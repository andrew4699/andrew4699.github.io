$(document).ready(function()
{
	$('#galleryPhotos > a > div').mouseenter(function()
	{
		$('#gallery-' + $(this).data("id")).stop().animate({"height": "90px"}, 300);
	})
	.mouseout(function()
	{
		$('#gallery-' + $(this).data("id")).stop().animate({"height": "40px"}, 300);
	});
});