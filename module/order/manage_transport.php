
<?php
if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='main.php'</script>";
  }

?>
<meta charset="UTF-8">
<h1 align="center">จัดการการส่งสินค้า</h1>
<form method="post" action='index.php?module=order&action=manage_order' >
	<p align="center"><input type="text" name="search">&nbsp;<input type="submit" value="ค้นหา"></p>
</form>

<?php
	/*include("include/connect_db.php");
	$con = connect_db();*/
	
?>
<?php
	if(empty($_POST['search'])){ //ถ้ามีการส่งค่าตัวแปร get_search มาจากช่องค้นหา
		if(empty($_GET['search'])){
			$search="";
		}else{
			$search=$_GET['search'];
		}	
		 //นำค่ามาเก็บไว้ในตัวแปรแล้วค่อยนำไปใช้
	}
	else{
		$search=$_POST['search'];
	}


	//select ข้อมูลโดยกำหนดเงื่อนไขให้ตรงกับคำค้น
	$result=mysqli_query($con,"SELECT order_id FROM order_shop WHERE order_id LIKE '%$search%'   group by order_id")or die("SQL Error==>".mysqli_error($con));
	
	$rows=mysqli_num_rows($result); //ใช้นับจำนวนแถวที่คิวรี่หรือซีเลคออกมาได้ พารามิเตอร์ 1 ตัวคือ ชื่อตัวแปรที่ใช้คิวรี่ รีเทิร์นค่าออกมาเป็นจำนวนแถวที่นับได้เป็นจำนวนเต็ม
	$rows_page=10; //จำนวนแถวที่ต้องการให้แสดงใน 1 หน้า
	$pages=ceil($rows/$rows_page); //จำนวนหน้าหาจาก (จำนวนแถว หาร จำนวนแถวต่อหน้า)ปัดเศษขึ้น *ceil
	
	if(isset($_GET['pid'])){ //ตรวจสอบว่ามีการส่งค่า หมายเลขหน้ามาหรือไม่
		$pid=$_GET['pid']; //หมายเลขหน้าที่ส่งมาจาก link
		$start_rows=($pid-1)*$rows_page; //คำนวณหาแถวแรกแต่ละหน้า
	}
	else{ //ถ้าไม่มีการคลิก link เลขหน้า
		$pid=1; //กำหนดหน้า เป็นหน้าแรก
		$start_rows=0; //แถวแรก
	}
	
	
	if($rows==0){ //ถ้าคำค้นไม่ตรงกับสินค้าใดๆ
		echo "<p style='color:#00008B; font-size:20px; '>ไม่พบออเดอร์ที่ตรงกับคำค้น</p>";
	}
	else{
		echo "<p style='color:#00008B; font-size:20px; '>จำนวนออเดอร์ทั้งหมดที่ตรงกับคำค้น $rows รายการ</p>";
	
	$result=mysqli_query($con,"SELECT * FROM order_shop WHERE order_id LIKE '%$search%' group by order_id
	")or die("Sql Error>>".mysqli_error($con));
	/*$result=mysqli_query($con,"SELECT * FROM product WHERE product_name LIKE '%$search%'
	")or die("Sql Error>>".mysqli_error($con));*/
	
	
	echo "<p> หน้า : ";
	for($i=1;$i<=$pages;$i++){ //วนลูปตามจำนวนหน้า
		if($i==$pid){ //ถ้าตรงกับหน้าปัจจุบัน
		echo "<span style='color:red;font-weight:bold;'> [ $i ] </span>";		
		}
		else
		{
	echo"<a href='index.php?module=item&action=manage_item&pid=$i&search=$search'>[ $i ]</a>"; //สร้าง link หมายเลขหน้า
		}
	}
	echo "</p>";
	

?>	
	
	<div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
			<table class="table table-borderless table-data3">
				<thead>
			<?php
	echo"<tr>
												<th style='text-align:center;'>เลขที่สั่งซื้อ</th>
                                                <th style='text-align:center;'>วันที่สั่ง</th>
                                                <th style='text-align:center;'>ชื่อผู้สั่ง</th>
                                                <th style='text-align:center;'>เบอร์โทร</th>
												<th style='text-align:center;'>ราคารวม</th>
												<th style='text-align:center;'>สถานะการชำระเงิน</th>
												<th style='text-align:center;'>สถานะสินค้า</th></tr>";
?>	
				</thead>
				
	<tbody>
	<?php
	
	while(list($o_num,$o_id,$o_memID,$o_pid,$o_pname,$o_Pprice,$o_Pnum,$o_address,$o_phone,$o_pic,$o_ems,$o_paidS,$o_proS,$o_date)=mysqli_fetch_row($result)){
	//echo $data [0],"-"; //การ eco array ต้องมี index
	$ems_p=0;
	$customer=mysqli_query($con,"SELECT m_name,m_lastname FROM member WHERE m_num='$o_memID' ")or die("Sql Error1>>".mysqli_error($con));
	list($name,$lassname)=mysqli_fetch_row($customer); 

	$total=0;
	
	if($o_paidS==0){
		$status = 'ยกเลิก' ;
		}elseif($o_paidS==1){
			$status = 'รอชำระ' ;
		}elseif($o_paidS==2){
			$status = 'รอตรวจสอบการชำระ';
		}else{
			$status = 'ชำระแล้ว' ;
		}

		if($o_proS==0){
			$Pstatus = '<td></td>' ;
			}elseif($o_proS==1){
				$Pstatus = '<td><h4><span class="badge badge-info ">ยังไม่ได้ชำระเงิน</span></h4></td>' ;
			}elseif($o_proS==2){
				$Pstatus = '<td>ตรวจสอบการชำระ</td>';
			}else{
				$Pstatus = '<td>รอการจัดส่ง</td>' ;
			}

	?>
										<?php 
	echo "<tr>"; 
	echo "<td style='text-align:center;'>$o_id</td>";
	echo "<td style='text-align:center;'>$o_date</td>"; 
	echo "<td style='text-align:center;'> $name  $lastname </td>";
	?>	
	
	
<?php
	echo "<td style='text-align:center;'>$o_phone</td>";
$result2=mysqli_query($con,"SELECT order_price ,order_pronum,order_ems FROM order_shop WHERE order_id ='$o_id'")or die("Sql Error>>".mysqli_error($con));
	while(list($cal_price,$cal_num,$ems)=mysqli_fetch_row($result2)){
		
if($ems==1){
			$ems_p=30;
		}elseif($ems==2){
			$ems_p=50;
		}
		$total=$total+($cal_price*$cal_num);
	}
	
	
		$total_last=$total+$ems_p;
	echo "<td style='text-align:center;'>$total_last</td>";
	

	echo " <td style='text-align:center;'>$status</td>";
   
	echo "$Pstatus</tr>";
	
	}
	echo "</table><br>";
	
	echo "<p> หน้า : ";
	for($i=1;$i<=$pages;$i++){ //วนลูปตามจำนวนหน้า
		if($i==$pid){ //ถ้าตรงกับหน้าปัจจุบัน
		echo "<span style='color:red;font-weight:bold;'> [ $i ] </span>";		
		}
		else
		{
	echo"<a href='index.php?module=item&action=manage_item&pid=$i&search=$search'>[ $i ]</a>"; //สร้าง link หมายเลขหน้า
		}
	}
	echo "</p>";

} 
 mysqli_close($con);
 
 	?>
 	</tbody>
			</table>
			
</div>
</div>