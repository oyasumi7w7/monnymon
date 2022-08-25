<?php
ob_start();
session_start();

  for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
  {
	  if($_SESSION["strProID"][$i] != "")
	  {
			$_SESSION["strQuantity"][$i] = $_POST["quantity".$i];
			
			$_SESSION["ram"][$i] =  $_POST["ram".$i];
			if($_POST["ram".$i] == 1){
				$_SESSION["price_ram".$i] = '1990';
			}else if($_POST["ram".$i] == 2){
				$_SESSION["price_ram".$i] = '3500';
			}else if($_POST["ram".$i] == 3){
				$_SESSION["price_ram".$i] = '6300';
			}else if($_POST["ram".$i] == 4){
				$_SESSION["price_ram".$i] = '11000';
			}else if($_POST["ram".$i] == 'N'){
				$_SESSION["price_ram".$i] = '0';
			}
			
			$_SESSION["disk"][$i] =  $_POST["disk".$i];
			if($_POST["disk".$i] == 1){
				$_SESSION["price_disk".$i] == '1550';
			}else if($_POST["disk".$i] == 2){
				$_SESSION["price_disk".$i] = '1990';
			}else if($_POST["disk".$i] == 3){
				$_SESSION["price_disk".$i] = '2990';
			}else if($_POST["disk".$i] == 4){
				$_SESSION["price_disk".$i] = '4000';
			}else if($_POST["disk".$i] == 'N'){
				$_SESSION["price_disk".$i] = '0';
			}
	  }
  }
	
	header("location:.../.../cart.php");

?>