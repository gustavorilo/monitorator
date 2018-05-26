<?php
	@session_start();
	$arrClasses 	= array('Entities', 'Session');
	include('core.inc.php');
	
	if(empty($_SESSION['user']))	echo "<script type='text/javascript'>window.location='index.php';</script>";
	
	$entity 			= (isset($_POST['entity'])) 	? strtoupper($_POST['entity'])	: '';
	$idEntity   	= $qEntities	= $Entities->insert($entity, 'my_insert_id');
	echo $idEntity;
?>