<?php
/**
 * Application routing
 */
use Controllers\PagesController;
use Controllers\UserController;
use Controllers\LectureController;
use Controllers\CamerasController;
use Controllers\AdminController;

use Models\Auth;
use Core\Middleware;

// instantiate the router
$router = new AltoRouter();

// index
$router->map('GET', '/', function() {
    PagesController::index();
});

// displays the register page
$router->map('GET', '/register', function() {
    redirectIfNotAdmin();
    PagesController::register();
});

// displays the login page
$router->map('GET', '/login', function() {
    if ( ! Auth::user() ) {
        PagesController::login();
    }
    PagesController::index();
});

// logs the user in
$router->map('POST', '/login', function() {
    UserController::login($_POST);
});

// logs the user out
$router->map('GET', '/logout', function() {
    Auth::logout();
});

// show user settings
$router->map('GET', '/settings', function() {
    redirectIfNotLoggedIn();
    UserController::settings();
});

// changes the app's language
$router->map('GET', '/language/[a:locale]', function($locale) {
    global $app;
    $app->setLocale($locale);
    UserController::settings();
});


/**
 * User routes
 */
// block a user
$router->map('GET', '/user/block/[i:user_id]', function($user_id) {
    redirectIfNotAdmin();
    UserController::block($user_id);
});
// unblock a user
$router->map('GET', '/user/unblock/[i:user_id]', function($user_id) {
    redirectIfNotAdmin();
    UserController::unblock($user_id);
});
// delete a user
$router->map('GET', '/user/delete/[i:user_id]', function($user_id) {
    redirectIfNotAdmin();
    UserController::delete($user_id);
});
// see user's lectures
$router->map('GET', '/user/[i:user_id]/lectures', function($user_id) {
    UserController::lectures($user_id);
});
// show a user
$router->map('GET', '/user/[i:user_id]', function($user_id) {
    redirectIfNotAdmin();
    UserController::show($user_id);
});
// index all users
$router->map('GET', '/users', function() {
    redirectIfNotAdmin();
    UserController::index();
});
// register a new user
$router->map('POST', '/register', function() {
    redirectIfNotAdmin();
    UserController::create($_POST);
});
// render a view with a form to create a new admin
$router->map('GET', '/admin/create', function() {
    redirectIfNotAdmin();
    AdminController::create();
});

$router->map('POST', '/admin', function() {
    redirectIfNotAdmin();
    AdminController::store($_POST);
});


/**
 * Lecture routes
 */
// get all the lectures
$router->map('GET', '/lectures', function() {
    LectureController::index();
});

// display a list of all the lectures
$router->map('GET', '/lectures/list', function() {
    LectureController::lecturelist();
});

// get the lecture dashboard
$router->map('GET', '/lecture', function() {
    redirectIfNotLoggedIn();
    LectureController::dashboard();
});
// persist a newly reated lecture to the database
$router->map('POST', '/lecture', function() {
    redirectIfNotLoggedIn();
    LectureController::store($_POST);
});
// displays the form for creating new lectures
$router->map('GET', '/lecture/create', function() {
    redirectIfNotLoggedIn();
    if (! isUserAdmin()) {
        LectureController::dashboard();
    }
    LectureController::create();
});
// shows a single lecture
$router->map('GET', '/lecture/[i:lecture_id]', function($lecture_id) {
    redirectIfNotLoggedIn();
    LectureController::show($lecture_id);
});
// subscribe to a lecture
$router->map('GET', '/subscribe/[i:lecture_id]', function($lecture_id) {
    redirectIfNotLoggedIn();
    UserController::subscribe($lecture_id);
});
// unsubscribe from a lecture
$router->map('GET', '/unsubscribe/[i:lecture_id]', function($lecture_id) {
    redirectIfNotLoggedIn();

    if (Middleware::isUserSubscribedToLecture($lecture_id)) {
        UserController::unsubscribe($lecture_id);
    }
    PagesController::index();
});

/**
 * Camera routes
 */
$router->map('GET', '/cameras', function () {
    CamerasController::index();
});
$router->map('GET', '/camera/[i:camera_id]', function ($camera_id) {
    CamerasController::show($camera_id);
});
$router->map('GET', '/camera/[i:camera_id]/archive', function($camera_id) {
    CamerasController::archive($camera_id);
});
$router->map('GET', '/cameras/create', function () {
    redirectIfNotAdmin();

    CamerasController::create();
});
$router->map('POST', '/cameras', function () {
    redirectIfNotAdmin();

    CamerasController::store($_POST);
});
$router->map('GET', '/camera/delete/[i:id]', function ($camera_id) {
    redirectIfNotAdmin();

    CamerasController::delete($camera_id);
});

$router->map('GET', '/getArchiveFrame/[i:camera_id]', function ($camera_id) {
    $seconds = 59;

    for ($i = 0; $i < $seconds; $i++) {
        $timestamp = date_create()->getTimestamp();
        // $url = 'http://96.10.1.168/mjpg/1/video.mjpg';
        $url = 'http://147.232.25.37/snap.jpg';

        $img = 'public/streamArchive/' . $camera_id . '/' . $timestamp . '.png';
        file_put_contents($img, file_get_contents($url));
    }
});

// handle route matches
$match = $router->match();
if( $match && is_callable( $match['target'] ) ) {
    call_user_func_array( $match['target'], $match['params'] );
} else {
    PagesController::index(["type" => "error", "body" => "Requested page not found"]);
}
