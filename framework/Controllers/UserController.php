<?php

namespace Controllers;

use Controllers\PagesController;

use Core\Config;

use Models\User;
use Models\Auth;
use Models\Lecture;

class UserController {
	/**
	 * Display the list of all the users
	 */
	public static function index() {
		// get all the users
		$users = User::all();

		// display only admins
		$usersToDisplay = array();
		foreach ($users as $user) {
			if ( ! isAdmin($user["id"]) ) {
				array_push($usersToDisplay, $user);
			}
		}

		// render the view with all the users
		render("users/index", ["users" => $usersToDisplay]);
	}

	/**
	 * Display the list of all the users
	 */
	public static function show($id) {
		// validate the id
		if ($id == NULL || !isset($id) || !is_numeric($id)) {
			render("index");
		}

		// get all the users
		$user = User::get("id", $id);

		// render the view with all the users
		render("users/show", ["user" => $user]);
	}

	/**
	 * Displays the user settings page
	 * 
	 * @return view
	 */
	public static function settings($user_id) {
		// get all the available languages from the config
		$languages = Config::get("languages");

		// get the user
		$user = Auth::user();

		if ($user) {
			render("users/settings", ["user" => $user, "languages" => $languages]);
		}

		// redirect to index if there is no user logged in
		PagesController::index();
	}

	/**
	 * Subscribes the user to a lecture.
	 * 
	 * @param  int $lecture_id
	 */
	public static function subscribe($lecture_id) {
		// get the lecture
		$lecture = Lecture::get("id", $lecture_id);
		if (! $lecture) {
			PagesController::index();
		}

		// save the subscription
		User::subscribe($lecture["id"]);

		// redirect back
		PagesController::index();
	}

	/**
	 * Unsubscribes from a lecture
	 * 
	 * @param  int $lecture_id
	 */
	public static function unsubscribe($lecture_id) {
		// get the lecture
		$lecture = Lecture::get("id", $lecture_id);
		if (! $lecture) {
			PagesController::index();
		}

		// save the subscription
		User::unsubscribe($lecture["id"]);

		// redirect back to index
		PagesController::index();
	}

	/**
	 * Attempts to log the user in
	 */
	public static function login($credentials = array()) {
		// attempt to log the user in
		$loginSuccess = Auth::login($credentials);

		// redirects to index after a succesful login
		if ($loginSuccess) {
			PagesController::index(["type" => "success", "body" => "Successfuly Logged in"]);
		}
		// redirects back if login was unsuccessful
		PagesController::login(["type" => "error", "body" => "Bad credentials"]);
	}

	/**
	 * Creates a new user
	 */
	public static function create($credentials = []) {
		// get the variables from post request
		$email = $credentials["email"];
		$password = $credentials["password"];

		// if any of the needed fields is empty, do not store the user
		if ($credentials["email"] == "" || credentials["password"] == "") { // should be replaced with a proper validator
			PagesController::index();
		}

		// check if there is a user like that
		$user = User::get("email", $email);

		if (!$user) {
			$newUser = User::create($credentials);

			if ($newUser) {
				Auth::login($newUser);
				self::index();
			} else {
				render("index", NULL, ["type" => "error", "body" => "There was a problem with user registration"]);
			}
		} else {
			render("users/register", NULL, ["type" => "error", "body" => "There already is a user with this email registered"]);
		}
	}

	/**
	 * Blocks a user
	 */
	public static function block($id) {
		// if the supplied user is an admin do not allow blocking
		if (isAdmin($id)) {
			self::index();
		}

		// block the user
		User::block($id);

		// redirect back to index of users
		self::index();
	}

	/**
	 * Unblocks a user
	 */
	public static function unblock($id) {
		// block the user
		User::unblock($id);

		// redirect back to index of users
		self::index();
	}

	/**
	 * Removes a user from the application
	 */
	public static function delete($id) {
		// if the supplied user is an admin do not allow deleting
		if (isAdmin($id)) {
		    self::index();
		}

		// delete the user
		$userToBeDeleted = User::get("id", $id);
		if ($userToBeDeleted) {
			User::delete($userToBeDeleted["id"]);
		}

		// redirect back to index of users
		self::index();
	}

	/**
	 * Get the lectures for the logged in user
	 * 
	 * @return view
	 */
	public static function lectures($user_id) {
		// get the user
		$user = User::get("id", $user_id);

		// get user lectures
		$lecturesForUser = Lecture::getForUser($user_id);

		// render the view with the lectures
		render("lectures/index", ["lectures" => $lecturesForUser, "user" => $user]);
	}
}
