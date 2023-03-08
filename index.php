<?php

namespace SF\Foundation;

include_once $_SERVER['DOCUMENT_ROOT'] . '/sf/support/ClassAutoloader.php';
\SF\Support\ClassAutoloader::run();

$app = Application::get();
$app->addRouteMap('web')->run();