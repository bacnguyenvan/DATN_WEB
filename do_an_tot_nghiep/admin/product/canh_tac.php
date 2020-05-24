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
            }

            if($id_insert){
               // $_SESSION['success'] = "Đã thêm điều kiện canh tác thành công";
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

                
                <?php $show_next = true; require_once  "_form_dieu_kien_canh_tac.php"; ?>

                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- end content-->

<?php require_once "../footer.php" ?>    
