
<?php
if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']>2 ){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='main.php'</script>";
  }

?>
<p align="center"><a style="font-size:50px; color:#A52A2A; ">ประวัติการแข่ง</a></p><br><br>

<?php
$count_1=0;$num_play=0;$count_2=0;$num_play2=0;$count_3=0;$num_play3=0;$champ=0;
$champion = mysqli_query($con,"SELECT winner FROM single_tour WHERE winner='$num' AND num_round='1' ");
while(list($win0)=mysqli_fetch_row($champion)){
    $champ++;
}
$match1 = mysqli_query($con,"SELECT score1 FROM tour_player WHERE player_id='$num' AND score1='1' ");
while(list($win1)=mysqli_fetch_row($match1)){
    $count_1++;
    $count_2++;
}
$match2 = mysqli_query($con,"SELECT score2 FROM tour_player WHERE player_id='$num' AND score2='1' ");
while(list($win2)=mysqli_fetch_row($match2)){
    $count_1++;
    $count_2++;
}
$match3 = mysqli_query($con,"SELECT score3 FROM tour_player WHERE player_id='$num' AND score3='1' ");
while(list($win31)=mysqli_fetch_row($match3)){
    $count_1++;
    $count_2++;
}
$final = mysqli_query($con,"SELECT winner FROM single_tour WHERE winner='$num' ");
while(list($win4)=mysqli_fetch_row($final)){
    $count_1++;
    $count_3++;
}

$round1 = mysqli_query($con,"SELECT score1 FROM tour_player WHERE player_id='$num' ");
while(list($win1)=mysqli_fetch_row($round1)){
    $num_play++;
    $num_play2++;
}
$round2 = mysqli_query($con,"SELECT score2 FROM tour_player WHERE player_id='$num' ");
while(list($win2)=mysqli_fetch_row($round2)){
    $num_play++;
    $num_play2++;
}
$round3 = mysqli_query($con,"SELECT score3 FROM tour_player WHERE player_id='$num' ");
while(list($win31)=mysqli_fetch_row($round3)){
    $num_play++;
    $num_play2++;
}
$final1 = mysqli_query($con,"SELECT player_id1 FROM single_tour WHERE player_id1='$num' ");
while(list($win4)=mysqli_fetch_row($final1)){
    $num_play++;
    $num_play3++;
}
$final1_1 = mysqli_query($con,"SELECT player_id2 FROM single_tour WHERE player_id2='$num' ");
while(list($win5)=mysqli_fetch_row($final1_1)){
    $num_play++;
    $num_play3++;
}
$win_rate_all=($count_1/$num_play)*100;
$win_rate_robin=($count_2/$num_play2)*100;
$win_rate_single=($count_3/$num_play3)*100;

        echo "<p  style='color:#00008B; font-size:20px; '>เป็นแชมป์ทั้งหมด :  $champ ครั้ง</p>";
		echo "<p  style='color:#00008B; font-size:20px; '>อัตราการชนะทั้งหมด : ".number_format($win_rate_all,2)."% => ชนะ $count_1 / $num_play ครั้ง</p>";
        echo "<p  style='color:#00008B; font-size:20px; '>อัตราการชนะรอบเก็บผลการแข่ง : ".number_format($win_rate_robin,2)."% => ชนะ $count_2 / $num_play2 ครั้ง</p>";
        echo "<p  style='color:#00008B; font-size:20px; '>อัตราการชนะรอบตัดเชือก : ".number_format($win_rate_single,2)."% => ชนะ $count_3 / $num_play3 ครั้ง</p>";

        
        echo "<br><br><p align='center'><a href='index.php?module=tour&action=history&type=robin' style='align: center; '><button type='button' class='btn' style='font-size:20px; color: #FFA500; background-color:white; border-color:#FFA500; border-width: 5px;' >
        ผลจับคู่รอบเก็บผลการแข่ง</button></a>&nbsp; &nbsp; ";
        echo "<a href='index.php?module=tour&action=history&type=single' style='align: center; '><button type='button' class='btn' style='font-size:20px; color:#FF8C00; background-color:white; border-color:#FF8C00; border-width: 5px;' >
        ผลจับคู่รอบรอบตัดเชือก</button></a>&nbsp;&nbsp;<br><br> </p>";
      
        if(!empty($_GET["type"])) {
            switch($_GET["type"]) {
                case "robin":  
                    $robin = mysqli_query($con,"SELECT tour_no FROM tour_player WHERE player_id='$num' ORDER BY tour_no DESC ");
                    ?>
                    <div class="table-responsive table--no-card m-b-30">
                        <table class="table table-borderless table-striped table-earning">
                            <thead>
                    <?php
        
                                echo"<tr style='color:#00008B; font-size:20px; '>
                                <th style='text-align:center; width:5%'>ตัวฉัน</th>
                                <th style='text-align:center; width:5%'></th>
                                <th style='text-align:center; width:5%''>คู่แข่ง</th>
                                <th style='text-align:center; width:5%'>ผลการแข่ง</th>
                                <th style='text-align:center; width:5%'>Tournament</th></tr>";
                    ?>	
                            </thead>
                        <tbody>
                    <?php 
                    while(list($tour)=mysqli_fetch_row($robin)){
                            $tour_play = mysqli_query($con,"SELECT tour_name FROM tournament WHERE tour_no='$tour'");
                            list($tour_name)=mysqli_fetch_row($tour_play);
                           
                            $robin2 = mysqli_query($con,"SELECT player_name,player_lastname,match1,match2,match3,score1,score2,score3 FROM tour_player WHERE tour_no='$tour' AND player_id='$num'");
                            list($p_name,$p_lastname,$m1,$m2,$m3,$sc1,$sc2,$sc3)=mysqli_fetch_row($robin2);
                                    
                                     	
                                        if(!empty($m1)){
                                                $loop_m1 = mysqli_query($con,"SELECT player_name,player_lastname FROM tour_player WHERE player_id='$m1' ");
                                                list($e_name1,$e_lastname1)=mysqli_fetch_row($loop_m1);
                                                    if($sc1==1){
                                                            $result='<a style="color:#228B22;">ชนะ</a>';
                                                            $full_name1='<a style="color:black;">'.$p_name.'&nbsp;&nbsp;&nbsp;'.$p_lastname.'</a>';
                                                            $full_e1='<a style="">'.$e_name1.'&nbsp;&nbsp;&nbsp;'.$e_lastname1.'</a>';
                                                    }else{
                                                        $result='<a style="color:#B22222;">แพ้</a>';
                                                        $full_name1='<a style="">'.$p_name.'&nbsp;&nbsp;&nbsp;'.$p_lastname.'</a>';
                                                        $full_e1='<a style="color:black;">'.$e_name1.'&nbsp;&nbsp;&nbsp;'.$e_lastname1.'</a>';
                                                    } ?>
                                                        <tr style="color:black">
                                                    <?php
                                                    echo "<td style='text-align:center;'>$full_name1</td>"; 
                                                    echo "<td style='text-align:center; color:red;'>VS</td>"; 
                                                    echo "<td style='text-align:center;'>$full_e1</td>"; 
                                                    echo "<td style='text-align:center; '>$result</td>";
                                                    echo "<td style='text-align:center; color:#00008B'><a href='show_result.php?tid=$tour'>$tour_name</a></td></tr>"; 
                                                   
                                                }
                                        
                                        if(!empty($m2)){
                                                $loop_m2 = mysqli_query($con,"SELECT player_name,player_lastname FROM tour_player WHERE player_id='$m2' ");
                                            list($e_name2,$e_lastname2)=mysqli_fetch_row($loop_m2);
                                                    if($sc2==1){
                                                        $result='<a style="color:#228B22;">ชนะ</a>';
                                                        $full_name2='<a style="color:black;">'.$p_name.'&nbsp;&nbsp;&nbsp;'.$p_lastname.'</a>';
                                                        $full_e2='<a style="">'.$e_name2.'&nbsp;&nbsp;&nbsp;'.$e_lastname2.'</a>';
                                                    }else{
                                                        $result='<a style="color:#B22222;">แพ้</a>';
                                                        $full_name2='<a style="">'.$p_name.'&nbsp;&nbsp;&nbsp;'.$p_lastname.'</a>';
                                                        $full_e2='<a style="color:black;">'.$e_name2.'&nbsp;&nbsp;&nbsp;'.$e_lastname2.'</a>';
                                                    } ?>
                                                    <tr style="color:black">
                                                    
                                                <?php
                                                    echo "<td style='text-align:center;'>$full_name2</td>"; 
                                                    echo "<td style='text-align:center; color:red;'>VS</td>"; 
                                                    echo "<td style='text-align:center;'>$full_e2</td>"; 
                                                    echo "<td style='text-align:center; '>$result</td>";
                                                    echo "<td style='text-align:center; color:#00008B'><a href='show_result.php?tid=$tour'>$tour_name</a></td></tr>"; 

                                                
                                        }
                                        if(!empty($m3)){
                                            $loop_m3 = mysqli_query($con,"SELECT player_name,player_lastname FROM tour_player WHERE player_id='$m3' ");
                                            list($e_name3,$e_lastname3)=mysqli_fetch_row($loop_m3);
                                                if($sc3==1){
                                                    $result='<a style="color:#228B22;">ชนะ</a>';
                                                    $full_name3='<a style="color:black;">'.$p_name.'&nbsp;&nbsp;&nbsp;'.$p_lastname.'</a>';
                                                    $full_e3='<a style="">'.$e_name3.'&nbsp;&nbsp;&nbsp;'.$e_lastname3.'</a>';
                                                }else{
                                                    $result='<a style="color:#B22222;">แพ้</a>';
                                                    $full_name3='<a style="">'.$p_name.'&nbsp;&nbsp;&nbsp;'.$p_lastname.'</a>';
                                                    $full_e3='<a style="color:black;">'.$e_name3.'&nbsp;&nbsp;&nbsp;'.$e_lastname3.'</a>';
                                                } ?>
                                                <tr style="color:black">
                                            <?php
                                                echo "<td style='text-align:center;'>$full_name3</td>"; 
                                                echo "<td style='text-align:center; color:red;'>VS</td>"; 
                                                echo "<td style='text-align:center;'>$full_e3</td>"; 
                                                echo "<td style='text-align:center; '>$result</td>";
                                                echo "<td style='text-align:center; color:#00008B'><a href='show_result.php?tid=$tour'>$tour_name</a></td></tr>"; 
        
                                            }
                }
            echo "</tbody></table>"; 

                break;
                case "single":
                    $single = mysqli_query($con,"SELECT tour_no FROM tour_player WHERE player_id='$num' ORDER BY tour_no DESC ");
                    ?>
                    <div class="table-responsive table--no-card m-b-30">
                        <table class="table table-borderless table-striped table-earning">
                            <thead>
                    <?php
        
                                echo"<tr style='color:#00008B; font-size:20px; '>
                                <th style='text-align:center; width:5%'>ตัวฉัน</th>
                                <th style='text-align:center; width:5%'></th>
                                <th style='text-align:center; width:5%''>คู่แข่ง</th>
                                <th style='text-align:center; width:5%'>ผลการแข่ง</th>
                                <th style='text-align:center; width:5%'>รอบ</th>
                                <th style='text-align:center; width:5%'>Tournament</th></tr>";
                    ?>	
                            </thead>
                        <tbody>
                    <?php 
                    while(list($tour)=mysqli_fetch_row($single)){
                        $tour_play = mysqli_query($con,"SELECT tour_name FROM tournament WHERE tour_no='$tour'");
                        list($tour_name)=mysqli_fetch_row($tour_play);

                        $single2 = mysqli_query($con,"SELECT player_name,player_lastname FROM tour_player WHERE tour_no='$tour' AND player_id='$num'");
                            list($p_name,$p_lastname)=mysqli_fetch_row($single2);
                        
                            $loop_p1 = mysqli_query($con,"SELECT num_round,player_id2,winner FROM single_tour WHERE player_id1='$num' AND t_id='$tour' ORDER BY num_round ASC , round_id DESC");
                            while(list($num_r,$e_id2,$winner)=mysqli_fetch_row($loop_p1)){
                                            $e_info = mysqli_query($con,"SELECT player_name,player_lastname FROM tour_player WHERE player_id='$e_id2' ");
                                            list($e_name1,$e_lastname1)=mysqli_fetch_row($e_info);
                            if(!empty($winner)){
                                if($winner==$num){
                                    $result='<a style="color:#228B22;">ชนะ</a>';
                                    $full_name1='<a style="color:black;">'.$p_name.'&nbsp;&nbsp;&nbsp;'.$p_lastname.'</a>';
                                    $full_e1='<a style="">'.$e_name1.'&nbsp;&nbsp;&nbsp;'.$e_lastname1.'</a>';
                                }else{
                                    $result='<a style="color:#B22222;">แพ้</a>';
                                    $full_name1='<a style="">'.$p_name.'&nbsp;&nbsp;&nbsp;'.$p_lastname.'</a>';
                                    $full_e1='<a style="color:black;">'.$e_name1.'&nbsp;&nbsp;&nbsp;'.$e_lastname1.'</a>';
                                } 
                            }else{
                                $result='<a style="color:orange;">รอผลการแข่ง</a>';
                                $full_name1='<a style="color:black;">'.$p_name.'&nbsp;&nbsp;&nbsp;'.$p_lastname.'</a>';
                                $full_e1='<a style="color:black;">'.$e_name1.'&nbsp;&nbsp;&nbsp;'.$e_lastname1.'</a>';
                            }
                                ?>
                                    <tr style="color:black">
                                <?php
                                if($num_r==1){
                                    $num_round=2;
                                }else{
                                    $num_round=pow(2,$num_r);
                                }
                                echo "<td style='text-align:center;'>$full_name1</td>"; 
                                echo "<td style='text-align:center; color:red;'>VS</td>"; 
                                echo "<td style='text-align:center;'>$full_e1</td>"; 
                                echo "<td style='text-align:center; '>$result</td>";
                                echo "<td style='text-align:center; '> $num_round คนสุดท้าย</td>";
                                echo "<td style='text-align:center; color:#00008B'><a href='show_result.php?tid=$tour'>$tour_name</a></td></tr>"; 
                            }
                            $loop_p2 = mysqli_query($con,"SELECT num_round,player_id1,winner FROM single_tour WHERE player_id2='$num' AND t_id='$tour'  ORDER BY num_round ASC , round_id DESC");
                            while(list($num_r2,$e_id1,$winner)=mysqli_fetch_row($loop_p2)){
                                            $e_info = mysqli_query($con,"SELECT player_name,player_lastname FROM tour_player WHERE player_id='$e_id1' ");
                                            list($e_name2,$e_lastname2)=mysqli_fetch_row($e_info);
                                if($winner==$num){
                                    $result='<a style="color:#228B22;">ชนะ</a>';
                                    $full_name1='<a style="color:black;">'.$p_name.'&nbsp;&nbsp;&nbsp;'.$p_lastname.'</a>';
                                    $full_e1='<a style="">'.$e_name2.'&nbsp;&nbsp;&nbsp;'.$e_lastname2.'</a>';
                                }else{
                                    $result='<a style="color:#B22222;">แพ้</a>';
                                    $full_name1='<a style="">'.$p_name.'&nbsp;&nbsp;&nbsp;'.$p_lastname.'</a>';
                                    $full_e1='<a style="color:black;">'.$e_name2.'&nbsp;&nbsp;&nbsp;'.$e_lastname2.'</a>';
                                } ?>
                                    <tr style="color:black">
                                <?php
                                if($num_r2==1){
                                    $num_round2=2;
                                }else{
                                    $num_round2=pow(2,$num_r2);
                                }
                                echo "<td style='text-align:center;'>$full_name1</td>"; 
                                echo "<td style='text-align:center; color:red;'>VS</td>"; 
                                echo "<td style='text-align:center;'>$full_e1</td>"; 
                                echo "<td style='text-align:center; '>$result</td>"; 
                                echo "<td style='text-align:center; '> $num_round2 คนสุดท้าย</td>";
                                echo "<td style='text-align:center; color:#00008B'><a href='show_result.php?tid=$tour'>$tour_name</a></td></tr>"; 
                            }
                            
                    }
                    echo "</tbody></table>"; 
                break;
            }
        }
        ?>