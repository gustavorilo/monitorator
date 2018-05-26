<?php
    //date_default_timezone_set('America/Argentina/Buenos_Aires');
    setlocale(LC_TIME, 'es_AR', 'spanish-ar', 'ar', 'es');  
    $arrClasses 	= array('ExecutedCommands', 'Commands', 'Session');
	include('core.inc.php');
	
    $qCommands = $Commands->selectCommandsEntitiesActive('query');
    while($row = $sqlCommon->myfetchassoc($qCommands)) {
        
        $tried		 		= 1;
		$status				= '';
		$tmpStatus   	= '';
		$response   	= '';
		$tmpTried			= '';
		
		$start_time 	= ( $row['lastExecutedCommand'] != '0000-00-00 00:00:00' ) ? $row['lastExecutedCommand'] : date('Y-m-d H:i:s');
		$end_time     = date('Y-m-d H:i:s');
		
		$intMinutes   = (strtotime($end_time) - strtotime($start_time)) / 60;
		
		//Verificamos intervalo para ejecutar el comando
		if( $row['interval'] <= $intMinutes ||  $row['lastExecutedCommand'] == '0000-00-00 00:00:00' ) {
		    
			$arrData		= $ExecutedCommands->lastTried($row['idCommand'], 'fetch_array');
			
			if( !empty($arrData['tried']) ) {
				$tmpStatus = $arrData['status'];
				$tmpTried	 = $arrData['tried'];
				$tried  	 = ( $arrData['tried'] >= 3 )		? 1 : $arrData['tried'] + 1;
			}
			
			$arrCmd 		= $Commands->execute($row['command'], $row['content'], $row['host'], $tried, $tmpStatus);
			
			if( !empty($arrCmd['status']) ) {
				$status 	= $arrCmd['status'];
				if( $status == 'ok' ) {
                    
                    $response = (!empty($arrCmd['response'][0])) ? $arrCmd['response'][0] : '';
					$response = (!empty($arrCmd['response'][1])) ? $arrCmd['response'][1] : $response;
                    $response = (!empty($arrCmd['response']))    ? $arrCmd['response']    : $response;
				} else {	
					$response = $arrCmd['response'];
				}
			}
			$newDateCron	= $end_time;
			
			$ExecutedCommands->insert($row['idCommand'], $newDateCron, $tried, $response, $status);
			$Commands->updateExecute($row['idCommand'], $newDateCron, $status);
		}
	}
?>