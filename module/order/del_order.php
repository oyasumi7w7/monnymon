<?php

if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='index.php'</script>";
  }
$i=0;
?>
<?php
	/*include("include/connect_db.php");
	$con=connect_db();*/
	

	
        $re_product=mysqli_query($con,"SELECT order_pid,order_pronum FROM order_shop WHERE order_id ='$_GET[o_id]'")or die ("SQL Error2=>".mysqli_error($con));
        while(list($p_id,$p_num)=mysqli_fetch_row($re_product)){

            $re_product1=mysqli_query($con,"SELECT product_num,product_sales FROM product WHERE product_id ='$p_id'")or die ("SQL Error2=>".mysqli_error($con));
            list($pro_num,$p_sales)=mysqli_fetch_row($re_product1);
                $re_num = $p_num+$pro_num;
                $re_sales = $p_sales-$p_num;

            $up="UPDATE product SET 
            product_num = '$re_num' ,
            product_sales = '$re_sales' 
             
            WHERE product_id = '$p_id' ";
            mysqli_query($con,$up)or die("SQL Error==>".mysqli_error($con));
// echo    "$p_id<br>";
// echo "$p_num<br>==>$re_num==>$re_sales<br>";              
             

        }
    mysqli_query($con,"DELETE FROM order_shop
	WHERE order_id='$_GET[o_id]' ")or die("SQL Error1==>".mysqli_error($con));

    
	mysqli_close($con);

?>
<!-- <script>alert('ยกเลิกออเดอร์นี้แล้ว')</script> -->
<script>window.location='index.php?module=order&action=manage_order&do=4'</script>