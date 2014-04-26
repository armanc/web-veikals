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

/* DEFAULT: RUS */

$app->get('/', function () use ($app) {
    $app->render('pages/index.html.twig', array("active" => "home"));
})->name('home');

$app->get('/info', function () use ($app) {
    $app->render('pages/info.html.twig', array("active" => "info"));
})->name('info');

$app->get('/contacts', function () use ($app) {
    $app->render('pages/contacts.html.twig', array("active" => "contacts"));
})->name('contacts');

$app->get('/sale', function () use ($app) {
    $app->render('pages/sale.html.twig', array("active" => "sale"));
})->name('sale');

$app->get('/collections', function () use ($app) {
    $app->render('pages/collections.html.twig', array("active" => "collections"));
})->name('collections');

$app->get('/product', function () use ($app) {
    $app->render('pages/product.html.twig', array("active" => "product"));
})->name('product');

/* ENGLISH VERSION */

$app->run();