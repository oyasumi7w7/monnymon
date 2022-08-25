<?php
if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']>2 ){
    echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
echo "<script>window.location='main.php'</script>";
}else{

}
?>
<meta charset="utf-8">
<?php
	/*include("include/connect_db.php");
	$con=connect_db();*/
	$num=$_POST['num'];
	$f_pass=$_POST['f_pass'];
    $n_pass=$_POST['new_pass'];
    $chk_pass=$_POST['password'];
	
    if( $f_pass != $chk_pass)
    {
        // echo "<script>alert('ใส่รหัสผ่านเดิมไม่ถูกต้อง')</script>";
		echo "<script>window.location='index.php?module=user&action=re_password&do=1'</script>" ;
		
    }elseif($f_pass == $n_pass)
    {
        // echo "<script>alert('ใช้รหัสผ่านนี้อยู่แล้ว')</script>";
		echo "<script>window.location='index.php?module=user&action=re_password&do=2'</script>" ;
    }
    else{
		$sql="UPDATE member SET
					
					m_pass='$n_pass'
					
					WHERE m_num='$num' " ;

					mysqli_query($con,$sql) or die("SQL Error==>".mysqli_error($con));
					
					//mysqli_query($con,$a)or die("SQL Error1==>".mysqli_error($con));
					// echo "<script>alert('เปลี่ยนรหัสผ่านเสร็จสิ้น')</script>";
					echo "<script>window.location='index.php?module=user&action=show_profile&do=4'</script>" ;
					mysqli_close($con);
				}

?>