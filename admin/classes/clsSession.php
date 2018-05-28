<?php
class Session {

		function init_session() {
			@session_start();
		}
		
		function user_session($idUser=0, $user='', $pass='', $fname='', $lname='', $email='', $state=0, $permissions='', $client='', $idClient=0) {
			$_SESSION['user'] = array(
					'idUser' 			=> $idUser,
					'user' 				=> $user,
					'pass'				=> $pass,
					'fname'				=> $fname,
					'lname'				=> $lname,
					'email'   		=> $email,
					'state'				=> $state,
					'permissions'	=> $permissions,			
					'client'			=> $client,
                    'idClient'    		=> $idClient
				);
		}

		function access($access='') {
			return (strpos($access, $_SESSION['user']['permissions']))	? 	1 	: 0;
		}

		function session_exist() {
			return (!empty($_SESSION['user']))	? 	1 	: 0;
		}

		function logout() {
            unset($_SESSION['user']);
            session_destroy();
    }
	}
?>