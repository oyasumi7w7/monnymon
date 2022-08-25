<?php

if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='index.php'</script>";
  }

?>
<meta charset="utf-8">
<?php
$pid=$_POST['p_id'];
if(empty($_POST['num']) OR $_POST['num']==0 ){
    echo "<script>alert('ไม่มีจำนวนสินค้าที่เพิ่ม หรือสินค้าที่เพิ่มคือ 0 ')</script>";
    echo "<script>window.location='index.php?module=item&action=warehouse'</script>" ;
}else{
    $new_num=$_POST['num'];


            $cal_num=mysqli_query($con,"SELECT product_name,product_num FROM product WHERE product_id ='$pid'
            ")or die("Sql Error>>".mysqli_error($con)); 
            
            list($p_name,$p_num)=mysqli_fetch_row($cal_num);

            $total=$p_num+$new_num;


        $sql="UPDATE product SET 
                product_num='$total'
                
                WHERE product_id='$pid' ";
        mysqli_query($con,$sql)or die("SQL Error==>".mysqli_error($con));


        mysqli_query($con,"INSERT INTO stock_update(product_id,product_name,product_qty,consumption) VALUES
        ('$pid',
        '$p_name',
        '$new_num',
        '$_POST[consum]')") or die("SQL Error==>".mysqli_error($con));
     

// echo "<script>alert('อัพเดทเสร็จสิ้น')</script>";
echo "<script>window.location='index.php?module=item&action=warehouse&do=1'</script>" ;
}
mysqli_close($con);

?>