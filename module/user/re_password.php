<?php

if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']>2 ){
    echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
echo "<script>window.location='main.php'</script>";
}else{

}

if($do==1){
    echo '<script type="text/javascript">
          swal("", "ใส่รหัสผ่านเดิมไม่ถูกต้อง", "error");
          </script>';
  }elseif($do==2){
     echo '<script type="text/javascript">
     swal("", "ใช้รหัสผ่านนี้อยู่แล้ว", "error");
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
                <a style="font-size:50px; color:#A52A2A; ">เปลี่ยนรหัสผ่าน</a>
                <h1></h1> 
            </div>
	<div class="card-body card-block">
        <form  action="index.php?module=user&action=chk_repass" method="post" name="repass" id="repass" enctype="multipart/form-data" class="form-horizontal" onSubmit="return check()";>
        <input type="hidden" name="num" value="<?php echo $num?>">
        <input type="hidden" name="f_pass" value="<?php echo $pass?>">
            <div class="row">
                <div class="col-lg-6">
                    <!-- USER DATA-->
  
                        <div class="filters m-b-45">
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="name" class=" form-control-label">รหัสผ่านเดิม : </label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="password" class="form-control" maxlength = "20">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="lastname" class=" form-control-label">รหัสผ่านใหม่ : </label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="new_pass" class="form-control" maxlength = "20">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="age" class=" form-control-label">ยืนยันรหัสผ่าน : </label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="chk_password"  class="form-control"  >
                                </div>
                            </div>                   
                </div>
                    
                                <!-- END USER DATA-->
                </div>

            </div>
        </div>
            


			<div class="card-footer ">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-dot-circle-o"></i> ยืนยัน
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
    function check(){
        if(document.repass.new_pass.value!=document.repass.chk_password.value)
          {
              alert('ยืนยันรหัสผ่านไม่ถูกต้อง')
              
              return false;

          }
        
    }
  </script>
  



