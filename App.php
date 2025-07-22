<?php

require_once "./vendor/autoload.php";

use EShopPhp\Config\Database;
use EShopPhp\Repository\BooklistRepository;
use EShopPhp\Service\BooklistService;
use EShopPhp\View\BooklistView;

echo "Aplikasi Booklist" . PHP_EOL;

$connection = Database::getConnection();
$booklistRepository = new BooklistRepository($connection);
$booklistService = new BooklistService($booklistRepository);
$booklistView = new BooklistView($booklistService);

$booklistView->showBooklist();