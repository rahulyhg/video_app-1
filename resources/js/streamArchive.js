var cameraId = "";

var getCameraId = function(camera_id) {
	cameraId = camera_id;
};

$(document).ready(function() {
	var timestamp = 1494431161;

	setInterval(function() {
		$("#archive_camera_stream").attr(
			"src",
			"http://localhost:4000" + "/" + "public" + "/" + "streamArchive" + "/" + 2 + "/" + timestamp + ".png");
		++timestamp;
	}, 1000);
});
