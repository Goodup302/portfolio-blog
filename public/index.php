<?php

namespace App;
require_once '../app/Autoloader.php';
\App\Autoloader::register();


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