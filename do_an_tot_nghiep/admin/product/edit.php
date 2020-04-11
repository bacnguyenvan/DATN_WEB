<?php 
    require_once  "../autoload/autoload.php";
    $active = 'rau'; // active 

    $id = (int)getInput('id');
    $productById = $db->fetchID('rau',$id); 
    $product_thu_hoach = $db->fetchOne('thu_hoach'," deleted_at = 0 AND rau_id = $id ");
    


    if(isset($_POST['number_row'])){
        $number_row = $_POST['number_row'];
    }else{
        $number_row = 1;
    }


    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        _debug("lam sau! see you again :)) ");die(); 
        
        $data =
        [
            'name' => postInput('name'),
            'slug' => changeTitle(postInput('name')),
            'category_id' => postInput('category'),
            'price' => postInput('price'),
            'content' => postInput('content'),
            'number' => postInput('number'),
            'sale' => postInput('sale')
        ];
        $errors = [];
        
        if(postInput('name') == '')
        {
            $errors['name'] = 'Vui lòng nhập tên sản phẩm';
        }

        if(postInput('category') == '')
        {
            $errors['category'] = 'Vui lòng nhập loại danh mục';
        }

        if(postInput('price') == '')
        {
            $errors['price'] = 'Vui lòng nhập giá sản phẩm';
        }
        if(postInput('number') == '')
        {
            $errors['number'] = 'Vui lòng nhập số lượng';
        }
       
        
        if(empty($errors)){

            if(isset($_FILES['images'])){
                $file_name  = $_FILES['images']['name'];
                $file_tmp   = $_FILES['images']['tmp_name'];
                $file_type  = $_FILES['images']['type'];
                $file_erro  = $_FILES['images']['error'];

                if($file_erro == 0){
                    $part = IMAGE."products/";
                    $data['thunbar'] = $file_name;
                }
               
            }
            
            $id_update = $db->updateDB("products",$data,['id'=>$id]);
            if($id_update){
               
                move_uploaded_file($file_tmp, $part.$file_name);

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
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Số lượng giống<span style="color: red">*</span></label>
                                <div class="col-sm-10">
                                  <input type="number" min="1"  class="form-control" id="inputEmail3" placeholder="Nhập số lượng sản phẩm" name='number' value="<?php echo $productById['number']?>">

                                  <?php if(isset($errors['number'])) { ?>
                                        <p class="text-danger">
                                            <?php echo $errors['number'] ?>
                                        </p>

                                  <?php } ?>
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
                                
                                <label class="col-sm-2 col-form-label">Hình ảnh giống rau <span style="color: red">*</span></label>
                                <div class="col-sm-4">
                                    <input type="file" name="image_giong" class="form-control">
                                    <?php if(isset($errors['image_giong'])) { ?>
                                        <p class="text-danger">
                                            <?php echo $errors['image_giong'] ?>
                                        </p>

                                  <?php } ?>
                                </div>
                            </div>

                            <h2> 2. Quá trình canh tác</h2>
                            <?php $show_next = false; require_once  "_form_dieu_kien_canh_tac.php";?>
                            
                            <h2> 3. Thu hoạch </h2>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Nhà sản xuất</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="inputEmail3" placeholder="Nhập nhà sản xuất" name='nha_san_xuat' value="<?php echo $product_thu_hoach['nha_san_xuat']?>">

                                  
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Ngày thu hoạch </label>
                                <div class="col-sm-10">
                                  <input type="date" class="form-control" id="inputEmail3" placeholder="Nhập ngày thu hoạch" name='ngay_thu_hoach' value="<?php echo $product_thu_hoach['ngay_thu_hoach']?>">
                                
                                  
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Sản lượng </label>
                                <div class="col-sm-10">
                                  <input type="number" min="0"  class="form-control" id="inputEmail3" placeholder="Nhập sản lượng " name='san_luong' value="<?php echo $product_thu_hoach['san_luong']?>">

                                  
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Giá bán </label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="inputEmail3" placeholder="Nhập giá bán " name='gia_ban' value="<?php echo $product_thu_hoach['gia_ban']?>">

                                  
                                </div>
                            </div>
                           
                           <div class="form-group row">
                                
                                <label class="col-sm-2 col-form-label">Hình ảnh rau thu hoạch </label>
                                <div class="col-sm-4">
                                    <input type="file" name="image_thu_hoach" class="form-control">
                                    <?php if(isset($errors['image_thu_hoach'])) { ?>
                                        <p class="text-danger">
                                            <?php echo $errors['image_thu_hoach'] ?>
                                        </p>

                                  <?php } ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                
                                <label class="col-sm-2 col-form-label">Hình ảnh QRCode</label>
                                <div class="col-sm-4">
                                    <input type="file" name="image_qrcode" class="form-control">
                                    <?php if(isset($errors['image_qrcode'])) { ?>
                                        <p class="text-danger">
                                            <?php echo $errors['image_qrcode'] ?>
                                        </p>

                                  <?php } ?>
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
