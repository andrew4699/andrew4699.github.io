$(document).ready(function()
{
	function alertFocus(message, element)
	{
		alert(message);
		$(element).focus();
	}

	$('#contact').click(function()
	{
		var emailAddress = $('#email').val(), senderName = $('#name').val(), message = $('#message').val();

		if(emailAddress)
		{
			if(message)
			{
				$.post
				(
					"ajax/contact.php",
					{email: emailAddress, name: senderName, body: message},
					function(response)
					{
						if(response == "OK")
						{
							$('#contactForm').fadeOut(500, function()
							{
								$('#contactSuccess').fadeIn(500);
							});
						}
						else
						{
							alert("Unknown error while sending your message.");
						}
					}
				);
			}
			else alertFocus("Please enter a message.", "message");
		}
		else alertFocus("Please enter your email address.", "#email");
	});

	// Textarea height adjustment

	var oldHeight = 0;

	function adjustMessageHeight()
	{
		var element = $('#message');

		oldHeight = element.height();

		element.height(0);

		var scrollHeight = Math.max(200, element[0].scrollHeight);

		element.height(oldHeight);
		element.stop().animate({"height": scrollHeight + 30}, 200);
	}

	$('#message').keyup(function()
	{
		adjustMessageHeight();
	});

	adjustMessageHeight();
});