<?php

define('ROOT', dirname(__DIR__));
require_once ROOT . '/app/App.php';
App::load();

$app = App::getInstance();
//$config = Config::getInstance();


if (isset($_GET['p'])) {
    $page = $_GET['p'];
} else {
    $page = 'home';
}

ob_start();
require_once '../page/'.$page.'.php';
$content = ob_get_clean();

require_once('../page/templates/default.php');