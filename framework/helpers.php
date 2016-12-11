<?php

use Controllers\PagesController;

use Models\User;
use Models\Auth;

use Core\Template;
use Core\Middleware;
use Core\Lang;

// debug function - die and dump vars
function dd($vars) {
	var_dump($vars);
	die();
}

// function for rendering templates
function render($template, $variables = array(), $message = []) {
	Template::render($template, $variables, $message);
}

// inserts a partial into a template
function insert($path) {
	include('views/' . $path . '.php');
}

// Get the absolute path of the project.
function getAbsolutePath() {
    return 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}/";
}

// includes an inline asset in html
function asset($path) {
    echo getAbsolutePath() . "public/$path";
}

// parses the url and links to a correct one
function url($location) {
	echo getAbsolutePath() . $location;
}

// redirects the user back to landing page if he is not a user
function redirectIfNotAdmin() {
	if ( ! Middleware::isUserAdmin() ) {
		PagesController::index();
	}
}

// returns true if the user is logged in
function redirectIfNotLoggedIn() {
	if ( ! Middleware::isUserLoggedIn()) {
		PagesController::index();
	}
}

// gets the logged-in user from the session
function getUser() {
	return Auth::user();
}

// check if the supplied user is an admin
function isAdmin($id) {
	$user = User::get("id", $id);
	if ($user) {
		if ($user["access_level"] == 1) {
			return true;
		}
		return false;
	}
	return false;
}

// checks if the user is an admin
function isUserAdmin() {
	if (Middleware::isUserAdmin()) {
		return true;
	}
	return false;
}

// returns true if the user is blocked
function isUserBlocked($id) {
	if ( Middleware::isUserBlocked($id) ) {
		return true;
	}
	return false;
}

// returns the translation of the string
function mutation($langString) {
	Lang::get($langString);
}

// display a flash message to a template
function flashMessage() {
	$message = Template::getFlashMessage();
	if ( ! empty($message) ) {
		$messageHtml .= "<div class='collection'>";
		$messageHtml .= "<a href='#' class='collection-item " . $message["type"] . "'>" . $message["body"] . "</a>";
		$messageHtml .= "</div>";

		echo $messageHtml;
	}
	return NULL;
}

// redirects the client to a given address
function redirect($address) {
	header('Location: ' . $address);
	die();
}
