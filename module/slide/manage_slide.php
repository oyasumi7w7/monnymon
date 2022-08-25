<?php

if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1){
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
         swal("", "เพิ่ม slide แล้ว", "success");
         </script>';
 }elseif($do==2){
    echo '<script type="text/javascript">
    swal("", "แก้ไข slide แล้ว", "success");
    </script>';
 }elseif($do==3){
    echo '<script type="text/javascript">
    swal("", "ลบ Slide Show เรียบร้อย", "success");
    </script>';
 }
?>
<meta charset="UTF-8">
<p align="center"><a style="font-size:50px; color:#A52A2A; ">จัดการSlide Show</a></p>
<?php
            $round=mysqli_query($con,"SELECT * FROM slide_show ")or die("SQL Error1==>".mysqli_error($con));
            $r=mysqli_num_rows($round);
            
            
          if($r<3)  {
            ?>
	<p align="right"  >
 	<button type="button" data-toggle='modal' data-target='#add_slide' class="btn btn-primary btn-ra " >
	<i class="fa fa-plus"></i>&nbsp; เพิ่ม Slide</button>
	</p>
    <?php } ?>

            <?php
            $result=mysqli_query($con,"SELECT * FROM slide_show ")or die("SQL Error1==>".mysqli_error($con));
            $rows=mysqli_num_rows($result);

        if($rows==0){

        }else{
            ?>
    
		<div class="table-responsive table--no-card m-b-30">
			<table class="table table-borderless table-striped table-earning">
				<thead>
			<?php
	echo"<tr>
	<th style='text-align:center;'>รูป</th>
	<th style='text-align:center;'>ชื่อ</th>
    <th style='text-align:center;'></th>
    </tr>";
?>	
				</thead>
	<tbody>
	<?php
    $result=mysqli_query($con,"SELECT * FROM slide_show ")or die("Sql Error>>".mysqli_error($con));
	while(list($id,$name,$pic)=mysqli_fetch_row($result)){
		if($type==1){
			$class="Admin";
		}
		else{
			$class="Customer";
		}
		if(empty($pic)){
			$pic="start_icon.jpg";
		}

	//echo $data [0],"-"; //การ eco array ต้องมี index
	echo "<tr>"; ?>
	<td style="text-align:center;"><img src="images/slide/<?php echo $pic ?>" style="width:100px;height:100px;"></td>
	<?php
	//echo "<td><a href='product_detail.php?id=$product_id'>$product_title</a></td>"; //แบบ GET ไม่มี $ข้างหน้า
	echo "<td style='text-align:center;'>$name </td>";
?>
<?php
	echo "<td style='text-align:center;'>
    <a><button type='button' data-toggle='modal' data-target='#edit_slide$id' class='btn btn-primary'>&nbsp;<i class='fa fa-pencil'></i>&nbsp;</button></a>
		<a href='index.php?module=slide&action=delete_slide&id=$id' onclick='return confirm(\" คุณแน่ใจหรือไม่ ว่าจะลบข้อมูลผู้ใช้นี้ \")'>
		<button type='button' class='btn btn-danger' >&nbsp;<i class='fa fa-trash-o'></i>&nbsp;</button></a></td>";
	}

	echo "</tr></tbody></table>";
	


 	}?>
 	
        </div>
		                    <div class="modal hide fade in" style=" margin-top:100px" id="add_slide" > 
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <p>เพิ่ม Slide</p>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
                                        </div>
                                            <div class="modal-body ">
                                                <form action="index.php?module=slide&action=add_slide" method="post" enctype="multipart/form-data" class="form-horizontal">
                                                            <table class="table site-block-order-table mb-5">
                                                            
                                                                <tbody>
                                                                    <tr>
                                                                            <td class="text-black font-weight-bold">ใส่ชื่อรูป(คำอธิบาย ย่อๆ)</td>
                                                                            <td class="text-black font-weight-bold" > <input type="text" id="name" name="name" class="form-control"></td>
                                                                    </tr>
                                                                    <tr>
                                                                            <td class="text-black font-weight-bold">รูป Slide</td>
                                                                            <td class="text-black font-weight-bold"> <input type="file" name="pic" class="form-control-file"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-success" id="submit"><i class="glyphicon glyphicon-inbox"></i> Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            
                            <?php
                            $modal=mysqli_query($con,"SELECT * FROM slide_show ")or die("Sql Error>>".mysqli_error($con)); 
                        
                            while(list($modal_id,$modal_name,$modal_pic)=mysqli_fetch_row($modal)){
                            ?>

                            <div class="modal hide fade in" style=" margin-top:100px" id="edit_slide<?php echo $modal_id ?>" > 
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                          <p>เพิ่ม Slide</p>
                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
                                    </div>
                                        <div class="modal-body ">
                                            <form action="index.php?module=slide&action=edit_slide" method="post" enctype="multipart/form-data" class="form-horizontal">
                                            <div  style="text-align:center;">
                                            <img src="images/slide/<?php echo $modal_pic ?>" style="width:500px;height:100px;">
                                            </div>
                                            <input type="hidden" id="id" name="id" value="<?php echo $modal_id; ?>">
                                                        <table class="table site-block-order-table mb-5">
                                                           
                                                            <tbody>
                                                                <tr>
                                                                        <td class="text-black font-weight-bold">ใส่ชื่อรูป(คำอธิบาย ย่อๆ)</td>
                                                                        <td class="text-black font-weight-bold" > <input type="text" id="name" value="<?php echo $modal_name ?>" name="name" class="form-control"></td>
                                                                </tr>
                                                                <tr>
                                                                        <td class="text-black font-weight-bold">รูป Slide</td>
                                                                        <td class="text-black font-weight-bold"> <input type="file" name="pic" class="form-control-file"></td>
                                                                </tr>
                                                            </tbody>
                                              			</table>
                                                <div class="modal-footer">
                                                    <button class="btn btn-success" id="submit"><i class="glyphicon glyphicon-inbox"></i> Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                  </div>
                                </div>
                            </div>
                            <?php
                            }  
                            ?>
<?php mysqli_close($con);  ?>
                          
                           
                           
