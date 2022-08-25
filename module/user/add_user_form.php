<?php

if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1 ){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='index.php'</script>";
  }

  if(empty($_GET['do'])){
    $do="";
 }else{
      $do=$_GET['do'];
 }

 if($do==1){
   echo '<script type="text/javascript">
         swal("", "ID หรือ Email ซ้ำ ไม่สามารถแก้ไขผู้ใช้ได้", "error");
         </script>';
 }
?>
<div >
    	<div class="card">
            <div class="card-header">
                <a style="font-size:50px; color:#A52A2A; ">เพิ่มผู้ใช้</a>
                
            </div>
	<div class="card-body card-block">
		<form  action="index.php?module=user&action=add_user" method="post" enctype="multipart/form-data" class="form-horizontal">

			<div class="row form-group">
                <div class="col col-md-3">
                    <label class=" form-control-label">ID : </label>
                 </div>
                <div class="col-12 col-md-9">
                    <input type="text" name="id" style="width: 50%"  class="form-control"  >
                </div>
			</div>
			<div class="row form-group">
                <div class="col col-md-3">
                    <label for="pass" class=" form-control-label">Password : </label>
                </div>
                <div class="col-12 col-md-9">
					<input type="text" name="pass" style="width: 50%"  class="form-control"> 
                </div>
			</div>
			<div class="row form-group">
                <div class="col col-md-3">
                    <label for="name" class=" form-control-label">ชื่อ : </label>
                </div>
                <div class="col-12 col-md-9">
					<input type="text" name="name" style="width: 50%"  class="form-control" maxlength = "20">
                </div>
			</div>
			<div class="row form-group">
                <div class="col col-md-3">
                    <label for="lastname" class=" form-control-label">นามสกุล : </label>
                </div>
                <div class="col-12 col-md-9">
					<input type="text" name="lastname" style="width: 50%"  class="form-control"  maxlength = "20">
                </div>
			</div>
			<div class="row form-group">
                <div class="col col-md-3">
                    <label class=" form-control-label">เพศ :</label>
                </div>
                <div class="col col-md-9">
                    <div class="form-check-inline form-check">
                        <label for="sex" class="form-check-label ">
                            <input type="radio" name="sex" value="1" class="form-check-input">ชาย
                        </label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <label for="sex" class="form-check-label ">
                        	<input type="radio" name="sex" value="2" class="form-check-input">หญิง
                        </label>
                    </div>
                </div>
			</div>
			<div class="row form-group">
                <div class="col col-md-3">
                    <label for="age" class=" form-control-label">อายุ : </label>
                </div>
                <div class="col-12 col-md-9">
					<input type="text" name="age" style="width: 10%"  class="form-control">
                </div>
			</div>
			<div class="row form-group">
                <div class="col col-md-3">
                    <label for="birth" class=" form-control-label">วันเดือนปีเกิด : </label>
                </div>
                <div class="col-12 col-md-9">
					<input type="date" name="birth" style="width: 50%"   class="form-control">
                </div>
			</div>
			<div class="row form-group">
                <div class="col col-md-3">
                    <label for="address" class=" form-control-label">ที่อยู่ :</label>
                </div>
                <div class="col-12 col-md-9">
                    <textarea name="address" rows="2" placeholder="Address..." class="form-control"></textarea>
                </div>
			</div>
			
			<div class="row form-group">
                <div class="col col-md-3">
                    <label for="address2" class=" form-control-label">ที่อยู่(เพิ่มเติม) : </label>
                </div>
                <div class="col-12 col-md-9">
                    <textarea name="address2" rows="2"  placeholder="Address..." class="form-control"></textarea>
                </div>
			</div>
			<div class="row form-group">
                <div class="col col-md-3">
                    <label for="email" class=" form-control-label">E-mail : </label>
                </div>
                <div class="col-12 col-md-9">
					<input type="email" name="email" class="form-control">
                </div>
			</div>
			<div class="row form-group">
                <div class="col col-md-3">
                    <label for="phone" class=" form-control-label"  >เบอร์โทรศัพท์ : </label>
                </div>
                <div class="col-12 col-md-9 ">
					<input type="text" name="phone" class="form-control" style="width: 50%"  maxlength = "10" onkeypress="return isNumber(event)"  >
                        
                </div>
			</div>
			<div class="row form-group">
                <div class="col col-md-3">
                    <label for="m_pic" class=" form-control-label">รูปโปรไฟล์</label>
                </div>
                <div class="col-12 col-md-9">
                    <input type="file" name="m_pic" class="form-control-file">
                </div>
			</div>
			<div class="row form-group">
                <div class="col col-md-3">
                    <label for="select" class=" form-control-label">Select</label>
                </div>
                <div class="col-12 col-md-9">
                    <select name="type" class="form-control">
						<option value=1 $sl>Admin</option>
						<option value=2 $sl2>Customer</option>
                    </select>
                </div>
            </div>
			<div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-dot-circle-o"></i> เพิ่มข้อมูลผู้ใช้งาน
                </button>
                <button type="reset" class="btn btn-danger btn-sm">
                    <i class="fa fa-ban"></i> ยกเลิก
                </button>
                <a href="index.php?module=user&action=manage_user">
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