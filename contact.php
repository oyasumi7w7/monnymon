<?php
session_start();
if(empty($_SESSION['numProduct'])){
$_SESSION['numProduct']=0;
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
<style>
  .img-center{
    margin: 0 auto;
    width: 50%;
  }

  </style>
  <body>
  
  <div class="site-wrap">
      <?php require_once ("include/header.php"); ?>
  
                <div class="bg-light py-3">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 mb-0"><a href="main.php">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Contact</strong></div>
                        </div>
                    </div>
                </div>


                <div class="site-section site-blocks-2">
                  <div class="container " style="text-align: center;">
                    <div class="row justify-content-center  mb-5">
                      <div class="col-md-7 site-section-heading text-center pt-4">
                        <h2>ติดต่อเรา</h2>
                      </div>
                    </div>
                    <div class="mapouter">
                        <div class="gmap_canvas">
                          <iframe class="gmap_iframe" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=Monnymon&amp;t=p&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                          <a href="https://piratebayproxy.net/">pirate bay proxy</a>
                        </div><style>.mapouter{position:relative;text-align:right;width:600px;height:400px; display: block;border-style:none;margin: 0 auto;}.gmap_canvas {overflow:hidden;background:none!important;width:600px;height:400px;}.gmap_iframe {width:600px!important;height:400px!important;}</style>
                    </div>
                    <P>ร้านอยู่ถนนจ่าบ้าน (ถนนหลังวัดเจดีย์หลวง) ร้านสีเขียวมีไวนิลสีบานเย็น</P>
                  </div>
                </div>
    
                <?php require_once ("include/slide_show.php"); ?>

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
                            <h3 class="text-black" align="center"> ติดตามคลิปใหม่ๆของทางร้านได้ที่<br>Youtube Channel<br> <a href="https://www.youtube.com/channel/UCqxR1JssE57uHVLPR6PnLyg">Monnymon Shop</a></h3>
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
