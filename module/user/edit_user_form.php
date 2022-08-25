<?php

if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='index.php'</script>";
  }

  if($do==1){
    echo '<script type="text/javascript">
          swal("", "ID ซ้ำ ไม่สามารถแก้ไขผู้ใช้ได้", "error");
          </script>';
  }elseif($do==2){
     echo '<script type="text/javascript">
     swal("", "Email ซ้ำ ไม่สามารถแก้ไขผู้ใช้ได้", "error");
     </script>';
  }elseif($do==3){
    echo '<script type="text/javascript">
    swal("", "ID และ Email ซ้ำ ไม่สามารถแก้ไขผู้ใช้ไ", "error");
    </script>';
 }
?>
	<?php

		$id=$_GET['id'];

		$rs=mysqli_query($con,"SELECT * FROM member WHERE m_num='$id' ")or die("Sql Error1>>".mysqli_error($con));
		list($num,$id,$pass,$pic,$name,$lastname,$sex,$age,$birth,$phone,$email,$address,$address2,$type)=mysqli_fetch_row($rs);

		if($sex=="1"){
			$check="checked";$check1="";
			}else{
			$check="";$check1="checked";
						   
			}

	?>
	<div >
    	<div class="card">
            <div class="card-header">
                <a style="font-size:50px; color:#A52A2A; ">แก้ไขข้อมูลผู้ใช้</a>
                
            </div>
	<div class="card-body card-block">
		<form  action="index.php?module=user&action=update_user" method="post" enctype="multipart/form-data" class="form-horizontal">
            <input type="hidden" name="num" value="<?php echo $num?>">
            <input type="hidden" name="f_id" value="<?php echo $id?>">
            <input type="hidden" name="f_mail" value="<?php echo $email?>">
			

			<div class="row form-group">
                <div class="col col-md-3">
                    <label class=" form-control-label">ID : </label>
                 </div>
                 <div class="col-12 col-md-9">
					<input type="text" name="id" style="width: 50%"  value=<?php echo $id ?> class="form-control"> 
                </div>
			</div>
			<div class="row form-group">
                <div class="col col-md-3">
                    <label for="pass" class=" form-control-label">Password : </label>
                </div>
                <div class="col-12 col-md-9">
					<input type="text" name="pass" style="width: 50%"  value=<?php echo $pass ?> class="form-control"> 
                </div>
			</div>
			<div class="row form-group">
                <div class="col col-md-3">
                    <label for="name" class=" form-control-label">ชื่อ : </label>
                </div>
                <div class="col-12 col-md-9">
					<input type="text" name="name" style="width: 50%"  value=<?php echo $name ?> maxlength = "20" class="form-control">
                </div>
			</div>
			<div class="row form-group">
                <div class="col col-md-3">
                    <label for="lastname" class=" form-control-label">นามสกุล : </label>
                </div>
                <div class="col-12 col-md-9">
					<input type="text" name="lastname" style="width: 50%"  value=<?php echo $lastname ?> maxlength = "20" class="form-control">
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
					<input type="text" name="age" style="width: 10%"  value=<?php echo $age ?> class="form-control">
                </div>
			</div>
			<div class="row form-group">
                <div class="col col-md-3">
                    <label for="birth" class=" form-control-label">วันเดือนปีเกิด : </label>
                </div>
                <div class="col-12 col-md-9">
					<input type="date" name="birth" style="width: 50%"  value=<?php echo $birth ?> class="form-control">
                </div>
			</div>
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
					<input type="email" name="email" value=<?php echo $email ?> class="form-control">
                </div>
			</div>
			<div class="row form-group">
                <div class="col col-md-3">
                    <label for="phone" class=" form-control-label">เบอร์โทรศัพท์ : </label>
                </div>
                <div class="col-12 col-md-9">
					<input type="text" name="phone" style="width: 50%"  maxlength = "10" onkeypress="return isNumber(event)" value="<?php echo $phone ?>" class="form-control">
                </div>
			</div>
			<div class="row form-group">
                <div class="col col-md-3">
                    <label for="m_pic" class=" form-control-label">File input</label>
                </div>
                <div class="col-12 col-md-9">
                    <input type="file" name="m_pic" class="form-control-file" value="<?php echo $pic ?>">
                </div>
			</div>
			<div class="row form-group">
                <div class="col col-md-3">
                    <label for="select" class=" form-control-label">Select</label>
                </div>
                <div class="col-12 col-md-9">
                    <select name="type" class="form-control">
					<?php
							if($type==1){
								$sl='selected';
							}
							else{					
								$sl2='selected';
							}
						echo "<option value=1 $sl>Admin</option>";
						echo "<option value=2 $sl2>Customer</option>";

				
					?>
                    </select>
                </div>
            </div>
			<div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-dot-circle-o"></i> แก้ไขข้อมูลผู้ใช้งาน
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
