<?php

    require_once  "../autoload/autoload.php";
    
    $id = (int)getInput('id');

    $sql = "SELECT * FROM rau WHERE rau.deleted_at='0' AND rau.id = ".$id;
      
    $lists = $db->fetchSql($sql);
    echo json_encode($lists);

?>