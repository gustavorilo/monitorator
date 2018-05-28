<?php
	class Clients extends SQLCommon {
		
		function selectClientsActive($return='') {
			
			$sql   	  = "SELECT CL.idClient, CL.client ";
			$sql     .= "FROM clients CL ";
			$sql     .= "WHERE 1 ";
			$sql     .= "AND CL.state = 1 ";
			
			$query 		= $this->myquery($sql);
			if($return == "query")       return $query;
			if($return == "num_rows")    return $this->mynumrows($query);
			if($return == "fetch_array") return $this->myfetcharray($query);
			
			return;
		}
	}
?>