<!DOCTYPE html>

<html lang='en'>
	<head>
		<?php

			error_reporting(E_ERROR | E_WARNING);

			$pageTitles = parse_ini_file("configuration/pagetitles.ini", true, INI_SCANNER_RAW);

			$currentPage = basename($_SERVER['SCRIPT_NAME']);
			$currentPage = str_replace(".php", "", $currentPage);

			if(!$pageTitles[$currentPage])
			{
				$currentPage = "default";
			}

		?>

		<title><?=$pageTitles[$currentPage]; ?></title>

		<meta charset='UTF-8'>

		<meta name='keywords' content='Key,Words,Here'>
		<meta name='description' content='This is my site description'>
		<meta name='author' content='Andrew Guterman'>

		<link rel='Shortcut Icon' href='images/favicon.png'>

		<link rel='stylesheet' href='css/main.css'>

		<link href='//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css' rel='stylesheet'>

		<link href='http://fonts.googleapis.com/css?family=Roboto:500,900,400italic,100,300,300italic,400' rel='stylesheet'>
		<link href='http://fonts.googleapis.com/css?family=Questrial:500,900,400italic,100,300,300italic,400' rel='stylesheet'>

		<script src='js/plugins/jquery.js'></script>
		<script src='js/plugins/ui.js'></script>
	</head>

	<body ontouchstart=''>
		<?php

			session_start();

			if(!isset($mainSettings['mysql']) || $mainSettings['mysql'])
			{
				require_once("mysql.php");
			}

			if(!isset($mainSettings['functions']) || $mainSettings['functions'])
			{
				require_once("functions.php");
			}

			if(!isset($mainSettings['navigation']) || $mainSettings['navigation'])
			{
				require_once("navigation.php");
			}

		?>