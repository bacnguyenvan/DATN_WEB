<?php
    $active = 'admin'; 
    require_once  "../autoload/autoload.php";
    
    $users = $db->fetchAll('users');

?>

<?php require_once "../header.php" ?>
    
        <!-- content -->
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Danh sách user
                            <a href="add.php" class="btn btn-success">Thêm mới <i class="fa fa-plus-square"></i></a>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo base_url(). "admin" ?>">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Danh sách
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
                                <div class="">
                                    <h3>
                                        <span style="text-decoration: underline;">Tổng user:</span>
                                        <span> <?php echo count($users)?> </span>
                                    </h3> 
                                </div>
                                <thead>
                                    <tr>
                                        <th>Stt</th>
                                     
                                        <th>Thông tin</th>
                                        <th>Liên hệ</th>
                                        <th>địa chỉ</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $stt=1;
                                     foreach($users as $item) { ?>
                                        <tr>
                                            <td><?php echo $stt ?></td>
                                            
                                            <td>
                                                <i class="fa fa-user"></i>
                                                <?php 
                                                    echo $item['name']
                                                ?>
                                                
                                            </td>
                                            <td>
                                                <ul style="list-style: none">
                                                    <li><i class="fa fa-envelope"></i>&nbsp; <?php echo $item['email']?></li>
                                                    
                                                     <li><i class="fa fa-phone"></i>&nbsp; <?php echo $item['phone']?></li>
                                                </ul>
                                            </td>
                                            <td><?php echo $item['address'] ?></td>
                                            <td style="text-align: center;">
                                                
                                                <a class="btn btn-info" href="edit.php?id=<?php echo $item['id'] ?>" ><i class="fa fa-edit"></i></a>
                                                <a id="<?php echo $item['id'] ?>" class="btn btn-warning btn_delete" href="delete.php?id=<?php echo $item['id'] ?>"><i class="fa fa-trash"></i></a>
                                                
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
