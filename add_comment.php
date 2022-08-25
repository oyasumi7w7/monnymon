<?php
include("include/connect_db.php");
$con=connect_db();
if(!empty($_FILES['c_pic']['name'])){
    $time=date("dmyis");
    $sum_name=$time."abcdefghijklmnopqrstuvwxyz";
    $char=substr(str_shuffle($sum_name),0,10);//ตัดเหลือ10,m_name,-m_lassname,m_
    $m_pic=$char."_".$_FILES['c_pic']['name'];//ชื่อไฟล์
    $temp_file=$_FILES['c_pic']['tmp_name'];
    copy($temp_file,"images/topic/$m_pic");//copy ไฟล์ไปไว้ในโฟลเดอร์image
}else{
    $m_pic="";
}
mysqli_query($con,"INSERT INTO comments(comment_text,comment_name,comment_pic,quest_id) 
VALUES('$_POST[comment]','$_POST[user_name]','$m_pic','$_POST[topic_id]')") or die("SQL comment Error1==>".mysqli_error($con));

mysqli_close($con);
if(empty($_POST['type'])){
    echo "<script>window.location='topic_view.php?id=$_POST[topic_id]'</script>" ;
}else{
    echo "<script>window.location='topic_deck_view.php?id=$_POST[topic_id]'</script>" ;
}

?>