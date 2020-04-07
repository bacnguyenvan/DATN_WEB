<?php 
    require_once  "../autoload/autoload.php";
    $active = 'rau'; // active 
    $css = true;
    $js = true;
    $phase = 2;
    $categories = $db->fetchAll('loai_rau');

    if(isset($_POST['number_row'])){
        $number_row = $_POST['number_row'];
    }else{
        $number_row = 1;
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        
        
        $errors = [];

        $inputs['condition_name'] = $_POST['condition_name'];
        $inputs['condition'] = $_POST['condition'];
        // foreach
       for($i = 0 ; $i < count($inputs['condition_name']) ; $i++ ){
            if( $inputs['condition_name'][$i] == '' ){
                
                $errors['condition_name'][$i] = 'Vui lòng nhập vào tên điều kiện';
                
            }
            if( $inputs['condition'][$i] == '' ){
                
                $errors['condition'][$i] = 'Vui lòng nhập vào điều kiện';
                
            }
       }
       
           
       
        if(empty($errors)){
            for($i = 0 ; $i < count($inputs['condition_name']) ; $i++ ){
                $data = [
                    'rau_id' => $_SESSION['rau_id'],
                    'ten_dieu_kien' => $inputs['condition_name'][$i],
                    'dieu_kien' => $inputs['condition'][$i],
                ];
                $id_insert = $db->insertDB("dieu_kien_canh_tac",$data);
                if($id_insert) break;
            }

            if($id_insert){
               $_SESSION['success'] = "Đã thêm điều kiện canh tác thành công";
                redirectStyle('product/thu_hoach.php');
            }else{
                $_SESSION['error'] = "Thêm điều kiện canh tác thất bại";
                redirectStyle('product/canh_tac.php');
            }
            
            
        }
    }

?>

<?php require_once "../header.php" ?>
    
        <!-- content -->
        <div id="page-wrapper" style="margin-bottom: 30px">

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

                
                <div class="row form-add" style="margin-left: 15%;margin-right: 15%;width:70%">
                    <div class="col-md-12">
                        <h2 class="text-center" style="font-family: cursive;margin-bottom: 50px">ĐIỀU KIỆN CANH TÁC</h2>
                        <div>
                            <a href="javascript:void(0)" class="btn btn-success pull-right btn_add_dk">Thêm điều kiện</a>

                            <?php  require_once __DIR__. DIRECTORY_SEPARATOR."../message/message.php";  ?>
                        </div>
                        <div class="clearfix" style="margin-bottom: 30px"></div>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="number_row" value="<?php echo postInput('number_row')?postInput('number_row'):1 ?>" class="number_row">
                            <div class="list_condition">
                                <?php for($i = 0; $i < $number_row ; $i++) { ?>
                                <div class="form-group row">
                                    <div class="col-sm-3 col-form-label">
                                        <input type="text" class="form-control" name="condition_name[]" placeholder="Nhập tên điều kiện" <?php if(!empty($inputs['condition_name'][$i])){ ?> value="<?php echo $inputs['condition_name'][$i] ?>" <?php } ?> >
                                        <?php 
                                        if(isset($errors['condition_name'][$i])){ ?>
                                            <p class="text-danger">
                                                <?php echo $errors['condition_name'][$i] ?>
                                            </p>
                                        <?php } ?>
                                        
                                    </div>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="inputEmail3" placeholder="Nhập điều kiện" name="condition[]" <?php if(!empty($inputs['condition'][$i])){ ?> value="<?php echo $inputs['condition'][$i] ?>" <?php } ?> >
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
                            <div>
                                <button class="btn btn-warning pull-right save_condition" style="padding:8px 25px">Next</button>
                            </div>

						
                             
						  
						</form>
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
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- end content-->

<?php require_once "../footer.php" ?>    
