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

<?php
if(!empty($_GET["page"])) {
    switch($_GET["page"]) {
        case "chk_tour":
            $t_id=$_GET['tid'];
            $name=mysqli_query($con,"SELECT tour_name FROM tournament WHERE tour_no = '$t_id' ")
            or die("Sql Error>>".mysqli_error($con));
            list($t_name)=mysqli_fetch_row($name);
?>

    <div id="print-div requiredprinting" style="background-color:white; padding-top:50px; padding-left:50px;padding-right:50px;">
    

        <img src="../../images/header-logo.png" style="width: 200px; height: auto; position: absolute; right: 85px; " alt="">

        <p style="font-size:16px; line-height: 25px; padding-left:35px;">
            <b style="font-size:18px;">ร้าน Monnymon </b> <br>
            เลขที่ 4/1-2 ถนนจ่าบ้าน ตำบลพระสิงห์ <br>
            อำเภอเมือง จังหวัดเชียงใหม่ 50200 <br>
            เบอร์โทร : 086-6561435 <br>
        </p>
            <h1>รายการ  <?php echo $t_name;?></h1>

        <p class="text-right">
            <b>วันที่ทำรายการ : </b> <?php echo DATE("d/m/Y")?><br>
        </p>
            <?php
            $i=1;
            $result=mysqli_query($con,"SELECT player_id,player_name,player_lastname,day_regis FROM tour_player WHERE tour_no = '$t_id' ")
            or die("Sql Error>>".mysqli_error($con));
           
               
            ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                    <th style="text-align:center;">ลำดับ</th>
                    <th style="text-align:center;">ชื่อผู้เข้าแข่งขัน</th>
                    <th style="text-align:center;">วันที่สมัคร</th>
                    </tr>
                </thead>
                <tbody>
            <?php
            	while(list($p_id,$p_name,$p_lastname,$p_regis)=mysqli_fetch_row($result)){
            ?>
            
            <?php 
                                echo "<tr>"; 
                                    echo "<td class='text-center'>$i</td>";
                                    echo "<td style='text-align:center;color:black;'> $p_name  $p_lastname </td>";
                                    echo "<td style='text-align:center;color:black;'>$p_regis</td>";
                                echo "</tr>";
                            ?>	
            <?php $i++; } ?>
                </tbody>
            </table>
    </div>
<?php
        break;

        case "tour_num":
            
            if(!empty($_GET['year'])){
                $year_1 = $_GET['year'];
                $where = "WHERE  Year(tour_start) = ";
                
                if(!empty($_GET['month'])){
                    $month_1 = $_GET['month'];
                    $and = "AND MONTH(tour_start) = ";
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
            <h1>รายงานรายการแข่งทั้งหมด</h1>
        <?php }elseif(empty($_GET['month'])){?>
            <h1>รายงานรายการแข่ง ประจำปี <?php echo $year_1 ?> </h1>
        <?php }else{?>
            <h1>รายงานรายการแข่ง ประจำเดือน <?php echo $month?> ปี <?php echo $year_1 ?> </h1>
        <?php }?>
    
            <p class="text-right">
                <b>วันที่ทำรายการ : </b> <?php echo DATE("d/m/Y")?><br>
            </p>
            <?php
            $i=1;
           
            $result=mysqli_query($con,"SELECT tour_no,tour_name,tour_max,tour_start FROM tournament $where $year_1 $and $month_1 ORDER BY tour_no ASC ")or die("Sql Error>>".mysqli_error($con));
                
            
            ?>
                    <div class="table-responsive table--no-card m-b-30">
                        <table class="table table-borderless table-striped table-earning">
                            <thead>
                                <tr>
                                    <th width="5%" class="text-center">ลำดับ</th>
                                    <th width="10%" class="text-center">รหัสการแข่ง</th>
                                    
                                    <th width="20%" class="text-center">ชื่อรายการแข่ง</th>
                                    <th width="10%" class="text-center">จำนวนผู้เข้าร่วม</th>
                                    <th width="10%" class="text-center">วันที่แข่ง</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                        <?php
                        while(list($t_no,$t_name,$t_max,$t_start)=mysqli_fetch_row($result)){
                        ?>
                        
                                <tr>
                                    <td class="text-center"><?php echo $i ?></td>
                                    <td class="text-center"><?php echo $t_no ?></td> 
                                    
                                    <td class="text-center"><?php echo $t_name ?></td>
                                    <?php
                                        $result2=mysqli_query($con,"SELECT player_id FROM tour_player WHERE tour_no ='$t_no'")or die("Sql Error>>".mysqli_error($con));
                                        $rows2=mysqli_num_rows($result2);
                                    ?>
                                    <td class="text-center"><?php echo $rows2 ?>&nbsp; คน</td>
                                    <td class="text-center"><?php echo $t_start ?></td>
                                    
                                    
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
