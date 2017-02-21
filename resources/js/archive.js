// placehodler definitions
var archiveVideoHolder = "#archive_camera_holder"
var archiveImageHolder = "#archive_camera_stream";
var archiveDatepickerHolder = ".archiveDatepicker";
var archiveSliderHolder = "#archiveSlider";

// video playback placeholder variables
var archivePlayButton = "#archive_play_button";
var archivePauseButton = "#archive_pause_button";
var achiveTimeHolder = "#achiveTimeFormatted";
var currentTimestampOfTheVideo;
var isVideoPlaying = false;
var archiveImageStreamInterval = 1000; // ms

/**
 * Player controls functions.
 */
var playStream = function() {
	$(archivePlayButton).hide();
	$(archivePauseButton).show();

	if (! isVideoPlaying) {
		isVideoPlaying = true;
	}
};

/**
 * Pauses the achive video player stream.
 */
var pauseStream = function() {
	$(archivePauseButton).hide();
	$(archivePlayButton).show();

	if (isVideoPlaying) {
		isVideoPlaying = false;
	}
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
	// console.log("video at timestamp: " + timestamp); // debug logging

	// update the image output
	var imageUrl = streamAddress + "?JpegCam=1&VCAOverlay=" + vcaOverlaySetting + "&rnd=" + timestamp;
	$(archiveImageHolder).attr("src", imageUrl);

	// update the slider and timer values
	var date = new Date(timestamp * 1000);
	var secondsInDay = (date.getHours() * 60 * 60) + (date.getMinutes() * 60) + date.getSeconds();
	console.log(secondsInDay);
	var timeFormatted = date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds();
	$(archiveSliderHolder).val(secondsInDay);
	$(achiveTimeHolder).val(timeFormatted)

	// add a second to the timestamp
	++timestamp;

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

	// playing the video here
	setInterval(function() {
		if (isVideoPlaying) {
			loadFrame(currentTimestampOfTheVideo);
		}
	}, archiveImageStreamInterval);

	// hide the pause button on load
	pauseStream();
});

// prepare the control functions
$(document).on("click", archivePauseButton, pauseStream);
$(document).on("click", archivePlayButton, playStream);
