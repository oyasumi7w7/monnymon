<?php
if(empty($_SESSION['valid_user']) or $_SESSION['valid_type']!=1 ){
		echo "<script>alert('สิทธิ์ไม่ถถูกต้อง')</script>";
    echo "<script>window.location='index.php'</script>";
  }


  $player_count=$_POST['num_player'];
  $num_round=$_POST['num_player'];
  $matchCount=$player_count-1;

      $draw=mysqli_query($con,"SELECT player_id FROM tour_player WHERE tour_no ='$_SESSION[tour_id]' ORDER by total_score DESC ,player_name ASC LIMIT $player_count ")or die("Sql Error>>".mysqli_error($con));
        $players=array();
        while(list($pid)=mysqli_fetch_row($draw)){
        
        array_push($players,"$pid");

        }

      $matchs=array();

      for ($i = 1; $i <= $matchCount; $i++){

          $match = (object)[
              't_id' => $_SESSION['tour_id'],
              'num_round' => '0',
              'round_id' => $i,
              'player_id1' => '',
              'player_id2' => '',
              'winner' => '',
              'next_round_id'=> '',
              'position' => ''];
  
          array_push($matchs, $match);
      }

  $poweredValue=2;
  $roundCount=1;

  for(;$poweredValue<$player_count;$poweredValue*=2){
    $roundCount++;
  }

 $freeWinPlayerCount = $poweredValue - $player_count;
  $firstRoundMatchCount = ($poweredValue / 2) - $freeWinPlayerCount;
  $secondRoundMatchCount = $poweredValue / 4;
  $thirdRoundMatchCount = $poweredValue / 8;

  $waitMatchCount = 0;
  $normalMatchCount = 0;

  if ($freeWinPlayerCount > 0) {

		if ($secondRoundMatchCount > ($firstRoundMatchCount + ($firstRoundMatchCount%2)/2)) {
			$waitMatchCount = $firstRoundMatchCount;
			$normalMatchCount = $secondRoundMatchCount - $waitMatchCount;
		} else {
			$waitMatchCount = $secondRoundMatchCount*2 - $firstRoundMatchCount;
		}
  }

  //  Section #1 -> Final round
	//  Section #2 -> Semi-final - round after second round
	//  Section #3 -> Second round
  //  Section #4 -> First round
  
  $currentMatchIndex = 0;
  $currentRound = 0;

  // Section #1

  $matchs[0]->num_round = $currentRound + 1;
  

	$currentMatchIndex++;
	$currentRound++;

  // Section #2

  if ($roundCount > 2) {

		 $matchIndexToLink = 0;
		 $currentRoundMatchCount = 1;

		for (; $currentRound < $roundCount-2; $currentRound++ ){

			$currentRoundMatchCount *= 2;

			for ($i = 0; $i < $currentRoundMatchCount; $i++ ){

				$matchToLink = $matchs[$matchIndexToLink];

				$matchs[$currentMatchIndex]->next_round_id = $matchToLink->round_id;
        $matchs[$currentMatchIndex]->num_round = $currentRound + 1;
        $matchs[$currentMatchIndex]->position = $i%2 == 1 ;
				$currentMatchIndex++;

				if ($i%2 == 1 ){
					$matchIndexToLink++;
				}
			}
		}
  }

  // Section #3

	$startIndexToLink = $thirdRoundMatchCount - 1;
	if ($startIndexToLink < 0 ){
		$startIndexToLink = 0;
	}

	$currentNormalMatchCount = $normalMatchCount;
	$currentWaitMatchCount = $waitMatchCount;

  $matchIndexToLink = $startIndexToLink;
	for ( $i = 0; $i < $secondRoundMatchCount; $i++) {

		$matchToLink = $matchs[$matchIndexToLink];

		$canSetWaitMatch = $currentWaitMatchCount > 0;
		$canSetNormalMatchCount = $currentNormalMatchCount > 0;

		if ($canSetWaitMatch) {

			$playerA = array_shift($players);

			$matchs[$currentMatchIndex]->player_id1 = $playerA;
			$currentWaitMatchCount--;

		} elseif($canSetNormalMatchCount) {

      $playerA = array_shift($players);
      $playerB = array_shift($players);

			$matchs[$currentMatchIndex]->player_id1 = $playerA;
			$matchs[$currentMatchIndex]->player_id2 = $playerB;
			$currentNormalMatchCount--;
		}

    $matchs[$currentMatchIndex]->next_round_id = $matchToLink->round_id;
    $matchs[$currentMatchIndex]->position = $i%2 == 1 ;
		$matchs[$currentMatchIndex]->num_round = $currentRound + 1;

		$currentMatchIndex++;

		if ($i%2 == 1) {
			$matchIndexToLink++;
		}
	}

  $currentRound++;
  
// Section #4

$startIndexToLink = $secondRoundMatchCount - 1;
if ($startIndexToLink < 0) {
  $startIndexToLink = 0;
}
$matchIndexToLink = $startIndexToLink;
for ($i =  0; $i < $secondRoundMatchCount; $i++ ){

  $matchToLink = $matchs[$matchIndexToLink];

  if ($matchToLink->player_id1 == "" && $matchToLink->player_id2 == "" ){

    $playerALeftMatch = array_shift($players);
    $playerBLeftMatch = array_shift($players);

    $matchs[$currentMatchIndex]->player_id1 = $playerALeftMatch;
    $matchs[$currentMatchIndex]->player_id2 = $playerBLeftMatch;
    $matchs[$currentMatchIndex]->next_round_id = $matchToLink->round_id;
    $matchs[$currentMatchIndex]->num_round = $currentRound + 1;
    $matchs[$currentMatchIndex]->position = 0 ;

    $playerARightMatch = array_shift($players);
    $playerBRightMatch = array_shift($players);
 

    $matchs[$currentMatchIndex+1]->player_id1 = $playerARightMatch;
    $matchs[$currentMatchIndex+1]->player_id2 = $playerBRightMatch;
    $matchs[$currentMatchIndex+1]->next_round_id = $matchToLink->round_id;
    $matchs[$currentMatchIndex+1]->num_round = $currentRound + 1;
    $matchs[$currentMatchIndex+1]->position = 1 ;

    $currentMatchIndex += 2;
  } elseif ($matchToLink->player_id1 == "" || $matchToLink->player_id2 == "" ){

    $playerA = array_shift($players);
    $playerB = array_shift($players);

    $matchs[$currentMatchIndex]->player_id1 = $playerA;
    $matchs[$currentMatchIndex]->player_id2 = $playerB;
    $matchs[$currentMatchIndex]->next_round_id = $matchToLink->round_id;
    $matchs[$currentMatchIndex]->num_round = $currentRound + 1;
    $matchs[$currentMatchIndex]->position = 1 ;

    $currentMatchIndex++;
  }

  $matchIndexToLink++;
}


$draw=mysqli_query($con,"SELECT player_id FROM tour_player WHERE tour_no ='$_SESSION[tour_id]' ORDER by total_score DESC ,player_name ASC LIMIT $player_count ")or die("Sql Error>>".mysqli_error($con));
$players=array();
while(list($pid)=mysqli_fetch_row($draw)){
 
 array_push($players,"$pid");

}




// echo "player : ";
// print_r($players);
// echo "<br>";
// echo "matchs : ";
// print_r($matchs);
// echo "<br>";
//   echo "player_count : <b>$player_count</b><br><br>";
//   echo "round : $roundCount<br>";
//   echo "matchCount : $matchCount<br>";
//   echo "freeWinPlayerCount : $freeWinPlayerCount<br><br>";

//   echo "firstRoundMatchCount : $firstRoundMatchCount<br>";
//   echo "secondRoundMatchCount : $secondRoundMatchCount<br>";
//   echo "thirdRoundMatchCount : $thirdRoundMatchCount<br><br>"; 
//   echo "normalMatchCount : $normalMatchCount<br>";
//   echo "waitMatchCount : $waitMatchCount<br><br>";
  
  $displayingRound = 0;
for ($i = 0; $i < $matchCount; $i++) {

  $match = $matchs[$i];
  if ($displayingRound < $match->num_round) {
    $displayingRound++;
    Printf("<br>Round $match->num_round => ", $displayingRound);  
  }
  $displayMatchFormat = "[" . $match->round_id;

    if ($match->next_round_id != "") {
      $displayMatchFormat = $displayMatchFormat . " ($match->next_round_id)"  ;
    }
    $displayMatchFormat = $displayMatchFormat . " <";
  
    if ($match->player_id1 != "" ) {
      $displayMatchFormat = $displayMatchFormat . "$match->player_id1" ;
    }
  
    if ($match->player_id2 != "" ){
      $displayMatchFormat = $displayMatchFormat . ",$match->player_id2" ;
    }
  
    $displayMatchFormat = $displayMatchFormat . " >";
  
    // printf("%s]", $displayMatchFormat);
  }

  
  $chk=mysqli_query($con,"SELECT t_id FROM single_tour WHERE t_id='$_SESSION[tour_id]' ")or die("SQL Error1==>".mysqli_error($con));
	$rows=mysqli_num_rows($chk); 

if($rows>0){
  // echo "<script>alert('มีการจับรอบตัดเชือก TOUNAMENT นี้แล้ว')</script>";
  echo "<script>window.location='index.php?module=tour&action=match&tid=$_SESSION[tour_id]&page=idle&do=6'</script>" ;
}else{
            for ($i = 0; $i < $matchCount; $i++){

              $match = $matchs[$i];
                mysqli_query($con,"INSERT INTO single_tour(t_id,num_round,round_id,player_id1,player_id2,next_round_id,position) VALUES
                      ('$_SESSION[tour_id]',
                      '$match->num_round',
                      '$match->round_id',
                      '$match->player_id1',
                      '$match->player_id2',
                      '$match->next_round_id',
                      '$match->position'

                      )") or die("SQL Error==>".mysqli_error($con));
                      
                      
          }
          // echo "<script>alert('จับคู่รอบตัดเชือกเรียบร้อย')</script>";
          echo "<script>window.location='index.php?module=tour&action=manage_single_tour&tid=$_SESSION[tour_id]&do=1'</script>" ;
}
  
             mysqli_close($con);

  ?>