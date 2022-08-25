<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
<?php

if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='index.php'</script>";
  }
  if(empty($_GET['do'])){
 	$do="";
  }else{
	   $do=$_GET['do'];
  }
 
  if($do==1){
    echo '<script type="text/javascript">
          swal("", "เพิ่มของรางวัลเรียบร้อย", "success");
          </script>';
  }
?>
<?php
	/*include("include/connect_db.php");
	$con = connect_db();*/
    if(empty($_POST['cate'])){ //ถ้ามีการส่งค่าตัวแปร get_search มาจากช่องค้นหา
		if(empty($_GET['cate'])){
			$cate="";
		}else{
			$cate=$_GET['cate'];
		}	
		 //นำค่ามาเก็บไว้ในตัวแปรแล้วค่อยนำไปใช้
	}
	else{
		$cate=$_POST['cate'];
	}
?>
<meta charset="UTF-8">
<p align="center"><a style="font-size:50px; color:#A52A2A; ">จัดการข้อมูลรางวัล</a></p>

<br>
<form method="post" action='index.php?module=tour&action=reward' style="text-align:center;">
	<select name="cate" class="form-control-select"  style="max-width:30%; ">
                    <option value="" >-- เลือกทัวร์นาเมนต์ --</option>
                    <?php
                     $result=mysqli_query($con,"SELECT tour_no,tour_name FROM tournament ORDER BY tour_no DESC") or die(mysqli_error($con));
        
                     while(list($t_id,$t_name)=mysqli_fetch_row($result)){
						$select=$t_id==$cate?"selected":"";
                         echo"<option value='$t_id' $select>$t_name</option>";
					 }
			
                    echo "</select>";
                    mysqli_free_result($result);
                    ?>
					
					<input type="submit" value="ค้นหา" class="btn btn-success btn-ra">
					
					
	</form>


<br>
<?php



	//select ข้อมูลโดยกำหนดเงื่อนไขให้ตรงกับคำค้น
	$result=mysqli_query($con,"SELECT reward_name FROM reward WHERE reward_tour LIKE '%$cate%' ")or die("SQL Error==>".mysqli_error($con));
	
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
		echo "<p style='color:#00008B; font-size:20px; '>ไม่พบสินค้าที่ตรงกับคำค้น</p>";
	}
	else{
		echo "<p style='color:#00008B; font-size:20px; '>จำนวนสินค้าทั้งหมดที่ตรงกับคำค้น $rows รายการ</p>";
	
	$result=mysqli_query($con,"SELECT * FROM reward WHERE reward_tour LIKE '%$cate%'
	ORDER BY reward_date DESC , reward_name ASC LIMIT $start_rows,$rows_page ")or die("Sql Error>>".mysqli_error($con));
	
	
	echo "<p> หน้า : ";
	for($i=1;$i<=$pages;$i++){ //วนลูปตามจำนวนหน้า
		if($i==$pid){ //ถ้าตรงกับหน้าปัจจุบัน
		echo "<span style='color:red;font-weight:bold;'> [ $i ] </span>";		
		}
		else
		{
	echo"<a href='index.php?module=tour&action=reward&pid=$i&cate=$cate'>[ $i ]</a>"; //สร้าง link หมายเลขหน้า
	
		}
	}
	echo "</p>";
	
		

?>	
	<p align="right" class="" >
 	<a href='index.php?module=tour&action=add_reward_form'><button type="button" class="btn btn-primary btn-ra " >
	<i class="fa fa-star"></i>&nbsp; เพิ่มของรางวัล</button></a>
	</p>
		<div class="table-responsive table--no-card m-b-30">
			<table class="table table-borderless table-striped table-earning">
				<thead>
			<?php
	echo"<tr>
    <th style='text-align:center;' width='15%'>รูปของรางวัล</th>
	<th style='text-align:center;' >ชื่อของรางวัล</th>
	<th style='text-align:center;' >จำนวนของรางวัล</th>
	<th style='text-align:center;' width='5%'>ชื่อทัวร์นาเมนต์</th>
    <th style='text-align:center;' width='5%'>วันที่รับ</th>";

	
	// <th style='text-align:center;' width='5%'><a href='index.php?module=item&action=manage_item&tx=$_GET[tx]'>$link</a></th>
	// <th style='text-align:center;' width='5%'>คงเหลือ</th>
?>	
				</thead>
	<tbody>
	<?php
	while(list($r_id,$r_name,$r_num,$r_tour,$r_date,$r_pic)=mysqli_fetch_row($result)){
	?>
<tr>
	<?php
	//echo $data [0],"-"; //การ eco array ต้องมี index
	// echo "<tr><td style='text-align:center;'><input type='checkbox' name='del_id[]' value='$pro_id' $chk></td>"; 
	echo "<td style='text-align:center;'><img src='images/reward/$r_pic' style='width:100px;height:100px;'></td>";
	echo "<td style='text-align:center;'>$r_name</td>"; 
    echo "<td style='text-align:center;'>$r_num</td>"; 
		$result2=mysqli_query($con,"SELECT tour_name FROM tournament WHERE tour_no='$r_tour'")or die 
            ("SQL Error2=>".mysqli_error($con));
		list($tour_name)=mysqli_fetch_row($result2);
						
	echo "<td style='text-align:center;'> $tour_name </td>";
	?>	
	

<?php
	echo "<td style='text-align:center;'>$r_date</td>";
	// echo "<td style='text-align:center;'>$pro_num</td>";
	
	}
	echo "</table>";
	echo "</form";

} 
 mysqli_close($con);
 
 	?>
 	</tbody>
			</table>
</div>
<?php
echo "<p> หน้า : ";
for($i=1;$i<=$pages;$i++){ //วนลูปตามจำนวนหน้า
	if($i==$pid){ //ถ้าตรงกับหน้าปัจจุบัน
	echo "<span style='color:red;font-weight:bold;'> [ $i ] </span>";		
	}
	else
	{
		echo"<a href='index.php?module=tour&action=reward&pid=$i&cate=$cate'>[ $i ]</a>"; //สร้าง link หมายเลขหน้า
	}
}
echo "</p><br>";

?>

	
			