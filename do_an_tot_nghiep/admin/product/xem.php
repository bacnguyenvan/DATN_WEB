<?php 
    require_once  "../autoload/autoload.php";
    $active = 'rau'; // active 

    $id = (int)getInput('id');
    $rauById = $db->fetchID('rau',$id); 

    if(empty($rauById)) {
       redirectStyle('404.php');
    }
    $thu_hoach_By_rau_id =  $db->fetchOne('thu_hoach', "rau_id = $id "); 

    $dieu_kien_canh_tac = $db->fetchAll_condition('dieu_kien_canh_tac',"rau_id = $id ");

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
                            <h2> 1. Khâu chọn giống </h2>
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
                                    <p><?php echo $rauById['ngay_trong'] ?></p>    
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Ảnh giống</label>
                                <div class="col-sm-10">
                                    <img alt="" src="../public/uploads/rau/<?php echo $rauById['image_giong']?>" width="100px" height="100px">    
                                </div>
                            </div>

                            <h2>2. Quá trình canh tác</h2>
                            <h4>Điều kiện canh tác</h4>
                            <?php if(!empty($dieu_kien_canh_tac)){ 
                                foreach($dieu_kien_canh_tac as $item){
                                ?>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">- <?php echo $item['ten_dieu_kien']; ?></label>
                                    <div class="col-sm-10">

                                        <p><?php echo $item['dieu_kien']; ?></p>    
                                    </div>
                                </div>
                            <?php } } ?>

                            <h2> 3. Thu hoạch </h2>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nhà sản xuất</label>
                                <div class="col-sm-10">

                                    <p><?php if(isset($thu_hoach_By_rau_id['nha_san_xuat'])) echo $thu_hoach_By_rau_id['nha_san_xuat']; ?></p>    
                                </div>
                            </div>
                           
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Ngày thu hoạch</label>
                                <div class="col-sm-10">
                                    <p><?php if(isset($thu_hoach_By_rau_id['ngay_thu_hoach'])) echo $thu_hoach_By_rau_id['ngay_thu_hoach'] ?></p>    
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Sản lượng</label>
                                <div class="col-sm-10">
                                    <p><?php if(isset($thu_hoach_By_rau_id['san_luong'])) echo $thu_hoach_By_rau_id['san_luong'] ?></p>    
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Ảnh cây khi thu hoạch</label>
                                <div class="col-sm-10">
                                    <?php if(!empty($thu_hoach_By_rau_id['image_thu_hoach'])){ ?>
                                    <img alt="" src="../public/uploads/thu_hoach/<?php echo $thu_hoach_By_rau_id['image_thu_hoach']?>" width="100px" height="100px"> 
                                    <?php } ?>   
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Ảnh QRCode</label>
                                <div class="col-sm-10">
                                    <?php if(!empty($thu_hoach_By_rau_id['qrcode'])){ ?>
                                    <img alt="" src="../public/uploads/qrcode/<?php echo $thu_hoach_By_rau_id['qrcode']?>" width="100px" height="100px">   
                                    <?php } ?>  
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
