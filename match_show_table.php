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
        <div class="col-md-12 mb-0"><a href="main.php">Home</a> <span class="mx-2 mb-0">/</span> <a href="idle_tour.php">Tournament</a> <span class="mx-2 mb-0">/</span> <a href="tour_result_view.php">Schedule - Results</a> <span class="mx-2 mb-0">/</span> <a href="show_result.php?tid=<?php echo $tid; ?>"><?php echo $t_name; ?></a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Scoring Round</strong></div>
        </div>
      </div>
    </div>

    <div class='site-section'>
      <div class='container'>
        <div class='row'>
          <div class='col-md-12 text-center'>

<?php

	//select ข้อมูลโดยกำหนดเงื่อนไขให้ตรงกับคำค้น
	$result=mysqli_query($con,"SELECT player_id FROM tour_player WHERE tour_no = $tid ")or die("SQL Error1==>".mysqli_error($con));
	
	$rows=mysqli_num_rows($result); //ใช้นับจำนวนแถวที่คิวรี่หรือซีเลคออกมาได้ พารามิเตอร์ 1 ตัวคือ ชื่อตัวแปรที่ใช้คิวรี่ รีเทิร์นค่าออกมาเป็นจำนวนแถวที่นับได้เป็นจำนวนเต็ม
  $result2=mysqli_query($con,"SELECT tour_max,tour_endregis FROM tournament WHERE tour_no ='$tid'")or die("Sql Error>>".mysqli_error($con));
  while(list($t_max,$t_end)=mysqli_fetch_row($result2)){
  if($rows==0){ //ถ้าคำค้นไม่ตรงกับสินค้าใดๆ
    echo "<p>ยังไม่มีผู้สมัคร</p>";

	}
	else{
    $chkfinal=mysqli_query($con,"SELECT t_id FROM single_tour WHERE t_id ='$tid' ")or die("Sql Error>>".mysqli_error($con));
    $chkF=mysqli_num_rows($chkfinal);

    echo "<a style='font-size:50px; color:#A52A2A; '>รอบเก็บคะแนน $t_name</a><br><br>";
		if($chkF>0){
      echo "<a href='match_show_single.php?tid=$tid' style='align: center; '><button type='button' class='btn' style='font-size:20px; color:#FF8C00; background-color:white; border-color:#FF8C00; border-width: 5px;' >
      ผลจับคู่รอบรอบตัดเชือก</button></a>&nbsp; &nbsp; <br><br>";




    }else{
     
        }
       
       
?>	
<?php

                                        if(!empty($_GET["action"])) {
                                          switch($_GET["action"]) {
                                            case "round1":
                                              echo "<a href='match_show_table.php?tid=$tid&action=round2' style='align: center; '><button type='button' class='btn' style='font-size:20px; color:white; background-color:red; border-color:black; border-width: 5px;'>
                                              รอบที่ 2</button></a>&nbsp; &nbsp;"; 
                                              echo "<a href='match_show_table.php?tid=$tid&action=round3' style='align: center; '><button type='button' class='btn' style='font-size:20px; color:white; background-color:red; border-color:black; border-width: 5px;'>
                                              รอบที่ 3</button></a>&nbsp; &nbsp;<br><br>"; 
                                             
                                              ?>
                                              
                                              		<div class="table-responsive table--no-card m-b-30">
			                                                <table class="table table-borderless table-striped table-earning">
				                                                    <thead>
                                                                <?php
                                                                    echo"<h3 style='aligh : center; color:#191970; font-size:30px; border-bottom: dashed 5px; '>รอบที่1</h3>";
                                                                    echo"<tr  style='color:#00008B; font-size:20px; ' style='color:#00008B; font-size:20px; '><th width='35%'>ผู้เข้าแข่งขัน</th><th width='5%'></th><th width='35%'>คู่แข่ง</th><th width='30%'>ผู้ชนะ</th></tr>";
                                                                ?>	
                                                            </thead>
	                                                        <tbody>
	                                                            <?php
                                                                  $draw=mysqli_query($con,"SELECT match1 FROM tour_player WHERE tour_no =$tid")or die("Sql Error>>".mysqli_error($con));
                                                                  $enemy1=array();
                                                                  while(list($pid)=mysqli_fetch_row($draw)){
                                                                  
                                                                    array_push($enemy1,"$pid");
                                                                
                                                                  }
                                                                  
                                                                  $draw1=mysqli_query($con,"SELECT player_id FROM tour_player WHERE tour_no =$tid")or die("Sql Error>>".mysqli_error($con));
                                                                  $player=array();
                                                                  while(list($pid1)=mysqli_fetch_row($draw1)){
                                                                  
                                                                    array_push($player,"$pid1");
                                                                
                                                                  }
                                                                  $player_c = count($player);
  
                                                                
                                                              ?>
                                                                  <tr>  
                                                              <?php
                                                            //   for($i=0;$i<$player_c;$i++){
                                                            //      echo $player[$i];
                                                            //      echo "<br>";
                                                            //      $k=0;
                                                            //      foreach($enemy1 as $bat){
                                                            //       if($player[$i]==$bat){
                                                            //         echo "$player[$i]&nbsp;&nbsp;$bat&nbsp;&nbsp;$k ";
                                                            //         echo "$player[$k]<br>";
                                                            //       }
                                                            //       $k++;
                                                            //   }
                                                            // }
                                                            
                                                                      $num=0;
                                                                      for($i=0;$i<$player_c;$i++){
                                                                        
                                                                        // echo $player[$i];
                                                                        if(empty($player[$i])){

                                                                        }else{
                                                                            echo "<tr style='color:black'>";
                                                                            $player_name=mysqli_query($con,"SELECT player_name,player_lastname,score1 FROM tour_player WHERE tour_no = '$tid' AND player_id = '$player[$i]' ")or die("Sql Error1>>".mysqli_error($con));
                                                                            list($play_1,$play_1_1,$score1)=mysqli_fetch_row($player_name);
                                                                            if($score1==1){
                                                                                echo "<td style='border:solid; font-weight:bold;'>$play_1 &nbsp;&nbsp; $play_1_1</td>"; 
                                                                            }else{
                                                                                echo "<td style='border:solid;  font-weight:bold;'><p style='color:#C0C0C0;'>$play_1 &nbsp;&nbsp; $play_1_1</p></td>"; 
                                                                            }
                                                                         
                                                                          echo "<td style='color:red; border:double; font-weight:bold;'>VS</td>"; 
                                                                            if(empty($enemy1[$i])){
                                                                              $match1='<a style="color:#696969;">ยังไม่มีการจับคู่</a>';
                                                                              $match1_1='';
                                                                            }elseif($enemy1[$i]==1 || $enemy1[$i]==001){
                                                                              $match1='<a style="color:#228B22;">ชนะบาย</a>';
                                                                              $match1_1='';
                                                                            }else{
                                                                              $enemy=mysqli_query($con,"SELECT player_name,player_lastname,score1 FROM tour_player WHERE tour_no = '$tid' AND player_id = '$enemy1[$i]' ")or die("Sql Error1>>".mysqli_error($con));
                                                                              list($match1,$match1_1,$score1_1)=mysqli_fetch_row($enemy);
                                                                            } 
                                                                            if($score1_1==1){
                                                                              echo "<td style=' border:solid; font-weight:bold;'>$match1 &nbsp;&nbsp; $match1_1</td>";
                                                                          }else{
                                                                              echo "<td style=' border:solid; font-weight:bold;'><p style='color:#C0C0C0;'>$match1 &nbsp;&nbsp; $match1_1</p></td>";
                                                                          }
                                                                       

                                                                          // echo "<td style=' border:solid; font-weight:bold;'>$match1 &nbsp;&nbsp; $match1_1</td>";
                                                                          $score_chk1=mysqli_query($con,"SELECT score1 FROM tour_player WHERE tour_no = '$tid' AND player_id = '$player[$i]' ")or die("Sql Error1>>".mysqli_error($con));
                                                                          list($sc1)=mysqli_fetch_row($score_chk1);
                                                                            if($sc1==1){
                                                                              $winner=$play_1. "&nbsp;&nbsp;" .$play_1_1;
                                                                            }elseif($sc1==2){
                                                                              $winner=$match1. "&nbsp;&nbsp;" .$match1_1;
                                                                            }else{
                                                                              $winner="รอผลการแข่ง";
                                                                            }

                                                                          echo "<td style='border-left:double 20px; border-bottom:dashed #FF7F50 5px; font-weight:bold;'>$winner</td></tr>";
                                                                          $k=0;
                                                                          foreach($enemy1 as $bat){
                                                                            if($player[$i]==$bat){
                                                                              // echo "<br>"; 
                                                                              // echo "$bat--"; 
                                                                              // echo "--$player[$i]<br>"; 
                                                                              // echo "<br>"; 
                                                                              // echo "$k"; 
                                                                              unset($player[$k]);
                                                                            
                                                                              
                                                                            }else{
                                                                              
                                                                            }
                                                                             $k++;
                                                                          }
                                                                        }
                                                                        $num++;
                                                                      }
                                                                   
                                                                        

                                                                        
                                                                          // echo "<td style='border:solid; font:bold;'>$p_name &nbsp;&nbsp; $p_lastname</td>"; 
                                                                          // echo "<td>VS</td>"; 
                                                                          //   if(empty($m1)){
                                                                          //     $match1='ยังไม่มีการจับคู่';
                                                                          //   }elseif($m1==1 || $m1==001){
                                                                          //     $match1='ชนะบาย';
                                                                          //   }else{
                                                                          //     $enemy=mysqli_query($con,"SELECT player_name,player_lastname FROM tour_player WHERE tour_no = '$tid' AND player_id = '$m1' ")or die("Sql Error1>>".mysqli_error($con));
                                                                          //     list($match1,$match1_1)=mysqli_fetch_row($enemy);
                                                                          //   } 

                                                                          // echo "<td style=' border:solid;'>$match1 &nbsp;&nbsp; $match1_1</td>";
                    
                                                                          //   if($score1==1){
                                                                          //     $winner=$p_name." &nbsp;&nbsp; ".$p_lastname;
                                                                          //   }elseif($score1==2){
                                                                          //     $winner=$match1." &nbsp;&nbsp; ".$match1_1;
                                                                          //   }else{
                                                                          //     $winner="ยังแข่งไม่จบ";
                                                                          //   }

                                                                          // echo "<td style='border-left:double 20px; border-bottom:dashed #FF7F50 5px;'>$winner</td>";
                                                                            

                                                              ?>	
	                                                                  </tr>
                                                                  <?php   ?>
                                                          </tbody>
                                                      </table><br>
                                                  </div>
                                          <?php
                                            break;

                                            case "round2":
                                              echo "<a href='match_show_table.php?tid=$tid&action=round1' style='align: center; '><button type='button' class='btn' style='font-size:20px; color:white; background-color:red; border-color:black; border-width: 5px;'>
                                              รอบที่ 1</button></a>&nbsp; &nbsp;"; 
                                              echo "<a href='match_show_table.php?tid=$tid&action=round3' style='align: center; '><button type='button' class='btn' style='font-size:20px; color:white; background-color:red; border-color:black; border-width: 5px;'>
                                              รอบที่ 3</button></a>&nbsp; &nbsp;<br><br>";
                                             

	                                        ?>
                                                  <div class="table-responsive table--no-card m-b-30">
                                                      <table class="table table-borderless table-striped table-earning">
                                                            <thead>
                                                                <?php
                                                                    echo"<h3 style='aligh : center; color:#191970; font-size:30px; border-bottom: dashed 5px; '>รอบที่2</h3>";
                                                                    echo"<tr style='color:#00008B; font-size:20px; '><th width='35%'>ผู้เข้าแข่งขัน</th><th width='5%'></th><th width='35%'>คู่แข่ง</th><th width='30%'>ผู้ชนะ</th></tr>";
                                                                ?>
                                                            </thead>
	                                                        <tbody>
                                                          <?php
                                                                  $draw=mysqli_query($con,"SELECT match2 FROM tour_player WHERE tour_no =$tid")or die("Sql Error>>".mysqli_error($con));
                                                                  $enemy2=array();
                                                                  while(list($pid)=mysqli_fetch_row($draw)){
                                                                  
                                                                    array_push($enemy2,"$pid");
                                                                
                                                                  }
                                                                  
                                                                  $draw1=mysqli_query($con,"SELECT player_id FROM tour_player WHERE tour_no =$tid")or die("Sql Error>>".mysqli_error($con));
                                                                  $player=array();
                                                                  while(list($pid1)=mysqli_fetch_row($draw1)){
                                                                  
                                                                    array_push($player,"$pid1");
                                                                
                                                                  }
                                                                  $player_c = count($player);
  
                                                                
                                                              ?>
                                                                  <tr>  
                                                              <?php
                                                            //   for($i=0;$i<$player_c;$i++){
                                                            //      echo $player[$i];
                                                            //      echo "<br>";
                                                            //      $k=0;
                                                            //      foreach($enemy1 as $bat){
                                                            //       if($player[$i]==$bat){
                                                            //         echo "$player[$i]&nbsp;&nbsp;$bat&nbsp;&nbsp;$k ";
                                                            //         echo "$player[$k]<br>";
                                                            //       }
                                                            //       $k++;
                                                            //   }
                                                            // }
                                                            
                                                                      $num=0;
                                                                      for($i=0;$i<$player_c;$i++){
                                                                        
                                                                        // echo $player[$i];
                                                                        if(empty($player[$i])){

                                                                        }else{
                                                                            echo "<tr style='color:black'>";
                                                                            $player_name=mysqli_query($con,"SELECT player_name,player_lastname,score2 FROM tour_player WHERE tour_no = '$tid' AND player_id = '$player[$i]' ")or die("Sql Error1>>".mysqli_error($con));
                                                                            list($play_2,$play_2_1,$score2)=mysqli_fetch_row($player_name);
                                                                            if($score2==1){
                                                                              echo "<td style='border:solid; font-weight:bold;'>$play_2 &nbsp;&nbsp; $play_2_1</td>"; 
                                                                          }else{
                                                                              echo "<td style='border:solid;  font-weight:bold;'><p style='color:#C0C0C0;'>$play_2 &nbsp;&nbsp; $play_2_1</p></td>"; 
                                                                          }
                                                                          echo "<td style='color:red; border:double; font-weight:bold;'>VS</td>"; 
                                                                            if(empty($enemy2[$i])){
                                                                              $match2='<a style="color:#696969;">ยังไม่มีการจับคู่</a>';
                                                                              $match2_1='';
                                                                            }elseif($enemy2[$i]==1 || $enemy2[$i]==001){
                                                                              $match2='<a style="color:#228B22;">ชนะบาย</a>';
                                                                              $match2_1='';
                                                                            }else{
                                                                              $enemy=mysqli_query($con,"SELECT player_name,player_lastname,score2 FROM tour_player WHERE tour_no = '$tid' AND player_id = '$enemy2[$i]' ")or die("Sql Error1>>".mysqli_error($con));
                                                                              list($match2,$match2_1,$score2_1)=mysqli_fetch_row($enemy);
                                                                            } 
                                                                            if($score2_1==1){
                                                                              echo "<td style=' border:solid; font-weight:bold;'>$match2 &nbsp;&nbsp; $match2_1</td>";
                                                                          }else{
                                                                              echo "<td style=' border:solid; font-weight:bold;'><p style='color:#C0C0C0;'>$match2 &nbsp;&nbsp; $match2_1</p></td>";
                                                                          }

                                                                          
                                                                          $score_chk2=mysqli_query($con,"SELECT score2 FROM tour_player WHERE tour_no = '$tid' AND player_id = '$player[$i]' ")or die("Sql Error1>>".mysqli_error($con));
                                                                          list($sc2)=mysqli_fetch_row($score_chk2);
                                                                            if($sc2==1){
                                                                              $winner=$play_2. "&nbsp;&nbsp;" .$play_2_1;
                                                                            }elseif($sc2==2){
                                                                              $winner=$match2. "&nbsp;&nbsp;" .$match2_1;
                                                                            }else{
                                                                              $winner="รอผลการแข่ง";
                                                                            }

                                                                          echo "<td style='border-left:double 20px; border-bottom:dashed #FF7F50 5px; font-weight:bold;'>$winner</td></tr>";
                                                                          $k=0;
                                                                          foreach($enemy2 as $bat){
                                                                            if($player[$i]==$bat){
                                                                              // echo "<br>"; 
                                                                              // echo "$bat--"; 
                                                                              // echo "--$player[$i]<br>"; 
                                                                              // echo "<br>"; 
                                                                              // echo "$k"; 
                                                                              unset($player[$k]);
                                                                            
                                                                              
                                                                            }else{
                                                                              
                                                                            }
                                                                             $k++;
                                                                          }
                                                                        }
                                                                        $num++;
                                                                      }
                                                                   
                                                                        

                                                                        
                                                                          // echo "<td style='border:solid; font:bold;'>$p_name &nbsp;&nbsp; $p_lastname</td>"; 
                                                                          // echo "<td>VS</td>"; 
                                                                          //   if(empty($m1)){
                                                                          //     $match1='ยังไม่มีการจับคู่';
                                                                          //   }elseif($m1==1 || $m1==001){
                                                                          //     $match1='ชนะบาย';
                                                                          //   }else{
                                                                          //     $enemy=mysqli_query($con,"SELECT player_name,player_lastname FROM tour_player WHERE tour_no = '$tid' AND player_id = '$m1' ")or die("Sql Error1>>".mysqli_error($con));
                                                                          //     list($match1,$match1_1)=mysqli_fetch_row($enemy);
                                                                          //   } 

                                                                          // echo "<td style=' border:solid;'>$match1 &nbsp;&nbsp; $match1_1</td>";
                    
                                                                          //   if($score1==1){
                                                                          //     $winner=$p_name." &nbsp;&nbsp; ".$p_lastname;
                                                                          //   }elseif($score1==2){
                                                                          //     $winner=$match1." &nbsp;&nbsp; ".$match1_1;
                                                                          //   }else{
                                                                          //     $winner="ยังแข่งไม่จบ";
                                                                          //   }

                                                                          // echo "<td style='border-left:double 20px; border-bottom:dashed #FF7F50 5px;'>$winner</td>";
                                                                            

                                                              ?>	
	                                                                  </tr>

                                                                  <?php  ?>
                                                          </tbody>
                                                      </table><br>
                                                  </div>
                                          <?php
                                            break;
                                            
                                            case "round3":
                                              echo "<a href='match_show_table.php?tid=$tid&action=round1' style='align: center; '><button type='button' class='btn' style='font-size:20px; color:white; background-color:red; border-color:black; border-width: 5px;'>
                                              รอบที่ 1</button></a>&nbsp; &nbsp;"; 
                                              echo "<a href='match_show_table.php?tid=$tid&action=round2' style='align: center; '><button type='button' class='btn' style='font-size:20px; color:white; background-color:red; border-color:black; border-width: 5px;'>
                                              รอบที่ 2</button></a>&nbsp; &nbsp;<br><br>";
                                             
                                          ?>	
		                                              <div class="table-responsive table--no-card m-b-30">
                                                      <table class="table table-borderless table-striped table-earning">
                                                            <thead>
                                                                <?php
                                                                    echo"<h3 style='aligh : center; color:#191970; font-size:30px; border-bottom: dashed 5px; '>รอบที่3</h3>";
                                                                    echo"<tr style='color:#00008B; font-size:20px; ' style='color:#00008B; font-size:20px; '><th width='35%'>ผู้เข้าแข่งขัน</th><th width='5%'></th><th width='35%'>คู่แข่ง</th><th width='30%'>ผู้ชนะ</th></tr>";
                                                                ?>	
				                                                    </thead>
	                                                        <tbody>
                                                              <?php
                                                               $draw=mysqli_query($con,"SELECT match3 FROM tour_player WHERE tour_no =$tid")or die("Sql Error>>".mysqli_error($con));
                                                               $enemy3=array();
                                                               while(list($pid)=mysqli_fetch_row($draw)){
                                                               
                                                                 array_push($enemy3,"$pid");
                                                             
                                                               }
                                                               
                                                               $draw1=mysqli_query($con,"SELECT player_id FROM tour_player WHERE tour_no =$tid")or die("Sql Error>>".mysqli_error($con));
                                                               $player=array();
                                                               while(list($pid1)=mysqli_fetch_row($draw1)){
                                                               
                                                                 array_push($player,"$pid1");
                                                             
                                                               }
                                                               $player_c = count($player);

                                                             
                                                           ?>
                                                               <tr>  
                                                           <?php
                                                         //   for($i=0;$i<$player_c;$i++){
                                                         //      echo $player[$i];
                                                         //      echo "<br>";
                                                         //      $k=0;
                                                         //      foreach($enemy1 as $bat){
                                                         //       if($player[$i]==$bat){
                                                         //         echo "$player[$i]&nbsp;&nbsp;$bat&nbsp;&nbsp;$k ";
                                                         //         echo "$player[$k]<br>";
                                                         //       }
                                                         //       $k++;
                                                         //   }
                                                         // }
                                                         
                                                                   $num=0;
                                                                   for($i=0;$i<$player_c;$i++){
                                                                     
                                                                     // echo $player[$i];
                                                                     if(empty($player[$i])){

                                                                     }else{
                                                                         echo "<tr style='color:black'>";
                                                                         $player_name=mysqli_query($con,"SELECT player_name,player_lastname,score3 FROM tour_player WHERE tour_no = '$tid' AND player_id = '$player[$i]' ")or die("Sql Error1>>".mysqli_error($con));
                                                                         list($play_3,$play_3_1,$score3)=mysqli_fetch_row($player_name);
                                                                         if($score3==1){
                                                                          echo "<td style='border:solid; font-weight:bold;'>$play_3 &nbsp;&nbsp; $play_3_1</td>"; 
                                                                      }else{
                                                                          echo "<td style='border:solid;  font-weight:bold;'><p style='color:#C0C0C0;'>$play_3 &nbsp;&nbsp; $play_3_1</p></td>"; 
                                                                      }
                                                                       echo "<td style='color:red; border:double; font-weight:bold;'>VS</td>"; 
                                                                         if(empty($enemy3[$i])){
                                                                           $match3='<a style="color:#696969;">ยังไม่มีการจับคู่</a>';
                                                                           $match3_1='';
                                                                         }elseif($enemy3[$i]==1 || $enemy3[$i]==001){
                                                                           $match3='<a style="color:#228B22;">ชนะบาย</a>';
                                                                           $match3_1='';
                                                                         }else{
                                                                           $enemy=mysqli_query($con,"SELECT player_name,player_lastname,score3 FROM tour_player WHERE tour_no = '$tid' AND player_id = '$enemy3[$i]' ")or die("Sql Error1>>".mysqli_error($con));
                                                                           list($match3,$match3_1,$score3_1)=mysqli_fetch_row($enemy);
                                                                         } 
                                                                         if($score3_1==1){
                                                                          echo "<td style=' border:solid; font-weight:bold;'>$match3 &nbsp;&nbsp; $match3_1</td>";
                                                                      }else{
                                                                          echo "<td style=' border:solid; font-weight:bold;'><p style='color:#C0C0C0;'>$match3 &nbsp;&nbsp; $match3_1</p></td>";
                                                                      }
                                                                       $score_chk3=mysqli_query($con,"SELECT score3 FROM tour_player WHERE tour_no = '$tid' AND player_id = '$player[$i]' ")or die("Sql Error1>>".mysqli_error($con));
                                                                       list($sc3)=mysqli_fetch_row($score_chk3);
                                                                         if($sc3==1){
                                                                           $winner=$play_3. "&nbsp;&nbsp;" .$play_3_1;
                                                                         }elseif($sc3==2){
                                                                           $winner=$match3. "&nbsp;&nbsp;" .$match3_1;
                                                                         }else{
                                                                           $winner="รอผลการแข่ง";
                                                                         }

                                                                       echo "<td style='border-left:double 20px; border-bottom:dashed #FF7F50 5px; font-weight:bold;'>$winner</td></tr>";
                                                                       $k=0;
                                                                       foreach($enemy3 as $bat){
                                                                         if($player[$i]==$bat){
                                                                           // echo "<br>"; 
                                                                           // echo "$bat--"; 
                                                                           // echo "--$player[$i]<br>"; 
                                                                           // echo "<br>"; 
                                                                           // echo "$k"; 
                                                                           unset($player[$k]);
                                                                         
                                                                           
                                                                         }else{
                                                                           
                                                                         }
                                                                          $k++;
                                                                       }
                                                                     }
                                                                     $num++;
                                                                   }
                                                                
                                                                     

                                                                     
                                                                       // echo "<td style='border:solid; font:bold;'>$p_name &nbsp;&nbsp; $p_lastname</td>"; 
                                                                       // echo "<td>VS</td>"; 
                                                                       //   if(empty($m1)){
                                                                       //     $match1='ยังไม่มีการจับคู่';
                                                                       //   }elseif($m1==1 || $m1==001){
                                                                       //     $match1='ชนะบาย';
                                                                       //   }else{
                                                                       //     $enemy=mysqli_query($con,"SELECT player_name,player_lastname FROM tour_player WHERE tour_no = '$tid' AND player_id = '$m1' ")or die("Sql Error1>>".mysqli_error($con));
                                                                       //     list($match1,$match1_1)=mysqli_fetch_row($enemy);
                                                                       //   } 

                                                                       // echo "<td style=' border:solid;'>$match1 &nbsp;&nbsp; $match1_1</td>";
                 
                                                                       //   if($score1==1){
                                                                       //     $winner=$p_name." &nbsp;&nbsp; ".$p_lastname;
                                                                       //   }elseif($score1==2){
                                                                       //     $winner=$match1." &nbsp;&nbsp; ".$match1_1;
                                                                       //   }else{
                                                                       //     $winner="ยังแข่งไม่จบ";
                                                                       //   }

                                                                       // echo "<td style='border-left:double 20px; border-bottom:dashed #FF7F50 5px;'>$winner</td>";
                                                                         

                                                           ?>	
                                                                 </tr>
                                                                  <?php  ?>
    
                                                      </table><br>
                                                  </div>
                                                      <?php
                                            break;
                                          } 
                                        }

  } //ปิดเงื่อนไข else ไม่ให้เห็นหัวตาราง (บรรทัด 43)
}
  

 mysqli_close($con);
 	?>

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
    if (confirm("ยืนยันการลงทะเบียนหรือไม่")) {
       // do stuff
    } else {
      return false;
    }
}
    </script>
    <script>
    function checkbattle($p_id,$m1){
      console.log($p_id,$m1);
    }
    
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function (event) {
        var scrollpos = sessionStorage.getItem('scrollpos');
        if (scrollpos) {
            window.scrollTo(0, scrollpos);
            sessionStorage.removeItem('scrollpos');
        }
    });

    window.addEventListener("beforeunload", function (e) {
        sessionStorage.setItem('scrollpos', window.scrollY);
    });
</script>
  </body>
</html>