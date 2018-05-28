<?php
	include_once('./classes/clsSQLCommon.php');
	$sqlCommon 	= new SQLCommon();
	
	//base64_encode(base64_encode(gethostbyaddr($_SERVER['REMOTE_ADDR'])));
	$_SERVER['HTTP_HOST'] = (!empty($_SERVER['HTTP_HOST'])) ? $_SERVER['HTTP_HOST'] : '';
	
	switch($_SERVER['HTTP_HOST']) {
 
		default:
  		    $dbhost = 'YOU_SERVER_HOST';
            $dbname = 'monitorator';
            $dbuser = 'YOU_DB_USERNAME';
	        $dbpass = 'YOU_DB_PASS';
      break;
  }

	define('DB_HOST', $dbhost);	
	define('DB_NAME', $dbname);	
	define('DB_USER', $dbuser);
	define('DB_PASS', $dbpass);
	
	$linkConn	= $sqlCommon->myconnect(DB_NAME, DB_HOST, DB_USER, DB_PASS);
        
	if(!empty($arrClasses) & is_array($arrClasses)) {
		foreach ($arrClasses as $class) {
			include('./classes/cls'.$class.'.php');
			$$class = new $class;
		}	
	}
?>
