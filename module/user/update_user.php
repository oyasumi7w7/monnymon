<?php
if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1 ){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='index.php'</script>";
  }

?>
<meta charset="utf-8">
<?php
	/*include("include/connect_db.php");
	$con=connect_db();*/
	$num=$_POST['num'];
	$f_id=$_POST['f_id'];
	$f_mail=$_POST['f_mail'];
	$chk_id=$_POST['id'];
    $chk_mail=$_POST['email'];

	$chkID=mysqli_query($con,"SELECT * FROM member WHERE m_id='$chk_id'");
	$chkEM=mysqli_query($con,"SELECT * FROM member WHERE m_mail='$chk_mail'");
	$rowsID=mysqli_num_rows($chkID); 
	$rowsEM=mysqli_num_rows($chkEM); 
	
    if($chk_id == $f_id && $chk_mail == $f_mail)
    {
		if(empty($_FILES['m_pic']['name'])){
			$m_pic="";
			$up_pic="";
		}else{
			$time=date("dmyis");
			$sum_name=$time."abcdefghijklmnopqrstuvwxyz";
			$char=substr(str_shuffle($sum_name),0,10);//ตัดเหลือ10
			$m_pic=$char."_".$_FILES['m_pic']['name'];//ชื่อไฟล์
			$temp_file=$_FILES['m_pic']['tmp_name'];
			copy($temp_file,"images/user_images/$m_pic");//copy ไฟล์ไปไว้ในโฟลเดอร์image
			$up_pic=",m_pic='$m_pic' ";
		}

		$sql="UPDATE member SET
					m_id='$_POST[id]',
					m_pass='$_POST[pass]',
					m_name='$_POST[name]',
					m_lastname='$_POST[lastname]',
					m_sex='$_POST[sex]',
					m_age='$_POST[age]',
					m_birth='$_POST[birth]',
					m_tel='$_POST[phone]',
					m_mail='$_POST[email]',
					m_contract1='$_POST[address]',
					m_contract2='$_POST[address2]',
					m_type='$_POST[type]' 
					$up_pic
					
					WHERE m_num='$num' " ;

					mysqli_query($con,$sql) or die("SQL Error==>".mysqli_error($con));
					
					//mysqli_query($con,$a)or die("SQL Error1==>".mysqli_error($con));
					// echo "<script>alert('อัพเดทเสร็จสิ้น')</script>";
					echo "<script>window.location='index.php?module=user&action=manage_user&do=3'</script>" ;
					mysqli_close($con);
	}
		

		elseif($chk_id != $f_id && $chk_mail == $f_mail){	

					if($rowsID>0){
						// echo "<script>alert('ID ซ้ำ ไม่สามารถแก้ไขผู้ใช้ได้' )</script>";		
						echo "<script>window.location='index.php?module=user&action=edit_user_form&id=$num&do=1'</script>" ;

					}else{

						if(empty($_FILES['m_pic']['name'])){
							$m_pic="";
							$up_pic="";
						}else{
							$time=date("dmyis");
							$sum_name=$time."abcdefghijklmnopqrstuvwxyz";
							$char=substr(str_shuffle($sum_name),0,10);//ตัดเหลือ10
							$m_pic=$char."_".$_FILES['m_pic']['name'];//ชื่อไฟล์
							$temp_file=$_FILES['m_pic']['tmp_name'];
							copy($temp_file,"images/user_images/$m_pic");//copy ไฟล์ไปไว้ในโฟลเดอร์image
							$up_pic=",m_pic='$m_pic' ";
						}
							$sql="UPDATE member SET
							m_id='$_POST[id]',
							m_pass='$_POST[pass]',
							m_name='$_POST[name]',
							m_lastname='$_POST[lastname]',
							m_sex='$_POST[sex]',
							m_age='$_POST[age]',
							m_birth='$_POST[birth]',
							m_tel='$_POST[phone]',
							m_mail='$_POST[email]',
							m_contract1='$_POST[address]',
							m_contract2='$_POST[address2]',
							m_type='$_POST[type]' 
							$up_pic
							
							WHERE m_num='$num' " ;

							mysqli_query($con,$sql) or die("SQL Error==>".mysqli_error($con));
							
							//mysqli_query($con,$a)or die("SQL Error1==>".mysqli_error($con));
							// echo "<script>alert('อัพเดทเสร็จสิ้น')</script>";
							echo "<script>window.location='index.php?module=user&action=manage_user&do=3'</script>" ;
							mysqli_close($con);
					}
		}
		elseif($chk_id == $f_id && $chk_mail != $f_mail){
						if($rowsEM>0){
							// echo "<script>alert('Email ซ้ำ ไม่สามารถแก้ไขผู้ใช้ได้' )</script>";		
							echo "<script>window.location='index.php?module=user&action=edit_user_form&id=$num&do=2'</script>" ;		
						}else{

						if(empty($_FILES['m_pic']['name'])){
							$m_pic="";
							$up_pic="";
						}else{
							$time=date("dmyis");
							$sum_name=$time."abcdefghijklmnopqrstuvwxyz";
							$char=substr(str_shuffle($sum_name),0,10);//ตัดเหลือ10
							$m_pic=$char."_".$_FILES['m_pic']['name'];//ชื่อไฟล์
							$temp_file=$_FILES['m_pic']['tmp_name'];
							copy($temp_file,"images/user_images/$m_pic");//copy ไฟล์ไปไว้ในโฟลเดอร์image
							$up_pic=",m_pic='$m_pic' ";
						}
								
							$sql="UPDATE member SET
							m_id='$_POST[id]',
							m_pass='$_POST[pass]',
							m_name='$_POST[name]',
							m_lastname='$_POST[lastname]',
							m_sex='$_POST[sex]',
							m_age='$_POST[age]',
							m_birth='$_POST[birth]',
							m_tel='$_POST[phone]',
							m_mail='$_POST[email]',
							m_contract1='$_POST[address]',
							m_contract2='$_POST[address2]',
							m_type='$_POST[type]' 
							$up_pic
							
							WHERE m_num='$num' " ;

							mysqli_query($con,$sql) or die("SQL Error==>".mysqli_error($con));
							
							//mysqli_query($con,$a)or die("SQL Error1==>".mysqli_error($con));
							// echo "<script>alert('อัพเดทเสร็จสิ้น')</script>";
							echo "<script>window.location='index.php?module=user&action=manage_user&do=3'</script>" ;
							mysqli_close($con);
				}

		}
		elseif($chk_id != $f_id && $chk_mail != $f_mail){
		
			if($rowsID>0){
				// echo "<script>alert('ID ซ้ำ ไม่สามารถแก้ไขผู้ใช้ได้' )</script>";		
				echo "<script>window.location='index.php?module=user&action=edit_user_form&id=$num&do=1'</script>" ;

			}
			elseif($rowsEM>0){
				// echo "<script>alert('Email ซ้ำ ไม่สามารถแก้ไขผู้ใช้ได้' )</script>";		
				echo "<script>window.location='index.php?module=user&action=edit_user_form&id=$num&do=2'</script>" ;		
			}else{
				if(empty($_FILES['m_pic']['name'])){
					$m_pic="";
					$up_pic="";
				}else{
					$time=date("dmyis");
					$sum_name=$time."abcdefghijklmnopqrstuvwxyz";
					$char=substr(str_shuffle($sum_name),0,10);//ตัดเหลือ10
					$m_pic=$char."_".$_FILES['m_pic']['name'];//ชื่อไฟล์
					$temp_file=$_FILES['m_pic']['tmp_name'];
					copy($temp_file,"images/user_images/$m_pic");//copy ไฟล์ไปไว้ในโฟลเดอร์image
					$up_pic=",m_pic='$m_pic' ";
				}
						
					$sql="UPDATE member SET
					m_id='$_POST[id]',
					m_pass='$_POST[pass]',
					m_name='$_POST[name]',
					m_lastname='$_POST[lastname]',
					m_sex='$_POST[sex]',
					m_age='$_POST[age]',
					m_birth='$_POST[birth]',
					m_tel='$_POST[phone]',
					m_mail='$_POST[email]',
					m_contract1='$_POST[address]',
					m_contract2='$_POST[address2]',
					m_type='$_POST[type]' 
					$up_pic
					
					WHERE m_num='$num' " ;

					mysqli_query($con,$sql) or die("SQL Error==>".mysqli_error($con));
					
					//mysqli_query($con,$a)or die("SQL Error1==>".mysqli_error($con));
					// echo "<script>alert('อัพเดทเสร็จสิ้น')</script>";
					echo "<script>window.location='index.php?module=user&action=manage_user&do=3'</script>" ;
					mysqli_close($con);
			}
		}
		
       /* elseif($rows2>1){
			echo "<script>alert('Email ซ้ำ ไม่สามารถแก้ไขผู้ใช้ได้' )</script>";		
			echo "<script>window.location='index.php?module=user&action=edit_user_form&id=$num'</script>" ;
		}*/	else{
		// echo "<script>alert('ID และ Email ซ้ำ ไม่สามารถแก้ไขผู้ใช้ได้' )</script>";		
        echo "<script>window.location='index.php?module=user&action=edit_user_form&id=$num&do=3'</script>" ;
		
			

		}
?>