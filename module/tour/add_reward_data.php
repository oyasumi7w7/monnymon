<?php

if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='index.php'</script>";
  }

?>

<?php
	if(!empty($_FILES['p_pic']['name'])){
		$temp_file=$_FILES['p_pic']['tmp_name'];
		$p_pic=date("shiYmd")."_".$_FILES['p_pic']['name'];//ชื่อไฟล์
		copy($temp_file,"images/reward/$p_pic");//copy ไฟล์ไปไว้ในโฟลเดอร์image
	}else{
		$p_pic="";
	}
	$sql="INSERT INTO reward (reward_name,reward_num,reward_tour,reward_pic)
	VALUES
	('$_POST[name]'
	,'$_POST[num]'
	,'$_POST[tour]'
    ,'$p_pic')"; 
	
	
	mysqli_query($con,$sql)or die("SQL Error==>".mysqli_error($con));
	// echo "<script>alert('เพิ่มของรางวัลเรียบร้อย')</script>";
	echo "<script>window.location='index.php?module=tour&action=reward&do=1'</script>" ;
	mysqli_close($con);
?>