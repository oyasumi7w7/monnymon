<meta charset="utf-8">
<?php

if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='index.php'</script>";
  }

?>

<?php
/*include("include/connect_db.php");
$con=connect_db();*/
?>
<div >
    	<div class="card">
            <div class="card-header">
                <a style="font-size:50px; color:#A52A2A; ">เพิ่มการ์ด</a>
                
            </div>
	<div class="card-body card-block">
		<form  action="index.php?module=card&action=add_card_data" method="post" enctype="multipart/form-data" class="form-horizontal">
        <div class="row form-group">
                <div class="col col-md-3">
                    <label class=" form-control-label">รหัสการ์ด : </label>
                 </div>
                <div class="col-12 col-md-9">
                    <input type="text" name="c_id" class="form-control" required>
                </div>
			</div>
			<div class="row form-group">
                <div class="col col-md-3">
                    <label class=" form-control-label">ชื่อการ์ด : </label>
                 </div>
                <div class="col-12 col-md-9">
                    <input type="text" name="name" class="form-control" required>
                </div>
			</div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label class=" form-control-label">ชื่อการ์ดภาษาญี่ปุ่น : </label>
                 </div>
                <div class="col-12 col-md-9">
                    <input type="text" name="jpname" class="form-control">
                </div>
			</div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label class=" form-control-label">ชื่อการ์ดภาษาไทย : </label>
                 </div>
                <div class="col-12 col-md-9">
                    <input type="text" name="thname" class="form-control">
                </div>
			</div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="grade" class=" form-control-label">เกรดของการ์ด : </label>
                </div>
                <div class="col-12 col-md-9">
                    <select name="grade" class="form-control" required>
                    <option value="" >-- เลือกเกรดของการ์ด --</option>
                        <option value="0" >0</option>
                         <option value="1" >1</option>
                         <option value="2" >2</option>
                         <option value="3" >3</option>
                         <option value="4" >4</option>
                         <option value="5" >5</option>
                    </select>
                </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="skill" class=" form-control-label">สกิลของการ์ด : </label>
                </div>
                <div class="col-12 col-md-9">
                    <select name="skill" class="form-control" size="1"  width="30px" required>
                    <option value="" >-- เลือกสกิลของการ์ด --</option>
                         <option value="Boost" >Boost</option>
                         <option value="Intercept" >Intercept</option>
                         <option value="Twin Drive!!" >Twin Drive!!</option>
                         <option value="Triple Drive!!!" >Triple Drive!!!</option>
                    </select>
                    
                </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="cate" class=" form-control-label">กิฟของการ์ด : </label>
                </div>
                <div class="col-12 col-md-9">
                    <select name="gift" class="form-control">
                    <option value="" >-- เลือกกิฟของการ์ด --</option>
                    <?php
                     $result=mysqli_query($con,"SELECT * FROM card_gift ") or die(mysqli_error($con));
        
                     while(list($g_id,$g_name)=mysqli_fetch_row($result)){
                         echo"<option value='$g_id' >$g_name</option>";
                     }
                    echo "</select>";
                    mysqli_free_result($result);
                    ?>
                </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="num" class=" form-control-label">Power : </label>
                </div>
                <div class="col-12 col-md-9">
					<input type="text" name="atk" onkeypress="return isNumber(event)" style="width: 10%" class="form-control">
                </div>
			</div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="critical" class=" form-control-label">คริของการ์ด : </label>
                </div>
                <div class="col-12 col-md-9">
                    <select name="critical" class="form-control" required>
                    <option value="" >-- เลือกคริของการ์ด --</option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                         <option value="2">2</option>
                         <option value="3">3</option>
                         <option value="4">4</option>
                    </select>
                </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="cate" class=" form-control-label">ประเทศของการ์ด : </label>
                </div>
                <div class="col-12 col-md-9">
                    <select name="nation" class="form-control" required>
                    <option value="" >-- เลือกประเทศของการ์ด --</option>
                    <?php
                     $result=mysqli_query($con,"SELECT * FROM card_nation ") or die(mysqli_error($con));
        
                     while(list($n_id,$n_name)=mysqli_fetch_row($result)){
                         echo"<option value='$n_id' >$n_name</option>";
                     }
                    echo "</select>";
                    mysqli_free_result($result);
                    ?>
                </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="clan" class=" form-control-label">แคลนของการ์ด : </label>
                </div>
                <div class="col-12 col-md-9">
                    <select name="clan" class="form-control" required>
                    <option value="" >-- เลือกแคลนของการ์ด --</option>
                    <?php
                     $result=mysqli_query($con,"SELECT * FROM card_clan ") or die(mysqli_error($con));
        
                     while(list($c_id,$c_name)=mysqli_fetch_row($result)){
                         echo"<option value='$c_id' >$c_name</option>";
                     }
                    echo "</select>";
                    mysqli_free_result($result);
                    ?>
                </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="clan" class=" form-control-label">เผ่าของการ์ด : </label>
                </div>
                <div class="col-12 col-md-9">
                    <select name="race" class="form-control" required>
                    <option value="" >-- เลือกเผ่าของการ์ด --</option>
                    <?php
                     $result=mysqli_query($con,"SELECT * FROM card_race ") or die(mysqli_error($con));
        
                     while(list($r_id,$r_name)=mysqli_fetch_row($result)){
                         echo"<option value='$r_id' >$r_name</option>";
                     }
                    echo "</select>";
                    mysqli_free_result($result);
                    ?>
                </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="type" class=" form-control-label">ประเภทของการ์ด : </label>
                </div>
                <div class="col-12 col-md-9">
                    <select name="cate" class="form-control" required>
                    <option value="" >-- เลือกประเภทของการ์ด --</option>
                        <option value="ทริกเกอร์ยูนิท0">ทริกเกอร์ยูนิท</option>
                        <option value="ทริกเกอร์ยูนิท(เซนติเนล)">ทริกเกอร์ยูนิท(เซนติเนล)</option>
                        <option value="นอมอลยูนิท">นอมอลยูนิท</option>
                         <option value="นอมอลยูนิท(เซนติเนล)">นอมอลยูนิท(เซนติเนล)</option>
                         <option value="ออเดอร์">ออเดอร์</option>
                    </select>
                </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="favor" class=" form-control-label">Text ของการ์ด :</label>
                </div>
                <div class="col-12 col-md-9">
                    <textarea name="favor" rows="2" placeholder="Text ของการ์ด..." class="form-control"></textarea>
                </div>
			</div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="detail" class=" form-control-label">เอฟเฟคของการ์ด :</label>
                </div>
                <div class="col-12 col-md-9">
                    <textarea name="detail" rows="2" placeholder="Text ของการ์ด..." class="form-control"></textarea>
                </div>
			</div>
			<div class="row form-group">
                <div class="col col-md-3">
                    <label for="p_pic" class=" form-control-label">รูปการ์ด</label>
                </div>
                <div class="col-12 col-md-9">
                    <input type="file" name="p_pic" class="form-control-file">
                </div>
			</div>
			<div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-dot-circle-o"></i> เพิ่มข้อมูลสินค้า
                </button>
                <button type="reset" class="btn btn-danger btn-sm">
                    <i class="fa fa-ban"></i> ยกเลิก
                </button>
                <a href="index.php?module=item&action=manage_item">
                    <button type="button" class="btn btn-secondary btn-sm">
                        <i class="fa fa-arrow-left"></i> ย้อนกลับ
                    </button>
                </a>
             </div>
		</form>
	</div>