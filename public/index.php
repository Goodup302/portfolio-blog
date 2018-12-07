<?php
define('ROOT', dirname(__DIR__));
define('CONFIG_FILE', ROOT . '/config.php');

require_once ROOT . '/app/App.php';
App::load();
$app = App::getInstance();


if (isset($_GET['p'])) {
    $page = $_GET['p'];
} else {
    $page = 'home';
}


if ($page === 'home') {
    (new \App\Controller\AppController())->home();




} else if ($page === 'loop') {
    (new \App\Controller\PostController())->loop();
} else if ($page === 'single') {
    (new \App\Controller\PostController())->single();

} else if ($page === '404') {
    $controller->error404();
} else if ($page === 'auth') {
    $controller->auth();



} else if ($page === '404') {
    $controller->error404();
} else if ($page === 'auth') {
    $controller->auth();
}