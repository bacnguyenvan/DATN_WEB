<?php
	require_once  "../autoload/autoload.php";
	$active = 'product';

	$id = (int)getInput('id');

	// $deleteById = $db->deleteDB('products',$id);
	$deleteById = $db->updateDB('products',['deleted_at'=>1],['id'=>$id]);
	
	
	if($deleteById){
		$_SESSION['success'] = 'Đã xóa thành công';
		redirectStyle('product');
	}else{
		$_SESSION['error'] = 'Xoá thất bại';
		redirectStyle('product');
	}



?>