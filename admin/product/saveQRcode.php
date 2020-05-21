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