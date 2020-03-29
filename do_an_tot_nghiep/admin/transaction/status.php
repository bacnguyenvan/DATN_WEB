<?php 
	
	require_once '../autoload/autoload.php';

	$id = (int)getInput('id');
	$EditTransaction = $db->fetchID('transaction',$id);

	if(!$EditTransaction){
		$_SESSION['error'] = 'Dữ liệu không tồn tại';
		redirectStyle('transaction');
	}

	$status = $EditTransaction['status']==0? 1:0;
	$update = $db->updateDB('transaction',['status'=>$status],['id'=>$id]);
	if($update){
		$_SESSION['success'] = 'Cập nhật thành công';

		if($status==1){

			// trừ đi số lượng sản phẩm đang có
			$sql = "SELECT product_id , number FROM orders WHERE transaction_id = $id ";
			$Order = $db->fetchSql($sql);

			foreach($Order as $item){
				$id_product = (int)$item['product_id'];
				$product = $db->fetchID('products',$id_product);
				$number = $product['number'] - $item['number'];
				$up_pro = $db->updateDB('products',['number'=>$number,'pay'=>$product['pay']+1 ],['id'=>$id_product]);
			}

		}
		

		redirectStyle('transaction');
	}else{
		$_SESSION['error'] = 'Cập nhật thất bại';
		redirectStyle('transaction');
	}



?>