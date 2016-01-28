$(document).ready(function()
{
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

	$('#navigationBar div').click(function()
	{
		$('html, body').animate({scrollTop: $('#section-' + $(this).text().toLowerCase()).offset().top}, 750);
	});
});