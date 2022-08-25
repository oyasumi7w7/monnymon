<meta charset="UTF-8">
<?php
    session_start(); 
	include("include/connect_db.php");
	$con=connect_db();

	$detail=mysqli_query($con,"SELECT m_num,m_contract1,m_tel FROM member WHERE m_id='$_SESSION[valid_user]' ")or die("Sql Error1>>".mysqli_error($con));
	list($m_id,$address,$tel)=mysqli_fetch_row($detail); 

	if(empty($address)){
		if(empty($tel)){
			$sqlmember = "UPDATE member SET m_tel='$_POST[phone]' , m_contract1='$_POST[address]' WHERE m_id='$_SESSION[valid_user]' "; mysqli_query($con,$sqlmember) or die("SQL Error==>".mysqli_error($con));
			// $new_address= $_POST['address'];
			// $new_tel=$_POST['phone'];
		}else{
			$sqlmember = "UPDATE member SET m_contract1='$_POST[address]' WHERE m_id='$_SESSION[valid_user]' "; mysqli_query($con,$sqlmember) or die("SQL Error==>".mysqli_error($con));
			// $new_address= $_POST['address'];
			// $new_tel=$tel;
		}

	}else{
		if(empty($tel)){
			$sqlmember = "UPDATE member SET m_tel='$_POST[phone]' WHERE m_id='$_SESSION[valid_user]' "; mysqli_query($con,$sqlmember) or die("SQL Error==>".mysqli_error($con));
			// $new_address= $address;
			// $new_tel=$_POST['phone'];
		// }else{
		// 	$new_address= $address;
		// 	$new_tel=$tel;
		// }
		}
	}

	$strSQL_Order = "SELECT order_id FROM order_shop group by order_id";
	$objQuery_Order = mysqli_query($con,$strSQL_Order)  or die(mysqli_error());
	$row_Order = mysqli_num_rows($objQuery_Order);
	// $maxOrder = $row_Order['maxOrder']+1;
	 $idor = date('Ymd').$row_Order+1;
	
	for ($i = 0; $i <= (int) $_SESSION["intLine"]; $i++) {

		if (!empty($_SESSION["strProID"][$i])) {

			$strSQL = "SELECT * FROM product WHERE product_id = '" . $_SESSION["strProID"][$i] . "' ";
                                $objQuery = mysqli_query($con, $strSQL)  or die(mysqli_error());
                                $objResult = mysqli_fetch_array($objQuery);
			
								$sales = $objResult['product_sales']+$_SESSION["strQuantity"][$i];
								$decress_qty = $objResult['product_num']-$_SESSION["strQuantity"][$i];

								  if ($objResult['product_sprice'] != 0) {
									$price=$objResult["product_sprice"];
								} else {
									$price=$objResult["product_price"];
								}


			$sqlorder = "INSERT INTO order_shop (order_id,order_memberid,order_pid,order_pname,order_price,order_pronum,order_address,order_phone,order_ems,order_paid_status,order_product_status,order_date) 
										 VALUES ('$idor','$m_id','".$_SESSION["strProID"][$i]."','".$objResult["product_name"]."','$price','".$_SESSION["strQuantity"][$i]."','$_POST[address]','$_POST[phone]'
										 ,'$_POST[ems]','1','1',NOW() )";
			$objorder = mysqli_query($con,$sqlorder);	


			$up_qty = "UPDATE product SET product_num = '$decress_qty' , product_sales = '$sales'  WHERE product_id = '" . $_SESSION["strProID"][$i] . "' ";
			mysqli_query($con,$up_qty);

		}


	}


     




        unset($_SESSION["strQuantity"]);	
        unset($_SESSION["strProID"]);
        $_SESSION["intLine"] = 0;
        $_SESSION["numProduct"] = 0;


		echo "<script>window.location='index.php?module=order&action=list_order'</script>" ;
        mysqli_close($con);

?>