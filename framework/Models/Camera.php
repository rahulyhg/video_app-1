<?php

namespace Models;

use Core\Transformer;

class Camera {
	/**
	 * Get the list of all te cameras
	 * 
	 * @return Object
	 */
	public static function all() {
		// get the db
		global $app;
		$db = $app->getDatabase();

		try {
			$cameras = $db->camera();
			$camerasArray = Transformer::objectsToArray($cameras);
			return $camerasArray;
		} catch (PDOException $e) {
			return false;
		}
	}

	/**
	 * Gets a specified camera.
	 * 
	 * @param  string $key
	 * @param  mixed $value
	 * @return object
	 */
	public static function get($key, $value) {
		// get the db
		global $app;
		$db = $app->getDatabase();

		// get the camera
		try {
			$cameraQuery = $db->camera("$key = ?", "$value");
			$camera = $cameraQuery->fetch();
			$cameraCount = $cameraQuery->count();

			if ($cameraCount < 1) {
				return false;
			}
			return $camera;
		} catch (PDOException $e) {
			return false;
		}
	}
}
