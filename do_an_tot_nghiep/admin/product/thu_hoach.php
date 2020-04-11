<?php 
    require_once  "../autoload/autoload.php";
    $active = 'rau'; // active 
    $css = true;
    

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
                            <input type="hidden" autocomplete="off" class="form-control" name="text_qrcode" style="border-radius: 0px; " placeholder="Text..." value="<?php echo $_SESSION['rau_id'] ?>" >
                            <br>
                            <div class="text-center">
                                <input type="submit" class="btn btn-md btn-danger text-center" value="Tạo QR CODE">
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
