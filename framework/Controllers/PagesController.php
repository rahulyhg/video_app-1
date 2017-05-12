<?php

namespace Controllers;
session_start();
class PagesController {
	/**
	 * Displays the landing page
	 */
	public static function index($message = []) {
		// get all the lectures
		$lectures = \Models\Lecture::all();

		// render the index with all the lectures
		render("index", ["lectures" => $lectures], $message);
	}

	/**
	 * Displays the login page
	 */
	public static function login($message = []) {
		render("users/login", NULL ,$message);
	}

	/**
	 * Displays the register page
	 */
	public static function register() {
		render("users/register");
	}
}
