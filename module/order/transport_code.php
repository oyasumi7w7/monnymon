<?php

if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1 ){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='main.php'</script>";
  }

?>
<?php

if(empty($_POST['code'])){
    // echo "<script>alert('กรุณาใส่รหัสขนส่ง')</script>";
    echo "<script>window.location='index.php?module=order&action=manage_order&do=6'</script>" ;
    mysqli_close($con);
}else{
  $date=DATE("Y-m-d");
// if($_POST['confirm']==1)
    $sql="UPDATE order_shop SET 
    order_track='$_POST[code]',
    order_product_status='3',
    order_sent='$date'
    WHERE order_id='$_POST[or_id]' ";
    mysqli_query($con,$sql)or die("SQL Error==>".mysqli_error($con));
    mysqli_close($con);
    // echo "<script>alert('ยืนยันการใส่รหัสขนส่ง')</script>";
    echo "<script>window.location='index.php?module=order&action=manage_order&do=5'</script>" ;
}
// else{
//     $sql="UPDATE order_shop SET 
//     pay_pic='',
//     order_paid_status='1'
//     WHERE order_id='$_POST[or_id]' ";
//     mysqli_query($con,$sql)or die("SQL Error==>".mysqli_error($con));
//     mysqli_close($con);
//     echo "<script>alert('ยืนยันหลักฐานไม่ถูกต้อง')</script>";
//     echo "<script>window.location='index.php?module=order&action=manage_order'</script>" ;
// }

?>
