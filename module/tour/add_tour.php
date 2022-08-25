<?php

if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1 ){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='index.php'</script>";
  }

?>
<meta charset="utf-8">
<?php
    $time=date('Y-m-d');
            mysqli_query($con,"INSERT INTO tournament(tour_name,tour_max,tour_regis,tour_endregis,tour_start) VALUES
            ('$_POST[name]',
            '$_POST[max]',
            '$time',
            '$_POST[endregis]',
            '$_POST[start_tour]')") or die("SQL Error==>".mysqli_error($con));

                // echo "<script>alert('เพิ่มรายการแข่งเสร็จเรียบร้อย')</script>";
                echo "<script>window.location='index.php?module=tour&action=list_tour&do=1'</script>" ;
                mysqli_close($con);

    ?>