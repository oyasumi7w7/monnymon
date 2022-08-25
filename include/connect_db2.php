<?php
//1.ติดต่อฐานข้อมูลและเลือกฐานข้อมูลที่จะใช้
function connect_db2(){


//2.กำหนดชุดถอดรหัสตัวอีกษร (UTF-8)
mysqli_set_charset($con,"utf8");
return $con;
}
?>
