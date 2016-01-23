<?php

	require_once("classes/mysql.php");
	require_once("classes/page.php");
	require_once("classes/account.php");

	function sendMail($to, $subject, $message)
	{
		$headers = "From: em@ail.com\r\n" .
				   "Reply-To: em@ail.com\r\n" .
				   "X-Mailer: PHP/" . phpversion();
				   
		foreach($to as $currentTarget)
		{
			mail($currentTarget, $subject, $message, $headers);
		}
	}

	$galleryID = 1;

	function addGalleryPhoto($caption, $description, $link, $image)
	{
		global $galleryID;

		echo
		"<a href='$link'>
			<div data-id='$galleryID' style='background-image: url(../images/gallery/$image)'>
				<div id='gallery-$galleryID' class='galleryPhotoCaption'>
					<div class='title space-bottom'>
						$caption
					</div>

					<div class='subtitle'>
						$description
					</div>
				</div>
			</div>
		</a>";

		$galleryID++;
	}

?>