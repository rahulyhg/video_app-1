// set up the stream
var streamHolder = "#camera_stream";
var cameraStreamHolder = "#camera_stream_holder";
var hostNameUrl = window.location.protocol + '//' + window.location.hostname + '/';
var loaded = false;

// check the stream for errors
var checkStream = function() {
	setTimeout(function() {
		if (! $(streamHolder)[0].complete) {
			displayErrorStream();
		}
	}, 20000);
};

// displays the error stream
var displayErrorStream = function() {
	$(cameraStreamHolder).html("");
	$(cameraStreamHolder).html("<img src=" + hostNameUrl + "public/images/static.gif width='100%'>");
}
