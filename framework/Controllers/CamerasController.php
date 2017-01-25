<?php

namespace Controllers;

use Models\Camera;

class CamerasController {
	/**
	 * Displays the list of all the cameras.
	 * 
	 * @return view
	 */
	public static function index() {
		// get all the cameras
		$cameras = Camera::all();

		// display the view with all the cameras
		render("cameras/index", ["cameras" => $cameras]);
	}

	/**
	 * Shows the view with the stream of the specified camera.
	 * 
	 * @param  int $camera_id
	 * @return view
	 */
	public static function show($camera_id) {
		// select the specified camera
		$camera = Camera::get("id", $camera_id);

		// display the view with the camera stream
		render("cameras/stream", ["camera" => $camera]);
	}
}
