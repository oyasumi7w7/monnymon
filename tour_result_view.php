
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

  </style>
  <body>
  
  <div class="site-wrap">
  <?php require_once ("include/header.php"); ?>
  <div class="bg-light py-3">
      <div class="container">
        <div class="row">
        <div class="col-md-12 mb-0"><a href="main.php">Home</a> <span class="mx-2 mb-0">/</span> <a href="idle_tour.php">Tournament</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Schedule - Results</strong></div>
        </div>
      </div>
    </div>


    <div class='site-section'>
      <div class='container'>
        <div class='row'>
          <div class='col-md-12 text-center'>
        <form method="post" action='tour_result_view.php' >
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
	
  ?>
  
<a target="_blank" href="rule.php" > <button type="button" class="btn btn-primary" >
  วิธีการเล่น Cardfight Vanguard
</button></a>
<br><br>



  <?php
	
	echo "<p> หน้า : ";
	for($i=1;$i<=$pages;$i++){ //วนลูปตามจำนวนหน้า
		if($i==$pid){ //ถ้าตรงกับหน้าปัจจุบัน
		echo "<span style='color:red;font-weight:bold;'> [ $i ] </span>";		
		}
		else
		{
	echo"<a href='tour_result_view.php?pid=$i'>[ $i ]</a>"; //สร้าง link หมายเลขหน้า
		}
	}
	echo "</p><br>";
	
?>	
		<div class="table-responsive table--no-card m-b-30">
			<table class="table table-borderless table-striped table-earning" >
				<thead>
			<?php
	echo"<tr style='color:#00008B; font-size:20px; '><th>รหัส</th><th>ชื่อรายการ</th><th>จำนวนผู้สมัคร</th><th>สถานะ</th><th></th></tr>";
?>	
				</thead>
	<tbody>
	<?php
	while(list($t_no,$t_name,$t_max,$t_regis,$t_endregis)=mysqli_fetch_row($result)){
?>
    <tr style="color:black">
    <?php
	//echo $data [0],"-"; //การ eco array ต้องมี index
	echo "<td>$t_no</td>"; 
	//echo "<td><a href='product_detail.php?id=$product_id'>$product_title</a></td>"; //แบบ GET ไม่มี $ข้างหน้า
   echo "<td>$t_name</td>";
 
   $chk3=0;
   $chkc3=mysqli_query($con,"SELECT match1 FROM tour_player WHERE tour_no ='$t_no'")or die("Sql Error>>".mysqli_error($con));
   while(list($row3)=mysqli_fetch_row($chkc3)){
      
      if(empty($row3)){
        $chk3++;
      }
  }
  $result2=mysqli_query($con,"SELECT player_id FROM tour_player WHERE tour_no ='$t_no'")or die("Sql Error>>".mysqli_error($con));
  $rows2=mysqli_num_rows($result2);
	echo "<td>$rows2/$t_max คน</td>";
    
    $chkfinal=mysqli_query($con,"SELECT winner FROM single_tour WHERE t_id ='$t_no' AND round_id='1'")or die("Sql Error>>".mysqli_error($con));
    list($chkF)=mysqli_fetch_row($chkfinal);
    $chk=mysqli_query($con,"SELECT t_id FROM single_tour WHERE t_id ='$t_no'")or die("Sql Error>>".mysqli_error($con));
    $rows4=mysqli_num_rows($chk);

    if(empty($chkF)){
        if($rows4>0){
            echo "<td style='color: blue;'><b>กำลังแข่งขันรอบตัดเชือก</b></td>";
        }else{
            if(date('Y-m-d')<=$t_endregis){
                  if($rows2==$t_max){
                    echo "<td style='color: #2F4F4F;'><b>ยังไม่มีการจับคู่การแข่ง</b></td>"; 
                  }else{
                    echo "<td style='color: green;'><b>อยู่ระหว่างการลงทะเบียน</b></td>";
                  }
                
               } elseif($chk3>0 ){
              echo "<td style='color: #2F4F4F;'><b>ยังไม่มีการจับคู่การแข่ง</b></td>"; 
               
            }else{
                echo "<td style='color: #FF8C00;'><b>กำลังแข่งขันเก็บคะแนน</b></td>";
            }
        }
        
    }else{
        echo "<td style='color: red;'><b>จบการแข่งขัน</b></td>";
    }
    // if(date('Y-m-d')>$t_endregis)	{
    //   echo "<td>หมดเขต</td>";
    //   }elseif($rows2 >= $t_max  ){
    //     echo "<td>หมดเขต</td>";
    //   }else{
    //     echo "<td>หมดเขต</td>";
    //   }
    if(date('Y-m-d')<=$t_endregis){
        if($rows2==$t_max){
          echo "<td><a href='show_result.php?tid=$t_no'><button type='button' class='btn btn-danger btn-ra' ><i'>ตรวจสอบ</i></button></a></td>";
        }else{
          echo "<td><a href='tour_listplayer.php?tid=$t_no'><button type='button' class='btn btn-success btn-ra' ><i'>ไปลงทะเบียน</i></button></a></td>";
        }
      
    } else{
      echo "<td><a href='show_result.php?tid=$t_no'><button type='button' class='btn btn-danger btn-ra' ><i'>ตรวจสอบ</i></button></a></td>";
     
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
                                      echo"<a href='tour_result_view.php?pid=$i'>[ $i ]</a>"; //สร้าง link หมายเลขหน้า
                                    }
                              }
                          echo "</p><br>";
                  
                  ?>
        </div>
      </div>
    </div>
    </div>

    <?php require_once ("include/footer.php"); 
    
   ?>
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
