<?php

if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='index.php'</script>";
  }

?>
<meta charset="utf-8">
<?php
/*include("include/connect_db.php");
$con=connect_db();*/
$id=$_GET['id'];
$rs=mysqli_query($con,"SELECT * FROM product WHERE product_id='$id' ")or die("Sql Error1>>".mysqli_error($con));
		list($p_id,$p_name,$p_cate,$p_detail,$p_price,$p_sprice,$p_num,$p_pic)=mysqli_fetch_row($rs);


?>
<div >
    	<div class="card">
            <div class="card-header">
                <a style="font-size:50px; color:#A52A2A; ">แก้ไขสินค้า</a>
               
            </div>
	<div class="card-body card-block">
		<form  action="index.php?module=item&action=edit_item_data" method="post" enctype="multipart/form-data" class="form-horizontal">
        <input type="hidden" name="id" value="<?php echo $p_id?>">

			<div class="row form-group">
                <div class="col col-md-3">
                    <label class=" form-control-label">ชื่อสินค้า : </label>
                 </div>
                <div class="col-12 col-md-9">
                    <input type="text" name="name" value=<?php echo $p_name ?> class="form-control" required>
                </div>
			</div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="cate" class=" form-control-label">ประเภทสินค้า : </label>
                </div>
                <div class="col-12 col-md-9">
                    <select name="cate" class="form-control" required>
                    <option value="" >-- เลือกประเภทสินค้า --</option>
                    <?php
                     $result=mysqli_query($con,"SELECT * FROM product_category ") or die(mysqli_error($con));
        
                     while(list($c_id,$c_name)=mysqli_fetch_row($result)){
                         $select=$c_id==$p_cate?"selected":"";
                         echo"<option value='$c_id' $select>$c_name</option>";
                     }
                    echo "</select>";
                    mysqli_free_result($result);
                    mysqli_close($con);
                    ?>
                </div>
            </div>
			<div class="row form-group">
                <div class="col col-md-3">
                    <label for="detail" class=" form-control-label">รายละเอียดสินค้า :</label>
                </div>
                <div class="col-12 col-md-9">
                    <textarea name="detail" rows="2" placeholder="รายละเอียดสินค้า..." class="form-control"><?php echo $p_detail ?></textarea>
                </div>
			</div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="price" class=" form-control-label">ราคา : </label>
                </div>
                <div class="col-12 col-md-9">
					<input type="text" name="price" value=<?php echo $p_price ?> onkeypress="return isNumber(event)" style="width: 10%" class="form-control">
                    บาท
                </div>
			</div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="sprice" class=" form-control-label">ราคาพิเศษ : </label>
                </div>
                <div class="col-12 col-md-9">
					<input type="text" name="sprice" value=<?php echo $p_sprice ?> onkeypress="return isNumber(event)" style="width: 10%" class="form-control">
                    บาท
                </div>
			</div>
			<div class="row form-group">
                <div class="col col-md-3">
                    <label for="p_pic" class=" form-control-label">รูปโปรไฟล์</label>
                </div>
                <div class="col-12 col-md-9">
                    <input type="file" name="p_pic" value="<?php echo $p_pic ?>" class="form-control-file">
                </div>
			</div>
			<div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-dot-circle-o"></i> แก้ไขข้อมูลสินค้า
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
