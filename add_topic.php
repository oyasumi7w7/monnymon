<meta charset="UTF-8">
<?php
session_start(); 
	include("include/connect_db.php");
	$con=connect_db();
	if(!empty($_FILES['pic']['name'])){
		$time=date("dmyis");
		$sum_name=$time."abcdefghijklmnopqrstuvwxyz";
		$char=substr(str_shuffle($sum_name),0,10);//ตัดเหลือ10,m_name,-m_lassname,m_
		$m_pic=$char."_".$_FILES['pic']['name'];//ชื่อไฟล์
		$temp_file=$_FILES['pic']['tmp_name'];
		copy($temp_file,"images/topic/$m_pic");//copy ไฟล์ไปไว้ในโฟลเดอร์image
	}else{
		$m_pic="";
	}
	mysqli_query($con,"INSERT INTO topics(topic_head,topic_text,topic_pic,topic_member,topic_type) 
	VALUES('$_POST[head]','$_POST[text]','$m_pic','$_SESSION[valid_user]','0')") or die("SQL Error1==>".mysqli_error($con));

	mysqli_close($con);
	echo "<script>window.location='webboard.php'</script>" ;
?>