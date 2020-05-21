<?php

    require_once  "../autoload/autoload.php";
    
    $id = (int)getInput('id');
    $productById = $db->fetchID('rau',$id); 
    $product_thu_hoach = $db->fetchOne('thu_hoach'," deleted_at = 0 AND rau_id = $id ");

    // dieu kien canh tac
    
    $sql = "SELECT ten_dieu_kien,dieu_kien FROM dieu_kien_canh_tac 
    WHERE deleted_at = 0 AND rau_id = $id";
    $data['dieu_kien_canh_tac'] = $db->fetchSql($sql);

    // thong so sensor
    $sql_temperature = "SELECT ROUND(avg(nhiet_do),2) as value_temperature_avg, day FROM thong_so_moi_truong GROUP BY day ";
    $data['temperature'] = $db->fetchSql($sql_temperature);

    $sql_soil_moist = "SELECT ROUND(avg(do_am),2) as value_soil_moist_avg, day FROM thong_so_moi_truong GROUP BY day ";
    
    $data['soil_moist'] = $db->fetchSql($sql_soil_moist);

    $getData = array_merge($productById,$product_thu_hoach,$data);      
    echo json_encode($getData);

?>