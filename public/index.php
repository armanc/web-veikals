<?php
session_cache_limiter(false); //palielina sesijas lielumu
session_start(); // palaizh sesiju

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
    $query = "SELECT * FROM product WHERE price > 5 ORDER BY id ASC LIMIT 3";
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
    $app->render('admin/product/add.html.twig', array());
})->name('add');
$app->post('/admin/product/add', function () use ($app) {
    addProduct();
    $app->redirect($app->urlFor('list'));
});


$app->get('/admin/product/delete/:id', function ($id) use ($app) {
 
    
    if (delProduct($id)) {
        $app->flash('success','Product deleted!');
    } else {
        $app->flash('error','Product delete failed!');
    }

    $app->redirect($app->urlFor('list'));
})->name('delete');


$app->get('/admin/product/edit/:id', function ($id) use ($app) {
    $db = connectdb();
    /*katrs connect ir kaa astevishkjsh pieprasijums */
    $query = "SELECT * FROM product WHERE id='$id'";
    $result = $db->query($query);
    $data = null;
    while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
        $data=$row;
    };
    /* var_dump($data); */
    $app->render('admin/product/edit.html.twig', array(
        "product" => $data
        ));
})->name('edit');
$app->post('/admin/product/edit/:id', function ($id) use ($app) {
    updateProduct($id);
    $app->redirect($app->urlFor('list',array('id'=>$id)));
});

$app->get('/admin/product/view', function () use ($app) {
    $app->render('admin/product/list.html.twig', array("active" => "view"));
})->name('view');

$app->run();