<?php
  @session_start();
  $arrClasses 	= array('Session');
  include('core.inc.php');
      
  $Session->logout();
  echo "<script type='text/javascript'>  window.location='index.php'; </script>";
?>