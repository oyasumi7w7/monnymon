<?php
session_start();

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
          <div class="col-md-12 mb-0"><a href="main.php">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Tournament</strong></div>
          
        </div>
      </div>
    </div>
 <div class="site-section site-blocks-2">
    <div class="site-section site-blocks-2">
      <div class="container">
        <div class="row justify-content-center  mb-5">
          <div class="col-md-7 site-section-heading text-center pt-4">
            <h2>เลือกรายการที่ต้องการ</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0" data-aos="fade" data-aos-delay="">
            <a class="block-2-item" href="tour_view.php">
              <figure class="image">
                <img src="images/register.jpg" alt="" class="img-fluid">
              </figure>
              <div class="text">
                <span class="text-uppercase">tournament</span>
                <h3>ลงทะเบียน</h3>
              </div>
            </a>
          </div>
          <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="100">
          
              <figure class="image">
                <img src="images/mo.png" alt="" class="img-fluid">
              </figure>
              
            
          </div>
          <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="200">
            <a class="block-2-item" href="tour_result_view.php">
              <figure class="image">
                <img src="images/result.jpg" alt="" class="img-fluid">
              </figure>
              <div class="text">
                <span class="text-uppercase">tournament</span>
                <h3>ดูผลการแข่ง</h3>
              </div>
            </a>
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
