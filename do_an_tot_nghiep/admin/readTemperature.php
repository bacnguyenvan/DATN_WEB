<?php 
	require_once "autoload/autoload.php";
	if(isset($_GET['temperature']) && isset($_GET['humidity']) ) {

		$data =
                [
                    'nhiet_do' 	=> $_GET['temperature'],
                    'day'		=> date("d-m-y"),
                    'do_am' 	=> $_GET['humidity']
                ];

        // $data_ready = $db->fetchAll("thong_so_moi_truong");        
        // if(!empty($data_ready)){
        // 	$db->updateDB("thong_so_moi_truong",$data,['day'=>date("d")] );
        	
        // }else{
			$db->insertDB("thong_so_moi_truong",$data);
        // }
		
	}

	$sensor = $db->getLatest("thong_so_moi_truong");
	if(!empty($sensor)){
		echo $sensor['nhiet_do']."_".$sensor['do_am'];
	
	} else{
		echo "0_0";
	}

?>