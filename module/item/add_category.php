<?php

if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='index.php'</script>";
  }

?>
<?php
	$sql="INSERT INTO product_category (cate_name)
	VALUES
	('$_POST[category]')"; 
	
	mysqli_query($con,$sql)or die("SQL Error==>".mysqli_error($con));
	// echo "<script>alert('เพิ่มประเภทเรียบร้อย')</script>";
	echo "<script>window.location='index.php?module=item&action=manage_item&do=3'</script>" ;
	mysqli_close($con);
?>