<?php 
    require_once  "../autoload/autoload.php";
    $active = 'admin'; // active
    $id = (int)getInput('id');
    $user = $db->fetchID('users',$id);
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $data = [
            'name' => postInput('name'),
            'email' => postInput('email'),
            'password' => md5(postInput('password')),
            'phone' => postInput('phone'),
            'address' => postInput('address')
        ];
        $errors=[];
        if(postInput('name')==''){
            $errors['name'] = 'Vui lòng nhập vào tên';
        }
        if(postInput('email')==''){
            $errors['email'] = 'Vui lòng nhập vào email';
        }
        if(postInput('password')==''){
            $errors['password'] = 'Vui lòng nhập mật khẩu';
        }
        
        if(postInput('address')==''){
            $errors['address'] = 'Vui lòng nhập địa chỉ';
        }
        
        
         
        if(empty($errors)){
           
            if(isset($_FILES['image'])){
                $file_name = $_FILES['image']['name'];
                $file_tmp = $_FILES['image']['tmp_name'];
                $file_error = $_FILES['image']['error'];

                if($file_error==0){
                    $part = IMAGE."user/";
                    $data['avatar'] = $file_name;
                } else{/*do nothing */}

            }else{/*do nothing */}

            $id_update = $db->updateDB('users',$data,['id'=>$id]);
            if($id_update){
                move_uploaded_file($file_tmp, $part.$file_name);
                $_SESSION['success'] = 'Sửa thông tin thành công';
                redirectStyle('user');
            }else{
                $_SESSION['error'] = 'Sửa thông tin thất bại';
                redirectStyle('user');
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
                            Sửa user
            
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo base_url()."admin"?>">Home</a>
                            </li>
                            <li class="">
                                <i class="fa fa-file"></i> User
                            </li>

                            <li class="active">
                                <i class="fa fa-plus-square"></i> Sửa
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
						    	<label for="inputEmail3" class="col-sm-2 col-form-label">Tên <span style="color: red">*</span></label>
							    <div class="col-sm-10">
							      <input type="text" class="form-control" placeholder="Nhập tên" name='name' value="<?php echo $user['name'] ?> ">
                                <?php if(isset($errors['name'])) {?>
                                    <p class="text-danger"> <?php echo $errors['name'] ?></p>
                                <?php }?>

							    </div>
							</div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Email <span style="color: red">*</span></label>
                                <div class="col-sm-10">
                                  <input  type="email" class="form-control" placeholder="Nhập email" name='email' value="<?php echo $user['email'] ?> ">
                                  <?php if(isset($errors['email'])) {?>
                                    <p class="text-danger"> <?php echo $errors['email'] ?></p>
                                <?php }?>
                                    
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Mật khẩu <span style="color: red">*</span></label>
                                <div class="col-sm-10">
                                  <input type="password" class="form-control" placeholder="Nhập mật khẩu" name='password' value="<?php echo $user['password'] ?> ">
                                    
                                    <?php if(isset($errors['password'])) {?>
                                    <p class="text-danger"> <?php echo $errors['password'] ?></p>
                                    <?php }?>
                                </div>
                            </div>

                            

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Phone <span style="color: red">*</span></label>
                                <div class="col-sm-4">
                                  <input type="number" min="1" class="form-control" placeholder="Nhập số điện thoại" name='phone' value="<?php echo $user['phone'] ?>">
                                  <?php if(isset($errors['phone'])) {?>
                                    <p class="text-danger"> <?php echo $errors['phone'] ?></p>
                                    <?php }?>
                                </div>

                                <label class="col-sm-2 col-form-label">Hình</label>
                                <div class="col-sm-4">
                                    <input type="file" name="image" class="form-control">
                                    <?php if(isset($errors['image'])) {?>
                                     <p class="text-danger"> <?php echo $errors['image'] ?></p>
                                    <?php }?>
                                    <img style="width: 40px;height: 40px;" src="../public/uploads/user/<?php echo $user['avatar'] ?>">
                                </div>
                            </div>

                             <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Address <span style="color: red">*</span></label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" placeholder="Nhập địa chỉ" name='address' value="<?php echo $user['address'] ?>" >
                                    <?php if(isset($errors['address'])) {?>
                                    <p class="text-danger"> <?php echo $errors['address'] ?></p>
                                    <?php }?>
                                </div>
                            </div>
                           <!-- session error check email exist -->
                            <?php  require_once __DIR__. DIRECTORY_SEPARATOR."../message/message.php";  ?>

						    <div class="form-group row">
							    <div class="col-sm-12">
							      <button type="submit" class="btn btn-primary submit-form" style="float: right">Cập nhật</button>
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
