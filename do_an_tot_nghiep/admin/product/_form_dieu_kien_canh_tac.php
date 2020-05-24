<div class="row form-add">
    <div class="col-md-12">
        <h2 class="text-center" style="font-family: cursive;margin-bottom: 50px">ĐIỀU KIỆN CANH TÁC</h2>
        <div>
            <a href="javascript:void(0)" class="btn btn-success pull-right btn_add_dk">Thêm điều kiện</a>

            <?php  require_once __DIR__. DIRECTORY_SEPARATOR."../message/message.php";  ?>
        </div>
        <div class="clearfix" style="margin-bottom: 30px"></div>
        <?php if($show_next){?>
        <form action="" method="POST" enctype="multipart/form-data">
        <?php }?>
            <input type="hidden" name="number_row" value="<?php echo postInput('number_row')?postInput('number_row'):1 ?>" class="number_row">
            <div class="list_condition">
                <?php for($i = 0; $i < $number_row ; $i++) { ?>
                <div class="form-group row">
                    <div class="col-sm-3 col-form-label">
                        <input type="text" class="form-control" name="condition_name[]" placeholder="Nhập tên điều kiện" <?php if(!empty($inputs['condition_name'][$i])){ ?> value="<?php echo $inputs['condition_name'][$i] ?>" <?php } ?> >
                        <?php 
                        if(isset($errors['condition_name'][$i])){ ?>
                            <p class="text-danger">
                                <?php echo $errors['condition_name'][$i] ?>
                            </p>
                        <?php } ?>
                        
                    </div>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="inputEmail3" placeholder="Nhập điều kiện" name="condition[]" <?php if(!empty($inputs['condition'][$i])){ ?> value="<?php echo $inputs['condition'][$i] ?>" <?php } ?> >
                        <?php 
                        if(isset($errors['condition'][$i])){ ?>
                            <p class="text-danger">
                                <?php echo $errors['condition'][$i] ?>
                            </p>
                        <?php } ?>
                    </div>
                    <div class="col-sm-2">
                        <a href="javascript:void(0)" class="btn btn-primary delete_condition">Xóa điều kiện</a>
                    </div>

                </div>
                <?php } ?>

            </div>
            <?php if($show_next){ ?>
            <div>
                <button class="btn btn-warning pull-right save_condition" style="padding:8px 25px">Next</button>
            </div>
            <?php }?>

    	
             
    	<?php if($show_next){?>  
    	</form>
        <?php } ?>
        <div class="more_condition" hidden>
            <div class="form-group row">
                <div class="col-sm-3 col-form-label">
                    <input type="text" class="form-control" name="condition_name[]" placeholder="Nhập tên điều kiện">
                </div>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="inputEmail3" placeholder="Nhập điều kiện" name='condition[]'>
                </div>
                <div class="col-sm-2">
                    <a href="javascript:void(0)" class="btn btn-primary delete_condition">Xóa điều kiện</a>
                </div>
            </div>
        </div>
    </div>
</div>