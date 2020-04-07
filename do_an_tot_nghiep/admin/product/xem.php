<?php 
    require_once  "../autoload/autoload.php";
    $active = 'rau'; // active 

    $id = (int)getInput('id');
    $rauById = $db->fetchID('rau',$id); 
    if(empty($rauById)) {
        echo ($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
        die();
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
                           Xem thông tin cây trồng
            
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Trang chủ</a>
                            </li>
                            <li class="">
                                <i class="fa fa-file"></i> Vườn rau
                            </li>

                            <li class="active">
                                <i class="fa fa-edit"></i> Xem thông tin cây trồng
                            </li>

                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <!-- /.row -->

                <div class="row form-add" style="margin-left: 15%;margin-right: 15%;width:70%">
                    <div class="col-md-12">
                        
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tên</label>
                                <div class="col-sm-10">
                                    <p><?php echo $rauById['name'] ?></p>    
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Giá mua giống</label>
                                <div class="col-sm-10">
                                    <p><?php echo $rauById['price'] ?></p>    
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Số lượng giống</label>
                                <div class="col-sm-10">
                                    <p><?php echo $rauById['number'] ?></p>    
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nhà cung cấp giống</label>
                                <div class="col-sm-10">
                                    <p><?php echo $rauById['nha_cung_cap'] ?></p>    
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Ngày trồng </label>
                                <div class="col-sm-10">
                                    <p><?php echo $rauById['ngay_chon_giong'] ?></p>    
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Ảnh giống</label>
                                <div class="col-sm-10">
                                    <img alt="" src="../public/uploads/rau/<?php echo $rauById['image_giong']?>" width="100px" height="100px">    
                                </div>
                            </div>

                            <h2> THU HOẠCH </h2>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nhà cung cấp</label>
                                <div class="col-sm-10">
                                    <p><?php echo $rauById['nha_cung_cap'] ?></p>    
                                </div>
                            </div>
                           
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Ngày thu hoạch</label>
                                <div class="col-sm-10">
                                    <p><?php echo $rauById['ngay_chon_giong'] ?></p>    
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Sản lượng</label>
                                <div class="col-sm-10">
                                    <p><?php echo $rauById['number'] ?></p>    
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Ảnh cây khi thu hoạch</label>
                                <div class="col-sm-10">
                                    <img alt="" src="../public/uploads/rau/<?php echo $rauById['image_giong']?>" width="100px" height="100px">    
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
