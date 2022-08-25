<?php

if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1 ){
	echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='index.php'</script>";
  }

?>
<meta charset="utf-8">
<?php
    $time=date('Y-m-d');
            mysqli_query($con,"INSERT INTO tour_player(tour_no,player_id,player_name,player_lastname,day_regis) VALUES
            ('$_SESSION[tour_id]',
            '$_POST[p_id]',
            '$_POST[p_name]',
            '$_POST[p_lastname]',
            '$time')") or die("SQL Error==>".mysqli_error($con));

                // echo "<script>alert('ลงทะเบียนออฟไลน์เสร็จสิ้น')</script>";
                echo "<script>window.location='index.php?module=tour&action=match&tid=$_SESSION[tour_id]&page=idle&do=1'</script>" ;
                mysqli_close($con);


?>