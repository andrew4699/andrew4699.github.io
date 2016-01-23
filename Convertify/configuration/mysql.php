<?php

	$mysqlSettings[0]['hostname'] = "localhost";
	$mysqlSettings[0]['username'] = "Cuser";
	$mysqlSettings[0]['password'] = "asnaeb?25565CU";
	$mysqlSettings[0]['database'] = "Converter";

	$mysqlSettings[1]['hostname'] = "localhost";
	$mysqlSettings[1]['username'] = "root";
	$mysqlSettings[1]['password'] = "";
	$mysqlSettings[1]['database'] = "convertify";

	for($connectionIndex = 0; $connectionIndex > -1; $connectionIndex++)
	{
		if(!$mysqlSettings[$connectionIndex]['hostname'])
		{
			die("No connection could be established to MySQL.");
		}

		if(mysql_connect($mysqlSettings[$connectionIndex]['hostname'], $mysqlSettings[$connectionIndex]['username'], $mysqlSettings[$connectionIndex]['password']))
		{
			if(mysql_select_db($mysqlSettings[$connectionIndex]['database']))
			{
				break;
			}
		}
	}

	function escape($item)
	{ 
		if(get_magic_quotes_gpc())
		{ 
	    	$item = stripcslashes($item);
	    } 
	        
		return sanitizeText($item);
	}

	function sanitizeText($text)
	{ 
	    $text = str_replace("<", "&lt;", $text); 
	    $text = str_replace(">", "&gt;", $text); 
	    $text = str_replace("\"", "&quot;", $text); 
	    $text = str_replace("'", "&#039;", $text); 
	    
	    $text = addslashes($text); 
	    return $text; 
	}

	function unescape($text)
	{ 
	    $text =  stripcslashes($text); 

	    $text = str_replace("&#039;", "'", $text); 
	    $text = str_replace("&gt;", ">", $text); 
	    $text = str_replace("&quot;", "\"", $text);    
	    $text = str_replace("&lt;", "<", $text); 
	    return $text; 
	}

?>