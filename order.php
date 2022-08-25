<?php
session_start();
ob_start();    


if($_SESSION["intLine"]==0)
{
	if(isset($_POST["pro_id"]))
	{
         $_SESSION["intLine"] = 1;
         $_SESSION["numProduct"] = 1;
		 $_SESSION["strProID"][0] = $_POST["pro_id"];
		 $_SESSION["strQuantity"][0] = $_POST["quantity"];
        // header("location:shop.php");
         echo "<script>window.location='shop.php'</script>";
	}
}
else
{
   
	
	$key = array_search($_POST["pro_id"], $_SESSION["strProID"]);
	if((string)$key != "")
	{
		 $_SESSION["strQuantity"][$key] = $_SESSION["strQuantity"][$key] + $_POST["quantity"];
	}
	else
	{
		
		 $_SESSION["intLine"] = $_SESSION["intLine"] + 1;
         $_SESSION["numProduct"] = $_SESSION["numProduct"] + 1;
		 $intNewLine = $_SESSION["intLine"];
		 $_SESSION["strProID"][$intNewLine] = $_POST["pro_id"];
		 $_SESSION["strQuantity"][$intNewLine] = $_POST["quantity"];

	}
	
     //header("location:shop.php");
     echo "<script>window.location='shop.php'</script>";

}
?>
