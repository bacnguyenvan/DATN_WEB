<?php
    $active = 'transaction'; 
    require_once  "../autoload/autoload.php";
    
    if(isset($_GET['page'])){
        $p = $_GET['page'];
    }else{
        $p = 1;
    }

    $sql = "SELECT transaction.*,users.name as Username,users.phone as phone,users.email as email FROM transaction INNER JOIN users ON transaction.user_id=users.id ORDER BY id DESC";

    $transaction = $db->fetchJone('transaction',$sql,$p,5,true);
    
    if(isset($transaction['page'])){
        $page_number = $transaction['page'];
        unset($transaction['page']);
    }

    $total_page = $page_number;
    $total_product = count($db->fetchAll_condition('products',"deleted_at=0"));

?>

<?php require_once "../header.php" ?>
    
        <!-- content -->
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Danh sách đơn hàng
                           
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
                                        <span style="text-decoration: underline;">Tổng đơn hàng:</span>
                                        <span> <?php echo count($transaction)?> </span>
                                    </h3> 
                                </div>
                                <thead>
                                    <tr>
                                        <th>Stt</th> 
                                        <th>Tên</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th style="text-align: center;">Trạng thái</th>
                                        <th>Ngày đặt</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $stt=1;
                                     foreach($transaction as $item) { ?>
                                        <tr>
                                            <td><?php echo $stt ?></td>
                                            
                                            <td>
                                                <?php 
                                                    echo $item['Username']
                                                ?>
                                                
                                            </td>
                                            <td>
                                                <?php 
                                                    echo $item['email']
                                                ?>
                                            </td>
                                            <td><?php echo $item['phone'] ?></td>
                                            <td style="text-align: center;">
                                                <a href="status.php?id=<?php echo $item['id'] ?>" class="btn <?php echo $item['status'] == 0?'btn-danger':'btn-info' ?> "> <?php echo $item['status'] == 0? 'Chưa xử lí':'Đã xử lí' ?> </a>
                                            </td>
                                            <td>
                                                <?php 
                                                    echo $item['created_at'];
                                                ?>
                                            </td>
                                            <td style="text-align: center;">
                                                
                                                
                                                <a id="<?php echo $item['id'] ?>" class="btn btn-warning btn_delete" href="delete.php?id=<?php echo $item['id'] ?>"><i class="fa fa-trash"></i> Xóa </a>
                                                
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
