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
    case 'auth':
        (new UserController())->auth(); break;
    case 'activate':
        (new UserController())->activate(); break;
    case 'account':
        (new UserController())->account(); break;

    //Front Post Page
    case 'loop':
        (new PostController())->loop(); break;
    case 'single':
        (new PostController())->single(); break;

    //Admin
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
    default:
        (new AppController())->error404("Cette page n'existe pas ou plus !"); break;
}
