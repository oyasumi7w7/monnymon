
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
         swal("", "ลงทะเบียนออฟไลน์เสร็จสิ้น", "success");
         </script>';
 }elseif($do==2){
    echo '<script type="text/javascript">
    swal("", "จับคู่รอบแรกเสร็จสิ้น", "success");
    </script>';
 }elseif($do==3){
    echo '<script type="text/javascript">
    swal("", "จับคู่รอบสองเสร็จสิ้น", "success");
    </script>';
 }elseif($do==4){
    echo '<script type="text/javascript">
    swal("", "จับคู่รอบสามเสร็จสิ้น", "success");
    </script>';
 }elseif($do==5){
  echo '<script type="text/javascript">
  swal("", "อัพเดทผลการแข่งเสร็จสิ้น", "success");
  </script>';
}elseif($do==6){
  echo '<script type="text/javascript">
  swal("", "มีการจับรอบตัดเชือก TOUNAMENT นี้แล้ว", "error");
  </script>';
}


  //$id=$_GET['tid'];
    $_SESSION['tour_id']=$_GET['tid'];
    $chk=mysqli_query($con,"SELECT t_id FROM single_tour WHERE t_id='$_SESSION[tour_id]' ")or die("SQL Error1==>".mysqli_error($con));
    $chkrows=mysqli_num_rows($chk); 
 
?>
<meta charset="UTF-8">
<div class='site-section'>
      <div class='container'>
        <div class='row'>
          <div class='col-md-12 text-center'>
<?php

	//select ข้อมูลโดยกำหนดเงื่อนไขให้ตรงกับคำค้น
	$result=mysqli_query($con,"SELECT player_id FROM tour_player WHERE tour_no = $_SESSION[tour_id] ")or die("SQL Error1==>".mysqli_error($con));
	$totalscore=0;
	$rows=mysqli_num_rows($result); //ใช้นับจำนวนแถวที่คิวรี่หรือซีเลคออกมาได้ พารามิเตอร์ 1 ตัวคือ ชื่อตัวแปรที่ใช้คิวรี่ รีเทิร์นค่าออกมาเป็นจำนวนแถวที่นับได้เป็นจำนวนเต็ม
  $result2=mysqli_query($con,"SELECT tour_name,tour_max,tour_endregis FROM tournament WHERE tour_no = $_SESSION[tour_id] ")or die("Sql Error>>".mysqli_error($con));
  while(list($t_name,$t_max,$t_end)=mysqli_fetch_row($result2)){
    echo "<a style='font-size:50px; color:#A52A2A; '>$t_name</a><br><br>";
  if($rows==0){ //ถ้าคำค้นไม่ตรงกับสินค้าใดๆ
    echo "<p><b>ยังไม่มีผู้สมัคร</b></p><br>";

    echo "<div class='text-center'>";
    echo "<a href='index.php?module=tour&action=add_player_form' ><button type='button' class='btn btn-success btn-ra' style=' padding: 20px 20px; font-size:20px;' ><i>ลงทะเบียนออฟไลน์</i>&nbsp;</button></a>";
    echo "</div><br>";
	}
	else{
    echo "<p style='color:#00008B; font-size:20px; '>จำนวนผู้เข้าแข่งทั้งหมด $rows คน</p><br>";
    if($chkrows>0){
      // echo "<h3 style='text-align: center; '>จับคู่การแข่งขันทั้งหมดเรียบร้อยแล้ว<h3>";
      echo "<a href='index.php?module=tour&action=manage_single_tour&tid=$_SESSION[tour_id]' style='align: center; '><button type='button' class='btn btn-primary btn-ra ' >
      </i>จัดการการแข่งรอบตัดเชือก</button></a><br><br>";
  }else{


  }
  $cm1=0;$sc1=0;
  $cm2=0;$sc2=0;
  $cm3=0;$sc3=0;
  $cm4=0;$sc4=0;
$result2=mysqli_query($con,"SELECT match1,match2,match3,score1,score2,score3 FROM tour_player WHERE tour_no = $_SESSION[tour_id] ")or die("Sql Error>>".mysqli_error($con));
while(list($m1,$m2,$m3,$score1,$score2,$score3)=mysqli_fetch_row($result2)){
      if(empty($m1)){
        $cm1++;
      }
      if(empty($m2)){
        $cm2++;
      }
      if(empty($m3)){
        $cm3++;
      }
      if($score1==0){
        $sc1++;
      }
      if($score2==0){
        $sc2++;
      }
      if($score3==0){
        $sc3++;
      }
      $cm4++;$sc4++;
}
  if(!empty($_GET["page"])) {
    switch($_GET["page"]) {
      case "round1":
        echo "<a href='index.php?module=tour&action=match&tid=$_SESSION[tour_id]&page=idle' style='align: center; '><button type='button' class='btn' style='font-size:20px; color:white; background-color:red; border-color:black; border-width: 5px;border-radius: 8px;'>
        หน้าหลัก</button></a>&nbsp; &nbsp;";  
      if($cm2==0){
        echo "<a href='index.php?module=tour&action=match&tid=$_SESSION[tour_id]&page=round2' style='align: center; '><button type='button' class='btn' style='font-size:20px; color:white; background-color:red; border-color:black; border-width: 5px;border-radius: 8px;'>
        รอบที่ 2</button></a>&nbsp; &nbsp;"; 
      }
      if($cm3==0){
        echo "<a href='index.php?module=tour&action=match&tid=$_SESSION[tour_id]&page=round3' style='align: center; '><button type='button' class='btn' style='font-size:20px; color:white; background-color:red; border-color:black; border-width: 5px;border-radius: 8px;'>
        รอบที่ 3</button></a>&nbsp; &nbsp;"; 
       }
        ?><br><br>
        
            <div class="table-responsive table--no-card m-b-30">
                <table class="table table-borderless table-striped table-earning">
                      <thead>
                          <?php
                              echo"<h3 style='aligh : center; color:#191970; font-size:30px; border-bottom: dashed 5px; '>รอบที่1</h3>";
                              echo"<tr  style='color:#00008B; font-size:20px; '>
                              <th width='35%' style='text-align:center;'>ผู้เข้าแข่งขัน</th>
                              <th width='5%' style='text-align:center;'></th>
                              <th width='35%' style='text-align:center;'>คู่แข่ง</th>
                              <th width='30%' style='text-align:center;'>ผู้ชนะ</th></tr>";
                          ?>	
                      </thead>
                    <tbody>
                        <?php
                            $draw=mysqli_query($con,"SELECT match1 FROM tour_player WHERE tour_no =$_SESSION[tour_id]")or die("Sql Error>>".mysqli_error($con));
                            $enemy1=array();
                            while(list($pid)=mysqli_fetch_row($draw)){
                            
                              array_push($enemy1,"$pid");
                          
                            }
                            
                            $draw1=mysqli_query($con,"SELECT player_id FROM tour_player WHERE tour_no =$_SESSION[tour_id]")or die("Sql Error>>".mysqli_error($con));
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
                                      echo "<tr>";
                                      $player_name=mysqli_query($con,"SELECT player_name,player_lastname,score1 FROM tour_player WHERE tour_no = '$_SESSION[tour_id]' AND player_id = '$player[$i]' ")or die("Sql Error1>>".mysqli_error($con));
                                      list($play_1,$play_1_1,$score1)=mysqli_fetch_row($player_name);
                                      if(empty($score1)){
                                           echo "<td style='border:solid;  font-weight:bold;'><p style='color:black;'>$play_1 &nbsp;&nbsp; $play_1_1</p></td>"; 
                                      }else{
                                        if($score1==1){
                                            echo "<td style='border:solid;  font-weight:bold;'><p style='color:black;'>$play_1 &nbsp;&nbsp; $play_1_1</p></td>"; 
                                        }else{
                                            echo "<td style='border:solid;  font-weight:bold;'><p style='color:#C0C0C0;'>$play_1 &nbsp;&nbsp; $play_1_1</p></td>"; 
                                        }
                                      }
                                    echo "<td style='color:red; border:double; font-weight:bold;'>VS</td>"; 
                                      if($enemy1[$i]==1 || $enemy1[$i]==001){
                                        $match1='<a style="color:red;">ชนะบาย</a>';
                                        $match1_1='';
                                      }else{
                                        $enemy=mysqli_query($con,"SELECT player_name,player_lastname,score1 FROM tour_player WHERE tour_no = '$_SESSION[tour_id]' AND player_id = '$enemy1[$i]' ")or die("Sql Error1>>".mysqli_error($con));
                                        list($match1,$match1_1,$score1_1)=mysqli_fetch_row($enemy);
                                      } 
                                      if(empty($score1_1)){
                                            echo "<td style=' border:solid; font-weight:bold;'><p style='color:black;'>$match1 &nbsp;&nbsp; $match1_1</p></td>";
                                      }else{
                                        if($score1_1==1){
                                            echo "<td style=' border:solid; font-weight:bold;'><p style='color:black;'>$match1 &nbsp;&nbsp; $match1_1</p></td>";
                                        }else{
                                            echo "<td style=' border:solid; font-weight:bold;'><p style='color:#C0C0C0;'>$match1 &nbsp;&nbsp; $match1_1</p></td>";
                                        }
                                      }

                                    // echo "<td style=' border:solid; font-weight:bold;'>$match1 &nbsp;&nbsp; $match1_1</td>";
                                    $score_chk1=mysqli_query($con,"SELECT score1 FROM tour_player WHERE tour_no = '$_SESSION[tour_id]' AND player_id = '$player[$i]' ")or die("Sql Error1>>".mysqli_error($con));
                                    list($sc1)=mysqli_fetch_row($score_chk1);
                                      if($sc1==1){
                                        $winner=$play_1. "&nbsp;&nbsp;" .$play_1_1;
                                      }elseif($sc1==2){
                                        $winner=$match1. "&nbsp;&nbsp;" .$match1_1;
                                      }else{
                                        $winner="<p><button data-toggle='modal' data-target='#match1-$player[$i]'  class='btn btn-primary'>ใส่ผลการแข่ง</button></p>";
                                      }

                                    echo "<td style='border-left:double 20px; text-align:center; border-bottom:dashed #FF7F50 5px; font-weight:bold;'><a style='color:green;'>$winner</a></td></tr>";
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
                        ?>	
                              </tr>
                            <?php   ?>
                    </tbody>
                </table><br>
            </div>
    <?php
      break;

      case "round2":
        echo "<a href='index.php?module=tour&action=match&tid=$_SESSION[tour_id]&page=idle' style='align: center; '><button type='button' class='btn' style='font-size:20px; color:white; background-color:red; border-color:black; border-width: 5px;border-radius: 8px;'>
        หน้าหลัก</button></a>&nbsp; &nbsp;"; 
        if($cm1==0){
        echo "<a href='index.php?module=tour&action=match&tid=$_SESSION[tour_id]&page=round1' style='align: center; '><button type='button' class='btn' style='font-size:20px; color:white; background-color:red; border-color:black; border-width: 5px;border-radius: 8px;'>
        รอบที่ 1</button></a>&nbsp; &nbsp;";
       }
       if($cm3==0){
        echo "<a href='index.php?module=tour&action=match&tid=$_SESSION[tour_id]&page=round3' style='align: center; '><button type='button' class='btn' style='font-size:20px; color:white; background-color:red; border-color:black; border-width: 5px;border-radius: 8px;'>
        รอบที่ 3</button></a>&nbsp; &nbsp;";
       }

    ?><br><br>
            <div class="table-responsive table--no-card m-b-30">
                <table class="table table-borderless table-striped table-earning">
                      <thead>
                          <?php
                             echo"<h3 style='aligh : center; color:#191970; font-size:30px; border-bottom: dashed 5px; '>รอบที่2</h3>";
                             echo"<tr  style='color:#00008B; font-size:20px; ' style='color:#00008B; font-size:20px; '>
                             <th width='35%' style='text-align:center;'>ผู้เข้าแข่งขัน</th>
                             <th width='5%' style='text-align:center;'></th>
                             <th width='35%' style='text-align:center;'>คู่แข่ง</th>
                             <th width='30%' style='text-align:center;'>ผู้ชนะ</th></tr>";
                          ?>
                      </thead>
                    <tbody>
                    <?php
                            $draw=mysqli_query($con,"SELECT match2 FROM tour_player WHERE tour_no =$_SESSION[tour_id]")or die("Sql Error>>".mysqli_error($con));
                            $enemy2=array();
                            while(list($pid)=mysqli_fetch_row($draw)){
                            
                              array_push($enemy2,"$pid");
                          
                            }
                            
                            $draw1=mysqli_query($con,"SELECT player_id FROM tour_player WHERE tour_no =$_SESSION[tour_id]")or die("Sql Error>>".mysqli_error($con));
                            $player=array();
                            while(list($pid1)=mysqli_fetch_row($draw1)){
                            
                              array_push($player,"$pid1");
                          
                            }
                            $player_c = count($player);

                          
                        ?>
                            <tr>  
                        <?php
                                $num=0;
                                for($i=0;$i<$player_c;$i++){
                                  
                                  // echo $player[$i];
                                  if(empty($player[$i])){

                                  }else{
                                      echo "<tr style='color:black'>";
                                      $player_name=mysqli_query($con,"SELECT player_name,player_lastname,score2 FROM tour_player WHERE tour_no = '$_SESSION[tour_id]' AND player_id = '$player[$i]' ")or die("Sql Error1>>".mysqli_error($con));
                                      list($play_2,$play_2_1,$score2)=mysqli_fetch_row($player_name);
                                      if(empty($score2)){
                                        echo "<td style='border:solid;  font-weight:bold;'><p style='color:black;'>$play_2 &nbsp;&nbsp; $play_2_1</p></td>"; 
                                   }else{
                                     if($score2==1){
                                         echo "<td style='border:solid;  font-weight:bold;'><p style='color:black;'>$play_2 &nbsp;&nbsp; $play_2_1</p></td>"; 
                                     }else{
                                         echo "<td style='border:solid;  font-weight:bold;'><p style='color:#C0C0C0;'>$play_2 &nbsp;&nbsp; $play_2_1</p></td>"; 
                                     }
                                   }
                                    echo "<td style='color:red; border:double; font-weight:bold;'>VS</td>"; 
                                      if(empty($enemy2[$i])){
                                        $match2='<a style="color:#696969;">ยังไม่มีการจับคู่</a>';
                                        $match2_1='';
                                      }elseif($enemy2[$i]==1 || $enemy2[$i]==001){
                                        $match2='<a style="color:red;">ชนะบาย</a>';
                                        $match2_1='';
                                      }else{
                                        $enemy=mysqli_query($con,"SELECT player_name,player_lastname,score2 FROM tour_player WHERE tour_no = '$_SESSION[tour_id]' AND player_id = '$enemy2[$i]' ")or die("Sql Error1>>".mysqli_error($con));
                                        list($match2,$match2_1,$score2_1)=mysqli_fetch_row($enemy);
                                      } 
                                      if(empty($score2_1)){
                                        echo "<td style=' border:solid; font-weight:bold;'><p style='color:black;'>$match2 &nbsp;&nbsp; $match2_1</p></td>";
                                  }else{
                                    if($score2_1==1){
                                        echo "<td style=' border:solid; font-weight:bold;'><p style='color:black;'>$match2 &nbsp;&nbsp; $match2_1</p></td>";
                                    }else{
                                        echo "<td style=' border:solid; font-weight:bold;'><p style='color:#C0C0C0;'>$match2 &nbsp;&nbsp; $match2_1</p></td>";
                                    }
                                  }

                                    
                                    $score_chk2=mysqli_query($con,"SELECT score2 FROM tour_player WHERE tour_no = '$_SESSION[tour_id]' AND player_id = '$player[$i]' ")or die("Sql Error1>>".mysqli_error($con));
                                    list($sc2)=mysqli_fetch_row($score_chk2);
                                      if($sc2==1){
                                        $winner=$play_2. "&nbsp;&nbsp;" .$play_2_1;
                                      }elseif($sc2==2){
                                        $winner=$match2. "&nbsp;&nbsp;" .$match2_1;
                                      }else{
                                        $winner="<p><button data-toggle='modal' data-target='#match2-$player[$i]'  class='btn btn-primary'>ใส่ผลการแข่ง</button></p>";
                                      }

                                      echo "<td style='border-left:double 20px; text-align:center; border-bottom:dashed #FF7F50 5px; font-weight:bold;'><a style='color:green;'>$winner</a></td></tr>";
                                    $k=0;
                                    foreach($enemy2 as $bat){
                                      if($player[$i]==$bat){

                                        unset($player[$k]);

                                      }else{
                                        
                                      }
                                       $k++;
                                    }
                                  }
                                  $num++;
                                }
                        ?>	
                              </tr>

                            <?php  ?>
                    </tbody>
                </table><br>
            </div>
    <?php
      break;
      
      case "round3":
        echo "<a href='index.php?module=tour&action=match&tid=$_SESSION[tour_id]&page=idle' style='align: center; '><button type='button' class='btn' style='font-size:20px; color:white; background-color:red; border-color:black; border-width: 5px;border-radius: 8px;'>
        หน้าหลัก</button></a>&nbsp; &nbsp;"; 
        if($cm1==0){
        echo "<a href='index.php?module=tour&action=match&tid=$_SESSION[tour_id]&page=round1' style='align: center; '><button type='button' class='btn' style='font-size:20px; color:white; background-color:red; border-color:black; border-width: 5px;border-radius: 8px;'>
        รอบที่ 1</button></a>&nbsp; &nbsp;"; 
      }
      if($cm2==0){
        echo "<a href='index.php?module=tour&action=match&tid=$_SESSION[tour_id]&page=round2' style='align: center; '><button type='button' class='btn' style='font-size:20px; color:white; background-color:red; border-color:black; border-width: 5px;border-radius: 8px;'>
        รอบที่ 2</button></a>&nbsp; &nbsp;";
       }
    ?>	<br><br>
            <div class="table-responsive table--no-card m-b-30">
                <table class="table table-borderless table-striped table-earning">
                      <thead>
                          <?php
                              echo"<h3 style='aligh : center; color:#191970; font-size:30px; border-bottom: dashed 5px; '>รอบที่3</h3>";
                              echo"<tr  style='color:#00008B; font-size:20px; ' style='color:#00008B; font-size:20px; '>
                              <th width='35%' style='text-align:center;'>ผู้เข้าแข่งขัน</th>
                              <th width='5%' style='text-align:center;'></th>
                              <th width='35%' style='text-align:center;'>คู่แข่ง</th>
                              <th width='30%' style='text-align:center;'>ผู้ชนะ</th></tr>";
                          ?>	
                      </thead>
                    <tbody>
                        <?php
                         $draw=mysqli_query($con,"SELECT match3 FROM tour_player WHERE tour_no =$_SESSION[tour_id]")or die("Sql Error>>".mysqli_error($con));
                         $enemy3=array();
                         while(list($pid)=mysqli_fetch_row($draw)){
                         
                           array_push($enemy3,"$pid");
                       
                         }
                         
                         $draw1=mysqli_query($con,"SELECT player_id FROM tour_player WHERE tour_no =$_SESSION[tour_id]")or die("Sql Error>>".mysqli_error($con));
                         $player=array();
                         while(list($pid1)=mysqli_fetch_row($draw1)){
                         
                           array_push($player,"$pid1");
                       
                         }
                         $player_c = count($player);

                       
                     ?>
                         <tr>  
                     <?php

                             $num=0;
                             for($i=0;$i<$player_c;$i++){
                               
                               // echo $player[$i];
                               if(empty($player[$i])){

                               }else{
                                   echo "<tr style='color:black'>";
                                   $player_name=mysqli_query($con,"SELECT player_name,player_lastname,score3 FROM tour_player WHERE tour_no = '$_SESSION[tour_id]' AND player_id = '$player[$i]' ")or die("Sql Error1>>".mysqli_error($con));
                                   list($play_3,$play_3_1,$score3)=mysqli_fetch_row($player_name);
                                   if(empty($score3)){
                                    echo "<td style='border:solid;  font-weight:bold;'><p style='color:black;'>$play_3 &nbsp;&nbsp; $play_3_1</p></td>"; 
                               }else{
                                 if($score3==1){
                                     echo "<td style='border:solid;  font-weight:bold;'><p style='color:black;'>$play_3 &nbsp;&nbsp; $play_3_1</p></td>"; 
                                 }else{
                                     echo "<td style='border:solid;  font-weight:bold;'><p style='color:#C0C0C0;'>$play_3 &nbsp;&nbsp; $play_3_1</p></td>"; 
                                 }
                               }
                                 echo "<td style='color:red; border:double; font-weight:bold;'>VS</td>"; 
                                   if(empty($enemy3[$i])){
                                     $match3='<a style="color:#696969;">ยังไม่มีการจับคู่</a>';
                                     $match3_1='';
                                   }elseif($enemy3[$i]==1 || $enemy3[$i]==001){
                                     $match3='<a style="color:red;">ชนะบาย</a>';
                                     $match3_1='';
                                   }else{
                                     $enemy=mysqli_query($con,"SELECT player_name,player_lastname,score3 FROM tour_player WHERE tour_no = '$_SESSION[tour_id]' AND player_id = '$enemy3[$i]' ")or die("Sql Error1>>".mysqli_error($con));
                                     list($match3,$match3_1,$score3_1)=mysqli_fetch_row($enemy);
                                   } 
                                   if(empty($score3_1)){
                                    echo "<td style=' border:solid; font-weight:bold;'><p style='color:black;'>$match3 &nbsp;&nbsp; $match3_1</p></td>";
                              }else{
                                if($score3_1==1){
                                    echo "<td style=' border:solid; font-weight:bold;'><p style='color:black;'>$match3 &nbsp;&nbsp; $match3_1</p></td>";
                                }else{
                                    echo "<td style=' border:solid; font-weight:bold;'><p style='color:#C0C0C0;'>$match3 &nbsp;&nbsp; $match3_1</p></td>";
                                }
                              }
                                 $score_chk3=mysqli_query($con,"SELECT score3 FROM tour_player WHERE tour_no = '$_SESSION[tour_id]' AND player_id = '$player[$i]' ")or die("Sql Error1>>".mysqli_error($con));
                                 list($sc3)=mysqli_fetch_row($score_chk3);
                                   if($sc3==1){
                                     $winner=$play_3. "&nbsp;&nbsp;" .$play_3_1;
                                   }elseif($sc3==2){
                                     $winner=$match3. "&nbsp;&nbsp;" .$match3_1;
                                   }else{
                                    $winner="<p><button data-toggle='modal' data-target='#match3-$player[$i]'  class='btn btn-primary'>ใส่ผลการแข่ง</button></p>";
                                   }

                                   echo "<td style='border-left:double 20px; text-align:center; border-bottom:dashed #FF7F50 5px; font-weight:bold;'><a style='color:green;'>$winner</a></td></tr>";
                                 $k=0;
                                 foreach($enemy3 as $bat){
                                   if($player[$i]==$bat){
                   
                                     unset($player[$k]);
                                   
                                   }else{
                                     
                                   }
                                    $k++;
                                 }
                               }
                               $num++;
                             }
                          
                    
                     ?>	
                           </tr>
                            <?php  ?>

                </table><br>
            </div>
                <?php
      break;
      case "idle":
        if($cm1==0){
        echo "<a href='index.php?module=tour&action=match&tid=$_SESSION[tour_id]&page=round1' style='align: center; '><button type='button' class='btn' style='font-size:20px; color:white; background-color:red; border-color:black; border-width: 5px;border-radius: 8px;'>
        รอบที่ 1</button></a>&nbsp; &nbsp;"; 
      }
      if($cm2==0){
        echo "<a href='index.php?module=tour&action=match&tid=$_SESSION[tour_id]&page=round2' style='align: center; '><button type='button' class='btn' style='font-size:20px; color:white; background-color:red; border-color:black; border-width: 5px;border-radius: 8px;'>
        รอบที่ 2</button></a>&nbsp; &nbsp;";
      }
      if($cm3==0){
        echo "<a href='index.php?module=tour&action=match&tid=$_SESSION[tour_id]&page=round3' style='align: center; '><button type='button' class='btn' style='font-size:20px; color:white; background-color:red; border-color:black; border-width: 5px;border-radius: 8px;'>
        รอบที่ 3</button></a>&nbsp; &nbsp;"; 
      }
  // $result=mysqli_query($con,"SELECT player_id,player_name,player_lastname,day_regis,match1,match2,match3,score1,score2,score3,total_score FROM tour_player WHERE tour_no = $_SESSION[tour_id] ORDER BY total_score DESC ,player_name ASC")or die("Sql Error>>".mysqli_error($con));
  if(!empty($_GET['search'])){
     $search = $_GET['search'];
  }else{
    $search = '';
  }
  
  $result=mysqli_query($con,"SELECT player_id,player_name,player_lastname,day_regis,match1,match2,match3,score1,score2,score3,total_score FROM tour_player WHERE tour_no = $_SESSION[tour_id] $search")or die("Sql Error>>".mysqli_error($con));
?>	<br><br>
	
		<div class="table-responsive table--no-card m-b-30">
			<table class="table table-borderless table-striped table-earning">
				<thead>
			<?php

  echo"<tr><th style='text-align:center;'width='5%'>รหัส</th>
  <th style='text-align:center;'>ชื่อผู้สมัคร</th>
  <th style='text-align:center;'>วันที่ลงทะเบียน</th>";
  if($search==" ORDER BY total_score DESC"){
    echo "<th style='text-align:center;'><a style='color:white;' href='index.php?module=tour&action=match&tid=$_SESSION[tour_id]&page=idle&search= ORDER BY total_score ASC'>คะแนนรวม <i class='fas fa fa-arrow-down'></i></a></th>";
  }else{
    echo "<th style='text-align:center;'><a style='color:white;' href='index.php?module=tour&action=match&tid=$_SESSION[tour_id]&page=idle&search= ORDER BY total_score DESC'>คะแนนรวม <i class='fas fa fa-arrow-up' </a></th>";
  }
  
 
  echo "</tr>";
  //  <th style='text-align:center;'>ผลการจับคู่</th>
?>	
				</thead>
	<tbody>
	<?php
	while(list($p_id,$p_name,$p_lastname,$p_regis,$m1,$m2,$m3,$score1,$score2,$score3,$total_score)=mysqli_fetch_row($result)){
  
	//echo $data [0],"-"; //การ eco array ต้องมี index
	echo "<td style='text-align:center;'><p style='color:black;'>$p_id</p></td>"; 
	//echo "<td><a href='product_detail.php?id=$product_id'>$product_title</a></td>"; //แบบ GET ไม่มี $ข้างหน้า
  echo "<td style='text-align:center;'><p style='color:black;'>$p_name  $p_lastname</p></td>";
  echo "<td style='text-align:center;'><p style='color:black;'>$p_regis</p></td>";
  echo "<td style='text-align:center;'><p style='color:black;'>$total_score</p></td>";
  
    
?>	
<!-- <td style='text-align:center;'><p><button data-toggle="modal" data-target="#contact<?php echo $p_id ?>"  class="btn btn-primary">DETAIL</button></p></td>-->


<?php
	
	echo "</tr>";
	}
  echo "</table></div>";

      break;
    } 
  }
  ?>
<?php
                                                      $Order_ID=mysqli_query($con,"SELECT player_id,player_name,player_lastname,match1,match2,match3 FROM tour_player WHERE tour_no ='$_SESSION[tour_id]'
                                                      ")or die("Sql Error>>".mysqli_error($con)); 
                                                      ?>
                                                     
                                                      <?php
                                                      while(list($p_id,$p_name,$p_lastname,$m1,$m2,$m3)=mysqli_fetch_row($Order_ID)){
                                                       
?>
              <div class="modal hide fade in" style=" margin-top:100px" id="match1-<?php echo $p_id ?>" > 
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
                                    </div>
                                        <div class="modal-body ">
                                        <form action="index.php?module=tour&action=update_score" method="post" enctype="multipart/form-data" class="form-horizontal">
                                          <?php 
                                              // $p_match=mysqli_query($con,"SELECT match1,match2,match3 FROM tour_player WHERE player_id =" + set_id($pid))or die("Sql Error1>>".mysqli_error($con));
                                              // list($m1,$m2,$m3)=mysqli_fetch_row($p_match);
                                              echo "<input type='hidden' name ='pid' value='$p_id'> ";
                                              echo "<input type='hidden' name='m1' value='$m1'> ";
                                              echo "<input type='hidden' name='match' value='1'>";
                                                          $player_full=$p_name." ".$p_lastname;
                                                  echo "<label style='color:red;'>เลือกผู้ชนะ</label>";
                                                  if($m1==1 || $m1==001){
                                                  echo "<br><b>ชนะบาย</b> <input type='hidden' name='score1' value='1'>" ;
                                                }else{
                                                  $enemy_name1=mysqli_query($con,"SELECT player_name,player_lastname FROM tour_player  WHERE tour_no ='$_SESSION[tour_id]'  AND player_id ='$m1' ")
                                                  or die("SQL Error==>".mysqli_error($con)); 
                                                  list($e_name1,$e_lastname1)=mysqli_fetch_row($enemy_name1); 
                                                  $fullname1=$e_name1." ".$e_lastname1;
                                                  echo "<tr>";
                                                  echo "<tb style='text-align:center;'><br>$player_full &nbsp;&nbsp;&nbsp;</tb>" ; 
                                                  echo "<tb style='text-align:center;'><b>VS</b> &nbsp;&nbsp;&nbsp;</tb>" ; 
                                                  echo "<tb style='text-align:center;'>$fullname1 &nbsp;&nbsp;&nbsp;</tb>" ; 
                                                  echo "</tr><br><br>";
                                                              echo "<select name='score1' >";
                                                                echo "<option value=1 >$player_full</option>";
                                                                echo "<option value=2 >$fullname1</option>";
                                                              echo  "</select>";
                                                }
                                          ?>
                                        
                                        <div class="modal-footer">
                                            <button class="btn btn-success" id="submit"><i class="glyphicon glyphicon-inbox"></i> Submit</button>
                                        </div>
                                        
                                        </form>
                                        </div>
                                </div>
                              </div>
                            </div> 

                            <div class="modal hide fade in" style=" margin-top:100px" id="match2-<?php echo $p_id ?>" > 
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
                                    </div>
                                        <div class="modal-body ">
                                        <form action="index.php?module=tour&action=update_score" method="post" enctype="multipart/form-data" class="form-horizontal">
                                          <?php 
                                              // $p_match=mysqli_query($con,"SELECT match1,match2,match3 FROM tour_player WHERE player_id =" + set_id($pid))or die("Sql Error1>>".mysqli_error($con));
                                              // list($m1,$m2,$m3)=mysqli_fetch_row($p_match);
                                              echo "<input type='hidden' name ='pid' value='$p_id'> ";
                                              echo "<input type='hidden' name='m2' value='$m2'> ";
                                              echo "<input type='hidden' name='match' value='2'>";
                                                          $player_full=$p_name." ".$p_lastname;
                                                  echo "<label style='color:red;'>เลือกผู้ชนะ</label>";
                                                  if($m1==1 || $m1==001){
                                                  echo "<br><b>ชนะบาย</b> <input type='hidden' name='score2' value='1'>" ;
                                                }else{
                                                  $enemy_name1=mysqli_query($con,"SELECT player_name,player_lastname FROM tour_player  WHERE tour_no ='$_SESSION[tour_id]'  AND player_id ='$m2' ")
                                                  or die("SQL Error==>".mysqli_error($con)); 
                                                  list($e_name1,$e_lastname1)=mysqli_fetch_row($enemy_name1); 
                                                  $fullname1=$e_name1." ".$e_lastname1;
                                                  echo "<tr>";
                                                  echo "<tb style='text-align:center;'><br>$player_full &nbsp;&nbsp;&nbsp;</tb>" ; 
                                                  echo "<tb style='text-align:center;'><b>VS</b> &nbsp;&nbsp;&nbsp;</tb>" ; 
                                                  echo "<tb style='text-align:center;'>$fullname1 &nbsp;&nbsp;&nbsp;</tb>" ; 
                                                  echo "</tr><br><br>";
 
                                                              echo "<select name='score2' >";
                                                                echo "<option value=1 >$player_full</option>";
                                                                echo "<option value=2 >$fullname1</option>";
                                                              echo  "</select>";
                                                           
                                                }
                                          ?>
                                        
                                        <div class="modal-footer">
                                            <button class="btn btn-success" id="submit"><i class="glyphicon glyphicon-inbox"></i> Submit</button>
                                        </div>
                                        
                                        </form>
                                        </div>
                                </div>
                              </div>
                            </div> 

                            <div class="modal hide fade in" style=" margin-top:100px" id="match3-<?php echo $p_id ?>" > 
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
                                    </div>
                                        <div class="modal-body ">
                                        <form action="index.php?module=tour&action=update_score" method="post" enctype="multipart/form-data" class="form-horizontal">
                                          <?php 
                                              // $p_match=mysqli_query($con,"SELECT match1,match2,match3 FROM tour_player WHERE player_id =" + set_id($pid))or die("Sql Error1>>".mysqli_error($con));
                                              // list($m1,$m2,$m3)=mysqli_fetch_row($p_match);
                                              echo "<input type='hidden' name ='pid' value='$p_id'> ";
                                              echo "<input type='hidden' name='m3' value='$m3'> ";
                                              echo "<input type='hidden' name='match' value='3'>";
                                                          $player_full=$p_name." ".$p_lastname;
                                                  echo "<label style='color:red;'>เลือกผู้ชนะ</label>";
                                                  if($m1==1 || $m1==001){
                                                  echo "<br><b>ชนะบาย</b> <input type='hidden' name='score3' value='1'>" ;
                                                }else{
                                                  $enemy_name1=mysqli_query($con,"SELECT player_name,player_lastname FROM tour_player  WHERE tour_no ='$_SESSION[tour_id]'  AND player_id ='$m3' ")
                                                  or die("SQL Error==>".mysqli_error($con)); 
                                                  list($e_name1,$e_lastname1)=mysqli_fetch_row($enemy_name1); 
                                                  $fullname1=$e_name1." ".$e_lastname1;
                                                  echo "<tr>";
                                                  echo "<tb style='text-align:center;'><br>$player_full &nbsp;&nbsp;&nbsp;</tb>" ; 
                                                  echo "<tb style='text-align:center;'><b>VS</b> &nbsp;&nbsp;&nbsp;</tb>" ; 
                                                  echo "<tb style='text-align:center;'>$fullname1 &nbsp;&nbsp;&nbsp;</tb>" ; 
                                                  echo "</tr><br><br>";

                                                              echo "<select name='score3' >";
                                                                echo "<option value=1 >$player_full</option>";
                                                                echo "<option value=2 >$fullname1</option>";
                                                              echo  "</select>";
                                                           
                                                }
                                          ?>
                                        
                                        <div class="modal-footer">
                                            <button class="btn btn-success" id="submit"><i class="glyphicon glyphicon-inbox"></i> Submit</button>
                                        </div>
                                        
                                        </form>
                                        </div>
                                </div>
                              </div>
                            </div> 
                            <?php } ?>
  
	

<?php
} //ปิดเงื่อนไข else ไม่ให้เห็นหัวตาราง (บรรทัด 43)
  }
 	?>
        
        </div>
      </div>
    </div> 
    <?php
    
    $cm1=0;$sc1=0;
    $cm2=0;$sc2=0;
    $cm3=0;$sc3=0;
    $cm4=0;$sc4=0;
 $result2=mysqli_query($con,"SELECT match1,match2,match3,score1,score2,score3 FROM tour_player WHERE tour_no = $_SESSION[tour_id] ")or die("Sql Error>>".mysqli_error($con));
 while(list($m1,$m2,$m3,$score1,$score2,$score3)=mysqli_fetch_row($result2)){
        if(empty($m1)){
          $cm1++;
        }
        if(empty($m2)){
          $cm2++;
        }
        if(empty($m3)){
          $cm3++;
        }
        if($score1==0){
          $sc1++;
        }
        if($score2==0){
          $sc2++;
        }
        if($score3==0){
          $sc3++;
        }
        $cm4++;$sc4++;
 }

 $regis=mysqli_query($con,"SELECT tour_max,tour_endregis FROM tournament WHERE tour_no ='$_SESSION[tour_id]' ")or die("Sql Error>>".mysqli_error($con));
 while(list($t_max,$t_end)=mysqli_fetch_row($regis)){

     if($rows < $t_max && $cm1>0){
       echo "<div class='text-center'>";
      echo "<a href='index.php?module=tour&action=add_player_form' ><button type='button' class='btn btn-success btn-ra' style=' padding: 20px 20px; font-size:20px;' ><i>ลงทะเบียนออฟไลน์</i>&nbsp;</button></a>";
      echo "</div><br>";
     }else{
    
     }
 }

 if($cm1>0) {
  echo "<div class='text-center'>";
   echo "&nbsp;<a href='index.php?module=tour&action=gen_match&id=$_SESSION[tour_id]&&match=1'><button type='button' class='btn btn-primary'style=' padding: 10px 10px; font-size:16x;' ><i>สุ่มคู่การแข่งรอบแรก</i>&nbsp;</button></a>&nbsp;";
   echo "</div>";echo "</div>";
 }elseif($cm2>0 && $sc1==0){
  echo "<div class='text-center'>";
   echo "&nbsp;<a href='index.php?module=tour&action=gen_match&id=$_SESSION[tour_id]&&match=2'><button type='button' class='btn btn-primary' style=' padding: 20px 10px; font-size:16px;'><i>สุ่มคู่การแข่งรอบสอง</i>&nbsp;</button></a>&nbsp;";
   echo "</div>";
 }elseif($cm3>0 && $sc2==0){
  echo "<div class='text-center'>";
   echo "&nbsp;<a href='index.php?module=tour&action=gen_match&id=$_SESSION[tour_id]&&match=3'><button type='button' class='btn btn-primary' style=' padding: 20px 10px; font-size:16px;'><i>สุ่มคู่การแข่งรอบสาม</i>&nbsp;</button></a>&nbsp;";
   echo "</div>";
 }
 
 if($rows==0){ 
 
}else{
  if($cm3==0 && $sc3==0){
    if($chkrows>0){
        echo "<h3 style='text-align: center; '>จับคู่การแข่งขันทั้งหมดเรียบร้อยแล้ว<h3>";
    }else{
        echo "<div class='text-center'>";
          echo "<form action='index.php?module=tour&action=single_tour&id=$_SESSION[tour_id]' method='post' enctype='multipart/form-data' class='form-horizontal'>";
            
            $num=5;
            $i=0;
            echo "<h4>กำหนดจำนวนผู้เข้ารอบตัดเชือก<h4>";
              echo "<select name='num_player' id='num_player'>";
                for($i=0;$i<12;$i++){
                    echo "<option value='$num'>$num</option>";
                    $num++;
                }
              
                
              echo "</select>";
            echo " <button class='btn btn-primary' id='submit'><i class='glyphicon glyphicon-inbox'></i> Submit</button>";
          echo"</form>";
        echo "</div>";
    }
    
   }
   
}
  echo "<br>";
  
    mysqli_close($con);

    ?>
</div>
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
