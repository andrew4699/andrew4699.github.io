<?php

	class Page
	{
		function Redirect($page, $time = 0)
		{
			echo "<meta http-equiv='Refresh' content='$time; url=$page'>";
			exit;
		}

		function SetCookie($name, $value)
		{
			return setcookie($name, $value, time() + 2592000);
		}
	}

?>