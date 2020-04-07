<?php
    $active = 'rau'; 
    require_once  "../autoload/autoload.php";
    
    if(isset($_GET['page'])){
        $p = $_GET['page'];
    }else{
        $p = 1;
    }

    $sql = "SELECT rau.*,loai_rau.name as namecate FROM rau
            INNER JOIN loai_rau ON loai_rau.id = rau.loai_rau_id AND rau.deleted_at='0' ";
   
   
    $products = $db->fetchJone('rau',$sql,$p,5,true);
    
    $total_page = $products['page'];
    $total_product = count($db->fetchAll_condition('rau',"deleted_at=0"));
    array_shift($products); //reject 'page' got from JOIN

?>

<?php require_once "../header.php" ?>
    
        <!-- content -->
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Danh sách rau trồng
                            <a href="add.php" class="btn btn-success">Thêm mới <i class="fa fa-plus-square"></i></a>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo base_url(). "admin" ?>">Trang chủ</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Quản lí vườn rau
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
                            <!-- total user -->
                            <div class="">
                                <h3>
                                    <span style="text-decoration: underline;">Tổng số cây:</span>
                                    <span> <?php echo $total_product?></span>
                                </h3> 
                            </div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên</th>
                                        <th>Hình ảnh giống</th>
                                        <th>Loại rau</th>
                                        <th>Nhà cung cấp</th>
                                        <th>Ngày chọn giống</th>
                                        <th>QRCODE</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $stt=1;
                                     foreach($products as $item) { ?>
                                        <tr>
                                            <td><?php echo $stt?></td>
                                            <td><?php echo $item['name'] ?></td>
                                            <th><img alt="" src="../public/uploads/rau/<?php echo $item['image_giong']?>" width="80px" height="80px"></th>
                                            <td>
                                                <?php  echo (isset($item['namecate']))?$item['namecate']:'<span style="color:red">Đã xóa loại rau của rau này</span>' ?>
                                                
                                            </td>
                                            
                                            
                                            <td><?php echo $item['nha_cung_cap']?></td>
                                            <td><?php echo $item['ngay_chon_giong']?></td>
                                            <td>
                                                <img alt="" src="../public/uploads/qrcode/<?php echo $item['qrcode']?>" width="80px" height="80px">
                                            </td>
                                            <td style="text-align: center;">
                                                <a class="btn btn-primary" href="xem.php?id=<?php echo $item['id'] ?>" > Xem</a>
                                                <a class="btn btn-info" href="edit.php?id=<?php echo $item['id'] ?>" ><i class="fa fa-edit"></i> Sửa</a>
                                                <a id="<?php echo $item['id'] ?>" class="btn btn-warning btn_delete" href="delete.php?id=<?php echo $item['id'] ?>"><i class="fa fa-trash"></i> Xóa</a>
                                            </td>
                                        </tr>
                                    <?php $stt++; } ?>
                                </tbody>
                            </table>
                            <!-- paginate -->
                            <div class="pull-right">
                                <nav aria-label="Page navigation example">

                                  <ul class="pagination">
                                    <?php 
                                        
                                        $page_next =  $p+1;
                                        $page_prev =  $p-1 ;
                                    ?>
                                    <li class="page-item">
                                          <a class="page-link <?php echo ($page_prev<1)?'disable':''?> " href="<?php echo "?page=$page_prev" ?>" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                                <span class="sr-only">Previous</span>
                                          </a>
                                    </li>

                                   <?php 
                                        for($i = 1 ; $i <= $total_page ; $i++){
                                             ?>
                                            
                                            <li class="<?php echo ($i==$p)?'active':'' ?> " >
                                                <a href="?page=<?php echo $i ?>"> <?php echo $i ?> </a>
                                            </li>
                                       <?php }
                                       
                                   ?>
                                    
                                    <li class="page-item">
                                      <a class="page-link <?php echo ($page_next>$total_page)?'disable':''?> " href="<?php echo "?page=".$page_next ?>" aria-label="Next"  >
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                      </a>
                                    </li>

                                  </ul>

                                </nav>
                            </div>

                        </div>
                    </div>
                    
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- end content-->

<?php require_once __DIR__. DIRECTORY_SEPARATOR."../footer.php" ?>    
