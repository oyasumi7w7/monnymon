<?php
date_default_timezone_set("Asia/Bangkok");
session_start();
if(empty($_SESSION['numProduct'])){
$_SESSION['numProduct']=0;
$_SESSION["intLine"]=0;
}

include("include/connect_db.php");
$con=connect_db();
// if (empty($_SESSION['intLine'])) {
//   $_SESSION['intLine']='0';
// }

?>
<!DOCTYPE html>
<html lang="en">
<?php require_once ("include/tag-head.php"); ?>
  <!-- <head>
    <title>Shoppers &mdash; Colorlib e-Commerce Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700"> 
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/themify-icons.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/login.css" type="text/css"> 
</head> -->
<style>
  .img-center{
    margin: 0 auto;
    width: 50%;
  }
  .marquee {
  height: 55px;
  width: 100%;
  font-size:30px;
  background-color: black;
  overflow: hidden;
  position: relative;
}

.marquee div {
  display: block;
  width: 200%;
  height: 55px;

  position: absolute;
  overflow: hidden;

  animation: marquee 20s linear infinite;
}

.marquee span {
  float: left;
  width: 100%;
}

@keyframes marquee {
  0% { left: 100%; }
  100% { left: -100%; }
}
.blinking{
    animation:blinkingText 1.2s infinite;
}
@keyframes blinkingText{
    0%{     color: white;    }
    49%{    color: red; }
    60%{    color: white; }
    99%{    color:red;  }
    100%{   color: white;    }
}

  </style>
  <body>
  <?php
if(empty($_GET['do'])){
  $do="";
}else{
    $do=$_GET['do'];
}
if($do==1){
  echo '<script type="text/javascript">
        swal("", "ออกจากระบบเสร็จสิ้น", "success");
        </script>';
}
?>
  <div class="site-wrap">
  <?php require_once ("include/header.php"); ?>

<?php require_once ("include/slide_show.php"); ?>

<br>
<?php
$date=DATE("Y-m-d");
$comp=mysqli_query($con,"SELECT tour_no,tour_name FROM tournament WHERE tour_start='$date' ")or die("SQL Error1==>".mysqli_error($con));
list($t_num,$t_name)=mysqli_fetch_row($comp);

if(!empty($t_num)){
?>

          <div class="marquee">
            <div>
            
            <span class="blinking">*** วันนี้มีการแข่งขันทัวร์ <?php echo $t_name?> เข้าไปติดตามไลฟ์ที่ <a href="https://www.facebook.com/Monnymon-Shop-257313710953489/">FACEBOOK</a> หรือสามารถติดตามผลการแข่งได้ <a href="show_result.php?tid=<?php echo $t_num?>">ที่นี่</a> </span> 

            </div> 
        </div>
        <?php } ?>


<div class="site-section site-blocks-2">
      <div class="container">
        <div class="row justify-content-center  mb-5">
          <div class="col-md-7 site-section-heading text-center pt-4">
            <h2>Card Gameที่ทางร้านเป็นตัวแทนจำหน่าย</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0" data-aos="fade" data-aos-delay="">
            <a class="block-2-item" >
              <figure class="image">
                <img src="images/buddy.jpg" alt="" class="img-fluid">
              </figure>
              <div class="text">
                <h3>Future Card Buddyfight</h3>
              </div>
            </a>
          </div>
          <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="100">
            <a class="block-2-item" >
              <figure class="image">
                <img src="images/vg.jpg" alt="" class="img-fluid">
              </figure>
              <div class="text">
                <h3>Cardfight!! Vanguard</h3>
              </div>
            </a>
          </div>
          <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="200">
            <a class="block-2-item" >
              <figure class="image">
                <img src="images/bsjp.jpg" alt="" class="img-fluid">
              </figure>
              <div class="text">
                <h3>Battle Spirits</h3>
              </div>
            </a>
          </div>
          <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="200">
            <a class="block-2-item" >
              <figure class="image">
                <img src="images/ws.jpg" alt="" class="img-fluid">
              </figure>
              <div class="text">
                <h3>Weiß Schwarz</h3>
              </div>
            </a>
          </div>
          <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="200">
            <a class="block-2-item" >
              <figure class="image">
                <img src="images/pkmn.jpg" alt="" class="img-fluid">
              </figure>
              <div class="text">
                <h3>Pokemon Trading Card Game</h3>
              </div>
            </a>
          </div>
          <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="200">
            <a class="block-2-item" >
              <figure class="image">
                <img src="images/reb.jpg" alt="" class="img-fluid">
              </figure>
              <div class="text">
                <h3>Rebirth For You</h3>
              </div>
            </a>
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
 
    <div class="site-section block-8">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-5">
          <div class="embed-responsive embed-responsive-16by9" >
            <iframe width="560" height="315" src="https://www.youtube.com/embed/videoseries?list=PLg2cUnlAgg1gUpoeB6YOK1u3EpI8pxdd8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>
        </div>
        <div class="col-lg-6 col-md-7">
          <div class="video-content">
            <h3 class="text-black" align="center"> ติดตามคลิปใหม่ๆของทางร้านได้ที่<br>Youtube Channel<br> <a href="https://www.youtube.com/channel/UCqxR1JssE57uHVLPR6PnLyg">Monnymon World</a></h3>
          </div>
        </div>
      </div>
    </div>
    </div>
    
<?php  mysqli_close($con);?>
    <?php require_once ("include/footer.php"); ?>
  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/main2.js"></script>
    
  <script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";  
  }
  x[slideIndex-1].style.display = "block";  
}
</script>
  </body>
</html>
