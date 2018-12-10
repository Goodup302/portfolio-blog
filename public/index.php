<?php
use \App\Controller\AppController;
use \App\Controller\PostController;
use \App\Controller\UserController;
use \App\Controller\Admin;
require_once '../app/App.php';

switch (App::load()) {
    //Front Page
    case 'home':
        (new AppController())->home(); break;
    case 'about':
        (new AppController())->about(); break;
    case 'contact':
        (new AppController())->contact(); break;
    case '404':
        (new AppController())->error404(); break;
    case 'auth':
        (new UserController())->auth(); break;

    //Front Post Page
    case 'loop':
        (new PostController())->loop(); break;
    case 'single':
        (new PostController())->single(); break;

    //Admin
    case 'admin':
        (new Admin\AppController())->home(); break;
    //Post CRUD
    case 'admin_posts':
        (new Admin\PostController())->loop(); break;
    case 'admin_posts_edit':
        (new Admin\PostController())->edit(); break;
    case 'admin_posts_add':
        (new Admin\PostController())->add(); break;
    case 'admin_posts_delete':
        (new Admin\PostController())->delete(); break;
    //Comment CRUD
    case 'admin_comments':
        (new Admin\CommentController())->loop(); break;
    case 'admin_comments_valid':
        (new Admin\CommentController())->valid(); break;
    case 'admin_comments_delete':
        (new Admin\CommentController())->delete(); break;
}