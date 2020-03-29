<?php 
	
	require_once '../autoload/autoload.php';

	$id = (int)getInput('id');
	$EditCategory = $db->fetchID('category',$id);

	$home = $EditCategory['home']==0? 1:0;
	$update = $db->updateDB('category',['home'=>$home],['id'=>$id]);
	if($update){
		$_SESSION['success'] = 'Cập nhật thành công';
		redirectStyle('categories');
	}else{
		$_SESSION['error'] = 'Cập nhật thất bại';
		redirectStyle('categories');
	}



?>