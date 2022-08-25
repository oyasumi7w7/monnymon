<!-- Slideshow container -->
<style>
/* Parent Container */
.content_img{
 position: relative;

}

/* Child Text Container */
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
 padding: 8px 15px;
 visibility: visible;
 opacity: 65%; 
}
</style>

<?php
$round=mysqli_query($con,"SELECT * FROM slide_show ")or die("SQL Error1==>".mysqli_error($con));
$r=mysqli_num_rows($round);
?>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <?php for($i=0;$i<$r;$i++) {?>
        <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i ?>"></li>
    <?php } ?>
  </ol>
  <?php $num=0;?>
  <div class="carousel-inner" data-interval="100" >
    
            <?php 
                $result=mysqli_query($con,"SELECT * FROM slide_show ")or die("Sql Error>>".mysqli_error($con));
                while(list($id,$name,$pic)=mysqli_fetch_row($result)){
            ?>
            <?php if($num==0) {?>
                <div class="carousel-item active">
                  <div class="content_img">
                    <img class="d-block w-100 " src="images/slide/<?php echo $pic ?>" alt="First slide" width="100%" height="500">
                    <div><?php echo $name ?></div>
                  </div>
                </div>
            <?php $num++;}else{ ?>
          <div class="carousel-item" data-interval="100" >
            <div class="content_img">
              <img class="d-block w-100" src="images/slide/<?php echo $pic ?>" alt="Second slide"width="100%" height="500">
              <div><?php echo $name ?></div>
            </div>
          </div>
            <?php } 
            }
            ?>
    
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>