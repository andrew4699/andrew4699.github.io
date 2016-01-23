<?php

	require_once("configuration/mysql.php");

	if(!file_exists("files/next"))
	{
		file_put_contents("files/next", 0);
	}

	$nextID = file_get_contents("files/next") + 1;
	file_put_contents("files/next", $nextID);

	file_put_contents("files/u$nextID", "" . $_POST['contents1'] . "\n" . $_POST['contents2'] . "");

	mysql_query("INSERT INTO `files` (`unqid`, `date`, `path`) VALUES ('" . escape($_COOKIE['unqid']) . "', '" . time() . "', 'files/u$nextID')");

?>