<?php
    require_once  "../autoload/autoload.php";
    
    
    // $sql = "SELECT * FROM rau WHERE rau.deleted_at='0' ";
   	$sql = "SELECT rau.id,rau.name,rau.provide_location as provideLocation,rau.price, thu_hoach.image_thu_hoach as harvestImage FROM rau  JOIN thu_hoach ON rau.id = thu_hoach.rau_id WHERE rau.deleted_at = 0"; 
    $lists = $db->fetchSql($sql);
    echo json_encode($lists);

?>