<?php

if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='index.php'</script>";
  }

?>
<?php
	/*include("include/connect_db.php");
	$con=connect_db();*/
	mysqli_query($con,"DELETE FROM product
	WHERE product_id='$_GET[id]' ")or die("SQL Error1==>".mysqli_error($con));

	
	mysqli_close($con);

?>
<script>alert('ลบสินค้าเสร็จสิ้น')</script>
<script>window.location='index.php?module=item&action=manage_item'</script>