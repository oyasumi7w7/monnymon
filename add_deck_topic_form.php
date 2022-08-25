<?php
session_start();
if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']>2 ){
  echo "<script>alert('สิทธิ์ไม่ถูกต้องสมัครสมาชิกก่อนครับ')</script>";
echo "<script>window.location='webboard.php'</script>";
}else{

}

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
      .mySlides {display:none;}
      
      
      </style>

  <body>
  
  <div class="site-wrap">
  <?php require_once ("include/header.php"); ?>

                <div class="bg-light py-3">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 mb-0"><a href="main.php">Home</a> <span class="mx-2 mb-0">/</span> <a href="deck_list.php">DeckBuilding</a> <span class="mx-2 mb-0">/</span> <a href="deck_build.php">SIM Builder</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Create Deck Topic</strong></div>
                        </div>
                    </div>
                </div>


<div class="jumbotron jumbotron-fluid" style="background-color: #008B8B;">
  <div class="container" style="color:#FFF8DC;">
    <h1 style="font-size: 50px; border-bottom:double; margin-right: 50%;">Monnymon Deck Builder</h1>
    <p style="font-size: 25px; border-bottom:double ; border-right:double; margin-right: 75%;">สร้างกระทู้ใหม่</p>
  </div>
</div>
<div class="container">
<form method='post' action='add_deck.php' enctype='multipart/form-data'>
<div class="form-group">
<label for="Headtopic">Topic</label>
<input type="text" class="form-control" placeholder="Topic" id="head" name="head">
</div>
<div class="form-group">
    <label for="exampleFormControlTextarea1">Comment</label>
    <textarea class="form-control" id="text" name="text" rows="3"></textarea>
    <label for="exampleFormControlFile1">อัพโหลดรูปภาพปกกระทู้</label>
    <input type="file" class="form-control-file" id="pic" name="pic">
    <hr>
    <button type="submit" class="btn btn-primary">Post</button> <button type="reset" class="btn btn-primary">Reset</button>
  </div>
</form>
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
