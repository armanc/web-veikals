<?php
require '../vendor/autoload.php';

$app = new \Slim\Slim(array(
    'debug' => true,
    'view' => new \Slim\Views\Twig(),
    'templates.path' => '../templates',
));

$view = $app->view();
$view->parserOptions = array(
    'debug' => true,
);
$view->parserExtensions = array(
    new \Slim\Views\TwigExtension(),
);

/* */

echo 'faffdsfs';

$app->get('/', function () use ($app) {
    $app->render('base.html.twig', array("active" => "home"));
})->name('home');

$app->get('/', function () use ($app) {
    $app->render('info.html.twig', array("active" => "info"));
})->name('home');

$app->get('/', function () use ($app) {
    $app->render('contacts.html.twig', array("active" => "contacts"));
})->name('home');

$app->get('/', function () use ($app) {
    $app->render('base.html.twig', array("active" => "auctions"));
})->name('home');

$app->get('/', function () use ($app) {
    $app->render('base.html.twig', array("active" => "collections"));
})->name('home');

$app->get('/', function () use ($app) {
    $app->render('base.html.twig', array("active" => "product"));
})->name('home');

$app->run();