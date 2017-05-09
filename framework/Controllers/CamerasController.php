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

		// get the camera type and display the render page according to that attribute
		if ($camera["type"] == "stream") {
			// display the view with the camera stream
			render("cameras/stream", ["camera" => $camera]);
		} else {
			render("cameras/imagestream", ["camera" => $camera]);
		}
	}

	/**
	 * Displays the view for creating new cameras.
	 * 
	 * @return view
	 */
	public static function create() {
		render("cameras/create");
	}

	/**
	 * Persists the newly created camera to the database.
	 * 
	 * @param  array $data
	 * @return view
	 */
	public static function store($data) {
		// store into database
		$record = Camera::store($data);

		if ($record) {
			// return back to lectures dashboard
			redirect('cameras');
		}
		redirect('/lecture');
	}

	/**
	 * Delets a specified camera.
	 * 
	 * @param  int $camera_id
	 * @return void
	 */
	public static function delete($camera_id) {
		// delete the camera
		$cameraToBeDeleted = Camera::get("id", $camera_id);
		if ($cameraToBeDeleted) {
			Camera::delete($cameraToBeDeleted["id"]);
		}

		// redirect back to index of users
		self::index();
	}

	/**
	 * Displays the archive view for the speciied camera.
	 * 
	 * @param  int $camera_id
	 * @return view
	 */
	public static function archive($camera_id) {
		// select all the cameras
		$camera = Camera::get("id", $camera_id);
		if (!$camera) {
			self::index();
		}

		dd($camera);

		// render the archive view with the camera
		render("cameras/archive", ["camera" => $camera]);
	}
}
