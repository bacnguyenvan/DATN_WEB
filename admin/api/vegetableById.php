<?php

    require_once  "../autoload/autoload.php";
    
    $id = (int)getInput('id');
    // $productById = $db->fetchID('rau',$id); 
    $sql = "SELECT thu_hoach.image_thu_hoach as harvestImage, rau.id, rau.name, rau.price, rau.nha_cung_cap as provider, rau.provide_location as provideLocation, rau.created_at as dateSelectBreed, rau.image_giong as breedImage,
    thu_hoach.nha_san_xuat as grower, thu_hoach.plant_location as plantLocation, rau.ngay_trong as plantDate, thu_hoach.ngay_thu_hoach as harvestDate, thu_hoach.san_luong as number FROM rau LEFT JOIN thu_hoach ON rau.id = thu_hoach.rau_id WHERE rau.deleted_at = 0 and rau.id = " . $id;
    $productById = $db->fetchSql($sql);  
   // $product_thu_hoach = $db->fetchOne('thu_hoach'," deleted_at = 0 AND rau_id = $id ");

    // dieu kien canh tac
    
    // $sql = "SELECT ten_dieu_kien,dieu_kien FROM dieu_kien_canh_tac 
    // WHERE deleted_at = 0 AND rau_id = $id";
    // $data['dieu_kien_canh_tac'] = $db->fetchSql($sql);

    // thong so sensor
    $sql_temperature = "SELECT ROUND(avg(nhiet_do),2) as temperature, ROUND(avg(do_am),2) as humidity, day as date FROM thong_so_moi_truong climate GROUP BY day";
    $data['climate'] = $db->fetchSql($sql_temperature);

    // $sql_soil_moist = "SELECT ROUND(avg(do_am),2) as value, day as date FROM thong_so_moi_truong GROUP BY day ";
    
    // $data['soil_moist'] = $db->fetchSql($sql_soil_moist);
    $getData = array_merge($productById[0], $data);      
 //   _debug($getData);
 //   _die();
    echo json_encode($getData);

?>