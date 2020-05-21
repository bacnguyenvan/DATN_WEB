<?php  
	require_once  "autoload/autoload.php";
    
  
    $sql = "SELECT rau.*,loai_rau.name as namecate FROM rau
            INNER JOIN loai_rau ON loai_rau.id = rau.loai_rau_id AND rau.deleted_at='0' ";
   
   
    $lists = $db->fetchSql($sql);
    
    echo json_encode($lists);



?>