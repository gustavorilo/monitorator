<?php
    class SQLCommon {
        public function myconnect($dbName=null, $dbHost=null, $dbUser=null, $dbPass=null) {
            $conn	= @mysql_connect($dbHost, $dbUser, $dbPass, $dbName);
			mysql_set_charset('utf8', $conn);
            $linkDb = mysql_select_db($dbName, $conn);
		}
	
		public function myquery($sql) {
            return mysql_query($sql);	
		}
	
		public function myresult($query=null, $indice=0, $columna=null) {
			return @mysql_result($query, $indice, $columna);		
		}
	
		public function myfetchassoc($query=null) {
			return mysql_fetch_assoc($query);
		}
	
		public function myfetcharray($query=null) {
			return mysql_fetch_array($query);
		}
	
		public function myfetchobject($query=null) {
			return mysql_fetch_object($query);	
		}
        
        public function myfetchrow($query=null) {
    		return mysql_fetch_row($query);	
		}
        
		
		public function mynumrows($query=null) {
			return mysql_num_rows($query);	
		}
	
		public function myinsertid() {
			return mysql_insert_id();	
		}
	
		public function myaffectedrows() {
			return mysql_affected_rows();
		}
		
		public function pr($arrD=array(), $msg=null) {
			
			echo '<br><br>--------------<br>' . $msg;
			echo '<pre>';
			print_r($arrD);
			echo '</pre>';
			echo $msg . '<br>--------------<br><br>';
		}
	}
?>