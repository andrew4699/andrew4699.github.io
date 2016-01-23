<?php

	require_once("configuration/main.php");

	if(!isset($_COOKIE['unqid']))
	{
		if(!file_exists("next"))
		{
			file_put_contents("next", 0);
		}

		$nextID = file_get_contents("next") + 1;
		file_put_contents("next", $nextID);

		cookie("unqid", hash("whirlpool", $nextID));
		refreshPage();
	}

	if(!isset($_COOKIE['drawdistance']) || !isset($_COOKIE['respawntime']) || !isset($_COOKIE['indent']) || !isset($_COOKIE['streamer']) || !isset($_COOKIE['comments']) || !isset($_COOKIE['vehiclecolors']))
	{
		cookie("drawdistance", 300);
		cookie("respawntime", 600);
		cookie("indent", 1);
		cookie("streamer", 0);
		cookie("comments", 1);
		cookie("vehiclecolors", 0);
		refreshPage();
	}

?>

<script>
	$(document).ready(function()
	{
		jQuery.fn.addHidden = function(name, value)
		{
		    return this.each(function()
		    {
		        var input = $("<input>").attr("type", "hidden").attr("name", name).val(value);
		        $(this).append($(input));
		    });
		};

		$('#convertArea').focus(function()
		{
			$('#convertAreaText, #pageSpaces').stop().fadeOut(300);
		});

		$('#convertArea').blur(function()
		{
			if(!$(this).val().length)
			{
				$('#convertAreaText, #pageSpaces').stop().fadeIn(300);
			}
		});

		$('#convertAreaText').click(function()
		{
			$(this).stop().fadeOut(200);
			$('#convertArea').focus();
		});

		$('#convertAreaF').focus(function()
		{
			$('#convertAreaTextF').stop().fadeOut(300);
		});

		$('#convertAreaF').blur(function()
		{
			if(!$(this).val().length)
			{
				$('#convertAreaTextF').stop().fadeIn(300);
			}
		});

		$('#convertAreaTextF').click(function()
		{
			$(this).stop().fadeOut(200);
			$('#convertAreaF').focus();
		});

		$('#changeAutoIndent').click(function()
		{
			if($(this).text().indexOf("Yes") >= 0)
			{
				$(this).html("Auto Indent: <span style='font-weight: bold; color: red;'>No</span>");
			}
			else
			{
				$(this).html("Auto Indent: <span style='font-weight: bold; color: green;'>Yes</span>");
			}
		});

		$('#changeStreamer').click(function()
		{
			if($(this).text().indexOf("Yes") >= 0)
			{
				$(this).html("Streamer: <span style='font-weight: bold; color: red;'>No</span>");
			}
			else
			{
				$(this).html("Streamer: <span style='font-weight: bold; color: green;'>Yes</span>");
			}
		});

		$('#changeCommenting').click(function()
		{
			if($(this).text().indexOf("Yes") >= 0)
			{
				$(this).html("Comments: <span style='font-weight: bold; color: red;'>No</span>");
			}
			else
			{
				$(this).html("Comments: <span style='font-weight: bold; color: green;'>Yes</span>");
			}
		});

		$('#changeVehicleColors').click(function()
		{
			if($(this).text().indexOf("Yes") >= 0)
			{
				$(this).html("Random Vehicle Colors: <span style='font-weight: bold; color: red;'>No</span>");
			}
			else
			{
				$(this).html("Random Vehicle Colors: <span style='font-weight: bold; color: green;'>Yes</span>");
			}
		});

		$('#changeDrawDistance').click(function()
		{
			$(this).hide();
			$('#drawdistanceinput').show().focus();
		});

		$('#drawdistanceinput').blur(function()
		{
			$(this).hide();
			$('#changeDrawDistance').html("Object Draw Distance: " + $(this).val() + "").show();
		});

		$('#changeRespawnTime').click(function()
		{
			$(this).hide();
			$('#respawntimeinput').show().focus();
		});

		$('#respawntimeinput').blur(function()
		{
			$(this).hide();
			$('#changeRespawnTime').html("Vehicle Respawn Time: " + $(this).val() + "").show();
		});

		$('#drawdistanceinput, #respawntimeinput').bind("keypress", function(e)
		{
			if(e.keyCode == 13)
			{
				$(this).trigger("blur");
				event.preventDefault();
			}
		});

		$('#convertAreaButtonF').zclip(
		{
			path: "js/ZeroClipboard.swf",
			copy: $('#conversion').val()
		});

		$('#convertAreaButtonS').zclip(
		{
			path: "js/ZeroClipboard.swf",
			copy: $('#removeWorldObject').val()
		});

		$('#convertForm').submit(function()
		{
			$(this).addHidden("indent", $('#changeAutoIndent').text()).addHidden("streamer", $('#changeStreamer').text()).addHidden("comments", $('#changeCommenting').text()).addHidden("vehiclecolors", $('#changeVehicleColors').text());
		});

		$('#mapfile').change(function()
		{
			$('#convertForm').submit();
		});

		$('#feedback').click(function()
		{
			$('#mainPage').fadeOut(500, function()
			{
				$('#feedbackPage').fadeIn(500);
			});
		});

		$('#return').click(function()
		{
			$('#feedbackPage').fadeOut(500, function()
			{
				$('#mainPage').fadeIn(500);
			});
		});
	});
</script>

<?php

	function processConversion($string)
	{
		global $indent, $streamer, $comments, $randomVehicleColors;

		$xmlHandle = simplexml_load_string($string);

		if($indent)
		{
			echo "\t";
		}

		if($xmlHandle)
		{
			$attributes = $xmlHandle->attributes();

			switch($xmlHandle->getName())
			{
				case "object":
				{
					if($streamer)
					{
						echo "CreateDynamicObject(" . $attributes['model'] . ", " . $attributes['posX'] . ", " . $attributes['posY'] . ", " . $attributes['posZ'] . ", " . $attributes['rotX'] . ", " . $attributes['rotY'] . ", " . $attributes['rotZ'] . ", " . $attributes['dimension'] . ", " . $attributes['interior'] . ", .streamdistance = " . $_POST['drawdistance'] . ");";
					}
					else
					{
						echo "CreateObject(" . $attributes['model'] . ", " . $attributes['posX'] . ", " . $attributes['posY'] . ", " . $attributes['posZ'] . ", " . $attributes['rotX'] . ", " . $attributes['rotY'] . ", " . $attributes['rotZ'] . ", " . $_POST['drawdistance'] . ");";
					}

					if($comments)
					{
						echo " // " . $attributes['id'] . "";
					}

					break;
				}

				case "vehicle":
				{
					$vehicleColors = ($randomVehicleColors) ? array(-1, -1) : split(",", $attributes['color']);
					echo "CreateVehicle(" . $attributes['model'] . ", " . $attributes['posX'] . ", " . $attributes['posY'] . ", " . $attributes['posZ'] . ", " . $attributes['rotZ'] . ", " . $vehicleColors[0] . ", " . $vehicleColors[1] . ", " . $_POST['respawntime'] . ");";
					break;
				}

				case "removeWorldObject":
				{
					echo "RemoveBuildingForPlayer(playerid, " . $attributes['model'] . ", " . $attributes['posX'] . ", " . $attributes['posY'] . ", " . $attributes['posZ'] . ", " . $attributes['radius'] . ");\n";

					if($indent)
					{
						echo "\t";
					}

					echo "RemoveBuildingForPlayer(playerid, " . $attributes['lodModel'] . ", " . $attributes['posX'] . ", " . $attributes['posY'] . ", " . $attributes['posZ'] . ", " . $attributes['radius'] . ");";
					
					if($comments)
					{
						echo " //" . $attributes['id'] . "";
					}

					break;
				}
			}

			echo "\n";
		}
		else
		{
			if(strpos($string, "CreateObject(") !== false || strpos($string, "CreateDynamicObject") !== false)
			{
				$objectInfo = explode(",", str_replace(", ", ",", $string));
				echo "<object id=\"Convertify (" . rand(1, 999999999) . ")\" interior=\"0\" collisions=\"true\" alpha=\"255\" doublesided=\"false\" model=\"" . $objectInfo[1] . "\" scale=\"1\" dimension=\"0\" posX=\"" . $objectInfo[2] . "\" posY=\"" . $objectInfo[3] . "\" posZ=\"" . $objectInfo[4] . "\" rotX=\"" . $objectInfo[5] . "\" rotY=\"" . $objectInfo[6] . "\" rotZ=\"" . $objectInfo[7] . "\"></object>\n";
			}
			else if(strpos($string, "CreateVehicle(") !== false || strpos($string, "AddStaticVehicle(") !== false || strpos($string, "AddStaticVehicleEx(") !== false)
			{
				$vehicleInfo = explode(",", str_replace(", ", ",", $string));
				echo "<vehicle model=\"" . $vehicleInfo[1] . "\" posX=\"" . $vehicleInfo[2] . "\" posY=\"" . $vehicleInfo[3] . "\" posZ=\"" . $vehicleInfo[4] . "\" rotX=\"0.0000000\" rotY=\"0.0000000\" rotZ=\"" . $vehicleInfo[5] . "\" color=\"" . $vehicleInfo[6] . "," . $vehicleInfo[7] . "\" />\n";
			}
			else if(strpos($string, "RemoveBuildingForPlayer(") !== false)
			{
				$buildingInfo = explode(",", str_replace(", ", ",", $string));
				echo "<removeWorldObject id=\"Convertify (" . rand(1, 999999999) . ")\" radius=\"" . $buildingInfo[6] . "\" interior=\"0\" model=\"" . $buildingInfo[1] . "\" lodModel=\"" . $buildingInfo[2] . "\" posX=\"" . $buildingInfo[3] . "\" posY=\"" . $buildingInfo[4] . "\" posZ=\"" . $buildingInfo[5] . "\" rotX=\"0\" rotY=\"0\" rotZ=\"0\"></removeWorldObject>\n";
			}
		}
	}

	if($_POST['convert'])
	{
		if(strpos($_POST['indent'], "Yes") !== false)
		{
			$indent = true;
			cookie("indent", 1);
		}
		else
		{
			$indent = false;
			cookie("indent", 0);
		}

		if(strpos($_POST['streamer'], "Yes") !== false)
		{
			$streamer = true;
			cookie("streamer", 1);
		}
		else
		{
			$streamer = false;
			cookie("streamer", 0);
		}

		if(strpos($_POST['comments'], "Yes") !== false)
		{
			$comments = true;
			cookie("comments", 1);
		}
		else
		{
			$comments = false;
			cookie("comments", 0);
		}

		if(strpos($_POST['vehiclecolors'], "Yes") !== false)
		{
			$randomVehicleColors = true;
			cookie("vehiclecolors", 1);
		}
		else
		{
			$randomVehicleColors = false;
			cookie("vehiclecolors", 0);
		}

		cookie("drawdistance", $_POST['drawdistance']);
		cookie("respawntime", $_POST['respawntime']);

		echo "</form>";

		echo "<a href=''><button id='convertAreaButton'>Convert More</button></a> <br><br>";

		echo "<textarea id='conversion' class='resultsText' readonly>";

		$splitText = explode("\n", $_POST['convert']);

		foreach($splitText as $currentLine)
		{
			if(strpos($currentLine, "removeWorldObject") === false && strpos($currentLine, "<map") === false && strpos($currentLine, "</map>") === false)
			{
				processConversion($currentLine);
			}
		}

		echo
		"</textarea>

		<div class='textareaTitle'>
			OnGameModeInit
		</div>

		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

		<button id='convertAreaButtonF'>Copy to Clipboard</button>

		<br><br><br>";

		echo "<textarea id='removeWorldObject' class='resultsText' readonly>";

		foreach($splitText as $currentLine)
		{
			if(strpos($currentLine, "removeWorldObject") !== false)
			{
				processConversion($currentLine);
			}
		}

		echo
		"</textarea>

		<div class='textareaTitle'>
			OnPlayerConnect
		</div>

		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

		<button id='convertAreaButtonS'>Copy to Clipboard</button>

		<script>
			$('#loadScript').load('logconversion.php', {contents1: $('#conversion').val(), contents2: $('#removeWorldObject').val()})
		</script>";
		exit;
	}

	if($_FILES['mapfile']['name'] && stripos($_FILES['mapfile']['name'], ".php") === false)
	{
		move_uploaded_file($_FILES['mapfile']['tmp_name'], "tmp/" . basename($_FILES['mapfile']['name']) . "");

		if(strpos($_POST['indent'], "Yes") !== false)
		{
			$indent = true;
			cookie("indent", 1);
		}
		else
		{
			$indent = false;
			cookie("indent", 0);
		}

		if(strpos($_POST['streamer'], "Yes") !== false)
		{
			$streamer = true;
			cookie("streamer", 1);
		}
		else
		{
			$streamer = false;
			cookie("streamer", 0);
		}

		cookie("drawdistance", $_POST['drawdistance']);
		cookie("respawntime", $_POST['respawntime']);

		echo "</form>";

		echo "<a href=''><button id='convertAreaButton'>Convert More</button></a> <br><br>";

		echo "<textarea id='conversion' class='resultsText' readonly>";

		$splitText = explode("\n", file_get_contents("tmp/" . basename( $_FILES['mapfile']['name']) . ""));
		unlink("tmp/" . basename( $_FILES['mapfile']['name']) . "");

		foreach($splitText as $currentLine)
		{
			if(strpos($currentLine, "removeWorldObject") === false && strpos($currentLine, "<map") === false && strpos($currentLine, "</map>") === false)
			{
				processConversion($currentLine);
			}
		}

		echo
		"</textarea>

		<div class='textareaTitle'>
			OnGameModeInit
		</div>

		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

		<button id='convertAreaButtonF'>Copy to Clipboard</button>

		<br><br><br>";

		echo "<textarea id='removeWorldObject' class='resultsText' readonly>";

		foreach($splitText as $currentLine)
		{
			if(strpos($currentLine, "removeWorldObject") !== false)
			{
				processConversion($currentLine);
			}
		}

		echo
		"</textarea>

		<div class='textareaTitle'>
			OnPlayerConnect
		</div>

		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

		<button id='convertAreaButtonS'>Copy to Clipboard</button>

		<script>
			$('#loadScript').load('logconversion.php', {contents1: $('#conversion').val(), contents2: $('#removeWorldObject').val()})
		</script>";
		exit;
	}

	if($_POST['feedback'])
	{
		mail("nggricky@gmail.com", "Convertify Feedback", "IP Address: " . $_SERVER['REMOTE_ADDR'] . "\n\n" . $_POST['feedback'] . "", "From: contact@convertify.co");
		mail("skoalify@gmail.com", "Convertify Feedback", "IP Address: " . $_SERVER['REMOTE_ADDR'] . "\n\n" . $_POST['feedback'] . "", "From: contact@convertify.co");
		alert("Your feedback has been submitted.");
	}

	$mQuery = mysql_query("SELECT `id` FROM `files`");
	$totalConversions = mysql_num_rows($mQuery);

?>

<div id='mainPage'>
	<div align='left'>
		<span class='fieldTitle'>Total Conversions:</span> <?php echo $totalConversions; ?>
	</div>

	<textarea id='convertArea' name='convert'></textarea>

	<br>

	<div align='right'>
		<button type='button' id='changeAutoIndent' class='convertAreaButton' data-autoindent='1'>Auto Indent: <span style='font-weight: bold; color: <?php echo ($_COOKIE['indent']) ? ("green") : ("red"); ?>;'><?php echo ($_COOKIE['indent']) ? ("Yes") : ("No"); ?></span></button> <button type='button' id='changeStreamer' class='convertAreaButton' data-autoindent='1'>Streamer: <span style='font-weight: bold; color: red;'>No</span></button> <button type='button' id='changeDrawDistance' class='convertAreaButton' data-drawdistance='1'>Object Draw Distance: <?php echo $_COOKIE['drawdistance']; ?></button> <input type='text' id='drawdistanceinput' name='drawdistance' placeholder='Object Draw Distance' value='<?php echo $_COOKIE['drawdistance']; ?>' style='display: none;'> <button type='button' id='changeRespawnTime' class='convertAreaButton' data-respawntime='1'>Vehicle Respawn Time: <?php echo $_COOKIE['respawntime']; ?></button> <input type='text' id='respawntimeinput' name='respawntime' placeholder='Vehicle Respawn Time' value='<?php echo $_COOKIE['respawntime']; ?>' style='display: none;'> <button id='convertAreaButton'>Convert</button>
	</div>

	<br>

	<div align='left'>
		<button type='button' id='changeCommenting' class='convertAreaButton'>Comments: <span style='font-weight: bold; color: <?php echo ($_COOKIE['comments']) ? ("green") : ("red"); ?>;'><?php echo ($_COOKIE['comments']) ? ("Yes") : ("No"); ?></span></button> <button type='button' id='changeVehicleColors' class='convertAreaButton'>Random Vehicle Colors: <span style='font-weight: bold; color: <?php echo ($_COOKIE['vehiclecolors']) ? ("green") : ("red"); ?>;'><?php echo ($_COOKIE['vehiclecolors']) ? ("Yes") : ("No"); ?></span></button>
	</div>

	<div id='convertAreaText'>
		Paste Here

		<br>

		<input type='hidden' name='MAX_FILE_SIZE' value='1000000'>
		<input type='file' id='mapfile' name='mapfile'>
	</div>

	<div id='pageSpaces'>
		<br><br><br><br><br><br><br><br><br><br>
	</div>

	<br><br>

	<div class='uploadHistory' align='left'>
		<?php

			$mQuery = mysql_query("SELECT `id`, `date`, `path` FROM `files` WHERE `unqid` = '" . escape($_COOKIE['unqid']) . "' ORDER BY `date` DESC");

			while($mData = mysql_fetch_assoc($mQuery))
			{
				echo
				"<div id='UPLOAD-" . $mData['id'] . "'>
					<a href='" . $mData['path'] . "' target='_blank'>
						<div class='uploadTitle'>
							" . substr(file_get_contents($mData['path']), 0, 64) . "...
						</div>
					</a>

					<div class='uploadDate'>
						" . date("l, F d, Y", $mData['date']) . " at " . date("h:i A", $mData['date']) . "
					</div>
				</div>

				<br>";
			}

		?>
	</div>

	<br><br><br>

	<div id='feedback' align='right' class='linkButton'>
		Feedback
	</div>
</div>

<div id='feedbackPage' style='display: none;'>
	<textarea id='convertAreaF' name='feedback'></textarea>

	<br>

	<div align='right'>
		<button type='button' id='return' class='convertAreaButton'>Return</button> <button class='convertAreaButton'>Submit Feedback</button>
	</div>

	<div id='convertAreaTextF'>
		Feedback
	</div>
</div>

<?php

	require_once("includes/footer.php");

?>