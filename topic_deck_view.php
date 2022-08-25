<!-- <meta charset="UTF-8"> -->
<?php
session_start();
include("include/connect_db.php");
  $con=connect_db();
  $topic = mysqli_query($con,"SELECT * FROM topics WHERE topic_id=$_GET[id]") or die("Sql Topics Error>>".mysqli_error($con));
  list($topic_id,$topic_name,$topic_text,$topic_pic,$topic_time,$topic_edit,$topic_member)=mysqli_fetch_row($topic);
  $name_out = strlen($topic_member) > 60 ? substr($topic_member,0,60)."..." : $topic_member;
  if(empty($topic_pic)){
    $topic_pic = "no-pic.jpg";
  }
  $user = mysqli_query($con,"SELECT m_num,m_id,m_pic FROM member WHERE m_id = '$topic_member'")or die("Sql Topics Member Error>>".mysqli_error($con));
  list($mem_num,$mem_id,$mem_pic)=mysqli_fetch_row($user);
 
  if(empty($_SESSION['valid_user'])){
    $valid_user = "";
    $dis = "disabled";
    $read = "readonly";
  }
  else{
    $valid_user = $_SESSION['valid_user'];
    $dis = "";
    $read = "";
  }
?>
<!DOCTYPE html>

<html>
 <?php require_once ("include/tag-head.php"); ?>
<style>
  .comment-post{
    padding-left : 25px;
    width:120%;
  }
  .content_img div{
 position: absolute;
 bottom: 0;
 right: 0;
 background: black;
 color: white;
 margin-bottom: 5px;
 font-family: sans-serif;
 opacity: 0;
 visibility: hidden;

}

/* Hover on Parent Container */
.content_img:hover{
 cursor: pointer;
}

.content_img:hover div{
 width: 100%;
 
 visibility: visible;
 opacity: 70%; 
}
  </style>
  <body>
  
<div class="site-wrap">
  <?php require_once ("include/header.php"); ?>
  <?php
if(empty($_GET['do'])){
  $do="";
}else{
    $do=$_GET['do'];
}

if($do==1){
 echo '<script type="text/javascript">
       swal("", "แก้ไขคอมเม้นเสร็จเรียบร้อย", "success");
       </script>';
}elseif($do==2){
  echo '<script type="text/javascript">
  swal("", "ลบเสร็จสิ้น", "success");
  </script>';
}
  ?>
    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="main.php">Home</a> <span class="mx-2 mb-0">/</span> <a href="deck_list.php">DeckBuilding</a> <span class="mx-2 mb-0">/</span> <strong class="text-black"><?php echo "$topic_name" ?></strong></div>
        </div>
      </div>
    </div>
    

    
    <div class="jumbotron jumbotron-fluid" style="background-color: #228B22">
  <div class="container" style="color:#FFF8DC;">
    <h1 style="font-size: 50px; border-bottom:double; margin-right: 50%;">Monnymon Deck Builder</h1>
    <p style="font-size: 25px; border-bottom:double ; border-right:double; margin-right: 75%;">Topic:<?php echo"$topic_name";?></p>
  </div>
</div>

  <div class="container">
    <div class="container-fluid mt-100">
      <div class="row">
        <?php
          echo  "<div class='col-md-12'>
                    <div class='card mb-4'>
                        <div class='card-header'>
                            <div class='media flex-wrap w-100 align-items-center'> <img src='images/user_images/$mem_pic' class='d-block ui-w-40 rounded-circle' alt='' width='100' height='100'>
                                <div class='media-body ml-3'> <a href='#' data-abc='true'>$topic_member</a>
                                    <div class='text-muted small'>$topic_time</div>
                                </div>
                                <div class='text-muted small ml-3'>
                                    <div>Post since <strong>$topic_time</strong></div>
                                <div><strong>134</strong> posts</div>   
                            </div>
                        </div>
                    </div>
                    <div class='card-body'>
                    <a style='color:red; font-size:20px;'>Topic : $topic_name</a>
                        <p style='color:black;'> 
                        <br>
                        $topic_text
                        </p>
                    </div>
                    <div class='card-footer d-flex flex-wrap justify-content-between align-items-center px-3 pt-3 pb-3' style='color:red; font-size:30px; padding-left:1rem;'>DECK ที่จัด</div>
                    
                    <div class='card-footer d-flex flex-wrap justify-content-between align-items-center px-0 pt-0 pb-3'>";
                   
                    
                    
                    
                        $result = mysqli_query($con,"SELECT * FROM deck_tb WHERE deck_topic_id='$topic_id' ");
                        while(list($deck_id,$top_id,$card_id,$card_num,$card_pic)=mysqli_fetch_row($result)){

                          $info=mysqli_query($con,"SELECT card_name,Nation,Clan,card_race,Card_Effect FROM card_list WHERE card_id='$card_id' ")or die("Sql Error1>>".mysqli_error($con));
                          list($card_name,$nation,$clan,$race,$effect)=mysqli_fetch_row($info);

                          $na=mysqli_query($con,"SELECT nation_name FROM card_nation WHERE nation_id='$nation' ")or die("Sql Error1>>".mysqli_error($con));
                          list($nation_name)=mysqli_fetch_row($na);
                          $cl=mysqli_query($con,"SELECT clan_name FROM card_clan WHERE clan_id='$clan' ")or die("Sql Error1>>".mysqli_error($con));
                          list($clan_name)=mysqli_fetch_row($cl);
                          $ra=mysqli_query($con,"SELECT race_name FROM card_race WHERE race_id='$race' ")or die("Sql Error1>>".mysqli_error($con));
                          list($race_name)=mysqli_fetch_row($ra);
                                                     
                                                ?>
                        
                            <div class="col-sm-6 col-lg-3 mb-4" data-aos="fade-up">
                              <div class="block-4 text-center ">
                                <div class="content_img">
                                    <img style="width : 100%" src="images/card_pic/<?php echo $card_pic; ?>">
                                                  <div>
                                                    <?php echo $card_name ?><br>
                                                    
                                                    <p>Nation : <?php echo $nation_name?> || Clan : <?php echo $clan_name?> </p>
                                                    <p>Race : <?php echo $race_name?> </p> <p>Effect : <?php echo $effect?></p>
                                                    
                                                  </div>
                                        
                                </div>
                                        <?php echo "<a style='color:black;'>$card_id</a>"; ?>
                                        <div style="background-color:black;">
                                        <?php echo "<a style='background-color:black;  color:white; '>จำนวน X $card_num</a>" ?>
                                        </div>
                              </div>
                            </div> 
                           <?php } ?>

                    <?php
                    echo "</div>
                </div>";
        ?>
      </div>  
    </div>
  </div>
         <h3 style="font-size : 35px">Comment</h3><br><br>
         <hr>
         <?php         
         echo"<div class='container-fluid mt-100'>";
         echo"<div class='container-fluid mt-100'>";
                $comment = mysqli_query($con,"SELECT * FROM comments WHERE quest_id='$topic_id'")or die("Sql Topics Comment Error>>".mysqli_error($con));
                while(list($comment_id,$comment_text,$comment_name,$comment_pic,$comment_time,$c_edited,$quest_id)=mysqli_fetch_row($comment)){
                        $user = mysqli_query($con,"SELECT m_num,m_id,m_pic FROM member WHERE m_id = '$comment_name'")or die("Sql Topics Member Error>>".mysqli_error($con));
                        list($mem_num,$mem_id,$mem_pic)=mysqli_fetch_row($user);
                              if(empty($mem_pic)){
                                $mem_pic="start_icon.jpg";
                              }
                              $name_out = strlen($comment_name) > 60 ? substr($comment_name,0,60)."..." : $comment_name;
                              if(empty($comment_pic)){
                                $comment_pic = "no-pic.jpg";
                              }

                              echo"<div class='row comment-post'>";
                                  echo"<div class='col-md-8'>";
                                      echo"<div class='card mb-4'>";
                                          echo"<div class='card-header'>";
                                              echo"<div class='media flex-wrap w-100 align-items-center'> <img src='images/user_images/$mem_pic' class='d-block ui-w-40 rounded-circle' alt='' width='100' height='100'>";
                                                  echo"<div class='media-body ml-3'> 
                                                           <div><a href='#' data-abc='true'> $name_out</a></div>";
                                                      echo"<div class='text-muted small'>$comment_time</div>";
                                                  echo"</div>";
                                                  echo"<div class='text-muted small ml-3'>";
                                                      echo"<div>Post since <strong>$comment_time</strong></div>";
                                                          echo"<div><strong>134</strong> posts</div>";
                                                              if(isset($_SESSION['valid_user'])){
                                                                  if($name_out==$_SESSION['valid_user']){
                                                                      $edit="
                                                                          <div>
                                                                              <a href='delete_deck_comment.php?cid=$comment_id&&qid=$quest_id' onclick='return confirm(\" คุณแน่ใจหรือไม่ ว่าจะลบคอมเม้นนี้ \")'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                                                              <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                                                                              </svg></a>
                                                                              <a href='edit_deck_comment_form.php?cid=$comment_id&&qid=$quest_id'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                                                                              <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                                                                              <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
                                                                              </svg></a>
                                                                          </div>";
                                                                    echo "$edit";
                                                                  }
                                                              }else{
                                                                  $edit = "";
                                                                  echo "$edit";
                                                              }
                                                  echo"</div>";
                                              echo"</div>";
                                          echo"</div>";
                                          echo"<div class='card-body'>";
                                              echo"<p>"; 
                                              echo "$comment_text";
                                              echo "</p>";
                                          echo"</div>";
                                          echo"<div class='card-footer d-flex flex-wrap justify-content-between align-items-center px-0 pt-0 pb-3'>";
                                              echo"<div class='px-4 pt-3'><h4>รูปถ่ายที่แนบมา</h4> <a  href='images/topic/$comment_pic' data-lightbox='example-1'><img src='images/topic/$comment_pic' height='150px'></a> </div>";
                                          echo"</div>";
                                                      ?>
                                      </div>
                                  </div>
                              </div>
                                      
                                  
                                
                <hr>     
                <?php } ?>
                </div>
                </div>      
                <hr>
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
                                      <form method='post' action='add_comment.php' enctype='multipart/form-data'>
                                              <input type='hidden' id='topic_id' name='topic_id' value='$topic_id'>
                                              <input type='hidden' id='type' name='type' value='1'>
                                              <input type='hidden' id='comment_name' name='user_name' value='$valid_user'>
                     	                  <div class='form-group'>
                                              <label for='exampleFormControlTextarea1'>แสดงความคิดเห็น</label>
                                              <textarea class='form-control' id='comment' name='comment' rows='3' placeholder='Add comment' $read></textarea>
                      	                </div>
                                              <label for='exampleFormControlFile1'>อัพโหลดรูปภาพ</label>
                                              <input type='file' class='form-control-file' name='c_pic' $dis>
                                        <div class='card-footer d-flex flex-wrap justify-content-between align-items-center px-0 pt-0 pb-3'>
                                              <div class='px-4 pt-3'><input type='reset' value='Reset'$dis><input type='submit' value='Submit' id='submit' $dis> </div>
                                        </div>
                                      </from>
                              ";
                            ?>
             	                      </div>
                                </div>
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
