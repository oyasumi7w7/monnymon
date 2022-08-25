<?php
session_start();

if(empty($_SESSION['valid_user'])){
 
	}else{
	echo "<script>alert('คุณได้เข้าสู่ระบบอยู่แล้ว')</script>";
  echo "<script>window.location='main.php'</script>";
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
      </style>
  </head>
  <body>
  <?php

if(empty($_GET['do'])){
  $do="";
}else{
    $do=$_GET['do'];
}

if($do==1){
 echo '<script type="text/javascript">
       swal("", "ไอดี หรือ รหัสผ่าน ไม่ถูกต้อง", "error");
       </script>';
}

?>
  <div class="site-wrap">
  <?php require_once ("include/header.php"); ?>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="main.php">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Login</strong></div>
        </div>
      </div>
    </div> 

    
    <!------ Include the above in your HEAD tag ---------->
    
    <div class="wrapper"><!--fadeInDown ถ้าต้องการ fade-->
      <div id="formContent">
        <!-- Tabs Titles -->
    
        <!-- Icon -->
        <div class="image">
          <img src="images/mo.png" id="icon" alt="icon" />
        
        </div>
             <a ><h1 class="title">เข้าสู่ระบบ</h1></a>
        <!-- Login Form -->
        <form method="post" action="module/user/check_login.php">  
          <input type="text" id="login" class="fadeIn second" name="username" placeholder="login">
          <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
          <input type="submit" class="fadeIn fourth" value="Log In">
        </form>
    
        <!-- Remind Passowrd -->
        <div id="formFooter">
          ยังไม่ใช่สมาชิกใช่ไหม?<a class="underlineHover" href="register.php">สมัครสมาชิก</a>
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