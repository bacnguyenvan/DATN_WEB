<?php 
    require_once  "../autoload/autoload.php";
    $active = 'rau'; // active 
    $css = true;
    $js = true;
    $phase = 2;
    $categories = $db->fetchAll('loai_rau');

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        
        $data =
        [
            'name' => postInput('name'),
            'slug' => changeTitle(postInput('name')),
            'category_id' => postInput('category'),
            'price' => postInput('price'),
            'content' => postInput('content'),
            'number' => postInput('number')
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
        
        if($_FILES['images']['name'] == ''){
            $errors['image'] = 'Vui lòng import hình';
        }
        
       
        if(empty($errors)){
            //check exist
            $checkNameExist = $db->fetchOne('products',"category_id = '".$data['category_id']."' AND name= '".$data['name']."' ");

            if($checkNameExist){
                $_SESSION['error'] = 'Product existed,please enter other name product';
            }else{

                if(isset($_FILES['images'])){
                $file_name  = $_FILES['images']['name'];
                $file_tmp   = $_FILES['images']['tmp_name'];
                $file_type  = $_FILES['images']['type'];
                $file_erro  = $_FILES['images']['error'];

                    if($file_erro == 0){
                        $part = IMAGE."products/";
                        $data['thunbar'] = $file_name;
                    }else{/*do nothing*/}
               
                }else{/*do nothing*/}
            
                $id_insert = $db->insertDB("products",$data);
                if($id_insert){
                    move_uploaded_file($file_tmp, $part.$file_name);

                    $_SESSION['success'] = "Thêm mới thành công";
                    redirectStyle('product');
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
                              <li class="active_progressbar">Qúa trình canh tác</li>
                              <li>Thu hoạch</li>
                        </ul>
                    </div>
                </div>

                <input type="hidden" name="number_row" value="0" class="number_row">
                <div class="row form-add" style="margin-left: 15%;margin-right: 15%;width:70%">
                    <div class="col-md-12">
                        <h2 class="text-center" style="font-family: cursive;margin-bottom: 50px">ĐIỀU KIỆN CANH TÁC</h2>
                        <div>
                            <a href="javascript:void(0)" class="btn btn-success pull-right btn_add_dk">Thêm điều kiện</a>
                        </div>
                        <div class="clearfix" style="margin-bottom: 30px"></div>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="list_condition">
                                <div class="form-group row">
                                    <div class="col-sm-3 col-form-label">
                                        <input type="text" class="form-control" name="condition_name" placeholder="Nhập tên điều kiện">
                                    </div>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="inputEmail3" placeholder="Nhập điều kiện" name='condition'>
                                    </div>
                                    <div class="col-sm-2">
                                        <a href="" class="btn btn-primary">Xóa điều kiện</a>
                                    </div>
                                </div>


                            </div>

						
                             <?php  require_once __DIR__. DIRECTORY_SEPARATOR."../message/message.php";  ?>
						  
						</form>
                        <div class="more_condition" hidden>
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label">
                                    <input type="text" class="form-control" name="condition_name" placeholder="Nhập tên điều kiện">
                                </div>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Nhập điều kiện" name='condition'>
                                </div>
                                <div class="col-sm-2">
                                    <a href="" class="btn btn-primary">Xóa điều kiện</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- end content-->

<?php require_once "../footer.php" ?>    
