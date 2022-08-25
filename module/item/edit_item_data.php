<?php

if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='index.php'</script>";
  }

?>
<meta charset="utf-8">
<?php
	/*include("include/connect_db.php");
	$con=connect_db(); */
	$id=$_POST['id'];
	if(empty($_FILES['p_pic']['name'])){
		$p_pic="";
		$up_pic="";
	}else{
		$time=date("dmyis");
		$sum_name=$time."abcdefghijklmnopqrstuvwxyz";
		$char=substr(str_shuffle($sum_name),0,10);//ตัดเหลือ10
		$p_pic=$char."_".$_FILES['p_pic']['name'];//ชื่อไฟล์
		$temp_file=$_FILES['p_pic']['tmp_name'];
		copy($temp_file,"images/products_images/$p_pic");//copy ไฟล์ไปไว้ในโฟลเดอร์image
		$up_pic=",product_pic='$p_pic' ";
	}
	
	$sql="UPDATE product SET 
	product_name='$_POST[name]',
	product_category='$_POST[cate]',
	product_detail='$_POST[detail]',
	product_price='$_POST[price]',
	product_sprice='$_POST[sprice]'
	$up_pic
	
	 WHERE product_id='$id' ";
	
	
	mysqli_query($con,$sql)or die("SQL Error==>".mysqli_error($con));
	// echo "<script>alert('อัพเดทเสร็จสิ้น')</script>";
	echo "<script>window.location='index.php?module=item&action=manage_item&do=2'</script>" ;
	mysqli_close($con);
	
	?>