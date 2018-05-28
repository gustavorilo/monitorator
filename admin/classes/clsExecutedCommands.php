<?php
	class ExecutedCommands extends SQLCommon {
		
		function insert($command_id=0, $date='', $tried=1, $response=array(), $status='', $return='') {
			
			$sql      = "INSERT INTO executed_commands ";
			$sql     .= "(idCommand, date, tried, response, status) ";
			$sql     .= "VALUES ";
			$sql     .= "(" . $command_id . ", '" . $date . "', " . $tried . ", '" . $response . "', '" . $status . "') ";
	
			$query    = $this->myquery($sql);
			
			if($return == "query")          return $query;
			if($return == "my_insert_id")   return $this->myinsertid();
			return;
		}
		
		function  lastTried($command_id, $return='') {
			
			$sql      = "SELECT tried, status ";
			$sql     .= "FROM executed_commands ";
			$sql     .= "WHERE idCommand = " . $command_id . " ";
			$sql     .= "ORDER BY idExecuteCommand DESC ";
			$sql     .= "LIMIT 0, 1";
			
			$query    = $this->myquery($sql);
			
			if($return == "query")       return $query;
			if($return == "num_rows")    return $this->mynumrows($query);
			if($return == "fetch_array") return $this->myfetcharray($query);
			
			return;			
		}
	}
?>