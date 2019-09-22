<?php
if (!session_id()) @session_start();
require_once __DIR__ . '/vendor/autoload.php';

define('PATH', __DIR__);

use App\Helper\Loader;

$app = new Loader();
$app->start();
