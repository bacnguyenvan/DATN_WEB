<?php 
    require_once  "../autoload/autoload.php";
    $active = 'rau'; // active 

    $id = (int)getInput('id');
    $productById = $db->fetchID('products',$id); 
    $categories = $db->fetchAll('category');
    

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        
        $data =
        [
            'name' => postInput('name'),
            'slug' => changeTitle(postInput('name')),
            'category_id' => postInput('category'),
            'price' => postInput('price'),
            'content' => postInput('content'),
            'number' => postInput('number'),
            'sale' => postInput('sale')
        ];
        $errors = [];
        
        if(postInput('name') == '')
        {
            $errors['name'] = 'Vui lòng nhập tên sản phẩm';
        }

        if(postInput('category') == '')
        {
            $errors['category'] = 'Vui lòng nhập loại danh mục';
        }

        if(postInput('price') == '')
        {
            $errors['price'] = 'Vui lòng nhập giá sản phẩm';
        }
        if(postInput('number') == '')
        {
            $errors['number'] = 'Vui lòng nhập số lượng';
        }
       
        
        if(empty($errors)){

            if(isset($_FILES['images'])){
                $file_name  = $_FILES['images']['name'];
                $file_tmp   = $_FILES['images']['tmp_name'];
                $file_type  = $_FILES['images']['type'];
                $file_erro  = $_FILES['images']['error'];

                if($file_erro == 0){
                    $part = IMAGE."products/";
                    $data['thunbar'] = $file_name;
                }
               
            }
            
            $id_update = $db->updateDB("products",$data,['id'=>$id]);
            if($id_update){
               
                move_uploaded_file($file_tmp, $part.$file_name);

                $_SESSION['success'] = "Cập nhật thành công";
                redirectStyle('product');
            }else{
                
                $_SESSION['error'] = "Cập nhật thất bại";
                redirectStyle('product');
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
                           Sửa thông tin sản phẩm
            
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Home</a>
                            </li>
                            <li class="">
                                <i class="fa fa-file"></i> Sản phẩm
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
                        
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Danh mục<span style="color: red">*</span></label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="category">
                                        <option value=""> --Choose category-- </option>
                                        <?php 
                                            foreach($categories as $item){ ?>

                                                <option value="<?php echo $item['id'] ?>" 
                                                        <?php if ($item['id'] == $productById['category_id']) {
                                                            echo "selected";
                                                            
                                                        } ?>
                                                    >

                                                    <?php echo $item['name'] ?>
                                                
                                                </option>

                                            <?php } ?>

                                        ?>
                                        
                                     </select>
                                     <?php if(isset($errors['category'])) { ?>
                                        <p class="text-danger">
                                            <?php echo $errors['category'] ?>
                                        </p>

                                  <?php } ?>
                                </div>
                            </div>

							<div class="form-group row">
						    	<label for="inputEmail3" class="col-sm-2 col-form-label">Tên<span style="color: red">*</span></label>
							    <div class="col-sm-10">
							      <input type="text" class="form-control" id="inputEmail3" placeholder="Nhập tên" name='name' 
                                  value="<?php echo $productById['name'] ?>">

                                  <?php 
                                        if(isset($errors['name'])){ ?>
                                            <p class="text-danger">
                                                <?php echo $errors['name'] ?>
                                            </p>
                                        <?php } ?>


                                   
							    </div>
							</div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Giá<span style="color: red">*</span></label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="inputEmail3" placeholder="Nhập giá" name='price' value="<?php echo $productById['price'] ?>">

                                  <?php if(isset($errors['price'])) { ?>
                                        <p class="text-danger">
                                            <?php echo $errors['price'] ?>
                                        </p>

                                  <?php } ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Số lượng<span style="color: red">*</span></label>
                                <div class="col-sm-10">
                                  <input type="number" min="1"  class="form-control" id="inputEmail3" placeholder="Nhập số lượng sản phẩm" name='number' value="<?php echo $productById['number']?>">

                                  <?php if(isset($errors['number'])) { ?>
                                        <p class="text-danger">
                                            <?php echo $errors['number'] ?>
                                        </p>

                                  <?php } ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Sale</label>
                                <div class="col-sm-4">
                                  <input type="number" min="0"  class="form-control" id="inputEmail3" placeholder="giảm giá" name='sale' value="<?php echo $productById['sale'] ?>">
                                </div>

                                <label class="col-sm-2 col-form-label">Hình</label>
                                <div class="col-sm-4">
                                    <input type="file" name="images" class="form-control" value="<?php echo $productById['thunbar'] ?>">
                                    <img style="width: 40px;height: 40px" src="../public/uploads/products/<?php echo $productById['thunbar'] ?>">
                                    <?php if(isset($errors['image'])) { ?>
                                        <p class="text-danger">
                                            <?php echo $errors['image'] ?>
                                        </p>

                                  <?php } ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Nội dung</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name='content' rows="5"><?php echo $productById['content'] ?>
                                        
                                    </textarea>
                                    <?php if(isset($errors['content'])) { ?>
                                        <p class="text-danger">
                                            <?php echo $errors['content'] ?>
                                        </p>

                                  <?php } ?>
                                </div>
                            </div>

                           

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
