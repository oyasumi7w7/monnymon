<?php

if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='index.php'</script>";
  }

?>
<?php

    if(!empty($_FILES['pic']['name'])){
        $temp_file=$_FILES['pic']['tmp_name'];
        $pic=date("shiYmd")."_".$_FILES['pic']['name'];//ชื่อไฟล์
        copy($temp_file,"images/slide/$pic");//copy ไฟล์ไปไว้ในโฟลเดอร์image
    }else{
        $pic="";
    }


	$sql="INSERT INTO slide_show (slide_name,slide_pic)
	VALUES
	('$_POST[name]','$pic')"; 
	
	mysqli_query($con,$sql)or die("SQL Error==>".mysqli_error($con));
	// echo "<script>alert('เพิ่ม slide แล้ว')</script>";
	echo "<script>window.location='index.php?module=slide&action=manage_slide&do=1'</script>" ;
	mysqli_close($con);
?>