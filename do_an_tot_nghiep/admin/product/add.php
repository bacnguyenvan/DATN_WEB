<?php 
    require_once  "../autoload/autoload.php";
    $active = 'rau'; // active 
    $css = true;
    $categories = $db->fetchAll('loai_rau');

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        
        $data =
        [
            'name' => postInput('name'),
            'loai_rau_id' => postInput('category'),
            'price' => postInput('price'),
            'number' => postInput('number'),
            'nha_cung_cap' => postInput('nha_cung_cap'),
            'ngay_chon_giong' => postInput('ngay_chon_giong')
            
        ];
        $errors = [];
        
        if(postInput('category') == '')
        {
            $errors['category'] = 'Vui lòng nhập loại rau';
        }
        if(postInput('name') == '')
        {
            $errors['name'] = 'Vui lòng nhập tên sản phẩm';
        }

    

        if(postInput('price') == '')
        {
            $errors['price'] = 'Vui lòng nhập giá sản phẩm';
        }
        if(postInput('number') == '')
        {
            $errors['number'] = 'Vui lòng nhập số lượng';
        }
        if(postInput('nha_cung_cap') == '')
        {
            $errors['nha_cung_cap'] = 'Vui lòng nhập vào nhà cung cấp';
        }
        if(postInput('ngay_chon_giong') == '')
        {
            $errors['ngay_chon_giong'] = 'Vui lòng nhập vào ngày chọn giống';
        }
        
        if($_FILES['images']['name'] == ''){
            $errors['image'] = 'Vui lòng import hình';
        }
        
       
        if(empty($errors)){
            //check exist
            $checkNameExist = $db->fetchOne('rau',"loai_rau_id = '".$data['loai_rau_id']."' AND name= '".$data['name']."' ");

            if($checkNameExist){
                $_SESSION['error'] = 'Tên rau này đã tồn tại , vui lòng nhập tên khác';
            }else{

                if(isset($_FILES['images'])){
                $file_name  = $_FILES['images']['name'];
                $file_tmp   = $_FILES['images']['tmp_name'];
                $file_type  = $_FILES['images']['type'];
                $file_erro  = $_FILES['images']['error'];

                    if($file_erro == 0){
                        $part = IMAGE."rau/";
                        $data['image_giong'] = $file_name;
                    }else{/*do nothing*/}
               
                }else{/*do nothing*/}

                // _debug($data);
                $id_insert = $db->insertDB("rau",$data);
                if($id_insert){
                    move_uploaded_file($file_tmp, $part.$file_name);

                    $_SESSION['success'] = "Thêm mới thành công";
                    $_SESSION['rau_id'] = mysqli_insert_id($db->connect);
                    redirectStyle('product/canh_tac.php');
                }else{
                    $_SESSION['error'] = "Thêm mới thất bại";
                    redirectStyle('product');
                }
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
                            Thêm rau trồng
            
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Home</a>
                            </li>
                            <li class="">
                                <i class="fa fa-file"></i> Quản lí vườn rau
                            </li>

                            <li class="active">
                                <i class="fa fa-plus-square"></i> Thêm mới
                            </li>

                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <!-- /.row -->

                <div class="container_progressbar_rau">
                    <div class="row">
                        <ul class="progressbar_rau">
                              <li class="active_progressbar">Chọn giống</li>
                              <li>Qúa trình canh tác</li>
                              <li>Thu hoạch</li>
                        </ul>
                    </div>
                </div>

                <div class="row form-add" style="margin-left: 15%;margin-right: 15%;width:70%">
                    <div class="col-md-12">
                        
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Loại rau<span style="color: red">*</span></label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="category">
                                        <option value=""> --Lựa chọn loại rau-- </option>
                                        <?php 
                                            foreach($categories as $item){ ?>

                                                <option value="<?php echo $item['id'] ?>"><?php echo $item['name'] ?></option>

                                            <?php } ?>

                                        ?>
                                        
                                     </select>
                                     <?php if(isset($errors['category'])) { ?>
                                        <p class="text-danger">
                                            <?php echo $errors['category'] ?>
                                        </p>

                                  <?php } ?>
                                </div>
                            </div>

							<div class="form-group row">
						    	<label for="inputEmail3" class="col-sm-2 col-form-label">Tên <span style="color: red">*</span></label>
							    <div class="col-sm-10">
							      <input type="text" class="form-control" id="inputEmail3" placeholder="Nhập tên" name='name'>

                                  <?php 
                                        if(isset($errors['name'])){ ?>
                                            <p class="text-danger">
                                                <?php echo $errors['name'] ?>
                                            </p>
                                        <?php } ?>


                                   
							    </div>
							</div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Giá <span style="color: red">*</span></label>
                                <div class="col-sm-10">
                                  <input type="number" min="1" class="form-control" id="inputEmail3" placeholder="Nhập giá" name='price'>

                                  <?php if(isset($errors['price'])) { ?>
                                        <p class="text-danger">
                                            <?php echo $errors['price'] ?>
                                        </p>

                                  <?php } ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Số lượng <span style="color: red">*</span></label>
                                <div class="col-sm-10">
                                  <input type="number" value="1" min="1"  class="form-control" id="inputEmail3" placeholder="Nhập số lượng" name='number'>

                                  <?php if(isset($errors['number'])) { ?>
                                        <p class="text-danger">
                                            <?php echo $errors['number'] ?>
                                        </p>

                                  <?php } ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Nhà cung cấp <span style="color: red">*</span></label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="inputEmail3" placeholder="Nhập nhà cung cấp" name='nha_cung_cap'>
                                <?php if(isset($errors['nha_cung_cap'])) { ?>
                                        <p class="text-danger">
                                            <?php echo $errors['nha_cung_cap'] ?>
                                        </p>

                                  <?php } ?>
                                  
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Ngày chọn giống <span style="color: red">*</span></label>
                                <div class="col-sm-10">
                                  <input type="date" class="form-control" id="inputEmail3" name='ngay_chon_giong'>
                                <?php if(isset($errors['ngay_chon_giong'])) { ?>
                                        <p class="text-danger">
                                            <?php echo $errors['ngay_chon_giong'] ?>
                                        </p>

                                  <?php } ?>
                                  
                                </div>
                            </div>

                            <div class="form-group row">
                                
                                <label class="col-sm-2 col-form-label">Hình ảnh giống rau <span style="color: red">*</span></label>
                                <div class="col-sm-4">
                                    <input type="file" name="images" class="form-control">
                                    <?php if(isset($errors['image'])) { ?>
                                        <p class="text-danger">
                                            <?php echo $errors['image'] ?>
                                        </p>

                                  <?php } ?>
                                </div>
                            </div>

                           
                           
                             <?php  require_once __DIR__. DIRECTORY_SEPARATOR."../message/message.php";  ?>
						    <div class="form-group row">
							    <div class="col-sm-12">
							      <button type="submit" class="btn btn-primary submit-form" style="float: right">Next</button>
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
