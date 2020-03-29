<?php
     
    require_once  "../autoload/autoload.php";
    $active = 'loai_rau';
    $categories = $db->fetchAll_condition('loai_rau',"deleted_at=0");
    

?>

<?php require_once "../header.php" ?>
    
        <!-- content -->
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Danh sách loại rau
                            <a href="add.php" class="btn btn-success">Thêm mới <i class="fa fa-plus-square"></i></a>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo base_url(). "admin" ?>">Trang chủ</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Loại rau
                            </li>

                        </ol>

                        <!-- success and error message -->
                        <?php  require_once __DIR__. DIRECTORY_SEPARATOR."../message/message.php";  ?>
                    </div>
                </div>
                <!-- /.row -->
                <!-- /.row -->
                

                <div class="row">
                    <div class="col-lg-12">
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Stt</th>
                                       
                                        <th>Tên</th>
                                        <th>Thời gian tạo</th>
                                        <th style="text-align: center;">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $stt=1;
                                     foreach($categories as $item) { ?>
                                        <tr>
                                            <td><?php echo $stt ?></td>
                                            
                                            <td><?php echo $item['name'] ?></td>
                                            <td><?php echo $item['created_at']?></td>
                                            <td style="text-align: center;">
                                                <a class="btn btn-info" href="edit.php?id=<?php echo $item['id'] ?>" ><i class="fa fa-edit"></i> Sửa</a>
                                                <a id="<?php echo $item['id'] ?>" class="btn btn-warning btn_delete" href="delete.php?id=<?php echo $item['id'] ?>"><i class="fa fa-trash"></i> Xóa</a>
                                            </td>
                                        </tr>
                                    <?php $stt++; } ?>
                                </tbody>
                            </table>
                           
                        </div>
                    </div>
                    
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- end content-->

<?php require_once __DIR__. DIRECTORY_SEPARATOR."../footer.php" ?>    
