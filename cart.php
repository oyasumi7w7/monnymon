<?php
session_start();

include("include/connect_db.php");
$con=connect_db();

?>
<!DOCTYPE html>
<html lang="en">
<?php require_once ("include/tag-head.php"); ?>
    <style>
      .zoom {
          transition: transform .2s; /* Animation */
          width: 200px;
          height: 130px;
          margin: 0 auto;
      }
      .zoom:hover {
          transform: scale(1.5); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
      }
      .bg-btn{
        background-color: initial;
        border: none;
      }
      .btn-block2 {
    display: block;
    width: auto;
}
#btnEmpty {
    background-color: #ffffff;
    border: #d00000 1px solid;
    padding: 5px 10px;
    color: #d00000;
   
    text-decoration: none;
    border-radius: 3px;
    margin: 10px 0px;
}
      </style>
 
  <body>
  
    <div class="site-wrap">
            <?php require_once ("include/header.php"); ?>
       

            <div class="bg-light py-3">
              <div class="container">
                <div class="row">
                  <div class="col-md-12 mb-0"><a href="main.php">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Cart</strong></div>
                  
                </div>
              </div>
            </div>

            <?php 
            if(!empty($_GET["action"])) {
              switch($_GET["action"]) {
                case "decrease":

                  if(!empty( $_SESSION["strQuantity"])) {
                    foreach( $_SESSION["strQuantity"] as $k => $v) {
                  if($_GET["code"] == $k){
                          if($_SESSION["strQuantity"][$k]>1){
                            $_SESSION["strQuantity"][$k]-=1;
                          }else{
                            $_SESSION["strQuantity"][$k]-=0;
                          }
                        }
                      }
                    }
                break;
                case "increase":
                  $p_num = $_GET["p_num"];
                  if(!empty( $_SESSION["strQuantity"])) {
                    foreach( $_SESSION["strQuantity"] as $k => $v) {
                    
                      if($_GET["code"] == $k){
                        
                          if($_SESSION["strQuantity"][$k]<$p_num){
                            $_SESSION["strQuantity"][$k]+=1;
                          }else{
                            $_SESSION["strQuantity"][$k]-=0;
                          }
                          // $_SESSION["strQuantity"][$k]+=1;
                        
                      }
                    }
                  }
                break;
                case "remove":
                  if(!empty($_SESSION["strProID"])) {
                    foreach($_SESSION["strProID"] as $k => $v) {
                        if($_GET["code"] == $k){
                          unset($_SESSION["strProID"][$k]);		
                          foreach($_SESSION["strProID"] as $k => $v) {
                            if($_GET["code"] == $k){
                          unset($_SESSION["strQuantity"][$k]);	
                            }
                          }

                          $_SESSION["intLine"]-=1;
                          $_SESSION["numProduct"] -= 1;
                          }
                              
                        if(empty($_SESSION["strProID"])){
                          unset($_SESSION["strProID"]);
                          
                          unset($_SESSION["strQuantity"]);	
                        }
                    }
                  }
                break;
              case "empty":
                
                unset($_SESSION["strQuantity"]);	
                unset($_SESSION["strProID"]);
                $_SESSION["intLine"] = 0;
                $_SESSION["numProduct"] = 0;
              break;	
            }
          }

          ?>

    <div class="site-section">
      <div class="container">
        <a id="btnEmpty" href="cart.php?action=empty">Empty Cart</a>
          <div class="row mb-5">
            <form class="col-md-12" href="module/order/update.php" method="post">
              <div class="site-blocks-table">
                  <?php
                    if(!empty($_SESSION["intLine"])){
                  ?>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="product-thumbnail">Image</th>
                      <th class="product-name">Product</th>
                      <th class="product-price">Price</th>
                      <th class="product-quantity">Quantity</th>
                      <th style="text-align:center;" width="10%">- / +</th>
                      <th class="product-total"  width="5%">Total</th>
                      <th class="product-remove" width="5%">Remove</th>
                    </tr>
                  </thead>
                    <tbody>

                      <?php 
                      $intRows = 0;
                      $Total = 0;
                      $SumTotal = 0;
                      $sumram = 0;
                      $sumdisk = 0;
                      $totalqty = 0;

                

                      for ($i = 0; $i <= (int) $_SESSION["intLine"]; $i++) {

                          if (!empty($_SESSION["strProID"][$i])) {
                        // if ($_SESSION["strProID"][$i] != "") {
                              $strSQL = "SELECT * FROM product WHERE product_id = '" . $_SESSION["strProID"][$i] . "' ";
                              $objQuery = mysqli_query($con, $strSQL)  or die(mysqli_error());
                              $objResult = mysqli_fetch_array($objQuery);

                              if ($objResult['product_sprice'] != 0) {
                                  $Total = $_SESSION["strQuantity"][$i] * $objResult["product_sprice"];
                                  $SumTotal = $SumTotal + $Total;
                              } else {
                                  $Total = $_SESSION["strQuantity"][$i] * $objResult["product_price"];
                                  $SumTotal = $SumTotal + $Total;
                              }

                              $totalqty += $_SESSION["strQuantity"][$i];
                      
                        ?>
                        <?php

                        $intRows++;

                        ?>
                  

                        <tr>
                          <td class="product-thumbnail">
                            <img src="images/products_images/<?php echo $objResult['product_pic']; ?>" alt="Image" class="img-fluid">
                          </td>
                          <td class="product-name">
                            <h2 class="h5 text-black"><?php echo $objResult['product_name']; ?></h2>
                          </td>
                          <td> <?php
                                                          if ($objResult['product_sprice'] != 0) {
                                                              echo number_format($objResult["product_sprice"], 2);
                                                          } else {
                                                              echo number_format($objResult["product_price"], 2);
                                                          }
                                                          ?></td>
                          
                          <td style="text-align:center;"><strong><?php echo $_SESSION["strQuantity"][$i]; ?> / <?php echo $objResult["product_num"]; ?> </strong></td>
                          <td style="text-align:center;">
                              <a href="cart.php?action=decrease&code=<?php echo $i; ?>" class="btnMinusAction"><img src="images/minus.png" alt="decrease Item" /></a>
                              <b> | </b>
                              <a href="cart.php?action=increase&code=<?php echo  $i; ?>&&p_num=<?php echo $objResult["product_num"]; ?>" class="btnPlusAction"><img src="images/plus.png" alt="increase Item" /></a>
                          </td>
              
                          <td style='text-align:center;'><?php echo number_format($Total, 2); ?></td>
                          <td><a href="cart.php?action=remove&code=<?php echo  $i; ?>" class="btn btn-primary btn-sm">X</a></td>
                        </tr>
                    
                    

                  <?php
                          }
                  
                      }
                    echo "</tbody>";
                echo "</table>";
                ?>
                <?php
                          }else{
                            echo  "<div class='site-section'>
                              <div class='container'>
                                <div class='row'>
                                  <div class='col-md-12 text-center'>
                                    <span class='icon-shopping-cart display-3 text-success'></span>
                                    <h2 class='display-3 text-black'>NO ORDER</h2>
                                    <p class='lead mb-5'>ในตะกร้าไม่มีสินค้า</p>
                                    <p><a href='shop.php' class='btn btn-sm btn-primary'>Back to shop</a></p>
                                  </div>
                                </div>
                              </div>
                            </div>";
                          }
                          ?>
              </div>
            </form>
                <?php
                // echo "<br>";
                // print_r($_SESSION["intLine"]);
                // echo "<br>";
                // print_r($_SESSION["strQuantity"]);
                // echo "<br>";
                // print_r($_SESSION["strProID"]);
                ?>
          
          </div> 
                <?php  if(!empty($_SESSION["intLine"])){ ?>
              <div class="row">
                  <div class="col-md-6">
                    <div class="row mb-5">
                      <div class="col-md-6 mb-3 mb-md-0">
                        <a href="shop.php"><button class="btn btn-outline-primary btn-sm btn-block2">Continue Shopping</button></a>
                      </div>
                      <div class="col-md-6 mb-3 mb-md-0">
                        
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        
                      </div>
                      <div class="col-md-8 mb-3 mb-md-0">
                        
                      </div>
                      <div class="col-md-4">
                        
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6 pl-5">
                    <div class="row justify-content-end">
                      <div class="col-md-7">

                        <div class="row">
                          <div class="col-md-12 text-right border-bottom mb-5">
                            <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                          </div>
                        </div>

                       
                        <div class="row mb-5">
                          <div class="col-md-6">
                            <span class="text-black">Total</span>
                          </div>
                          <div class="col-md-6 text-right">
                            <strong class="text-black"><?php echo number_format($SumTotal, 2); ?> บาท</strong>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-12">
                            <button class="btn btn-primary btn-lg py-3 btn-block2" onclick="window.location='checkout.php'">Proceed To Checkout</button>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>

              </div>
<?php  }   ?>

  </div>
     
    </div>

    <?php require_once ("include/footer.php"); ?>
  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/slideshow.js"></script>
  <script src="js/main2.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function (event) {
        var scrollpos = sessionStorage.getItem('scrollpos');
        if (scrollpos) {
            window.scrollTo(0, scrollpos);
            sessionStorage.removeItem('scrollpos');
        }
    });

    window.addEventListener("beforeunload", function (e) {
        sessionStorage.setItem('scrollpos', window.scrollY);
    });
</script>
  </body>
</html>