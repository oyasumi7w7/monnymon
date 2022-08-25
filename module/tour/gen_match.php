<?php
if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1){
    echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
echo "<script>window.location='index.php'</script>";
}

// $id=$_GET['id'];
$match=$_GET['match'];
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<head>
<?php
function scheduler($teams){
    if (count($teams)%2 != 0){
        array_push($teams,001);
    }
    $away = array_splice($teams,(count($teams)/2));
    $home = $teams;
    for ($i=0; $i < 1; $i++){
        for ($j=0; $j<count($home); $j++){
            $round[$i][$j]["Home"]=$home[$j];
            $round[$i][$j]["Away"]=$away[$j];
        }
        if(count($home)+count($away)-1 > 2){
            $ar = array_splice($home,1,1);
            $test = array_shift($ar);
            array_unshift($away,$test);
            array_push($home,array_pop($away));

        // if(count($home)+count($away)-1 > 2){
        //     array_unshift($away,array_shift(array_splice($home,1,1)));
        //     array_push($home,array_pop($away));
        }
    }
    return $round;
}

?>

<?php 
if($match==1){
 $draw=mysqli_query($con,"SELECT player_id FROM tour_player WHERE tour_no =$_SESSION[tour_id] ORDER by RAND() ")or die("Sql Error>>".mysqli_error($con));
 $rowpl=mysqli_num_rows($draw);
 $members=array();
 while(list($pid)=mysqli_fetch_row($draw)){
   
   array_push($members,"$pid");

 }
 shuffle($members);

?>
<?php $schedule = scheduler($members); ?>
<?php
foreach($schedule AS $round => $games){
    //echo "Round: ".($round+1)."<BR>";

    foreach($games AS $play){
        //echo "||".$play["Home"]." - ".$play["Away"];
        if($play['Away']==001){
            $score1="1";
        }else{
            $score1="0";
        }
        if($play['Home']==001){
            $score2="1";
        }else{
            $score2="0";
        }

        $sql="UPDATE tour_player SET
					match$match='$play[Away]',
                    score1 = $score1
                    WHERE player_id='$play[Home]' AND tour_no= '$_SESSION[tour_id]' " ;
                    mysqli_query($con,$sql) or die("SQL Error==>".mysqli_error($con));
         $sql2="UPDATE tour_player SET
					match$match='$play[Home]',
                    score1 = $score2
                    WHERE player_id='$play[Away]' AND tour_no='$_SESSION[tour_id] ' " ;
                    mysqli_query($con,$sql2) or die("SQL Error==>".mysqli_error($con));
    }
}

       // echo "<script>alert('จับคู่รอบแรกเสร็จสิ้น')</script>";
        // echo "<script>window.location='index.php?module=tour&action=match&tid=$id'</script>" ;
        echo "<script>window.location='index.php?module=tour&action=cal_after&match=$match'</script>" ;

}elseif($match==2){
    $draw=mysqli_query($con,"SELECT player_id FROM tour_player WHERE tour_no ='$_SESSION[tour_id]' AND score1 ='1' ORDER by RAND() ")or die("Sql Error>>".mysqli_error($con));
    $rowpl=mysqli_num_rows($draw);
    $members=array();
    while(list($pid)=mysqli_fetch_row($draw)){
      
      array_push($members,"$pid");
   
    }  
    shuffle($members);

    ?>
    <?php $schedule = scheduler($members); ?>
    <?php
    foreach($schedule AS $round => $games){
        //echo "Round: ".($round+1)."<BR>";
    
        foreach($games AS $play){
            //echo "||".$play["Home"]." - ".$play["Away"];
            if($play['Away']==001){
                $score1="1";
            }else{
                $score1="0";
            }
            if($play['Home']==001){
                $score2="1";
            }else{
                $score2="0";
            }

            $sql="UPDATE tour_player SET
                        match$match='$play[Away]',
                        score2 = $score1
                        WHERE player_id='$play[Home]' AND tour_no='$_SESSION[tour_id]' " ;
                        mysqli_query($con,$sql) or die("SQL Error==>".mysqli_error($con));
             $sql2="UPDATE tour_player SET
                        match$match='$play[Home]',
                        score2 = $score2
                        WHERE player_id='$play[Away]' AND tour_no='$_SESSION[tour_id]' " ;
                        mysqli_query($con,$sql2) or die("SQL Error==>".mysqli_error($con));
        }
    }
    $draw2=mysqli_query($con,"SELECT player_id FROM tour_player WHERE tour_no ='$_SESSION[tour_id]'AND score1 ='2' ORDER by RAND() ")or die("Sql Error>>".mysqli_error($con));
    $rowpl2=mysqli_num_rows($draw2);
    $members2=array();
    while(list($pid2)=mysqli_fetch_row($draw2)){
      
      array_push($members2,"$pid2");
   
    }
    shuffle($members2);

    ?>
    <?php $schedule = scheduler($members2); ?>
<?php
    foreach($schedule AS $round => $games){
        //echo "Round: ".($round+1)."<BR>";

        foreach($games AS $play){
            //echo "||".$play["Home"]." - ".$play["Away"];
            if($play['Away']==001){
                $score1="1";
            }else{
                $score1="0";
            }
            if($play['Home']==001){
                $score2="1";
            }else{
                $score2="0";
            }

            $sql="UPDATE tour_player SET
                        match$match='$play[Away]',
                        score2 = $score1
                        WHERE player_id='$play[Home]' AND tour_no='$_SESSION[tour_id]' " ;
                        mysqli_query($con,$sql) or die("SQL Error==>".mysqli_error($con));
            $sql2="UPDATE tour_player SET
                        match$match='$play[Home]',
                        score2 = $score2
                        WHERE player_id='$play[Away]' AND tour_no='$_SESSION[tour_id]' " ;
                        mysqli_query($con,$sql2) or die("SQL Error==>".mysqli_error($con));
        }
       
    } 
       // echo "<script>alert('จับคู่รอบสองเสร็จสิ้น')</script>";
        // echo "<script>window.location='index.php?module=tour&action=match&tid=$id'</script>" ;
        echo "<script>window.location='index.php?module=tour&action=cal_after&match=$match'</script>" ;


}elseif($match==3){
    $draw=mysqli_query($con,"SELECT player_id FROM tour_player WHERE tour_no ='$_SESSION[tour_id]' AND score2 ='1' ORDER by RAND() ")or die("Sql Error>>".mysqli_error($con));
    $rowpl=mysqli_num_rows($draw);
    $members=array();
    while(list($pid)=mysqli_fetch_row($draw)){
      
      array_push($members,"$pid");
   
    }  
    shuffle($members);

    ?>
    <?php $schedule = scheduler($members); ?>
    <?php
    foreach($schedule AS $round => $games){
        //echo "Round: ".($round+1)."<BR>";
    
        foreach($games AS $play){
            //echo "||".$play["Home"]." - ".$play["Away"];
            if($play['Away']==001){
            $score1="1";
        }else{
            $score1="0";
        }
        if($play['Home']==001){
            $score2="1";
        }else{
            $score2="0";
        }

            $sql="UPDATE tour_player SET
                        match$match='$play[Away]',
                        score3 = $score1
                        WHERE player_id='$play[Home]' AND tour_no='$_SESSION[tour_id]' " ;
                        mysqli_query($con,$sql) or die("SQL Error==>".mysqli_error($con));
             $sql2="UPDATE tour_player SET
                        match$match='$play[Home]',
                        score3 = $score2
                        WHERE player_id='$play[Away]' AND tour_no='$_SESSION[tour_id]' " ;
                        mysqli_query($con,$sql2) or die("SQL Error==>".mysqli_error($con));
        }
    }
  
    $draw2=mysqli_query($con,"SELECT player_id FROM tour_player WHERE tour_no ='$_SESSION[tour_id]'AND score2 ='2' ORDER by RAND() ")or die("Sql Error>>".mysqli_error($con));
    $rowpl2=mysqli_num_rows($draw2);
    $members2=array();
    while(list($pid2)=mysqli_fetch_row($draw2)){
      
      array_push($members2,"$pid2");
   
    }
    shuffle($members2);

    ?>
    <?php $schedule = scheduler($members2); ?>
    

<?php
    foreach($schedule AS $round => $games){
        //echo "Round: ".($round+1)."<BR>";

        foreach($games AS $play){
            //echo "||".$play["Home"]." - ".$play["Away"];
            if($play['Away']==001){
            $score1="1";
        }else{
            $score1="0";
        }
        if($play['Home']==001){
            $score2="1";
        }else{
            $score2="0";
        }

            $sql="UPDATE tour_player SET
                        match$match='$play[Away]',
                        score3 = $score1
                        WHERE player_id='$play[Home]' AND tour_no='$_SESSION[tour_id]' " ;
                        mysqli_query($con,$sql) or die("SQL Error==>".mysqli_error($con));
            $sql2="UPDATE tour_player SET
                        match$match='$play[Home]',
                        score3 = $score2
                        WHERE player_id='$play[Away]' AND tour_no='$_SESSION[tour_id]' " ;
                        mysqli_query($con,$sql2) or die("SQL Error==>".mysqli_error($con));
        }
       
    } 
        //echo "<script>alert('จับคู่รอบสามสร็จสิ้น')</script>";
        // echo "<script>window.location='index.php?module=tour&action=match&tid=$id'</script>" ;
        echo "<script>window.location='index.php?module=tour&action=cal_after&match=$match'</script>" ;
}

?>
<?php
mysqli_close($con);
?>
    </body>
    </html>