<?php
session_start();

include("include/connect_db.php");
$con = connect_db();


?>
<!DOCTYPE html>
<html lang="en">
<?php require_once ("include/tag-head.php"); ?>


    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css">
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
      </style>
 
  <body>
        <div class="site-wrap">
        <?php require_once ("include/header.php"); ?>
          <?php 
            $id=$_GET['id'];
                        

          $item_show=mysqli_query($con,"SELECT * FROM product WHERE product_id='$id' ")or die("Sql Error1>>".mysqli_error($con));
          list($pro_id,$pro_name,$pro_cate,$pro_detail,$pro_price,$pro_sprice,$pro_num,$pro_sales,$pro_pic)=mysqli_fetch_row($item_show);
          
          ?>
      
    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="main.php">Home</a> <span class="mx-2 mb-0">/</span> <a href="shop.php">Shop</a> <span class="mx-2 mb-0">/</span> <strong class="text-black"><?php echo $pro_name; ?></strong></div>
        </div>
      </div>
    </div>  

    <div class="site-section">
      <div class="container">
      <form action="order.php" method="post">
        <div class="row">
          <div class="col-md-6">
            <img src="images/products_images/<?php echo $pro_pic; ?>" alt="Image" class="img-fluid">
          </div>
          <div class="col-md-6">
            <h2 class="text-black"><?php echo $pro_name; ?></h2>
            <p><?php echo $pro_detail; ?></p>
            <p><strong class="text-primary h4"><?php echo $pro_price; ?> บาท</strong></p>
            
            <div class="mb-5">
              <div class="input-group mb-3" style="max-width: 120px;">
              <input type="number" class="form-control text-center" name="quantity" value="1" min="1" max="<?php echo $pro_num; ?>">

            </div>
            </div>
            <?php
            if($pro_num==0){
               echo "<div>
                        <p><strong class='h4' style='color:red;'>สินค้าหมด</strong></p>
                    </div>";
            }else{

            ?>
                    <div>
                        <p><strong class="text-primary h4">เหลือทั้งหมด  <?php echo $pro_num; ?>  ชิ้น</strong></p>
                    </div>
                    <?php if(empty($_SESSION['valid_user'])){?>
          
                    <?php }else{ ?>
                        <button type="submit" class="buy-now btn btn-sm btn-primary" name="add">Add To Cart   <i class="icon icon-shopping_cart"></i></button>
                   <?php     }
            
            }
                 ?> 
            
            <input type="hidden" name="pro_id" value="<?php echo $pro_id ?>">

          </div>
        </div>
        </form>
      </div>
    </div>

    <div class="site-section block-3 site-blocks-2 bg-light">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7 site-section-heading text-center pt-4">
            <h2>Products</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="nonloop-block-3 owl-carousel">
<?php
            $product=mysqli_query($con,"SELECT*FROM product ORDER BY Rand() LIMIT 6")or die("Sql Error>>".mysqli_error($con));
  while(list($pro_id,$pro_name,$pro_cate,$pro_detail,$pro_price,$pro_sprice,$pro_num,$pro_sales,$pro_pic)=mysqli_fetch_row($product)){

    $tour=mysqli_query($con,"SELECT*FROM product_category WHERE cate_id='$pro_cate' ")or die("Sql Error1>>".mysqli_error($con));
		list($cate_id,$cate_name)=mysqli_fetch_row($tour);

  if($pro_sprice>0){
    $price=$pro_sprice;
  }else{
    $price=$pro_price;
  }
  ?>
              <div class="item">
                <div class="block-4 text-center" style="height:100%;width:100%;"> 
                  <figure class='block-4-image'>
                    <img src="images/products_images/<?php echo "$pro_pic";?>" style="height:300px;width:300px;" alt="Image placeholder" class="img-fluid">
                  </figure>
                  <div class="block-4-text p-4">
                    <h3><a href="shop-single.php?&id=<?php echo "$pro_id"; ?>"><?php echo "$pro_name"; ?></a></h3>
                    <p class="mb-0"><?php echo "$cate_name"; ?></p>
                    <p class="text-primary font-weight-bold"><?php echo "$price"; ?> บาท</p>
                  </div>
                </div>
              </div>
  <?php
  }
?>

            </div>
          </div>
        </div>
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
    
  </body>
</html>