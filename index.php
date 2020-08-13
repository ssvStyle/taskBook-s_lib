<?php
session_start();

include __DIR__ . '/vendor/autoload.php';

use Core\FrontController;

/**
 * SIMON-LIB
 *
 *
 *
 */

$myApp = new FrontController();

$myApp->run();



