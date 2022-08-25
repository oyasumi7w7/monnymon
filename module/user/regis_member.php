
<meta charset="utf-8">
<?php
	include("../../include/connect_db.php");
    $con=connect_db();
    $chk_id=$_POST['id'];
    $type=2;
    $chk=mysqli_query($con,"SELECT * FROM member WHERE m_id='$chk_id' ");
    $rows=mysqli_num_rows($chk); 
    if($rows>0)
    {
        echo "<script>alert('ID ซ้ำ ไม่สามารเพิ่มผู้ใช้ได้')</script>";
        echo "<script>window.location='../../register.php'</script>" ;
    }
        else{
    mysqli_query($con,"INSERT INTO member(m_id,m_pass,m_pic,m_type) VALUES
    ('$_POST[id]',
    '$_POST[password]',
    'start_icon.jpg',
    '$type')") or die("SQL Error==>".mysqli_error($con));

        echo "<script>alert('เพิ่มผู้ใช้เสร็จเรียบร้อย')</script>";
        echo "<script>window.location='../../login_shop.php'</script>" ;
        mysqli_close($con);
        }
    ?>