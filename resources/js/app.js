$(document).ready(function() {
	// set up the collapsible side nav
	$('.button-collapse').sideNav();

	// setup the modals
	$('.modal').modal();

	// setup datepicker
	$('.datepicker').pickadate({
	  selectMonths: true,
	  selectYears: 15
	});

	// setup timepickers
	// $('#starts_at').bootstrapMaterialDatePicker({date: false});
	// $('#ends_at').bootstrapMaterialDatePicker({date: false});
});
