<?php

    require_once  "../autoload/autoload.php";
    
    $id = (int)getInput('id');
    $productById = $db->fetchID('rau',$id); 
    $product_thu_hoach = $db->fetchOne('thu_hoach'," deleted_at = 0 AND rau_id = $id ");

    // dieu kien canh tac
    $sql = "SELECT ten_dieu_kien,dieu_kien FROM dieu_kien_canh_tac 
    WHERE deleted_at = 0 AND rau_id = $id";
    $data['dieu_kien_canh_tac'] = $db->fetchSql($sql);


    $getData = array_merge($productById,$product_thu_hoach,$data);      
    echo json_encode($getData);

?>