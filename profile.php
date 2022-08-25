<meta charset="UTF-8">
<?php
session_start();
if(empty($_SESSION['valid_user'])){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='main.php'</script>";
  }

?>

<!DOCTYPE html>
<html>

<head>
  <!-- Required meta tags-->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="au theme template">
  <meta name="author" content="Hau Nguyen">
  <meta name="keywords" content="au theme template">
  <!-- Title Page-->
  <title>BackEnd</title>
  <!-- Fontfaces CSS-->
  <link href="css/font-face.css" rel="stylesheet" media="all">
  <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet" >
  <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
  <!-- Bootstrap CSS-->
  <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
  <!-- Vendor CSS-->
  <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
  <!-- Main CSS-->
  <link href="css/theme.css" rel="stylesheet" media="all">
</head>

<body class="animsition">
  <div class="page-wrapper">
    <!-- HEADER MOBILE-->
    <header class="header-mobile d-block d-lg-none">
      <div class="header-mobile__bar">
        <div class="container-fluid">
          <div class="header-mobile-inner">
            <a class="logo" href="index.html">
              <img src="images/icon/header-logo-2-no-border.png" >
            </a>
            <button class="hamburger hamburger--slider" type="button">
              <span class="hamburger-box">
                <span class="hamburger-inner"></span>
              </span>
            </button>
          </div>
        </div>
      </div>

      <nav class="navbar-mobile">
        <div class="container-fluid">
          <ul class="navbar-mobile__list list-unstyled">
          <?php
                include("include/menu_profile.php"); //เรียกใช้เมนู ตามประเภทของผู้ใช้ 
              ?>
          </ul>
        </div>
      </nav>
    </header>
    <!-- END HEADER MOBILE-->
    <!-- MENU SIDEBAR-->
    
    <aside class="menu-sidebar d-none d-lg-block">
      <div class="logo">
        <a href="#">
          <img src="images/icon/header-logo-2-no-border.png" alt="Cool Admin">
        </a>
      </div>
      <div class="menu-sidebar__content js-scrollbar1" style="">
        <nav class="navbar-sidebar">
          <ul class="list-unstyled navbar__list">
          <?php
                include("include/menu_profile2.php"); //เรียกใช้เมนู ตามประเภทของผู้ใช้ 
              ?>
          </ul>
        </nav>
      </div>
    </aside>
    <!-- END MENU SIDEBAR-->
    <!-- PAGE CONTAINER-->
    <div class="page-container">
      <!-- HEADER DESKTOP-->
      <header class="header-desktop">
        <div class="section__content section__content--p30">
          <div class="container-fluid">
            <div class="header-wrap">
              <form class="form-header">
              </form>
              <div class="header-button">
                <div class="noti-wrap">
                </div>
                <div class="account-wrap">
                  <div class="account-item clearfix js-item-menu">
                    <div class="image">
                      <img src="images/icon/user-icon.jpg" alt="John Doe" />
                    </div>
                    <div class="content">
                      <a class="js-acc-btn" href="#"> <?php echo $_SESSION['valid_name']; ?> &nbsp;&nbsp;  <?php echo $_SESSION['valid_lastname']; ?></a>
                    </div>
                    <div class="account-dropdown js-dropdown">
                      <div class="account-dropdown__footer">
                        <a href="main.php"><i class="fa fa-shopping-cart"></i>เว็บร้าน</a>
                        <a href="module/user/logout.php"><i class="zmdi zmdi-power"></i>Logout</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>
      <!-- HEADER DESKTOP-->
      <!-- MAIN CONTENT-->
      <div class="main-content">
        <div class="section__content section__content--p30">
          <div class="container-fluid">
                  <?php
                    if(empty($_GET['module']) or empty($_GET['action'])){ //ถ้าตัวแปร module หรือ action ว่าง
                      $module="user";
                      $action="user_profile";
                    }
                    else{
                      $module=$_GET['module']; //เก็บชื่อ folder
                      $action=$_GET['action']; //เก็บชื่อไฟล์
                    }
                    include("module/$module/$action.php");
                ?>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="copyright">
                <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
  </div>
  </div>
  <!-- Jquery JS-->
  <script src="vendor/jquery-3.2.1.min.js"></script>
  <!-- Bootstrap JS-->
  <script src="vendor/bootstrap-4.1/popper.min.js"></script>
  <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
  <!-- Vendor JS       -->
  <script src="vendor/slick/slick.min.js">
  </script>
  <script src="vendor/wow/wow.min.js"></script>
  <script src="vendor/animsition/animsition.min.js"></script>
  <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
  </script>
  <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
  <script src="vendor/counter-up/jquery.counterup.min.js">
  </script>
  <script src="vendor/circle-progress/circle-progress.min.js"></script>
  <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="vendor/chartjs/Chart.bundle.min.js"></script>
  <script src="vendor/select2/select2.min.js">
  </script>
  <!-- Main JS-->
  <script src="js/main.js"></script>
  <!-- end document-->





</body>

</html>