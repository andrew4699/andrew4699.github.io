$(document).ready(function()
{
	var currentPhoto = -1;
	var photoCount = $('#galleryPhotos > div > div').length;

	function changeGalleryOverlay()
	{
		var container = $('#gallery-container-' + currentPhoto);

		$('#galleryOverlayPicture').attr("src", "images/gallery/" + container.data("src"));
		$('#galleryOverlayTitle').text(container.find(".title").text());
		$('#galleryOverlayLink').text(container.data("link")).attr("href", container.data("link"));
		$('#galleryOverlayDescription').text(container.find(".subtitle").text());
	}

	$('#galleryPhotos > div > div').mouseenter(function()
	{
		$('#gallery-' + $(this).data("id")).stop().animate({"height": "90px"}, 300);
	})
	.mouseleave(function()
	{
		$('#gallery-' + $(this).data("id")).stop().animate({"height": "40px"}, 300);
	})
	.click(function()
	{
		currentPhoto = $(this).data("id");

		changeGalleryOverlay();

		$('#galleryOverlay').fadeIn(500);
	});

	$('#galleryOverlayClose').click(function()
	{
		$('#galleryOverlay').fadeOut(500);
	});

	$('#galleryArrowLeft').click(function()
	{
		currentPhoto--;

		if(currentPhoto < 1)
		{
			currentPhoto = photoCount;
		}

		changeGalleryOverlay();
	});

	$('#galleryArrowRight').click(function()
	{
		currentPhoto++;

		if(currentPhoto > photoCount)
		{
			currentPhoto = 0;
		}

		changeGalleryOverlay();
	});
});