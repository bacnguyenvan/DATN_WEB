<?php 
    require_once  "../autoload/autoload.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $errors = [];
        $data = [];
       
        if( empty($_FILES['imgqrcode']['name'] ) ){
            $errors['image'] = 'Vui lòng thêm hình vào';
        }

        if(empty($errors)){
            
            $file_name  = $_FILES['imgqrcode']['name'];
            $file_tmp   = $_FILES['imgqrcode']['tmp_name'];
            $file_type  = $_FILES['imgqrcode']['type'];
            $file_erro  = $_FILES['imgqrcode']['error'];

                if($file_erro == 0){
                    $part = IMAGE."qrcode/";
                    $data['qrcode'] = $file_name;
                }else{/*do nothing*/}
                
                if(!empty($_SESSION['rau_id'])){
                    $id_update = $db->updateDB("rau",$data,['id'=>$_SESSION['rau_id'] ]);
                    if($id_update){
                        move_uploaded_file($file_tmp, $part.$file_name);

                        $_SESSION['success'] = "Thêm mới thành công";
                        
                        redirectStyle('product');
                    }else{
                        $_SESSION['error'] = "Thêm mới thất bại";
                        
                    }
                }else{
                    $_SESSION['error'] = "Vui lòng tạo lại mã qrcode";
                    redirectStyle('product/thu_hoach.php');
                }
                
                
        }

    }



?>

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
                    <img src="generate.php?text_qrcode=<?php echo $_POST['text_qrcode']?>" alt="">
                </div>
                <hr>
                <a class="btn btn-danger" id="download" href="generate.php?text_qrcode=<?php echo $_POST['text_qrcode']?>" download="generate.php?text_qrcode=<?php echo $_POST['text_qrcode']?>.png">Tải hình xuống</a>

                <div class="mt-4"></div>
                
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="text_qrcode" value="<?php echo $_POST['text_qrcode']?>">
                    <label>Đặt ảnh QRcode sau khi tải xuống vào đây , sau đó nhấn lưu.</label>
                    <?php if(isset($errors['image'])) { ?>
                            <p class="alert alert-danger">
                                <?php echo $errors['image'] ?>
                            </p>

                      <?php } ?>
                    <input type="file" name="imgqrcode">
                    
                    <button style="cursor: pointer;" class="btn btn-primary float-right"> Lưu QRCode </button>
                </form>

                <?php  require_once __DIR__. DIRECTORY_SEPARATOR."../message/message.php";  ?>

            </div>
        </div>
    </div>
</body>
</html>