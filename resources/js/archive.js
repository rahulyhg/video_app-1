// placehodler definitions
var archiveVideoHolder = "#archive_camera_holder"
var archiveImgHolder = "#archive_camera_stream";
var archiveDatepickerHolder = ".archiveDatepicker";

// archive settings functions
var changeStreamDate = function(date) {
	// change the date
	// reset the timer slider
};

// document ready functions
$(document).ready(function() {
	// datepicker config for archive interaction
	$(archiveDatepickerHolder).pickadate({
		format: 'yyyy-mm-dd',
		selectMonths: true,
		selectYears: 15
	});

	$(archiveDatepickerHolder).on("change", function(event) {
		var date = $(this).val();
	});
});
