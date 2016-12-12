<?php

namespace Models;

use Core\Transformer;

class Lecture {
	/**
	 * Gets all the lectures
	 */
	public static function all() {
		// get the db
		global $app;
		$db = $app->getDatabase();

		try {
			$lectures = $db->lecture();
			$lecturesArray = Transformer::objectsToArray($lectures);
			return $lecturesArray;
		} catch (PDOException $e) {
			return false;
		}
	}

	/**
	 * Gets the lecture by a specified parameter
	 * 
	 * @param  string $key
	 * @param  mixed $value
	 * @return object
	 */
	public static function get($key, $value) {
		// get the db
		global $app;
		$db = $app->getDatabase();

		// get the lecture
		try {
			$lectureQuery = $db->lecture("$key = ?", "$value");
			$lecture = $lectureQuery->fetch();
			$lectureCount = $lectureQuery->count();

			if ($lectureCount < 1) {
				return false;
			}
			return $lecture;
		} catch (PDOException $e) {
			return false;
		}
	}

	/**
	 * Persist the lecture to the database
	 */
	public static function store($data) {
		global $app;
		$db = $app->getDatabase();

		// prepare the data
		$lectureData = [
			"title" => $data["title"],
			"note" => $data["note"],
			"user_id" => $data["user_id"],
			"date" => $data["date"],
			"starts_at" => $data["starts_at"],
			"ends_at" => $data["ends_at"]
		];

		// insert data into the database
		try {
			$lectures = $db->lecture();
			$result = $lectures->insert($lectureData);

			if ($result) {
				return true;
			}
			return false;
		} catch (PDOException $e) {
			return false;
		}
	}
}
