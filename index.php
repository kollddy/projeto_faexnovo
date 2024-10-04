<?php

require_once './vendor/autoload.php';

session_start();

use Regivaldo\Videos\Routers\Loader;
// use Regivaldo\Videos\Models\Users\Users;

// $user = new Users();

// $data = $user->findAll();

// var_dump($data);

$loader = new Loader();
$loader->execute();