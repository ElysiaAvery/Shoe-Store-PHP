<?php
  date_default_timezone_set('America/Los_Angeles');

  require_once __DIR__."/../vendor/autoload.php";
  require_once __DIR__."/../src/Store.php";
  require_once __DIR__."/../src/Brand.php";

  $app = new Silex\Application();

  $server = 'mysql:host=127.0.0.1:8889;dbname=shoes';
  $username = 'root';
  $password = 'root';
  $DB = new PDO($server, $username, $password);

  $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
  ));

  use Symfony\Component\HttpFoundation\Request;
  Request::enableHttpMethodParameterOverride();

  //Home Page
  $app->get("/", function() use ($app) {
    return $app['twig']->render('index.html.twig', array('brands' => Brand::getAll(), 'stores' => Store::getAll()));
  });

  //All Shoe Stores and can add more Shoe Stores
  $app->get("/stores", function() use ($app) {
    return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
  });

  $app->post("/stores", function() use ($app) {
    $store = new Store($_POST['name']);
    $store->save();
    return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
  });

  //Individual Stores and add Brands to Stores
  $app->get("/stores/{id}", function($id) use ($app) {
    $store = Store::find($id);
    return $app['twig']->render('store.html.twig', array('store' => $store, 'brands' => $store->getBrands(), 'all_brands' => Brand::getAll()));
  });

  $app->post("/add_brands", function() use ($app) {
    $brand = Brand::find($_POST['brand_id']);
    $store = Store::find($_POST['store_id']);
    $store->addBrand($brand);
    return $app['twig']->render('store.html.twig', array('store' => $store, 'stores' => Store::getAll(), 'brands' => $store->getBrands(), 'all_brands' => Brand::getAll()));
  });

  //Edit Shoe Stores name
  $app->get("/stores/{id}/edit", function($id) use ($app) {
    $store = Store::find($id);
    return $app['twig']->render('store_edit.html.twig', array('store' => $store));
  });

  $app->patch("/stores/{id}", function($id) use ($app) {
    $name = $_POST['name'];
    $store = Store::find($id);
    $store->update($name);
    return $app['twig']->render('store.html.twig', array('store' => $store, 'brands' => $store->getBrands()));
  });

  //Delete Shoe Stores
  $app->delete("/stores/{id}", function($id) use ($app) {
    $store = Store::find($id);
    $store->delete();
    return $app['twig']->render('index.html.twig', array('stores' => Store::getAll()));
  });

  $app->post("/delete_stores", function() use ($app) {
    Store::deleteAll();
    return $app['twig']->render('index.html.twig');
  });

  //All Shoe Brands and can add more Shoe Brands
  $app->get("/brands", function() use ($app) {
    return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
  });

  $app->post("/brands", function() use ($app) {
    $brand = new Brand($_POST['name']);
    $brand->save();
    return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
  });

  //Individual Shoe Brands and add Stores to Brands
  $app->get("/brands/{id}", function($id) use ($app) {
    $brand = Brand::find($id);
    return $app['twig']->render('brand.html.twig', array('brand' => $brand, 'stores' => $brand->getStores(), 'all_stores' => Store::getAll()));
  });

  $app->post("/add_stores", function() use ($app) {
    $brand = Brand::find($_POST['brand_id']);
    $store = Store::find($_POST['store_id']);
    $brand->addStore($store);
    return $app['twig']->render('brand.html.twig', array('brand' => $brand, 'brands' => Brand::getAll(), 'stores' => $brand->getStores(), 'all_stores' => Store::getAll()));
  });

  //Edit Shoe Brands name
  $app->get("/brands/{id}/edit", function($id) use ($app) {
    $brand = Brand::find($id);
    return $app['twig']->render('brand_edit.html.twig', array('brand' => $brand));
  });

  $app->patch("/brands/{id}", function($id) use ($app) {
    $name = $_POST['name'];
    $brand = Brand::find($id);
    $brand->update($name);
    return $app['twig']->render('brand.html.twig', array('brand' => $brand, 'stores' => $brand->getStores()));
  });

  //Delete Shoe Brands
  $app->delete("/brands/{id}", function($id) use ($app) {
    $brand = Brand::find($id);
    $brand->delete();
    return $app['twig']->render('index.html.twig', array('brands' => Brand::getAll()));
  });

  $app->post("/delete_brands", function() use ($app) {
    Brand::deleteAll();
    return $app['twig']->render('index.html.twig');
  });

  return $app;
?>
