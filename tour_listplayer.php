<?php
session_start();

include("include/connect_db.php");
$con=connect_db();
$tid=$_GET['tid'];

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
  
  <body>
  
      <div class="site-wrap">
      <?php require_once ("include/header.php"); ?>
      <?php
if(empty($_GET['do'])){
  $do="";
}else{
    $do=$_GET['do'];
}

if($do==1){
 echo '<script type="text/javascript">
       swal("", "ลงทะเบียนเรียบร้อย", "success");
       </script>';
}
  ?>
       <?php
      $tour=mysqli_query($con,"SELECT tour_name FROM tournament WHERE tour_no='$tid' ")or die("Sql Error1>>".mysqli_error($con));
		list($t_name)=mysqli_fetch_row($tour);
?>
    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
        <div class="col-md-12 mb-0"><a href="main.php">Home</a> <span class="mx-2 mb-0">/</span> <a href="idle_tour.php">Tournament</a> <span class="mx-2 mb-0">/</span> <a href="tour_view.php">Register</a> <span class="mx-2 mb-0">/</span> <strong class="text-black"><?php echo $t_name; ?></strong></div>
        </div>
      </div>
    </div>

    <div class='site-section'>
      <div class='container'>
        <div class='row'>
          <div class='col-md-12 text-center'>

<?php

	//select ข้อมูลโดยกำหนดเงื่อนไขให้ตรงกับคำค้น
	$result=mysqli_query($con,"SELECT player_id FROM tour_player WHERE tour_no = $tid ")or die("SQL Error1==>".mysqli_error($con));
	
	$rows=mysqli_num_rows($result); //ใช้นับจำนวนแถวที่คิวรี่หรือซีเลคออกมาได้ พารามิเตอร์ 1 ตัวคือ ชื่อตัวแปรที่ใช้คิวรี่ รีเทิร์นค่าออกมาเป็นจำนวนแถวที่นับได้เป็นจำนวนเต็ม
  $result2=mysqli_query($con,"SELECT tour_max,tour_endregis FROM tournament WHERE tour_no ='$tid'")or die("Sql Error>>".mysqli_error($con));
  while(list($t_max,$t_end)=mysqli_fetch_row($result2)){
  if($rows==0){ //ถ้าคำค้นไม่ตรงกับสินค้าใดๆ
    echo "<a style='font-size:30px; color:#A52A2A; border-bottom:double 10px;'>$t_name</a><br><br><br><br>";
    echo "<p style='color:black'>ยังไม่มีผู้สมัคร</p>";

	}
	else{
		echo "<a style='font-size:30px; color:#A52A2A; border-bottom:double 10px;'>$t_name</a><br><br>";
    
	
	$result=mysqli_query($con,"SELECT player_id,player_name,player_lastname,day_regis FROM tour_player WHERE tour_no = $tid ")or die("Sql Error>>".mysqli_error($con));
?>	
	<p style="color:red; font-size:20px; ">***ค่าลงทะเบียน 100 บาท โปรดเตรียมไปจ่ายในวันแข่ง***</p>
  <br>
  


		<div class="table-responsive table--no-card m-b-30">
			<table class="table table-borderless table-striped table-earning">
				<thead>
			<?php

	echo"<tr style='color:#00008B; font-size:20px; '><th>รหัส</th><th>ชื่อผู้สมัคร</th><th>วันที่ลงทะเบียน</th></tr>";
?>	
				</thead>
	<tbody>
	<?php
	while(list($p_id,$p_name,$p_lastname,$p_regis)=mysqli_fetch_row($result)){
?>
<tr style='color:black; '>

<?php
	//echo $data [0],"-"; //การ eco array ต้องมี index
	echo "<td>$p_id</td>"; 
	//echo "<td><a href='product_detail.php?id=$product_id'>$product_title</a></td>"; //แบบ GET ไม่มี $ข้างหน้า
  echo "<td>$p_name  $p_lastname</td>";
  echo "<td>$p_regis</td>";

    
?>	
<?php
	
	echo "</tr>";
	}
  echo "</table>";

} //ปิดเงื่อนไข else ไม่ให้เห็นหัวตาราง (บรรทัด 43)
  }
  $result2=mysqli_query($con,"SELECT tour_max,tour_endregis FROM tournament WHERE tour_no ='$tid'")or die("Sql Error>>".mysqli_error($con));
  while(list($t_max,$t_end)=mysqli_fetch_row($result2)){

      if($rows >= $t_max || date('Y-m-d')>$t_end){
  
      }else{
          if(empty($_SESSION['valid_user'])){
          
          }else{
              $rs=mysqli_query($con,"SELECT m_num FROM member WHERE m_id='$_SESSION[valid_user]' ")or die("Sql Error1>>".mysqli_error($con));
              list($pid)=mysqli_fetch_row($rs);
          
              $rs=mysqli_query($con,"SELECT player_id FROM tour_player WHERE player_id ='$pid' AND tour_no ='$tid' ")or die("Sql Error1>>".mysqli_error($con));
              $chk_id=mysqli_num_rows($rs);
              if($chk_id>0){
        
              }else{

                echo "<a href='tour_regis.php?tid=$tid&&pid=$_SESSION[valid_user]' onclick='return confirm_regis()'><button type='button' class='btn btn-success btn-ra' ><i>สมัครลงแข่ง</i>&nbsp;</button></a>";
                                                                                        
              }
          }
      }
  }

  ?>
<p style="color:green; font-size:30px;">รายการของรางวัล</p>
 
 <table class="table" align="center">
   <thead>
   <tr class="table-secondary" style="color:blue; font-size:20px; "><th>ของรางวัล</th><th>จำนวน</th></tr>
   </thead>
<tbody>
<?php
$reward=mysqli_query($con,"SELECT * FROM reward WHERE reward_tour = $tid ")or die("Sql Error>>".mysqli_error($con));
while(list($r_id,$r_name,$r_num,$r_tour,$r_date,$r_pic)=mysqli_fetch_row($reward)){
?>
<tr  style='color:white; ' class="bg-success">
<td ><?php echo $r_name ?></td>
<td ><?php echo $r_num ?></td>
</tr>
<?php
}
?>
</tbody>
</table>

  <?php
 mysqli_close($con);
 	?>
 	</tbody>
            </table>
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
  <script src="js/slideshow.js"></script>
  <script src="js/main2.js"></script>
    <script>
  function confirm_regis() {
    if (confirm("ยืนยันการลงทะเบียนหรือไม่")) {
       // do stuff
    } else {
      return false;
    }
}
    </script>
  </body>
</html>