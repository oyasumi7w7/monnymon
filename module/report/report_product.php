<?php

if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='index.php'</script>";
  }
  if(empty($_POST['cate'])){
                    
    if(empty($_GET['cate'])){
    $cate="";
    }else{
    $cate=$_GET['cate'];
    }
}else{
    $cate=$_POST['cate'];
}

    if(!empty($_GET['page'])){
        if($_GET['page']=='balance'){
            $active="color:#FFD700;";
            $active1="color:white;";
        }else{
            $active="color:white;";
            $active1="color:#FFD700;";
        }
        
    }else{
        $active="color:white;";
        $active1="color:white;";
    }
?>

<meta charset="UTF-8">
<p align="center"><a style="font-size:60px; color:#A52A2A; ">รายงาน</a></p>
              <table class="table table-borderless table-striped table-earning" >
                <thead>
                    <tr>
                        <th class="text-center" style="background-color: #8B0000; border-left:solid;border-right:solid;"><a href="index.php?module=report&action=report_product" style="color:#FFD700; font-size:20;">รายงานสินค้า</a></th>
                        <th class="text-center" style="background-color: #8B0000; border-left:solid;border-right:solid;"><a href="index.php?module=report&action=report_order" style="color:white; font-size:20;">รายงานคำสั่งซื้อ</a></th>
                        <th class="text-center" style="background-color: #8B0000; border-left:solid;border-right:solid;"><a href="index.php?module=report&action=report_tour" style="color:white; font-size:20;">รายงานการแข่งขัน</a></th>
                        <th class="text-center" style="background-color: #8B0000; border-left:solid;border-right:solid;"><a href="index.php?module=report&action=report_stat" style="color:white; font-size:20;">สถิติ</a></th>
                        <th class="text-center" style="background-color: #8B0000; border-left:solid;border-right:solid;"><a href="index.php?module=report&action=report_income" style="color:white; font-size:20;">รายงานรายรับ-จ่าย</a></th>
                    </tr>
                </thead>
              </table>

<br><br>
<p align="center"><a style="font-size:30px; color:#DC143C; ">รายงานสินค้า</a></p>
<table class="table table-borderless table-striped table-earning" >
                <thead>
                    <tr>
                        <th class="text-center" style="background-color: #DC143C; border-left:solid;border-right:solid;"><a href="index.php?module=report&action=report_product&page=balance" style="<?php echo $active ?> font-size:20;">รายงานสินค้าคงเหลือ</a></th>
                        <th class="text-center" style="background-color: #DC143C; border-left:solid;border-right:solid;"><a href="index.php?module=report&action=report_product&page=stock" style="<?php echo $active1 ?> font-size:20;">รายงานสินค้าเข้าร้าน</a></th>  
                    </tr>
                </thead>
              </table>
              <br>


<?php
if(!empty($_GET["page"])) {
    switch($_GET["page"]) {
        case "balance":
?>
                <form align="center" method="post" action='index.php?module=report&action=report_product&page=balance'>
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

            <?php
            echo "<br><p align='center'><a target='_blank' href='module/report/print_stock.php?cate=$cate&page=balance' style='align: center; '><button type='button' class='btn' style='font-size:20px; color: #A52A2A; background-color:white; border-color:#A52A2A; border-width: 5px;border-radius: 8px;' >
            ออกรายงานสินค้าคงเหลือ</button></a>&nbsp; &nbsp; <br><br>";

            $cal_page=mysqli_query($con,"SELECT product_id FROM product WHERE product_category LIKE '%$cate%'  ORDER BY product_category ASC,product_name DESC " )or die("SQL Error==>".mysqli_error($con));
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
            
            $result=mysqli_query($con,"SELECT product_id,product_name,product_category,product_price,product_sprice,product_num FROM product WHERE product_category LIKE '%$cate%' ORDER BY product_category ASC,product_name DESC  LIMIT $start_rows,$rows_page")or die("Sql Error>>".mysqli_error($con));
                echo "<p> หน้า : ";
                for($p=1;$p<=$pages;$p++){ //วนลูปตามจำนวนหน้า
                    if($p==$pid){ //ถ้าตรงกับหน้าปัจจุบัน
                    echo "<span style='color:red;font-weight:bold;'> [ $p ] </span>";		
                    }
                    else
                    {
                echo"<a href='index.php?module=report&action=report_product&pid=$p&cate=$cate&page=balance'>[ $p ]</a>"; //สร้าง link หมายเลขหน้า
                    }
                }
                echo "</p><br>"; 
            
            ?>
                    <div class="table-responsive table--no-card m-b-30">
                        <table class="table table-borderless table-striped table-earning">
                            <thead>
                                <tr>
                                    <th width="5%" class="text-center">ลำดับ</th>
                                   
                                    
                                    <th width="20%" class="text-center">รายการ</th>
                                    <th width="10%" class="text-center">จำนวน</th>
                                    <th width="10%" class="text-center">ประเภท</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                        <?php
                        while(list($pro_id,$pro_name,$pro_cate,$pro_price,$pro_sprice,$pro_num)=mysqli_fetch_row($result)){
                        ?>
                        
                                <tr>
                                    <td class="text-center"><?php echo $i ?></td>
                                    
                                    
                                    <td ><?php echo $pro_name ?></td>
                                    <td class="text-center"><?php echo $pro_num ?>&nbsp;ชิ้น</td>
                                    <?php
                                        $result2=mysqli_query($con,"SELECT cate_name FROM product_category WHERE cate_id='$pro_cate'")or die 
                                        ("SQL Error2=>".mysqli_error($con));
                                        list($pro_cate)=mysqli_fetch_row($result2);
                                        ?>
                                    <td class="text-center"><?php echo $pro_cate ?></td>
                                    
                                </tr>
                        <?php  $i++;} ?>
                            </tbody>
                        </table>
                    </div>   
                    <?php
                    echo "<p> หน้า : ";
                    for($p=1;$p<=$pages;$p++){ //วนลูปตามจำนวนหน้า
                        if($p==$pid){ //ถ้าตรงกับหน้าปัจจุบัน
                        echo "<span style='color:red;font-weight:bold;'> [ $p ] </span>";		
                        }
                        else
                        {
                    echo"<a href='index.php?module=report&action=report_product&pid=$p&cate=$cate&page=balance'>[ $p ]</a>"; //สร้าง link หมายเลขหน้า
                        }
                    }
                    echo "</p>"; 
                    ?>
<?php
        break;

        case "stock":
?>
                <form align="center" method="post" action='index.php?module=report&action=report_product&page=stock'>
                    <select name="search" id="search">
                        <option value="">Year</option>
                        <?PHP for($i=0; $i<=20; $i++) {?>
                        <option value="<?PHP echo date("Y")-$i?>"><?PHP echo date("Y")-$i?></option>
                        <?PHP }?>
                    </select>
					<input type="submit" value="ค้นหารายปี" class="btn btn-success btn-ra">			
	            </form>
                <form align="center" method="post" action='index.php?module=report&action=report_product&page=stock'>
                    <input type="month" id="search" name="search" min="2020-12" value="------">
					<input type="submit" value="ค้นหารายเดือน" class="btn btn-success btn-ra">			
	            </form>
<?php 
if(!empty($_POST['search'])){
    $date = explode('-',$_POST['search']);
    $where = "WHERE  Year(stock_date_up) = ";
    $year_1=$date[0];
        if(empty($date[1])){
            $month_1='';
            $and ='';
        }else{
                $and = "AND MONTH(stock_date_up) = ";
                $month_1=$date[1];

        }

}else{
    if(!empty($_GET['year'])){
        $year_1 = $_GET['year'];
        $where = "WHERE  Year(stock_date_up) = ";
        
        if(!empty($_GET['month'])){
            $month_1 = $_GET['month'];
            $and = "AND MONTH(stock_date_up) = ";
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
                echo "<br><p align='center'><a target='_blank' href='module/report/print_stock.php?page=stock&&year=$year_1&month=$month_1' style='align: center; '><button type='button' class='btn' style='font-size:20px; color: #A52A2A; background-color:white; border-color:#A52A2A; border-width: 5px;border-radius: 8px;' >
                ออกรายงานสินค้าเข้าร้าน</button></a>&nbsp; &nbsp; <br><br>";
				?>
                <?php if(empty($date[0])){?>
                <p align="center" style="font-size:20px; color:red;">รายงานสินค้าเข้าร้านทั้งหมด</p><br>
        <?php }elseif(empty($date[1])){?>
         <p align="center" style="font-size:20px; color:red;">รายงานสินค้าเข้าร้าน ประจำปี <?php echo $year_1 ?> </p><br>
        <?php }else{?>
         <p align="center" style="font-size:20px; color:red;">รายงานสินค้าเข้าร้าน ประจำเดือน <?php echo $month?> ปี <?php echo $year_1 ?>  </p><br>
        <?php }?>
                
                <?php

                $cal_page=mysqli_query($con,"SELECT stock_id FROM stock_update $where $year_1 $and $month_1 ORDER BY stock_date_up desc,stock_id asc " )or die("SQL Error==>".mysqli_error($con));
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
            
            $result=mysqli_query($con,"SELECT * FROM stock_update $where $year_1 $and $month_1 ORDER BY stock_date_up desc,stock_id asc LIMIT $start_rows,$rows_page")or die("Sql Error>>".mysqli_error($con));     
            
            echo "<p> หน้า : ";
            for($p=1;$p<=$pages;$p++){ //วนลูปตามจำนวนหน้า
                if($p==$pid){ //ถ้าตรงกับหน้าปัจจุบัน
                echo "<span style='color:red;font-weight:bold;'> [ $p ] </span>";		
                }
                else
                {
            echo"<a href='index.php?module=report&action=report_product&pid=$p&year=$year_1&month=$month_1&page=stock'>[ $p ]</a>"; //สร้าง link หมายเลขหน้า
                }
            }
            echo "</p><br>"; 
            ?>
                    <div class="table-responsive table--no-card m-b-30">
                        <table class="table table-borderless table-striped table-earning">
                            <thead>
                                <tr>
                                    <th width="1%" class="text-center">ลำดับ</th>
                                   
                                    
                                    <th width="20%" class="text-center">รายการ</th>
                                    <th width="10%" class="text-center">จำนวน</th> 
                                    <th width="10%" class="text-center">ราคาซื้อ</th>
                                    <th width="10%" class="text-center">วันที่นำเข้า</th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php
                        while(list($stock_id,$pro_id,$pro_name,$pro_num,$buy_price,$stock_date)=mysqli_fetch_row($result)){
                        ?>
                        
                                <tr>
                                    <td class="text-center"><?php echo $i ?></td>
                                  
                                    
                                    <td><?php echo $pro_name ?></td>
                                    <td class="text-center"><?php echo $pro_num ?>&nbsp;ชิ้น</td>
                                    <td class="text-center"><?php echo number_format($buy_price, 2) ?>&nbsp;บาท</td>
                                    <td class="text-center"><?php echo $stock_date ?>&nbsp;</td>
                                </tr>
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
                    echo"<a href='index.php?module=report&action=report_product&pid=$p&year=$year_1&month=$month_1&page=stock'>[ $p ]</a>"; //สร้าง link หมายเลขหน้า
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