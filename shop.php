<?php
session_start();

include("include/connect_db.php");
$con = connect_db();



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
      .site-block-27 ul li {
            display: inline;
            margin-bottom: 4px;
        }
        .active, .dot:hover {
    background-color: #71717100;
}
      </style>
  
  <body>
  
  <div class="site-wrap">
  <?php require_once ("include/header.php"); ?>
     
    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="main.php">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Shop</strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">

        <div class="row mb-5">
          <div class="col-md-9 order-2">

            <div class="row">
              <div class="col-md-12 mb-5">
                
                <?php 

                if(empty($_POST['search'])){ //ถ้ามีการส่งค่าตัวแปร get_search มาจากช่องค้นหา
                    $search="";
                    //นำค่ามาเก็บไว้ในตัวแปรแล้วค่อยนำไปใช้
                }
                else{
                    $search=$_POST['search'];
                }

                $result=mysqli_query($con,"SELECT product_name FROM product WHERE product_name LIKE '%$search%' ")or die("SQL Error==>".mysqli_error($con));
                // $item1=mysqli_query($con,"SELECT product_name FROM product WHERE product_category ='1' ")or die("SQL Error==>".mysqli_error($con));
                // $item2=mysqli_query($con,"SELECT product_name FROM product WHERE product_category ='2' ")or die("SQL Error==>".mysqli_error($con));
                // $item3=mysqli_query($con,"SELECT product_name FROM product WHERE product_category ='3' ")or die("SQL Error==>".mysqli_error($con));
                // $rowsI1=mysqli_num_rows($item1);
                // $rowsI2=mysqli_num_rows($item2);
                // $rowsI3=mysqli_num_rows($item3);

                    $rows=mysqli_num_rows($result); //ใช้นับจำนวนแถวที่คิวรี่หรือซีเลคออกมาได้ พารามิเตอร์ 1 ตัวคือ ชื่อตัวแปรที่ใช้คิวรี่ รีเทิร์นค่าออกมาเป็นจำนวนแถวที่นับได้เป็นจำนวนเต็ม
                    $rows_page=15; //จำนวนแถวที่ต้องการให้แสดงใน 1 หน้า
                    $pages=ceil($rows/$rows_page); //จำนวนหน้าหาจาก (จำนวนแถว หาร จำนวนแถวต่อหน้า)ปัดเศษขึ้น *ceil
                    
                    if(isset($_GET['pid'])){ //ตรวจสอบว่ามีการส่งค่า หมายเลขหน้ามาหรือไม่
                        $pid=$_GET['pid']; //หมายเลขหน้าที่ส่งมาจาก link
                        $start_rows=($pid-1)*$rows_page; //คำนวณหาแถวแรกแต่ละหน้า
                    }
                    else{ //ถ้าไม่มีการคลิก link เลขหน้า
                        $pid=1; //กำหนดหน้า เป็นหน้าแรก
                        $start_rows=0; //แถวแรก
                    }
                    
                    
                    if($rows==0){ //ถ้าคำค้นไม่ตรงกับสินค้าใดๆ
                        // echo "<p>NOT FOUND</p>";
                    }
                    else{
                            // echo "<p>PRODUCT FOUND $rows </p>";?>

                
              </div>
            </div>
            <div class="row mb-5">
<?php                        


            $result=mysqli_query($con,"SELECT product_id,product_name,product_category,product_price,product_num,product_pic FROM product WHERE product_name LIKE '%$search%'
            ORDER BY product_name DESC LIMIT $start_rows,$rows_page ")or die("Sql Error>>".mysqli_error($con));
            
            
    while(list($pro_id,$pro_name,$pro_cate,$pro_price,$pro_num,$pro_pic)=mysqli_fetch_row($result)){
        $name_out = strlen($pro_name) > 60 ? mb_substr($pro_name,0,60)."..." : $pro_name;

        // echo      "<div class='col-sm-6 col-lg-4 mb-4' data-aos='fade-up'>";
        // echo        "<div class='block-4 text-center border'>";
        // echo          "<figure class='block-4-image'>";
        // echo            "<a href='shop-single.php?&id=$pro_id'><img src='images/products_images/$pro_pic' alt='Image placeholder' class='img-fluid'></a>";
        // echo          "</figure>";
        // echo          "<div class='block-4-text p-4'>";
        // echo            "<h3><a href='shop-single.php?&id=$pro_id>$name_out</a></h3>";
        // echo            "<p class='mb-0'>Finding perfect t-shirt</p>";
        // echo            "<p class='text-primary font-weight-bold'>$pro_price  บาท</p>";
        // echo          "</div>";
        // echo        "</div>";
        // echo      "</div>"; 
        ?>
                  <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                  <div class="block-4 text-center border" style="height:100%;width:100%;">
                    <figure class="block-4-image">
                      <a href="shop-single.php?&id=<?php echo "$pro_id";?>" ><img src="images/products_images/<?php echo "$pro_pic";?>" style="height:300px;width:300px;" alt="Image placeholder" class="img-fluid"></a>
                    </figure>
                    <div class="block-4-text p-4">
                      <h3><a href="shop-single.php?&id=<?php echo "$pro_id";?>"><?php echo"$name_out"; ?></a></h3>
                      <p class="mb-0">---</p>
                      <?php
                      if($pro_num==0){
                        echo " <p class=' font-weight-bold' style='color:red;' >สินค้าหมด</p>";
                      }else{
                      ?>
                        <p class="text-primary font-weight-bold"><?php echo"$pro_price"; ?> บาท</p>
                      
                      <?php } ?>

                    </div>
                  </div>
                </div>
<?php
    }
                } 
            
           ?>
            </div>
          
            <div class="row" data-aos="fade-up">
              <div class="col-md-12 ">
                <div class="site-block-27">
                  
                  <ul>
                  <?php 
                  for($i=1;$i<=$pages;$i++){ //วนลูปตามจำนวนหน้า
                    // echo "<li><a href='#''>&lt;</a></li>";
                    if($i==$pid){
                    
                    echo "<li class='active'><span> $i </span></li>";
                   
                    }else{
                      echo "<li><a href='shop.php?pid=$i&&search=$search'><span> $i </span></a></li>";
                    }
                  }
                    ?>
                  </ul>
                </div>
              </div>
            </div>

          </div>

          <div class="col-md-3 order-1 mb-5 mb-md-0">
              <div class="border p-4 rounded mb-4">
                <h3 class="mb-3 h6 text-uppercase text-black d-block">Categories</h3>
                <ul class="list-unstyled mb-0">
                  <li class="mb-1"><a href="shop.php" class="d-flex"><span>ทั้งหมด</span> <span class="text-black ml-auto">(<?php echo $rows; ?>)</span></a></li>
                  <?php
                  $category=mysqli_query($con,"SELECT*FROM product_category")or die("Sql Error>>".mysqli_error($con));
                          
                          
                  while(list($c_id,$c_name)=mysqli_fetch_row($category)){
                    $qty=mysqli_query($con,"SELECT product_name FROM product WHERE product_category ='$c_id' ")or die("SQL Error==>".mysqli_error($con));
                    $qty_pro=mysqli_num_rows($qty);
                    if($qty_pro==0){

                    }else{
                      ?>
                        <li class="mb-1"><a href="shop_cate.php?cate=<?php echo $c_id; ?>" class="d-flex"><span><?php echo $c_name; ?></span> <span class="text-black ml-auto">(<?php echo $qty_pro; ?>)</span></a></li>
                      <?php
                    }
                    ?>
                  <!-- <li class="mb-1"><a href="shop_cate.php?cate=3" class="d-flex"><span>Supply</span> <span class="text-black ml-auto">(<?php echo $rowsI3; ?>)</span></a></li>
                  <li class="mb-1"><a href="shop_cate.php?cate=1" class="d-flex"><span>Single Card</span> <span class="text-black ml-auto">(<?php echo $rowsI1; ?>)</span></a></li> -->
                  <?php
                  }
                  ?>
                </ul>
              </div>
            </div>
</div>
      </div>
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
                    <div class="col-md-12" >
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

    
    <?php require_once ("include/footer.php"); 
    mysqli_close($con);
    ?>
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