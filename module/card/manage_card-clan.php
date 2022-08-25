<?php

if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='index.php'</script>";
  }

?>
<meta charset="UTF-8">
<p align="center"><a style="font-size:50px; color:#A52A2A; ">จัดการข้อมูลการ์ด</a></p>

<form method="post" action='index.php?module=card&action=manage_card' >
	<p align="center"><input type="text" name="search">&nbsp;<input type="submit" value="ค้นหา"></p>
</form>

<?php
	/*include("include/connect_db.php");
	$con = connect_db();*/
	
	/*include("include/connect_db.php");
	$con = connect_db();*/
	if(empty($_POST['clan'])){
		$clan="";
	}else{
		$clan=$_POST['clan'];
	}
	if(empty($_GET['clan'])){
		
	}else{
		$clan=$_GET['clan'];
	}
?>
<br>
	<form method="post" action='index.php?module=card&action=manage_card-clan' >
	<select name="clan" class="form-control-select"  style="max-width:30%;">
                    <option value="" >-- เลือกแคลนของการ์ด --</option>
                    <?php
                     $result=mysqli_query($con,"SELECT * FROM card_clan ") or die(mysqli_error($con));
        
                     while(list($c_id,$c_name)=mysqli_fetch_row($result)){
						$select=$c_id==$clan?"selected":"";
                         echo"<option value='$c_id' $select>$c_name</option>";
                     }
                    echo "</select>";
                    mysqli_free_result($result);
                    ?>
					<input type="submit" value="ค้นหา" class="btn btn-success btn-ra">
					
	</form><a href="index.php?module=card&action=manage_card"><button class="btn btn-success btn-ra"><i class="fa fa-star"></i>&nbsp; ทั้งหมด</button></a>
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
	$result=mysqli_query($con,"SELECT card_name FROM card_list WHERE Clan LIKE '$clan' ")or die("SQL Error==>".mysqli_error($con));
	
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
		echo "<p style='color:#00008B; font-size:20px; '>ไม่พบการ์ดที่ตรงกับคำค้น</p>";
	}
	else{
		echo "<p style='color:#00008B; font-size:20px; '>จำนวนการ์ดทั้งหมดที่ตรงกับคำค้น $rows รายการ</p>";
	
	$result=mysqli_query($con,"SELECT card_id,card_name,grade,Clan,card_type,card_pic FROM card_list WHERE Clan LIKE '$clan'
	ORDER BY card_id ASC LIMIT $start_rows,$rows_page ")or die("Sql Error>>".mysqli_error($con));
	
	
	echo "<p> หน้า : ";
	for($i=1;$i<=$pages;$i++){ //วนลูปตามจำนวนหน้า
		if($i==$pid){ //ถ้าตรงกับหน้าปัจจุบัน
		echo "<span style='color:red;font-weight:bold;'> [ $i ] </span>";		
		}
		else
		{
	echo"<a href='index.php?module=card&action=manage_card-clan&pid=$i&search=$search&clan=$clan'>[ $i ]</a>"; //สร้าง link หมายเลขหน้า
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

	echo "<form method='post' action='index.php?module=card&action=delete_card_multi'>"; //ส่งค่าจาก checkbox
?>	
	<p align="right" class="" >
 	<a href='index.php?module=card&action=add_card_form'><button type="button" class="btn btn-primary btn-ra " >
	<i class="fa fa-star"></i>&nbsp; เพิ่มการ์ด</button></a>
	</p>
		<div class="table-responsive table--no-card m-b-30">
			<table class="table table-borderless table-striped table-earning">
				<thead>
			<?php
	echo"<tr><th style='text-align:center;'><a href='index.php?module=card&action=manage_card&tx=$_GET[tx]'>$link</a></th>
	<th style='text-align:center;' width='5%'>รูปการ์ด</th>
	<th style='text-align:center;'>ชื่อการ์ด</th>
	<th style='text-align:center;' width='5%'>เกรด</th>
	<th style='text-align:center;'>แคลน</th>
	<th></th></tr>";
?>	
				</thead>
	<tbody>
	<?php
	while(list($card_id,$card_name,$grade,$c_clan,$type,$card_pic)=mysqli_fetch_row($result)){
	//echo $data [0],"-"; //การ eco array ต้องมี index
	echo "<tr><td style='text-align:center;'><input type='checkbox' name='del_id[]' value='$card_id' $chk></td>"; 
	echo "<td style='text-align:center;'><img src='images/card_pic/$card_pic' style='width:100px;height:100px;'></td>";
	
	echo "<td style='text-align:center;'>$card_name</td>"; 
	echo "<td style='text-align:center;'>$grade</td>"; 
		$result2=mysqli_query($con,"SELECT clan_name FROM card_clan WHERE clan_id='$c_clan'")or die 
            ("SQL Error2=>".mysqli_error($con));
		list($show_clan)=mysqli_fetch_row($result2);
						
	echo "<td style='text-align:center;'> $show_clan </td>";
	
	?>	
	

<?php
	echo "<td style='text-align:center;'>
	<a href='index.php?module=card&action=edit_card_form&id=$card_id'><button type='button' class='btn btn-warning' ><i class='fa fa-pencil'></i>&nbsp;</button></a>
	<a href='index.php?module=card&action=delete_card_single&id=$card_id' onclick='return confirm(\" คุณแน่ใจหรือไม่ ว่าจะลบการ์ดใบนี้ \")'>
	<button type='button' class='btn btn-danger' ><i class='fa fa-trash-o'></i>&nbsp;</button></a></td></tr>";
	
	}
	echo "</table>";
	

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
echo"<a href='index.php?module=card&action=manage_card-clan&pid=$i&search=$search&clan=$clan'>[ $i ]</a>"; //สร้าง link หมายเลขหน้า
	}
}
echo "</p><br>";

?>
<button type="submit" class="btn btn-danger btn-ra">
			<i class="fa  fa-recycle"></i>&nbsp; ลบแถวที่เลือก</button>
			
			