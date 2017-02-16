// placehodler definitions
var archiveVideoHolder = "#archive_camera_holder"
var archiveImageHolder = "#archive_camera_stream";
var archiveDatepickerHolder = ".archiveDatepicker";
var archiveSliderHolder = "#archiveSlider";
var currentTimestampOfTheVideo;

/**
 * Changes the date of the stream.
 * 
 * @param  string date
 */
var changeStreamDate = function(date) {
	// convert the date to timestamp
	var timestamp = new Date(date).getTime() / 1000;

	// update the video
	loadFrame(timestamp);

	// reset the timer slider
	$(archiveSliderHolder).val(0);
};

/**
 * Loads the next frame in the video.
 * 
 * @param  string timestamp
 */
var loadFrame = function(timestamp) {
	// update the image output
	var imageUrl = streamAddress + "?JpegCam=1&VCAOverlay=" + vcaOverlaySetting + "&rnd=" + timestamp;
	$(archiveImageHolder).attr("src", imageUrl);

	// update the global timestamp placeholder
	currentTimestampOfTheVideo = timestamp;
};

// document ready functions
$(document).ready(function() {
	// datepicker config for archive interaction
	$(archiveDatepickerHolder).pickadate({
		format: 'yyyy-mm-dd',
		selectMonths: true,
		selectYears: 15
	});

	// changing the stream date
	$(archiveDatepickerHolder).on("change", function(event) { changeStreamDate($(this).val()); });

	// updating the image video stream in a loop here
	setInterval(function() {
		loadFrame(currentTimestampOfTheVideo);
	}, imageStreamInterval);
});
