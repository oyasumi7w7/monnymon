<meta charset="UTF-8">
<?php
session_start();

//unset($_SESSION['valid_user']); ยกเลิกค่าทีละ session
//unset($_SESSION['valid_type']);

session_destroy(); //ยกเลิก/reset session ทั้งหมด
// echo "<script>alert('ออกจากระบบเสร็จสิ้น')</script>";
echo "<script>window.location='../../main.php?do=1'</script>";
?>