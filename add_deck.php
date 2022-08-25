<meta charset="UTF-8">
<?php
session_start(); 
	include("include/connect_db.php");
	$con=connect_db();
	if(!empty($_FILES['pic']['name'])){
		$time=date("dmyis");
		$sum_name=$time."abcdefghijklmnopqrstuvwxyz";
		$char=substr(str_shuffle($sum_name),0,10);//ตัดเหลือ10,m_name,-m_lassname,m_
		$m_pic=$char."_".$_FILES['pic']['name'];//ชื่อไฟล์
		$temp_file=$_FILES['pic']['tmp_name'];
		copy($temp_file,"images/topic/$m_pic");//copy ไฟล์ไปไว้ในโฟลเดอร์image
	}else{
		$m_pic="";
	}

	mysqli_query($con,"INSERT INTO topics(topic_head,topic_text,topic_pic,topic_member,topic_type) 
	VALUES('$_POST[head]','$_POST[text]','$m_pic','$_SESSION[valid_user]','1')") or die("SQL Error1==>".mysqli_error($con));

    $top_id=mysqli_query($con,"SELECT topic_id FROM topics WHERE topic_member='$_SESSION[valid_user]' AND topic_type='1' ORDER BY topic_time DESC ")or die("Sql Error1>>".mysqli_error($con));
    list($tp_id)=mysqli_fetch_row($top_id); 

    foreach ($_SESSION["card_set"] as $item){

    mysqli_query($con,"INSERT INTO deck_tb(deck_topic_id,card_id,card_num,card_pic) 
    VALUES('$tp_id','$item[card_id]','$item[quantity]','$item[card_pic]')") or die("SQL Error1==>".mysqli_error($con));
    }


	mysqli_close($con);
	echo "<script>window.location='deck_list.php'</script>" ;
?>