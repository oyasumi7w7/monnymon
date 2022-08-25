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

 if($do==1){
   echo '<script type="text/javascript">
         swal("", "อัพเดทเสร็จสิ้น", "success");
         </script>';
 }elseif($do==3){
    echo '<script type="text/javascript">
    swal("", "ERROR : 00000", "error");
    </script>';
 }elseif($do==4){
    echo '<script type="text/javascript">
    swal("", "เปลี่ยนรหัสผ่านเสร็จสิ้น", "success");
    </script>';
 }elseif($do==2){
    echo '<script type="text/javascript">
    swal("", "กรุณาเพิ่มข้อมูลส่วนตัว", "warning");
    </script>';
 }
?>
<link href="css/test.css" rel="stylesheet" media="all">
<div >
    	<div class="card">
            <div class="card-header">
                <a style="font-size:50px; color:#A52A2A; ">ข้อมูลส่วนตัว</a>
                
            </div>
	<div class="card-body card-block">
		<form  action="index.php?module=user&action=add_user" method="post" enctype="multipart/form-data" class="form-horizontal">
       
            <div class="row">
                <div class="col-lg-6"  style="width:100%;height:100%;">
                    <!-- USER DATA-->
                    
                            
                        <div>
                            <div>
                                <img class="pf"  style="width:300px;height: 300px;" src="images/user_images/<?php echo $pic?>" >
                            </div>
                            <div>
                               <br>
                            </div>
                        </div>
                        
                    
                                <!-- END USER DATA-->
                </div>
                <div class="col-lg-6">
                    <!-- USER DATA-->
                    
                            
                        <div class="filters m-b-45">
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="name" class=" form-control-label">ชื่อ-นามสกุล :   </label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <label for="name" class=" form-control-label" ><strong><?php echo $name ?>&nbsp;&nbsp; <?php echo $lastname ?></strong></label>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="phone" class=" form-control-label"  >เบอร์โทรศัพท์ : </label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <label for="phone" class=" form-control-label" ><strong><?php echo $phone ?></strong></label>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="email" class=" form-control-label">E-mail : </label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <label for="email" class=" form-control-label" ><strong><?php echo $email ?></strong></label>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="address" class=" form-control-label">ที่อยู่ :</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <label for="address" class=" form-control-label" ><strong><?php echo $address ?></strong></label>
                                </div>
                            </div>
                            <?php
                               if(!empty($address2)){
                                    echo "<div class='row form-group'>";
                                    echo    "<div class='col col-md-3'>";
                                    echo        "<label for='address2' class=' form-control-label'>ที่อยู่(เพิ่มเติม) : </label>";
                                    echo    "</div>";
                                    echo    "<div class='col-12 col-md-9'>";
                                    echo        "<label for='address2' 'class=' form-control-label' ><strong> $address2 </strong></label>";
                                    echo    "</div>";
                                    echo "</div>";
                                } else{
                                    echo "";
                                }
                            ?>
                        </div>
                 <!--  END TOP CAMPAIGN-->
                
            </div>
        </div>
            


			<div class="card-footer">
                <a href="index.php?module=user&action=profile">
                    <button type="button" class="btn btn-success btn-sm">
                        <i class="fa fa-arrow-left"></i> แก้ไขข้อมูลส่วนตัว
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