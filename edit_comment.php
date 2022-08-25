<?php
session_start(); 

    include("include/connect_db.php");
    $con=connect_db();
    $comment = mysqli_query($con,"SELECT comment_time FROM comments WHERE comment_id=$_POST[comment_id]") or die("Sql Topics Error>>".mysqli_error($con));
  list($time)=mysqli_fetch_row($comment);

  if(empty($_FILES['c_pic']['name'])){
    $c_pic="";
    $up_pic="";
}else{
    $time=date("dmyis");
    $sum_name=$time."abcdefghijklmnopqrstuvwxyz";
    $char=substr(str_shuffle($sum_name),0,10);//ตัดเหลือ10
    $c_pic=$char."_".$_FILES['c_pic']['name'];//ชื่อไฟล์
    $temp_file=$_FILES['c_pic']['tmp_name'];
    copy($temp_file,"images/topic/$c_pic");//copy ไฟล์ไปไว้ในโฟลเดอร์image
    $up_pic=",comment_pic='$c_pic' ";
}


$sql="UPDATE comments SET 
comment_text='$_POST[comment]'
$up_pic ,
comment_time='$time'

 WHERE comment_id='$_POST[comment_id]' ";

    mysqli_query($con,$sql)or die("SQL Error==>".mysqli_error($con));
    // echo "<script>alert('แก้ไขรายการแข่งเสร็จเรียบร้อย')</script>";
    echo "<script>window.location='topic_view.php?id=$_POST[topic_id]&do=1'</script>" ;
    mysqli_close($con);
?>