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
if(!empty($_POST['search'])){
    $date = explode('-',$_POST['search']);
    $where = "AND  Year(order_sent) = ";
    $where2 = "WHERE  Year(stock_date_up) = ";
    $year_1=$date[0];
        if(empty($date[1])){
            $month_1='';
            $and ='';
            $and2 ='';
        }else{
                $and = "AND MONTH(order_sent) = ";
                $and2 = "AND MONTH(stock_date_up) = ";
                $month_1=$date[1];

        }

}else{
   
        $year_1='';
        $where ='';
        $month_1='';
        $and ='';
        $where2 ='';
        $and2 ='';
}


$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");   
for($i=1;$i<13;$i++){
    if($i==$month_1){
        $month=$strMonthCut[$i];
    }else{

    }
}

?>
    <p align="center" class="text-center print" style="padding: 20px; ">
        <button onclick="return window.print();" type="button" style="padding: 20px;"  class="btn btn-primary"><i class="fa fa-print"></i>
            พิมพ์
        </button>
    </p>

    <div id="print-div requiredprinting" style="background-color:white; padding-top:50px; padding-left:50px;padding-right:50px;">
    

        <img src="../../images/header-logo.png" style="width: 200px; height: auto; position: absolute; right: 85px; " alt="">

        <p style="font-size:16px; line-height: 25px; padding-left:35px;">
            <b style="font-size:18px;">ร้าน Monnymon </b> <br>
            เลขที่ 4/1-2 ถนนจ่าบ้าน ตำบลพระสิงห์ <br>
            อำเภอเมือง จังหวัดเชียงใหม่ 50200 <br>
            เบอร์โทร : 086-6561435 <br>
        </p>
        <?php if(empty($date[0])){?>
            <h1>รายงานรายรับ-จ่าย</h1>
        <?php }elseif(empty($date[1])){?>
            <h1>รายงานรายรับ  ประจำปี <?php echo $year_1 ?> </h1>
        <?php }else{?>
            <h1>รายงานรายรับ  ประจำเดือน <?php echo $month?> ปี <?php echo $year_1 ?> </h1>
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
                                            <tr>
                                                <td style="text-align:center;"></td>
                                                <td style="font-size:20px;border-bottom:solid;"><b>รายรับ</b></td>
												<td style="text-align:center;"></td>
                                                <td style="text-align:center;"></td>
												<td style="text-align:center;"></td>
                                            </tr>
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
                                    

                        $result2=mysqli_query($con,"SELECT order_price ,order_pronum,order_ems FROM order_shop WHERE order_pid ='$o_pid' $where $year_1 $and $month_1 ")or die("Sql Error>>".mysqli_error($con));
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
                                    echo "<td style='text-align:center;color:black;'>$amount&nbsp;ชิ้น</td>";
                                    ?>
                                    <td style="color:black;"><?php echo number_format($total, 2); ?> บาท</td> 
                                <?php
                                echo "</tr>";
                            ?>	
                                                    
                        <?php  $i++;} ?>
                                                    <tr>
              
                                                    <td style="text-align:center;"></td><td style="text-align:center;"></td><td style="text-align:center;"></td>
                                                        <td class="text-black font-weight-bold"><strong>รายรับรวม</strong></td>
                                                        <td class="text-black font-weight-bold"><strong><?php echo number_format($total_last, 2); ?> บาท</strong></td>
                                                    </tr>
                                                    <tr>
              
                                                    <td style="text-align:center;"></td><td style="text-align:center;"></td><td style="text-align:center;"></td>
                                                        <td style="text-align:center;"></td>
                                                        <td class="text-black font-weight-bold"><strong><?php echo Convert($total_last,2); ?> </strong></td>
                                                    </tr>

                        <?php
                        $total_buy=0;
                        $result=mysqli_query($con,"SELECT * FROM stock_update $where2 $year_1 $and2 $month_1 ORDER BY stock_date_up desc,stock_id asc ")or die("Sql Error>>".mysqli_error($con));      
                        $total2=0;
            ?>
                                <tr>
                                                <td style="text-align:center;"></td>
                                                <td style="font-size:20px;border-bottom:solid;"><b>รายจ่าย</b></td>
												<td style="text-align:center;"></td>
                                                <td style="text-align:center;"></td>
												<td style="text-align:center;"></td>
                                </tr>

                        <?php
                        while(list($stock_id,$pro_id,$pro_name,$pro_num,$buy_price,$stock_date)=mysqli_fetch_row($result)){
                        ?>
                        
                                <tr>
                                    <td class="text-center"><?php echo $i ?></td>
                                    <td class="text-center"><?php echo $pro_id ?></td> 
                                    
                                    <td class="text-center"><?php echo $pro_name ?></td>
                                    <td class="text-center"><?php echo $pro_num ?>&nbsp;ชิ้น</td>
                                    <td style="color:black;"><?php echo number_format($buy_price, 2); ?> บาท</td> 
    
                                </tr>
                                <?php
                                $total_buy=$total_buy+$buy_price;
                                ?>
                        <?php  $i++;} ?>
                                                    <tr>
                                                        <td style="text-align:center;"></td><td style="text-align:center;"></td><td style="text-align:center;"></td>
                                                        <td class="text-black font-weight-bold"><strong>รายจ่ายรวม</strong></td>
                                                        <td class="text-black font-weight-bold"><strong><?php echo number_format($total_buy, 2); ?> บาท</strong></td>
                                                    </tr>
                                                    <tr>
              
                                                    <td style="text-align:center;"></td><td style="text-align:center;"></td><td style="text-align:center;"></td>
                                                        <td style="text-align:center;"></td>
                                                        <td class="text-black font-weight-bold"><strong><?php echo Convert($total_buy,2); ?> </strong></td>
                                                    </tr>
                            </tbody>
                        </table>



    </div>
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
<?php
function Convert($amount_number)
{
    $amount_number = number_format($amount_number, 2, ".","");
    $pt = strpos($amount_number , ".");
    $number = $fraction = "";
    if ($pt === false) 
        $number = $amount_number;
    else
    {
        $number = substr($amount_number, 0, $pt);
        $fraction = substr($amount_number, $pt + 1);
    }
    
    $ret = "";
    $baht = ReadNumber ($number);
    if ($baht != "")
        $ret .= $baht . "บาท";
    
    $satang = ReadNumber($fraction);
    if ($satang != "")
        $ret .=  $satang . "สตางค์";
    else 
        $ret .= "ถ้วน";
    return $ret;
}
 
function ReadNumber($number)
{
    $position_call = array("แสน", "หมื่น", "พัน", "ร้อย", "สิบ", "");
    $number_call = array("", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");
    $number = $number + 0;
    $ret = "";
    if ($number == 0) return $ret;
    if ($number > 1000000)
    {
        $ret .= ReadNumber(intval($number / 1000000)) . "ล้าน";
        $number = intval(fmod($number, 1000000));
    }
    
    $divider = 100000;
    $pos = 0;
    while($number > 0)
    {
        $d = intval($number / $divider);
        $ret .= (($divider == 10) && ($d == 2)) ? "ยี่" : 
            ((($divider == 10) && ($d == 1)) ? "" :
            ((($divider == 1) && ($d == 1) && ($ret != "")) ? "เอ็ด" : $number_call[$d]));
        $ret .= ($d ? $position_call[$pos] : "");
        $number = $number % $divider;
        $divider = $divider / 10;
        $pos++;
    }
    return $ret;
}
?>