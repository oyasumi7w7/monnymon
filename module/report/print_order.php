<?php
date_default_timezone_set("Asia/Bangkok");

include("../../include/connect_db.php");
$con=connect_db();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>รายงาน</title>
    <link rel="stylesheet" href="fonts/thsarabunnew.css" /> 
    <link href="../../+-css/font-face.css" rel="stylesheet" media="all">
  <link rel="../../stylesheet" href="css/bootstrap.min.css">
  <link href="../../css/font-awesome/css/font-awesome.min.css" rel="stylesheet" >
  <link href="../../vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
  <!-- Bootstrap CSS-->
  <link href="../../vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
  <!-- Vendor CSS-->
  <link href="../../vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="../../vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="../../vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="../../vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="../../vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="../../vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../../vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
  <!-- Main CSS-->
  <link href="css/theme.css" rel="stylesheet" media="all">

    <style>
        * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box
        }

        #print-div {
            position: relative;
            height: auto;
            width: 210mm;
            min-height: 250mm;
            margin: 20px auto 20px auto;
            border: 1px solid #f1f1e3;
            padding: 20px 40px;
            line-height: 20px;
            overflow: hidden;
        }

        h1 {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            padding-top: 20px;
            line-height: 30px;
        }

        h2 {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            padding-bottom: 2px;
            line-height: 30px;
            font-weight: normal;
        }

        span {
            padding: 0 0 0 10px;
            border-bottom: 1px dashed #000;
            display: inline-block;
            text-indent: 0px;
        }

        .sen {
            width: 300px;
            height: 75px;
            font-size: 12px;
            text-align: center;
            line-height: 18px;
            padding-top: 20px;
            clear: both;
        }

        .bor_titel {
            width: 49%;
            border: 2px solid #000;
            border-radius: 20px;
            padding: 20px 10px;
            margin-bottom: 30px;
        }

        table.tb_title {
            width: 100%;
            height: 80px;
        }

        @media print {
            #print-div {
                border: none;
                height: 205mm;
            }

            .print {
                display: none;
            }
        }

        @media print {
            .panel-heading {
                display: none
            }
        }
        @media screen,print
  {
   div#requiredprinting{ ; }
  }
        
    </style>
</head>

<body style="font-family: 'THSarabunNew', sans-serif;">
<?php

if(!empty($_GET['year'])){
    $year_1 = $_GET['year'];
    $where = "AND  Year(order_sent) = ";
    
    if(!empty($_GET['month'])){
        $month_1 = $_GET['month'];
        $and = "AND MONTH(order_sent) = ";
    }else{
        $month_1='';
        $and ='';
        $month='';
    }
}else{
    $year_1='';
    $where ='';
    $month_1='';
    $and ='';

}
?>

    <p align="center" class="text-center print" style="padding: 20px; ">
        <button onclick="return window.print();" type="button" style="padding: 20px;"  class="btn btn-primary"><i class="fa fa-print"></i>
            พิมพ์
        </button>
    </p>

<?php
if(!empty($_GET["page"])) {
    switch($_GET["page"]) {
        case "all":
            $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");   
            for($i=1;$i<13;$i++){
                if($i==$month_1){
                    $month=$strMonthCut[$i];
                }else{

                }
            }
            
?>

    <div id="print-div requiredprinting" style="background-color:white; padding-top:50px; padding-left:50px;padding-right:50px;">
    

        <img src="../../images/header-logo.png" style="width: 200px; height: auto; position: absolute; right: 85px; " alt="">

        <p style="font-size:16px; line-height: 25px; padding-left:35px;">
            <b style="font-size:18px;">ร้าน Monnymon </b> <br>
            เลขที่ 4/1-2 ถนนจ่าบ้าน ตำบลพระสิงห์ <br>
            อำเภอเมือง จังหวัดเชียงใหม่ 50200 <br>
            เบอร์โทร : 086-6561435 <br>
        </p>
        <?php if(empty($_GET['year'])){?>
            <h1>คำสั่งซื้อทั้งหมด</h1>
        <?php }elseif(empty($_GET['month'])){?>
            <h1>คำสั่งซื้อ  ประจำปี <?php echo $year_1 ?> </h1>
        <?php }else{?>
            <h1>คำสั่งซื้อ  ประจำเดือน <?php echo $month?> ปี <?php echo $year_1 ?> </h1>
        <?php }?>
        <p class="text-right">
            <b>วันที่ทำรายการ : </b> <?php echo DATE("d/m/Y")?><br>
        </p>
            <?php
            $i=1;
            $result=mysqli_query($con,"SELECT * FROM order_shop WHERE order_product_status ='3' $where $year_1 $and $month_1  group by order_id ORDER BY order_sent DESC 
            ")or die("Sql Error>>".mysqli_error($con));
           
               
            ?>
            <table class="table table-bordered">
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
                                    echo "<td style='text-align:center;color:black;'>$total_last</td>";
                                    echo "<td style='text-align:center;color:black;'>$sent</td>";
                                
                                echo "</tr>";
                            ?>	
            <?php $i++; } ?>
                </tbody>
            </table>
    </div>
<?php
        break;

        case "qty":
            $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");   
            for($i=1;$i<13;$i++){
                if($i==$month_1){
                    $month=$strMonthCut[$i];
                }else{

                }
            }
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
?>
    <div id="print-div requiredprinting" style="background-color:white; padding-top:50px; padding-left:50px;padding-right:50px;">
    

            <img src="../../images/header-logo.png" style="width: 200px; height: auto; position: absolute; right: 85px; " alt="">
    
            <p style="font-size:16px; line-height: 25px; padding-left:35px;">
                <b style="font-size:18px;">ร้าน Monnymon </b> <br>
                เลขที่ 1/1 ถนนเมืองสมุทร ตำบลช้างม่อย <br>
                อำเภอเมือง จังหวัดเชียงใหม่ 50300 <br>
            </p>
            <?php if(empty($_GET['year'])){?>
            <h1>สินค้าที่ขายออกไปทั้งหมด</h1>
        <?php }elseif(empty($_GET['month'])){?>
            <h1>สินค้าที่ขาย ประจำปี <?php echo $year_1 ?> </h1>
        <?php }else{?>
            <h1>สินค้าที่ขาย ประจำเดือน <?php echo $month?> ปี <?php echo $year_1 ?> </h1>
        <?php }?>
    
            <p class="text-right">
                <b>วันที่ทำรายการ : </b> <?php echo DATE("d/m/Y")?><br>
            </p>
            <?php
            $i=1;
            $result=mysqli_query($con,"SELECT * FROM order_shop WHERE order_product_status ='3' $where $year_1 $and $month_1  group by order_pid ORDER BY order_pid ASC ")or die("Sql Error>>".mysqli_error($con));      
            ?>
                    
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                                <th style="text-align:center;">ลำดับ</th>
                                                <th style="text-align:center;">รหัสสินค้า</th>
												<th style="text-align:center;">ชื่อสินค้า</th>
                                                <th style="text-align:center;">จำนวน</th>
												<th style="text-align:center;">ราคารวมสินค้า</th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php
                         $total_last=0;
                         while(list($o_num,$o_id,$o_memID,$o_pid,$o_pname,$o_Pprice,$o_Pnum,$o_address,$o_phone,$o_pic,$o_ems,$o_paidS,$o_proS,$o_date,$sent,$track)=mysqli_fetch_row($result)){
                            $amount=0;
                            $total=0;
                        ?>
                        
                        <?php 
                                echo "<tr>"; 
                                    echo "<td class='text-center'>$i</td>";
                                    echo "<td style='text-align:center;color:black;'>$o_pid</td>";
                                    echo "<td style='text-align:center;color:black;'>$o_pname</td>";
                                    

                        $result2=mysqli_query($con,"SELECT order_price ,order_pronum,order_ems FROM order_shop WHERE order_pid ='$o_pid'")or die("Sql Error>>".mysqli_error($con));
	                    while(list($cal_price,$cal_num,$ems)=mysqli_fetch_row($result2)){
                                    if($ems==1){
			                            $ems_p=30;
                                    }elseif($ems==2){
                                        $ems_p=50;
                                    }
		                        $total=$total+($cal_price*$cal_num);
                                $amount=$cal_num+$amount;
	                    }
		                    $total_last=$total_last+$total;
                                    echo "<td style='text-align:center;color:black;'>$amount</td>";
                                    ?>
                                    <td style="color:black;"><?php echo number_format($total, 2); ?> บาท</td> 
                                <?php
                                echo "</tr>";
                            ?>	
                                                    
                        <?php  $i++;} ?>
                                                    <tr>
              
                                                        <td style="visibility:hidden;"></td><td style="visibility:hidden;"></td><td style="visibility:hidden;"></td>
                                                        <td class="text-black font-weight-bold"><strong>ราคารวมสินค้า</strong></td>
                                                        <td class="text-black font-weight-bold"><strong><?php echo number_format($total_last, 2); ?> บาท</strong></td>
                                                    </tr>
                            </tbody>
                        </table>
                    

    </div>
<?php    
        break;
    }
}
?>
    <script src="vendor/jquery-3.2.1.min.js"></script>
  <!-- Bootstrap JS-->
  <script src="vendor/bootstrap-4.1/popper.min.js"></script>
  <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
  <!-- Vendor JS       -->
  <script src="vendor/slick/slick.min.js">
  </script>
  <script src="vendor/wow/wow.min.js"></script>
  <script src="vendor/animsition/animsition.min.js"></script>
  <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
  </script>
  <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
  <script src="vendor/counter-up/jquery.counterup.min.js">
  </script>
  <script src="vendor/circle-progress/circle-progress.min.js"></script>
  <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="vendor/chartjs/Chart.bundle.min.js"></script>
  <script src="vendor/select2/select2.min.js">
  </script>
  <!-- Main JS-->
  <script src="js/main.js"></script>
</body>
</html>
