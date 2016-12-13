// start the calendar
var setUpCalendar = function(events) {
	$('#calendar').fullCalendar({
		events: events,
		locale: 'sk',
		displayEventTime: true,
		displayEventEnd: true,
		defaultView: 'agendaWeek',
		header: {
			left:   'title',
			center: '',
			right:  'today month, agendaWeek, agendaDay prev, next'
		},
		eventClick: function(response) {
			var eventModalSelector = '#modal_' + response.id;
			$(eventModalSelector).modal('open');
		}
	});
};

// format the time into correct format
var parseTimeString = function(date, time) {
	// construct and return the date and time string
	return date + 'T' + time + ":00";
};

$(document).ready(function() {
	// set up the collapsible side nav
	$('.button-collapse').sideNav();

	// setup the modals
	$('.modal').modal();

	// setup datepicker
	$('.datepicker').pickadate({
		format: 'yyyy-mm-dd',
		selectMonths: true,
		selectYears: 15
	});

	// get all the lectuz
	$.ajax({
		type: "GET",
		url: "/lectures",
		success: function(data) {
			var lectures = data.lectures;

			// prepare the events from the response
			var events = [];
			for (var i = lectures.length - 1; i >= 0; i--) {
				var lecture = lectures[i];

				// parse the start and end times
				lecture.start = parseTimeString(lecture.date, lecture.starts_at);
				lecture.end = parseTimeString(lecture.date, lecture.ends_at);

				// delete the old keys
				delete lecture.starts_at;
				delete lecture.ends_at;

				events.push(lecture);
			}

			// load the calendar with the events
			setUpCalendar(events);
		},
		error: function(error) {
			// console.log("there was an error retrieving the lectures");
		}
	});
});
