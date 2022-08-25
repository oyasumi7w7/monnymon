
<?php
if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']>2 ){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='main.php'</script>";
  }

  if(empty($_GET['do'])){
    $do="";
 }else{
      $do=$_GET['do'];
 }

 if($do==1){
   echo '<script type="text/javascript">
         swal("", "ส่งหลักฐานแล้ว โปรดรอการตรวจสอบ", "success");
         </script>';
 }elseif($do==2){
    echo '<script type="text/javascript">
    swal("", "กรุณาใส่หลักฐานการชำระ", "error");
    </script>';
 }
?>
<meta charset="UTF-8">
<p align="center"><a style="font-size:50px; color:#A52A2A; ">รายการสั่งซื้อของฉัน</a></p>
<form method="post" action='index.php?module=order&action=list_order' >
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
	$result=mysqli_query($con,"SELECT order_id FROM order_shop WHERE order_id LIKE '%$search%' AND order_memberid ='$num'  group by order_id " )or die("SQL Error==>".mysqli_error($con));
	
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
	
	$result=mysqli_query($con,"SELECT * FROM order_shop WHERE order_id LIKE '%$search%' AND order_memberid ='$num' group by order_id ORDER BY order_id DESC LIMIT $start_rows,$rows_page
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
	echo"<a href='index.php?module=order&action=list_order&pid=$i&search=$search'>[ $i ]</a>"; //สร้าง link หมายเลขหน้า
		}
	}
	echo "</p>";
	

?>	
<?php
                                                      $Order_ID=mysqli_query($con,"SELECT order_id FROM order_shop WHERE order_memberid ='$num' ORDER BY order_id DESC LIMIT $start_rows,$rows_page
                                                      ")or die("Sql Error>>".mysqli_error($con)); 
                                                      ?>
                                                     
                                                      <?php
                                                      while(list($or_id)=mysqli_fetch_row($Order_ID)){
                                                       
?>
                                                   
<div class="modal hide fade in" style=" margin-top:100px" id="check<?php echo $or_id ?>" > 
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                          <p>รายการสินค้าออเดอร์นี้</p>
                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
                                    </div>
                                        <div class="modal-body ">
                                          <form action="index.php?module=order&action=sent_check" method="post" enctype="multipart/form-data" class="form-horizontal">
                                                      
                                                      <table class="table site-block-order-table mb-5">
                                                  <thead>
                                                    <tr>
                                                      <th>Product</th>
                                                      <th>Total</th>
                                                    </tr>
                                                  </thead>
												  <tbody>
                                                  <?php
                                                  	$total2=0;$numprice=0;$total_last2=0;$o_ems2p=0;
                                                      $check=mysqli_query($con,"SELECT order_pname,order_price,order_pronum,order_ems,order_date FROM order_shop WHERE order_id ='$or_id'
                                                      ")or die("Sql Error>>".mysqli_error($con)); 
                                                      ?>
                                                     
                                                      <?php
                                                      while(list($o_pname2,$o_Pprice2,$o_Pnum2,$o_ems2,$o_date2)=mysqli_fetch_row($check)){
                                                        if($o_ems2==1){
                                                          $o_ems2p=30;
                                                        }elseif($o_ems2==2){
                                                          $o_ems2p=50;
                                                        }
                                                        $numprice=$o_Pprice2*$o_Pnum2;
                                                        $total2=$total2+($o_Pprice2*$o_Pnum2);
                                                      
                                                      
                                                      
                                                        $total_last2=$total2+$o_ems2p;

                                                 ?>
												 <input type="hidden" id="or_id" name="or_id" value="<?php echo $or_id; ?>">
                                                  
                                                    <tr>
                                                      <td><?php echo $o_pname2; ?><strong class="mx-2">x</strong> <?php echo $o_Pnum2; ?></td>
                                                      <td><?php echo number_format($numprice, 2); ?></td>
                                                    </tr>
                                                    <?php 
                                                  } 
                                                  ?>
                                                    <tr>
                                                      <td class="text-black font-weight-bold"><strong>Subtotal</strong></td>
                                                      <td class="text-black font-weight-bold"><strong><?php echo number_format($total2, 2); ?> บาท</strong></td>
                                                    </tr>
                                                      
                                                        <tr>
                                                          <td class="text-black font-weight-bold"><strong>Shipping cost</strong></td>
                                                          <td class="text-black font-weight-bold"><strong><?php echo number_format($o_ems2p, 2); ?> บาท</strong></td>
                                                        </tr>  
                                                     

                                                    <tr>
                                                      <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                                                      <td class="text-black font-weight-bold"><strong><?php echo number_format($total_last2, 2); ?> บาท</strong></td>
                                                    </tr>

													<tr>
                                                                <td class="text-black font-weight-bold"><a >-----</a></td>
                                                                <td class="text-black font-weight-bold"><a >-----</a></td>
                                                    </tr>

													<tr>
                                                                <td class="text-black font-weight-bold"><strong>ใส่หลักฐานการชำระ</strong></td>
                                                                <td class="text-black font-weight-bold"> <input type="file" name="slip" class="form-control-file"></td>
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

<div class="row m-t-30">
  <div class="col-md-12">
            <!-- DATA TABLE-->
    <div class="table-responsive m-b-40">
			<table id="main-table" class="table table-borderless table-data3">
				<thead>
			                <?php
	                      echo"<tr>
												<th style='text-align:center;'>เลขที่สั่งซื้อ</th>
                        						<th style='text-align:center;'>วันที่สั่ง</th>
												<th style='text-align:center;'>ราคารวม</th>
												<th style='text-align:center;'>สถานะการชำระ</th>
												<th style='text-align:center;'>สถานะการจัดส่ง</th></tr>";
                      ?>	
				</thead>
				
	      <tbody>
	<?php
	
	while(list($o_num,$o_id,$o_memID,$o_pid,$o_pname,$o_Pprice,$o_Pnum,$o_address,$o_phone,$o_pic,$o_ems,$o_paidS,$o_proS,$o_date)=mysqli_fetch_row($result)){
	//echo $data [0],"-"; //การ eco array ต้องมี index
	$ems_p=0;

	$total=0;
	
		if($o_paidS==1){
			$status = "<td style='text-align:center; '><button data-toggle='modal' data-target='#check$o_id'  class='btn btn-info'>ส่งหลักฐาน</button></td>" ;
		}elseif($o_paidS==2){
			$status = "<td style='text-align:center; color:#1E90FF;'>รอตรวจสอบการชำระ</td>";
		}else{
			$status = "<td style='text-align:center; color:#228B22;'>ชำระแล้ว</td>" ;
		}

			if($o_proS==1){
				$Pstatus = "<td style='text-align:center;color:#8FBC8F;'>รอชำระ</td>" ;
			}elseif($o_proS==2){
				$Pstatus = "<td style='text-align:center; color:#1E90FF;'>รอการจัดส่ง</td>";
			}else{
				$Pstatus = "<td style='text-align:center; color:#DAA520;'>สินค้าจัดส่งแล้ว</td>" ;
				$Pstatus = "<td style='text-align:center;'><button data-toggle='modal' data-target='#transport$o_id'  class='btn' style='color:white; background-color:#DAA520;'>ดูรหัสจัดส่ง</button>
				<a target='_blank' href='module/report/order_report.php?o_id=$o_id&m_id=$num' style='align: center; '><button type='button' class='btn' style='font-size:20px; background-color:#FFA500; border-width:3px;' ><i class='fas fa fa-file' style='color:white'></i></button></a>
				</td>" ;
			}

	?>
                            



										<?php 
	echo "<tr>"; 
	echo "<td style='text-align:center;'>$o_id</td>";
	echo "<td style='text-align:center;'>$o_date</td>"; 
	?>	
	
	
<?php

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
	

	echo "$status";
   
	echo "$Pstatus";
echo"</tr>";
?>

<?php
	}

 echo " </tbody>";    
		echo "</table>"; 	
 	 
    
	?>

   
     <br>                         
  <?php
  
  echo "<p> หน้า : ";
  for($i=1;$i<=$pages;$i++){ //วนลูปตามจำนวนหน้า
	  if($i==$pid){ //ถ้าตรงกับหน้าปัจจุบัน
	  echo "<span style='color:red;font-weight:bold;'> [ $i ] </span>";		
	  }
	  else
	  {
  echo"<a href='index.php?module=order&action=list_order&pid=$i&search=$search'>[ $i ]</a>"; //สร้าง link หมายเลขหน้า
	  }
  }
  echo "</p>";
 
} 

 ?>
 	
      
         	
    </div>	
  </div> 
  
          
</div>
<?php
                                                      $Order_ID=mysqli_query($con,"SELECT order_id,order_track FROM order_shop WHERE order_memberid ='$num' ORDER BY order_id DESC LIMIT $start_rows,$rows_page
                                                      ")or die("Sql Error>>".mysqli_error($con)); 
                                                      ?>
                                                     
                                                      <?php
                                                      while(list($or_id,$track)=mysqli_fetch_row($Order_ID)){
                                                       
?>
                                                   
							<div class="modal hide fade in" style=" margin-top:100px" id="transport<?php echo $or_id ?>" > 
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                          <p>รายการสินค้าออเดอร์นี้</p>
                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
                                    </div>
                                        <div class="modal-body ">
                                          
										  <input type="hidden" id="or_id" name="or_id" value="<?php echo $or_id; ?>">
                                                      <table class="table site-block-order-table mb-5">
                                                  <thead>
                                                    <tr>
                                                      <th></th>
                                                      <th></th>
                                                    </tr>
                                                  </thead>
												  <tbody>

												  <tr>
															<td class="text-black font-weight-bold">รหัสขนส่ง</td>
															<td class="text-black font-weight-bold" style="background-color: #A9A9A9;"> <input type="text" id="code" name="code" style="text-align:center;" value="<?php echo $track ?>" readonly></td>
												  </tr>
                                                  </tbody>
                                              			</table>
                                        </div>
                                  </div>
                                </div>
                              </div>
                              <?php
                              }
                              ?>
                             

<?php
          mysqli_close($con);	
          ?>
