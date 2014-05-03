<?php
require '../vendor/autoload.php';
require '../vendor/lib/mysql.php';



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

$app->get('/', function () use ($app) {
    $db = connectdb();
    /*katrs connect ir kaa astevishkjsh pieprasijums */
    $query = "SELECT * FROM product WHERE price > 50 ORDER BY id ASC LIMIT 3";
    $result = $db->query($query);
    $data = array();
    while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
        $data[]=$row;
    };
    /* var_dump($data); */
    $app->render('pages/index.html.twig', array(
        "active" => "home",
        "data" => $data
        ));
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

$app->get('/admin', function () use ($app) {
    $app->render('admin/dashboard.html.twig', array("active" => "admin"));
})->name('admin');


$app->get('/admin/product/list', function () use ($app) {
    $db = connectdb();
    /*katrs connect ir kaa astevishkjsh pieprasijums */
    $query = "SELECT * FROM product ORDER BY id ASC";
    $result = $db->query($query);
    $data = array();
    while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
        $data[]=$row;
    };
    $app->render('admin/product/list.html.twig', array(
        "active" => "list",
        "data" => $data
        ));
})->name('list');

$app->get('/admin/product/add', function () use ($app) {
    $app->render('admin/product/list.html.twig', array("active" => "add"));
})->name('add');

$app->get('/admin/product/edit', function () use ($app) {
    $app->render('admin/product/list.html.twig', array("active" => "edit"));
})->name('edit');

$app->get('/admin/product/delete', function () use ($app) {
    $db = connectdb();
    /*katrs connect ir kaa astevishkjsh pieprasijums */
    $query = "SELECT * FROM product ORDER BY id ASC";
    $result = $db->query($query);
    $data = array();
    while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
        $data[]=$row;
    };
    $app->render('admin/product/list.html.twig', array(
        "active" => "delete",
        "data" => $data
        ));
})->name('delete');

$app->get('/admin/product/view', function () use ($app) {
    $app->render('admin/product/list.html.twig', array("active" => "view"));
})->name('view');

/* ENGLISH VERSION */

$app->run();