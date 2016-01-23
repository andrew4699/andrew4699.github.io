<?php

	$mysqlSettings = parse_ini_file($_SERVER['CONTEXT_DOCUMENT_ROOT'] . "/configuration/mysql.ini", true, INI_SCANNER_RAW);

	$mConnection = new mysqli($mysqlSettings['hostname'], $mysqlSettings['username'], $mysqlSettings['password'], $mysqlSettings['database']);

	if(!$mConnection->ping())
	{
		die("No connection could be established to MySQL.");
	}

?>