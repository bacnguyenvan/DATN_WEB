<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tạo QR Code</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" ></script>
    <style>
        body, html {
            height: 100%;
            width: 100%;
        }
        .bg {
            /*background-image: url("images/bg.jpg");*/
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>
<body class="bg">
    <div class="container" id="panel">
        <br><br><br>
        <div class="row">
            <div class="col-md-6 offset-md-3" style="background-color: white; padding: 20px; box-shadow: 10px 10px 5px #888;">
                <div class="panel-heading">
                    <h1 class="text-center">Hình ảnh QR-code</h1>
                </div>
                <hr>
                <div id="qrbox" style="text-align: center;">
                    <img src="generate.php?text_qrcode=<?php echo $_GET['text_qrcode']?>" alt="">
                </div>
                <hr>
                <a class="btn btn-danger" id="download" href="generate.php?text_qrcode=<?php echo $_GET['text_qrcode']?>" download="generate.php?text_qrcode=<?php echo $_GET['text_qrcode']?>.png">Tải hình xuống</a>

                <div class="mt-4"></div>
                
                <div class="row">
                    <label class="col-sm-8">Nhấn tải hình xuống sau đó nhấn tiếp tục</label>
                    <div class="col-sm-4">
                        <a href="javascript:history.go(-1)" class="btn btn-primary">Tiếp tục</a>
                    </div>
                    
                </div>
                

            </div>
        </div>
    </div>
</body>
</html>