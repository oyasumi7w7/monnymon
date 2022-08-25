<?php

if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1 ){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='index.php'</script>";
  }

?>
<div >
    	<div class="card">
            <div class="card-header">
                <h1>เพิ่มผู้ลงแข่งออฟไลน์</h1> 
            </div>
        <div class="card-body card-block">
          <form  action="index.php?module=tour&action=add_player" method="post" enctype="multipart/form-data" class="form-horizontal">

            <div class="row form-group">
                      <div class="col col-md-3">
                          <label class=" form-control-label">รหัสจำลองผู้เข้าแข่ง (ตย. 00101 , 00551) : </label>
                      </div>
                      <div class="col-12 col-md-9">
                          <input type="text" name="p_id" class="form-control"  >
                      </div>
            </div>
            <div class="row form-group">
                      <div class="col col-md-3">
                          <label class=" form-control-label">ชื่อผู้เข้าแข่ง : </label>
                      </div>
                      <div class="col-12 col-md-9">
                          <input type="text" name="p_name" class="form-control"  >
                      </div>
            </div>
            <div class="row form-group">
                      <div class="col col-md-3">
                          <label class=" form-control-label">นามสกุลผู้เข้าแข่ง : </label>
                      </div>
                      <div class="col-12 col-md-9">
                          <input type="text" name="p_lastname" class="form-control"  >
                      </div>
            </div>
            <div class="card-footer">
                      <button type="submit" class="btn btn-primary btn-sm">
                          <i class="fa fa-dot-circle-o"></i> เพิ่มผู้ลงแข่งออฟไลน์
                      </button>
                      <button type="reset" class="btn btn-danger btn-sm">
                          <i class="fa fa-ban"></i> ยกเลิก
                      </button>
                      <a href="index.php?module=tour&action=match&tid=<?php echo "$_SESSION[tour_id]";?>" class="btn btn-secondary btn-sm">
                              <i class="fa fa-arrow-left"></i> ย้อนกลับ
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