<?php
if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1 ){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='index.php'</script>";
  }
  $match = $_GET['match'];


  if($match==1){

    $cal=mysqli_query($con,"SELECT player_id,score1,score2,score3 FROM tour_player WHERE tour_no = $_SESSION[tour_id] ")or die("Sql Error>>".mysqli_error($con));
    while(list($p_id,$c1,$c2,$c3)=mysqli_fetch_row($cal)){
  
                if($c1==1){
                $sc1=1;
                }else{
                    $sc1=0;
                }
                if($c2==1){
                $sc2=1;
                }else{
                    $sc2=0;
                }
                if($c3==1){
                $sc3=1;
                }else{
                    $sc3=0;
                }
                $total=$sc1+$sc2+$sc3;
            $sql="UPDATE tour_player SET
            total_score = $total
            WHERE player_id='$p_id' AND tour_no= '$_SESSION[tour_id]' " ;
            mysqli_query($con,$sql) or die("SQL Error==>".mysqli_error($con));
        }
    // echo "<script>alert('จับคู่รอบแรกเสร็จสิ้น')</script>";
    echo "<script>window.location='index.php?module=tour&action=match&tid=$_SESSION[tour_id]&page=round1&do=2'</script>" ;


  }elseif($match==2){

    $cal=mysqli_query($con,"SELECT player_id,score1,score2,score3 FROM tour_player WHERE tour_no = $_SESSION[tour_id] ")or die("Sql Error>>".mysqli_error($con));
    while(list($p_id,$c1,$c2,$c3)=mysqli_fetch_row($cal)){
  
                if($c1==1){
                $sc1=1;
                }else{
                    $sc1=0;
                }
                if($c2==1){
                $sc2=1;
                }else{
                    $sc2=0;
                }
                if($c3==1){
                $sc3=1;
                }else{
                    $sc3=0;
                }
                $total=$sc1+$sc2+$sc3;
            $sql="UPDATE tour_player SET
            total_score = $total
            WHERE player_id='$p_id' AND tour_no= '$_SESSION[tour_id]' " ;
            mysqli_query($con,$sql) or die("SQL Error==>".mysqli_error($con));
        }
    // echo "<script>alert('จับคู่รอบสองเสร็จสิ้น')</script>";
    echo "<script>window.location='index.php?module=tour&action=match&tid=$_SESSION[tour_id]&page=round2&do=3'</script>" ;


  }elseif($match==3){

    $cal=mysqli_query($con,"SELECT player_id,score1,score2,score3 FROM tour_player WHERE tour_no = $_SESSION[tour_id] ")or die("Sql Error>>".mysqli_error($con));
    while(list($p_id,$c1,$c2,$c3)=mysqli_fetch_row($cal)){
  
                if($c1==1){
                $sc1=1;
                }else{
                    $sc1=0;
                }
                if($c2==1){
                $sc2=1;
                }else{
                    $sc2=0;
                }
                if($c3==1){
                $sc3=1;
                }else{
                    $sc3=0;
                }
                $total=$sc1+$sc2+$sc3;
            $sql="UPDATE tour_player SET
            total_score = $total
            WHERE player_id='$p_id' AND tour_no= '$_SESSION[tour_id]' " ;
            mysqli_query($con,$sql) or die("SQL Error==>".mysqli_error($con));
        }
    // echo "<script>alert('จับคู่รอบสามเสร็จสิ้น')</script>";
    echo "<script>window.location='index.php?module=tour&action=match&tid=$_SESSION[tour_id]&page=round3&do=4'</script>" ;
  }

mysqli_close($con);
?>