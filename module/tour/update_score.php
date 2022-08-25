<?php
if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1 ){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='index.php'</script>";
  }
$p_id=$_POST['pid'];

if(empty($_POST['m1'])){
  $m1='';
}else{
  $m1=$_POST['m1'];
}

if(empty($_POST['m2'])){
  $m2='';
}else{
  $m2=$_POST['m2'];
}

if(empty($_POST['m3'])){
  $m3='';
}else{
  $m3=$_POST['m3'];
}

if(empty($_POST['score1'])){
  $score1='';
}else{
  $score1=$_POST['score1'];
}

if(empty($_POST['score2'])){
  $score2='';
}else{
  $score2=$_POST['score2'];
}

if(empty($_POST['score3'])){
  $score3='';
}else{
  $score3=$_POST['score3'];
}

if($score1==1){
  $enamy1=2;
}elseif($score1==2){
  $enamy1=1;
}
if($score2==1){
  $enamy2=2;
}elseif($score2==2){
  $enamy2=1;
}
if($score3==1){
  $enamy3=2;
}elseif($score3==2){
  $enamy3=1;
}

?>
<meta charset="utf-8">
<?php
if($_POST['match']==1){

        $sql="UPDATE tour_player SET
          score1=$score1
        WHERE player_id='$p_id' AND tour_no='$_SESSION[tour_id]' " ;
        mysqli_query($con,$sql) or die("SQL Error==>".mysqli_error($con));

        $sql2="UPDATE tour_player SET
          score1=$enamy1
        WHERE player_id='$m1' AND tour_no='$_SESSION[tour_id]' " ;
        mysqli_query($con,$sql2) or die("SQL Error==>".mysqli_error($con));
        
        // echo "<script>alert('อัพเดทเสร็จสิ้น1')</script>";
        echo "<script>window.location='index.php?module=tour&action=score_cal&tid=$_SESSION[tour_id]&pid=$p_id&m1=$m1&match=$_POST[match]'</script>" ;
        
      

}elseif($_POST['match']==2){

      $sql="UPDATE tour_player SET
        score2=$score2
      WHERE player_id='$p_id' AND tour_no='$_SESSION[tour_id]' " ;
      mysqli_query($con,$sql) or die("SQL Error==>".mysqli_error($con));

      $sql3="UPDATE tour_player SET
        score2=$enamy2
      WHERE player_id='$m2' AND tour_no='$_SESSION[tour_id]' " ;
      mysqli_query($con,$sql3) or die("SQL Error==>".mysqli_error($con));
      
      // echo "<script>alert('อัพเดทเสร็จสิ้น2')</script>";
      echo "<script>window.location='index.php?module=tour&action=score_cal&tid=$_SESSION[tour_id]&pid=$p_id&m2=$m2&match=$_POST[match]'</script>" ;

}elseif($_POST['match']==3){
  $sql="UPDATE tour_player SET
  score3=$score3
  WHERE player_id='$p_id' AND tour_no='$_SESSION[tour_id]' " ;
  mysqli_query($con,$sql) or die("SQL Error==>".mysqli_error($con));

  $sql4="UPDATE tour_player SET
    score3=$enamy3
  WHERE player_id='$m3' AND tour_no='$_SESSION[tour_id]' " ;
  mysqli_query($con,$sql4) or die("SQL Error==>".mysqli_error($con));

  // echo "<script>alert('อัพเดทเสร็จสิ้น3')</script>";
  echo "<script>window.location='index.php?module=tour&action=score_cal&tid=$_SESSION[tour_id]&pid=$p_id&m3=$m3&match=$_POST[match]'</script>" ;
}



//mysqli_query($con,$a)or die("SQL Error1==>".mysqli_error($con));

mysqli_close($con);
?>