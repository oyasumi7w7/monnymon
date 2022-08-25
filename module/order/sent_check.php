<?php

if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']>2 ){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='main.php'</script>";
  }

?>
<?php
if(empty($_FILES['slip']['name'])){

    // echo "<script>alert('กรุณาใส่หลักฐานการชำระ')</script>";
    echo "<script>window.location='index.php?module=order&action=list_order&do=2'</script>" ;
    mysqli_close($con);
}else{
            $time=date("dmyis");
            $sum_name=$time."abcdefghijklmnopqrstuvwxyz";
            $char=substr(str_shuffle($sum_name),0,10);//ตัดเหลือ10,m_name,-m_lassname,m_
            $slip=$char."_".$_FILES['slip']['name'];//ชื่อไฟล์
            $temp_file=$_FILES['slip']['tmp_name'];
            copy($temp_file,"images/orders/$slip");
}

            $sql="UPDATE order_shop SET 
                pay_pic='$slip',
                order_paid_status='2'
                
            WHERE order_id='$_POST[or_id]' ";
            mysqli_query($con,$sql)or die("SQL Error==>".mysqli_error($con));
            mysqli_close($con);

?>
<!-- <script>alert('ส่งหลักฐานแล้ว โปรดรอการตรวจสอบ')</script> -->
<script>window.location='index.php?module=order&action=list_order&do=1'</script>