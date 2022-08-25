<?php
//1.ติดต่อฐานข้อมูลและเลือกฐานข้อมูลที่จะใช้
function connect_db2(){

// localhost Server CIS
// $con=mysqli_connect("localhost","cistrain_axelz","suwijak34308","cistrain_axelz"); //root=cistrain_pskp4

// localhost desktop
$con=mysqli_connect("localhost","root","","monnymon_shop");

//2.กำหนดชุดถอดรหัสตัวอีกษร (UTF-8)
mysqli_set_charset($con,"utf8");
return $con;
}
?>