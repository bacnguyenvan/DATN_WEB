<?php 
    require_once  "../autoload/autoload.php";
    $active = 'rau'; // active 

    $id = (int)getInput('id');
    $productById = $db->fetchID('rau',$id); 
    if(empty($productById)) redirectStyle('404.php');

    $product_thu_hoach = $db->fetchOne('thu_hoach',"rau_id = $id ");
    $dieu_kien_canh_tac = $db->fetchAll_condition('dieu_kien_canh_tac',"rau_id = $id");



    if(isset($_POST['number_row'])){
        $number_row = $_POST['number_row'];
    }else{
        $number_row = count($dieu_kien_canh_tac);
    }


    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
       
        $data =
        [
            'name' => postInput('name'),
            'price' => postInput('price'),
            'number' => postInput('number'),
            'nha_cung_cap' => postInput('nha_cung_cap'),
            'ngay_trong' => postInput('ngay_trong'),
            'updated_at' => date("d-m-Y H:i:s"),

        ];

        $errors = [];
        
        if(postInput('name') == '')
        {
            $errors['name'] = 'Vui lòng nhập tên rau';
        }

        if(postInput('price') == '')
        {
            $errors['price'] = 'Vui lòng nhập giá rau';
        }
        
        if(postInput('nha_cung_cap') == '')
        {
            $errors['nha_cung_cap'] = 'Vui lòng nhập vào nhà cung cấp';
        }
        if(postInput('ngay_trong') == '')
        {
            $errors['ngay_trong'] = 'Vui lòng nhập vào ngày chọn giống';
        }
        
    
        
        if(empty($errors)){

            
            if($_FILES['image_giong']['name']){   

                $file_name_image_giong  = $_FILES['image_giong']['name'];
                $file_tmp_image_giong   = $_FILES['image_giong']['tmp_name'];
                $file_type_image_giong  = $_FILES['image_giong']['type'];
                $file_erro_image_giong  = $_FILES['image_giong']['error'];

                if($file_erro_image_giong == 0){
                    $part = IMAGE."rau/";
                    $data['image_giong'] = $file_name_image_giong;
                }
               
            } 
            
            $id_update_rau = $db->updateDB("rau",$data,['id'=>$id]);
            echo($id_update_rau); die();
            if($id_update_rau){
               
                move_uploaded_file($file_tmp_image_giong, $part.$file_name_image_giong);


                // 2. save dieu kien canh tac
                $inputs['condition_name'] = $_POST['condition_name'];
                $inputs['condition'] = $_POST['condition'];


                $db->fetchSql_no_array("DELETE FROM dieu_kien_canh_tac WHERE rau_id = $id ");
                

                for($i = 0 ; $i < count($inputs['condition_name']) ; $i++ ){
                    $data_dieu_kien_canh_tac = [
                        'ten_dieu_kien' => $inputs['condition_name'][$i],
                        'dieu_kien' => $inputs['condition'][$i],
                        'rau_id'    => $id
                    ];

                    if($data_dieu_kien_canh_tac['ten_dieu_kien'] == '' || $data_dieu_kien_canh_tac['dieu_kien'] == '' ) continue;

                    $id_update_dieu_kien_canh_tac = $db->insertDB("dieu_kien_canh_tac",$data_dieu_kien_canh_tac);

                }

                // 3. save thu_hoach

                $data_thu_hoach =
                [
                    'nha_san_xuat' => postInput('nha_san_xuat'),
                    'ngay_thu_hoach' => postInput('ngay_thu_hoach'),
                    'san_luong' => postInput('san_luong'),
                    'gia_ban' => postInput('gia_ban'),
                    
                ];
                if($_FILES['image_thu_hoach']['name']){   

                    $file_name_image_thu_hoach  = $_FILES['image_thu_hoach']['name'];
                    $file_tmp_image_thu_hoach   = $_FILES['image_thu_hoach']['tmp_name'];
                    $file_type_image_thu_hoach  = $_FILES['image_thu_hoach']['type'];
                    $file_erro_image_thu_hoach  = $_FILES['image_thu_hoach']['error'];

                    if($file_erro_image_thu_hoach == 0){
                        $part = IMAGE."thu_hoach/";
                        $data_thu_hoach['image_thu_hoach'] = $file_name_image_thu_hoach;
                        move_uploaded_file($file_tmp_image_thu_hoach, $part.$file_name_image_thu_hoach);
                    }
                   
                }  
                if($_FILES['image_qrcode']['name']){   

                    $file_name_image_qrcode  = $_FILES['image_qrcode']['name'];
                    $file_tmp_image_qrcode   = $_FILES['image_qrcode']['tmp_name'];
                    $file_type_image_qrcode  = $_FILES['image_qrcode']['type'];
                    $file_erro_image_qrcode  = $_FILES['image_qrcode']['error'];

                    if($file_erro_image_thu_hoach == 0){
                        $part = IMAGE."qrcode/";
                        $data_thu_hoach['qrcode'] = $file_name_image_qrcode;

                        move_uploaded_file($file_tmp_image_qrcode, $part.$file_name_image_qrcode);
                    }
                   
                }  

                $checkExists = $db->fetchOne('thu_hoach'," rau_id = $id ");
                if(!empty($checkExists)){
                    $test = $db->updateDB("thu_hoach",$data_thu_hoach,['rau_id'=>$id]);
                }else{
                    $data_thu_hoach['rau_id'] = $id;
                    $db->insertDB("thu_hoach",$data_thu_hoach);
                }

                $_SESSION['success'] = "Cập nhật thành công";
                redirectStyle('product');


            }else{
                
                $_SESSION['error'] = "Cập nhật thất bại";
                redirectStyle('product');
            }
        }
    }

?>

<?php require_once "../header.php" ?>
    
        <!-- content -->
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Cập nhật thông tin rau trồng
            
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Trang chủ</a>
                            </li>
                            <li class="">
                                <i class="fa fa-file"></i> Sản phẩm
                            </li>

                            <li class="active">
                                <i class="fa fa-edit"></i> Cập nhật
                            </li>

                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <!-- /.row -->

                <div class="row form-add" style="margin-left: 15%;margin-right: 15%;width:70%">
                    <div class="col-md-12">
                        
                        <form action="" method="POST" enctype="multipart/form-data">
                            <h2>1. Khâu chọn giống</h2>
							<div class="form-group row">
						    	<label for="inputEmail3" class="col-sm-2 col-form-label">Tên<span style="color: red">*</span></label>
							    <div class="col-sm-10">
							      <input type="text" class="form-control" id="inputEmail3" placeholder="Nhập tên" name='name' 
                                  value="<?php echo $productById['name'] ?>">

                                  <?php 
                                        if(isset($errors['name'])){ ?>
                                            <p class="text-danger">
                                                <?php echo $errors['name'] ?>
                                            </p>
                                        <?php } ?>


                                   
							    </div>
							</div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Giá mua giống<span style="color: red">*</span></label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="inputEmail3" placeholder="Nhập giá" name='price' value="<?php echo $productById['price'] ?>">

                                  <?php if(isset($errors['price'])) { ?>
                                        <p class="text-danger">
                                            <?php echo $errors['price'] ?>
                                        </p>

                                  <?php } ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Số lượng giống</label>
                                <div class="col-sm-10">
                                  <input type="number" min="0"  class="form-control" id="inputEmail3" placeholder="Nhập số lượng sản phẩm" name='number' value="<?php echo $productById['number']?>">

                                  
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Nhà cung cấp<span style="color: red">*</span></label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="inputEmail3" placeholder="Nhập nhà cung cấp giống" name='nha_cung_cap' value="<?php echo $productById['nha_cung_cap']?>">

                                  <?php if(isset($errors['nha_cung_cap'])) { ?>
                                        <p class="text-danger">
                                            <?php echo $errors['nha_cung_cap'] ?>
                                        </p>

                                  <?php } ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Ngày trồng <span style="color: red">*</span></label>
                                <div class="col-sm-10">
                                  <input type="date" class="form-control" id="inputEmail3" placeholder="Nhập ngày trồng" name='ngay_trong' value="<?php echo $productById['ngay_trong']?>" >
                                <?php if(isset($errors['ngay_trong'])) { ?>
                                        <p class="text-danger">
                                            <?php echo $errors['ngay_trong'] ?>
                                        </p>

                                  <?php } ?>
                                  
                                </div>
                            </div>

                            <div class="form-group row">
                                
                                <label class="col-sm-2 col-form-label">Hình ảnh giống rau </label>
                                <div class="col-sm-4">
                                    <input type="file" name="image_giong" class="form-control">
                                    
                                  <?php if(!empty($productById['image_giong'])){ ?>
                                        <img alt="" src="../public/uploads/rau/<?php echo $productById['image_giong']?>" width="80px" height="80px">
                                  <?php } ?>
                                </div>
                            </div>

                            <h2> 2. Quá trình canh tác</h2>
                            <div class="row form-add">
                                <div class="col-md-12">
                                    <h2 class="text-center" style="font-family: cursive;margin-bottom: 50px">ĐIỀU KIỆN CANH TÁC</h2>
                                    <div>
                                        <a href="javascript:void(0)" class="btn btn-success pull-right btn_add_dk">Thêm điều kiện</a>

                                        <?php  require_once __DIR__. DIRECTORY_SEPARATOR."../message/message.php";  ?>
                                    </div>
                                    <div class="clearfix" style="margin-bottom: 30px"></div>
                                  
                                    <input type="hidden" name="number_row" value="<?php echo $number_row?>" class="number_row">
                                    <div class="list_condition">
                                        <?php for($i = 0; $i < count($dieu_kien_canh_tac) ; $i++) { ?>
                                        <div class="form-group row">
                                            <div class="col-sm-3 col-form-label">
                                                <input type="text" class="form-control" name="condition_name[]" placeholder="Nhập tên điều kiện" value="<?php echo $dieu_kien_canh_tac[$i]['ten_dieu_kien'] ?>" >
                                                <?php 
                                                if(isset($errors['condition_name'][$i])){ ?>
                                                    <p class="text-danger">
                                                        <?php echo $errors['condition_name'][$i] ?>
                                                    </p>
                                                <?php } ?>
                                                
                                            </div>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="Nhập điều kiện" name="condition[]" value="<?php echo $dieu_kien_canh_tac[$i]['dieu_kien'] ?>" >
                                                <?php 
                                                if(isset($errors['condition'][$i])){ ?>
                                                    <p class="text-danger">
                                                        <?php echo $errors['condition'][$i] ?>
                                                    </p>
                                                <?php } ?>
                                            </div>
                                            <div class="col-sm-2">
                                                <a href="javascript:void(0)" class="btn btn-primary delete_condition">Xóa điều kiện</a>
                                            </div>

                                        </div>
                                        <?php } ?>

                                    </div>
                                        
                                    <div class="more_condition" hidden>
                                        <div class="form-group row">
                                            <div class="col-sm-3 col-form-label">
                                                <input type="text" class="form-control" name="condition_name[]" placeholder="Nhập tên điều kiện">
                                            </div>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="Nhập điều kiện" name='condition[]'>
                                            </div>
                                            <div class="col-sm-2">
                                                <a href="javascript:void(0)" class="btn btn-primary delete_condition">Xóa điều kiện</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            
                            <h2> 3. Thu hoạch </h2>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Nhà sản xuất</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="inputEmail3" placeholder="Nhập nhà sản xuất" name='nha_san_xuat' value="<?php echo (!empty($product_thu_hoach))? $product_thu_hoach['nha_san_xuat']: "" ?>">

                                  
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Ngày thu hoạch </label>
                                <div class="col-sm-10">
                                  <input type="date" class="form-control" id="inputEmail3" placeholder="Nhập ngày thu hoạch" name='ngay_thu_hoach' value="<?php echo (!empty($product_thu_hoach))?$product_thu_hoach['ngay_thu_hoach']:"" ?>">
                                
                                  
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Sản lượng </label>
                                <div class="col-sm-10">
                                  <input type="number" min="0"  class="form-control" id="inputEmail3" placeholder="Nhập sản lượng " name='san_luong' value="<?php echo (!empty($product_thu_hoach))? $product_thu_hoach['san_luong']:"" ?>">

                                  
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Giá bán </label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="inputEmail3" placeholder="Nhập giá bán " name='gia_ban' value="<?php echo (!empty($product_thu_hoach))? $product_thu_hoach['gia_ban']:""?>">

                                  
                                </div>
                            </div>
                           
                           <div class="form-group row">
                                
                                <label class="col-sm-2 col-form-label">Hình ảnh rau thu hoạch </label>
                                <div class="col-sm-4">
                                    <input type="file" name="image_thu_hoach" class="form-control">
                                    <?php if(!empty($product_thu_hoach['image_thu_hoach'])){ ?>
                                    <img alt="" src="../public/uploads/thu_hoach/<?php echo (!empty($product_thu_hoach))?$product_thu_hoach['image_thu_hoach']:""?>" width="100px" height="100px">   
                                    <?php } ?> 
                                </div>
                            </div>

                            <div class="form-group row">
                                
                                <label class="col-sm-2 col-form-label">Hình ảnh QRCode</label>
                                <div class="col-sm-4">
                                    <input type="file" name="image_qrcode" class="form-control">
                                    <?php if(!empty($product_thu_hoach['qrcode'])){ ?>
                                    <img alt="" src="../public/uploads/qrcode/<?php echo $product_thu_hoach['qrcode']?>" width="100px" height="100px">   
                                    <?php } ?> 
                                </div>
                                <div class="col-sm-4">
                                    <a href="generateQRcode.php?text_qrcode=<?php echo $id ?>" class="btn btn-danger">Tạo QRCode ( nếu chưa có hình QRCode) <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>

						    <div class="form-group row">
							    <div class="col-sm-12">
							      <button type="submit" class="btn btn-primary submit-form" style="float: right">Cập nhật</button>
							    </div>
						    </div>
						</form>
                    </div>
                    
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- end content-->

<?php require_once "../footer.php" ?>    
