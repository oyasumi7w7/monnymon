<?php

if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='index.php'</script>";
  }

?>
<?php

	$del_id=$_POST['del_id']; //รับค่ารหัสสินค้าที่จะลบ,เป็น array
	
	/*include("include/connect_db.php");
	$con=connect_db();*/
	foreach($del_id as $id){ //วนลูปเอารหัสสินค้าที่ส่งมาจาก checkbox ออกมาเพื่อเป็นเงื่อนไขในการลบ
	
	mysqli_query($con,"DELETE FROM card_list 
	WHERE card_id='$id' ")or die("SQL Error1==>".mysqli_error($con)); //ลบข้อมูลใน db
	}
	mysqli_close($con);

?>
<script>alert('ลบการ์ดเสร็จสิ้น')</script>
<script>window.location='index.php?module=card&action=manage_card'</script>