// placehodler definitions
var archiveVideoHolder = "#archive_camera_holder"
var archiveImageHolder = "#archive_camera_stream";
var archiveDatepickerHolder = ".archiveDatepicker";
var archiveSliderHolder = "#archiveSlider";
var currentTimestampOfTheVideo;

// control butons placeholder
var archivePlayButton = "#archive_play_button";
var archivePauseButton = "#archive_pause_button";

/**
 * Player controls functions
 */
var playStream = function() {
	$(archivePlayButton).hide();
	$(archivePauseButton).show();
};

var pauseStream = function() {
	$(archivePauseButton).hide();
	$(archivePlayButton).show();
};

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

	// prepare the control functions
	$(archivePlayButton).hide();
	$(archivePauseButton).on("click", pauseStream());
	$(archivePlayButton).on("click", playStream());
});
