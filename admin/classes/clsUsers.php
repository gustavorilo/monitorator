<?php
    Class Users extends SQLCommon
    {
        function validate_login($usuario='', $clave='', $idCliente=0, $return='') {
          $sql   		= "SELECT U.idUser, U.fname, U.lname, U.user, U.pass, U.state, U.email, U.state ";
          $sql     .= ", GROUP_CONCAT(PE.permission  SEPARATOR '|') AS permissions, CL.client, CL.idClient ";
    			$sql     .= "FROM users U ";
    			$sql     .= "INNER JOIN clients CL ON U.idClient  = CL.idClient ";
					$sql     .= "INNER JOIN users_permissions UP ON U.idUser  = UP.idUser ";
					$sql     .= "INNER JOIN permissions PE ON UP.idPermission = PE.idPermission ";
					$sql     .= "WHERE U.user = '".$usuario."' ";
					$sql 	   .= "AND U.pass = MD5('".$clave."') ";
					$sql 	   .= "AND CL.idClient = ".$idCliente." ";
					$sql 	   .= "AND CL.state = 1 ";
					
					$query 		= $this->myquery($sql);
          if($return == "query")       return $query;
          if($return == "num_rows")    return $this->mynumrows($query);
          if($return == "fetch_array") return $this->myfetcharray($query);
            
          return;
				}
		
				function updateUser($idUsuario=null,  $nombre=null, $apellido=null, $email=null) {
					$nombre     = mysql_real_escape_string($nombre);
					$apellido   = mysql_real_escape_string($apellido);
					$email     	= mysql_real_escape_string($email);
		
					$sql   		= "UPDATE usuarios ";
					$sql       .= "SET nombre = '".$nombre."', apellido = '".$apellido."', email = '".$email."' ";
					$sql       .= "WHERE idUsuario = '".$idUsuario."' ";
		
					$res 		= $this->myquery($sql);
					return $this->myaffectedrows();
				}
    }
?>