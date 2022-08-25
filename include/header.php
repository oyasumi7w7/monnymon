<style>
.zoom2 {
  transition: transform .2s;
    width: 200px;
    /* height: 130px; */
    margin: 0 auto;
}
.site-navbar .site-navigation .site-menu {
    margin-top: 20px;
}

.site-mobile-menu .site-nav-wrap .arrow-collapse {
      right: 0px;
      top: 10px;
      z-index: 20;
      width: 36px;
      height: 36px;
      text-align: center;
      cursor: pointer;
      border-radius: 50%; }
/* 
.zoom {
          transition: transform .2s;  Animation 
          width: 200px;
          height: 130px;
          margin: 0 auto;
      } 
      */
.zoom2:hover {
    transform: scale(1.5); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
}
.bg-btn{
    background-color: initial;
    border: none;
}
.mySlides {display:none;}

  </style>

<header class="site-navbar" role="banner">
      <div class="site-navbar-top">
        <div class="container">
          <div class="row align-items-center">

            <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
              <a href="main.php"><img src="images/header-logo.png" class="js-logo-clone"></a>
            </div>

            <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
              <div class="site-logo">
                <img src="images/mo.png" class="rounded mx-auto d-block w-50">
              </div>
            </div>

            <div class="col-6 col-md-4 order-3 order-md-3 text-right">
              <div class="site-top-icons">
                <div class="row">
                  <div class="col-md-7 d-flex-justify-content-end">
                  <form method="post" action="shop.php" class="site-block-top-search">
                      <span class="icon icon-search2 ml-2"></span>
                      <input style="border-radius: 20px;" type="" name="search" class="form-control" placeholder="Search">
                    </form>
                  </div>
                  
                  <?php
            
                    if(empty($_SESSION['valid_user'])){//ถ้ายังไม่ login  
                      echo "<a href='login_shop.php'><h2><span class='icon icon-person'></span>เข้าสู่ระบบ</h2></a>";
                      $dis = "disabled";
                        }else{
                          $dis = "";
                           $nameuser=$_SESSION['valid_name'];
                           $nameuser_o = strlen($nameuser) > 5 ? mb_substr($nameuser,0,5)."..." : $nameuser;
                         ?>
                         <button class="btn btn-secondary dropdown-toggle icon-person" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             
                         <?php echo $nameuser_o ?>
                        </button>
                        <?php
                         include("include/shop_func.php")
                          //แสดงเมนูของ user ใน Type นั้น
                          ?>
                          <!-- <nav> -->
                         <?php 
                         select_menu($_SESSION['valid_type']);//แสดงเมนูของแต่ละ level 
                         ?>
                         <!-- </nav> -->
                     <?php          
                      }
                    ?>
  

                  <div class="col-md-5">
                    <ul>
                      <li class="d-inline-block d-md-none ml-md-0"><a href="#" class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a></li>
                    </ul>
                  </div>
                </div>
              </div> 
            </div>
          </div>
        </div>
      </div> 
      
      <nav class="site-navigation text-right text-md-center" role="navigation">
        <div class="container">
          <ul class="site-menu js-clone-nav d-none d-md-block">
            <li class="has-children">
              <div class="view overlay zoom2">
                <a href="shop.php"><img src="images/eevee-shop.png" class="rounded mx-auto d-block w-50"></a>
              </div>
            </li>
            <li class="has-children">
              <div class="view overlay zoom2">
                <a href="idle_tour.php"><img src="images/eevee-tour.png" class="rounded mx-auto d-block w-50"></a>
              </div>
            </li>
            <li class="has-children">
              <div class="view overlay zoom2">
                <a href="webboard.php";><img src="images/eevee-webbord.png" class="rounded mx-auto d-block w-50"></a>
              </div>
            </li>
            <li class="has-children ">
              <div class="view overlay zoom2">
                <a href="deck_list.php";><img src="images/eevee-deck.png" class="rounded mx-auto d-block w-50"></a>
              </div>
            </li>
            <li class="has-children">
              <div class="view overlay zoom2">
                <a href="contact.php";><img src="images/eevee-contact.png" class="rounded mx-auto d-block w-50"></a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
      <br>
<!-- 
        <div class="container"> 
          <div class="row mt-5">
            <div class="col-md-3 view overlay zoom">
              <a href="shop.php"><img src="images/eevee-button.png" class="rounded mx-auto d-block w-50"></a>
            </div>
            <div class="col-md-3 view overlay zoom">
              <a href="tour_view.php"><img src="images/eevee-button.png" class="rounded mx-auto d-block w-50"></a>
            </div>
            <div class="col-md-3 view overlay zoom">
              <a href="*"><img src="images/eevee-button.png" class="rounded mx-auto d-block w-50"></a>
            </div>
            <div class="col-md-3 view overlay zoom">
              <a href="*"><img src="images/eevee-button.png" class="rounded mx-auto d-block w-50"></a>
            </div>
          </div>
        </div> -->
    </header>