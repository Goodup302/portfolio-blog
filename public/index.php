<?php

namespace App;
require_once '../app/Autoloader.php';
\App\Autoloader::register();



if (isset($_GET['p'])) {
    $page = $_GET['p'];
} else {
    $page = 'home';
}

ob_start();
if ($page === 'home') {
    //require_once '';
}
require_once '../page/'.$page.'.php';
$content = ob_get_clean();

require_once('../page/templates/default.php');