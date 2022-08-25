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
$id=$_GET['id'];
$rs=mysqli_query($con,"SELECT * FROM card_list WHERE card_id='$id' ")or die("Sql Error1>>".mysqli_error($con));
		list(
            $card_id
            ,$card_name
            ,$card_jp_name
            ,$card_th_name
            ,$Grade
            ,$Skill
            ,$Imaginary_Gift
            ,$atk
            ,$Critical
            ,$Nation
            ,$Clan
            ,$card_race
            ,$card_type
            ,$Card_Flavor
            ,$Card_Effect
            ,$card_pic)=mysqli_fetch_row($rs);
?>
<div >
    	<div class="card">
            <div class="card-header">
                <a style="font-size:50px; color:#A52A2A; ">เพิ่มการ์ด</a>
                <h1></h1> 
            </div>
	<div class="card-body card-block">
		<form  action="index.php?module=card&action=edit_card_data" method="post" enctype="multipart/form-data" class="form-horizontal">
        <div class="row form-group">
                <div class="col col-md-3">
                    <label class=" form-control-label">รหัสการ์ด : </label>
                 </div>
                <div class="col-12 col-md-9">
                    <input type="text" name="c_id" class="form-control"  value="<?php echo "$card_id"; ?>" required>
                    <input type="hidden" name="old_id"  class="form-control"  value="<?php echo "$card_id"; ?>">
                </div>
			</div>
			<div class="row form-group">
                <div class="col col-md-3">
                    <label class=" form-control-label">ชื่อการ์ด : </label>
                 </div>
                <div class="col-12 col-md-9">
                    <input type="text" name="name" class="form-control" value="<?php echo $card_name ?>" required>
                </div>
			</div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label class=" form-control-label">ชื่อการ์ดภาษาญี่ปุ่น : </label>
                 </div>
                <div class="col-12 col-md-9">
                    <input type="text" name="jpname" class="form-control" value=<?php echo $card_jp_name ?>>
                </div>
			</div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label class=" form-control-label">ชื่อการ์ดภาษาไทย : </label>
                 </div>
                <div class="col-12 col-md-9">
                    <input type="text" name="thname" class="form-control" value=<?php echo $card_th_name ?>>
                </div>
			</div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="grade" class=" form-control-label">เกรดของการ์ด : </label>
                </div>
                <div class="col-12 col-md-9">
                    <select name="grade" class="form-control" required>
                    <option value="" >-- เลือกเกรดของการ์ด --</option>
                        <option value="0" <?php if($Grade == "0") echo 'selected="selected"'; ?> >0</option>
                         <option value="1" <?php if($Grade == "1") echo 'selected="selected"'; ?> >1</option>
                         <option value="2" <?php if($Grade == "2") echo 'selected="selected"'; ?> >2</option>
                         <option value="3" <?php if($Grade == "3") echo 'selected="selected"'; ?> >3</option>
                         <option value="4" <?php if($Grade == "4") echo 'selected="selected"'; ?>>4</option>
                         <option value="5"<?php if($Grade == "5") echo 'selected="selected"'; ?>>5</option>
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
                         <option value="Boost" <?php if($Skill == "Boost") echo 'selected="selected"'; ?> >Boost</option>
                         <option value="Intercept" <?php if($Skill == "Intercept") echo 'selected="selected"'; ?> >Intercept</option>
                         <option value="Twin Drive!!" <?php if($Skill == "Twin Drive!!") echo 'selected="selected"'; ?> >Twin Drive!!</option>
                         <option value="Triple Drive!!!" <?php if($Skill == "Triple Drive!!!") echo 'selected="selected"'; ?>  >Triple Drive!!!</option>
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
                        $select=$g_id==$Imaginary_Gift?"selected":"";
                         echo"<option value='$g_id' $select>$g_name</option>";
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
					<input type="text" name="atk" class="form-control"  onkeypress="return isNumber(event)" style="width: 10%" value="<?php echo "$atk"; ?>">
                </div>
			</div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="critical" class=" form-control-label">คริของการ์ด : </label>
                </div>
                <div class="col-12 col-md-9">
                    <select name="critical" class="form-control" required>
                    <option value="" >-- เลือกคริของการ์ด --</option>
                        <option value="0" <?php if($Critical == "0") echo 'selected="selected"'; ?>>0</option>
                        <option value="1" <?php if($Critical == "1") echo 'selected="selected"'; ?>>1</option>
                         <option value="2" <?php if($Critical == "2") echo 'selected="selected"'; ?>>2</option>
                         <option value="3" <?php if($Critical == "3") echo 'selected="selected"'; ?>>3</option>
                         <option value="4" <?php if($Critical == "4") echo 'selected="selected"'; ?>>4</option>
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
                        $select=$n_id==$Nation?"selected":"";
                         echo"<option value='$n_id' $select>$n_name</option>";
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
                        $select=$c_id==$Clan?"selected":"";
                         echo"<option value='$c_id' $select>$c_name</option>";
                     }
                    echo "</select>";
                    mysqli_free_result($result);
                    ?>
                </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="race" class=" form-control-label">เผ่าของการ์ด : </label>
                </div>
                <div class="col-12 col-md-9">
                    <select name="race" class="form-control" required>
                    <option value="" >-- เลือกเผ่าของการ์ด --</option>
                    <?php
                     $result=mysqli_query($con,"SELECT * FROM card_race ") or die(mysqli_error($con));
        
                     while(list($r_id,$r_name)=mysqli_fetch_row($result)){
                        $select=$r_id==$card_race?"selected":"";
                         echo"<option value='$r_id' $select>$r_name</option>";
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
                        <option value="ทริกเกอร์ยูนิท" <?php if($card_type == "ทริกเกอร์ยูนิท") echo 'selected="selected"'; ?>>ทริกเกอร์ยูนิท</option>
                        <option value="ทริกเกอร์ยูนิท(เซนติเนล)" <?php if($card_type == "ทริกเกอร์ยูนิท(เซนติเนล)") echo 'selected="selected"'; ?>>ทริกเกอร์ยูนิท(เซนติเนล)</option>
                        <option value="นอมอลยูนิท"<?php if($card_type == "นอมอลยูนิท") echo 'selected="selected"'; ?>>นอมอลยูนิท</option>
                         <option value="นอมอลยูนิท(เซนติเนล)"<?php if($card_type == "นอมอลยูนิท(เซนติเนล)") echo 'selected="selected"'; ?>>นอมอลยูนิท(เซนติเนล)</option>
                         <option value="ออเดอร์"<?php if($card_type == "ออเดอร์") echo 'selected="selected"'; ?>>ออเดอร์</option>
                    </select>
                </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="favor" class=" form-control-label">Text ของการ์ด :</label>
                </div>
                <div class="col-12 col-md-9">
                    <textarea name="favor" rows="2" placeholder="Text ของการ์ด..." class="form-control"><?php echo" $Card_Flavor "; ?></textarea>
                </div>
			</div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="detail" class=" form-control-label">เอฟเฟคของการ์ด :</label>
                </div>
                <div class="col-12 col-md-9">
                    <textarea name="detail" rows="2" placeholder="Text ของการ์ด..." class="form-control"><?php echo" $Card_Effect "; ?></textarea>
                </div>
			</div>
			<div class="row form-group">
                <div class="col col-md-3">
                    <label for="p_pic" class=" form-control-label">รูปการ์ด</label>
                </div>
                <div class="col-12 col-md-9">
                    <input type="file" name="c_pic" class="form-control-file">
                </div>
			</div>
			<div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-dot-circle-o"></i> แก้ไขข้อมูลการ์ด
                </button>
                <button type="reset" class="btn btn-danger btn-sm">
                    <i class="fa fa-ban"></i> ยกเลิก
                </button>
                <a href="index.php?module=card&action=manage_card">
                    <button type="button" class="btn btn-secondary btn-sm">
                        <i class="fa fa-arrow-left"></i> ย้อนกลับ
                    </button>
                </a>
             </div>
		</form>
	</div>