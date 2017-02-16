/**
 * DOM elemens placeholders
 */

// interval setting (int [ms])
var imageStreamInterval = 1500;

// overlay setting for the camera
var vcaOverlaySetting = 0;

// holder of the image stream
var streamImage = "#image_stream";
var streamImageHolder = "#image_stream_holder";

// stream address global variable
var streamAddress = "";

// Basic Auth credentials
var httpBasicAuthUsername = "service";
var httpBasicAuthPasword = "mac661959";

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
	var imageUrl = streamAddress + "?JpegCam=1&VCAOverlay=" + vcaOverlaySetting + "&rnd=" + timestamp;
	$(streamImage).attr("src", imageUrl);
};

var updateImageCallback = function(response) {
	// console.log(response);
};

// load the image for stream display in a loop and update the image
$(document).ready(function() {
	setInterval(function() {
		updateImageStream(getCurrentTimestamp());
	}, imageStreamInterval);
});
