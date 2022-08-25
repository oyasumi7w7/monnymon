<?php



function select_menu($type){
	switch($type){
		case "1" : admin_menu();break;
		case "2" : customer_menu();break;
	}
}

function admin_menu(){
    echo "<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>";
    echo        "<ul class='navbar-right'>";?>

                    <li><a href="cart.php" id="cart"><i class="icon icon-shopping_cart"></i> Cart 
                    <?php
                        if ($_SESSION['numProduct']!=0 || $_SESSION['numProduct'] != ''){
                            echo "<span id='cart_count' class='text-warning bg-light'>". $_SESSION['numProduct'] ."</span>";
                        }else{
                            echo "<span id='cairt_count' class='text-warning bg-light'>0</span>";
                        }
                    ?> </a></li>
<?php
                      
    echo        "</ul> <!--end navbar-right -->";
        echo "<a class='dropdown-item' href='main.php'>หน้าหลัก</a>";
        echo "<a class='dropdown-item' href='index.php?module=user&action=show_profile'>จัดการข้อมูลส่วนตัว</a>";
        echo "<a class='dropdown-item' href='index.php?module=item&action=manage_item'>จัดการร้าน</a>";
        echo "<a class='dropdown-item' href='module/user/logout.php'>Logout</a>";
    echo "</div>";
}

function customer_menu(){
    echo "<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>";
    echo        "<ul class='navbar-right'>";?>

    <li><a href="cart.php" id="cart"><i class="icon icon-shopping_cart"></i> Cart 
    <?php
        if ($_SESSION['numProduct']!=0 || $_SESSION['numProduct'] != ''){
            echo "<span id='cart_count' class='text-warning bg-light'>". $_SESSION['numProduct'] ."</span>";
        }else{
            echo "<span id='cairt_count' class='text-warning bg-light'>0</span>";
        }
    ?> </a></li>
<?php
      
echo        "</ul> <!--end navbar-right -->";
        echo "<a class='dropdown-item' href='main.php'>หน้าหลัก</a>";
        echo "<a class='dropdown-item' href='index.php?module=user&action=show_profile'>จัดการข้อมูลส่วนตัว</a>";
        echo "<a class='dropdown-item' href='module/user/logout.php'>Logout</a>";
    echo "</div>";
}


?>