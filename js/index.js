$(document).ready(function()
{
	console.log("///////////////////////////////////////////////////////////");
	console.log("//														 //");
	console.log("//														 //");
	console.log("//				WELCOME TO MY CONSOLE 					 //");
	console.log("//														 //");
	console.log("//														 //");
	console.log("///////////////////////////////////////////////////////////");

	// Navigation

	function updateNavigation()
	{
		var scrollTop = $(this).scrollTop() + $('#navigationBar').height();

		if(scrollTop >= $('#section-contact').offset().top)
		{
			$('.navigationCurrent').removeClass("navigationCurrent");
			$('#navigation-contact').addClass("navigationCurrent");
		}
		else if(scrollTop >= $('#section-gallery').offset().top)
		{
			$('.navigationCurrent').removeClass("navigationCurrent");
			$('#navigation-gallery').addClass("navigationCurrent");
		}
		else
		{
			$('.navigationCurrent').removeClass("navigationCurrent");
			$('#navigation-home').addClass("navigationCurrent");
		}
	}

	$(window).scroll(function()
	{
		updateNavigation();
	});

	updateNavigation();

	$('#homeScroll').click(function()
	{
		$('html, body').animate({scrollTop: $('#section-gallery').offset().top}, 750);
	});

	$('#navigationBar div').click(function()
	{
		$('html, body').animate({scrollTop: $('#section-' + $(this).text().toLowerCase()).offset().top}, 750);
	});
});