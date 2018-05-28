<?php
	Class UsersPermissions extends SQLCommon
	{
		function delete($idUser=0, $idPermission=0)
		{
			$sql    = "DELETE FROM users_permissions ";
			$sql   .= "WHERE idUser = $idUser AND idPermission = $idPermission ";
			$this->query($sql);
		}
		
		function insert($idUser=0, $idPermission=0)
		{
			$sql    = "INSERT INTO users_permissions ";
			$sql   .= "(idUser, idPermission) VALUES ($idUser, $idPermission) ";
			$this->query($sql);
		}	
		
		function select($idUser=0, $idPermission=0, $return='')
		{
			$sql      = "SELECT * FROM users_permissions ";
			$sql     .= "WHERE 1 ";
			$sql     .= (!empty($idUser))? " AND idUser = '$idUser' " : "";
			$sql     .= (!empty($idPermission))? " AND idPermission = '$idPermission' " : "";
			$query    = $this->query($sql);
			
			if($return == "query")       return $query;
			if($return == "num_rows")    return @$this->num_rows($query);
			if($return == "fetch_assoc") return $this->fetch_assoc($query);
			
			return;
		}	
		
		function withPermission($idUser=0, $permission='', $return='')
		{
			$sql    = "SELECT * FROM users_permissions UP ";
			$sql   .= "INNER JOIN permissions P ON P.idPermission = UP.idPermission ";
			$sql   .= "WHERE UP.idUser = $idUser ";
			$sql   .= (!empty($permission)) ? "AND P.permission = '$permission'" : "";
			$query    = $this->query($sql);
			
			if($return == "query")       return $query;
			if($return == "num_rows")    return $this->num_rows($query);
			if($return == "fetch_assoc") return $this->fetch_assoc($query);
			
			return;
		}	
	}
?>