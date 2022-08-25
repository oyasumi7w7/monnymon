<?php

if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='index.php'</script>";
  }

?>
<?php

        if(!empty($_FILES['pic']['name'])){
            $time=date("dmyis");
            $sum_name=$time."abcdefghijklmnopqrstuvwxyz";
            $char=substr(str_shuffle($sum_name),0,10);//ตัดเหลือ10,m_name,-m_lassname,m_
            $pic=$char."_".$_FILES['pic']['name'];//ชื่อไฟล์
            $temp_file=$_FILES['pic']['tmp_name'];
            copy($temp_file,"images/slide/$pic");//copy ไฟล์ไปไว้ในโฟลเดอร์image

        }else{
            $chk_pic=mysqli_query($con,"SELECT slide_pic FROM slide_show WHERE slide_id ='$_POST[id]'
            ")or die("Sql Error>>".mysqli_error($con)); 
            
            list($t_pic)=mysqli_fetch_row($chk_pic);
            $pic="$t_pic";
        }


        $sql="UPDATE slide_show SET 
        slide_name='$_POST[name]',
        slide_pic='$pic'
        
        WHERE slide_id='$_POST[id]' ";

        mysqli_query($con,$sql)or die("SQL Error==>".mysqli_error($con));
	
	mysqli_close($con);
    // echo "<script>alert('แก้ไข slide แล้ว')</script>";
	echo "<script>window.location='index.php?module=slide&action=manage_slide&do=2'</script>" ;
?>