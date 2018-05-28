<?php
	class Entities extends SQLCommon {
		
		function select($search='', $offset=0, $byPage=10, $return='') {
    		$sql      = "SELECT * ";
    		$sql     .= "FROM entities ";
    		$sql     .= "WHERE 1 ";
    		$sql     .= ($search != '') 				?  	"AND entities.entity LIKE '%".$search."%' "		: "";
			$sql     .= "ORDER BY entity ASC ";
			$sql     .= ($return!= 'mynumrows') ? 	"LIMIT $offset, $byPage " 											: "";
    		$query    = $this->myquery($sql);
        
			if($return == "query")       return $query;
			if($return == "mynumrows")   return $this->mynumrows($query);
			return;
		}


		function selectRequested($state=-1, $return=null) {
            
            $sql   		= ($return == 'num_rows') ? "SELECT COUNT(EN.idEntity) AS cantidad " : "SELECT EN.idEntity, EN.entity, CO.host, CO.lastStatus AS status, CT.command ";
			$sql     .= "FROM entities EN ";
			$sql     .= "INNER JOIN commands CO ON CO.idEntity  = EN.idEntity ";
			$sql     .= "INNER JOIN commands_types CT ON CT.idCommandType = CO.idCommandType ";
			$sql     .= "WHERE 1 ";
			$sql     .= ($state != -1) ? "AND EN.state = ". $state ." " : "";
            $sql     .= "AND EN.idClient = ". $_SESSION['user']['idClient'] . " ";
			
			$query 		= $this->myquery($sql);
		    if($return == "query")       return $query;
		    if($return == "num_rows")    return $this->mynumrows($query);
		    if($return == "fetch_array") return $this->myfetcharray($query);
		        
		    return;
		}
		
		function get($entity_id=0, $return='') {
			$sql      = "SELECT EN.*, CO.host, CO.content, CO.interval, CT.*  ";
 	 		$sql     .= "FROM entities EN ";
 	 		$sql     .= "LEFT JOIN commands CO ON CO.idEntity  = EN.idEntity ";
			$sql     .= "LEFT JOIN commands_types CT ON CT.idCommandType = CO.idCommandType ";
			$sql     .= "WHERE EN.idEntity = " . $entity_id . " ";
			$query    = $this->myquery($sql);

			if($return == "query")         return $query;
			if($return == "myfetcharray")  return $this->myfetcharray($query);
			if($return == "mynumrows")     return $this->mynumrows($query);
			return;
		}
		
		function insert($entity='', $return='') {
			$arrExist    = $this->getExist($entity);
			$exists      = $arrExist[0];

			if( $exists == 0 ) {
				$sql      = "INSERT INTO entities ";
				$sql     .= "(idClient, entity, state) ";
				$sql     .= "VALUES ";
				$sql     .= "(".$_SESSION['idClient'].", ".$entity."', 1) ";
		
				$query    = $this->myquery($sql);
				
				if($return == "query")          return $query;
				if($return == "my_insert_id")   return $this->myinsertid();
			} else {
			  return 0;
			}
		}
    
		function update($entity_id=0, $entity='', $state=0) {
    		$sql      = "UPDATE entities ";
			$sql     .= "SET entity = '" . $entity . "' ";
			$sql     .= ",state = " . $state . " ";
			$sql     .= "WHERE idEntity = " . $entity_id . " ";
			
            $query    = $this->myquery($sql);
        }
    
		function getExist($entity='') {

    		$sql      = "SELECT COUNT(idEntity) AS cantidad ";
			$sql     .= "FROM entities ";
			$sql     .= "WHERE entity = '$entity' ";
			
			$query    = $this->myquery($sql);
			return $this->myfetchrow($query);
		}
		
		function countEntities($state=-1, $return='') {
			$sql   	  = "SELECT COUNT(EN.entity) AS estities ";
			$sql     .= "FROM entities EN ";
			$sql     .= "INNER JOIN commands CO ON CO.idEntity  = EN.idEntity ";
			$sql     .= "INNER JOIN commands_types CT ON CT.idCommandType = CO.idCommandType ";
			$sql     .= "WHERE 1 ";
			$sql     .= ($state !=-1) ? "AND EN.state = " . $state . " " : "";
			
			$query 		= $this->myquery($sql);
			if($return == "query")       return $query;
			if($return == "num_rows")    return $this->mynumrows($query);
			if($return == "fetch_array") return $this->myfetcharray($query);
			
			return;
		}
	}
?>