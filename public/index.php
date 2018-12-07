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

//Front Page
if ($page === 'home') {
    (new \App\Controller\AppController())->home();
} else if ($page === 'about') {
    (new \App\Controller\AppController())->about();
} else if ($page === 'contact') {
    (new \App\Controller\AppController())->contact();



//Front Post Page
} else if ($page === 'loop') {
    (new \App\Controller\PostController())->loop();
} else if ($page === 'single') {
    (new \App\Controller\PostController())->single();

} else if ($page === 'auth') {
    (new \App\Controller\UserController())->auth();

// Admin

} else if ($page === 'admin') {
    (new \App\Controller\Admin\AppController())->home();

// Admin post CRUD
} else if ($page === 'admin_posts') {
    (new \App\Controller\Admin\PostController())->loop();
} else if ($page === 'admin_posts_edit') {
    (new \App\Controller\Admin\PostController())->edit();
} else if ($page === 'admin_posts_add') {
    (new \App\Controller\Admin\PostController())->add();
} else if ($page === 'admin_posts_delete') {
    (new \App\Controller\Admin\PostController())->delete();

// Admin comment CRUD
} else if ($page === 'admin_comments') {
    (new \App\Controller\Admin\CommentController())->loop();
} else if ($page === 'admin_comments_valid') {
    (new \App\Controller\Admin\CommentController())->valid();
} else if ($page === 'admin_comments_delete') {
    (new \App\Controller\Admin\CommentController())->delete();



// ERROR
} else if ($page === '404') {
    (new \App\Controller\AppController())->error404();


}