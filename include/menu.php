<?php
if($_SESSION['valid_type']==1){ //ถ้า session valid_type ไม่ว่าง
	$user_type=admin_menu();
	}elseif($_SESSION['valid_type']==2){
		$user_type=customer_menu();
	}

	/*function select_menu($type){
		switch($type){
			case "1" : admin_menu();break;
			case "2" : customer_menu();break;
		}
	}
	*/
	function admin_menu(){
         //echo "<li><a href='index.php?module=tour&action=list_tour'><i class='fas fa fa-address-card'></i>รายการแข่ง</a></li>";
         echo "<li class='has-sub'>";
        echo                    "<a class='js-arrow' href='#'><i class='fas fa fa-user'></i>ข้อมูลส่วนตัว</a>";
		echo                    "<ul class='navbar-mobile-sub__list list-unstyled js-sub-list'>";
		echo                        "<li>";
        echo                           "<a href='index.php?module=user&action=show_profile'>--> ข้อมูลส่วนตัว</a>";
        echo                        "</li>";
        echo                        "<li>";
        echo                            "<a href='index.php?module=user&action=re_password'>--> เปลี่ยนรหัสผ่าน</a>";
        echo                        "</li>";
        echo                    "</ul>";
        echo "<li><a href='index.php?module=topic&action=manage_topic_self'><i class='fas fa fa-table'></i>จัดการกระทู้ของตนเอง</a></li>";
        echo "<li><a href='index.php?module=order&action=list_order'><i class='fas fa fa-truck'></i>ข้อมูลการสั่งซื้อส่วนตัว</a></li>";
        echo "<li><a href='index.php?module=tour&action=history'><i class='fas fa fa-gamepad'></i>ประวัติการแข่ง</a></li>";
        echo "<br>";
        echo "<a style='align:center'>-----------------------<a>";

        echo "<li><a href='index.php?module=topic&action=manage_topic_shop'><i class='fas fa fa-table'></i>จัดการกระทู้ร้าน</a></li>";
		echo "<li class='has-sub'>";
        echo                    "<a class='js-arrow' href='#'>";
        echo                    "<i class='fas fa fa-gamepad'></i>จัดการการแข่ง</a>";
		echo                    "<ul class='navbar-mobile-sub__list list-unstyled js-sub-list'>";
		echo                        "<li>";
        echo                           "<a href='index.php?module=tour&action=list_tour'>--> เพิ่มรายการแข่ง</a>";
        echo                        "</li>";
        echo                        "<li>";
        echo                           "<a href='index.php?module=tour&action=tour_draw'>--> จัดการผลคู่การแข่งขัน</a>";
        echo                        "</li>";
        echo                    "</ul>";

        echo "<li class='has-sub'>";
        echo                    "<a class='js-arrow' href='#'>";
        echo                    "<i class='fas fa fa-cart-plus'></i>จัดการคลัง</a>";
		echo                    "<ul class='navbar-mobile-sub__list list-unstyled js-sub-list'>";
		echo                        "<li>";
        echo                           "<a href='index.php?module=item&action=manage_item'></i>--> จัดการข้อมูลสินค้า</a>";
        echo                        "</li>";
        echo                        "<li>";
        echo                           "<a href='index.php?module=item&action=warehouse'>--> จัดการคลังสินค้า</a>";
        echo                        "</li>";
        echo                    "</ul>";

        // echo "<li class='has-sub'>";
        // echo                    "<a class='js-arrow' href='#'>";
        // echo                    "<i class='fas fa fa-file'></i>ออกรายงาน</a>";
		// echo                    "<ul class='navbar-mobile-sub__list list-unstyled js-sub-list'>";
		// echo                        "<li>";
        // echo                           "<a href='index.php?module=report&action=report_product'></i>--> รายงานสินค้า</a>";
        // echo                        "</li>";
        // echo                        "<li>";
        // echo                           "<a href='index.php?module=report&action=warehouse'>--> จัดการคลังสินค้า</a>";
        // echo                        "</li>";
        // echo                    "</ul>";
		
        echo "<li><a href='index.php?module=report&action=report_product'><i class='fas fa fa-file'></i> ออกรายงาน</a></li>";
        echo "<li><a href='index.php?module=order&action=manage_order'><i class='fas fa fa-truck'></i>ตรวจสอบคำสั่งซื้อ</a></li>";
        echo "<li><a href='index.php?module=tour&action=reward'><i class='fas fa-award'></i></i>จัดการของรางวัล</a></li>";
        echo "<li><a href='index.php?module=card&action=manage_card'><i class='fas fa fa-star'></i>จัดการข้อมูลการ์ด</a></li>";
  	 	echo "<li><a href='index.php?module=user&action=manage_user'><i class='fas fa fa-address-card'></i>จัดการข้อมูลสมาชิก</a></li>";
        echo "<li><a href='index.php?module=slide&action=manage_slide'><i class='fas fa fa-image'></i>จัดการSlide Show</a></li>";
		//echo "<li><a href='#'><i class='fas fa fa-dashboard'></i>สถิติ</a></li>";
		// echo "<li><a href='#'><i class='fas fa fa-file'></i>ออกรายงาน</a>";
         
     }

	function customer_menu(){
        echo "<li class='has-sub'>";
		echo                    "<a class='js-arrow' href='#'>";
        echo                    "<i class='fas fa fa-user'></i>ข้อมูลส่วนตัว</a>";
		echo                    "<ul class='navbar-mobile-sub__list list-unstyled js-sub-list'>";
		echo                        "<li>";
        echo                           "<a href='index.php?module=user&action=show_profile'>ข้อมูลส่วนตัว</a>";
        echo                        "</li>";
        echo                        "<li>";
        echo                            "<a href='index.php?module=user&action=re_password'>เปลี่ยนรหัสผ่าน</a>";
        echo                        "</li>";
        echo                    "</ul>";
        echo "<li><a href='index.php?module=topic&action=manage_topic_self'><i class='fas fa fa-table'></i>จัดการกระทู้ของตนเอง</a></li>";
		echo "<li><a href='index.php?module=order&action=list_order'><i class='fas fa fa-truck'></i>ข้อมูลการสั่งซื้อส่วนตัว</a></li>";
        echo "<li><a href='index.php?module=tour&action=history'><i class='fas fa fa-gamepad'></i>ประวัติการแข่ง</a></li>";
	}

?>
