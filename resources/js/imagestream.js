/**
 * DOM elemens placeholders
 */

// interval setting (int [ms])
var imageStreamInterval = 3000;

// holder of the image stream
var imageStreamHolder = "#image_stream";

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
		url: streamAddress,
		username: httpBasicAuthUsername,
		password: httpBasicAuthPasword,
		beforeSend: function(xhr) {
			xhr.setRequestHeader("Authorization", "Basic " + btoa(httpBasicAuthUsername + ":" + httpBasicAuthPasword));
		},
		success: function(response) {
			var imgSrcAttribute = streamAddress + "?JpegCam=1&rnd=" + timestamp;
			$(imageStreamHolder).attr("src", imgSrcAttribute);
		}
	});

	var imgSrcAttribute = streamAddress + "?JpegCam=1&rnd=" + timestamp;
	$(imageStreamHolder).attr("src", imgSrcAttribute);
};

// load the image for stream display in a loop and update the image
$(document).ready(function() {
	setInterval(function() {
		var timestamp = getCurrentTimestamp();
		updateImageStream(timestamp);
	}, imageStreamInterval);
});
