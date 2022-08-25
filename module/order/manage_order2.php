<?php
if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='index.php'</script>";
  }

?>
<meta charset="UTF-8">
<h1 align="center">จัดการข้อมูลออเดอร์</h1>
<form method="post" action='index.php?module=order&action=manage_order' >
	<p align="center"><input type="text" name="search">&nbsp;<input type="submit" value="ค้นหา"></p>
</form>

<?php
	/*include("include/connect_db.php");
	$con = connect_db();*/
	
?>
<?php
	if(empty($_POST['search'])){ //ถ้ามีการส่งค่าตัวแปร get_search มาจากช่องค้นหา
		$search="";
		 //นำค่ามาเก็บไว้ในตัวแปรแล้วค่อยนำไปใช้
	}
	else{
		$search=$_POST['search'];
	}


	//select ข้อมูลโดยกำหนดเงื่อนไขให้ตรงกับคำค้น
	$result=mysqli_query($con,"SELECT order_id FROM order_shop WHERE order_id LIKE '%$search%' ")or die("SQL Error==>".mysqli_error($con));
	
	$rows=mysqli_num_rows($result); //ใช้นับจำนวนแถวที่คิวรี่หรือซีเลคออกมาได้ พารามิเตอร์ 1 ตัวคือ ชื่อตัวแปรที่ใช้คิวรี่ รีเทิร์นค่าออกมาเป็นจำนวนแถวที่นับได้เป็นจำนวนเต็ม
	$rows_page=20; //จำนวนแถวที่ต้องการให้แสดงใน 1 หน้า
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
		echo "<p>ไม่พบสินค้าที่ตรงกับคำค้น</p>";
	}
	else{
		echo "<p>จำนวนสินค้าทั้งหมดที่ตรงกับคำค้น $rows รายการ</p>";
	
	$result=mysqli_query($con,"SELECT * FROM order_shop WHERE order_id LIKE '%$search%'
	")or die("Sql Error>>".mysqli_error($con));
	
	
	echo "<p> หน้า : ";
	for($i=1;$i<=$pages;$i++){ //วนลูปตามจำนวนหน้า
		if($i==$pid){ //ถ้าตรงกับหน้าปัจจุบัน
		echo "<span style='color:red;font-weight:bold;'> [ $i ] </span>";		
		}
		else
		{
	echo"<a href='index.php?module=order&action=mange_order&pid=$i&search=$search&cate=$cate'>[ $i ]</a>"; //สร้าง link หมายเลขหน้า
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
                                            <tr>
                                                <th>เลขที่สั่งซื้อ</th>
                                                <th>วันที่สั่ง</th>
                                                <th>ชื่อผู้สั่ง</th>
                                                <th>เบอร์โทร</th>
												<th>ราคารวม</th>
												<th>สถานะการชำระเงิน</th>
												<th>สถานะสินค้า</th>
                                            </tr>
                                        </thead>
										<tbody>
										<?php
										$total=0;

	while(list($o_num,$o_id,$o_memID,$o_pid,$o_pname,$o_Pprice,$o_Cname,$o_Clastname,$o_address,$o_address1,$o_phone,$o_pic,$o_paidS,$o_proS,$o_date)=mysqli_fetch_row($result)){
	//echo $data [0],"-"; //การ eco array ต้องมี index
	if($o_paidS==0){
		$status = ยกเลิก ;
		}elseif($o_paidS==1){
			$status = รอชำระ ;
		}elseif($o_paidS==2){
			$status = รอตรวจสอบการชำระ ;
		}else{
			$status = ชำระแล้ว ;
		}

	?>
										<?php
             echo                              " <tr>
                                                <td>$o_id</td>
                                                <td>$o_date</td>
                                                <td>$o_Cname  $o_Clastname</td>
                                                <td '>$o_phone</td>
												<td>$total</td>
												<td>$status</td>
												<td>$999.00</td>
                                            </tr>";
                                            
        echo                               " </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE-->
                            </div>
                        </div>";
	?>	
	
	
<?php
	
 mysqli_close($con);
 
 	?>
 	</tbody>
			</table>
			
</div>

            