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
        <h1 style="font-size:30px;">ใบเสร็จรับเงิน <?php echo $_GET['o_id'] ?></h1>

        <p class="text-right">
            <b>รหัสออเดอร์ : </b> <?php echo $_GET['o_id']?><br>
            <b>วันที่ทำรายการ : </b> <?php echo DATE("d/m/Y")?><br>
        </p>
        <?php
            $member=mysqli_query($con,"SELECT m_name,m_lastname FROM member WHERE m_num ='$_GET[m_id]' ")or die("Sql Error>>".mysqli_error($con)); 
            list($m_name,$m_lastname)=mysqli_fetch_row($member);
            $info=mysqli_query($con,"SELECT order_address,order_phone,order_date,order_sent,order_track FROM order_shop WHERE order_id ='$_GET[o_id]' ")or die("Sql Error>>".mysqli_error($con)); 
            list($m_address,$m_phone,$buy,$sent,$track)=mysqli_fetch_row($info);
        ?>
        <p style="text-indent: 100px; margin-top:80px;">
            <b>ผู้รับของ</b> <span style="width: 15%;"><?php echo $m_name."&nbsp; &nbsp; ".$m_lastname ?></span>
            <b>เบอร์โทร</b> <span style="width: 15%;"><?php echo $m_phone ?></span>
            <b>วันที่สั่งซื้อ</b> <span style="width: 15%;"><?php echo date('Y-m-d', strtotime($buy)) ?></span>
            <b>วันที่จัดส่ง</b> <span style="width: 15%;"><?php echo $sent ?></span>
            
        </p>
        <p>
            <b>ที่อยู่จัดส่ง</b> <span style="width: 40%;"><?php echo $m_address ?></span>
            <b>รหัสจัดส่ง</b> <span style="width: 40%;"><?php echo $track ?></span>
        </p>

        <br><h2 style="font-size:20px;">รายละเอียด</h2><br>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="5%" class="text-center">ลำดับ</th>
                        <th width="100" class="text-center">รายการ</th>
                        <th width="20%" class="text-center">จำนวน</th>
                        <th width="100" class="text-center">ราคา /ต่อชิ้น</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                                                  	$total2=0;$numprice=0;$total_last2=0;$o_ems2p=0;$i=1;
                                                      $check=mysqli_query($con,"SELECT order_pname,order_price,order_pronum,order_ems,order_date FROM order_shop WHERE order_id ='$_GET[o_id]'
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
            
                    <tr>
                        <td class="text-center"><?php echo $i ?></td>
                        <td><?php echo $o_pname2 ?></td>
                        <td class="text-center"><?php echo $o_Pnum2 ?> ชิ้น</td>
                        <td><?php echo number_format($o_Pprice2, 2); ?> บาท</td>
                    </tr>
            <?php $i++; } ?>
                                                    <tr>
                                                        <td style="visibility:hidden;"></td><td style="visibility:hidden;"></td>
                                                      <td class="text-black font-weight-bold"><strong>ราคารวมสินค้า</strong></td>
                                                      <td class="text-black font-weight-bold"><strong><?php echo number_format($total2, 2); ?> บาท</strong></td>
                                                    </tr>
                                                      
                                                        <tr>
                                                            <td style="visibility:hidden;"></td><td style="visibility:hidden;"></td>
                                                          <td class="text-black font-weight-bold"><strong>ค่าส่ง</strong></td>
                                                          <td class="text-black font-weight-bold"><strong><?php echo number_format($o_ems2p, 2); ?> บาท</strong></td>
                                                        </tr>  
                                                     

                                                    <tr>
                                                        <td style="visibility:hidden;"></td><td style="visibility:hidden;"></td>
                                                      <td class="text-black font-weight-bold"><strong>ราคารวมส่ง</strong></td>
                                                      <td class="text-black font-weight-bold"><strong>**<?php echo number_format($total_last2, 2); ?> บาท**</strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="visibility:hidden;"></td><td style="visibility:hidden;"></td>
                                                      <td style="visibility:hidden;">
                                                      <td class="text-black font-weight-bold"><strong>**<?php echo Convert($total_last2,2); ?> **</strong></td>
                                                    </tr>
                </tbody>
            </table>
            <br>
        <p class="text-right">
        <b>ลงชื่อผู้รับเงิน</b> <span style="width: 15%;">Monnymon SHOP</span>
        </p>


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