<?php

if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='index.php'</script>";
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
                        <th class="text-center" style="background-color: #8B0000; border-left:solid;border-right:solid;"><a href="index.php?module=report&action=report_stat" style="color:white; font-size:20;">สถิติ</a></th>
                        <th class="text-center" style="background-color: #8B0000; border-left:solid;border-right:solid;"><a href="index.php?module=report&action=report_income" style="color:#FFD700; font-size:20;">รายงานรายรับ-จ่าย</a></th>
                        
                    </tr>
                </thead>
              </table>

<br><br>
<p align="center"><a style="font-size:30px; color:#DC143C; ">รายงานรายรับ-จ่าย</a></p><br>

                <form align="center" method="post" target='_blank' action='module/report/print_income.php'>
                    <select name="search" id="search" >
                        <option value="">Year</option>
                        <?PHP for($i=0; $i<=20; $i++) {?>
                        <option value="<?PHP echo date("Y")-$i?>"><?PHP echo date("Y")-$i?></option>
                        <?PHP }?>
                    </select>
					<input type="submit"  value="ออกรายงานรายรับ-จ่าย รายปี" class="btn btn-success btn-ra">			
	            </form>
                <form align="center" method="post" target='_blank'  action='module/report/print_income.php'>
                    <input type="month" id="search" name="search" min="2020-12" value="------">
					<input type="submit" value="ออกรายงานรายรับ-จ่าย รายเดือน" class="btn btn-success btn-ra">			
	            </form>

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