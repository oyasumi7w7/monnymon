<?php

if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1 ){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='index.php'</script>";
  }

?>
<?php
$tid=$_GET['tid'];

$tour=mysqli_query($con,"SELECT * FROM tournament WHERE tour_no='$tid' ")or die("Sql Error1>>".mysqli_error($con));
		list($t_id,$t_name,$t_max,$t_regis,$t_end,$t_start)=mysqli_fetch_row($tour);


?>


<div >
    	<div class="card">
            <div class="card-header">
            
            <a style="font-size:50px; color:#A52A2A; ">แก้ไขรายการแข่ง</a>
            </div>
	<div class="card-body card-block">
		<form  action="index.php?module=tour&action=edit_tour" method="post" enctype="multipart/form-data" class="form-horizontal">
            <input type="hidden" name="tid" value="<?php echo $t_id?>">
            
			<div class="row form-group">
                <div class="col col-md-3">
                    <label class=" form-control-label">ชื่อรายการ : </label>
                 </div>
                <div class="col-12 col-md-9">
                    <input type="text" name="name" value=<?php echo $t_name ?>  class="form-control"  >
                </div>
			</div>
			<div class="row form-group">
                <div class="col col-md-3">
                    <label for="age" class=" form-control-label">จำนวนผู้เข้าแข่ง : </label>
                </div>
                <div class="col-12 col-md-9">
					<input type="text" name="max"  value=<?php echo $t_max ?>  class="form-control" maxlength = "2" onkeypress="return isNumber(event)">
                </div>
			</div>
			<div class="row form-group">
                <div class="col col-md-3">
                    <label for="birth" class=" form-control-label">สิ้นสุดการสมัครออนไลน์ : </label>
                </div>
                <div class="col-12 col-md-9">
					<input type="date" name="endregis" value=<?php echo $t_end ?>  class="form-control" style="max-width:30%;">
                </div>
			</div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="birth" class=" form-control-label">วันที่ทำการแข่ง : </label>
                </div>
                <div class="col-12 col-md-9">
					<input type="date" name="start_tour" value=<?php echo $t_start ?> class="form-control" style="max-width:30%;">
                </div>
			</div>
			
			<div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-dot-circle-o"></i> แก้ไขรายการแข่ง
                </button>
                <button type="reset" class="btn btn-danger btn-sm">
                    <i class="fa fa-ban"></i> ยกเลิก
                </button>
                <a href="index.php?module=tour&action=list_tour">
                    <button type="button" class="btn btn-secondary btn-sm">
                        <i class="fa fa-arrow-left"></i> ย้อนกลับ
                    </button>
                </a>
             </div>
		</form>
        
	</div>
    <script>
        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
                if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                    return false;
                }
                    return true;
        }
        
    </script>