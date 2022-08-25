<?php

if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1 ){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='index.php'</script>";
  }

?>
<meta charset="utf-8">
<?php
	/*include("include/connect_db.php");
    $con=connect_db();*/
    $chk_id=$_POST['id'];
    $chk_mail=$_POST['email'];

    $chk=mysqli_query($con,"SELECT * FROM member WHERE m_id='$chk_id' OR m_mail='$chk_mail'");
    $rows=mysqli_num_rows($chk); 
    if($rows>0)
    {
        // echo "<script>alert('ID หรือ Email ซ้ำ ไม่สามารถแก้ไขผู้ใช้ได้')</script>";
        echo "<script>window.location='index.php?module=user&action=add_user_form&do=1'</script>" ;
    }
        else{
            if(!empty($_FILES['m_pic']['name'])){
                $time=date("dmyis");
                $sum_name=$time."abcdefghijklmnopqrstuvwxyz";
                $char=substr(str_shuffle($sum_name),0,10);//ตัดเหลือ10,m_name,-m_lassname,m_
                $m_pic=$char."_".$_FILES['m_pic']['name'];//ชื่อไฟล์
                $temp_file=$_FILES['m_pic']['tmp_name'];
                copy($temp_file,"images/user_images/$m_pic");//copy ไฟล์ไปไว้ในโฟลเดอร์image
            }else{
                $m_pic="";
            }
            
            mysqli_query($con,"INSERT INTO member(m_id,m_pass,m_pic,m_name,m_lastname,m_sex,m_age,m_birth,m_tel,m_mail,m_contract1,m_contract2,m_type) VALUES
            ('$_POST[id]',
            '$_POST[pass]',
            '$m_pic',
            '$_POST[name]',
            '$_POST[lastname]',
            '$_POST[sex]',
            '$_POST[age]',
            '$_POST[birth]',
            '$_POST[phone]',
            '$_POST[email]',
            '$_POST[address]',
            '$_POST[address2]',
            '$_POST[type]')") or die("SQL Error==>".mysqli_error($con));

                // echo "<script>alert('เพิ่มผู้ใช้เสร็จเรียบร้อย')</script>";
                echo "<script>window.location='index.php?module=user&action=manage_user&do=1'</script>" ;
                mysqli_close($con);
        }
    ?>