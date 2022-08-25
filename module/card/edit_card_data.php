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
	$id=$_POST['old_id'];
	if(empty($_FILES['c_pic']['name'])){
		$p_pic="";
		$up_pic="";
	}else{
		$time=date("dmyis");
		$sum_name=$time."abcdefghijklmnopqrstuvwxyz";
		$char=substr(str_shuffle($sum_name),0,10);//ตัดเหลือ10
		$p_pic=$char."_".$_FILES['c_pic']['name'];//ชื่อไฟล์
		$temp_file=$_FILES['c_pic']['tmp_name'];
		copy($temp_file,"images/card_pic/$p_pic");//copy ไฟล์ไปไว้ในโฟลเดอร์image
		$up_pic=",card_pic='$p_pic' ";
	}
	
	$sql="UPDATE card_list  SET 
	card_id='$_POST[c_id]',
	card_name='$_POST[name]',
	card_jp_name='$_POST[jpname]',
	card_th_name='$_POST[thname]',
	Grade='$_POST[grade]',
	Skill='$_POST[skill]',
	Imaginary_Gift='$_POST[gift]',
	atk='$_POST[atk]',
	Critical='$_POST[critical]',
	Nation='$_POST[nation]',
	Clan='$_POST[clan]',
	card_race='$_POST[race]',
	card_type='$_POST[cate]',
	Card_Flavor='$_POST[favor]',
	Card_Effect='$_POST[detail]'
	$up_pic
	
	 WHERE card_id='$id' ";
	
	
	mysqli_query($con,$sql)or die("SQL Error==>".mysqli_error($con));
	// echo "<script>alert('อัพเดทเสร็จสิ้น')</script>";
	echo "<script>window.location='index.php?module=card&action=manage_card&do=2'</script>" ;
	mysqli_close($con);
	
	?>