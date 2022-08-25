<?php
$t_id=$_GET['qid'];

?>
<?php
	include("include/connect_db.php");
	$con=connect_db();
	mysqli_query($con,"DELETE FROM comments WHERE comment_id='$_GET[cid]' ")or die("SQL Error1==>".mysqli_error($con));

	
	mysqli_close($con);

?>

<?php
// echo "<script>alert('ลบเสร็จสิ้น')</script>";
echo "<script>window.location='topic_view.php?id=$t_id&do=2'</script>";
?>