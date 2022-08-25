<?php
if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1 ){
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
		  swal("", "ลบเสร็จสิ้น", "error");
		  </script>';
  }
?>
<meta charset="UTF-8">
<p align="center"><a style="font-size:50px; color:#A52A2A; ">กระทู้ทั้งหมด</a></p>
<form method="post" action='index.php?module=topic&action=manage_topic_shop' >
	<p align="center"><input type="text" name="search">&nbsp;<input type="submit" value="ค้นหา"></p>
</form>

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
	$result=mysqli_query($con,"SELECT topic_head FROM topics WHERE topic_head LIKE '%$search%'  ")or die("SQL Error1==>".mysqli_error($con));
	
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
		echo "<p>ไม่พบกระทู้ที่ตรงกับคำค้น</p>";
	}
	else{
		echo "<p>จำนวนกระทู้ที่ตรงกับคำค้น $rows รายการ</p>";
	
	$result=mysqli_query($con,"SELECT topic_id,topic_head,topic_time,last_edited FROM topics WHERE topic_head LIKE '%$search%'  ORDER BY topic_id DESC LIMIT $start_rows,$rows_page ")or die("Sql Error>>".mysqli_error($con));
	
	
	echo "<p> หน้า : ";
	for($i=1;$i<=$pages;$i++){ //วนลูปตามจำนวนหน้า
		if($i==$pid){ //ถ้าตรงกับหน้าปัจจุบัน
		echo "<span style='color:red;font-weight:bold;'> [ $i ] </span>";		
		}
		else
		{
	echo"<a href='index.php?module=topic&action=manage_topic_shop&pid=$i&search=$search'>[ $i ]</a>"; //สร้าง link หมายเลขหน้า
		}
	}
	echo "</p><br>";
	
	if(empty($_GET['tx'])){
			$link="All";
			$chk="";
			$_GET['tx']=1;
		}
		else{
			$link="Reset";
			$chk="checked";
			$_GET['tx']="";
		}

	echo "<form method='post' action='index.php?module=topic&action=multi_delete_topic_shop'>"; //ส่งค่าจาก checkbox
?>	
		<div class="table-responsive table--no-card m-b-30">
			<table class="table table-borderless table-striped table-earning">
				<thead>
			<?php
	echo"<tr><th style='text-align:center;'><a href='index.php?module=topic&action=manage_topic_shop&tx=$_GET[tx]'>$link</a></th>
	
	<th style='text-align:center;'>ชื่อกระทู้</th>
	<th style='text-align:center;' width='5%'>วันที่ตั้ง</th>
	<th style='text-align:center;'>แก้ไขล่าสุด</th>
	<th style='text-align:center;'width='5%'>  </th></tr>";
	
	// <th style='text-align:center;' width='5%'>รหัส</th>
?>	
				</thead>
	<tbody>
	<?php
	while(list($top_id,$top_head,$top_time,$top_edit)=mysqli_fetch_row($result)){
        // $top_head_o = strlen($top_head) > 5 ? substr($top_head,0,5)."..." : $top_head;
	//echo $data [0],"-"; //การ eco array ต้องมี index
	echo "<tr><td style='text-align:center;' width='5%'><input type='checkbox' name='del_id[]' value='$top_id' $chk></td>"; 
	// echo "<td style='text-align:center;' >$top_id</td>"; 
	//echo "<td><a href='product_detail.php?id=$product_id'>$product_title</a></td>"; //แบบ GET ไม่มี $ข้างหน้า
	echo "<td style='text-align:center;'>$top_head</td>";
    echo "<td style='text-align:center;'>$top_time</td>";
    echo "<td style='text-align:center;'>$top_edit</td>";?>	
    

<?php
	echo "<td>
	<a href='index.php?module=topic&action=delete_topic_shop_single&top_id=$top_id' onclick='return confirm(\" คุณแน่ใจหรือไม่ ว่าจะลบข้อมูลผู้ใช้นี้ \")'>
	<button type='button' class='btn btn-danger' ><i class='fa fa-trash-o'></i>&nbsp;</button></a></td></tr>";
	}
	echo "</table>";
	

} //ปิดเงื่อนไข else ไม่ให้เห็นหัวตาราง (บรรทัด 43)
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
	echo"<a href='index.php?module=topic&action=manage_topic_shop&pid=$i&search=$search'>[ $i ]</a>"; //สร้าง link หมายเลขหน้า
		}
	}
	echo "</p><br>";
?>
			<button type="submit" class="btn btn-danger btn-ra">
			<i class="fa  fa-recycle"></i>&nbsp; ลบแถวที่เลือก</button>
			