<?php
if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']>2 ){
    echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
echo "<script>window.location='main.php'</script>";
}else{

}

if(empty($_GET['do'])){
    $do="";
 }else{
      $do=$_GET['do'];
 }

 if($do==1){
   echo '<script type="text/javascript">
         swal("", "แก้ไขกระทู้เสร็จสิ้น", "success");
         </script>';
 }elseif($do==2){
    echo '<script type="text/javascript">
    swal("", "ลบเสร็จสิ้น", "success");
    </script>';
 }
?>
<meta charset="UTF-8">

<p align="center"><a style="font-size:50px; color:#A52A2A; ">กระทู้ของตนเอง</a></p>
<form method="post" action='index.php?module=topic&action=manage_topic_self' >
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
	$result=mysqli_query($con,"SELECT topic_head FROM topics WHERE topic_head LIKE '%$search%' AND topic_member='$_SESSION[valid_user]' ")or die("SQL Error1==>".mysqli_error($con));
	
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
		echo "<p style='color:#00008B; font-size:20px; '>ไม่พบกระทู้</p>";
	}
	else{
		echo "<p style='color:#00008B; font-size:20px; '>จำนวนกระทู้ที่ตรงกับคำค้น $rows รายการ</p>";
	
	$result=mysqli_query($con,"SELECT topic_id,topic_head,topic_time,last_edited FROM topics WHERE topic_head LIKE '%$search%' AND topic_member='$_SESSION[valid_user]' ORDER BY topic_id DESC LIMIT $start_rows,$rows_page ")or die("Sql Error>>".mysqli_error($con));
	
	
	echo "<p> หน้า : ";
	for($i=1;$i<=$pages;$i++){ //วนลูปตามจำนวนหน้า
		if($i==$pid){ //ถ้าตรงกับหน้าปัจจุบัน
		echo "<span style='color:red;font-weight:bold;'> [ $i ] </span>";		
		}
		else
		{
	echo"<a href='index.php?module=topic&action=manage_topic_self&pid=$i&search=$search'>[ $i ]</a>"; //สร้าง link หมายเลขหน้า
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

		$modal_topic=mysqli_query($con,"SELECT topic_id,topic_head FROM topics WHERE topic_head LIKE '%$search%' AND topic_member='$_SESSION[valid_user]' 
		ORDER BY topic_id DESC LIMIT $start_rows,$rows_page ")or die("Sql Error>>".mysqli_error($con)); 
		?>
	   
		<?php
		while(list($t_id,$t_head)=mysqli_fetch_row($modal_topic)){
	?>	
	
	
								<div class="modal hide fade in" style=" margin-top:100px" id="check<?php echo $t_id ?>" > 
									<div class="modal-dialog">
									  <div class="modal-content">
										<div class="modal-header">
											  <p><?php echo $t_head ;?></p>
											  <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
										</div>
											<div class="modal-body ">
											  <form action="index.php?module=topic&action=edit_topic_self" method="post" enctype="multipart/form-data" class="form-horizontal">
														  
														  
													  <?php
													 
														  $topic_info=mysqli_query($con,"SELECT topic_head,topic_text,topic_pic,topic_type FROM topics WHERE topic_id ='$t_id'
														  ")or die("Sql Error>>".mysqli_error($con)); 
														  ?>
														 
														  <?php
														  list($t_head2,$t_text,$t_pic,$t_type)=mysqli_fetch_row($topic_info);
															?>
																	<?php
																		if(empty($t_pic)){

																	?>
																		<p style='text-align:center;'><img src='images/topic/no-pic.jpg' style='width:40%;height:auto;'></p>
															   			<br>
																	<?php
																	}else{
																	?>
																		<p style='text-align:center;'><img src='images/topic/<?php echo $t_pic?>' style='width:40%;height:auto;'></p>
															   			<br>
																	<?php
																	}
																	?>
															    <input type="hidden" id="top_id" name="top_id" value="<?php echo $t_id; ?>">
															   <table class="table site-block-order-table mb-5">

													  <thead>
														
													  </thead> 
													  <tbody>
													  	<tr>
															<td class="text-black font-weight-bold"><strong>หัวข้อใหม่</strong></td>
															<td class="text-black font-weight-bold"><strong><input type="text" name="top_head" value="<?php echo $t_head2 ?>" style="width: 50%" class="form-control"></strong></td>                                                 
														</tr>
														<tr>
															<td class="text-black font-weight-bold"><strong>โพสใหม่</strong></td>
															<td><textarea class="form-control" id="top_text" name="top_text" rows="3"><?php echo $t_text ?></textarea></td>
															      
														</tr>
														<?php if($t_type==0){ ?>
														<tr>
															<td class="text-black font-weight-bold"><strong>รูปภาพประกอบ</strong></td>
                                                            <td class="text-black font-weight-bold"> <input type="file" name="top_pic" class="form-control-file"></td>                                                 
														</tr>
														<?php }else{?>
														<tr>
															<td class="text-black font-weight-bold"><strong>รูปปก</strong></td>
                                                            <td class="text-black font-weight-bold"> <input type="file" name="top_pic" class="form-control-file"></td>                                                 
														</tr>
														<?php } ?>
													  </tbody>
												  </table>
														
													  
												
												<div class="modal-footer">
													
													<button class="btn btn-success" id="submit"><i class="glyphicon glyphicon-inbox"></i> Submit</button>
												</div>
											  </form>
											</div>
									  </div>
									</div>
								</div>
												
								  <?php
								  }
								  ?>
	<br>


		<?php

	echo "<form method='post' action='index.php?module=topic&action=multi_delete_topic_self'>"; //ส่งค่าจาก checkbox
?>	
		<div class="table-responsive table--no-card m-b-30">
			<table class="table table-borderless table-striped table-earning">
				<thead>
			<?php
	echo"<tr><th style='text-align:center;'><a href='index.php?module=topic&action=manage_topic_self&tx=$_GET[tx]'>$link</a></th>
	
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

	//echo $data [0],"-"; //การ eco array ต้องมี index
	echo "<tr><td style='text-align:center;' width='5%'><input type='checkbox' name='del_id[]' value='$top_id' $chk></td>"; 
	// echo "<td style='text-align:center;' >$top_id</td>"; 
	//echo "<td><a href='product_detail.php?id=$product_id'>$product_title</a></td>"; //แบบ GET ไม่มี $ข้างหน้า
	echo "<td style='text-align:center;'>$top_head</td>";
    echo "<td style='text-align:center;'>$top_time</td>";
    echo "<td style='text-align:center;'>$top_edit</td>";?>	
    

<?php
	echo "<td>
	<button type='button' data-toggle='modal' data-target='#check$top_id'  class='btn btn-warning' ><i class='fa fa-pencil'></i>&nbsp;</button>
	<a href='index.php?module=topic&action=delete_topic_self_single&top_id=$top_id' onclick='return confirm(\" คุณแน่ใจหรือไม่ ว่าจะลบข้อมูลผู้ใช้นี้ \")'>
	<button type='button' class='btn btn-danger' ><i class='fa fa-trash-o'></i>&nbsp;</button></a></td></tr>";
	}
	echo "</tbody></table>";
	

	echo "<p> หน้า : ";
	for($i=1;$i<=$pages;$i++){ //วนลูปตามจำนวนหน้า
		if($i==$pid){ //ถ้าตรงกับหน้าปัจจุบัน
		echo "<span style='color:red;font-weight:bold;'> [ $i ] </span>";		
		}
		else
		{
	echo"<a href='index.php?module=topic&action=manage_topic_self&pid=$i&search=$search'>[ $i ]</a>"; //สร้าง link หมายเลขหน้า
		}
	}
	echo "</p><br>";
?>
			<button type="submit" class="btn btn-danger btn-ra">
			<i class="fa  fa-recycle"></i>&nbsp; ลบแถวที่เลือก</button>
			<?php
} //ปิดเงื่อนไข else ไม่ให้เห็นหัวตาราง (บรรทัด 43)
 mysqli_close($con);
 	?>

        </div>


			