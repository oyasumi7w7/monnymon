<?php
if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1 ){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='index.php'</script>";
  }
$sc1=0;$sc2=0;$sc3=0;$sc4=0;$sc5=0;$sc6=0;$sc7=0;$sc8=0;$sc9=0;$sc10=0;$sc11=0;$sc12=0;
$total1=0;$total2=0;$total3=0;$total4=0;

$p_id=$_GET['pid'];
    $calculate1=mysqli_query($con,"SELECT score1,score2,score3 FROM tour_player WHERE player_id='$p_id' AND tour_no='$_SESSION[tour_id]' ")or die("Sql Error1>>".mysqli_error($con));
      list($c1,$c2,$c3)=mysqli_fetch_row($calculate1);  
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


$total1=$sc1+$sc2+$sc3;





  if($_GET['match']==1){
    $m1=$_GET['m1'];
      $calculate2=mysqli_query($con,"SELECT score1,score2,score3 FROM tour_player WHERE player_id='$m1' AND tour_no='$_SESSION[tour_id]' ")or die("Sql Error1>>".mysqli_error($con));
      list($c4,$c5,$c6)=mysqli_fetch_row($calculate2);
      if($c4==1){
        $sc4=1;
        }else{
          $sc4=0;
        }
        if($c5==1){
        $sc5=1;
        }else{
          $sc5=0;
        }
        if($c6==1){
        $sc6=1;
        }else{
          $sc6=0;
        }
        $total2=$sc4+$sc5+$sc6;

        $sql="UPDATE tour_player SET
        total_score=$total1
      WHERE player_id='$p_id' AND tour_no='$_SESSION[tour_id]' " ;
      mysqli_query($con,$sql) or die("SQL Error==>".mysqli_error($con));
    
      $sql2="UPDATE tour_player SET
        total_score=$total2
      WHERE player_id='$m1' AND tour_no='$_SESSION[tour_id]' " ;
      mysqli_query($con,$sql2) or die("SQL Error==>".mysqli_error($con));
      
      // echo "<script>alert('อัพเดทเสร็จสิ้น1')</script>";
      echo "<script>window.location='index.php?module=tour&action=match&tid=$_SESSION[tour_id]&page=round1&do=5'</script>" ;
    
  

}elseif($_GET['match']==2){
  $m2=$_GET['m2'];
      $calculate3=mysqli_query($con,"SELECT score1,score2,score3 FROM tour_player WHERE player_id='$m2' AND tour_no='$_SESSION[tour_id]' ")or die("Sql Error1>>".mysqli_error($con));
      list($c7,$c8,$c9)=mysqli_fetch_row($calculate3);
      if($c7==1){
        $sc7=1;
        }else{
          $sc7=0;
        }
        if($c8==1){
        $sc8=1;
        }else{
          $sc8=0;
        }
        if($c9==1){
        $sc9=1;
        }else{
          $sc9=0;
        }
        $total3=$sc7+$sc8+$sc9;

        $sql="UPDATE tour_player SET
        total_score=$total1
      WHERE player_id='$p_id' AND tour_no='$_SESSION[tour_id]' " ;
      mysqli_query($con,$sql) or die("SQL Error==>".mysqli_error($con));
  
      $sql3="UPDATE tour_player SET
        total_score=$total3
      WHERE player_id='$m2' AND tour_no='$_SESSION[tour_id]' " ;
      mysqli_query($con,$sql3) or die("SQL Error==>".mysqli_error($con));
      
      // echo "<script>alert('อัพเดทเสร็จสิ้น2')</script>";
  echo "<script>window.location='index.php?module=tour&action=match&tid=$_SESSION[tour_id]&page=round2&do=5'</script>" ;

}elseif($_GET['match']==3){
  $m3=$_GET['m3'];
      $calculate4=mysqli_query($con,"SELECT score1,score2,score3 FROM tour_player WHERE player_id='$m3' AND tour_no='$_SESSION[tour_id]' ")or die("Sql Error1>>".mysqli_error($con));
      list($c10,$c11,$c12)=mysqli_fetch_row($calculate4);
      if($c10==1){
        $sc10=1;
        }else{
          $sc10=0;
        }
        if($c11==1){
        $sc11=1;
        }else{
          $sc11=0;
        }
        if($c12==1){
        $sc12=1;
        }else{
          $sc12=0;
        }
        $total4=$sc10+$sc11+$sc12;

        $sql="UPDATE tour_player SET
        total_score=$total1
        WHERE player_id='$p_id' AND tour_no='$_SESSION[tour_id]' " ;
        mysqli_query($con,$sql) or die("SQL Error==>".mysqli_error($con));
      
        $sql4="UPDATE tour_player SET
          total_score=$total4
        WHERE player_id='$m3' AND tour_no='$_SESSION[tour_id]' " ;
        mysqli_query($con,$sql4) or die("SQL Error==>".mysqli_error($con));
      
        // echo "<script>alert('อัพเดทเสร็จสิ้น3')</script>";
echo "<script>window.location='index.php?module=tour&action=match&tid=$_SESSION[tour_id]&page=round3&do=5'</script>" ;
}





mysqli_close($con);
?>