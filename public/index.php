<?php

use EShopPhp\App\Router;
use EShopPhp\Config\Database;
use EShopPhp\Controller\BooklistController;
use EShopPhp\Controller\UserController;

require_once __DIR__ . "/../vendor/autoload.php";

Router::add('GET', '/', BooklistController::class, 'index', []);
Router::add('GET', '/add', BooklistController::class, 'addBooklist', []);
Router::add('POST', '/add', BooklistController::class, 'postAddBooklist', []);
Router::add('GET', '/delete', BooklistController::class, 'postDeleteBooklist', []);

Router::add('GET', '/signin', UserController::class, 'signInPage', []);
Router::add('GET', '/signup', UserController::class, 'signUpPage', []);
Router::add('GET', '/logout', UserController::class, 'logout', []);
Router::add('POST', '/signin', UserController::class, 'signIn', []);
Router::add('POST', '/signup', UserController::class, 'signUp', []);

Router::run();