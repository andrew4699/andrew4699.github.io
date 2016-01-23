<?php

	class Account
	{
		function HashPassword($text)
		{
			for($hashIndex = 0; $hashIndex < 50; $hashIndex++)
			{
				$text = hash("whirlpool", $text);
			}

			return $text;
		}
	}

?>