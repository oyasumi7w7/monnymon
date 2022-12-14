<?php
session_start();

include("include/connect_db.php");
$con=connect_db();
$tid=$_GET['tid'];

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
      html {
  height: 100%;
  width: 100%;
}

body {
  font-family: sans-serif;
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
  height: 50%;
  top: 7%;
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
  
  <body>
  
<div class="site-wrap">
      <?php require_once ("include/header.php"); ?>
              <?php
              $tour=mysqli_query($con,"SELECT tour_name FROM tournament WHERE tour_no='$tid' ")or die("Sql Error1>>".mysqli_error($con));
                list($t_name)=mysqli_fetch_row($tour);
              ?>
  <div class="bg-light py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mb-0"><a href="main.php">Home</a> <span class="mx-2 mb-0">/</span> <a href="idle_tour.php">Tournament</a> <span class="mx-2 mb-0">/</span> <a href="tour_result_view.php">Schedule - ResultsSchedule - Results</a> <span class="mx-2 mb-0">/</span> <a href="show_result.php?tid=<?php echo $tid; ?>"><?php echo $t_name; ?></a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Single-Elimination Tournament</strong></div>
        </div>
      </div>
    </div>

    <div class='site-section'>
      <div class='container'>
        <div class='row'>
          <div class='col-md-12 text-center'>
          <?php
                  echo "<a style='font-size:50px; color:#A52A2A; '>????????????????????????????????? $t_name</a><br><br>";
                  echo "<a href='match_show_table.php?tid=$tid&action=round1' style='align: center; '><button type='button' class='btn' style='font-size:20px; color:#FFA500; background-color:white; border-color:#FFA500; border-width: 5px;' >
                  ????????????????????????????????????????????????????????????</button></a>&nbsp; &nbsp;<br><br><br> ";
          ?>
            <div class="tournament-container">
              <div class="tournament-headers"><?php

                    $round_chk=mysqli_query($con,"SELECT num_round FROM single_tour WHERE t_id ='$tid' group by num_round")or die("SQL Error==>".mysqli_error($con));
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
                        echo "<h3 style='color: #CD5C5C;'>Round of $chk </h3>";
                      $chk=$chk/2;
                    }
                     echo "<h3 style='color: #FFD700;'>Winner</h3>";
                    }
                      
                    
                    ?>
              </div>
              <div class="tournament-brackets">      
                      <?php if($round==4){  ?>
                        <ul class="bracket bracket-1" >
                            <?php $loop=16;$bye=1;$r_next=4;$big_round=1;$num=0;$position=0;
                            for($i=8;$i<$loop;$i++){?>
                                <?php $r4_1=mysqli_query($con,"SELECT single_tour.player_id1,tour_player.player_name,tour_player.player_lastname,position,next_round_id FROM single_tour INNER JOIN tour_player ON (tour_no='$tid' AND single_tour.player_id1 = tour_player.player_id)
                                WHERE t_id ='$tid' AND num_round ='4' AND round_id= '$i' ")or die("SQL Error==>".mysqli_error($con)); 
                                list($p1_r4,$p1_r4_name,$p1_r4_lastname,$pos,$next)=mysqli_fetch_row($r4_1); ?>

                                <?php $r4_2=mysqli_query($con,"SELECT single_tour.player_id2,tour_player.player_name,tour_player.player_lastname FROM single_tour INNER JOIN tour_player ON (tour_no='$tid' AND single_tour.player_id2 = tour_player.player_id)
                                WHERE t_id ='$tid' AND num_round ='4' AND round_id= '$i' ")or die("SQL Error==>".mysqli_error($con)); 
                                list($p2_r4,$p2_r4_name,$p2_r4_lastname)=mysqli_fetch_row($r4_2); 
                                        $name_lastr4=$p1_r4_name." ".$p1_r4_lastname;
                                        $name_lastr4_2=$p2_r4_name." ".$p2_r4_lastname;
                                        if(empty($p1_r4_name)){
                                          $wait_r4="<a style='color:#B22222' >?????????????????????????????????</a>" ;
                                        }else{
                                          $wait_r4=$name_lastr4;
                                        }
  
                                        if(empty($p2_r4_name)){
                                          $wait_r4_2="<a style='color:#B22222' >?????????????????????????????????</a>" ;
                                        }else{
                                          $wait_r4_2=$name_lastr4_2;
                                        }
                                
                                ?>
                                <?php if($pos==1){?>
                                  <?php $chk_pos=mysqli_query($con,"SELECT player_id1 FROM single_tour  WHERE t_id ='$tid'  AND next_round_id ='$next' AND position='0' ")
                                              or die("SQL Error==>".mysqli_error($con)); 
                                              list($chk_pos0)=mysqli_fetch_row($chk_pos); ?>
                                              <?php if(empty($chk_pos0)){?>
                                                <?php
                                            if($big_round%2==0){
                                              $win_bye=mysqli_query($con,"SELECT single_tour.player_id1,tour_player.player_name,tour_player.player_lastname,position,next_round_id FROM single_tour INNER JOIN tour_player ON (tour_no='$tid' AND single_tour.player_id1 = tour_player.player_id) WHERE t_id ='$tid'  AND round_id ='$next' AND position='1' ")
                                              or die("SQL Error==>".mysqli_error($con)); 
                                              list($win_bye,$winbye_name,$winbye_lastname)=mysqli_fetch_row($win_bye);
                                              $win_full=$winbye_name." ".$winbye_lastname;
                                              }else{
                                                $win_bye=mysqli_query($con,"SELECT single_tour.player_id1,tour_player.player_name,tour_player.player_lastname,position,next_round_id FROM single_tour INNER JOIN tour_player ON (tour_no='$tid' AND single_tour.player_id1 = tour_player.player_id) WHERE t_id ='$tid'  AND round_id ='$next' AND position='0' ")
                                              or die("SQL Error==>".mysqli_error($con)); 
                                              list($win_bye,$winbye_name,$winbye_lastname)=mysqli_fetch_row($win_bye);
                                              $win_full=$winbye_name." ".$winbye_lastname;
                                              }?>
                                        <li class="team-item" style="color: black; font-weight: bold;" > <?php echo $win_full ?><br> <time style="color:red;">VS</time><br> <a style="color: red;">(?????????????????????????????????????????????)</a></li>
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
                                                  $win_bye1=mysqli_query($con,"SELECT single_tour.player_id2,tour_player.player_name,tour_player.player_lastname,position,next_round_id FROM single_tour INNER JOIN tour_player ON (tour_no='$tid' AND single_tour.player_id2 = tour_player.player_id) WHERE t_id ='$tid'  AND round_id ='$r_next' AND position='1' ")
                                                  or die("SQL Error==>".mysqli_error($con)); 
                                                  list($win_bye,$winbye_name,$winbye_lastname)=mysqli_fetch_row($win_bye1);
                                                  $win_full=$winbye_name." ".$winbye_lastname;
                                                  $bye++;$num++;$position++;
                                                }else{
                                                  $win_bye1=mysqli_query($con,"SELECT single_tour.player_id1,tour_player.player_name,tour_player.player_lastname,position,next_round_id FROM single_tour INNER JOIN tour_player ON (tour_no='$tid' AND single_tour.player_id1 = tour_player.player_id) WHERE t_id ='$tid'  AND round_id ='$r_next' AND position='1'  ")
                                                or die("SQL Error==>".mysqli_error($con)); 
                                                list($win_bye,$winbye_name,$winbye_lastname)=mysqli_fetch_row($win_bye1);
                                                $win_full=$winbye_name." ".$winbye_lastname;
                                                $bye++;$num++;
                                                }
                                                
                                          }else{
                                                if($bye%2==0){
                                                  $win_bye1=mysqli_query($con,"SELECT single_tour.player_id2,tour_player.player_name,tour_player.player_lastname,position,next_round_id FROM single_tour INNER JOIN tour_player ON (tour_no='$tid' AND single_tour.player_id2 = tour_player.player_id) WHERE t_id ='$tid'  AND round_id ='$r_next' AND position='0' ")
                                                  or die("SQL Error==>".mysqli_error($con)); 
                                                  list($win_bye,$winbye_name,$winbye_lastname)=mysqli_fetch_row($win_bye1);
                                                  $win_full=$winbye_name." ".$winbye_lastname;
                                                  $bye++;$num++;$position--;
                                                }else{
                                                  $win_bye1=mysqli_query($con,"SELECT single_tour.player_id1,tour_player.player_name,tour_player.player_lastname,position,next_round_id FROM single_tour INNER JOIN tour_player ON (tour_no='$tid' AND single_tour.player_id1 = tour_player.player_id) WHERE t_id ='$tid'  AND round_id ='$r_next' AND position='0'  ")
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
                                     <li class="team-item" style="color: black; font-weight: bold; "><?php echo $win_full  ?><br>  <time style="color:red;">VS</time> <br> <a style="color: red;">(?????????????????????????????????????????????)</a></li>
                                        <?php }?> 
                                  <?php }?> 
                                <?php } ?>
                          
                          </ul>  
                          <ul class="bracket bracket-2">

                            <?php for($i=4;$i<8;$i++){?>
                                <?php $r3_1=mysqli_query($con,"SELECT single_tour.player_id1,tour_player.player_name,tour_player.player_lastname FROM single_tour INNER JOIN tour_player ON (tour_no='$tid' AND single_tour.player_id1 = tour_player.player_id)
                                WHERE t_id ='$tid' AND num_round ='3' AND round_id= '$i' ")or die("SQL Error==>".mysqli_error($con)); 
                                list($p1_r3,$p1_r3_name,$p1_r3_lastname)=mysqli_fetch_row($r3_1); ?>

                                <?php $r3_2=mysqli_query($con,"SELECT single_tour.player_id2,tour_player.player_name,tour_player.player_lastname FROM single_tour INNER JOIN tour_player ON (tour_no='$tid' AND single_tour.player_id2 = tour_player.player_id)
                                WHERE t_id ='$tid' AND num_round ='3' AND round_id= '$i' ")or die("SQL Error==>".mysqli_error($con)); 
                                list($p2_r3,$p2_r3_name,$p2_r3_lastname)=mysqli_fetch_row($r3_2); 
                                        $name_lastr3=$p1_r3_name." ".$p1_r3_lastname;
                                        $name_lastr3_2=$p2_r3_name." ".$p2_r3_lastname;
                                        if(empty($p1_r3_name)){
                                          $wait_r3="<a style='color:#228B22; border-bottom:2px solid red;' >?????????????????????????????????</a>" ;
                                        }else{
                                          $wait_r3=$name_lastr3;
                                        }
  
                                        if(empty($p2_r3_name)){
                                          $wait_r3_2="<a style='color:#228B22; border-bottom:2px solid red;' >?????????????????????????????????</a>" ;
                                        }else{
                                          $wait_r3_2=$name_lastr3_2;
                                        }
                                ?>

                                <?php if(!empty($p1_r3)){?>
                                  <li class="team-item" style="color: black; font-weight: bold;"><?php echo $wait_r3 ?><br> <time style="color:red;">VS</time><br> <?php echo $wait_r3_2 ?></li>
                                  <?php }else{?>
                                  <li class="team-item" style="color:#B22222; border-bottom:2px solid #00FF00;"> <?php echo $wait_r3 ?><br> <time style="color:red;">VS</time> <br> <?php echo $wait_r3_2 ?></li>
                                <?php }?> 
                            <?php } ?>

                          </ul>  
                          <ul class="bracket bracket-3">
                            <?php for($i=2;$i<4;$i++){?>
                                <?php $r2_1=mysqli_query($con,"SELECT single_tour.player_id1,tour_player.player_name,tour_player.player_lastname FROM single_tour INNER JOIN tour_player ON (tour_no='$tid' AND single_tour.player_id1 = tour_player.player_id)
                                WHERE t_id ='$tid' AND num_round ='2' AND round_id= '$i' ")or die("SQL Error==>".mysqli_error($con)); 
                                list($p1_r2,$p1_r2_name,$p1_r2_lastname)=mysqli_fetch_row($r2_1); ?>

                                <?php $r2_2=mysqli_query($con,"SELECT single_tour.player_id2,tour_player.player_name,tour_player.player_lastname FROM single_tour INNER JOIN tour_player ON (tour_no='$tid' AND single_tour.player_id2 = tour_player.player_id)
                                WHERE t_id ='$tid' AND num_round ='2' AND round_id= '$i' ")or die("SQL Error==>".mysqli_error($con)); 
                                list($p2_r2,$p2_r2_name,$p2_r2_lastname)=mysqli_fetch_row($r2_2); 
                                        $name_lastr2=$p1_r2_name." ".$p1_r2_lastname;
                                        $name_lastr2_2=$p2_r2_name." ".$p2_r2_lastname;
                                        if(empty($p1_r2_name)){
                                          $wait_r2="<a style='color:#228B22; border-bottom:2px solid red;' >?????????????????????????????????</a>" ;
                                        }else{
                                          $wait_r2=$name_lastr2;
                                        }
  
                                        if(empty($p2_r2_name)){
                                          $wait_r2_2="<a style='color:#228B22; border-bottom:2px solid red;' >?????????????????????????????????</a>" ;
                                        }else{
                                          $wait_r2_2=$name_lastr2_2;
                                        }
                                ?>

                                <?php if(!empty($p1_r2)){?>
                                  <li class="team-item" style="color: black; font-weight: bold;"><?php echo $wait_r2 ?> <br><time style="color:red;">VS</time> <br><?php echo $wait_r2_2 ?></li>
                                  <?php }else{?>
                                  <li class="team-item" style="color:#B22222; border-bottom:2px solid #00FF00;"><?php echo $wait_r2 ?> <br> <time style="color:red;">VS</time><br><?php echo $wait_r2_2 ?></li>
                                <?php }?> 
                            <?php } ?>
                                 

                          </ul>  
                          <ul class="bracket bracket-4">

                          <?php $r1_1=mysqli_query($con,"SELECT single_tour.player_id1,tour_player.player_name,tour_player.player_lastname FROM single_tour INNER JOIN tour_player ON (tour_no='$tid' AND single_tour.player_id1 = tour_player.player_id)
                          WHERE t_id ='$tid' AND num_round ='1' ")or die("SQL Error==>".mysqli_error($con)); 
                          list($p1_r1,$p1_r1_name,$p1_r1_lastname)=mysqli_fetch_row($r1_1); ?>

                          <?php $r1_2=mysqli_query($con,"SELECT single_tour.player_id2,tour_player.player_name,tour_player.player_lastname FROM single_tour INNER JOIN tour_player ON (tour_no='$tid' AND single_tour.player_id2 = tour_player.player_id)
                          WHERE t_id ='$tid' AND num_round ='1' ")or die("SQL Error==>".mysqli_error($con)); 
                          list($p2_r1,$p2_r1_name,$p2_r1_lastname)=mysqli_fetch_row($r1_2); 
                                        $name_lastr1=$p1_r1_name." ".$p1_r1_lastname;
                                        $name_lastr1_2=$p2_r1_name." ".$p2_r1_lastname;
                                        if(empty($p1_r1_name)){
                                          $wait_r1="<a style='color:#228B22; border-bottom:2px solid red;' >?????????????????????????????????</a>" ;
                                        }else{
                                          $wait_r1=$name_lastr1;
                                        }
   
                                        if(empty($p2_r1_name)){
                                          $wait_r1_2="<a style='color:#228B22; border-bottom:2px solid red;' >?????????????????????????????????</a>" ;
                                        }else{
                                          $wait_r1_2=$name_lastr1_2;
                                        }
                          ?>

                                  <li class="team-item" style="color: black; font-weight: bold;"><?php echo $wait_r1 ?><br> <time style="color:red;">VS</time> <br><?php echo $wait_r1_2 ?></li>

                          </ul>
                          <?php
                          $final=mysqli_query($con,"SELECT single_tour.winner,tour_player.player_name,tour_player.player_lastname FROM single_tour INNER JOIN tour_player ON (tour_no='$tid' AND single_tour.winner = tour_player.player_id)
                          WHERE t_id ='$tid' AND num_round ='1' AND round_id='1' ")or die("SQL Error==>".mysqli_error($con));
                          list($last_winner,$winner_name,$winner_lastname)=mysqli_fetch_row($final);
                          ?>
                          <ul class="bracket bracket-5">
                          <?php if(empty($last_winner)){?>
                              <li class="team-item" style="border: 5px dotted  #FF7F50; border-bottom: 5px double #00008B;"> &nbsp;  &nbsp;</li>
                          <?php }else{ ?>
                              <li class="team-item" style="color: black; font-weight: bold;  border: 5px dotted  #FF7F50; border-bottom: 5px double #00008B;"><?php echo $winner_name?> <?php echo $winner_lastname?></li>
                          
                          <?php }  ?>
                          </ul>  






                      <?php }elseif($round==3) {?>
                          <ul class="bracket bracket-2_2" >

                            <?php $loop=8;$bye=1;$r_next=2;$big_round=1;
                            for($i=4;$i<$loop;$i++){?>
                                  <?php $r3_1=mysqli_query($con,"SELECT single_tour.player_id1,tour_player.player_name,tour_player.player_lastname,position,next_round_id FROM single_tour INNER JOIN tour_player ON (tour_no='$tid' AND single_tour.player_id1 = tour_player.player_id)
                                  WHERE t_id ='$tid' AND num_round ='3' AND round_id= '$i' ")or die("SQL Error==>".mysqli_error($con)); 
                                  list($p1_r3,$p1_r3_name,$p1_r3_lastname,$pos,$next)=mysqli_fetch_row($r3_1); ?>

                                  <?php $r3_2=mysqli_query($con,"SELECT single_tour.player_id2,tour_player.player_name,tour_player.player_lastname FROM single_tour INNER JOIN tour_player ON (tour_no='$tid' AND single_tour.player_id2 = tour_player.player_id)
                                  WHERE t_id ='$tid' AND num_round ='3' AND round_id= '$i' ")or die("SQL Error==>".mysqli_error($con)); 
                                  list($p2_r3,$p2_r3_name,$p2_r3_lastname)=mysqli_fetch_row($r3_2); 
                                        $name_lastr3=$p1_r3_name." ".$p1_r3_lastname;
                                        $name_lastr3_2=$p2_r3_name." ".$p2_r3_lastname;
                                        if(empty($p1_r3_name)){
                                          $wait_r3="<a style='color:#228B22; border-bottom:2px solid red;' >?????????????????????????????????</a>" ;
                                        }else{
                                          $wait_r3=$name_lastr3;
                                        }
   
                                        if(empty($p2_r3_name)){
                                          $wait_r3_2="<a style='color:#228B22; border-bottom:2px solid red;' >?????????????????????????????????</a>" ;
                                        }else{
                                          $wait_r3_2=$name_lastr3_2;
                                        }
                                  ?>
                                  <?php if($pos==1){?>
                                              <?php $chk_pos=mysqli_query($con,"SELECT player_id1 FROM single_tour  WHERE t_id ='$tid'  AND next_round_id ='$next' AND position='0' ")
                                              or die("SQL Error==>".mysqli_error($con)); 
                                              list($chk_pos0)=mysqli_fetch_row($chk_pos); ?>
                                              <?php if(empty($chk_pos0)){?>
                                              
                                            <?php
                                            if($big_round%2==0){
                                              $win_bye=mysqli_query($con,"SELECT single_tour.player_id1,tour_player.player_name,tour_player.player_lastname,position,next_round_id FROM single_tour INNER JOIN tour_player ON (tour_no='$tid' AND single_tour.player_id1 = tour_player.player_id) WHERE t_id ='$tid'  AND round_id ='$next' AND position='1' ")
                                              or die("SQL Error==>".mysqli_error($con)); 
                                              list($win_bye,$winbye_name,$winbye_lastname)=mysqli_fetch_row($win_bye);
                                              $win_full=$winbye_name." ".$winbye_lastname;
                                              }else{
                                                $win_bye=mysqli_query($con,"SELECT single_tour.player_id1,tour_player.player_name,tour_player.player_lastname,position,next_round_id FROM single_tour INNER JOIN tour_player ON (tour_no='$tid' AND single_tour.player_id1 = tour_player.player_id) WHERE t_id ='$tid'  AND round_id ='$next' AND position='0' ")
                                              or die("SQL Error==>".mysqli_error($con)); 
                                              list($win_bye,$winbye_name,$winbye_lastname)=mysqli_fetch_row($win_bye);
                                              $win_full=$winbye_name." ".$winbye_lastname;
                                              }?>
                                        <li class="team-item" style="color: black; font-weight: bold;" > <?php echo $win_full ?><br> <time style="color:red;">VS</time><br> <a style="color: red;">(?????????????????????????????????????????????)</a></li>
                                        <li class="team-item" style="color: black; font-weight: bold; "><?php echo $wait_r3 ?><br>  <time style="color:red;">VS</time> <br><?php echo $wait_r3_2 ?></li>

                                        <?php $loop--; $r_next++;$big_round++;}else{?> 
                                          <li class="team-item" style="color: black; font-weight: bold; "><?php echo $wait_r3 ?><br>  <time style="color:red;">VS</time> <br><?php echo $wait_r3_2 ?></li>
                                          <?php }?> 
                                  <?php }else{?> 
                                  <?php if(!empty($p1_r3)){?>
                                    <li class="team-item" style="color: black; font-weight: bold; "><?php echo $wait_r3 ?><br>  <time style="color:red;">VS</time> <br><?php echo $wait_r3_2 ?></li>
                                    <?php
                                  $bye++; 
                                  }else{?>
                                  <?php
                                                if($bye%2==0){
                                                  $win_bye1=mysqli_query($con,"SELECT single_tour.player_id2,tour_player.player_name,tour_player.player_lastname,position,next_round_id FROM single_tour INNER JOIN tour_player ON (tour_no='$tid' AND single_tour.player_id2 = tour_player.player_id) WHERE t_id ='$tid'  AND round_id ='$r_next' AND position='1' ")
                                                  or die("SQL Error==>".mysqli_error($con)); 
                                                  list($win_bye,$winbye_name,$winbye_lastname)=mysqli_fetch_row($win_bye1);
                                                  $win_full=$winbye_name." ".$winbye_lastname;
                                                  $bye++;
                                                }else{
                                                  $win_bye1=mysqli_query($con,"SELECT single_tour.player_id1,tour_player.player_name,tour_player.player_lastname,position,next_round_id FROM single_tour INNER JOIN tour_player ON (tour_no='$tid' AND single_tour.player_id1 = tour_player.player_id) WHERE t_id ='$tid'  AND round_id ='$r_next' AND position='1' ")
                                                or die("SQL Error==>".mysqli_error($con)); 
                                                list($win_bye,$winbye_name,$winbye_lastname)=mysqli_fetch_row($win_bye1);
                                                $win_full=$winbye_name." ".$winbye_lastname;
                                                $bye++;
                                                }
                                                

                                                ?>
                                     <li class="team-item" style="color: black; font-weight: bold; "><?php echo $win_full ?><br>  <time style="color:red;">VS</time> <br><a style="color: red;">(?????????????????????????????????????????????)</a></li>
                                    
                                  <?php }?> 
                               <?php }?> 
                            <?php  }?>
                                  <!-- <li class="team-item">QF3 <time>20:00</time> QF4</li>
                                  <li class="team-item">QF5 <time>20:00</time> QF6</li>
                                  <li class="team-item">QF7 <time>20:00</time> QF8</li> -->

                          </ul>  
                          <ul class="bracket bracket-3_2">
                            <?php for($i=2;$i<4;$i++){?>
                                <?php $r2_1=mysqli_query($con,"SELECT single_tour.player_id1,tour_player.player_name,tour_player.player_lastname FROM single_tour INNER JOIN tour_player ON (tour_no='$tid' AND single_tour.player_id1 = tour_player.player_id)
                                WHERE t_id ='$tid' AND num_round ='2' AND round_id= '$i' ")or die("SQL Error==>".mysqli_error($con)); 
                                list($p1_r2,$p1_r2_name,$p1_r2_lastname)=mysqli_fetch_row($r2_1); ?>

                                <?php $r2_2=mysqli_query($con,"SELECT single_tour.player_id2,tour_player.player_name,tour_player.player_lastname FROM single_tour INNER JOIN tour_player ON (tour_no='$tid' AND single_tour.player_id2 = tour_player.player_id)
                                WHERE t_id ='$tid' AND num_round ='2' AND round_id= '$i' ")or die("SQL Error==>".mysqli_error($con)); 
                                list($p2_r2,$p2_r2_name,$p2_r2_lastname)=mysqli_fetch_row($r2_2); 
                                      $name_lastr2=$p1_r2_name." ".$p1_r2_lastname;
                                      $name_lastr2_2=$p2_r2_name." ".$p2_r2_lastname;
                                      if(empty($p1_r2_name)){
                                        $wait_r2="<a style='color:#228B22; border-bottom:2px solid red;' >?????????????????????????????????</a>" ;
                                      }else{
                                        $wait_r2=$name_lastr2;
                                      }
 
                                      if(empty($p2_r2_name)){
                                        $wait_r2_2="<a style='color:#228B22; border-bottom:2px solid red;' >?????????????????????????????????</a>" ;
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

                          <?php $r1_1=mysqli_query($con,"SELECT single_tour.player_id1,tour_player.player_name,tour_player.player_lastname FROM single_tour INNER JOIN tour_player ON (tour_no='$tid' AND single_tour.player_id1 = tour_player.player_id)
                          WHERE t_id ='$tid' AND num_round ='1' ")or die("SQL Error==>".mysqli_error($con)); 
                          list($p1_r1,$p1_r1_name,$p1_r1_lastname)=mysqli_fetch_row($r1_1); ?>

                          <?php $r1_2=mysqli_query($con,"SELECT single_tour.player_id2,tour_player.player_name,tour_player.player_lastname FROM single_tour INNER JOIN tour_player ON (tour_no='$tid' AND single_tour.player_id2 = tour_player.player_id)
                          WHERE t_id ='$tid' AND num_round ='1' ")or die("SQL Error==>".mysqli_error($con)); 
                          list($p2_r1,$p2_r1_name,$p2_r1_lastname)=mysqli_fetch_row($r1_2); 
                                $name_lastr1=$p1_r1_name." ".$p1_r1_lastname;
                                $name_lastr1_2=$p2_r1_name." ".$p2_r1_lastname;
                                if(empty($p1_r1_name)){
                                  $wait_r1="<a style='color:#228B22; border-bottom:2px solid red;' >?????????????????????????????????</a>" ;
                                }else{
                                  $wait_r1=$name_lastr2;
                                }
                                if(empty($p2_r1_name)){
                                  $wait_r1_2="<a style='color:#228B22; border-bottom:2px solid red;' >?????????????????????????????????</a>" ;
                                }else{
                                  $wait_r1_2=$name_lastr2_2;
                                }
                                
                          ?>

                                  <li class="team-item" style="color: black; font-weight: bold;"><?php echo $wait_r1 ?><br> <time style="color:red;">VS</time> <br><?php echo $wait_r1_2 ?></li>

                          </ul>
                          <?php
                          $final=mysqli_query($con,"SELECT single_tour.winner,tour_player.player_name,tour_player.player_lastname FROM single_tour INNER JOIN tour_player ON (tour_no='$tid' AND single_tour.winner = tour_player.player_id)
                          WHERE t_id ='$tid' AND num_round ='1' AND round_id='1' ")or die("SQL Error==>".mysqli_error($con));
                          list($last_winner,$winner_name,$winner_lastname)=mysqli_fetch_row($final);
                          ?>
                          <ul class="bracket bracket-5">
                          <?php if(empty($last_winner)){?>
                              <li class="team-item" style="border: 5px dotted  #FF7F50; border-bottom: 5px double #00008B;"> &nbsp;  &nbsp;</li>
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

    <?php require_once ("include/footer.php"); ?>
</div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/slideshow.js"></script>
  <script src="js/main2.js"></script>
    <script>
  function confirm_regis() {
    if (confirm("???????????????????????????????????????????????????????????????????????????")) {
       // do stuff
    } else {
      return false;
    }
}
    </script>
  </body>
</html>