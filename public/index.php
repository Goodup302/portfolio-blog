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
    $controller = new \App\Controller\PostController();
    $controller->home();
} else if ($page === 'loop') {

} else if ($page === 'single') {

} else if ($page === '404') {

} else if ($page === 'auth') {

}