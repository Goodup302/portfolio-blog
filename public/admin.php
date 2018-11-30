<?php
use \Core\Auth\DBAuth;

define('ROOT', dirname(__DIR__));
define('CONFIG_FILE', ROOT . '/config.php');

require_once ROOT . '/app/App.php';
App::load();
$app = App::getInstance();

// Auth
$auth = new DBAuth($app->getDatabase());
if (!$auth->isLogged()) {
    $app->errorAuth();
}



if (isset($_GET['p'])) {
    $page = $_GET['p'];
} else {
    $page = 'home';
}

$app->setTitle('Administration');

ob_start();
if ($page === 'home') {
    require_once ROOT . '/page/admin/index.php';


} else if ($page === 'posts') {
    require_once ROOT . '/page/admin/posts/index.php';


} else if ($page === 'post_add') {
    require_once ROOT . '/page/admin/posts/add.php';


} else if ($page === 'post_edit') {
    require_once ROOT . '/page/admin/posts/edit.php';


} else if ($page === 'post_delete') {
    require_once ROOT . '/page/admin/posts/delete.php';


}
$content = ob_get_clean();
require_once( ROOT.'/page/templates/default.php');