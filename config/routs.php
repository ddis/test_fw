<?php

$router = \kernel\Route::getInstance();

$router->get('\/', [\app\controllers\IndexController::class, 'index']);
$router->get('\/html\/create', [\app\controllers\HtmlController::class, 'create']);
$router->get('\/html\/edit\/([\d]+)', [\app\controllers\HtmlController::class, 'edit']);

$router->post('\/create', [\app\controllers\ItemsController::class, 'create']);
$router->post('\/edit\/([\d]+)', [\app\controllers\ItemsController::class, 'edit']);
$router->delete('\/delete\/([\d]+)', [\app\controllers\ItemsController::class, 'delete']);

