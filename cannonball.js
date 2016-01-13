$(document).ready(function()
{
	var position = {x: 0, y: 0};
	var velocity = {x: 0, y: 0};

	var GRAVITY = -9.81;

	function animateBall(x, y)
	{
		$('#ball').stop(true, true).animate({"bottom": (y + 100), "left": x}, 2,
		function()
		{
			if(position.y > 0)
			{
				move($('#interval').val());
			}
		});
	}

	function move(dT)
	{
		position.x += velocity.x * dT;
		position.y += velocity.y * dT;

		velocity.y += 0.5 * GRAVITY * (dT * dT);

		animateBall(position.x, position.y);
	}
	
	function shoot(angle, v, dT)
	{
		velocity.x = v * Math.cos(Math.radians(angle));
		velocity.y = v * Math.sin(Math.radians(angle));

		move(dT);
	}

	Math.radians = function(degrees)
	{
  		return degrees * Math.PI / 180;
	};

	$('#fireBall').click(function()
	{
		var velocity = $('#velocity').val();
		var angle = $('#angle').val();
		var xPosition = $('#xPosition').val();
		var interval = $('#interval').val();

		$('#ball').css({"bottom": 100, "left": xPosition});

		position.x = 0;
		position.y = 0;

		velocity.x = 0;
		velocity.y = 0;

		shoot(angle, velocity, interval);
	});
});
