
<?php
session_start();
if(empty($_SESSION['numProduct'])){
$_SESSION['numProduct']=0;
}

include("include/connect_db.php");
$con=connect_db();
// if (empty($_SESSION['intLine'])) {
//   $_SESSION['intLine']='0';
// }

?>
<!DOCTYPE html>
<html lang="en">
<?php require_once ("include/tag-head.php"); ?>
  <!-- <head>
    <title>Shoppers &mdash; Colorlib e-Commerce Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700"> 
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/themify-icons.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/login.css" type="text/css"> 
</head> -->
<style>
  .img-center{
    margin: 0 auto;
    width: 50%;
  }

  </style>
  <body>
  
<div class="site-wrap">
  <?php require_once ("include/header.php"); ?>
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="main.php">Home</a> <span class="mx-2 mb-0">/</span> <a href="idle_tour.php">Tournament</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">How to Play </strong></div>
            </div>
        </div>
    </div>


    <div class='site-section'>
        <div class='container'>
            <div class='row'>
                <div class='col-md-12 text-center' >
                    <p style="color:red; font-size:50px;">How to Play (วิธีการเล่น กฎกติกา)<p>

                        <p style="color:black; font-size:20px; text-align: justify; text-indent: 50px;">ผู้เล่นจะต้องเลือกการ์ดยูนิตเกรด 0 จากในเด็คของตนเอง และวางลงบนพื้นที่ แวนการ์ด เซอร์เคิล ในรูปแบบคว่ำหน้าไว้ 
                        จากนั้นสับเด็คและเลือกว่าใครจะเริ่มเล่นก่อน แล้วจึงจั่วการ์ดขึ้นมาบนมือ 5 ใบ หากผู้เล่นไม่พอใจการ์ดที่จั่วขึ้นมา สามารถเลือกเปลี่ยนได้กี่ใบก็ได้ 1 ครั้ง โดยเลือกการ์ดที่ไม่พอใจกลับเข้ากองการ์ดและสับเด็ค จากนั้นจั่วการ์ดกลับขึ้นมาตามจำนวนที่นำเข้าเด็คกลับลงไป
                        เสร็จแล้วจึงเริ่มเล่นและเปิดการ์ดที่อยู่ในตำแหน่ง แวนการ์ด เซอร์เคิล ของเรา การเอาชนะในเกมการ์ดไฟท์ แวนการ์ด คือ คุณจะต้องสร้างความเสียหาย หรือ ดาเมจ ให้กับแวนการ์ดของอีกฝ่าย 6 ดาเมจ 
                        ซึ่งดาเมจของแวนการ์ดจะแสดงโดยใช้การ์ดใบบนสุดจากเด็คทิ้งลงบนพื้นที่ดาเมจโซน แทนจำนวนดาเมจของผู้เล่น หากผู้เล่นฝ่ายใดมีการ์ดในดาเมจโซน 6 ใบหรือมากกว่า ผู้เล่นคนนั้นจะถือว่าแพ้ในทันที หรือ 
                        หากผู้เล่นฝ่ายใดมีการ์ดในเด็คเท่ากับ 0 ผู้เล่นคนนั้นก็จะถือว่าแพ้เช่นกัน</p>

                        <img src="images/Shadow-Paladin-Deck-December-15-2018.jpg" style="width:500px;height:500px;">

                    <p style="color:red; font-size:50px;">การจัดเด็ค<p>
 

                        <p style="color:black; font-size:20px; text-align: justify; text-indent: 50px;">
                        - ในหนึ่งเด็คจำเป็นต้องมีการ์ดทั้งหมด 50 ใบพอดีเป๊ะ! ห้ามขาด ห้ามเกิน (จำนวนดังกล่าว รวมแวนการ์ดตัวแรกแล้วเรียบร้อย)</p>
                        <p style="color:black; font-size:20px; text-align: justify; text-indent: 50px;">
                        - ในหนึ่งเด็คไม่สามารถใส่การ์ดที่มีชื่อซ้ำกันมากเกินกว่า 4 ใบ อย่างเด็ดขาด (ถึงแม้ว่าภาพในการ์ดหรือความสามารถจะต่างกันก็ตาม)</p>
                        <p style="color:black; font-size:20px; text-align: justify; text-indent: 50px;">
                        - ในหนึ่งเด็คจำเป็นต้องมีทริกเกอร์ 16 ใบ ห้ามขาด ห้ามเกิน</p>
                        <p style="color:black; font-size:20px; text-align: justify; text-indent: 50px;">
                        - ในหนึ่งเด็คสามารถใส่การ์ดที่มี Heal Trigger(ฮีลทริกเกอร์) ได้ไม่เกิน 4 ใบ</p>
                        <p style="color:black; font-size:20px; text-align: justify; text-indent: 50px;">
                        - ในหนึ่งเด็คสามารถใส่การ์ดที่มีความสามารถ Sentinel (พิทักษ์) ได้ไม่เกิน 4 ใบ</p>
                        <p style="color:black; font-size:20px; text-align: justify; text-indent: 50px;">
                        - ใน “แฟลชเด็ค” มีการ์ดได้แค่ 25 ใบ และจะเล่น “Flash Fight” ในกฎ “Flash Fight Rules” เท่านั้น กฎจะแตกต่างกับการเล่นปกติดังนี้</p>
                        <p style="color:black; font-size:20px; text-align: justify; text-indent: 50px;">
                        *1) คุณชนะเกมโดยการทำให้อีกฝ่ายมี 4 ดาเมจ ไม่ใช่ 6</p>
                        <p style="color:black; font-size:20px; text-align: justify; text-indent: 50px;">
                        *2) ฮีลทริกเกอร์ สามารถใส่ได้ไม่เกิน 2 ใบในเด็ค</p>
                        <p style="color:black; font-size:20px; text-align: justify; text-indent: 50px;">
                        - ในเด็คจะอยู่ภายใต้กฎ “Clan Fight” ซึ่งจำเป็นต้องใส่การ์ดที่อยู่ในแคลนเดียวกันทั้งหมด</p>
                        <p style="color:black; font-size:20px; text-align: justify; text-indent: 50px;">
                        * การ์ดที่ระบุว่าเป็นมากกว่า 1 แคลน (ยกตัวอย่าง บลาสเตอร์ เบลด สปิริต) สามารถใส่เข้าไปในเด็คแคลนใดแคลนหนึ่งของทั้งสองแคลนนั้นได้</p>

                        <p style="color:black; font-size:20px; text-align: justify; text-indent: 50px;">
                        * มีกฎพิเศษแยกออกมาสำหรับแคลนที่จำเป็นต้องใช้การ์ดมากกว่า 1 แคลนในการใช้สกิล : เด็ค Royal Paladin สามารถใส่การ์ด Shadow Paladin ได้ไม่เกิน 10 ใบ 
                        และ เด็ค Link Joker สามารถใส่การ์ดจากแคลนไหนก็ได้ จำนวนกี่ใบก็ได้ ตราบเท่าที่การ์ดจากแคลนอื่น ๆ เหล่านั้นติดชื่อ “Я”</p>

                    <p style="color:red; font-size:50px;">สนามการเล่น (Play Map)<p>

                        <img src="images/Cardfight-Vanguard-4.jpg" style="width:500px;height:200px;"><br>
                        <p style="color:black; font-size:20px; text-align: justify; text-indent: 50px;">
                        การวางการ์ดของ Cardfight! Vanguard จะมีพื้นที่การวางการ์ดในการเล่นทั้งหมด 7 ตำแหน่ง ได้แก่ เจเนอร์เรชั่นโซน ในโซนนี้ ผู้เล่นจะสามารถวางการ์ดที่เป็นเจเนอร์เรชั่นยูนิตแบบคว่ำหน้าไว้ได้ไม่เกิน 8 ใบ 
                        เอาไว้สำหรับทำการสไตรด์ หรือการช่วยเหลือเกรด โดยสนามหลักของผู้เล่นแต่ละคนจะมีสองแถว แถวละสามช่อง แถวที่อยู่ใกล้ผู้เล่นอีกฝ่าย เรียกว่าแถวหน้า และอีกแถวหนึ่งเรียกว่าแถวหลัง แวนการ์ดเซอร์เคิล
                         คือช่องตรงกลางในแถวหน้า สามารถมีการ์ดวางในช่องนั้นได้มากกว่าหนึ่งใบ การ์ดใบบนสุดของแวนการ์ดเซอร์เคิล คือ แวนการ์ดของคุณการ์ดอื่น ๆ ข้างใต้นั้น เรียกว่าโซล แวนการ์ดของคุณไม่ใช่ส่วนหนึ่งของโซล 
                         ถ้ามีการ์ดเพียงใบเดียวบนแวนการ์ดเซอร์เคิล การ์ดนั้น คือ แวนการ์ดของคุณ และคุณไม่มีโซลเลยแม้แต่ใบเดียว อีกห้าช่องที่เหลือเรียกว่า เรียร์การ์ดเซอร์เคิล ช่องเหล่านั้นจะมีการ์ดวางอยู่ได้เพียงใบเดียวต่อช่องเท่านั้น</p>

 

                         <p style="color:black; font-size:20px; text-align: justify; text-indent: 50px;">1.Vanguard Zone (แวนการ์ด โซน)  ==> แวนการ์ด โซน เป็นโซนที่ผู้เล่นจะต้องเลือกการ์ดยูนิตเกรด 0 จากในเด็คของตนเอง 
                         วางคว่ำหน้าไว้ตั้งแต่ก่อนเริ่มเกม</p>
                         <p style="color:black; font-size:20px; text-align: justify; text-indent: 50px;">2.Rear-Guard Zone (เรียร์การ์ด โซน)  ==> เรียร์การ์ด โซน เป็นโซนที่ผู้เล่นสามารถเลือกการ์ดยูนิตเกรดต่าง ๆ 
                         มาวางเพื่อใช้ในการต่อสู้กับผู้เล่นฝ่ายตรงข้ามได้</p>
                         <p style="color:black; font-size:20px; text-align: justify; text-indent: 50px;">3.Guardian Zone (การ์เดี้ยนโซน)  ==> การ์เดี้ยนโซน เป็นโซนที่การ์ดจะถูกวางลงในช่วงการปะทะกัน โดยทั่วไปจะอยู่ด้านหน้าของแถวหน้า 
                         การ์ดเหล่านี้จะมีผลขณะการต่อสู้ และถูกรีไทร์ไปยังดรอปโซนหลังจากนั้น คุณสามารถกาด(Guard/ป้องกัน)ได้โดยใช้ยูนิตที่มีเกรดเท่ากับหรือต่ำกว่าแวนการ์ดของคุณเท่านั้น</p>
                         <p style="color:black; font-size:20px; text-align: justify; text-indent: 50px;">4.Damage Zone (ดาเมจ โซน)  ==> ดาเมจ โซน เป็นโซนที่รวมการ์ดที่ใช้งานไม่ได้ แต่จะต้องอยู่คนละกองกับดรอปโซน 
                         การ์ดในดาเมจโซนแสดงถึงดาเมจของแวนการ์ดของคุณ หากคุณมีการ์ดในดาเมจโซนของคุณ 6 ใบหรือมากกว่า คุณแพ้เกมนั้น</p>
                         <p style="color:black; font-size:20px; text-align: justify; text-indent: 50px;">5.Drop Zone (ดรอบ โซน)  ==> ดรอบ โซน เป็นโซนที่ทิ้งการ์ดใช้งานแล้ว จะต้องแยกไว้อีกกองหนึ่งจากเด็ค เมื่อคุณรีไทร์การ์ดใบใดใบหนึ่ง 
                         คุณย้ายการ์ดนั้นไปที่ดรอปโซน เมื่อคุณฮีลดาเมจ คุณย้ายการ์ดนั้นจากดาเมจโซนไปยังดรอปโซน</p>
                         <p style="color:black; font-size:20px; text-align: justify; text-indent: 50px;">6.Deck Zone (เด็ค โซน)  ==>เด็ค โซน เป็นโซนที่อยู่ด้านขวาของสนาม เมื่อคุณจั่วการ์ด คุณจะต้องหยิบการ์ดใบบนสุดของเด็คไปไว้บนมือคุณ 
                         หากการ์ดในเด็คของคุณเท่ากับ 0 เมื่อไร คุณจะแพ้เกมทันที</p>
                         <p style="color:black; font-size:20px; text-align: justify; text-indent: 50px;">7.Trigger Zone (ทริกเกอร์ โซน)  ==> ทริกเกอร์ โซน เป็นโซนที่การ์ดจะถูกวางลงเมื่อความสามารถของมันกำลังจะแสดงผล 
                         มันจะอยู่ตรงไหนนั้นไม่สำคัญ หากคุณกำลังทำการไดร์ฟเช็ค คุณย้ายการ์ดจากใบบนสุดของเด็คไปยังทริกเกอร์โซน และย้ายการ์ดนั้นไปยังมือของคุณหลังจากนั้น หากคุณกำลังดาเมจเช็ค คุณย้ายการ์ดจากใบบนสุดของเด็คไปยังทริกเกอร์โซน 
                         และจากนั้นย้ายการ์ดนั้นไปยังดาเมจโซน</p>
                         
                         
                    <p style="color:red; font-size:50px;">ลำดับต่าง ๆ ในเทิร์นการเล่น<p>  
                         <p style="color:black; font-size:30px;">[ I ] แสตนเฟส</p> 
                         <p style="color:black; font-size:20px; text-align: center; text-indent: 50px;">ยูนิตของคุณที่เรสอยู่ จะกลับมาเป็นสถานะแสตน (เว้นเสียแต่ว่าจะถูกผลของการ์ดใดๆห้ามเอาไว้)</p>
                         <img src="images/Cardfight-Vanguard-5.jpg" style="width:500px;height:200px;"><br>
                         <p style="color:black; font-size:30px;">[ II ] ดรอว์เฟส</p>
                         <p style="color:black; font-size:20px; text-align: center; text-indent: 50px;">จั่วการ์ดจากเด็ค 1 ใบ หากคุณทำไม่ได้เนื่องจากไม่มีการ์ดในเด็ค คุณแพ้</p>
                         <p style="color:black; font-size:30px;">[ III ]ไรด์เฟส</p>
                         <p style="color:black; font-size:20px; text-align: center;text-align: justify; text-indent: 50px;">สามารถนำการ์ดบนมือของคุณวางทับลงไปบนแวนการ์ด แวนการ์ดที่ถูกทับจะกลายเป็นโซล ยูนิตที่วางทับลงไปจะต้องเป็นเกรดเดียวกัน 
                         หรือสูงกว่าไม่เกิน 1 ของเกรดแวนการ์ดปัจจุบันของคุณ คุณทำการไรด์ได้แค่ 1 ครั้งต่อเทิร์น คุณเลือกที่จะไม่ไรด์ได้ การไรด์ไม่ได้ช่วยฮีลดาเมจจากแวนการ์ดของคุณใด ๆ ทั้งสิ้น(การ์ดบางใบอนุญาตให้คุณซูพีเรียร์ไรด์ สามารถพบเจอการซูพีเรียร์ไรด์ได้ใน 2 
                         กรณี : ยูนิตบางชนิดจะสามารถให้คุณไรด์ยูนิตจากมือ เด็ค หรือดรอปโซน ยกตัวอย่างเช่นสกิลของนักรบผู้มาจากอนาคต ริว หรือยูนิตที่มีความสามารถในการไรด์ตัวเองลงบนแวนการ์ดถ้าหากเงื่อนไขทั้งหมดครบ
                         เช่น มังกรชั่วร้ายผู้บ้าบิ่น ยักชาร์ และ สปิริต เอ็กซีด การซูพีเรียร์ไรด์สามารถไรด์ได้ทุกยูนิต ยกเว้นเสียแต่ว่าจะถูกกำหนดไว้ โดยจะไม่สนใจเกรด หรืออะไรทั้งสิ้น ซูพีเรียร์ไรด์สามารถทำได้มากกว่า 1 ครั้งต่อเทิร์น
                          และการ์ไรด์ธรรมดาไม่ได้ยับยั้งการซูพีเรียร์ไรด์ ทั้งสองอย่างไม่ได้มีอะไรเกี่ยวข้องกันเลย หากการซูพีเรียร์ไรด์ถูกกระทำเมื่อเริ่มต้นไรด์เฟส 
                         การไรด์ธรรมดาจะสามารถทำต่อเนื่องจากการซูพีเรียร์ไรด์นั้นได้ทันที เว้นเสียแต่ว่าจะถูกบางอย่างห้ามไว้)</p>
                         <p style="color:black; font-size:30px;">[ IV ] เมนเฟส</p>
                         <p style="color:red; font-size:20px; text-align: center; text-indent: 50px;">*คอล</p> 
                         <p style="color:black; font-size:20px; text-align: center;text-align: justify; text-indent: 50px;">วางยูนิตที่มีเกรดเท่ากับ หรือน้อยกว่าแวนการ์ดของคุณลงบนเรียร์การ์ดเซอร์เคิล คุณจะคอลกี่ครั้งก็ได้ต่อเทิร์น 
                         เว้นเสียแต่ว่าการ์ดจะระบุไว้ คุณสามารถคอลเรียร์การ์ดทับเรียร์การ์ดใบอื่นได้ แต่ถ้าคุณทำ คุณจะต้องรีไทร์เรียร์การ์ดที่ถูกทับ หรือก็คือย้ายมันไปดรอปโซน (การ์ดบางใบอนุญาตให้คุณซูพีเรียร์คอล ซึ่งจะเป็นความสามารถของยูนิตหนึ่งในการเลือกยูนิตตัวอื่นจากที่ไหนก็ได้ 
                         และคอลยูนิตนั้น ยกตัวอย่าง บาร์คกัล จากเด็ค และ กัปตันไนท์มิสท์ จากดรอปโซน คุณสามารถซูพีเรียร์คอลยูนิตที่เกรดสูงกว่าแวนการ์ดของคุณ)</p>
                         <p style="color:red; font-size:20px; text-align: center; text-indent: 50px;">*ลด/เพิ่มระดับ</p> 
                         <p style="color:black; font-size:20px; text-align: center;text-align: justify; text-indent: 50px;">คุณสามารถเคลื่อนย้าย/ขยับ/แลกตำแหน่งยูนิต 2 ตัวที่อยู่ในคอลัมน์เดียวกันจากแถวหน้าไปยังแถวหลัง 
                         หรือแถวหลังไปยังแถวหน้าได้ ยูนิตไม่สามารถเคลื่อนย้ายข้ามคอลัมน์ได้ และไม่สามารถขยับเข้าออกแวนการ์ดเซอร์เคิลได้ ดังนั้นยูนิตที่อยู่ด้านหลังแวนการ์ดไม่สามารถขยับได้เลย 
                         สามารถสลับตำแหน่งระหว่างเรียร์การ์ด 2 ตัวในแถวหน้าและแถวหลังในคอลัมน์เดียวกันได้</p>
                         <p style="color:red; font-size:20px; text-align: center; text-indent: 50px;">*สั่งใช้งานผลของการ์ด</p> 
                         <p style="color:black; font-size:20px; text-align: center;text-align: justify; text-indent: 50px;">สกิลของการ์ดที่สามารถใช้งานได้ในเมนเฟส สามารถสั่งใช้งานได้ในจุดนี้</p>
                         <p style="color:red; font-size:20px; text-align: center; text-indent: 50px;">*ประกาศจบเมนเฟส</p> 
                         <p style="color:black; font-size:20px; text-align: center;text-align: justify; text-indent: 50px;">เมื่อคุณพอใจกับการกระทำในเมนเฟสของคุณแล้ว สามารถประกาศจบเมนเฟส และเริ่มแบทเทิลเฟสได้</p>

                         <p style="color:black; font-size:30px;">[ V ] แบทเทิลเฟส</p>
                         <p style="color:black; font-size:20px; text-align: center;text-align: justify; text-indent: 50px;">ในแบทเทิลเฟส คุณสามารถสั่งโจมตีกี่ครั้งก็ได้ตราบเท่าที่ยังมียูนิตที่โจมตีได้อยู่ เมื่อแบทเทิลเฟสเริ่ม คุณจะย้อนกลับไปเมนเฟสไม่ได้ 
                         และไม่สามารถทำการกระทำในเมนเฟสได้ ดังนั้นคุณจะโจมตีแล้วขยับยูนิตลงแถวหลังไม่ได้</p>

                                <img src="images/Cardfight-Vanguard-7.jpg" style="width:500px;height:300px;"><br>
                         <p style="color:red; font-size:20px; text-align: center; text-indent: 50px;">*โจมตี</p> 
                         <p style="color:black; font-size:20px; text-align: center;text-align: justify; text-indent: 50px;"> หากต้องการจะประกาศโจมตี ให้เลือกยูนิตแถวหน้าที่จะสั่งโจมตี และเรสยูนิตนั้น 
                         จากนั้นประกาศชื่อยูนิตแถวหน้าของผู้เล่นอีกฝ่าย เพื่อโจมตีการ์ดนั้น (ยกเว้นว่าการ์ดจะระบุเป้าหมายโจมตีเฉพาะ)</p>
                         <p style="color:red; font-size:20px; text-align: center; text-indent: 50px;">*บูส</p> 
                         <p style="color:black; font-size:20px; text-align: center;text-align: justify; text-indent: 50px;">  หากคุณมีการ์ดที่แสตนอยู่ในแถวหลังด้านหลังตรง ๆ ยูนิตที่คุณสั่งโจมตี และยูนิตนั้นมีสัญลักษณ์ “บูส” คุณสามารถเรสยูนิตนั้น
                          และจนกว่าจะจบการต่อสู้ ยูนิตที่โจมตีจะได้รับพลังเพิ่มตามพลังของยูนิตที่บูส (หากยูนิตที่บูสถูกเคลื่อนย้ายก่อนจบการต่อสู้ คุณจะสูญเสียบูสนั้น) (หากยูนิตที่บูสได้รับพลังเพิ่มระหว่างการต่อสู้นั้น ยูนิตแถวหน้าที่โจมตีอยู่จะได้รับพลังเพิ่มตามนั้นเช่นกัน)</p>
  
                                      <img src="images/Cardfight-Vanguard-8.jpg" style="width:500px;height:200px;"><br>

                         <p style="color:red; font-size:20px; text-align: center; text-indent: 50px;">*การ์เดี้ยนคอล</p> 
                         <p style="color:black; font-size:20px; text-align: center;text-align: justify; text-indent: 50px;"> ผู้เล่นอีกฝ่ายสามารถคอลการ์เดี้ยนจากมือของเขาเพื่อปกป้องยูนิตที่ถูกโจมตี ผู้เล่นอีกฝ่ายสามารถคอลการ์เดี้ยนกี่ตัวก็ได้ 
                         และนำชิลด์ของยูนิตที่คอลมาบวกพลังของยูนิตที่กำลังถูกโจมตี ค่าชิลด์จะมองเห็นได้ในกรอบสีเหลืองหรือสีดำทางด้านซ้ายของการ์ด ยูนิตบางตัวจะไม่มีชิลด์ ให้ถือว่ามีชิลด์เป็น 0 การ์เดี้ยนจะต้องมีเกรดเท่ากับ หรือต่ำกว่าแวนการ์ดของผู้ที่คอล 
                         การ์เดี้ยนที่ถูกคอลจะถูกวางลงบนการ์เดี้ยนเซอร์เคิลในสภาพเรสจนกว่าจะจบการต่อสู้ เมื่อจบการต่อสู้ การ์เดี้ยนจะถูกส่งลงดรอปโซน ผู้เล่นอีกฝ่ายสามารถ’อินเทอร์เซ็ป ได้เช่นกัน (ความสามารถเฉพาะของเกรด 2) 
                         หากคุณมียูนิตบนเรียร์การ์ดเซอร์เคิลแถวหน้าที่สามารถอินเทอร์เซ็ปได้ คุณสามารถย้ายการ์ดนั้นไปยังการ์เดี้ยนเซอร์เคิล และนำชิลด์ของตัวนั้นมาคิดคำนวณในการต่อสู้ด้วย และยูนิตนั้นจะถูกรีไทร์เมื่อจบการต่อสู้เช่นเดียวกับการ์เดี้ยนตัวอื่น 
                         แม้ยูนิตจะเรสอยู่ก็สามารถอินเทอร์เซ็ปได้ แวนการ์ดไม่สามารถทำการอินเทอร์เซ็ปได้</p>
                                      
                                        <img src="images/Cardfight-Vanguard-30.jpg" style="width:200px;height:200px;"><br>
                         <p style="color:red; font-size:20px; text-align: center; text-indent: 50px;">*ไดร์ฟเช็ค</p> 
                         <p style="color:black; font-size:20px; text-align: center;text-align: justify; text-indent: 50px;">  หลังจากการทำการ์เดี้ยนคอล หากคุณโจมตีด้วยแวนการ์ด คุณจะทำการไดร์ฟเช็ค 
                         แสดงการ์ดใบบนสุดของเด็คให้ผู้เล่นทั้งหมดดู และวางมันลงบนทริกเกอร์โซน หากยูนิตที่แสดงเป็นทริกเกอร์ยูนิต และมีแคลนซ้ำกับยูนิตตัวใดตัวหนึ่งบนแวนการ์ดหรือเรียร์การ์ดของคุณ ให้ถือว่าทริกเกอร์นั้นทำงาน ถึงแม้ว่ายูนิตที่แสดงเป็นทริกเกอร์หรือไม่ 
                         หลังจากที่ทริกเกอร์แสดงผลแล้ว ให้นำการ์ดนั้นขึ้นมือคุณ หากแวนการ์ดของคุณมีความสามารถทวินไดร์ฟ คุณจะสามารถไดร์ฟเช็คได้ 2 ครั้ง หากการเช็คครั้งแรกมีทริกเกอร์ จะต้องสั่งใช้งานผลของทริกเกอร์นั้นทั้งหมด ก่อนที่จะทำการเช็คอีกใบ 
                         ยกตัวอย่างเช่นเมื่อดรอว์ทริกเกอร์ทำงาน ผู้เล่นจั่วการ์ด 1 ใบ และให้พลังแก่ยูนิตตัวหนึ่งของเขา จากนั้นจึงเช็คใบที่สอง ความสามารถทวินไดร์ฟไม่มีประโยชน์สำหรับยูนิตที่ไม่ใช่แวนการ์ด</p>

                         <p style="color:red; font-size:20px; text-align: center; text-indent: 50px;">*ผลการต่อสู้</p> 
                         <p style="color:black; font-size:20px; text-align: center;text-align: justify; text-indent: 50px;">  การค้นหาผู้ชนะในการต่อสู้ครั้งนั้น ให้ดูพลังรวมของยูนิตทั้งสองตัว 
                         ถ้าพลังของยูนิตที่กำลังโจมตีอยู่น้อยกว่าพลังของยูนิตที่ถูกโจมตี การโจมตีครั้งนั้นถือว่าไม่ประสบความสำเร็จ หากการโจมตีไม่เป็นผล จะไม่มีอะไรเกิดขึ้นทั้งนั้น หากพลังของยูนิตที่กำลังโจมตีมีค่าเท่ากับ หรือมากกว่าพลังของตัวที่ถูกโจมตี 
                         ถือว่าการโจมตีนั้นสำเร็จ หากยูนิตที่ถูกโจมตีเป็นเรียร์การ์ด รีไทร์ยูนิตนั้นและส่งไปยังดรอปโซน จากนั้นการต่อสู้ถือเป็นที่สิ้นสุด ค่าคริติคัลของผู้โจมตีจะไม่มีผลใด ๆ ถ้าเป้าหมายเป็นเรียร์การ์ด หากการโจมตีประสบความสำเร็จและเป้าหมายเป็นแวนการ์ด 
                         ผู้ที่ถูกโจมตีจะต้องทำการดาเมจเช็คตามจำนวนคริติคัลของยูนิตที่โจมตี ในการดาเมจเช็ค จะต้องย้ายการ์ดใบบนสุดของเด็คไปยังทริกเกอร์โซน หากการ์ดนั้นเป็นทริกเกอร์ จะมีผลให้ทำงานได้เหมือนกับตอนไดร์ฟเช็คทุกประการ 
                         หลังจากที่ทริกเกอร์ทั้งหมดแสดงผลเรียบร้อยแล้ว การ์ดใบนั้นจะถูกย้ายต่อไปยังดาเมจโซน ทำแบบนี้ซ้ำไปซ้ำมาเรื่อยๆตามจำนวนคริติคัลของผู้โจมตี ทริกเกอร์แต่ละใบจะต้องแสดงผลอย่างสมบูรณ์เสียก่อน จึงจะสามารถดาเมจเช็คใบถัดไปได้ 
                         หากคุณให้พลัง +5000 แก่ยูนิตที่ถูกโจมตี ยูนิตนั้นจะได้รับพลังค้างไว้จนกว่าจะจบเทิร์น แต่ไม่ได้หมายความว่ายูนิตนั้นจะหลุดพ้นจากการโจมตีครั้งนั้น ให้ถือว่ายูนิตนั้นได้พ่ายแพ้การต่อสู้ครั้งนั้นไปเรียบร้อยแล้ว อย่างไรก็ตาม 
                         มันก็จะช่วยให้คุณรับมือการโจมตีครั้งถัดไปในเทิร์นนี้ง่ายขึ้น หากดาเมจเช็คแสดงฮีลทริกเกอร์ คุณสามารถฮีลดาเมจก่อนที่จะวางการ์ดใบนั้นลงในดาเมจโซน ถ้าหากดาเมจของคุณมีมากกว่า หรือเท่ากับผู้เล่นอีกฝ่าย เช่น ถ้าคุณมี 5 ดาเมจ 
                         แล้วดาเมจเช็คได้ฮีลทริกเกอร์ที่แสดงผลได้ คุณสามารถฮีล 1 ดาเมจก่อน และค่อยวางฮีลทริกเกอร์นั้นลงในดาเมจโซน ทำให้คุณยังคงมี 5 ดาเมจเท่าเดิม และยังไม่แพ้การแข่งขันครั้งนั้น</p>

                          <p style="color:red; font-size:20px; text-align: center; text-indent: 50px;">*เมื่อจบการต่อสู้</p> 
                         <p style="color:black; font-size:20px; text-align: center;text-align: justify; text-indent: 50px;"> การ์เดี้ยนและยูนิตที่ทำการอินเทอร์เซ็ปทั้งหมดถูกรีไทร์ (ย้ายไปยังดรอปโซน)  
                         หากคุณยังมียูนิตแถวหน้าที่สามารถโจมตีได้ คุณก็ยังสามารถประกาศโจมตีได้อีก เลือกเป้าหมายและทำการทางด้านบนซ้ำอีกครั้ง</p>         
                                              
                         <p style="color:black; font-size:30px;">[ VI ] เอนด์เฟส</p>
                         <p style="color:black; font-size:20px; text-align: center;text-align: justify; text-indent: 50px;">ประกาศจบเทิร์นของคุณ และเริ่มเทิร์นของผู้เล่นฝ่ายตรงข้าม</p>

                                <p style="color:red; font-size:50px;">Credit: <a href='https://www.metalbridges.com/how-to-play-cardfight-vanguard/'>https://www.metalbridges.com/</a></p>

                        

                          

                         

                         

        
                </div>
            </div>
        </div>
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
