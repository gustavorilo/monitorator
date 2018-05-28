<?php
	class Commands extends SQLCommon {
		
		function selectCommandsEntitiesActive($return='') {
			
			$sql   	  = "SELECT CT.command, CO.content, CO.idCommand, CO.host, CO.interval, CO.lastExecutedCommand ";
			$sql     .= "FROM commands CO ";
			$sql     .= "INNER JOIN commands_types CT ON CT.idCommandType = CO.idCommandType ";
			$sql     .= "INNER JOIN entities EN ON CO.idEntity = EN.idEntity ";
			$sql     .= "WHERE 1 ";
			$sql     .= "AND EN.state = 1 ";
			
            $query 		= $this->myquery($sql);
			if($return == "query")       return $query;
			if($return == "num_rows")    return $this->mynumrows($query);
			if($return == "fetch_array") return $this->myfetcharray($query);
			
			return;
		}
        
        function insert($entity_id=0, $host='', $content='', $idCommandType=0, $interval=5) {
            $sql      = "INSERT INTO commands ";
    		$sql     .= " (`idEntity`, `host`, `content`, `idCommandType`, `interval`) ";
            $sql     .= "VALUES (" . $entity_id . ", '" . $host . "',  '" . $content . "'," . $idCommandType . "," . $interval . ") ";
            
			$query    = $this->myquery($sql);
        }
		
		function update($entity_id=0, $host='', $content='', $idCommandType=0) {
    		$sql      = "UPDATE commands ";
			$sql     .= "SET host = '" . $host . "' ";
            $sql     .= ",content = '" . $content . "' ";
			$sql     .= ",idCommandType = " . $idCommandType . " ";
			$sql     .= "WHERE idEntity = " . $entity_id . " ";
            
			$query    = $this->myquery($sql);
            if( $this->myaffectedrows() == 0 )
                $this->insert($entity_id, $host, $content, $idCommandType);
		}
		
		function updateExecute($command_id=0, $lastexecuteCommand='', $lastStatus='ok') {
    		
			$sql      = "UPDATE commands ";
			$sql     .= "SET lastExecutedCommand = '" . $lastexecuteCommand . "' ";
			$sql     .= ",lastStatus = '" . $lastStatus . "' ";
			$sql     .= "WHERE idCommand = " . $command_id . " ";
			$query    = $this->myquery($sql);
		}
        
        function ping($host, $port, $timeout) 
        { 
          $tB = microtime(true); 
          $fP = fSockOpen($host, $port, $errno, $errstr, $timeout); 
          if (!$fP) { return "down"; } 
          $tA = microtime(true); 
          return round((($tA - $tB) * 1000), 0)." ms"; 
        }

		function execute($command=null, $content=null, $parameters=null, $tried=1, $statusAnt='') {
			
			define('OK', 'ok');
			define('WARNING', 'warning');
			define('ERROR', 'error');
			
			$arrResponse 	= Array();
			$status 			= '';
			$response    	= '';
			
			switch($command) {
				
				case 'CURL':
					$response = shell_exec("curl $parameters");
				break;
				
				case 'GET':
					$response = @get_headers($parameters, 1);
					if( @strstr($response[0], "HTTP/1.1 200 OK") || @strstr($response[1], "HTTP/1.1 200 OK") ) {
                        $response = ($response[0] == "HTTP/1.1 200 OK") ? $response[0] : $response[1];
						$status = OK;
					} else {
						//No OK (fail)
						$response	= 'Host Name Could Not be Resolved';
						$status 	= ( $statusAnt == 'ok' || $tried == 1 )	?	WARNING	:	ERROR;
					}
				break;
				
				case 'PING':
                    
                    $parameters = str_replace('http://', '', $parameters);
                    $parameters = str_replace('https://', '', $parameters);
                    
                    $response = $this->ping($parameters, 80, 10);
                    if( $response != 'down' ) {
						$status = OK;
					} else {
						//No OK (fail)
						$response	= 'Host Name Could Not be Resolved';
						$status     = ( $statusAnt == 'ok' || $tried == 1 )	?	WARNING	:	ERROR;
					}	
				break;
				
				case 'TELNET':
				break;
                
                case 'TEXT ON PAGE':
    				$response = @file_get_contents($parameters, 1);
                    
                    if(stristr($response, $content, false)) {
                    	$response   = 'String: ' . $content;
                        $status     = OK;
					} else {
						//No OK (fail)
						$response	= 'String not found';
						$status     = ( $statusAnt == 'ok' || $tried == 1 )	?	WARNING	:	ERROR;
					}
				break;
				
				default:
				break;
			}
			$arrResponse['status'] 		= $status;
			$arrResponse['response'] 	= $response;
			
            return $arrResponse;
		}
	}
?>