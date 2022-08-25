<meta charset="utf-8">
<?php
	include("include/connect_db.php");
    $con=connect_db();
    $tid=$_GET['tid'];
    $pid=$_GET['pid'];
    $time=date('Y-m-d');

if(empty($pid)){
    echo "<script>alert('กรุณา Login เข้าสู่ระบบก่อนลงทะเบียน')</script>";
    echo "<script>window.location='tour_listplayer.php?tid=$tid'</script>" ;
}else{
    $rs=mysqli_query($con,"SELECT m_num,m_name,m_lastname FROM member WHERE m_id='$pid' ")or die("Sql Error1>>".mysqli_error($con));
    list($num,$name,$lastname)=mysqli_fetch_row($rs);

    mysqli_query($con,"INSERT INTO tour_player(tour_no,player_id,player_name,player_lastname,day_regis) VALUES
            ('$tid',
            '$num',
            '$name',
            '$lastname',
            '$time' )") or die("SQL Error==>".mysqli_error($con));

                // echo "<script>alert('ลงทะเบียนเรียบร้อย)</script>";
                echo "<script>window.location='tour_listplayer.php?tid=$tid&do=1'</script>" ;
                mysqli_close($con);
            }

?>