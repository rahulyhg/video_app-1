// set up the stream
var imageStreamHolder = "#camera_stream";
var cameraStreamHolder = "#camera_stream_holder";
var hostNameUrl = window.location.protocol + '//' + window.location.hostname + '/';
var loaded = false;

// check the stream for errors
var checkStream = function() {
	setInterval(function() {
		if (! $(imageStreamHolder)[0].complete) {
			displayErrorStream();
		}
	}, 3000);
};

// displays the error stream
var displayErrorStream = function() {
	$(cameraStreamHolder).html("");
	$(cameraStreamHolder).html("<img src=" + hostNameUrl + "public/images/static.gif width='100%'>");
}
