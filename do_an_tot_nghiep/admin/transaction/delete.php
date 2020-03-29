<?php 
	
	require_once  "../autoload/autoload.php";
	$active = 'transaction';
	$id = (int)getInput('id');

	$deleteById = $db->deleteDB('transaction',$id);
	
	if($deleteById){
		$_SESSION['success'] = 'Xóa thành công';
		redirectStyle('transaction');
	}else{
		$_SESSION['error'] = 'Xóa thất bại';
		redirectStyle('transaction');
	}




?>