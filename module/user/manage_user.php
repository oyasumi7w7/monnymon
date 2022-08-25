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
         swal("", "เพิ่มผู้ใช้เสร็จเรียบร้อย", "success");
         </script>';
 }elseif($do==2){
    echo '<script type="text/javascript">
    swal("", "ลบเสร็จสิ้น", "success");
    </script>';
 }elseif($do==3){
    echo '<script type="text/javascript">
    swal("", "อัพเดทเสร็จสิ้น", "success");
    </script>';
 }
?>
<meta charset="UTF-8">
<p align="center"><a style="font-size:50px; color:#A52A2A; ">จัดการข้อมูลผู้ใช้</a></p>

<form method="post" action='index.php?module=user&action=manage_user' >
	<p align="center"><input type="text" name="search">&nbsp;<input type="submit" value="ค้นหา"></p>
</form>

<?php
	/*include("include/connect_db.php");
	$con = connect_db();*/
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
	$result=mysqli_query($con,"SELECT m_id FROM member WHERE m_id LIKE '%$search%' OR m_name LIKE '%$search%' OR m_lastname LIKE '%$search%' ")or die("SQL Error1==>".mysqli_error($con));
	
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
		echo "<p style='color:#00008B; font-size:20px; '>ไม่พบผู้ใช้งานที่ตรงกับคำค้น</p>";
	}
	else{
		echo "<p style='color:#00008B; font-size:20px; '>จำนวนผู้ใช้งานทั้งหมดที่ตรงกับคำค้น $rows รายการ</p>";
	
	$result=mysqli_query($con,"SELECT m_num,m_id,m_pic,m_name,m_lastname,m_type FROM member WHERE m_id LIKE '%$search%' OR m_name LIKE '%$search%'  OR m_lastname LIKE '%$search%'
	ORDER BY m_num DESC LIMIT $start_rows,$rows_page ")or die("Sql Error>>".mysqli_error($con));
	
	
	echo "<p> หน้า : ";
	for($i=1;$i<=$pages;$i++){ //วนลูปตามจำนวนหน้า
		if($i==$pid){ //ถ้าตรงกับหน้าปัจจุบัน
		echo "<span style='color:red;font-weight:bold;'> [ $i ] </span>";		
		}
		else
		{
	echo"<a href='index.php?module=user&action=manage_user&pid=$i&search=$search'>[ $i ]</a>"; //สร้าง link หมายเลขหน้า
		}
	}
	echo "</p>";
	
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

	echo "<form method='post' action='index.php?module=user&action=multi_delete_user' >"; //ส่งค่าจาก checkbox
?>	
	<p align="right"  >
 	<a href='index.php?module=user&action=add_user_form'><button type="button" class="btn btn-primary btn-ra " >
	<i class="fa fa-star"></i>&nbsp; เพิ่มผู้ใช้งาน</button></a>
	</p>
		<div class="table-responsive table--no-card m-b-30">
			<table class="table table-borderless table-striped table-earning">
				<thead>
			<?php
	echo"<tr><th style='text-align:center;' width='5%'><a href='index.php?module=user&action=manage_user&tx=$_GET[tx]'>$link</a></th>
	<th style='text-align:center;'>รูป</th>
	<th style='text-align:center;'>ID</th>
	<th style='text-align:center;'>ชื่อ</th>
	<th style='text-align:center;'>สิทธิ์</th>
	<th style='text-align:center;'></th></tr>";
?>	
				</thead>
	<tbody>
	<?php
	while(list($num,$id,$pic,$name,$lastname,$type)=mysqli_fetch_row($result)){
		if($type==1){
			$class="Admin";
		}
		else{
			$class="Customer";
		}
		if(empty($pic)){
			$pic="start_icon.jpg";
		}

	//echo $data [0],"-"; //การ eco array ต้องมี index
	echo "<tr><td style='text-align:center;'><input type='checkbox' name='del_id[]' value='$num' $chk></td>"; ?>
	<td><img src='images/user_images/<?php echo $pic ?>' style='width:100px;height:100px;'></td>
	<?php
	echo "<td style='text-align:center;'>$id</td>"; 
	//echo "<td><a href='product_detail.php?id=$product_id'>$product_title</a></td>"; //แบบ GET ไม่มี $ข้างหน้า
	echo "<td style='text-align:center;'>$name&nbsp;&nbsp; $lastname </td>";
	echo "<td style='text-align:center;'>$class</td>";?>	

<?php
	echo "<td style='text-align:center;'>
		<a href='index.php?module=user&action=edit_user_form&id=$num'><button type='button' class='btn btn-warning' ><i class='fa fa-pencil'></i>&nbsp;</button></a>
		<a href='index.php?module=user&action=delete_user&id=$num' onclick='return confirm(\" คุณแน่ใจหรือไม่ ว่าจะลบข้อมูลผู้ใช้นี้ \")'>
		<button type='button' class='btn btn-danger' ><i class='fa fa-trash-o'></i>&nbsp;</button></a></td>";
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
				echo"<a href='index.php?module=user&action=manage_user&pid=$i&search=$search'>[ $i ]</a>"; //สร้าง link หมายเลขหน้า
					}
				}
				echo "</p><br>";
			?>
			<button type="submit" class="btn btn-danger btn-ra">
			<i class="fa  fa-recycle"></i>&nbsp; ลบแถวที่เลือก</button>
		</form>
