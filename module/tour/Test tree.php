<?php
// $num=16;
// $i=$num /2;
// $i1=ceil($i/2);
// $i2=ceil($i1/2);
// $i3=ceil($i2/2);
// echo "$num<br>";
// echo "$i<br>";
// echo "$i1<br>";
// echo "$i2<br>";
// echo "$i3<br>";

// $num_player=17;
// $a=0;
//   do{
//       $num_player=ceil($num_player/2);
//       $a++;}
// while($num_player>1);
  
//   echo "$a<br>";
//   echo "$num_player";


//   $l=2;
//   $li=$l**2;
//   echo "$li";
$suits = array (
  "Spades", "Hearts", "Clubs", "Diamonds"
);

$faces = array (
  "Two", "Three", "Four", "Five", "Six", "Seven", "Eight",
  "Nine", "Ten", "Jack", "Queen", "King", "Ace"
);

$deck = array();
 
foreach ($suits as $suit) {
    foreach ($faces as $face) {
        $deck[] = array ("face"=>$face, "suit"=>$suit);
    }
}
shuffle($deck);
 
$card = array_shift($deck);
 
echo $card['face'] . ' of ' . $card['suit'];

?>