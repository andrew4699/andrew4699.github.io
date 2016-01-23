<?php

	class MySQL
	{
		function Escape($item)
		{ 
			if(get_magic_quotes_gpc())
			{ 
		    	$item = stripcslashes($item);
		    } 
		        
			return MySQL::SanitizeText($item);
		}

		function Unescape($text)
		{ 
		    $text =  stripcslashes($text); 
		    $text = str_replace("&#039;", "'", $text); 
		    $text = str_replace("&gt;", ">", $text); 
		    $text = str_replace("&quot;", "\"", $text);    
		    $text = str_replace("&lt;", "<", $text); 
		    return $text; 
		}

		function SanitizeText($text)
		{ 
		    $text = str_replace("<", "&lt;", $text); 
		    $text = str_replace(">", "&gt;", $text); 
		    $text = str_replace("\"", "&quot;", $text); 
		    $text = str_replace("'", "&#039;", $text); 
		    $text = addslashes($text); 
		    return $text; 
		}
	}

?>