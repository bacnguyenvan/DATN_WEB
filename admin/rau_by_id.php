<?php  
	require_once  "autoload/autoload.php";
    
  
    $id = (int)getInput('id');
    $rauById = $db->fetchID('rau',$id); 
  
    
    echo json_encode($rauById);



?>