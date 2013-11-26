$(function() {

	$('#blueprint_img').unbind('load').load(function() {
		// Create new offscreen image to test
		var theImage = new Image();
		theImage.src = $('#blueprint_img').attr("src");

		// Get accurate measurements from that.
		var imageWidth = theImage.width;
		var imageHeight = theImage.height;

		var canvas = $('#blueprint_map');

		canvas.attr('width', imageWidth);
		canvas.attr('height', imageHeight);

		var offset = $('#blueprint_img').offset();
		canvas.css('position', 'absolute');
		canvas.css('top', offset.top + 'px');
		canvas.css('left', offset.left + 'px');
		canvas.css('z-index', '1');

		// draw checkpoints
		drawVertexes($('#floor_info').val());
	});

	function drawVertexes(floorid) {
		// make ajax call
		var url = 'http://localhost/xampp_intro/index.php/service/getVertexesForFloorId/'
				+ floorid;
		$.getJSON(url, function(data) {
			var context = $('#blueprint_map').get(0).getContext("2d");
			// draw on the canvas
			for ( var i = 0; i < data.length; i++) {
				drawFullCheckpoint(data[i].x, data[i].y, context);
			}
		});
	}

	function drawFullCheckpoint(x, y, context) {
		var radius = 10;
		context.beginPath();
		context.arc(x, y, radius, 0, Math.PI * 2, false);
		context.closePath();
		context.fillStyle = "blue";
		context.fill();
	}
});