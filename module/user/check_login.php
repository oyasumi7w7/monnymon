<meta charset="UTF-8">

<?php
session_start(); /*ออกเพราะมีใน index แล้ว*/
	include("../../include/connect_db.php");
	$con=connect_db();
	
	$log=mysqli_query($con,"SELECT m_id,m_pass,m_pic,m_name,m_lastname,m_type  FROM member WHERE m_id='$_POST[username]' AND m_pass='$_POST[password]' ")or die("SQL Error ==>".mysqli_error($con));
	list($user,$pass,$pic,$name,$lastname,$type)=mysqli_fetch_row($log);
	
	if(empty($name)){
		$name ='NewMember';
		$lastname = "New";

				if($user==$_POST['username'] and $pass==$_POST['password']){
					$_SESSION['valid_user']=$user; //กำหนดตัวแปรเป็นตัวแปร session เพื่อนำค่า/ตัวแปรไปใช้ในไฟล์อื่น
					$_SESSION['valid_name']=$name;
					$_SESSION['valid_lastname']=$lastname;
					$_SESSION['valid_type']=$type;
					$_SESSION['tour_id']=0;
					
							// echo "<script>alert('กรุณาเพิ่มข้อมูลส่วนตัว')</script>";
							echo "<script>window.location='../../index.php?module=user&action=show_profile&do=2'</script>";
							
				}
				else{
					$_SESSION['valid_user']="";
					// echo "<script>alert('ชื่อ หรือ รหัสผ่าน ไม่ถูกต้อง')</script>";
					echo "<script>window.location='../../login_shop.php?do=1'</script>";
				}

	}else{

				if($user==$_POST['username'] and $pass==$_POST['password']){
					$_SESSION['valid_user']=$user; //กำหนดตัวแปรเป็นตัวแปร session เพื่อนำค่า/ตัวแปรไปใช้ในไฟล์อื่น
					$_SESSION['valid_name']=$name;
					$_SESSION['valid_lastname']=$lastname;
					$_SESSION['valid_type']=$type;
					$_SESSION['tour_id']=0;
							echo "<script>window.location='../../main.php'</script>";
							
				}
				else{
					$_SESSION['valid_user']="";
					// echo "<script>alert('ชื่อ หรือ รหัสผ่าน ไม่ถูกต้อง')</script>";
					echo "<script>window.location='../../login_shop.php?do=1'</script>";
				}
	}
	

	
?>