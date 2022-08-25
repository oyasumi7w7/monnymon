<?php

if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1 ){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='index.php'</script>";
  }


?>
<meta charset="utf-8">
<?php
$sql="UPDATE tournament SET 
tour_name='$_POST[name]',
tour_max='$_POST[max]',
tour_endregis='$_POST[endregis]',
tour_start='$_POST[start_tour]'

 WHERE tour_no='$_POST[tid]' ";

    mysqli_query($con,$sql)or die("SQL Error==>".mysqli_error($con));
    // echo "<script>alert('แก้ไขรายการแข่งเสร็จเรียบร้อย')</script>";
    echo "<script>window.location='index.php?module=tour&action=list_tour&do=2'</script>" ;
    mysqli_close($con);
?>