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
if(empty($_GET['cate'])){
    $cate="";
}else{
    $cate=$_GET['cate'];
}

if(!empty($_GET['year'])){
    $year_1 = $_GET['year'];
    $where = "WHERE Year(stock_date_up) = ";
    
    if(!empty($_GET['month'])){
        $month_1 = $_GET['month'];
        $and = "AND MONTH(stock_date_up) = ";
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
        case "balance":
?>
    <div id="print-div requiredprinting" style="background-color:white; padding-top:50px; padding-left:50px;padding-right:50px;">
    

        <img src="../../images/header-logo.png" style="width: 200px; height: auto; position: absolute; right: 85px; " alt="">

        <p style="font-size:16px; line-height: 25px; padding-left:35px;">
            <b style="font-size:18px;">ร้าน Monnymon </b> <br>
            เลขที่ 4/1-2 ถนนจ่าบ้าน ตำบลพระสิงห์ <br>
            อำเภอเมือง จังหวัดเชียงใหม่ 50200 <br>
            เบอร์โทร : 086-6561435 <br>
        </p>
        <h1>สินค้าคงเหลือ</h1>

        <p class="text-right">
            <b>วันที่ทำรายการ : </b> <?php echo DATE("d/m/Y")?><br>
        </p>
            <?php
            $i=1;
            $result=mysqli_query($con,"SELECT product_id,product_name,product_category,product_price,product_sprice,product_num FROM product  WHERE product_category LIKE '%$cate%' ORDER BY product_category ASC,product_name DESC ")or die("Sql Error>>".mysqli_error($con));
           
               
            ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="5%" class="text-center">ลำดับ</th>
                        <th width="10%" class="text-center">รหัสสินค้า</th>
                        <th width="100" class="text-center">รายการ</th>
                        <th width="50" class="text-center">จำนวน</th>
                        <th width="50" class="text-center">ประเภท</th>
                        <th width="100" class="text-center">ราคา</th>
                    </tr>
                </thead>
                <tbody>
            <?php
            while(list($pro_id,$pro_name,$pro_cate,$pro_price,$pro_sprice,$pro_num)=mysqli_fetch_row($result)){
            ?>
            
                    <tr>
                        <td class="text-center"><?php echo $i ?></td>
                        <td class="text-center"><?php echo $pro_id ?></td>
                        <td><?php echo $pro_name ?></td>
                        <td class="text-center"><?php echo $pro_num ?>&nbsp;ชิ้น</td>
                            <?php
                            $result2=mysqli_query($con,"SELECT cate_name FROM product_category WHERE cate_id='$pro_cate'")or die 
                            ("SQL Error2=>".mysqli_error($con));
                            list($pro_cate)=mysqli_fetch_row($result2);
                            ?>
                        <td class="text-center"><?php echo $pro_cate ?></td>
                        <?php if(empty($pro_sprice)){ ?>
                            <td class="text-center"><?php echo number_format($pro_price, 2) ?>&nbsp;บาท</td>
                        <?php }else{ ?>
                            <td class="text-center"><?php echo number_format($pro_sprice, 2) ?>&nbsp;บาท</td>
                        <?php } ?>
                    </tr>
            <?php $i++; } ?>
                </tbody>
            </table>
    </div>
<?php
        break;

        case "stock":
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
                เลขที่ 1/1 ถนนเมืองสมุทร ตำบลช้างม่อย <br>
                อำเภอเมือง จังหวัดเชียงใหม่ 50300 <br>
            </p>
            <?php if(empty($_GET['year'])){?>
            <h1>ยอดสินค้าเข้าร้านรวม</h1>
        <?php }elseif(empty($_GET['month'])){?>
            <h1>ยอดสินค้าเข้าร้าน  ประจำปี <?php echo $year_1 ?> </h1>
        <?php }else{?>
            <h1>ยอดสินค้าเข้าร้าน  ประจำเดือน <?php echo $month?> ปี <?php echo $year_1 ?> </h1>
        <?php }?>
    
            <p class="text-right">
                <b>วันที่ทำรายการ : </b> <?php echo DATE("d/m/Y")?><br>
            </p>
            <?php
            $i=1;
            $result=mysqli_query($con,"SELECT * FROM stock_update $where $year_1 $and $month_1 ORDER BY stock_date_up desc,stock_id asc ")or die("Sql Error>>".mysqli_error($con));      
            ?>
                    
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%" class="text-center">ลำดับ</th>
                                    <th width="10%" class="text-center">รหัสสินค้า</th>
                                    
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
                                    <td class="text-center"><?php echo $pro_id ?></td> 
                                    
                                    <td class="text-center"><?php echo $pro_name ?></td>
                                    <td class="text-center"><?php echo $pro_num ?>&nbsp;ชิ้น</td>
                                    <td class="text-center"><?php echo $buy_price ?>&nbsp;บาท</td>
                                    <td class="text-center"><?php echo $stock_date ?>&nbsp;</td>
                                </tr>
                        <?php  $i++;} ?>
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
