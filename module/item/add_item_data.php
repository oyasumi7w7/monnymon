<?php

if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='index.php'</script>";
  }

?>
<?php
	/*include("include/connect_db.php");
	$con=connect_db(); //เรียกฟังค์ชั่นติดต่อฐานข้อมูล*/
	if(!empty($_FILES['p_pic']['name'])){
		$temp_file=$_FILES['p_pic']['tmp_name'];
		$p_pic=date("shiYmd")."_".$_FILES['p_pic']['name'];//ชื่อไฟล์
		copy($temp_file,"images/products_images/$p_pic");//copy ไฟล์ไปไว้ในโฟลเดอร์image
	}else{
		$p_pic="";
	}
	$sql="INSERT INTO product (product_name,product_category,product_detail,product_price,product_sprice,product_num,product_pic)
	VALUES
	('$_POST[name]'
	,'$_POST[cate]'
	,'$_POST[detail]'
	,'$_POST[price]'
	,'$_POST[sprice]'
	,'$p_pic')"; 
	
	mysqli_query($con,$sql)or die("SQL Error==>".mysqli_error($con));
	// echo "<script>alert('เพิ่มสินค้าใหม่เรียบร้อย')</script>";
	echo "<script>window.location='index.php?module=item&action=manage_item&do=1'</script>" ;
	mysqli_close($con);
?>