<?php

	if(!$_POST['email'] || !$_POST['body'])
	{
		exit;
	}

	$mainSettings = array("navigation" => false);

	require_once("../includes/functions.php");
	require_once("../includes/mysql.php");
	
	if(!$_POST['name'])
	{
		$_POST['name'] = "Annonymous";
	}

	/*sendMail(
		array("andrew_guterman@yahoo.com", "andrew_guterman1@gmail.com"),
		"(CM) " . $_POST['name'] . " - " . $_POST['email'],
		$_POST['body']);*/

	$mConnection->query("INSERT INTO `contact` (`email`, `name`, `message`)
						VALUES ('" . MySQL::Escape($_POST['email']) . "', '" . MySQL::Escape($_POST['name']) . "', '" . MySQL::Escape($_POST['body']) . "')");

	echo "OK";

?>