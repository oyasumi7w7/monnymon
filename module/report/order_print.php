<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>รายงาน</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700"> 
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/magnific-popup.css">
    <link rel="stylesheet" href="../css/jquery-ui.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../css/themify-icons.css" type="text/css">
    <link rel="stylesheet" href="../css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="../css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="../css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="../css/slicknav.min.css" type="text/css">

    <style>
        * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box
        }

        #print-div {
            position: relative;
            height: auto;
            width: 210mm;
            min-height: 250mm;
            margin: 20px auto 20px auto;
            border: 1px solid #f1f1e3;
            padding: 20px 40px;
            line-height: 20px;
            overflow: hidden;
        }

        h1 {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            padding-top: 20px;
            line-height: 30px;
        }

        h2 {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            padding-bottom: 2px;
            line-height: 30px;
            font-weight: normal;
        }

        span {
            padding: 0 0 0 10px;
            border-bottom: 1px dashed #000;
            display: inline-block;
            text-indent: 0px;
        }

        .sen {
            width: 300px;
            height: 75px;
            font-size: 12px;
            text-align: center;
            line-height: 18px;
            padding-top: 20px;
            clear: both;
        }

        .bor_titel {
            width: 49%;
            border: 2px solid #000;
            border-radius: 20px;
            padding: 20px 10px;
            margin-bottom: 30px;
        }

        table.tb_title {
            width: 100%;
            height: 80px;
        }

        @media print {
            #print-div {
                border: none;
                height: 205mm;
            }

            .print {
                display: none;
            }
        }

        @media print {
            .panel-heading {
                display: none
            }
        }
    </style>
</head>

<body>
    <p class="text-center print" style="padding: 20px;">
        <button onclick="return window.print();" type="button" class="btn btn-primary"><i class="fa fa-print"></i>
            พิมพ์
        </button>
    </p>


    <div id="print-div">

        <img src="../images/header-logo1.png" style="width: 200px; height: auto; position: absolute; right: 85px; top: 20px;" alt="">

        <p style="font-size:16px; line-height: 25px;">
            <b style="font-size:18px;">ร้าน Monnymon </b> <br>
            เลขที่ 1/1 ถนนเมืองสมุทร ตำบลช้างม่อย <br>
            อำเภอเมือง จังหวัดเชียงใหม่ 50300 <br>
        </p>
        <h1>ใบเสร็จรับเงิน</h1>

        <p class="text-right">
            <b>เอกสารเลขที่ : </b>000001 <br>
            <b>วันที่ทำรายการ : </b> 14/11/2539<br>
        </p>

        <p style="text-indent: 100px; margin-top:80px;">
            <b>ผู้รับของ</b> <span style="width: 250px;">God Oak</span>
            <b>เบอร์โทร</b> <span style="width: 150px;">03333333</span>
        </p>

        <p>
            <b>วันที่เริ่ม</b> <span style="width: 150px;">20/8/2553</span>
            <b>วันที่สิ้นสุด</b> <span style="width: 150px;">20/8/2560</span>
            <b>สถานะ</b> <span style="width: 150px;">ใช้อยู่</span>
        </p>
        <p>
            <b>วัตถุประสงค์</b> <span style="width: 530px;">จัดงาน</span>
        </p>

        <h2>รายละเอียด</h2>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="50" class="text-center">ลำดับ</th>
                    <th width="50" class="text-center">รหัสสินค้า</th>
                    <th width="100" class="text-center">รายการ</th>
                    <th width="50" class="text-center">จำนวน</th>
                    <th width="100" class="text-center">ราคา</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <td class="text-center">00001</td>
                        <td class="text-center">bazooka</td>
                        <td class="text-center">5</td>
                        <td class="text-center">20 บาท</td>
                    </tr>
            </tbody>
        </table>

        <p class="text-right">
            <b>ราคารวม</b> <span style="width: 250px;"> บาท</span>
        </p>


    </div>

</body>
</html>
