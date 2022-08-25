<?php

if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='index.php'</script>";
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
        if($_GET['page']=='chk_tour'){
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
                        <th class="text-center" style="background-color: #8B0000; border-left:solid;border-right:solid;"><a href="index.php?module=report&action=report_tour" style="color:#FFD700; font-size:20;">รายงานการแข่งขัน</a></th>
                        <th class="text-center" style="background-color: #8B0000; border-left:solid;border-right:solid;"><a href="index.php?module=report&action=report_stat" style="color:white; font-size:20;">สถิติ</a></th>
                        <th class="text-center" style="background-color: #8B0000; border-left:solid;border-right:solid;"><a href="index.php?module=report&action=report_income" style="color:white; font-size:20;">รายงานรายรับ-จ่าย</a></th>
                        
                    </tr>
                </thead>
              </table>

<br><br>
<p align="center"><a style="font-size:30px; color:#DC143C; ">รายงานการแข่ง</a></p>
<table class="table table-borderless table-striped table-earning" >
                <thead>
                    <tr>
                        <th class="text-center" style="background-color: #DC143C; border-left:solid;border-right:solid;"><a href="index.php?module=report&action=report_tour&page=chk_tour" style="<?php echo $active ?> font-size:20;">รายงานผู้เข้าแข่งขัน/ต่อทัวร์</a></th>
                        <th class="text-center" style="background-color: #DC143C; border-left:solid;border-right:solid;"><a href="index.php?module=report&action=report_tour&page=tour_num" style="<?php echo $active1 ?> font-size:20;">รายงานรายการแข่ง เดือน/ปี</a></th>  
                    </tr>
                </thead>
              </table>
              <br>


<?php
if(!empty($_GET["page"])) {
    switch($_GET["page"]) {
        case "chk_tour":
?>
                <form method="post"  action='index.php?module=report&action=report_tour&page=chk_tour' >
                    <p align="center"><input type="text" style="border:solid;" name="search">&nbsp;<input type="submit" style="border:solid;" value="ค้นหา"></p>
                </form>

            <?php
            

            $cal_page=mysqli_query($con,"SELECT tour_name FROM tournament WHERE tour_name LIKE '%$search%'")or die("SQL Error1==>".mysqli_error($con));
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
            
            $result=mysqli_query($con,"SELECT tour_no,tour_name,tour_max,tour_start FROM tournament WHERE tour_name LIKE '%$search%' ORDER BY tour_no DESC LIMIT $start_rows,$rows_page ")or die("Sql Error>>".mysqli_error($con));
                echo "<p> หน้า : ";
                for($p=1;$p<=$pages;$p++){ //วนลูปตามจำนวนหน้า
                    if($p==$pid){ //ถ้าตรงกับหน้าปัจจุบัน
                    echo "<span style='color:red;font-weight:bold;'> [ $p ] </span>";		
                    }
                    else
                    {
                echo"<a href='index.php?module=report&action=report_tour&pid=$p&search=$search&page=chk_tour'>[ $p ]</a>"; //สร้าง link หมายเลขหน้า
                    }
                }
                echo "</p><br>"; 
            
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
                                    <th style="text-align:center;">ออกรายงาน</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                        <?php
                        while(list($t_no,$t_name,$t_max,$t_start)=mysqli_fetch_row($result)){
                        ?>
                        
                                <tr>
                                    <td class="text-center"><?php echo $i ?></td>
                                    <td class="text-center"><?php echo $t_no ?></td> 
                                    
                                    <td ><?php echo $t_name ?></td>
                                    <?php
                                        $result2=mysqli_query($con,"SELECT player_id FROM tour_player WHERE tour_no ='$t_no'")or die("Sql Error>>".mysqli_error($con));
                                        $rows2=mysqli_num_rows($result2);
                                    ?>
                                    <td class="text-center"><?php echo $rows2 ?>&nbsp; คน</td>
                                    <td class="text-center"><?php echo $t_start ?></td>
                                    <?php

                                        echo "<td style='text-align:center;'><a target='_blank' href='module/report/print_chktour.php?&tid=$t_no&page=chk_tour' style='align: center; '>
                                        <button type='button' class='btn' style='font-size:20px; background-color:#FFA500; border-width:3px;' ><i class='fas fa fa-file' style='color:white'></i></button></a></td>";
                                    ?>
                                    
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
                   echo"<a href='index.php?module=report&action=report_tour&pid=$p&search=$search&page=chk_tour'>[ $p ]</a>"; //สร้าง link หมายเลขหน้า
                       }
                   }
                    echo "</p>"; 
                    ?>
<?php
        break;

        case "tour_num":
?>
                <form align="center" method="post" action='index.php?module=report&action=report_tour&page=tour_num'>
                    <select name="search" id="search">
                        <option value="">Year</option>
                        <?PHP for($i=0; $i<=20; $i++) {?>
                        <option value="<?PHP echo date("Y")-$i?>"><?PHP echo date("Y")-$i?></option>
                        <?PHP }?>
                    </select>
					<input type="submit" value="ค้นหารายปี" class="btn btn-success btn-ra">			
	            </form>
                <form align="center" method="post" action='index.php?module=report&action=report_tour&page=tour_num'>
                    <input type="month" id="search" name="search" min="2020-12" value="------">
					<input type="submit" value="ค้นหารายเดือน" class="btn btn-success btn-ra">			
	            </form><br>
                
               
<?php 
if(!empty($_POST['search'])){
    $date = explode('-',$_POST['search']);
    $where = "WHERE  Year(tour_start) = ";
    $year_1=$date[0];
        if(empty($date[1])){
            $month_1='';
            $and ='';
        }else{
                $and = "AND MONTH(tour_start) = ";
                $month_1=$date[1];

        }

}else{
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
                echo "<br><p align='center'><a target='_blank' href='module/report/print_chktour.php?page=tour_num&&year=$year_1&month=$month_1' style='align: center; '><button type='button' class='btn' style='font-size:20px; color: #A52A2A; background-color:white; border-color:#A52A2A; border-width: 5px;border-radius: 8px;' >
                ออกรายงานรายการแข่ง</button></a>&nbsp; &nbsp; <br><br>";
?>
 <?php if(empty($date[0])){?>
                <p align="center" style="font-size:20px; color:red;">รายงานรายการแข่งทั้งหมด</p><br>
        <?php }elseif(empty($date[1])){?>
         <p align="center" style="font-size:20px; color:red;">รายงานรายการแข่ง ประจำปี <?php echo $year_1 ?> </p><br>
        <?php }else{?>
         <p align="center" style="font-size:20px; color:red;">รายงานรายการแข่ง ประจำเดือน <?php echo $month?> ปี <?php echo $year_1 ?>  </p><br>
        <?php }?>
<?php
               $cal_page=mysqli_query($con,"SELECT tour_name FROM tournament $where $year_1 $and $month_1 ")or die("SQL Error1==>".mysqli_error($con));
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
           
           $result=mysqli_query($con,"SELECT tour_no,tour_name,tour_max,tour_start FROM tournament $where $year_1 $and $month_1 ORDER BY tour_no ASC LIMIT $start_rows,$rows_page ")or die("Sql Error>>".mysqli_error($con));
               echo "<p> หน้า : ";
               for($p=1;$p<=$pages;$p++){ //วนลูปตามจำนวนหน้า
                   if($p==$pid){ //ถ้าตรงกับหน้าปัจจุบัน
                   echo "<span style='color:red;font-weight:bold;'> [ $p ] </span>";		
                   }
                   else
                   {
               echo"<a href='index.php?module=report&action=report_tour&pid=$p&year=$year_1&month=$month_1&page=tour_num'>[ $p ]</a>"; //สร้าง link หมายเลขหน้า
                   }
               }
               echo "</p><br>"; 
           
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
                                   
                                   <td ><?php echo $t_name ?></td>
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
                    echo "<br><p> หน้า : ";
                    for($p=1;$p<=$pages;$p++){ //วนลูปตามจำนวนหน้า
                        if($p==$pid){ //ถ้าตรงกับหน้าปัจจุบัน
                        echo "<span style='color:red;font-weight:bold;'> [ $p ] </span>";		
                        }
                        else
                        {
                    echo"<a href='index.php?module=report&action=report_product&pid=$p&year=$year_1&month=$month_1&page=tour_num'>[ $p ]</a>"; //สร้าง link หมายเลขหน้า
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