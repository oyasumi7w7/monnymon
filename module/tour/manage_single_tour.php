
<?php
if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='index.php'</script>";
  }
  //$id=$_GET['tid'];
    $_SESSION['tour_id']=$_GET['tid'];
 
    if(empty($_GET['do'])){
      $do="";
   }else{
        $do=$_GET['do'];
   }
  
   if($do==1){
     echo '<script type="text/javascript">
           swal("", "จับคู่รอบตัดเชือกเรียบร้อย", "success");
           </script>';
   }elseif($do==2){
    echo '<script type="text/javascript">
    swal("", "กรุณาใส่ผู้ชนะการแข่ง", "error");
    </script>';
 }elseif($do==3){
  echo '<script type="text/javascript">
  swal("", "ใส่ผลการแข่งเสร็จสิ้น", "success");
  </script>';
}
?>
<meta charset="UTF-8">
<style>

html {
  height: 100%;
  width: 100%;
}

body {
  /* font-family: sans-serif; */
  margin: 0;
  height: 100%;
}

.tournament-headers {
  flex-grow: 1;
  display: flex;
  flex-direction: row;
  justify-content: space-around;
  border-bottom: 1px solid #ccc;
}
.tournament-headers h3 {
  width: 25%;
  text-align: center;
  font-weight: 400;
  border-right: 1px dashed #ccc;
  margin: 0;
  padding: 1rem;
}

.tournament-brackets {
  display: flex;
  flex-direction: row;
  list-style-type: none;
  background: #fdfdfd;
  margin-bottom: 50px;
}

.bracket {
  padding-left: 0;
  display: flex;
  margin: 0;
  padding: 30px 0;
  flex-grow: 1;
  flex-direction: column;
  justify-content: space-around;
  list-style-type: none;
  border-right: 1px dashed #ccc;
  flex: 1;
}

.team-item {
  background-color: #FFE4C4;
  padding: 0.5rem;
  display: block;
  margin: 0.5rem 10px;
  position: relative;
  vertical-align: middle;
  line-height: 2;
  text-align: center;
}

.team-item:after {
  content: "";
  border-color: #4f7a38;
  border-width: 2px;
  position: absolute;
  display: block;
  width: 10px;
  right: -11px;
}

.team-item:nth-of-type(odd):after {
  border-right-style: solid;
  border-top-style: solid;
  height: 100%;
  top: 50%;
}

.team-item:nth-of-type(even):after {
  border-right-style: solid;
  border-bottom-style: solid;
  height: 100%;
  top: -50%;
}

.team-item:before {
  content: "";
  border-top: 2px solid #4f7a38;
  position: absolute;
  height: 2px;
  width: 10px;
  left: -10px;
  top: 50%;
}
.bracket-1 .team-item:nth-of-type(odd):after {
  height: 70%;
  top: 50%;
}
.bracket-1 .team-item:nth-of-type(even):after {
  height: 60%;
  top: 5%;
}
.bracket-2 .team-item:nth-of-type(odd):after {
  height: 200%;
  top: 50%;
}
.bracket-2 .team-item:nth-of-type(even):after {
  height: 200%;
  top: -150%;
}
.bracket-2_2 .team-item:nth-of-type(odd):after {
  height: 100%;
  top: 50%;
}
.bracket-2_2 .team-item:nth-of-type(even):after {
  height: 60%;
  top: -8%;
}

.bracket-3 .team-item:nth-of-type(odd):after {
  height: 350%;
  top: 50%;
}
.bracket-3 .team-item:nth-of-type(even):after {
  height: 350%;
  top: -300%;
}
.bracket-3_2 .team-item:nth-of-type(odd):after {
  height: 120%;
  top: 50%;
}
.bracket-3_2 .team-item:nth-of-type(even):after {
  height: 120%;
  top: -65%;
}

.bracket-4 .team-item:nth-of-type(odd):after {
  height: 700%;
  top: 50%;
}
.bracket-4 .team-item:nth-of-type(even):after {
  height: 700%;
  top: -650%;
}

.bracket:first-of-type .team-item:before {
  display: none;
}

.bracket-4 .team-item:after {
  display: none;
}

.bracket:last-of-type .team-item:before,
.bracket:last-of-type .team-item:after {
  display: none;
}

.team-item time {
  display: inline-block;
  border-style:double;
  font-size: 0.8rem;
  padding: 0 0.6rem;
}
      </style>
      <?php
              $tour=mysqli_query($con,"SELECT tour_name FROM tournament WHERE tour_no='$_SESSION[tour_id]' ")or die("Sql Error1>>".mysqli_error($con));
                list($t_name)=mysqli_fetch_row($tour);
              ?>
<div class='site-section'>
      <div class='container'>
        <div class='row'>
          <div class='col-md-12 text-center'>
          <?php
                  echo "<a style='font-size:50px; color:#A52A2A; '>รอบตัดเชือก $t_name</a><br><br>";
                  echo "<a href='index.php?module=tour&action=match&tid=$_SESSION[tour_id]&page=idle' style='align: center; '><button type='button' class='btn btn-primary btn-ra ' >
      </i>รอบเก็บคะแนน</button></a><br><br>";
          ?>
            <div class="tournament-container">
              <div class="tournament-headers"><?php

                    $round_chk=mysqli_query($con,"SELECT num_round FROM single_tour WHERE t_id ='$_SESSION[tour_id]' group by num_round")or die("SQL Error==>".mysqli_error($con));
                    $round=mysqli_num_rows($round_chk);
                    if($round==4){
                      $chk=16;
                    }elseif($round==3){
                      $chk=8;
                    }
                    if($round==0){
                      echo "<h4 style='color: #B22222;'>NO MATCH</h4>";
                    }else{
                      for($i=0;$i<$round;$i++){
                        echo "<h3 style='color: #CD5C5C; background-color:white;'>Round of $chk </h3>";
                      $chk=$chk/2;
                    }
                     echo "<h3 style='color: #FFD700;background-color:white;'>Winner</h3>";
                    }
                      
                    
                    ?>
              </div>
              <div class="tournament-brackets">      
                      <?php 
                      if($round==4){  ?>
                          <ul class="bracket bracket-1" >
                            <?php $loop=16;$bye=1;$r_next=4;$big_round=1;$num=0;$position=0;
                            for($i=8;$i<$loop;$i++){?>
                                <?php $r4_1=mysqli_query($con,"SELECT single_tour.player_id1,tour_player.player_name,tour_player.player_lastname,position,next_round_id FROM single_tour INNER JOIN tour_player ON (tour_no='$_SESSION[tour_id]' AND single_tour.player_id1 = tour_player.player_id)
                                WHERE t_id ='$_SESSION[tour_id]' AND num_round ='4' AND round_id= '$i' ")or die("SQL Error==>".mysqli_error($con)); 
                                list($p1_r4,$p1_r4_name,$p1_r4_lastname,$pos,$next)=mysqli_fetch_row($r4_1); ?>

                                <?php $r4_2=mysqli_query($con,"SELECT single_tour.player_id2,tour_player.player_name,tour_player.player_lastname FROM single_tour INNER JOIN tour_player ON (tour_no='$_SESSION[tour_id]' AND single_tour.player_id2 = tour_player.player_id)
                                WHERE t_id ='$_SESSION[tour_id]' AND num_round ='4' AND round_id= '$i' ")or die("SQL Error==>".mysqli_error($con)); 
                                list($p2_r4,$p2_r4_name,$p2_r4_lastname)=mysqli_fetch_row($r4_2); 
                                        $name_lastr4=$p1_r4_name." ".$p1_r4_lastname;
                                        $name_lastr4_2=$p2_r4_name." ".$p2_r4_lastname;
                                        if(empty($p1_r4_name)){
                                          $wait_r4="<a style='color:#B22222; border-bottom:2px solid #00FF00;' >รอผลการแข่ง</a>" ;
                                        }else{
                                          $wait_r4=$name_lastr4;
                                        }
  
                                        if(empty($p2_r4_name)){
                                          $wait_r4_2="<a style='color:#B22222; border-bottom:2px solid #00FF00;' >รอผลการแข่ง</a>" ;
                                        }else{
                                          $wait_r4_2=$name_lastr4_2;
                                        }
                                
                                ?>
                                <?php if($pos==1){?>
                                  <?php $chk_pos=mysqli_query($con,"SELECT player_id1 FROM single_tour  WHERE t_id ='$_SESSION[tour_id]'  AND next_round_id ='$next' AND position='0' ")
                                              or die("SQL Error==>".mysqli_error($con)); 
                                              list($chk_pos0)=mysqli_fetch_row($chk_pos); ?>
                                              <?php if(empty($chk_pos0)){?>
                                                <?php
                                            if($big_round%2==0){
                                              $win_bye=mysqli_query($con,"SELECT single_tour.player_id1,tour_player.player_name,tour_player.player_lastname,position,next_round_id FROM single_tour INNER JOIN tour_player ON (tour_no='$_SESSION[tour_id]' AND single_tour.player_id1 = tour_player.player_id) WHERE t_id ='$_SESSION[tour_id]'  AND round_id ='$next' AND position='1' ")
                                              or die("SQL Error==>".mysqli_error($con)); 
                                              list($win_bye,$winbye_name,$winbye_lastname)=mysqli_fetch_row($win_bye);
                                              $win_full=$winbye_name." ".$winbye_lastname;
                                              }else{
                                                $win_bye=mysqli_query($con,"SELECT single_tour.player_id1,tour_player.player_name,tour_player.player_lastname,position,next_round_id FROM single_tour INNER JOIN tour_player ON (tour_no='$_SESSION[tour_id]' AND single_tour.player_id1 = tour_player.player_id) WHERE t_id ='$_SESSION[tour_id]'  AND round_id ='$next' AND position='0' ")
                                              or die("SQL Error==>".mysqli_error($con)); 
                                              list($win_bye,$winbye_name,$winbye_lastname)=mysqli_fetch_row($win_bye);
                                              $win_full=$winbye_name." ".$winbye_lastname;
                                              }?>
                                        <li class="team-item" style="color: black; font-weight: bold;" > <?php echo $win_full ?><br> <time style="color:red;">VS</time><br> <a style="color: red;">(ไม่มีคู่แข่งขัน)</a></li>
                                        <li class="team-item" style="color: black; font-weight: bold; "><?php echo $wait_r4 ?><br><time style="color:red;">VS</time><br> <?php echo $wait_r4_2 ?></li>
                                        <?php $loop--;$r_next++;$big_round++;}else{?> 
                                          <li class="team-item" style="color: black; font-weight: bold; "><?php echo $wait_r4 ?><br><time style="color:red;">VS</time><br> <?php echo $wait_r4_2 ?></li>
                                          <?php }?> 
                                  <?php }else{?> 
                                        <?php if(!empty($p1_r4)){?>
                                          <li class="team-item" style="color: black; font-weight: bold;"><?php echo $wait_r4 ?><br><time style="color:red;">VS</time><br> <?php echo $wait_r4_2 ?></li>
                                        <?php $bye++; 
                                       }else{?>
                                         <?php
                                         if($big_round==3){
                                           $position++;
                                           $big_round=1;
                                         }
                                          if($position==0){
                                                if($bye%2==0){
                                                  $win_bye1=mysqli_query($con,"SELECT single_tour.player_id2,tour_player.player_name,tour_player.player_lastname,position,next_round_id FROM single_tour INNER JOIN tour_player ON (tour_no='$_SESSION[tour_id]' AND single_tour.player_id2 = tour_player.player_id) WHERE t_id ='$_SESSION[tour_id]'  AND round_id ='$r_next' AND position='1' ")
                                                  or die("SQL Error==>".mysqli_error($con)); 
                                                  list($win_bye,$winbye_name,$winbye_lastname)=mysqli_fetch_row($win_bye1);
                                                  $win_full=$winbye_name." ".$winbye_lastname;
                                                  $bye++;$num++;$position++;
                                                }else{
                                                  $win_bye1=mysqli_query($con,"SELECT single_tour.player_id1,tour_player.player_name,tour_player.player_lastname,position,next_round_id FROM single_tour INNER JOIN tour_player ON (tour_no='$_SESSION[tour_id]' AND single_tour.player_id1 = tour_player.player_id) WHERE t_id ='$_SESSION[tour_id]'  AND round_id ='$r_next' AND position='1'  ")
                                                or die("SQL Error==>".mysqli_error($con)); 
                                                list($win_bye,$winbye_name,$winbye_lastname)=mysqli_fetch_row($win_bye1);
                                                $win_full=$winbye_name." ".$winbye_lastname;
                                                $bye++;$num++;
                                                }
                                                
                                          }else{
                                                if($bye%2==0){
                                                  $win_bye1=mysqli_query($con,"SELECT single_tour.player_id2,tour_player.player_name,tour_player.player_lastname,position,next_round_id FROM single_tour INNER JOIN tour_player ON (tour_no='$_SESSION[tour_id]' AND single_tour.player_id2 = tour_player.player_id) WHERE t_id ='$_SESSION[tour_id]'  AND round_id ='$r_next' AND position='0' ")
                                                  or die("SQL Error==>".mysqli_error($con)); 
                                                  list($win_bye,$winbye_name,$winbye_lastname)=mysqli_fetch_row($win_bye1);
                                                  $win_full=$winbye_name." ".$winbye_lastname;
                                                  $bye++;$num++;$position--;
                                                }else{
                                                  $win_bye1=mysqli_query($con,"SELECT single_tour.player_id1,tour_player.player_name,tour_player.player_lastname,position,next_round_id FROM single_tour INNER JOIN tour_player ON (tour_no='$_SESSION[tour_id]' AND single_tour.player_id1 = tour_player.player_id) WHERE t_id ='$_SESSION[tour_id]'  AND round_id ='$r_next' AND position='0'  ")
                                                or die("SQL Error==>".mysqli_error($con)); 
                                                list($win_bye,$winbye_name,$winbye_lastname)=mysqli_fetch_row($win_bye1);
                                                $win_full=$winbye_name." ".$winbye_lastname;
                                                $bye++;$num++;
                                                }
                                               
                                          }
                                                if($num==2){
                                                  $num=0;
                                                  $r_next++;
                                                }
                                                

                                                ?>
                                     <li class="team-item" style="color: black; font-weight: bold; "><?php echo $win_full  ?><br>  <time style="color:red;">VS</time> <br><a style="color: red;">(ไม่มีคู่แข่งขัน)</a></li>
                                        <?php }?> 
                                  <?php }?> 
                                <?php } ?>
                          
                          </ul>  
                          <ul class="bracket bracket-2">

                            <?php for($i=4;$i<8;$i++){?>
                                <?php $r3_1=mysqli_query($con,"SELECT single_tour.player_id1,tour_player.player_name,tour_player.player_lastname FROM single_tour INNER JOIN tour_player ON (tour_no='$_SESSION[tour_id]' AND single_tour.player_id1 = tour_player.player_id)
                                WHERE t_id ='$_SESSION[tour_id]' AND num_round ='3' AND round_id= '$i' ")or die("SQL Error==>".mysqli_error($con)); 
                                list($p1_r3,$p1_r3_name,$p1_r3_lastname)=mysqli_fetch_row($r3_1); ?>

                                <?php $r3_2=mysqli_query($con,"SELECT single_tour.player_id2,tour_player.player_name,tour_player.player_lastname FROM single_tour INNER JOIN tour_player ON (tour_no='$_SESSION[tour_id]' AND single_tour.player_id2 = tour_player.player_id)
                                WHERE t_id ='$_SESSION[tour_id]' AND num_round ='3' AND round_id= '$i' ")or die("SQL Error==>".mysqli_error($con)); 
                                list($p2_r3,$p2_r3_name,$p2_r3_lastname)=mysqli_fetch_row($r3_2); 
                                        $name_lastr3=$p1_r3_name." ".$p1_r3_lastname;
                                        $name_lastr3_2=$p2_r3_name." ".$p2_r3_lastname;
                                        if(empty($p1_r3_name)){
                                          $wait_r3="<button data-toggle='modal' data-target='#result_p$i'  class='btn btn-info'>Round 16 WIN</button>";
                                        }else{
                                          $wait_r3=$name_lastr3;
                                        }
  
                                        if(empty($p2_r3_name)){
                                          $wait_r3_2="<button data-toggle='modal' data-target='#result$i'  class='btn btn-info'>Round 16 WIN</button>";
                                        }else{
                                          $wait_r3_2=$name_lastr3_2;
                                        }
                                ?>

                                <?php if(!empty($p1_r3)){?>
                                  <li class="team-item" style="color: black; font-weight: bold;"><?php echo $wait_r3 ?><br> <time style="color:red;">VS</time><br> <?php echo $wait_r3_2 ?></li>
                                  <?php }else{?>
                                  <li class="team-item" style="color: black; font-weight: bold;"> <?php echo $wait_r3 ?><br> <time style="color:red;">VS</time> <br> <?php echo $wait_r3_2 ?></li>
                                <?php }?> 
                            <?php } ?>

                          </ul>  
                          <ul class="bracket bracket-3">
                            <?php for($i=2;$i<4;$i++){?>
                                <?php $r2_1=mysqli_query($con,"SELECT single_tour.player_id1,tour_player.player_name,tour_player.player_lastname FROM single_tour INNER JOIN tour_player ON (tour_no='$_SESSION[tour_id]' AND single_tour.player_id1 = tour_player.player_id)
                                WHERE t_id ='$_SESSION[tour_id]' AND num_round ='2' AND round_id= '$i' ")or die("SQL Error==>".mysqli_error($con)); 
                                list($p1_r2,$p1_r2_name,$p1_r2_lastname)=mysqli_fetch_row($r2_1); ?>

                                <?php $r2_2=mysqli_query($con,"SELECT single_tour.player_id2,tour_player.player_name,tour_player.player_lastname FROM single_tour INNER JOIN tour_player ON (tour_no='$_SESSION[tour_id]' AND single_tour.player_id2 = tour_player.player_id)
                                WHERE t_id ='$_SESSION[tour_id]' AND num_round ='2' AND round_id= '$i' ")or die("SQL Error==>".mysqli_error($con)); 
                                list($p2_r2,$p2_r2_name,$p2_r2_lastname)=mysqli_fetch_row($r2_2); 
                                        $name_lastr2=$p1_r2_name." ".$p1_r2_lastname;
                                        $name_lastr2_2=$p2_r2_name." ".$p2_r2_lastname;
                                        if(empty($p1_r2_name)){
                                          $wait_r2="<button data-toggle='modal' data-target='#result_p$i'  class='btn btn-info'>Round 8 WIN</button>";
                                        }else{
                                          $wait_r2=$name_lastr2;
                                        }
  
                                        if(empty($p2_r2_name)){
                                          $wait_r2_2="<button data-toggle='modal' data-target='#result$i'  class='btn btn-info'>Round 8 WIN</button>";
                                        }else{
                                          $wait_r2_2=$name_lastr2_2;
                                        }
                                ?>

                                <?php if(!empty($p1_r2)){?>
                                  <li class="team-item" style="color: black; font-weight: bold;"><?php echo $wait_r2 ?> <br><time style="color:red;">VS</time> <br><?php echo $wait_r2_2 ?></li>
                                  <?php }else{?>
                                  <li class="team-item" style="color: black; font-weight: bold;"><?php echo $wait_r2 ?> <br> <time style="color:red;">VS</time><br><?php echo $wait_r2_2 ?></li>
                                <?php }?> 
                            <?php } ?>
                                 

                          </ul>  
                          <ul class="bracket bracket-4">

                          <?php $r1_1=mysqli_query($con,"SELECT single_tour.player_id1,tour_player.player_name,tour_player.player_lastname FROM single_tour INNER JOIN tour_player ON (tour_no='$_SESSION[tour_id]' AND single_tour.player_id1 = tour_player.player_id)
                          WHERE t_id ='$_SESSION[tour_id]' AND num_round ='1' ")or die("SQL Error==>".mysqli_error($con)); 
                          list($p1_r1,$p1_r1_name,$p1_r1_lastname)=mysqli_fetch_row($r1_1); ?>

                          <?php $r1_2=mysqli_query($con,"SELECT single_tour.player_id2,tour_player.player_name,tour_player.player_lastname FROM single_tour INNER JOIN tour_player ON (tour_no='$_SESSION[tour_id]' AND single_tour.player_id2 = tour_player.player_id)
                          WHERE t_id ='$_SESSION[tour_id]' AND num_round ='1' ")or die("SQL Error==>".mysqli_error($con)); 
                          list($p2_r1,$p2_r1_name,$p2_r1_lastname)=mysqli_fetch_row($r1_2); 
                                        $name_lastr1=$p1_r1_name." ".$p1_r1_lastname;
                                        $name_lastr1_2=$p2_r1_name." ".$p2_r1_lastname;
                                        if(empty($p1_r1_name)){
                                          $wait_r1="<button data-toggle='modal' data-target='#result_p1'  class='btn btn-info'>Round 4 WIN</button>";
                                        }else{
                                          $wait_r1=$name_lastr1;
                                        }
   
                                        if(empty($p2_r1_name)){
                                          $wait_r1_2="<button data-toggle='modal' data-target='#result1'  class='btn btn-info'>Round 4 WIN</button>";
                                        }else{
                                          $wait_r1_2=$name_lastr1_2;
                                        }
                          ?>

                                  <li class="team-item" style="color: black; font-weight: bold;"><?php echo $wait_r1 ?><br> <time style="color:red;">VS</time> <br><?php echo $wait_r1_2 ?></li>

                          </ul>
                          <?php
                          $final=mysqli_query($con,"SELECT single_tour.winner,tour_player.player_name,tour_player.player_lastname FROM single_tour INNER JOIN tour_player ON (tour_no='$_SESSION[tour_id]' AND single_tour.winner = tour_player.player_id)
                          WHERE t_id ='$_SESSION[tour_id]' AND num_round ='1' AND round_id='1' ")or die("SQL Error==>".mysqli_error($con));
                          list($last_winner,$winner_name,$winner_lastname)=mysqli_fetch_row($final);
                          ?>
                          <ul class="bracket bracket-5">
                          <?php if(empty($last_winner)){?>
                              <li class="team-item" style="color: black; font-weight: bold;  border: 5px dotted  #FF7F50; border-bottom: 5px double #00008B;"><button data-toggle='modal' data-target='#result_final'  class='btn btn-info'>Round 2 WIN</button></li>
                          <?php }else{ ?>
                              <li class="team-item" style="color: black; font-weight: bold;  border: 5px dotted  #FF7F50; border-bottom: 5px double #00008B;"><?php echo $winner_name?> <?php echo $winner_lastname?></li>
                          
                          <?php }  ?>
                          </ul>  






                      <?php }elseif($round==3) {?>
                          <ul class="bracket bracket-2_2" >
                           
                            <?php  $loop=8;$bye=1;$r_next=2;$big_round=1;
                            for($i=4;$i<$loop;$i++){?>
                                  <?php $r3_1=mysqli_query($con,"SELECT single_tour.player_id1,tour_player.player_name,tour_player.player_lastname,position,next_round_id FROM single_tour INNER JOIN tour_player ON (tour_no='$_SESSION[tour_id]' AND single_tour.player_id1 = tour_player.player_id)
                                  WHERE t_id ='$_SESSION[tour_id]' AND num_round ='3' AND round_id= '$i' ")or die("SQL Error==>".mysqli_error($con)); 
                                  list($p1_r3,$p1_r3_name,$p1_r3_lastname,$pos,$next)=mysqli_fetch_row($r3_1); ?>

                                  <?php $r3_2=mysqli_query($con,"SELECT single_tour.player_id2,tour_player.player_name,tour_player.player_lastname FROM single_tour INNER JOIN tour_player ON (tour_no='$_SESSION[tour_id]' AND single_tour.player_id2 = tour_player.player_id)
                                  WHERE t_id ='$_SESSION[tour_id]' AND num_round ='3' AND round_id= '$i' ")or die("SQL Error==>".mysqli_error($con)); 
                                  list($p2_r3,$p2_r3_name,$p2_r3_lastname)=mysqli_fetch_row($r3_2); 
                                        $name_lastr3=$p1_r3_name." ".$p1_r3_lastname;
                                        $name_lastr3_2=$p2_r3_name." ".$p2_r3_lastname;
                                        if(empty($p1_r3_name)){
                                          $wait_r3="<a style='color:#B22222; border-bottom:2px solid #00FF00;' >รอผลการแข่ง</a>" ;
                                        }else{
                                          $wait_r3=$name_lastr3;
                                        }
   
                                        if(empty($p2_r3_name)){
                                          $wait_r3_2="<a style='color:#B22222; border-bottom:2px solid #00FF00;' >รอผลการแข่ง</a>" ;
                                        }else{
                                          $wait_r3_2=$name_lastr3_2;
                                        }
                                  ?>
                                  <?php if($pos==1){?>
                                              <?php $chk_pos=mysqli_query($con,"SELECT player_id1 FROM single_tour  WHERE t_id ='$_SESSION[tour_id]'  AND next_round_id ='$next' AND position='0' ")
                                              or die("SQL Error==>".mysqli_error($con)); 
                                              list($chk_pos0)=mysqli_fetch_row($chk_pos); ?>
                                              <?php if(empty($chk_pos0)){?>

                                            <?php
                                            if($big_round%2==0){
                                              $win_bye=mysqli_query($con,"SELECT single_tour.player_id1,tour_player.player_name,tour_player.player_lastname,position,next_round_id FROM single_tour INNER JOIN tour_player ON (tour_no='$_SESSION[tour_id]' AND single_tour.player_id1 = tour_player.player_id) WHERE t_id ='$_SESSION[tour_id]'  AND round_id ='$next' AND position='1' ")
                                              or die("SQL Error==>".mysqli_error($con)); 
                                              list($win_bye,$winbye_name,$winbye_lastname)=mysqli_fetch_row($win_bye);
                                              $win_full=$winbye_name." ".$winbye_lastname;
                                              }else{
                                                $win_bye=mysqli_query($con,"SELECT single_tour.player_id1,tour_player.player_name,tour_player.player_lastname,position,next_round_id FROM single_tour INNER JOIN tour_player ON (tour_no='$_SESSION[tour_id]' AND single_tour.player_id1 = tour_player.player_id) WHERE t_id ='$_SESSION[tour_id]'  AND round_id ='$next' AND position='0' ")
                                              or die("SQL Error==>".mysqli_error($con)); 
                                              list($win_bye,$winbye_name,$winbye_lastname)=mysqli_fetch_row($win_bye);
                                              $win_full=$winbye_name." ".$winbye_lastname;
                                              }?>
                                        <li class="team-item" style="color: black; font-weight: bold;" > <?php echo $win_full ?><br> <time style="color:red;">VS</time><br> <a style="color: red;">(ไม่มีคู่แข่งขัน)</a></li>
                                        <li class="team-item" style="color: black; font-weight: bold; "><?php echo $wait_r3 ?><br>  <time style="color:red;">VS</time> <br><?php echo $wait_r3_2 ?></li>
                                        
                                        <?php $loop--; $r_next++;$big_round++;}else{?> 
                                          <li class="team-item" style="color: black; font-weight: bold; "><?php echo $wait_r3 ?><br>  <time style="color:red;">VS</time> <br><?php echo $wait_r3_2 ?></li>
                                          <?php }?> 
                                  <?php }else{?> 
                                  <?php if(!empty($p1_r3)){?>
                                    <li class="team-item" style="color: black; font-weight: bold; "><?php echo $wait_r3 ?><br>  <time style="color:red;">VS</time> <br><?php echo $wait_r3_2 ?></li>

                                    <?php $bye++; 
                                    
                                  
                                    }else{?>
                                                <?php
                                                if($bye%2==0){
                                                  $win_bye1=mysqli_query($con,"SELECT single_tour.player_id2,tour_player.player_name,tour_player.player_lastname,position,next_round_id FROM single_tour INNER JOIN tour_player ON (tour_no='$_SESSION[tour_id]' AND single_tour.player_id2 = tour_player.player_id) WHERE t_id ='$_SESSION[tour_id]'  AND round_id ='$r_next' AND position='1' ")
                                                  or die("SQL Error==>".mysqli_error($con)); 
                                                  list($win_bye,$winbye_name,$winbye_lastname)=mysqli_fetch_row($win_bye1);
                                                  $win_full=$winbye_name." ".$winbye_lastname;
                                                  $bye++;
                                                }else{
                                                  $win_bye1=mysqli_query($con,"SELECT single_tour.player_id1,tour_player.player_name,tour_player.player_lastname,position,next_round_id FROM single_tour INNER JOIN tour_player ON (tour_no='$_SESSION[tour_id]' AND single_tour.player_id1 = tour_player.player_id) WHERE t_id ='$_SESSION[tour_id]'  AND round_id ='$r_next' AND position='1' ")
                                                or die("SQL Error==>".mysqli_error($con)); 
                                                list($win_bye,$winbye_name,$winbye_lastname)=mysqli_fetch_row($win_bye1);
                                                $win_full=$winbye_name." ".$winbye_lastname;
                                                $bye++;
                                                }
                                                

                                                ?>
                                     <li class="team-item" style="color: black; font-weight: bold; "><?php echo $win_full ?><br>  <time style="color:red;">VS</time> <br><a style="color: red;">(ไม่มีคู่แข่งขัน)</a></li>
                                  <?php }?> 
                               <?php }
                               
                               ?> 
                            <?php  }?>
                                  <!-- <li class="team-item">QF3 <time>20:00</time> QF4</li>
                                  <li class="team-item">QF5 <time>20:00</time> QF6</li>
                                  <li class="team-item">QF7 <time>20:00</time> QF8</li> -->

                          </ul>  
                          <ul class="bracket bracket-3_2">
                            <?php for($i=2;$i<4;$i++){?>
                                <?php $r2_1=mysqli_query($con,"SELECT single_tour.player_id1,tour_player.player_name,tour_player.player_lastname FROM single_tour INNER JOIN tour_player ON (tour_no='$_SESSION[tour_id]' AND single_tour.player_id1 = tour_player.player_id)
                                WHERE t_id ='$_SESSION[tour_id]' AND num_round ='2' AND round_id= '$i' ")or die("SQL Error==>".mysqli_error($con)); 
                                list($p1_r2,$p1_r2_name,$p1_r2_lastname)=mysqli_fetch_row($r2_1); ?>

                                <?php $r2_2=mysqli_query($con,"SELECT single_tour.player_id2,tour_player.player_name,tour_player.player_lastname FROM single_tour INNER JOIN tour_player ON (tour_no='$_SESSION[tour_id]' AND single_tour.player_id2 = tour_player.player_id)
                                WHERE t_id ='$_SESSION[tour_id]' AND num_round ='2' AND round_id= '$i' ")or die("SQL Error==>".mysqli_error($con)); 
                                list($p2_r2,$p2_r2_name,$p2_r2_lastname)=mysqli_fetch_row($r2_2); 
                                      $name_lastr2=$p1_r2_name." ".$p1_r2_lastname;
                                      $name_lastr2_2=$p2_r2_name." ".$p2_r2_lastname;
                                      if(empty($p1_r2_name)){
                                        $wait_r2="<button data-toggle='modal' data-target='#result_p$i'  class='btn btn-info'>Round 8 WIN</button>";
                                      }else{
                                        $wait_r2=$name_lastr2;
                                      }
 
                                      if(empty($p2_r2_name)){
                                  
                                        $wait_r2_2="<button data-toggle='modal' data-target='#result$i'  class='btn btn-info'>Round 8 WIN</button>";
                                        // $wait_r2_2="<a style='color:#B22222; border-bottom:2px solid #00FF00;' >รอผลการแข่ง</a>" ;
                                      }else{
                                        $wait_r2_2=$name_lastr2_2;
                                      }
                                ?>
                                

                                <?php if(!empty($p1_r2)){?>
                                  <li class="team-item" style="color: black; font-weight: bold;"><?php echo $wait_r2 ?><br> <time style="color:red;">VS</time> <br><?php echo $wait_r2_2 ?></li>
                                  <?php }else{?>
                                  <li class="team-item" style=""> <?php echo $wait_r2 ?><br> <time style="color:red;">VS</time> <br><?php echo $wait_r2_2 ?></li>
                                <?php }?> 
                            <?php } ?>
                                 

                          </ul> 
                          
                          <ul class="bracket bracket-4">

                          <?php $r1_1=mysqli_query($con,"SELECT single_tour.player_id1,tour_player.player_name,tour_player.player_lastname FROM single_tour INNER JOIN tour_player ON (tour_no='$_SESSION[tour_id]' AND single_tour.player_id1 = tour_player.player_id)
                          WHERE t_id ='$_SESSION[tour_id]' AND num_round ='1' ")or die("SQL Error==>".mysqli_error($con)); 
                          list($p1_r1,$p1_r1_name,$p1_r1_lastname)=mysqli_fetch_row($r1_1); ?>

                          <?php $r1_2=mysqli_query($con,"SELECT single_tour.player_id2,tour_player.player_name,tour_player.player_lastname FROM single_tour INNER JOIN tour_player ON (tour_no='$_SESSION[tour_id]' AND single_tour.player_id2 = tour_player.player_id)
                          WHERE t_id ='$_SESSION[tour_id]' AND num_round ='1' ")or die("SQL Error==>".mysqli_error($con)); 
                          list($p2_r1,$p2_r1_name,$p2_r1_lastname)=mysqli_fetch_row($r1_2); 
                                $name_lastr1=$p1_r1_name." ".$p1_r1_lastname;
                                $name_lastr1_2=$p2_r1_name." ".$p2_r1_lastname;
                                if(empty($p1_r1_name)){
                                  $wait_r1="<button data-toggle='modal' data-target='#result_p1'  class='btn btn-info'>Round 4 WIN</button>";
                                }else{
                                  $wait_r1=$name_lastr1;
                                }
                                if(empty($p2_r1_name)){
                                  $wait_r1_2="<button data-toggle='modal' data-target='#result1'  class='btn btn-info'>Round 4 WIN</button>";
                                }else{
                                  $wait_r1_2=$name_lastr1_2;
                                }
                                
                          ?>

                                  <li class="team-item" style="color: black; font-weight: bold;"><?php echo $wait_r1 ?><br> <time style="color:red;">VS</time> <br><?php echo $wait_r1_2 ?></li>

                          </ul>
                          <?php
                          $final=mysqli_query($con,"SELECT single_tour.winner,tour_player.player_name,tour_player.player_lastname FROM single_tour INNER JOIN tour_player ON (tour_no='$_SESSION[tour_id]' AND single_tour.winner = tour_player.player_id)
                          WHERE t_id ='$_SESSION[tour_id]' AND num_round ='1' AND round_id='1' ")or die("SQL Error==>".mysqli_error($con));
                          list($last_winner,$winner_name,$winner_lastname)=mysqli_fetch_row($final);
                          ?>
                          <ul class="bracket bracket-5">
                          <?php if(empty($last_winner)){?>
                            <li class="team-item" style="color: black; font-weight: bold;  border: 5px dotted  #FF7F50; border-bottom: 5px double #00008B;"><button data-toggle='modal' data-target='#result_final'  class='btn btn-info'>Round 2 WIN</button></li>
                          <?php }else{ ?>
                              
                              <li class="team-item" style="color: black; font-weight: bold;  border: 5px dotted  #FF7F50; border-bottom: 5px double #00008B;"><?php echo $winner_name?> <?php echo $winner_lastname?></li>
                          
                          <?php }  ?>
                          </ul>  
                     
                      <?php }else{?>

                      <?php }?>
              </div>
            </div>
          </div>
        </div>


                  </div>
            </div>
      </div>
</div>
                            <?php for($i=0;$i<16;$i++){?>
                                                   
                              <div class="modal hide fade in" style=" margin-top:100px" id="result<?php echo $i ?>" > 
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                          <p>จัดการผลการแข่ง <?php echo $i?></p>
                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
                                    </div>
                                        <div class="modal-body ">
                                          <form action="index.php?module=tour&action=final_result" method="post" enctype="multipart/form-data" class="form-horizontal">
                                          <?php
                                                $chk_bat=mysqli_query($con,"SELECT player_id1,player_id2 FROM single_tour 
                                                WHERE t_id ='$_SESSION[tour_id]' AND next_round_id= '$i' AND position='1' ")or die("SQL Error==>".mysqli_error($con)); 
                                                      list($p1_bat1,$p2_bat1)=mysqli_fetch_row($chk_bat); 
                                                ?>
                                                <input type="hidden" id="round_id" name="round_id" value="<?php echo $i;?>">
                                                <input type="hidden" id="position" name="position" value="1">

                                      	              <select name="result" class="form-control-select"  style="max-width:30%; ">
                                                              <option value="" >-- เลือกผู้ชนะ --</option>
                                              <?php
                                                        $result=mysqli_query($con,"SELECT player_id,player_name,player_lastname FROM tour_player WHERE tour_no='$_SESSION[tour_id]' AND player_id in ('$p1_bat1','$p2_bat1') ") or die(mysqli_error($con));
                                                        while(list($p_id,$p_name,$p_lastname)=mysqli_fetch_row($result)){
                                                    
                                                              echo"<option value='$p_id'>$p_name $p_lastname</option>";
                                                        }
                                                      
                                                      echo "</select>";
                                                      mysqli_free_result($result);
                                              ?>
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
                                                  <?php for($i=0;$i<16;$i++){?>
                                                   
                                                   <div class="modal hide fade in" style=" margin-top:100px" id="result_p<?php echo $i ?>" > 
                                                     <div class="modal-dialog">
                                                       <div class="modal-content">
                                                         <div class="modal-header">
                                                               <p>จัดการผลการแข่ง <?php echo $i?></p>
                                                               <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
                                                         </div>
                                                             <div class="modal-body ">
                                                               <form action="index.php?module=tour&action=final_result" method="post"  enctype="multipart/form-data" class="form-horizontal" >
                                                               <?php
                                                                     $chk_bat=mysqli_query($con,"SELECT player_id1,player_id2 FROM single_tour 
                                                                     WHERE t_id ='$_SESSION[tour_id]' AND next_round_id= '$i' AND position='0' ")or die("SQL Error==>".mysqli_error($con)); 
                                                                           list($p1_bat1,$p2_bat1)=mysqli_fetch_row($chk_bat); 
                                                                     ?>
                                                                      <input type="hidden" id="round_id" name="round_id" value="<?php echo $i?>">
                                                                      <input type="hidden" id="position" name="position" value="0">
                                                                   
                                                                           <select name="result" class="form-control-select"  style=" max-width:30%; ">
                                                                           
                                                                                   <option value="" >-- เลือกผู้ชนะ --</option>
                                                                   <?php
                                                                             $result=mysqli_query($con,"SELECT player_id,player_name,player_lastname FROM tour_player WHERE tour_no='$_SESSION[tour_id]' AND player_id in ('$p1_bat1','$p2_bat1') ") or die(mysqli_error($con));
                                                                             while(list($p_id,$p_name,$p_lastname)=mysqli_fetch_row($result)){
                                                                         
                                                                                   echo"<option value='$p_id'>$p_name $p_lastname</option>";
                                                                             }
                                                                           
                                                                           echo "</select>";
                                                                           
                                                                           mysqli_free_result($result);
                                                                   ?>
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
                                                 <div class="modal hide fade in" style=" margin-top:100px" id="result_final" > 
                                                     <div class="modal-dialog">
                                                       <div class="modal-content">
                                                         <div class="modal-header">
                                                               <p>จัดการผลการแข่งคู่รอบชิง</p>
                                                               <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
                                                         </div>
                                                             <div class="modal-body ">
                                                               <form action="index.php?module=tour&action=final_result" method="post"  enctype="multipart/form-data" class="form-horizontal" >
                                                               <?php
                                                                     $chk_bat=mysqli_query($con,"SELECT player_id1,player_id2 FROM single_tour 
                                                                     WHERE t_id ='$_SESSION[tour_id]' AND round_id= '1' ")or die("SQL Error==>".mysqli_error($con)); 
                                                                           list($p1_bat1,$p2_bat1)=mysqli_fetch_row($chk_bat); 
                                                                     ?>
                                                                          <input type="hidden" id="round_id" name="round_id" value="1">
                                                                          <input type="hidden" id="winner" name="winner" value="winner">
                                                                   
                                                                           <select name="result" class="form-control-select"  style=" max-width:30%; ">
                                                                           
                                                                                   <option value="" >-- เลือกผู้ชนะ --</option>
                                                                   <?php
                                                                             $result=mysqli_query($con,"SELECT player_id,player_name,player_lastname FROM tour_player WHERE tour_no='$_SESSION[tour_id]' AND player_id in ('$p1_bat1','$p2_bat1') ") or die(mysqli_error($con));
                                                                             while(list($p_id,$p_name,$p_lastname)=mysqli_fetch_row($result)){
                                                                         
                                                                                   echo"<option value='$p_id'>$p_name $p_lastname</option>";
                                                                             }
                                                                           
                                                                           echo "</select>";
                                                                           
                                                                           mysqli_free_result($result);
                                                                   ?>
                                                                 <div class="modal-footer">
                                                                     <button class="btn btn-success" id="submit"><i class="glyphicon glyphicon-inbox"></i> Submit</button>
                                                                 </div>
                                                               </form>
                                                             </div>
                                                       </div>
                                                     </div>
                                                   </div>