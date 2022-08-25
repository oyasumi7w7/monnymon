<?php

if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='index.php'</script>";
  }
  if(empty($_POST['cate'])){
		$cate="";
	}else{
		$cate=$_POST['cate'];
	}
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

    if(!empty($_GET['page'])){
        if($_GET['page']=='single'){
            $active="color:#FFD700;";
            $active1="color:white;";
            $active2="color:white;";

        }elseif($_GET['page']=='all'){
            $active1="color:#FFD700;";
            $active="color:white;";
            $active2="color:white;";
        }else{
            $active2="color:#FFD700;";
            $active="color:white;";
            $active1="color:white;";
        }
    }else{
        $active2="color:white;";
            $active="color:white;";
            $active1="color:white;";
    }


?>

<meta charset="UTF-8">
<p align="center"><a style="font-size:60px; color:#A52A2A; ">รายงาน</a></p>
              <table class="table table-borderless table-striped table-earning" >
                <thead>
                    <tr>
                        <th class="text-center" style="background-color: #8B0000; border-left:solid;border-right:solid;"><a href="index.php?module=report&action=report_product" style="color:white; font-size:20;">รายงานสินค้า</a></th>
                        <th class="text-center" style="background-color: #8B0000; border-left:solid;border-right:solid;"><a href="index.php?module=report&action=report_order" style="color:#FFD700; font-size:20;">รายงานคำสั่งซื้อ</a></th>
                        <th class="text-center" style="background-color: #8B0000; border-left:solid;border-right:solid;"><a href="index.php?module=report&action=report_tour" style="color:white; font-size:20;">รายงานการแข่งขัน</a></th>
                        <th class="text-center" style="background-color: #8B0000; border-left:solid;border-right:solid;"><a href="index.php?module=report&action=report_stat" style="color:white; font-size:20;">สถิติ</a></th>
                        <th class="text-center" style="background-color: #8B0000; border-left:solid;border-right:solid;"><a href="index.php?module=report&action=report_income" style="color:white; font-size:20;">รายงานรายรับ-จ่าย</a></th>
                        
                    </tr>
                </thead>
              </table>

<br><br>
<p align="center"><a style="font-size:30px; color:#DC143C; ">รายงานคำสั่งซื้อ</a></p>
<table class="table table-borderless table-striped table-earning" >
                <thead>
                    <tr style="width:50px;  ">
                        <th class="text-center" style="background-color: #DC143C; border-left:solid;border-right:solid;"><a href="index.php?module=report&action=report_order&page=single" style="<?php echo $active ?> font-size:20;">คำสั่งซื้อรายบุคคล</a></th>
                        <th class="text-center" style="background-color: #DC143C; border-left:solid;border-right:solid;"><a href="index.php?module=report&action=report_order&page=all" style="<?php echo $active1 ?> font-size:20;">จำนวนคำสั่งซื้อรายเดือน/ปี</a></th>  
                        <th class="text-center" style="background-color: #DC143C; border-left:solid;border-right:solid;"><a href="index.php?module=report&action=report_order&page=qty" style="<?php echo $active2 ?> font-size:20;">จำนวนสินค้าที่ขายรายเดือน/ปี</a></th>  
                    </tr>
                </thead>
              </table>
              <br>


<?php
if(!empty($_GET["page"])) {
    switch($_GET["page"]) {
        case "single":
?>
                    <form method="post" action='index.php?module=report&action=report_order&page=single' >
                        <p align="center"><input style="border:solid;" type="text" name="search">&nbsp;<input type="submit" style="border:solid;" value="ค้นหา"></p>
                    </form>
                    <br>
                    
            <?php
            $cal_page=mysqli_query($con,"SELECT order_shop.order_num,order_shop.order_id,order_shop.order_memberid,order_shop.order_pid,order_shop.order_pname,order_shop.order_pronum
            ,order_shop.order_address,order_shop.order_phone,order_shop.pay_pic,order_shop.order_ems,order_shop.order_paid_status,order_shop.order_product_status,order_shop.order_date,order_shop.order_sent,order_shop.order_track 
            FROM order_shop INNER JOIN member ON order_shop.order_memberid = member.m_num 
            WHERE order_shop.order_product_status ='3' AND member.m_name LIKE '%$search%' OR member.m_lastname LIKE '%$search%' group by order_shop.order_id ORDER BY order_shop.order_date DESC" )or die("SQL Error==>".mysqli_error($con));
            $rows=mysqli_num_rows($cal_page); 
            $rows_page=10; 
            $pages=ceil($rows/$rows_page); 
            
            if(isset($_GET['pid'])){ 
                $pid=$_GET['pid']; 
                $start_rows=($pid-1)*$rows_page; 
            }
            else{ 
                $pid=1; 
                $start_rows=0; 
            }
            
            $i=1;
            $result=mysqli_query($con,"SELECT order_shop.order_num,order_shop.order_id,order_shop.order_memberid,order_shop.order_pid,order_shop.order_pname,order_shop.order_pronum
            ,order_shop.order_address,order_shop.order_phone,order_shop.pay_pic,order_shop.order_ems,order_shop.order_paid_status,order_shop.order_product_status,order_shop.order_date,order_shop.order_sent,order_shop.order_track 
            FROM order_shop INNER JOIN member ON order_shop.order_memberid = member.m_num 
            WHERE order_shop.order_product_status ='3' AND member.m_name LIKE '%$search%' OR member.m_lastname LIKE '%$search%' group by order_shop.order_id ORDER BY order_shop.order_date DESC LIMIT $start_rows,$rows_page
            ")or die("Sql Error>>".mysqli_error($con));
           
           echo "<p> หน้า : ";
           for($p=1;$p<=$pages;$p++){ //วนลูปตามจำนวนหน้า
               if($p==$pid){ //ถ้าตรงกับหน้าปัจจุบัน
               echo "<span style='color:red;font-weight:bold;'> [ $p ] </span>";		
               }
               else
               {    
           echo"<a href='index.php?module=report&action=report_order&pid=$p&page=single&search=$search'>[ $p ]</a>"; //สร้าง link หมายเลขหน้า
               }
           }
           echo "</p><br>";
            ?>
                    <div class="table-responsive table--no-card m-b-30">
                        <table class="table table-borderless table-striped table-earning">
                            <thead>

	                            <tr>
                                                <th style="text-align:center;">ลำดับ</th>
												<th style="text-align:center;">เลขที่สั่งซื้อ</th>
                                                <th style="text-align:center;">ชื่อผู้สั่ง</th>
												<th style="text-align:center;">ราคารวมส่ง</th>
												<th style="text-align:center;">ออกรายงาน</th>
                                </tr>
	
                            </thead>
                            <tbody>
                        <?php
                        while(list($o_num,$o_id,$o_memID,$o_pid,$o_pname,$o_Pprice,$o_Pnum,$o_address,$o_phone,$o_pic,$o_ems,$o_paidS,$o_proS,$o_date)=mysqli_fetch_row($result)){
                            $ems_p=0;
                        $customer=mysqli_query($con,"SELECT m_name,m_lastname FROM member WHERE m_num='$o_memID' ")or die("Sql Error1>>".mysqli_error($con));
                        list($name,$lastname)=mysqli_fetch_row($customer); 
                            $total=0;
                        ?>
                        
                            <?php 
                                echo "<tr>"; 
                                    echo "<td class='text-center'>$i</td>";
                                    echo "<td style='text-align:center;color:black;'>$o_id</td>";
                                    echo "<td style='text-align:center;color:black;'> $name  $lastname </td>";

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
							?>
                                    <td style="text-align:center;color:black;"><?php echo number_format($total_last, 2)?>&nbsp;บาท</td>
                                  <?php  echo "<td style='text-align:center;'><a target='_blank' href='module/report/order_report.php?o_id=$o_id&m_id=$o_memID' style='align: center; '>
                                    <button type='button' class='btn' style='font-size:20px; background-color:#FFA500; border-width:3px;' ><i class='fas fa fa-file' style='color:white'></i></button></a></td>";
                                echo "</tr>";
                            ?>	
                                    
                                   
                        <?php  $i++;} ?>
                            </tbody>
                        </table>
                    </div>     
                    <?php 
                    echo "<br><p> หน้า : ";
                    for($p=1;$p<=$pages;$p++){ //วนลูปตามจำนวนหน้า
                        if($p==$pid){ //ถ้าตรงกับหน้าปัจจุบัน
                        echo "<span style='color:red;font-weight:bold;'> [ $p ] </span>";		
                        }
                        else
                        {
                    echo"<a href='index.php?module=report&action=report_order&pid=$p&page=single&search=$search'>[ $p ]</a>"; //สร้าง link หมายเลขหน้า
                        }
                    }
                    echo "</p>";
                    ?>
<?php
        break;

        case "all":
?>
                <form align="center" method="post" action='index.php?module=report&action=report_order&page=all'>
                    <select name="search" id="search">
                        <option value="">Year</option>
                        <?PHP for($i=0; $i<=20; $i++) {?>
                        <option value="<?PHP echo date("Y")-$i?>"><?PHP echo date("Y")-$i?></option>
                        <?PHP }?>
                    </select>
					<input type="submit" value="ค้นหารายปี" class="btn btn-success btn-ra">			
	            </form>
                <form align="center" method="post" action='index.php?module=report&action=report_order&page=all'>
                    <input type="month" id="search" name="search" min="2020-12" value="--------">
					<input type="submit" value="ค้นหารายเดือน" class="btn btn-success btn-ra">			
	            </form>
<?php 
if(!empty($_POST['search'])){
    $date = explode('-',$_POST['search']);
    $where = "AND  Year(order_sent) = ";
    $year_1=$date[0];
        if(empty($date[1])){
            $month_1='';
            $and ='';
        }else{
                $and = "AND MONTH(order_sent) = ";
                $month_1=$date[1];

        }

}else{
    if(!empty($_GET['year'])){
        $year_1 = $_GET['year'];
        $where = "AND  Year(order_sent) = ";
        
        if(!empty($_GET['month'])){
            $month_1 = $_GET['month'];
            $and = "AND MONTH(order_sent) = ";
        }else{
            $month_1='';
            $and ='';
        }
    }else{
        $year_1='';
        $where ='';
        $month_1='';
        $and ='';
        
    }

}
 $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");   
            for($i=1;$i<13;$i++){
                if($i==$month_1){
                    $month=$strMonthCut[$i];
                }else{

                }
            }


?>
                <?php
                echo "<br><p align='center'><a target='_blank' href='module/report/print_order.php?page=all&&year=$year_1&month=$month_1' style='align: center; '><button type='button' class='btn' style='font-size:20px; color: #A52A2A; background-color:white; border-color:#A52A2A; border-width: 5px;border-radius: 8px;' >
                ออกรายงานคำสั่งซื้อ</button></a>&nbsp; &nbsp; <br><br>";
				?>
                <?php if(empty($date[0])){?>
                <p align="center" style="font-size:20px; color:red;">จำนวนคำสั่งซื้อทั้งหมด</p><br>
        <?php }elseif(empty($date[1])){?>
         <p align="center" style="font-size:20px; color:red;">จำนวนคำสั่งซื้อ ประจำปี <?php echo $year_1 ?> </p><br>
        <?php }else{?>
         <p align="center" style="font-size:20px; color:red;">จำนวนคำสั่งซื้อ ประจำเดือน <?php echo $month?> ปี <?php echo $year_1 ?>  </p><br>
        <?php }?>
                <?php

                $cal_page=mysqli_query($con,"SELECT order_id FROM order_shop WHERE order_product_status ='3' $where $year_1 $and $month_1  group by order_id ORDER BY order_sent DESC " )or die("SQL Error==>".mysqli_error($con));
            $rows=mysqli_num_rows($cal_page); 
            $rows_page=10; 
            $pages=ceil($rows/$rows_page); 
            
            if(isset($_GET['pid'])){ 
                $pid=$_GET['pid']; 
                $start_rows=($pid-1)*$rows_page; 
            }
            else{ 
                $pid=1; 
                $start_rows=0; 
            }
                ?>
                <?php
            $i=1;
            $result=mysqli_query($con,"SELECT * FROM order_shop WHERE order_product_status ='3' $where $year_1 $and $month_1  group by order_id ORDER BY order_sent DESC LIMIT $start_rows,$rows_page
            ")or die("Sql Error>>".mysqli_error($con));
           echo "<p> หน้า : ";
           for($p=1;$p<=$pages;$p++){ //วนลูปตามจำนวนหน้า
               if($p==$pid){ //ถ้าตรงกับหน้าปัจจุบัน
               echo "<span style='color:red;font-weight:bold;'> [ $p ] </span>";		
               }
               else
               {
           echo"<a href='index.php?module=report&action=report_order&pid=$p&page=all&year=$year_1&month=$month_1'>[ $p ]</a>"; //สร้าง link หมายเลขหน้า
               }
           }
           echo "</p><br>";

            ?>
                    <div class="table-responsive table--no-card m-b-30">
                        <table class="table table-borderless table-striped table-earning">
                            <thead>

	                            <tr>
                                                <th style="text-align:center;">ลำดับ</th>
												<th style="text-align:center;">เลขที่สั่งซื้อ</th>
                                                <th style="text-align:center;">ชื่อผู้สั่ง</th>
												<th style="text-align:center;">ราคารวมส่ง</th>
                                                <th style="text-align:center;">วันที่ส่ง</th>
                                </tr>
	
                            </thead>
                            <tbody>
                        <?php
                        while(list($o_num,$o_id,$o_memID,$o_pid,$o_pname,$o_Pprice,$o_Pnum,$o_address,$o_phone,$o_pic,$o_ems,$o_paidS,$o_proS,$o_date,$sent,$track)=mysqli_fetch_row($result)){
                            $ems_p=0;
                        $customer=mysqli_query($con,"SELECT m_name,m_lastname FROM member WHERE m_num='$o_memID' ")or die("Sql Error1>>".mysqli_error($con));
                        list($name,$lastname)=mysqli_fetch_row($customer); 
                            $total=0;
                        ?>
                        
                            <?php 
                                echo "<tr>"; 
                                    echo "<td class='text-center'>$i</td>";
                                    echo "<td style='text-align:center;color:black;'>$o_id</td>";
                                    echo "<td style='text-align:center;color:black;'> $name  $lastname </td>";

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
							?>
                                    <td style="text-align:center;color:black;"><?php echo number_format($total_last, 2)?>&nbsp;บาท</td>
<?php
                                    echo "<td style='text-align:center;color:black;'>$sent</td>";
                                
                                echo "</tr>";
                            ?>	
                                    
                                   
                        <?php  $i++;} ?>
                            </tbody>
                        </table>
                    </div>   
                    <?php 
                    echo "<br><p> หน้า : ";
                    for($p=1;$p<=$pages;$p++){ //วนลูปตามจำนวนหน้า
                        if($p==$pid){ //ถ้าตรงกับหน้าปัจจุบัน
                        echo "<span style='color:red;font-weight:bold;'> [ $p ] </span>";		
                        }
                        else
                        {
                    echo"<a href='index.php?module=report&action=report_order&pid=$p&page=all&year=$year_1&month=$month_1'>[ $p ]</a>"; //สร้าง link หมายเลขหน้า
                        }
                    }
                    echo "</p>";
                    ?>  
<?php
        break;

        case "qty":
?>
                <form align="center" method="post" action='index.php?module=report&action=report_order&page=qty'>
                    <select name="search" id="search">
                        <option value="">Year</option>
                        <?PHP for($i=0; $i<=20; $i++) {?>
                        <option value="<?PHP echo date("Y")-$i?>"><?PHP echo date("Y")-$i?></option>
                        <?PHP }?>
                    </select>
					<input type="submit" value="ค้นหารายปี" class="btn btn-success btn-ra">			
	            </form>
                <form align="center" method="post" action='index.php?module=report&action=report_order&page=qty'>
                    <input type="month" id="search" name="search" min="2020-12" value="">
					<input type="submit" value="ค้นหารายเดือน" class="btn btn-success btn-ra">			
	            </form>
 <?php 

if(!empty($_POST['search'])){
    $date = explode('-',$_POST['search']);
    $where = "AND  Year(order_sent) = ";
    $year_1=$date[0];
        if(empty($date[1])){
            $month_1='';
            $and ='';
        }else{
                $and = "AND MONTH(order_sent) = ";
                $month_1=$date[1];

        }

}else{
    if(!empty($_GET['year'])){
        $year_1 = $_GET['year'];
        $where = "AND  Year(order_sent) = ";
        
        if(!empty($_GET['month'])){
            $month_1 = $_GET['month'];
            $and = "AND MONTH(order_sent) = ";
        }else{
            $month_1='';
            $and ='';
        }
    }else{
        $year_1='';
        $where ='';
        $month_1='';
        $and ='';
        
    }

}
 $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");   
            for($i=1;$i<13;$i++){
                if($i==$month_1){
                    $month=$strMonthCut[$i];
                }else{

                }
            }
?>
                <?php
                echo "<br><p align='center'><a target='_blank' href='module/report/print_order.php?page=qty&&year=$year_1&month=$month_1' style='align: center; '><button type='button' class='btn' style='font-size:20px; color: #A52A2A; background-color:white; border-color:#A52A2A; border-width: 5px;border-radius: 8px;' >
                ออกรายงานสินค้าที่ขาย</button></a>&nbsp; &nbsp; <br><br>";
				?>
                 <?php if(empty($date[0])){?>
                <p align="center" style="font-size:20px; color:red;">จำนวนสินค้าที่ขายทั้งหมด</p><br>
        <?php }elseif(empty($date[1])){?>
         <p align="center" style="font-size:20px; color:red;">จำนวนสินค้าที่ขาย ประจำปี <?php echo $year_1 ?> </p><br>
        <?php }else{?>
         <p align="center" style="font-size:20px; color:red;">จำนวนสินค้าที่ขาย ประจำเดือน <?php echo $month?> ปี <?php echo $year_1 ?>  </p><br>
        <?php }?>
                <?php

                $cal_page=mysqli_query($con,"SELECT order_id FROM order_shop WHERE order_product_status ='3' $where $year_1 $and $month_1  group by order_pid ORDER BY order_pid ASC " )or die("SQL Error==>".mysqli_error($con));
            $rows=mysqli_num_rows($cal_page); 
            $rows_page=10; 
            $pages=ceil($rows/$rows_page); 
            
            if(isset($_GET['pid'])){ 
                $pid=$_GET['pid']; 
                $start_rows=($pid-1)*$rows_page; 
            }
            else{ 
                $pid=1; 
                $start_rows=0; 
            }
                ?>
                <?php
            $i=1;
            $result=mysqli_query($con,"SELECT * FROM order_shop WHERE order_product_status ='3' $where $year_1 $and $month_1  group by order_pid ORDER BY order_pid ASC LIMIT $start_rows,$rows_page
            ")or die("Sql Error>>".mysqli_error($con));
           echo "<p> หน้า : ";
           for($p=1;$p<=$pages;$p++){ //วนลูปตามจำนวนหน้า
               if($p==$pid){ //ถ้าตรงกับหน้าปัจจุบัน
               echo "<span style='color:red;font-weight:bold;'> [ $p ] </span>";		
               }
               else
               {
           echo"<a href='index.php?module=report&action=report_order&pid=$p&page=qty&year=$year_1&month=$month_1'>[ $p ]</a>"; //สร้าง link หมายเลขหน้า
               }
           }
           echo "</p><br>";

            ?>
                    <div class="table-responsive table--no-card m-b-30">
                        <table class="table table-borderless table-striped table-earning">
                            <thead>

	                            <tr>
                                                <th style="text-align:center;">ลำดับ</th>
												<th style="text-align:center;">ชื่อสินค้า</th>
                                                <th style="text-align:center;">จำนวน</th>
                                                <th style="text-align:center;">ราคาต่อชิ้น</th>
												<th style="text-align:center;">ราคารวมสินค้า</th>
                                </tr>
	
                            </thead>
                            <tbody>
                        <?php
                        while(list($o_num,$o_id,$o_memID,$o_pid,$o_pname,$o_Pprice,$o_Pnum,$o_address,$o_phone,$o_pic,$o_ems,$o_paidS,$o_proS,$o_date,$sent,$track)=mysqli_fetch_row($result)){
                            $ems_p=0;
                            $amount=0;
                            $total=0;
							$price=0;
                        ?>
                        
                            <?php 
                                echo "<tr>"; 
                                    echo "<td class='text-center'>$i</td>";
                                    
                                    echo "<td style='text-align:center;color:black;'>$o_pname</td>";
                                    

                        $result2=mysqli_query($con,"SELECT order_price ,order_pronum,order_ems FROM order_shop WHERE order_pid ='$o_pid' $where $year_1 $and $month_1")or die("Sql Error>>".mysqli_error($con));
	                    while(list($cal_price,$cal_num,$ems)=mysqli_fetch_row($result2)){
                                    if($ems==1){
			                            $ems_p=30;
                                    }elseif($ems==2){
                                        $ems_p=50;
                                    }
		                        $total=$total+($cal_price*$cal_num);
                                $amount=$cal_num+$amount;
	                    }
		                    $total_last=$total+$ems_p;
							$price=$total/$amount;
							?>
             
                                    <td style="text-align:center;color:black;"><?php echo $amount?>&nbsp;ชิ้น</td>
                                   <td style="text-align:center;color:black;"><?php echo number_format($price, 2)?>&nbsp;บาท</td>
                                    <td style="text-align:center;color:black;"><?php echo number_format($total, 2)?>&nbsp;บาท</td>

                                <?php
                                echo "</tr>";
                            ?>	
                                    
                                   
                        <?php  $i++;} ?>
                            </tbody>
                        </table>
                    </div>   
                    <?php 
                    echo "<br><p> หน้า : ";
                    for($p=1;$p<=$pages;$p++){ //วนลูปตามจำนวนหน้า
                        if($p==$pid){ //ถ้าตรงกับหน้าปัจจุบัน
                        echo "<span style='color:red;font-weight:bold;'> [ $p ] </span>";		
                        }
                        else
                        {
                    echo"<a href='index.php?module=report&action=report_order&pid=$p&page=qty&year=$year_1&month=$month_1'>[ $p ]</a>"; //สร้าง link หมายเลขหน้า
                        }
                    }
                    echo "</p>";
                    ?>  
<?php
        break;


       
    }
}
 ?>
  <script>
    document.addEventListener("DOMContentLoaded", function (event) {
        var scrollpos = sessionStorage.getItem('scrollpos');
        if (scrollpos) {
            window.scrollTo(0, scrollpos);
            sessionStorage.removeItem('scrollpos');
        }
    });

    window.addEventListener("beforeunload", function (e) {
        sessionStorage.setItem('scrollpos', window.scrollY);
    });
</script>