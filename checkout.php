<?php
session_start();
if(empty($_SESSION["intLine"])){
  echo "<script>alert('ไม่มีสินค้าในตะกร้า')</script>";
  echo "<script>window.location='main.php'</script>";
}
include("include/connect_db.php");
$con=connect_db();


?>
<!DOCTYPE html>
<html lang="en">
<?php require_once ("include/tag-head.php"); ?>
    <style>
      .error {color: #FF0000;}
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
      .order-place{
        margin:0px;
        display: block;
    width: 100%;
    font-weight: 300;
    letter-spacing: .2em;
    border: none;
    
    position: relative;
 
}

      </style>
      
  </head>
  <body>

  <div class="site-wrap">
    <?php require_once ("include/header.php"); ?>
        

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="main.php">Home</a> <span class="mx-2 mb-0">/</span> <a href="cart.php">Cart</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Checkout</strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
      <form action="checkout_data.php" method="post" enctype="multipart/form-data" class="form-horizontal">
        <div class="row">
          <div class="col-md-6 mb-5 mb-md-0">
            <h2 class="h3 mb-3 text-black">Delivery Detail</h2>
            <div class="p-3 p-lg-5 border">
                                    <?php
                                        $detail=mysqli_query($con,"SELECT m_contract1,m_tel FROM member WHERE m_id='$_SESSION[valid_user]' ")or die("Sql Error1>>".mysqli_error($con));
                                        list($address,$tel)=mysqli_fetch_row($detail); 
                                         
                                        
                                        if(empty($_GET['phone'])){
                                          if($tel==''){
                                            $phone='';
                                          }else{
                                            $phone=$tel;
                                          }
                                        }else{
                                          $phone=$_GET['phone'];
                                        }  

                                        if(empty($_GET['address'])){
                                          if($address==''){
                                            $addresschk='';
                                          }else{
                                            $addresschk=$address;
                                          }
                                        }else{
                                          $addresschk=$_GET['address'];
                                        }  
                                        
                                      
                                    ?>
                   
                              <label for="address" class=" form-control-label" style="color:black" >Address :</label><span class="error">* Required</span><br>                        
                              <textarea name="address" rows="5" placeholder="Address..." class="form-control" required><?php echo $addresschk ?></textarea>
                              <br><label for="phone" class=" form-control-label"  style="color:black" >Phone Number : </label><span class="error">* Required</span><br>
                              <input type="text" name="phone" style="padding: 15px 25px; text-align: left;"  class="form-control" maxlength = "10"  onkeypress="return isNumber(event)" value="<?php echo $phone ?>" >

                              <?php 
                              if(empty($_GET['ems'])){
                                $chk = '';
                              }else{
                                $chk = $_GET['ems'];
                              }
                              
                                  if($chk==1){ 
                                    $check ='checked';
                                    $check2 ='';
                                    }elseif($chk==2){
                                       $check ='';
                                      $check2 ='checked';
                                    }else{
                                      $check ='';
                                      $check2 ='';
                                    }
                              ?>
                              <br><br><label for="ems" class=" form-control-label" style="color:black" >Service :</label><span class="error">* Required</span><br>
                            <input type="radio" name="ems" <?php echo $check;  ?> value="1" onchange="window.location='?address=' + address.value + '&phone=' + phone.value + '&ems='+this.value"   required > <a style="color:black" > การส่งแบบลงทะเบียน (Registered) + ค่าส่ง30</a>
                              <br>
                            
                            <input type="radio" name="ems" <?php echo $check2; ?> value="2" onchange="window.location='?address=' + address.value + '&phone=' + phone.value + '&ems='+this.value" > <a style="color:black" >การส่งแบบด่วน (EMS) + ค่าส่ง50</a>

            </div>
          </div>

          <div class="col-md-6">
            <!-- <div class="row mb-5">
              <div class="col-md-12">
                <h2 class="h3 mb-3 text-black">Coupon Code</h2>
                <div class="p-3 p-lg-5 border">
                  
                  <label for="c_code" class="text-black mb-3">Enter your coupon code if you have one</label>
                  <div class="input-group w-75">
                    <input type="text" class="form-control" id="c_code" placeholder="Coupon Code" aria-label="Coupon Code" aria-describedby="button-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary btn-sm" type="button" id="button-addon2">Apply</button>
                    </div>
                  </div>

                </div>
              </div>
            </div> -->
            <div class="row mb-5">
              <div class="col-md-12">
                <h2 class="h3 mb-3 text-black">Your Order</h2>
                <div class="p-3 p-lg-5 border">
                  <table class="table site-block-order-table mb-5">

                    <thead>
                      <th>Product</th>
                      <th>Total</th>
                    </thead>
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
                        
                    <tbody>
                    
                      <tr>
                        <td><?php echo $objResult['product_name']; ?><strong class="mx-2">x</strong> <?php echo $_SESSION["strQuantity"][$i]; ?></td>
                        <td><?php echo number_format($Total, 2); ?></td>
                      </tr>    
                                 
<?php
                    }
                  }
                                        if($chk==1){ 
                                          $SumTotal2 = $SumTotal+30;
                                          $ship_cost = 30;
                                          }elseif($chk==2){
                                            $SumTotal2 = $SumTotal+50;
                                            $ship_cost = 50;
                                          }else{
                                            $SumTotal2 = $SumTotal;
                                            $ship_cost = '';
                                          }
?>   
                      <tr>
                        <td class="text-black font-weight-bold"><strong>Subtotal</strong></td>
                        <td class="text-black font-weight-bold"><strong><?php echo number_format($SumTotal, 2); ?> บาท</strong></td>
                      </tr>
                    <?php if(!empty($chk)){?>
                      <tr>
                        <td class="text-black font-weight-bold"><strong>Shipping cost</strong></td>
                        <td class="text-black font-weight-bold"><strong><?php echo number_format($ship_cost, 2); ?> บาท</strong></td>
                      </tr>  
                    <?php } ?>

                      <tr>
                        <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                        <td class="text-black font-weight-bold"><strong><?php echo number_format($SumTotal2, 2); ?> บาท</strong></td>
                      </tr>
                    </tbody>
                  </table>

                  

                  <div class="form-group">
                    <input class="order-place" type="submit" value="Place Order">
                    <!-- <button class="btn btn-primary btn-lg py-3 btn-block" >Place Order</button> -->
                  </div>

                </div>
              </div>
            </div>

          </div>
        </div>
        </form>
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
<script>
        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
                if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                    return false;
                }
                    return true;
        }
        
    </script>
  </body>
</html>