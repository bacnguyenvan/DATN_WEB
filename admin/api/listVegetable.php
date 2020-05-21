<?php
    require_once  "../autoload/autoload.php";
    
    
    // $sql = "SELECT * FROM rau WHERE rau.deleted_at='0' ";
   	$sql = "SELECT rau.*,thu_hoach.nha_san_xuat,thu_hoach.ngay_thu_hoach,thu_hoach.san_luong,thu_hoach.image_thu_hoach as hinh_anh_thu_hoach,thu_hoach.qrcode FROM rau
            LEFT JOIN thu_hoach ON rau.id = thu_hoach.rau_id WHERE rau.deleted_at = 0"; 
   
    $lists = $db->fetchSql($sql);
    echo json_encode($lists);

?>