<?php

if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1 ){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='index.php'</script>";
  }

?>
<div >
    	<div class="card">
            <div class="card-header">
                <a style="font-size:50px; color:#A52A2A; ">เพิ่มรายการแข่ง</a>
            
            </div>
	<div class="card-body card-block">
		<form  action="index.php?module=tour&action=add_tour" method="post" enctype="multipart/form-data" class="form-horizontal">

			<div class="row form-group">
                <div class="col col-md-3">
                    <label class=" form-control-label">ชื่อรายการ : </label>
                 </div>
                <div class="col-12 col-md-9">
                    <input type="text" name="name" class="form-control"  >
                </div>
			</div>
			<div class="row form-group">
                <div class="col col-md-3">
                    <label for="age" class=" form-control-label">จำนวนผู้เข้าแข่ง : </label>
                </div>
                <div class="col-12 col-md-9">
					<input type="text" name="max"  class="form-control" maxlength = "2" style="max-width:30%;" onkeypress="return isNumber(event)">
                </div>
			</div>
			<div class="row form-group">
                <div class="col col-md-3">
                    <label for="birth" class=" form-control-label">สิ้นสุดการสมัครออนไลน์ : </label>
                </div>
                <div class="col-12 col-md-9">
					<input type="date" name="endregis"  class="form-control" style="max-width:30%;">
                </div>
			</div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="birth" class=" form-control-label">วันที่ทำการแข่ง : </label>
                </div>
                <div class="col-12 col-md-9">
					<input type="date" name="start_tour"  class="form-control" style="max-width:30%;">
                </div>
			</div>
			
			<div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-dot-circle-o"></i> เพิ่มรายการแข่ง
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