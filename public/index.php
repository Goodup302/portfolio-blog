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


ob_start();
if ($page === 'home') {
    require_once ROOT.'/page/home.php';


} else if ($page === 'loop') {
    require_once ROOT . '/page/posts/loop.php';


} else if ($page === 'single') {
    require_once ROOT . '/page/posts/single.php';


} else if ($page === '404') {
    require_once ROOT . '/page/errors/404.php';


} else if ($page === 'auth') {
    require_once ROOT . '/page/users/auth.php';


}
$content = ob_get_clean();
require_once( ROOT.'/page/templates/default.php');