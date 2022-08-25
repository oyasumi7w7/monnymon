<?php
$result=mysqli_query($con,"SELECT player_id,player_name,player_lastname,day_regis,match1,match2,match3,score1,score2,score3,total_score FROM tour_player WHERE tour_no = $tid ORDER BY player_id ASC ")or die("Sql Error>>".mysqli_error($con));
while(list($p_id,$p_name,$p_lastname,$p_regis,$m1,$m2,$m3,$score1,$score2,$score3,$total_score)=mysqli_fetch_row($result)){
    
}


?>