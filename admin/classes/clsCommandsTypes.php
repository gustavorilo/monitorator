<?php
	class CommandsTypes extends SQLCommon {
		
		
		function select($search='', $offset=0, $byPage=10, $return='') {
			$sql      = "SELECT * ";
			$sql     .= "FROM commands_types ";
			$sql     .= "WHERE 1 ";
			$sql     .= ($search != '') 				?  	"AND commands_types.command LIKE '%".$search."%' "		: "";
			$sql     .= "ORDER BY command ASC ";
			$query    = $this->myquery($sql);
			
			if($return == "query")       return $query;
			if($return == "mynumrows")   return $this->mynumrows($query);
			return;
		}
		
		function get($commandtype_id=0, $return='') {
			$sql      = "SELECT CT.*  ";
			$sql     .= "FROM commands_types CT ";
			$sql     .= "WHERE CT.idCommandType = " . $commandtype_id . " ";
			$query    = $this->myquery($sql);

			if($return == "query")         return $query;
			if($return == "myfetcharray")  return $this->myfetcharray($query);
			if($return == "mynumrows")     return $this->mynumrows($query);
			return;
		}
			
		function update($commandtype_id=0, $command='') {
			$sql      = "UPDATE commands_types ";
			$sql     .= "SET command = '" . $command . "' ";
			$sql     .= "WHERE idCommandType = " . $commandtype_id . " ";
			$query    = $this->myquery($sql);
		}
		
		function insert($command='', $return='') {
			$arrExist    = $this->getExist($command);
			$exists      = $arrExist[0];

			if( $exists == 0 ) {
				$sql      = "INSERT INTO commands_types ";
						$sql     .= "(command) ";
						$sql     .= "VALUES ";
						$sql     .= "('".$command."') ";
				
						$query    = $this->myquery($sql);
				
			  if($return == "query")          return $query;
			  if($return == "my_insert_id")   return $this->myinsertid();
			} else {
			  return 0;
			}
		}
		
		function getExist($command='') {

			$sql      = "SELECT COUNT(idCommandType) AS cantidad ";
			$sql     .= "FROM commands_types ";
			$sql     .= "WHERE command = '$command' ";
				
			$query    = $this->myquery($sql);
			return $this->myfetchrow($query);
		}
	}
?>