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
                <a style="font-size:50px; color:#A52A2A; ">เพิ่มรางวัล</a>
            
            </div>
	<div class="card-body card-block">
		<form  action="index.php?module=item&action=add_item_data" method="post" enctype="multipart/form-data" class="form-horizontal">

			<div class="row form-group">
                <div class="col col-md-3">
                    <label class=" form-control-label">ชื่อรางวัล : </label>
                 </div>
                <div class="col-12 col-md-9">
                    <input type="text" name="name" class="form-control" required>
                </div>
			</div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="price" class=" form-control-label">จำนวนของรางวัล : </label>
                </div>
                <div class="col-12 col-md-9">
					<input type="text" name="price" style="width: 10%" onkeypress="return isNumber(event)" class="form-control">
                    ชิ้น
                </div>
			</div>
            <div class="row form-group">
                <div class="col col-md-3">
                    <label for="cate" class=" form-control-label">รายชื่อทัวร์นาเมนต์ : </label>
                </div>
                <div class="col-12 col-md-9">
                    <select name="cate" class="form-control" required>
                    <option value="" >-- เลือกรายชื่อทัวร์นาเมนต์ --</option>
                    <?php
                     $result=mysqli_query($con,"SELECT * FROM product_category ") or die(mysqli_error($con));
        
                     while(list($c_id,$c_name)=mysqli_fetch_row($result)){
                         echo"<option value='$c_id' >$c_name</option>";
                     }
                    echo "</select>";
                    mysqli_free_result($result);
                    ?>
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