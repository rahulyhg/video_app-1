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
var archiveImageStreamInterval = 1000; // [ms] / 1000 = [s]

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
	var theDate = new Date(date);
	theDate.setHours(7);
	var timestamp = theDate.getTime() / 1000;

	// pause the playback on load of a new date
	pauseStream();

	// update the video
	loadFrame(timestamp);

	// set the current timestamp of video to the selected dates timestamp
	currentTimestampOfTheVideo = timestamp;

	// reset the timer slider
	$(archiveSliderHolder).val(0);
};

/**
 * Formats the time to a human readable format
 * @param  {int} date
 * @return {int}
 */
var formatTime = function(date) {
	var seconds = date.getSeconds();
	var minutes = date.getMinutes();
	var hours = date.getHours();

	if (seconds < 10) {
		seconds = "0" + seconds;
	}
	if (minutes < 10) {
		minutes = "0" + minutes;
	}
	if (hours < 10) {
		hours = "0" + hours;
	}

	return hours + ":" + minutes + ":" + seconds;
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

	// reassign the date to javascipt readable object
	var date = new Date(timestamp * 1000);

	// calculate and visualize the elapsed time
	var timeFormatted = formatTime(date);
	$(achiveTimeHolder).val(timeFormatted)

	// calculate and update the slider with the correct value
	var secondsInDay = (date.getHours() * 60 * 60) + (date.getMinutes() * 60) + date.getSeconds();
	$(archiveSliderHolder).val(secondsInDay);

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
		selectYears: 15,
		max: true
	});

	// changing the stream date
	$(archiveDatepickerHolder).on("change", function(event) {
		changeStreamDate($(this).val());
	});

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
