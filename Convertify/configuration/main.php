<!DOCTYPE html>

<html lang='en'>
	<head>
		<title>Convertify</title>

		<meta charset='UTF-8'>

		<link rel='Shortcut Icon' type='image/png' href='images/favicon.png'>

		<link rel='stylesheet' type='text/css' href='css/global.css'>

		<noscript>
			<meta http-equiv="refresh" content="0;url=../errors/javascript.html">
		</noscript>

		<script src='js/jquery.js'></script>
		<script src='js/jquery.zclip.js'></script>
	</head>

	<body ontouchstart=''>
		<div id='loadScript' style='display: none;'>.</div>

		<div align='center' id='wrapper'>
			<a href=''>
				<img src='images/logo.png'>
			</a>

			<br>


			<form id='convertForm' action='' method='POST' enctype='multipart/form-data'>
				<?php

					error_reporting(E_ERROR);

					require_once("mysql.php");

					date_default_timezone_set("America/Los_Angeles");

					function cookie($name, $contents, $time = 2147483646)
					{
						return setcookie($name, $contents, time() + $time);
					}

					function refreshPage()
					{
						echo "<meta http-equiv='REFRESH' content='0;url='>";
						exit;
					}

					function alert($message)
					{
						echo
						"<script>
							alert('$message');
						</script>";
					}

				?>