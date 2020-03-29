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
                              <li class="active_progressbar">Thu hoạch</li>
                        </ul>
                    </div>
                </div>

                <div class="row form-add" style="margin-left: 15%;margin-right: 15%;width:70%">
                    <div class="col-md-12">
                        
                        <form action="show.php" method="post">
                            <input type="hidden" autocomplete="off" class="form-control" name="text_qrcode" style="border-radius: 0px; " placeholder="Text..." value="<?php echo $_SESSION['id'] ?>" >
                            <br>
                            <input type="submit" class="btn btn-md btn-danger text-center" value="Tạo QR CODE">
                        </form>

                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group row text-center">
                                
                                <!-- <a  href="" class="btn btn-primary">Tạo QR CODE</a> -->
                            </div>
                           
                           
                             <?php  require_once __DIR__. DIRECTORY_SEPARATOR."../message/message.php";  ?>
						    <div class="form-group row">
							    <div class="col-sm-12">
							      <button type="submit" class="btn btn-primary submit-form" style="float: right">Lưu</button>
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
