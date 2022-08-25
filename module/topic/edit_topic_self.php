<?php

if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']>2 ){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='main.php'</script>";
  }

?>
<?php


        if(!empty($_FILES['top_pic']['name'])){
            $time=date("dmyis");
            $sum_name=$time."abcdefghijklmnopqrstuvwxyz";
            $char=substr(str_shuffle($sum_name),0,10);//ตัดเหลือ10,m_name,-m_lassname,m_
            $m_pic=$char."_".$_FILES['top_pic']['name'];//ชื่อไฟล์
            $temp_file=$_FILES['top_pic']['tmp_name'];
            copy($temp_file,"images/topic/$m_pic");//copy ไฟล์ไปไว้ในโฟลเดอร์image

        }else{
            $chk_pic=mysqli_query($con,"SELECT topic_pic FROM topics WHERE topic_id ='$_POST[top_id]'
            ")or die("Sql Error>>".mysqli_error($con)); 
            
            list($t_pic)=mysqli_fetch_row($chk_pic);
            $m_pic="$t_pic";
        }


        $sql="UPDATE topics SET 
        topic_head='$_POST[top_head]',
        topic_text='$_POST[top_text]',
        topic_pic='$m_pic'
        
         WHERE topic_id='$_POST[top_id]' ";
        
        
        mysqli_query($con,$sql)or die("SQL Error==>".mysqli_error($con));


	
	mysqli_close($con);

?>
<!-- <script>alert('แก้ไขกระทู้เสร็จสิ้น')</script> -->
<script>window.location='index.php?module=topic&action=manage_topic_self&do=1'</script>