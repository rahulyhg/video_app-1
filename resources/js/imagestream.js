/**
 * DOM elemens placeholders
 */

// interval setting (int [ms])
var imageStreamInterval = 3000;

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
	$.ajax({
		url: streamAddress + "?JpegCam=1&rnd=" + timestamp,
		beforeSend: function(xhr) {
			xhr.setRequestHeader("Authorization", "Basic " + btoa(httpBasicAuthUsername + ":" + httpBasicAuthPasword));
		},
		success: function(response) {
			// prepare the new image
			var newImage = new Image();
			newImage.src = response;

			// append the new image
			$(image_stream_holder).empty().append(newImage);
		}
	});
};

// load the image for stream display in a loop and update the image
$(document).ready(function() {
	setInterval(function() {
		var timestamp = getCurrentTimestamp();
		updateImageStream(timestamp);
	}, imageStreamInterval);
});
