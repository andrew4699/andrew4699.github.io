<?php

	$mainSettings = array("navigation" => false);

	require_once("includes/main.php");

?>

<script src='js/index.js'></script>
<script src='js/gallery.js'></script>
<script src='js/contact.js'></script>

<div id='navigationBar'>
	<div class='wrapper'>
		<div class='navigationLogo floatLeft'>
			<div>
				AG
			</div>

			<div>
				Andrew Guterman

				<div>Web Designer & Developer</div>
			</div>
		</div>

		<div class='navigationItems floatRight'>
			<div id='navigation-home'>Home</div>
			<div id='navigation-gallery'>Gallery</div>
			<div id='navigation-contact'>Contact</div>
		</div>
	</div>
</div>

<div id='section-home' class='homeFirst'>
	<div class='wrapper'>
		<div class='homeHeader'>
			Andrew Guterman
		</div>

		<div class='homeSubHeader'>
			Web Designer & Developer
		</div>

		<div class='homeStatement'>
			I am a Web Developer from San Francisco, California who enjoys building everything from small business websites to rich interactive web apps.
			If you're a business seeking a website or an employer looking to hire, you can get in touch with me <a href='contact'>here</a>.
		</div>

		<div id='homeScroll'>
			<span class='fa fa-angle-down'></span>
		</div>
	</div>
</div>

<div id='section-gallery' class='homeSecond'>
	<div class='wrapper swrapper-large'>
		<div class='homeHeader space-bottom'>
			Gallery
		</div>

		<div id='galleryPhotos'>
			<?php addGalleryPhoto("OffToYou", "The most convenient way to dry clean", "http://offtoyou.com", "offtoyou.jpg"); ?>
			<?php addGalleryPhoto("SF Limo", "Rent a limousine in the Bay Area", "http://sflimo.net", "sflimo.jpg"); ?>
			<?php addGalleryPhoto("Lawless Boards", "Create a forum board in seconds with this simple to use and interactive user interface", "", "forums.png"); ?>
			<?php addGalleryPhoto("Geolocator", "Locate the city, region, country, and provider of an IP address", "", "geolocator.png"); ?>
			<?php addGalleryPhoto("GTA User Control Panel", "View statistics about your character on Lawless Gaming's Grand Theft Auto: San Andreas server", "http://lawlessrp.com/ucp", "ucp.jpg"); ?>
			<?php addGalleryPhoto("Report Count Statistics", "Given a large set of data about the amount of reports an administrator has handled each day, display statistics such as the total amount of reports, average reports per day, etc.", "", "reports.png"); ?>
			<?php addGalleryPhoto("File Manager", "Upload and share files with your friends", "", "filemanager.jpg"); ?>
		</div>
	</div>
</div>

<div id='section-contact' class='homeThird'>
	<div class='wrapper wrapper-small'>
		<div class='homeHeader space-bottom'>
			Contact Me
		</div>

		<div id='contactForm' class='formBlocked'>
			<input type='text' id='email' placeholder='Email Address'>
			<input type='text' id='name' placeholder='Name (optional)'>
			<textarea id='message' placeholder='Message' style='overflow: hidden'></textarea>

			<button id='contact'>Send</button>
		</div>

		<div id='contactSuccess' class='hideit'>
			<div class='homeSubHeader' style='color: white'>
				<div class='space-bottom'>Thank you for contacting me.</div>

				I will reply to your message within 48 hours.
			</div>
		</div>
	</div>
</div>