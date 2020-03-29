<?php 
    require_once  "../autoload/autoload.php";
    $active = 'category'; // active

    $id = (int)(getInput('id')); 

    $editCategory = $db->fetchID('category',$id);
    if(!$editCategory){
        $_SESSION['error'] = 'Dữ liệu không tồn tại';
        redirectStyle('categories');
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
    	
    	$data =
    	[
    		'name' => postInput('name'),
            'title_unsigned' => changeTitle(postInput('name'))
    	];
    	$errors = [];
    	if(!$data['name']) $errors['name'] = 'Vui lòng nhập danh mục';

    	if(empty($errors)){
            
            if($editCategory['name'] != $data['name']){
                $checkUnique = $db->fetchOne("category","name = '".$data['name']."' ");
                if(count($checkUnique) > 0){
                    $_SESSION['error'] = "Danh mục đã tồn tại";
                }else{

                    $id_update = $db->updateDB('category',$data,array('id'=>$id));
                    if($id_update>0)
                    {
                        $_SESSION['success'] = 'Cập nhật thành công';
                        redirectStyle('categories');
                    }else{
                        
                        $_SESSION['error'] = 'Dữ liệu không thay đỗi';
                        redirectStyle('categories');
                    }

                }
            }else{
                $id_update = $db->updateDB('category',$data,array('id'=>$id));
                if($id_update>0)
                {
                    $_SESSION['success'] = 'Cập nhật thành công';
                    redirectStyle('categories');
                }else{
                    $_SESSION['error'] = 'Dữ liệu không thay đỗi';
                    redirectStyle('categories');
                }
            }

    	}
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
                            Sửa danh mục
            
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo base_url()."admin"?>">Home</a>
                            </li>
                            <li class="">
                                <i class="fa fa-file"></i> Danh mục
                            </li>

                            <li class="active">
                                <i class="fa fa-edit"></i> Sửa
                            </li>

                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <!-- /.row -->

                <div class="row form-add" style="margin-left: 15%;margin-right: 15%;width:70%">
                    <div class="col-md-12">
                        
                        <form action="" method="POST">
							<div class="form-group row">
						    	<label for="inputEmail3" class="col-sm-2 col-form-label">Tên danh mục</label>
							    <div class="col-sm-10">
							      <input type="text" class="form-control" id="inputEmail3" placeholder="Nhập tên danh mục" name='name' value="<?php echo $editCategory['name'] ?>">
							      <?php 
							      	 if(isset($errors['name'])): ?>
							      	 	<p class="text-danger"> 
							      	 		<?php echo $errors['name'] ?>
							      	 		
							      	 	</p>
							      	 
							      <?php endif ?>
							     <?php  require_once __DIR__. DIRECTORY_SEPARATOR."../message/message.php";  ?>
							    </div>
							</div>
						  
						    <div class="form-group row">
							    <div class="col-sm-10">
							      <button type="submit" class="btn btn-primary submit-form">Cập nhật</button>
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
