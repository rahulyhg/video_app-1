// selector definitions
var cameraStreamHolder = "#camera_stream_holder";
var cameraIframeSelector = "#camera_stream";

// displays the stream
var displayStream = function(url) {
	$(cameraStreamHolder).html("<iframe id='camera_stream' src='" + url + "'>");
};

// diplays the error stream
var displayErrorStream = function() {
	$(cameraStreamHolder).html("");
}

// getting the camera stream
var getTheCameraStream = function(url) {
	var url = url.trim();
	var streamUrl = "http://" + url;
	var streamUrl = "https://google.com";

	$.ajax({
		type: 'GET',
		url: streamUrl,
		success: function(response) {
			// display the stream
			displayStream(streamUrl);
		},
		error: function(error) {
			// handle the error here
			displayErrorStream();
		}
	});
};
