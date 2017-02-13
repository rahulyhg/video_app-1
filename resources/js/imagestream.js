/**
 * DOM elemens placeholders
 */

// interval setting (int [ms])
var imageStreamInterval = 2000;

// holder of the image stream
var imageStreamHolder = "#image_stream";

// stream address global variable
var streamAddress = "";

/**
 * Assings the stream URL to a global variable.
 * 
 * @param  string stream_address
 */
var getIpAddress = function(stream_address) {
	streamAddress = stream_address;
};

/**
 * Returns the current timestamp.
 * 
 * @return string
 */
var getCurrentTimestamp = function() {
	return + new Date();
};

/**
 * Updates the image stream with the current image.
 * 
 * @param  int timestamp
 */
var updateImageStream = function(timestamp) {
	var imgSrcAttribute = streamAddress + "?JpegCam=1&rnd=" + timestamp;
	$(imageStreamHolder).attr("src", imgSrcAttribute);

	console.log("updated");
};

// load the image for stream display in a loop and update the image
$(document).ready(function() {
	setInterval(function() {
		var timestamp = getCurrentTimestamp();
		updateImageStream(timestamp);
	}, imageStreamInterval);
});
