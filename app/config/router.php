<?php
$router = $di->getRouter();

$router->addGet(
    '/api/activity',
    [
        'controller'=>'activity',
        'action' => 'show'
    ]
);

$router->addPost(
    '/api/activity',
    'activity::add'
);

$router->handle();
