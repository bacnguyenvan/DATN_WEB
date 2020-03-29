<?php  
    
    if(!isset($_SESSION['admin_id'])){

        // header('location: http://kmtshop.byethost22.com/login/');
        // header('location: http://localhost/kmtshop/login/');
    }

    require_once "libraries/database.php";
   
    $db = new database;
    // $product_chua_xu_li = $db->fetchAll_condition('transaction'," status=0 AND deleted_at=0");



?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if($active == 'control'): echo '<link rel="icon" type="image/png" href="public/uploads/kmt.png"/>' ?>
    <?php else: echo '<link rel="icon" type="image/png" href="../public/uploads/kmt.png"/>'?>

    <?php endif ?>
        
    <title>
        
        <?php if($active== 'control'): echo 'Trang chủ' ?>
        <?php elseif ($active== 'loai_rau'): echo 'Loại rau' ?>
        <?php elseif ($active== 'rau'): echo 'Quản lí vườn rau' ?>
        <?php elseif ($active== 'admin'): echo 'Người dùng' ?>
        <?php elseif ($active== 'transaction'): echo 'Quản lí đơn hàng' ?>
        <?php endif ?>

    </title>


    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url() ?>admin/public/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    

    <link href="<?php echo base_url() ?>admin/public/css/sb-admin.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="<?php echo base_url() ?>admin/public/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="<?php echo base_url() ?>admin/public/jquery-confirm/jquery-confirm.css " rel="stylesheet">

    <?php if( isset($css) && $css)  echo "<link href='".base_url()."admin/public/css/style.css' rel='stylesheet' >" ?>

    <style type="text/css">
        .text-danger{
            color: red !important;
            font-size: 15px !important;
        }
    </style>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="">Xin chào <?php if(isset($_SESSION['admin_name'])) echo $_SESSION['admin_name'] ?></a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">

                <li class="dropdown inform_order">
                    <!-- <a href=""><i class="fa fa-bell"></i> <?php if ($product_chua_xu_li): ?> <span>Có <?php echo count($product_chua_xu_li)?> cây trồng chưa được xử lí QRCODE</span> <?php endif ?></a> -->
                    <a href=""><i class="fa fa-bell"></i> <span>Có 6 cây trồng chưa được xử lí QRCODE</span> </a>
                    
                </li>
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><?php if(isset($_SESSION['admin_name'])) echo $_SESSION['admin_name'] ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        

                        <li>
                            <!-- <a href="<?php echo base_url(). "login/dang-xuat.php"?>"><i class="fa fa-fw fa-power-off"></i> Đăng xuất</a> -->
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="<?php echo isset($active)&& $active=='control'?'active':'' ?> ">
                        <a href="<?php echo base_url(). "admin"?> "><i class="fa fa-fw fa-dashboard"></i> Bảng điều khiển</a>
                    </li>
                    <li>
                        <a href="<?php echo modules('chart')?>"><i class="fa fa-fw fa-bar-chart-o"></i>&nbsp;Biểu đồ</a>
                    </li>
                    <li class="<?php echo isset($active) && $active=='loai_rau' ?'active':'' ?>">
                        <a href=" <?php echo modules('categories')?> "><i class="fa fa-fw fa-table"></i> Danh sách loại rau</a>
                    </li>
                    <li class="<?php echo isset($active) && $active=='rau'?'active':'' ?>">
                        <a href="<?php echo modules('product') ?>"><i class="fa fa-fw fa-edit"></i> Quản lí vườn rau</a>
                    </li>


                    
                   

                    <!-- <li class="<?php echo isset($active) && $active=='admin' ?'active':'' ?>">
                        <a href=" <?php echo modules('user')?> "> <i class="fa fa-user"></i>&nbsp; Danh sách người dùng</a>
                    </li>

                    <li class="<?php echo isset($active) && $active=='transaction' ?'active':'' ?>">
                        <a href=" <?php echo modules('transaction')?> "> <i class="fa fa-shopping-cart"></i>&nbsp; Quản lí đơn hàng</a>
                    </li>  -->
                   
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>