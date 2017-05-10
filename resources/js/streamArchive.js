var cameraId = "";

var getCameraId = function(camera_id) {
	cameraId = camera_id;
};

$(document).ready(function() {
	var baseUrl = window.location.origin;
	var timestamp = 1494432573;

	setInterval(function() {
		$("#archive_camera_stream").attr(
			"src",
			baseUrl + "/" + "public" + "/" + "streamArchive" + "/" + 2 + "/" + timestamp + ".png");
		++timestamp;
	}, 1000);
});
