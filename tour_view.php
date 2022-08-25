<?php
session_start();

include("include/connect_db.php");
$con=connect_db();

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
  
  <body>
  
      <div class="site-wrap">
      <?php require_once ("include/header.php"); ?>
       

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
        <div class="col-md-12 mb-0"><a href="main.php">Home</a> <span class="mx-2 mb-0">/</span> <a href="idle_tour.php">Tournament</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Register</strong></div>
          
        </div>
      </div>
    </div>

    <div class='site-section'>
      <div class='container'>
        <div class='row'>
          <div class='col-md-12 text-center'>
            <form method="post" action='tour_view.php' >
              <p align="center"><input type="text" name="search">&nbsp;<input type="submit" value="ค้นหา"></p>
            </form>

<?php
	/*include("include/connect_db.php");
	$con = connect_db();*/
	if(empty($_POST['search'])){ //ถ้ามีการส่งค่าตัวแปร get_search มาจากช่องค้นหา
		$search="";
		 //นำค่ามาเก็บไว้ในตัวแปรแล้วค่อยนำไปใช้
	}
	else{
		$search=$_POST['search'];
	}
	//select ข้อมูลโดยกำหนดเงื่อนไขให้ตรงกับคำค้น
	$result=mysqli_query($con,"SELECT tour_name FROM tournament WHERE tour_name LIKE '%$search%'")or die("SQL Error1==>".mysqli_error($con));
	
	$rows=mysqli_num_rows($result); //ใช้นับจำนวนแถวที่คิวรี่หรือซีเลคออกมาได้ พารามิเตอร์ 1 ตัวคือ ชื่อตัวแปรที่ใช้คิวรี่ รีเทิร์นค่าออกมาเป็นจำนวนแถวที่นับได้เป็นจำนวนเต็ม
	$rows_page=20; //จำนวนแถวที่ต้องการให้แสดงใน 1 หน้า
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
		echo "<p>ไม่พบรายการแข่งที่ตรงกับคำค้น</p>";
	}
	else{
		echo "<p style='color:#00008B; font-size:20px; '>จำนวนรายการแข่งทั้งหมดที่ตรงกับคำค้น $rows รายการ</p>";
	
	$result=mysqli_query($con,"SELECT tour_no,tour_name,tour_max,tour_regis,tour_endregis FROM tournament WHERE tour_name LIKE '%$search%' ORDER BY tour_no DESC LIMIT $start_rows,$rows_page ")or die("Sql Error>>".mysqli_error($con));
	
	
	echo "<p> หน้า : ";
	for($i=1;$i<=$pages;$i++){ //วนลูปตามจำนวนหน้า
		if($i==$pid){ //ถ้าตรงกับหน้าปัจจุบัน
		echo "<span style='color:red;font-weight:bold;'> [ $i ] </span>";		
		}
		else
		{
	echo"<a href='tour_view.php?pid=$i'>[ $i ]</a>"; //สร้าง link หมายเลขหน้า
		}
	}
	echo "</p><br>";
	
?>	
	<p style="color:red; font-size:20px; ">***ค่าลงทะเบียน 100 บาท โปรดเตรียมไปจ่ายในวันแข่ง***</p>
		<div class="table-responsive table--no-card m-b-30">
			<table class="table table-borderless table-striped table-earning">
				<thead>
			<?php
	echo"<tr style='color:#00008B; font-size:20px; '><th>รหัส</th><th>ชื่อรายการ</th><th>จำนวนผู้สมัคร</th><th>ปิดรับสมัคร</th><th>สถานะ</th><th>ลงชื่อแข่ง</th></tr>";
?>	
				</thead>
	<tbody>
	<?php
	while(list($t_no,$t_name,$t_max,$t_regis,$t_endregis)=mysqli_fetch_row($result)){
?>
<tr style='color:black; '>
<?php
	//echo $data [0],"-"; //การ eco array ต้องมี index
	echo "<td>$t_no</td>"; 
	//echo "<td><a href='product_detail.php?id=$product_id'>$product_title</a></td>"; //แบบ GET ไม่มี $ข้างหน้า
  echo "<td>$t_name</td>";
  $result2=mysqli_query($con,"SELECT player_id FROM tour_player WHERE tour_no ='$t_no'")or die("Sql Error>>".mysqli_error($con));
  $rows2=mysqli_num_rows($result2);
	
    echo "<td>$rows2/$t_max คน</td>";
    echo "<td>$t_endregis</td>";
    if(date('Y-m-d')>$t_endregis)	{
    echo "<td style='color:red; '>หมดเขตลงทะเบียน</td>";
    }else{
      echo "<td style='color:green;'>พร้อมลงทะเบียน</td>";
    }
    if(date('Y-m-d')>$t_endregis)	{
      echo "<td><a href='tour_listplayer.php?tid=$t_no'><button type='button' class='btn btn-danger' ><i>หมดเขต</i>&nbsp;</button></a></td>";
      }elseif($rows2 >= $t_max  ){
        echo "<td><a href='tour_listplayer.php?tid=$t_no'><button type='button' class='btn btn-danger' ><i>เต็ม</i>&nbsp;</button></a></td>";
      }else{
        echo "<td><a href='tour_listplayer.php?tid=$t_no'><button type='button' class='btn btn-success btn-ra' ><i'>สมัคร</i>&nbsp;</button></a></td>";
      }
?>	
<?php
	
	echo "</tr>";
	}
	echo "</table>";
	

} //ปิดเงื่อนไข else ไม่ให้เห็นหัวตาราง (บรรทัด 43)
 mysqli_close($con);
 	?>
 	</tbody>
            </table>
        </div>
                      <?php
                          echo "<p> หน้า : ";
                              for($i=1;$i<=$pages;$i++){ //วนลูปตามจำนวนหน้า
                                    if($i==$pid){ //ถ้าตรงกับหน้าปัจจุบัน
                                      echo "<span style='color:red;font-weight:bold;'> [ $i ] </span>";		
                                      }
                                      else
                                      {
                                      echo"<a href='tour_view.php?pid=$i'>[ $i ]</a>"; //สร้าง link หมายเลขหน้า
                                    }
                              }
                          echo "</p><br>";
                  
                  ?>
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
  <script src="js/slideshow.js"></script>
  <script src="js/main2.js"></script>
    
  </body>
</html>