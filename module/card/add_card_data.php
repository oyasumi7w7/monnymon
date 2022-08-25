<?php

if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1){
		echo "<script>alert('สิทธิ์ไม่ถูกต้อง')</script>";
    echo "<script>window.location='index.php'</script>";
  }
?>
<?php
	/*include("include/connect_db.php");
	$con=connect_db(); //เรียกฟังค์ชั่นติดต่อฐานข้อมูล*/
	if(!empty($_FILES['p_pic']['name'])){
		$temp_file=$_FILES['p_pic']['tmp_name'];
		$p_pic=date("shiYmd")."_".$_FILES['p_pic']['name'];//ชื่อไฟล์
		copy($temp_file,"images/card_pic/$p_pic");//copy ไฟล์ไปไว้ในโฟลเดอร์image
	}else{
		$p_pic="";
	}
	$sql="INSERT INTO card_list (card_id,card_name,card_jp_name,card_th_name,Grade,Skill,Imaginary_Gift,atk,Critical,Nation,Clan,card_race,card_type,Card_Flavor,Card_Effect,card_pic)
	VALUES 
	('$_POST[c_id]'
	,'$_POST[name]'
	,'$_POST[jpname]'
	,'$_POST[thname]'
	,'$_POST[grade]'
	,'$_POST[skill]'
	,'$_POST[gift]'
	,'$_POST[atk]'
	,'$_POST[critical]'
	,'$_POST[nation]'
	,'$_POST[clan]'
	,'$_POST[race]'
	,'$_POST[cate]'
	,'$_POST[favor]'
	,'$_POST[detail]'
	,'$p_pic')" ;

	mysqli_query($con,$sql)or die("SQL Error==>".mysqli_error($con));
	// echo "<script>alert('เพิ่มการ์ดเรียบร้อย')</script>";
	echo "<script>window.location='index.php?module=card&action=manage_card&do=1'</script>" ;
	mysqli_close($con);

?>