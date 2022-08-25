<?php

if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='index.php'</script>";
  }

?>
<meta charset="UTF-8">
<?php
/*include("include/connect_db.php");
$con = connect_db();*/
?>

<h1 align="center">จัดการข้อมูลสินค้า</h1>
<form method="post" action='index.php?module=item&action=manage_item' >


	<p align="center"><input type="text" name="search">&nbsp;
<?php
	echo"<select name='search' >";
	echo"<option value=''>-- เลือกประเภทสินค้า --</option>";
	$result2=mysqli_query($con,"SELECT * FROM product_category ") or die(mysqli_error($con));

		while(list($cate_id,$cate_name)=mysqli_fetch_row($result2)){
			
			echo"<option value='$cate_id' >$cate_name</option>";
		}
			echo"</select>";
		mysqli_free_result($result2);
?><input type="submit" value="ค้นหา"></p>

	
</form>

<?php
	
	
	if(empty($_POST['search2'])){ //ถ้ามีการส่งค่าตัวแปร get_search มาจากช่องค้นหา
			$search2="";
			 //นำค่ามาเก็บไว้ในตัวแปรแล้วค่อยนำไปใช้
		}
	else{
			$search2=$_POST['search2'];
		}	

	if(empty($_POST['search'])){ //ถ้ามีการส่งค่าตัวแปร get_search มาจากช่องค้นหา
		$search="";
		 //นำค่ามาเก็บไว้ในตัวแปรแล้วค่อยนำไปใช้
	}
	else{
		$search=$_POST['search'];
	}
	echo "<td>$search</td>";
	echo "<td>$search2</td>";

	//select ข้อมูลโดยกำหนดเงื่อนไขให้ตรงกับคำค้น
	$result=mysqli_query($con,"SELECT product_name FROM product WHERE product_name LIKE '%$search%'")or die("SQL Error==>".mysqli_error($con));
	$result=mysqli_query($con,"SELECT product_category FROM product WHERE  product_category LIKE '%$search%'")or die("SQL Error==>".mysqli_error($con));
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
	
	$result1=mysqli_query($con,"SELECT product_id,product_name,product_category,product_num,product_pic FROM product WHERE product_name LIKE '%$search%' 
	OR product_category LIKE '%$search%'
	ORDER BY product_name DESC LIMIT $start_rows,$rows_page ")or die("Sql Error>>".mysqli_error($con));
	
	
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
	
	if(empty($_GET['tx'])){
			$link="Select All";
			$chk="";
			$_GET['tx']=1;
		}
		else{
			$link="No Select";
			$chk="checked";
			$_GET['tx']="";
		}

	echo "<form method='post' action='index.php?module=item&action=multi_delete_item'>"; //ส่งค่าจาก checkbox
?>	
	<p align="right" class="p-xs-b-250" >
 	<a href='index.php?module=item&action=add_item_form'><button type="button" class="btn btn-primary btn-ra " >
	<i class="fa fa-star"></i>&nbsp; เพิ่มสินค้า</button></a>
	</p>
		<div class="table-responsive table--no-card m-b-30">
			<table class="table table-borderless table-striped table-earning">
				<thead>
			<?php
	echo"<tr><th><a href='index.php?module=item&action=manage_item&tx=$_GET[tx]'>$link</a></th>
	<th>ชื่อสินค้า</th><th>ประเถทสินค้า</th><th>จำนวนคงเหลือ</th><th>รูป</th><th>แก้ไข</th><th>ลบ</th></tr>";
?>	
				</thead>
	<tbody>
	<?php
	while(list($pro_id,$pro_name,$pro_cate,$pro_num,$pro_pic)=mysqli_fetch_row($result1)){
	//echo $data [0],"-"; //การ eco array ต้องมี index
	echo "<tr><td><input type='checkbox' name='del_id[]' value='$pro_id' $chk></td>"; 
	echo "<td>$pro_name</td>"; 
		$result2=mysqli_query($con,"SELECT cate_name FROM product_category WHERE cate_id='$pro_cate'")or die 
            ("SQL Error2=>".mysqli_error($con));
		list($pro_cate)=mysqli_fetch_row($result2);
						
	echo "<td> $pro_cate </td>";
	echo "<td>$pro_num</td>";?>	
	<td><img src='images/<?php echo $pro_pic ?>' style='width:100px;height:100px;'></td>

<?php
	echo "<td><a href='index.php?module=item&action=edit_item_form&id=$pro_id'>Edit</a></td>";
	echo "<td><a href='index.php?module=item&action=delete_item&id=$pro_id' onclick='return confirm(\" คุณแน่ใจหรือไม่ ว่าจะลบสินค้าชิ้นนี้ \")'>Delete</a></td></tr>";
	}
	echo "</table>";
	

} 

 mysqli_close($con);
 	?>
 	</tbody>
            </table>
        </div>
			<button type="submit" class="btn btn-danger btn-ra">
			<i class="fa  fa-recycle"></i>&nbsp; ลบแถวที่เลือก</button>