
<?php


if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='index.php'</script>";
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
                        <th class="text-center" style="background-color: #8B0000; border-left:solid;border-right:solid;"><a href="index.php?module=report&action=report_product" style="color:white; font-size:20;">รายงานสินค้า</a></th>
                        <th class="text-center" style="background-color: #8B0000; border-left:solid;border-right:solid;"><a href="index.php?module=report&action=report_order" style="color:white; font-size:20;">รายงานคำสั่งซื้อ</a></th>
                        <th class="text-center" style="background-color: #8B0000; border-left:solid;border-right:solid;"><a href="index.php?module=report&action=report_tour" style="color:white; font-size:20;">รายงานการแข่งขัน</a></th>
                        <th class="text-center" style="background-color: #8B0000; border-left:solid;border-right:solid;"><a href="index.php?module=report&action=report_stat" style="color:#FFD700; font-size:20;">สถิติ</a></th>
                        <th class="text-center" style="background-color: #8B0000; border-left:solid;border-right:solid;"><a href="index.php?module=report&action=report_income" style="color:white; font-size:20;">รายงานรายรับ-จ่าย</a></th>
                        
                    </tr>
                </thead>
              </table>

<br><br>
<p align="center"><a style="font-size:30px; color:#DC143C; ">สถิติกราฟ</a></p>
<table class="table table-borderless table-striped table-earning" >
                <thead>
                    <tr>
                        <th class="text-center" style="background-color: #DC143C; border-left:solid;border-right:solid;"><a href="index.php?module=report&action=report_stat&page=balance&year=2021" style="<?php echo $active ?> font-size:20;">รายรับ-รายจ่าย</a></th>
                        <th class="text-center" style="background-color: #DC143C; border-left:solid;border-right:solid;"><a href="index.php?module=report&action=report_stat&page=stock&year=2021" style="<?php echo $active1 ?> font-size:20;">จำนวนผู้เข้าแข่งขัน</a></th>  
                    </tr>
                </thead>
              </table>
              <br>


<?php
if(!empty($_GET["page"])) {
    switch($_GET["page"]) {
        case "balance":

if(!empty($_POST['search'])){
    $date = explode('-',$_POST['search']);
    $year_1=$date[0];
   


}else{

        if(!empty($_GET['year'])){
            $year_1 = $_GET['year'];

        }else{
    
            $year_1='';

            
        }
}
?>
                <form align="center" method="post" action='index.php?module=report&action=report_stat&page=balance'>
                    <select name="search" id="search">
                        <option value="2021">Year</option>
                        <?PHP for($i=0; $i<=20; $i++) {?>
                        <option value="<?PHP echo date("Y")-$i?>"><?PHP echo date("Y")-$i?></option>
                        <?PHP }?>
                    </select>
					<input type="submit" value="รายรับ-จ่าย รายปี" class="btn btn-success btn-ra">			
	            </form><br>
                 <p align="center" style="font-size:20px; color:red;">จำนวนรายรับ-จ่ายในปี <?php echo $year_1 ?></p><br>
                <?php


                                            $data = array();
                                            $data1 = array();
                                            

                                            for($i=1;$i<13;$i++){
                                                $result=mysqli_query($con,"SELECT order_pid FROM order_shop WHERE order_product_status ='3' AND  Year(order_sent) =  $year_1 AND MONTH(order_sent) =  '$i'  group by order_pid ")or die("Sql Error>>".mysqli_error($con));
                                                $total_last=0;
                                                while(list($o_pid)=mysqli_fetch_row($result)){ $amount=0; $total=0;
                                                    if(empty($o_pid)){
                                                        $total_last=0;
                                                    }else{
                                                        $result2=mysqli_query($con,"SELECT order_price ,order_pronum,order_ems FROM order_shop WHERE order_pid ='$o_pid' AND  Year(order_sent) =  $year_1 AND MONTH(order_sent) =  '$i' ")or die("Sql Error>>".mysqli_error($con));
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
                                                    }
                                                }
                                                // var data=['"'.$total_last.'".'];
                                                $data[0][$i] = $total_last;
                                            }
                                            
                                                    $dataPoints1 = array(
                                                        array("label"=> "ม.ค.", "y"=> $data[0][1]),
                                                        array("label"=> "ก.พ.", "y"=> $data[0][2]),
                                                        array("label"=> "มี.ค.", "y"=> $data[0][3]),
                                                        array("label"=> "เม.ย.", "y"=> $data[0][4]),
                                                        array("label"=> "พ.ค.", "y"=> $data[0][5]),
                                                        array("label"=> "มิ.ย.", "y"=> $data[0][6]),
                                                        array("label"=> "ก.ค.", "y"=> $data[0][7]),
                                                        array("label"=> "ส.ค.", "y"=> $data[0][8]),
                                                        array("label"=> "ก.ย.", "y"=> $data[0][9]),
                                                        array("label"=> "ต.ค.", "y"=> $data[0][10]),
                                                        array("label"=> "พ.ย.", "y"=> $data[0][11]),
                                                        array("label"=> "ธ.ค.", "y"=> $data[0][12])
                                                    );
                                           

                                            
                                            for($i=1;$i<13;$i++){
                                                $total_buy=0;
                                                $result=mysqli_query($con,"SELECT * FROM stock_update WHERE  Year(stock_date_up) = $year_1 AND MONTH(stock_date_up) = '$i'  ")or die("Sql Error>>".mysqli_error($con));      
                                                $total2=0;
                                                while(list($stock_id,$pro_id,$pro_name,$pro_num,$buy_price,$stock_date)=mysqli_fetch_row($result)){
                                                    $total_buy=$total_buy+$buy_price;
                                                }
                                                $data1[0][$i] = $total_buy;
                                            }
                                                    $dataPoints2 = array(
                                                        array("label"=> "ม.ค.", "y"=> $data1[0][1]),
                                                        array("label"=> "ก.พ.", "y"=> $data1[0][2]),
                                                        array("label"=> "มี.ค.", "y"=> $data1[0][3]),
                                                        array("label"=> "เม.ย.", "y"=> $data1[0][4]),
                                                        array("label"=> "พ.ค.", "y"=> $data1[0][5]),
                                                        array("label"=> "มิ.ย.", "y"=> $data1[0][6]),
                                                        array("label"=> "ก.ค.", "y"=> $data1[0][7]),
                                                        array("label"=> "ส.ค.", "y"=> $data1[0][8]),
                                                        array("label"=> "ก.ย.", "y"=> $data1[0][9]),
                                                        array("label"=> "ต.ค.", "y"=> $data1[0][10]),
                                                        array("label"=> "พ.ย.", "y"=> $data1[0][11]),
                                                        array("label"=> "ธ.ค.", "y"=> $data1[0][12])
                                                    );
                                            
                                            ?>
 <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                                       
   
                
<?php
        break;

        case "stock":
            if(!empty($_POST['search'])){
                $date = explode('-',$_POST['search']);
                $year_1=$date[0];
               
            
            
            }else{
            
                    if(!empty($_GET['year'])){
                        $year_1 = $_GET['year'];
            
                    }else{
                
                        $year_1='';
            
                        
                    }
            }
            ?>
                            <form align="center" method="post" action='index.php?module=report&action=report_stat&page=stock'>
                                <select name="search" id="search">
                                    <option value="2021">Year</option>
                                    <?PHP for($i=0; $i<=20; $i++) {?>
                                    <option value="<?PHP echo date("Y")-$i?>"><?PHP echo date("Y")-$i?></option>
                                    <?PHP }?>
                                </select>
                                <input type="submit" value="ผู้เข้าแข่งขัน รายปี" class="btn btn-success btn-ra">			
                            </form><br>
                            <p align="center" style="font-size:20px; color:red;">จำนวนผู้เข้าแข่งขันในปี <?php echo $year_1 ?></p><br>
                            <?php


$data = array();



for($i=1;$i<13;$i++){
    $result=mysqli_query($con,"SELECT tour_no,tour_name,tour_max,tour_start FROM tournament WHERE  Year(tour_start) =  $year_1 AND MONTH(tour_start) =  '$i'")or die("Sql Error>>".mysqli_error($con));
    $total_last=0;
    while(list($t_no,$t_name,$t_max,$t_start)=mysqli_fetch_row($result)){ $amount=0; $total=0;
        $result2=mysqli_query($con,"SELECT player_id FROM tour_player WHERE tour_no ='$t_no'")or die("Sql Error>>".mysqli_error($con));
            $rows2=mysqli_num_rows($result2);
            $total_last=$rows2+$total_last;
        }
         $data[0][$i] = $total_last;
    }
    // var data=['"'.$total_last.'".'];
   


        $dataPoints1 = array(
            array("label"=> "ม.ค.", "y"=> $data[0][1]),
            array("label"=> "ก.พ.", "y"=> $data[0][2]),
            array("label"=> "มี.ค.", "y"=> $data[0][3]),
            array("label"=> "เม.ย.", "y"=> $data[0][4]),
            array("label"=> "พ.ค.", "y"=> $data[0][5]),
            array("label"=> "มิ.ย.", "y"=> $data[0][6]),
            array("label"=> "ก.ค.", "y"=> $data[0][7]),
            array("label"=> "ส.ค.", "y"=> $data[0][8]),
            array("label"=> "ก.ย.", "y"=> $data[0][9]),
            array("label"=> "ต.ค.", "y"=> $data[0][10]),
            array("label"=> "พ.ย.", "y"=> $data[0][11]),
            array("label"=> "ธ.ค.", "y"=> $data[0][12])
        );


?>
<div id="chart_player" style="height: 370px; width: 100%;"></div>

                            
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
<?php
if(!empty($_GET["page"])) {
    switch($_GET["page"]) {
        case "balance":
?>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "กราฟรายรับ-รายจ่าย"
	},
	axisY:{
		includeZero: true
	},
	legend:{
		cursor: "pointer",
		verticalAlign: "center",
		horizontalAlign: "right",
		itemclick: toggleDataSeries
	},
	data: [{
		type: "column",
		name: "รายรับ",
		indexLabel: "{y}",
		yValueFormatString: "#0.## บาท",
		showInLegend: true,
		dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
	},{
		type: "column",
		name: "รายจ่าย",
		indexLabel: "{y}",
		yValueFormatString: "#0.## บาท",
		showInLegend: true,
		dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
function toggleDataSeries(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chart.render();
}
 
}
</script>
<?php
break;
case "stock":
?>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chart_player", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "กราฟผู้เข้าแข่งขัน"
	},
	axisY:{
		includeZero: true
	},
	legend:{
		cursor: "pointer",
		verticalAlign: "center",
		horizontalAlign: "right",
		itemclick: toggleDataSeries
	},
	data: [{
		type: "column",
		
		indexLabel: "{y}",
		yValueFormatString: "#0.## คน",
		
		dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
function toggleDataSeries(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chart.render();
}
 
}
</script>
<?php
break;
    }
}
?>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>