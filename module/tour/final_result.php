<?php

if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1 ){
	echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='index.php'</script>";
  }

?>
<meta charset="utf-8">
<?php

// echo $_POST['result'];
// echo "<br>";
// echo $_POST['round_id'];
// echo "<br>";
// echo $_POST['position'];
// echo "<br>";
if(empty($_POST['result'])){

//     echo "<script>alert('กรุณาใส่ผู้ชนะการแข่ง')</script>";
    echo "<script>window.location='index.php?module=tour&action=manage_single_tour&tid=$_SESSION[tour_id]&do=2'</script>" ;
    mysqli_close($con);

}
elseif(empty($_POST['winner'])){

              if($_POST['position']==0){

                      $sql="UPDATE single_tour SET
                      player_id1='$_POST[result]'
                      WHERE t_id='$_SESSION[tour_id]' AND round_id='$_POST[round_id]' " ;
                      mysqli_query($con,$sql) or die("SQL Error==>".mysqli_error($con));

                      $sql2="UPDATE single_tour SET
                      winner='$_POST[result]'
                      WHERE t_id='$_SESSION[tour_id]' AND next_round_id='$_POST[round_id]' AND position='$_POST[position]' " ;
                      mysqli_query($con,$sql2) or die("SQL Error==>".mysqli_error($con));

                //       echo "<script>alert('ใส่ผลการแข่งเสร็จสิ้น')</script>";
                      echo "<script>window.location='index.php?module=tour&action=manage_single_tour&tid=$_SESSION[tour_id]&do=3'</script>" ;
                      mysqli_close($con);

              }else{

                      $sql="UPDATE single_tour SET
                      player_id2='$_POST[result]'
                      WHERE t_id='$_SESSION[tour_id]' AND round_id='$_POST[round_id]' " ;
                      mysqli_query($con,$sql) or die("SQL Error==>".mysqli_error($con));

                      $sql2="UPDATE single_tour SET
                      winner='$_POST[result]'
                      WHERE t_id='$_SESSION[tour_id]' AND next_round_id='$_POST[round_id]' AND position='$_POST[position]' " ;
                      mysqli_query($con,$sql2) or die("SQL Error==>".mysqli_error($con));

                //       echo "<script>alert('ใส่ผลการแข่งเสร็จสิ้น')</script>";
                      echo "<script>window.location='index.php?module=tour&action=manage_single_tour&tid=$_SESSION[tour_id]&do=3'</script>" ;
                      mysqli_close($con);
              }
    }else{

                      $sql="UPDATE single_tour SET
                      winner='$_POST[result]'
                      WHERE t_id='$_SESSION[tour_id]' AND round_id='$_POST[round_id]' " ;
                      mysqli_query($con,$sql) or die("SQL Error==>".mysqli_error($con));

                //       echo "<script>alert('ใส่ผลการแข่งเสร็จสิ้น')</script>";
                      echo "<script>window.location='index.php?module=tour&action=manage_single_tour&tid=$_SESSION[tour_id]&do=3'</script>" ;
                      mysqli_close($con);
  
}
    





                

?>