<?php

namespace Controllers;

use Models\Lecture;
use Models\Auth;

use Core\Validator;
use Core\Responder;

class LectureController {
	/**
	 * Returns the dashboard for managing lectures
	 * 
	 * @return view
	 */
	public static function dashboard() {
		render("lectures/dashboard");
	}

	/**
	 * Displays the form for creating a new lecture
	 * 
	 * @return view
	 */
	public static function create() {
		render("lectures/create");
	}

	/**
	 * Shows a single lecture with an id.
	 * 
	 * @return view
	 */
	public static function show($id) {
		// get the lecture
		$lecture = Lecture::get("id", $id);

		// render the view
		render("lectures/show", ["lecture" => $lecture]);
	}

	/**
	 * Persists the created lecture into the database
	 * 
	 * @return view
	 */
	public static function store($data) {
		// set up validators
		$validator = Validator::make("string,min:5");

		// validate the whole input
		// @TODO -> finish validation

		// add user to the $data aray
		$data["user_id"] = Auth::user()["id"];

		// store into database
		Lecture::store($data);

		// return back to lectures dashboard
		self::dashboard();
	}

	/**
	 * Export the lecture to pdf.
	 * 
	 * @param  int $lecture_id
	 * @return view
	 */
	public static function export($lecture_id) {
		// get the lecture
		$lecture = Lecture::get("id", $lecture_id);
		die();
		// check if there is a lecture with this id

		// return the json interpretation of the query
		Responder::respondWithJson("lecture", $lecture, 200);
	}
}
