<?php
	require_once  "../autoload/autoload.php";
	$active = 'product';

	$id = (int)getInput('id');

	// $deleteById = $db->deleteDB('products',$id);
	$deleteById = $db->updateDB('rau',['deleted_at'=>1],['id'=>$id]);
	$db->updateDB('thu_hoach',['deleted_at'=>1],['rau_id'=>$id]);
	$db->updateDB('dieu_kien_canh_tac',['deleted_at'=>1],['rau_id'=>$id]);

	if($deleteById){
		$_SESSION['success'] = 'Đã xóa thành công';
		redirectStyle('product');
	}else{
		$_SESSION['error'] = 'Xoá thất bại';
		redirectStyle('product');
	}



?>