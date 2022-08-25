<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();

$qty=0;
    if(empty($_POST['clan'])){
		$clan="";
	}else{
		$clan=$_POST['clan'];
	}
    
    if(empty($_GET['clan'])){
        
    }else{
        $clan=$_GET['clan'];
    }

	if(!empty($clan)){
        $rows = $db_handle->numRows("SELECT card_name FROM card_list WHERE Clan LIKE '$clan' ");
    }else{
        $rows = $db_handle->numRows("SELECT card_name FROM card_list ");
    }

if(!empty($_SESSION["card_set"])){
    foreach ($_SESSION["card_set"] as $item){
$qty+=$item['quantity'];
}


}

    $rows_page=40; 
    
	$pages=ceil($rows/$rows_page); 
	$total_quantity=0;
	if(isset($_GET['pid'])){ 
		$pid=$_GET['pid']; 
		$start_rows=($pid-1)*$rows_page; 
	}
	else{ 
		$pid=1; 
		$start_rows=0; 
	}

    
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$cardByCode = $db_handle->runQuery("SELECT * FROM card_list WHERE card_id='" . $_GET["code"] . "'");
			$deckArray = array($cardByCode[0]["card_id"]=>array('card_name'=>$cardByCode[0]["card_name"], 'card_id'=>$cardByCode[0]["card_id"], 'quantity'=>$_POST["quantity"],  'card_pic'=>$cardByCode[0]["card_pic"]));
			
			if(!empty($_SESSION["card_set"])) {
				if(in_array($cardByCode[0]["card_id"],array_keys($_SESSION["card_set"]))) {
					foreach($_SESSION["card_set"] as $k => $v) {
							if($cardByCode[0]["card_id"] == $k) {
								if(empty($_SESSION["card_set"][$k]["quantity"])) {
									$_SESSION["card_set"][$k]["quantity"] = 0;
								}
								if($_SESSION["card_set"][$k]["quantity"]<4){
									$_SESSION["card_set"][$k]["quantity"] += $_POST["quantity"];
								}	
								// $_SESSION["card_set"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["card_set"] = array_merge($_SESSION["card_set"],$deckArray);
				}
			} else {
				$_SESSION["card_set"] = $deckArray;
			}
		}
	break;
	case "decrease":
		if(!empty($_SESSION["card_set"])) {
			foreach($_SESSION["card_set"] as $k => $v) {
					if($_GET["code"] == $k)
						if($_SESSION["card_set"][$k]["quantity"]>1){
							$_SESSION["card_set"][$k]["quantity"]-=1;
						}else{
							$_SESSION["card_set"][$k]["quantity"]-=0;
						}
			}
		}
	break;
  
   
  
	case "increase":
		if(!empty($_SESSION["card_set"])) {
			foreach($_SESSION["card_set"] as $k => $v) {
				if($_GET["code"] == $k){
                    if($qty<50){
                        if($_SESSION["card_set"][$k]["quantity"]<4){
                            $_SESSION["card_set"][$k]["quantity"]+=1;
                        }else{
                            $_SESSION["card_set"][$k]["quantity"]-=0;
                        }
                    }
			    }
            }
		}
	break;
	case "remove":
		if(!empty($_SESSION["card_set"])) {
			foreach($_SESSION["card_set"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["card_set"][$k]);				
					if(empty($_SESSION["card_set"]))
						unset($_SESSION["card_set"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["card_set"]);
	break;	
} 
}
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once ("include/tag-head.php"); ?>
<link rel="stylesheet" href="css/style2.css" type="text/css">
<style>
  .img-center{
    margin: 0 auto;
    width: 50%;
  }
.deck{
    border-collapse: separate;
    text-indent: initial;
    white-space: normal;
    line-height: normal;
    font-weight: normal;
    font-size: medium;
    font-style: normal;
    
    text-align: start;
    border-spacing: 2px;
    font-variant: normal;
}
/* Parent Container */
.content_img{
 position: relative;


 margin-right: 10px;
}

/* Child Text Container */
.content_img div{
 position: absolute;
 bottom: 0;
 right: 0;
 background: black;
 color: white;
 margin-bottom: 5px;
 font-family: sans-serif;
 opacity: 0;
 visibility: hidden;

}

/* Hover on Parent Container */
.content_img:hover{
 cursor: pointer;
}

.content_img:hover div{
 width: 100%;
 padding: 8px 15px;
 visibility: visible;
 opacity: 65%; 
}

  </style>
  <body>
  
<div class="site-wrap">
        <?php require_once ("include/header.php"); ?>
        
                <div class="bg-light py-3">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 mb-0"><a href="main.php">Home</a> <span class="mx-2 mb-0">/</span> <a href="deck_list.php">DeckBuilding</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">SIM Builder</strong></div>
                        </div>
                    </div>
                </div>
                <div class="jumbotron jumbotron-fluid" style="background-color: #228B22">
                    <div class="container" style="color:#FFF8DC;">
                        <h1 style="font-size: 50px; border-bottom:double; margin-right: 50%;">Monnymon Deck Builder</h1>
                        <p style="font-size: 25px; border-bottom:double ; border-right:double; margin-right: 75%;">จัดเด็ค</p>
                    </div>
                </div>

    <div id="shopping-cart">
            <div class="txt-heading" ><?php echo "<p style='color:#00008B; font-size:50px; border-bottom:double 10px;'>Deck Building</p>"; ?></div>

                                            
                                        <a id="btnEmpty" href="deck_build.php?action=empty">Empty Deck</a>
                                            <?php if(!empty($_SESSION["card_set"])){?>
                                                <a id="btnCheck" href="add_deck_topic_form.php" >ยืนยันการจัด Deck</a><br>
                                            <?php }?>
                                            <!-- href="deck_create.php" -->
                        <?php 
                        // print_r($deckArray);echo"<br><br>";
                        // print_r($_SESSION["card_set"]);echo"<br><br>";
                        // print_r($_SESSION["card_set"][$k]);echo"<br><br>";
                        // print_r($_GET["code"]);echo"<br><br>";
                              

                        if(isset($_SESSION["card_set"])){
                            $total_quantity = 0;
                        ?>	
                        <table class="tbl-cart" cellpadding="10" cellspacing="1">
                        <tbody>
                        <tr class="deck" style="border:double; border-width:10px; ">
                        <th style="text-align:left;">Name</th>
                        <th style="text-align:left;">Code</th>
                        <th style="text-align:center;" width="5%">Quantity</th>
                        <th style="text-align:center;" width="10%">- / +</th>
                        <th style="text-align:center;" width="5%">Remove</th>
                        </tr>	
                        <?php		

                        foreach ($_SESSION["card_set"] as $item){
                        
                            ?>
                                    <tr class="deck" style="border:solid">
                                    <td style="border-right:solid;"><img src="images/card_pic/<?php echo $item["card_pic"]; ?>" class="cart-item-image" /><?php echo $item["card_name"]; ?></td>
                                    <td style="border-right:solid;"><?php echo $item["card_id"]; ?></td>
                                    <td style="text-align:center;border-right:solid;"><?php echo $item["quantity"] . "/ 4"; ?></td>
                                    <td style="text-align:center;border-right:solid;">
                                    <a href="deck_build.php?action=decrease&code=<?php echo $item["card_id"]; ?>&clan=<?php echo $clan ?>" class="btnMinusAction"><img src="images/minus.png" alt="decrease Item" /></a>
                                    <b> | </b>
                                    <a href="deck_build.php?action=increase&code=<?php echo $item["card_id"]; ?>&clan=<?php echo $clan ?>" class="btnPlusAction"><img src="images/plus.png" alt="increase Item" /></a></td>
                                    <td style="text-align:center;"><a href="deck_build.php?action=remove&code=<?php echo $item["card_id"]; ?>" class="btnRemoveAction"><img src="images/icon-delete.png" alt="Remove Item" /></a></td>
                                    </tr>
                                    <?php
                                    $total_quantity += $item["quantity"];
                                    
                            }
                            ?>

                            <tr class="deck" style="border:solid">
                            <td colspan="2" align="right">Total:</td>
                            <td align="right"><?php echo $total_quantity . "/ 50"; ?></td>
                            <td align="right" colspan="2"></td>

                            </tr>
                            </tbody>
                            </table>	<br>	
                                            <?php
                                            } else {
                                            ?>
                                                    <div class="no-records">Empty</div>
                                            <?php 
                                            }
                                            ?>

                    <form method="post" action='deck_build.php' >
                            <select name="clan" class="form-control-select"  style="max-width:30%;">
                                    <option value="" >-- เลือกแคลนของการ์ด --</option>
                                     <?php
                                        
                                        $result = $db_handle->runQuery("SELECT * FROM card_clan ");
                                        foreach($result as $key=>$value){
                                            $c_id=$result[$key]["clan_id"];
                                            $c_name=$result[$key]["clan_name"];
                                            echo"<option value='$c_id' >$c_name</option>";
                                        }
                            echo "</select>";
                                
                                    ?>
                        <input type="submit" value="ค้นหา">
                       
	                </form> 
                    <a href="deck_build.php"><button class="btn btn-success btn-ra">ทั้งหมด</button></a>

                                <?php
                                if($rows==0){
                                    echo "<p align='center'style='color:#00008B; font-size:20px; '>ไม่พบการ์ดที่ตรงกับที่ค้นหา</p>";
                                }else{
                            echo "<p style='text-align : center'> หน้า : ";
                            for($i=1;$i<=$pages;$i++){ //วนลูปตามจำนวนหน้า
                                if($i==$pid){ //ถ้าตรงกับหน้าปัจจุบัน
                                echo "<span style='color:red;font-weight:bold;'> [ $i ] </span>";		
                                }
                                else
                                {
                            echo"<a href='deck_build.php?pid=$i&clan=$clan'>[ $i ]</a>"; //สร้าง link หมายเลขหน้า
                                }
                            }
                            echo "</p><br>";




                                if($total_quantity<50){
                                ?>
                                             <div class="row mb-5">
                                                <?php
                                                if(!empty($clan)){
                                                     $card_array = $db_handle->runQuery("SELECT * FROM card_list WHERE Clan LIKE '$clan' ORDER BY card_id ASC LIMIT $start_rows,$rows_page ");
                                                if (!empty($card_array)) { 
                                                    foreach($card_array as $key=>$value){
                                                        $na=$card_array[$key]["Nation"];
                                                        $nation= $db_handle->runQuery("SELECT nation_name FROM card_nation WHERE nation_id='$na' ");
                                                        $cl=$card_array[$key]["Clan"];
                                                        $clan1= $db_handle->runQuery("SELECT clan_name FROM card_clan WHERE clan_id='$cl' ");
                                                        $ra=$card_array[$key]["card_race"];
                                                        $race= $db_handle->runQuery("SELECT race_name FROM card_race WHERE race_id='$ra' ");
                                                        ?>
                                                     <div class="col-sm-6 col-lg-3 mb-4" data-aos="fade-up">
                                                        <div class="block-4 text-center ">
                                                            <div class="content_img">
                                                            
                                                                <form method="post"  action="deck_build.php?action=add&code=<?php echo $card_array[$key]["card_id"]; ?>&clan=<?php echo $clan ?>">
                                                                    <input type="image" style="width : 100%; " src="images/card_pic/<?php echo $card_array[$key]["card_pic"]; ?>" alt="Submit" >
                                                                    <input type="hidden" class="product-quantity" name="quantity" value="1" size="2" />
                                                                </form>
                                                                    <div>
                                                                        <?php echo $card_array[$key]["card_name"] ?><br>
                                                                    
                                                                        <p>Nation : <?php echo $nation[0]['nation_name']?> || Clan : <?php echo $clan1[0]['clan_name']?> </p>
                                                                        <p>Race : <?php echo $race[0]['race_name']?> </p> <p>Effect : <?php echo $card_array[$key]["Card_Effect"]?></p>
                                                                        
                                                                    </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                            <?php
                                                                    }
                                                                } 
                                                
                                                            ?>
                                                </div>
                                                <?php
                                                }else{
                                                     $card_array = $db_handle->runQuery("SELECT * FROM card_list ORDER BY card_id ASC LIMIT $start_rows,$rows_page ");
                                                if (!empty($card_array)) { 
                                                    foreach($card_array as $key=>$value){
                                                        $na=$card_array[$key]["Nation"];
                                                        $nation= $db_handle->runQuery("SELECT nation_name FROM card_nation WHERE nation_id='$na' ");
                                                        $cl=$card_array[$key]["Clan"];
                                                        $clan1= $db_handle->runQuery("SELECT clan_name FROM card_clan WHERE clan_id='$cl' ");
                                                        $ra=$card_array[$key]["card_race"];
                                                        $race= $db_handle->runQuery("SELECT race_name FROM card_race WHERE race_id='$ra' ");
                                                    ?>
                                                    <div class="col-sm-6 col-lg-3 mb-4" data-aos="fade-up">
                                                        <div class="block-4 text-center ">
                                                            <div class="content_img">
                                                            
                                                                <form method="post"  action="deck_build.php?action=add&code=<?php echo $card_array[$key]["card_id"]; ?>">
                                                                    <input type="image" style="width : 100%; " src="images/card_pic/<?php echo $card_array[$key]["card_pic"]; ?>" alt="Submit" >
                                                                    <input type="hidden" class="product-quantity" name="quantity" value="1" size="2" />
                                                                </form>
                                                                    <div>
                                                                        <?php echo $card_array[$key]["card_name"] ?><br>
                                                                    
                                                                        <p>Nation : <?php echo $nation[0]['nation_name']?> || Clan : <?php echo $clan1[0]['clan_name']?> </p>
                                                                        <p>Race : <?php echo $race[0]['race_name']?> </p> <p>Effect : <?php echo $card_array[$key]["Card_Effect"]?></p>
                                                                        
                                                                    </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                            <?php
                                                                    }
                                                                } 
                                                
                                                            ?>
                                                </div>
                                                <?php
                                                    
                                                }
                                               
		                                                
                                                        
                                                
                                                

                                            }else{
                                ?>

                                <div class="row mb-5">
                                                <?php
                                                 if(!empty($clan)){
                                                $card_array = $db_handle->runQuery("SELECT * FROM card_list WHERE Clan LIKE '$clan' ORDER BY card_id ASC LIMIT $start_rows,$rows_page ");
                                                if (!empty($card_array)) { 
                                                    foreach($card_array as $key=>$value){
                                                        $na=$card_array[$key]["Nation"];
                                                        $nation= $db_handle->runQuery("SELECT nation_name FROM card_nation WHERE nation_id='$na' ");
                                                        $cl=$card_array[$key]["Clan"];
                                                        $clan1= $db_handle->runQuery("SELECT clan_name FROM card_clan WHERE clan_id='$cl' ");
                                                        $ra=$card_array[$key]["card_race"];
                                                        $race= $db_handle->runQuery("SELECT race_name FROM card_race WHERE race_id='$ra' ");
                                                ?>
                                                        <div class="col-sm-6 col-lg-3 mb-4" data-aos="fade-up">
                                                            <div class="block-4 text-center ">
                                                                <div class="content_img">
                                                            
                                                                    <img style="width : 100%" src="images/card_pic/<?php echo $card_array[$key]["card_pic"]; ?>">
                                                                    <div>
                                                                        <?php echo $card_array[$key]["card_name"] ?><br>
                                                                        
                                                                        <p>Nation : <?php echo $nation[0]['nation_name']?> || Clan : <?php echo $clan1[0]['clan_name']?> </p>
                                                                        <p>Race : <?php echo $race[0]['race_name']?> </p> <p>Effect : <?php echo $card_array[$key]["Card_Effect"]?></p>
                                                                        <!-- <p>Race : <?php echo $race[0]['race_name']?>  </p> -->
                                                                        </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                <?php
                                                    }
                                                } 
                                    
                                                ?>
                                </div>
                                <?php
                                }else{
                                    $card_array = $db_handle->runQuery("SELECT * FROM card_list WHERE Clan  ORDER BY card_id ASC LIMIT $start_rows,$rows_page ");
                                                if (!empty($card_array)) { 
                                                    foreach($card_array as $key=>$value){
                                                        $na=$card_array[$key]["Nation"];
                                                        $nation= $db_handle->runQuery("SELECT nation_name FROM card_nation WHERE nation_id='$na' ");
                                                        $cl=$card_array[$key]["Clan"];
                                                        $clan1= $db_handle->runQuery("SELECT clan_name FROM card_clan WHERE clan_id='$cl' ");
                                                        $ra=$card_array[$key]["card_race"];
                                                        $race= $db_handle->runQuery("SELECT race_name FROM card_race WHERE race_id='$ra' ");
                                                ?>
                                                        <div class="col-sm-6 col-lg-3 mb-4" data-aos="fade-up">
                                                            <div class="block-4 text-center ">
                                                                <div class="content_img">
                                                            
                                                                    <img style="width : 100%" src="images/card_pic/<?php echo $card_array[$key]["card_pic"]; ?>">
                                                                    <div>
                                                                        <?php echo $card_array[$key]["card_name"] ?><br>
                                                                        
                                                                        <p>Nation : <?php echo $nation[0]['nation_name']?> || Clan : <?php echo $clan1[0]['clan_name']?> </p>
                                                                        <p>Race : <?php echo $race[0]['race_name']?> </p> <p>Effect : <?php echo $card_array[$key]["Card_Effect"]?></p>
                                                                        <!-- <p>Race : <?php echo $race[0]['race_name']?>  </p> -->
                                                                        </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                <?php
                                                    }
                                                } 
                                    
                                                ?>
                                </div>

                                    <?php
                                }   
                            }
                                ?>
                                
                            
                        

                            <?php
                            echo "<p style='text-align : center'> หน้า : ";
                            for($i=1;$i<=$pages;$i++){ //วนลูปตามจำนวนหน้า
                                if($i==$pid){ //ถ้าตรงกับหน้าปัจจุบัน
                                echo "<span style='color:red;font-weight:bold;'> [ $i ] </span>";		
                                }
                                else
                                {
                            echo"<a href='deck_build.php?pid=$i&clan=$clan'>[ $i ]</a>"; //สร้าง link หมายเลขหน้า
                                }
                            }
                            echo "</p><br>";
                            }?>
    </div>




                <?php require_once ("include/footer.php"); 
                ?>
</div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/main2.js"></script>
  
  <script>
    document.addEventListener("DOMContentLoaded", function (event) {
        var scrollpos = sessionStorage.getItem('scrollpos');
        if (scrollpos) {
            window.scrollTo(0, scrollpos);
            sessionStorage.removeItem('scrollpos');
        }
    });

    window.addEventListener("beforeunload", function (e) {
        sessionStorage.setItem('scrollpos', window.scrollY);
    });
</script>

  <script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";  
  }
  x[slideIndex-1].style.display = "block";  
}
</script>

  
  </body>
</html>
