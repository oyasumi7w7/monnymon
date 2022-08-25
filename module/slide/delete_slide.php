<?php

if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='index.php'</script>";
  }

?>
<?php
	/*include("include/connect_db.php");
	$con=connect_db();*/
	mysqli_query($con,"DELETE FROM slide_show
	WHERE slide_id='$_GET[id]' ")or die("SQL Error1==>".mysqli_error($con));

	
	mysqli_close($con);

?>
<!-- <script>alert('ลบ Slide Show เรียบร้อย ')</script> -->
<script>window.location='index.php?module=slide&action=manage_slide&do=3'</script>