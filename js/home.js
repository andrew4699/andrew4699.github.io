$(document).ready(function()
{
	console.log("///////////////////////////////////////////////////////////");
	console.log("//														 //");
	console.log("//														 //");
	console.log("//				WELCOME TO MY CONSOLE 					 //");
	console.log("//														 //");
	console.log("//														 //");
	console.log("///////////////////////////////////////////////////////////");

	$('#homeScroll').click(function()
	{
		$('html, body').animate({scrollTop: $('#section-gallery').offset().top}, 750);
	});
	
	$('#contactScroll').click(function()
	{
		$('html, body').animate({scrollTop: $('#section-contact').offset().top}, 750);	
	});
});
