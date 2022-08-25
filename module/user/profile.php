<?php

if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']>2 ){
    echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
echo "<script>window.location='main.php'</script>";
}else{

}
if(empty($_GET['do'])){
    $do="";
 }else{
      $do=$_GET['do'];
 }
if($do==2){
    echo '<script type="text/javascript">
    swal("", "Email ซ้ำ ไม่สามารถแก้ไขผู้ใช้ได้", "error");
    </script>';
 }
?>
<?php
		/*include("include/connect_db.php");
		$con = connect_db();*/
		if($sex=="1"){
			$check="checked";$check1="";
			}else{
			$check="";$check1="checked";
						   
			}

	?>
<div >
    	<div class="card">
            <div class="card-header">
                <a style="font-size:50px; color:#A52A2A; ">แก้ไขข้อมูลส่วนตัว</a>
                
            </div>
	<div class="card-body card-block">
		<form  action="index.php?module=user&action=update_self" method="post" enctype="multipart/form-data" class="form-horizontal">
       
            <div class="row">
                <div class="col-lg-6">
                    <!-- USER DATA-->
                    <input type="hidden" name="num" value="<?php echo $num?>">
                    <input type="hidden" name="f_mail" value="<?php echo $email?>">
                    <input type="hidden" name="id" value="<?php echo $id?>">
                    <input type="hidden" name="pass" value="<?php echo $pass?>">
                    <input type="hidden" name="type" value="<?php echo $type?>">
                            
                        <div class="filters m-b-45">
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="name" class=" form-control-label">ชื่อ : </label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="name" class="form-control" value="<?php echo $name ?>" maxlength = "20">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="lastname" class=" form-control-label">นามสกุล : </label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="lastname" class="form-control" value="<?php echo $lastname ?>" maxlength = "20">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class=" form-control-label">เพศ :</label>
                                </div>
                                <div class="col col-md-9">
                                    <div class="form-check-inline form-check">
                                        <label for="sex" class="form-check-label ">
                                            <input type="radio" name="sex" value="1" class="form-check-input" <?php echo $check ?>>ชาย
                                        </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <label for="sex" class="form-check-label ">
                                            <input type="radio" name="sex" value="2" class="form-check-input" <?php echo $check1 ?>>หญิง
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="age" class=" form-control-label">อายุ : </label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="age"  class="form-control" value="<?php echo $age ?>" >
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="birth" class=" form-control-label">วันเดือนปีเกิด : </label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="date" name="birth" value=<?php echo $birth ?> class="form-control">
                                </div>
                            </div>  
                            
                    
                </div>
                    
                                <!-- END USER DATA-->
                </div>
                <div class="col-lg-6">
                    <!-- USER DATA-->
                    
                            
                        <div class="filters m-b-45">
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="address" class=" form-control-label">ที่อยู่ :</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <textarea name="address" rows="2" placeholder="Address..." class="form-control"><?php echo $address ?></textarea>
                                </div>
                            </div>
                            
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="address2" class=" form-control-label">ที่อยู่(เพิ่มเติม) : </label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <textarea name="address2" rows="2" placeholder="Address..." class="form-control"><?php echo $address2 ?></textarea>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="email" class=" form-control-label">E-mail : </label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="email" name="email"  class="form-control" value=<?php echo $email ?>>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="phone" class=" form-control-label"  >เบอร์โทรศัพท์ : </label>
                                </div>
                                <div class="col-12 col-md-9 ">
                                    <input type="text" name="phone" class="form-control" maxlength = "10" onkeypress="return isNumber(event)"  value=<?php echo $phone ?>>
                                        
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="m_pic" class=" form-control-label">รูปโปรไฟล์</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="file" name="m_pic" class="form-control-file" value="<?php echo $pic ?>" >
                                </div>
                            </div>
                        </div>
                 <!--  END TOP CAMPAIGN-->
                
            </div>
        </div>
            


			<div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-dot-circle-o"></i> แก้ไขข้อมูลส่วนตัว
                </button>
                <button type="reset" class="btn btn-danger btn-sm">
                    <i class="fa fa-ban"></i> ยกเลิก
                </button>
                <a href="index.php?module=user&action=show_profile">
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





    <!--
			<div class="row form-group">
                <div class="col col-md-3">
                    <label for="name" class=" form-control-label">ชื่อ : </label>
                </div>
                <div class="col-12 col-md-9">
					<input type="text" name="name" class="form-control" maxlength = "20">
                </div>
			</div>
			<div class="row form-group">
                <div class="col col-md-3">
                    <label for="lastname" class=" form-control-label">นามสกุล : </label>
                </div>
                <div class="col-12 col-md-9">
					<input type="text" name="lastname" class="form-control"  maxlength = "20">
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
					<input type="text" name="age"  class="form-control">
                </div>
			</div>
			<div class="row form-group">
                <div class="col col-md-3">
                    <label for="birth" class=" form-control-label">วันเดือนปีเกิด : </label>
                </div>
                <div class="col-12 col-md-9">
					<input type="date" name="birth"  class="form-control">
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
                    <textarea name="address2" rows="2" placeholder="Address..." class="form-control"></textarea>
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
					<input type="text" name="phone" class="form-control" maxlength = "10" onkeypress="return isNumber(event)"  >
                        
                </div>
			</div>
			<div class="row form-group">
                <div class="col col-md-3">
                    <label for="m_pic" class=" form-control-label">รูปโปรไฟล์</label>
                </div>
                <div class="col-12 col-md-9">
                    <input type="file" name="m_pic" class="form-control-file">
                </div>
			</div>-->