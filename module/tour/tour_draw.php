<?php

if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='index.php'</script>";
  }

?>
<meta charset="UTF-8">
<h1 align="center">รายการแข่งขัน</h1>
<form method="post" action='index.php?module=tour&action=list_tour' >
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
	$result=mysqli_query($con,"SELECT tour_name FROM tournament WHERE tour_name LIKE '%$search%'")or die("SQL Error1==>".mysqli_error($con));
	
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
		echo "<p>ไม่พบรายการแข่งที่ตรงกับคำค้น</p>";
	}
	else{
		echo "<p style='color:#00008B; font-size:20px; '>จำนวนรายการแข่งทั้งหมดที่ตรงกับคำค้น $rows รายการ</p>";
	
	$result=mysqli_query($con,"SELECT tour_no,tour_name,tour_max,tour_regis,tour_endregis FROM tournament WHERE tour_name LIKE '%$search%' ORDER BY tour_no DESC LIMIT $start_rows,$rows_page ")or die("Sql Error>>".mysqli_error($con));
	
	
	echo "<p> หน้า : ";
	for($i=1;$i<=$pages;$i++){ //วนลูปตามจำนวนหน้า
		if($i==$pid){ //ถ้าตรงกับหน้าปัจจุบัน
		echo "<span style='color:red;font-weight:bold;'> [ $i ] </span>";		
		}
		else
		{
	echo"<a href='index.php?module=tour&action=tour_draw&pid=$i&search=$search'>[ $i ]</a>"; //สร้าง link หมายเลขหน้า
		}
	}
	echo "</p><br>";
?>	
		<div class="table-responsive table--no-card m-b-30">
			<table class="table table-borderless table-striped table-earning">
				<thead>
			<?php
	echo"<th style='text-align:center;'>รหัส</th>
	<th style='text-align:center;'>ชื่อรายการ</th>
	<th style='text-align:center;'>สูงสุด</th>
	<th style='text-align:center;'>ปัจจุบัน</th>
	<th style='text-align:center;'>ปิดรับสมัคร</th>
	<th style='text-align:center;'>  </th></tr>";
?>	
				</thead>
	<tbody>
    
	<?php
    $time=date('Y-m-d');
	while(list($t_no,$t_name,$t_max,$t_regis,$t_endregis)=mysqli_fetch_row($result)){
        
	//echo $data [0],"-"; //การ eco array ต้องมี index
	echo "<td style='text-align:center;'>$t_no</td>"; 
	//echo "<td><a href='product_detail.php?id=$product_id'>$product_title</a></td>"; //แบบ GET ไม่มี $ข้างหน้า
	echo "<td style='text-align:center;'>$t_name</td>";
    echo "<td style='text-align:center;'>$t_max คน</td>";
        $result2=mysqli_query($con,"SELECT player_id FROM tour_player WHERE tour_no ='$t_no'")or die("Sql Error>>".mysqli_error($con));
        $rows2=mysqli_num_rows($result2);
    echo "<td style='text-align:center;'>$rows2 คน</td>";
    if($t_endregis<$time){
        echo "<td style='text-align:center;'>หมดเขตลงออนไลน์</td>";
    }else{
        echo "<td style='text-align:center;'>$t_endregis</td>";
    }
?>
    

<?php
	echo "<td><a href='index.php?module=tour&action=match&tid=$t_no&page=idle'><button type='button' class='btn btn-warning' ><i class='fa fa-pencil'></i>&nbsp;</button></a></td></tr>";
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
		echo"<a href='index.php?module=tour&action=tour_draw&pid=$i&search=$search'>[ $i ]</a>"; //สร้าง link หมายเลขหน้า
			}
		}
		echo "</p>";
		?>
			