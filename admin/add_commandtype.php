<?php
  @session_start();
  $arrClasses 	= array('CommandsTypes', 'Session');
	include('core.inc.php');
	
  if(empty($_SESSION['user']))	echo "<script type='text/javascript'>window.location='index.php';</script>";
	
	$command 				= (isset($_POST['command'])) 	? strtoupper($_POST['command'])	: '';
	
  $idCommandType	= $qCommandsTypes	= $CommandsTypes->insert($command, 'my_insert_id');
	echo $idCommandType;
?>