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
         swal("", "อัพเดทเสร็จสิ้น", "success");
         </script>';
 }
?>
<meta charset="UTF-8">
<p align="center"><a style="font-size:50px; color:#A52A2A; ">จัดการสต๊อกสินค้า</a></p>

<form method="post" action='index.php?module=item&action=warehouse' >
	<p align="center"><input type="text" name="search">&nbsp;<input type="submit" value="ค้นหา"></p>
</form>

<?php
	/*include("include/connect_db.php");
	$con = connect_db();*/
	if(empty($_GET['cate'])){
		$cate="";
	}else{
		$cate=$_GET['cate'];
	}
?>
<br>
	<!-- <form method="post" action='index.php?module=item&action=warehouse_category' >
	<button name="cate" value="1" class="btn btn-success btn-ra"><i class="fa fa-star"></i>&nbsp; การ์ด</button>
	<button name="cate" value="2" class="btn btn-success btn-ra"><i class="fa fa-star"></i>&nbsp; สลีฟ(ซองใส่การ์ด)</button>
	<button name="cate" value="3" class="btn btn-success btn-ra"><i class="fa fa-star"></i>&nbsp; กล่องใส่การ์ด</button>
	<a href="index.php?module=item&action=warehouse"><button class="btn btn-success btn-ra"><i class="fa fa-star"></i>&nbsp; ทั้งหมด</button></a>
	</form> -->

	
	<form method="post" action='index.php?module=item&action=warehouse_category'>
	<select name="cate" class="form-control-select"  style="max-width:30%; ">
                    <option value="" >-- เลือกประเภทสินค้า --</option>
                    <?php
                     $result=mysqli_query($con,"SELECT * FROM product_category ") or die(mysqli_error($con));
        
                     while(list($cate_id,$cate_name)=mysqli_fetch_row($result)){
						$select=$cate_id==$cate?"selected":"";
                         echo"<option value='$cate_id' $select>$cate_name</option>";
					 }
			
                    echo "</select>";
                    mysqli_free_result($result);
                    ?>
					
					<input type="submit" value="ค้นหา" class="btn btn-success btn-ra">
					
					
	</form>
	<a href="index.php?module=item&action=warehouse"><button class="btn btn-success btn-ra"><i class="fa fa-star"></i>&nbsp; ทั้งหมด</button></a>
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
	$result=mysqli_query($con,"SELECT product_name FROM product WHERE product_name LIKE '%$search%' ")or die("SQL Error==>".mysqli_error($con));
	
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
	
	$result=mysqli_query($con,"SELECT product_id,product_name,product_category,product_price,product_num,product_pic FROM product WHERE product_name LIKE '%$search%'
	ORDER BY product_name DESC LIMIT $start_rows,$rows_page ")or die("Sql Error>>".mysqli_error($con));
	
	
	echo "<p> หน้า : ";
	for($i=1;$i<=$pages;$i++){ //วนลูปตามจำนวนหน้า
		if($i==$pid){ //ถ้าตรงกับหน้าปัจจุบัน
		echo "<span style='color:red;font-weight:bold;'> [ $i ] </span>";		
		}
		else
		{
	echo"<a href='index.php?module=item&action=warehouse&pid=$i&search=$search&cate=$cate'>[ $i ]</a>"; //สร้าง link หมายเลขหน้า
	
		}
	}
	echo "</p>";
	
    $stock_pd=mysqli_query($con,"SELECT product_id,product_name FROM product WHERE product_name LIKE '%$search%'
	ORDER BY product_name DESC LIMIT $start_rows,$rows_page ")or die("Sql Error>>".mysqli_error($con)); 

    while(list($p_id,$p_name)=mysqli_fetch_row($stock_pd)){
?>	


<div class="modal hide fade in" style=" margin-top:100px" id="check<?php echo $p_id ?>" > 
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                          <p><?php echo $p_name ;?></p>
                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
                                    </div>
                                        <div class="modal-body ">
                                          <form action="index.php?module=item&action=stock_update" method="post" enctype="multipart/form-data" class="form-horizontal">
                                                      
                                                      
                                                  <?php
                                                 
                                                      $stock_info=mysqli_query($con,"SELECT product_num,product_sales,product_pic FROM product WHERE product_id ='$p_id'
                                                      ")or die("Sql Error>>".mysqli_error($con)); 
                                                      ?>
                                                     
                                                      <?php
                                                      list($p_num,$p_sales,$p_pic)=mysqli_fetch_row($stock_info);
                                                        ?>

                                                           <a style='text-align:center;'><img src='images/products_images/<?php echo $p_pic ?>' style='width:50%;height:auto;'></a>
                                                           <br><br>

														   <input type="hidden" id="p_id" name="p_id" value="<?php echo $p_id; ?>">
                                                           <table class="table site-block-order-table mb-5">

                                                  <thead>
                                                    
                                                  </thead> 
                                                  <tbody>
                                                    <tr>
                                                        <td class="text-black font-weight-bold"><strong>จำนวนสินค้าในคลัง</strong></td>
                                                        <td class="text-black font-weight-bold"><strong><?php echo $p_num; ?> ชิ้น</strong></td>                                                 
                                                    </tr>
                                                    <tr>
                                                        <td class="text-black font-weight-bold"><strong>ขายไปแล้ว</strong></td>
                                                        <td class="text-black font-weight-bold"><strong><?php echo $p_sales; ?> ชิ้น</strong></td>                                                 
                                                    </tr>
                                                    <tr>
                                                                <td class="text-black font-weight-bold"><a >-----</a></td>
                                                                <td class="text-black font-weight-bold"><a >-----</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-black font-weight-bold"><strong>จำนวนสินค้าที่จะเพิ่ม</strong></td>
                                                        <td class="text-black font-weight-bold"><strong><input type="text" name="num" value="" maxlength = "3" onkeypress="return isNumber(event)" required style="width: 50%" class="form-control">ชิ้น</strong></td>                                                 
                                                    </tr>
													<tr>
                                                        <td class="text-black font-weight-bold"><strong>ค่าใช้จ่าย</strong></td>
                                                        <td class="text-black font-weight-bold"><strong><input type="text" name="consum" value="" maxlength = "4" onkeypress="return isNumber(event)" required style="width: 50%" class="form-control">บาท</strong></td>                                                 
                                                    </tr>
                                                    
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
		<div class="table-responsive table--no-card m-b-30">
			<table class="table table-borderless table-striped table-earning">
				<thead>
			<?php
	echo"<tr>
	<th style='text-align:center;' width='15%'>รูปสินค้า</th>
	<th style='text-align:center;' >ชื่อสินค้า</th>
	<th style='text-align:center;' >ประเถทสินค้า</th>
	<th style='text-align:center;' width='5%'>คงเหลือ</th>
	<th style='text-align:center;' width='5%'></th></tr>";
	
	// <th style='text-align:center;' width='5%'><a href='index.php?module=item&action=warehouse&tx=$_GET[tx]'>$link</a></th>
	
    // <th style='text-align:center;' width='5%'>ราคา</th>
?>	
				</thead>
	<tbody>
	<?php
	while(list($pro_id,$pro_name,$pro_cate,$pro_price,$pro_num,$pro_pic)=mysqli_fetch_row($result)){
	//echo $data [0],"-"; //การ eco array ต้องมี index
	// echo "<tr><td style='text-align:center;'><input type='checkbox' name='del_id[]' value='$pro_id' $chk></td>"; 
	echo "<td style='text-align:center;'><img src='images/products_images/$pro_pic' style='width:100px;height:100px;'></td>";
	echo "<td style='text-align:center;'>$pro_name</td>"; 
		$result2=mysqli_query($con,"SELECT cate_name FROM product_category WHERE cate_id='$pro_cate'")or die 
            ("SQL Error2=>".mysqli_error($con));
		list($pro_cate)=mysqli_fetch_row($result2);
						
	echo "<td style='text-align:center;'> $pro_cate </td>";
	?>	
	

<?php
	// echo "<td style='text-align:center;'>$pro_price</td>";
    if($pro_num==0){
        echo "<td style='text-align:center; color:red;'>สินค้าหมด</td>";
    }else{
        echo "<td style='text-align:center;'>$pro_num ชิ้น</td>";
    }

	echo "<td style='text-align:center;'>
   
	<button type='button' data-toggle='modal' data-target='#check$pro_id'  class='btn btn-warning' ><i class='fa fa-pencil'></i>&nbsp;</button></td></tr>";
	// echo "<td style='text-align:center;'>
	// <a href='index.php?module=item&action=edit_item_form&id=$pro_id'><button type='button' class='btn btn-warning' ><i class='fa fa-pencil'></i>&nbsp;</button></a>
	// <a href='index.php?module=item&action=delete_item_single&id=$pro_id' onclick='return confirm(\" คุณแน่ใจหรือไม่ ว่าจะลบสินค้าชิ้นนี้ \")'>
	// <button type='button' class='btn btn-danger' ><i class='fa fa-trash-o'></i>&nbsp;</button></a></td></tr>";
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
		echo"<a href='index.php?module=item&action=warehouse&pid=$i&search=$search&cate=$cate'>[ $i ]</a>"; //สร้าง link หมายเลขหน้า
	}
}
echo "</p><br>";

?>
<!-- <button type="submit" class="btn btn-danger btn-ra">
			<i class="fa  fa-recycle"></i>&nbsp; ลบแถวที่เลือก</button> -->
			
			