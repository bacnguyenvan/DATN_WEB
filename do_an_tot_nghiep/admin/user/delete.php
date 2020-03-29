<?php 
	
	require_once  "../autoload/autoload.php";
	$active = 'admin';
	$id = (int)getInput('id');

	$deleteById = $db->deleteDB('admin',$id);
	
	if($deleteById){
		$_SESSION['success'] = 'Xóa thành công';
		redirectStyle('user');
	}else{
		$_SESSION['error'] = 'Xóa thất bại';
		redirectStyle('user');
	}




?>