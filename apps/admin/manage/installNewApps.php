<?php

	$appPath=APP_PATH;

	$lsResult=array_slice(scandir($appPath), 2);

	

	$apps=array();

	foreach($lsResult as $row){

		$appConfigFile=$appPath.$row.'/config.php';

		$appConfig=array("type"=>"Application","userType"=>"user");

			if(file_exists($appConfigFile)){

				include($appConfigFile);

				$appConfig;

			}

		if(file_exists($appPath.$row.'/menu.php')){

			$apps[]=array("name"=>$row,"config"=>$appConfig);

			

		}	

	}
	// print_r($apps);
	

	update_system_config("applications",json_encode($apps));

	sleep(1);

	print 1;

?>