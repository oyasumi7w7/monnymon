<?php
session_start();
include("include/connect_db.php");
  $con=connect_db();
  $comment = mysqli_query($con,"SELECT comment_id,comment_text,comment_pic,quest_id FROM comments WHERE comment_id=$_GET[cid]") or die("Sql Topics Error>>".mysqli_error($con));
  list($comment_id,$comment,$comment_pic,$quest_id)=mysqli_fetch_row($comment);

  $back = mysqli_query($con,"SELECT * FROM topics WHERE topic_id=$quest_id") or die("Sql Topics Error>>".mysqli_error($con));
  list($topic_id,$topic_name,$topic_text,$topic_pic,$topic_time,$topic_edit,$topic_member)=mysqli_fetch_row($back);
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once ("include/tag-head.php"); ?>
<style>
      .zoom {
          transition: transform .2s; /* Animation */
          width: 200px;
          height: 130px;
          margin: 0 auto;
      }
      .zoom:hover {
          transform: scale(1.5); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
      }
      .bg-btn{
        background-color: initial;
        border: none;
      }
      .mySlides {display:none;}
      
      
      </style>

  <body>
  
  <div class="site-wrap">
  <?php require_once ("include/header.php"); ?>
  
  <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="main.php">Home</a> <span class="mx-2 mb-0">/</span><a href="webboard.php">Webboard</a>
           <span class="mx-2 mb-0">/</span><a href="topic_view.php?id=<?php echo "$quest_id" ?>"><?php echo "$topic_name" ?></a> 
           <span class="mx-2 mb-0">/</span><strong class="text-black">แก้ไขคอมเม้น</strong></div>
          
        </div>
      </div>
    </div>


<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 style="font-size: 50px">Monnymon Webboard</h1>
    <h2 style="font-size: 25px">ฟอร์มแก้ไขคอมเม้น</h2>
  </div>
</div>
         <div class="container">
         <div class="row">
       <?php
        echo "
	<div class='col-md-12'>
             <div class='card mb-4'>
                 <div class='card-header'>
                     <div class='media flex-wrap w-100 align-items-center'>
                      <h3>Comment Form</h3> 
                     </div>
                 </div>
             </div>
                 <div class='card-body'>
                 <form method='post' action='edit_comment.php' enctype='multipart/form-data'>
                         <input type='hidden' id='topic_id' name='topic_id' value='$quest_id'>
                         <input type='hidden' id='comment_id' name='comment_id' value='$comment_id'>
                     	<div class='form-group'>
                        	<label for='exampleFormControlTextarea1'>แสดงความคิดเห็น</label>
                        	<textarea class='form-control' id='comment' name='comment' rows='3' placeholder='Add comment'>$comment</textarea>
                      	</div>
                      		<label for='exampleFormControlFile1'>อัพโหลดรูปภาพ</label>
                      		<input type='file' class='form-control-file' name='c_pic'>
                 	<div class='card-footer d-flex flex-wrap justify-content-between align-items-center px-0 pt-0 pb-3'>
                     		<div class='px-4 pt-3'><input type='reset' value='Reset'><input type='submit' value='Submit' id='submit'> </div>
                 	</div>
                   </from>";
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
  <script src='js/jquery-1.11.0.min.js'></script>
<script src='js/lightbox.js'></script>
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
  <?php
  mysqli_free_result($user);
  mysqli_free_result($topic);
  mysqli_close($con);
  ?>
</html>
