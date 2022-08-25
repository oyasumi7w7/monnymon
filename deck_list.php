<?php
session_start();
include("include/connect_db.php");
  $con=connect_db();
  

?>
<!DOCTYPE html>
<html lang="en">
<?php require_once ("include/tag-head.php"); ?>
<style>

      </style>

  <body>

  <div class="site-wrap">
  <?php require_once ("include/header.php"); ?>

  <div class="bg-light py-3">
      <div class="container">
        <div class="row">
        <div class="col-md-12 mb-0"><a href="main.php">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">DeckBuilding</strong></div>
          
        </div>
      </div>
    </div>


<div class="jumbotron jumbotron-fluid" style="background-color: #228B22">
  <div class="container" style="color:#FFF8DC;">
    <h1 style="font-size: 50px; border-bottom:double; margin-right: 50%;">Monnymon Deck Builder</h1>
    <p style="font-size: 25px; border-bottom:double ; border-right:double; margin-right: 75%;">มุมแลกเปลี่ยนการจัดเด็ค</p>
  </div>
</div>

        <?php 
        $topic = mysqli_query($con,"SELECT topic_id,topic_head,topic_pic,topic_time,topic_member FROM topics WHERE topic_type ='1' ORDER BY topic_time DESC;") or die("Sql Topics Error>>".mysqli_error($con));
       
          
        
        $rows=mysqli_num_rows($topic); //ใช้นับจำนวนแถวที่คิวรี่หรือซีเลคออกมาได้ พารามิเตอร์ 1 ตัวคือ ชื่อตัวแปรที่ใช้คิวรี่ รีเทิร์นค่าออกมาเป็นจำนวนแถวที่นับได้เป็นจำนวนเต็ม
	$rows_page=20; //จำนวนแถวที่ต้องการให้แสดงใน 1 หน้า
	$pages=ceil($rows/$rows_page); //จำนวนหน้าหาจาก (จำนวนแถว หาร จำนวนแถวต่อหน้า)ปัดเศษขึ้น *ceil
	
	if(isset($_GET['pid'])){ //ตรวจสอบว่ามีการส่งค่า หมายเลขหน้ามาหรือไม่
		$pid=$_GET['pid']; //หมายเลขหน้าที่ส่งมาจาก link
		$start_rows=($pid-1)*$rows_page; //คำนวณหาแถวแรกแต่ละหน้า
	}
	else{ //ถ้าไม่มีการคลิก link เลขหน้า
		$pid=1; //กำหนดหน้า เป็นหน้าแรก
		$start_rows=0; //แถวแรก
	}

        ?>
    <div class="album py-5 bg-light">
      <div class="container">
          <a href="deck_build.php"><button type="button" class="btn btn-primary"<?php echo $dis; ?>>จัดเด็คจำลอง</button></a>
          <br><br>
      <div class="row">
    
    
        <?php
        $result=mysqli_query($con,"SELECT topic_id,topic_head,topic_pic,topic_time,topic_member FROM topics WHERE topic_type ='1' ORDER BY topic_id DESC LIMIT $start_rows,$rows_page ")or die("Sql Error>>".mysqli_error($con));
	      while(list($topic_id,$topic_name,$topic_pic,$topic_time,$topic_member)=mysqli_fetch_row($result)){ 
          $name_out = strlen($topic_member) > 60 ? substr($topic_member,0,60)."..." : $topic_member;
          if(empty($topic_pic)){
            $topic_pic = "no-pic.jpg";
          }
          echo "<div class='col-md-4'>";
         echo "<div class='card mb-4 shadow-sm' style='height:100%;width:100%;'>";
        echo "<img src='images/topic/$topic_pic'  height='200px'>";
              echo"<a href='topic_view.php?id=$topic_id'><h3 class='card-text'>$topic_name</h3></a>";
              echo"<div class='d-flex justify-content-between align-items-center'>";
                echo"<div class='btn-group'>";
                  echo"<a href='topic_deck_view.php?id=$topic_id'><button type='button' class='btn btn-sm btn-outline-secondary'>View</button></a>";
                  echo"<button type='button' class='btn btn-sm btn-lg disabled'>$name_out</button>";
                echo"</div>";
                echo"<small class='text-muted'>$topic_time</small>";
              echo"</div>";
            echo"</div>";
          echo"</div>";
          ?>	
          <?php
        } 
        ?>
</div>
<?php
	echo "<p> หน้า : ";
	for($i=1;$i<=$pages;$i++){ //วนลูปตามจำนวนหน้า
		if($i==$pid){ //ถ้าตรงกับหน้าปัจจุบัน
		echo "<span style='color:red;font-weight:bold;'> [ $i ] </span>";		
		}
		else
		{
	echo"<a href='webboard.php?pid=$i'>[ $i ]</a>"; //สร้าง link หมายเลขหน้า
		}
	}
  echo "</p>";
  ?>
    </div>
  </div>
  <?php require_once ("include/footer.php"); ?>
  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/main2.js"></script>
    
  <script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";  
  }
  x[slideIndex-1].style.display = "block";  
}
</script>
  </body>
</html>