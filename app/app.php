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

  $app->get("/", function() use ($app) {
    return $app['twig']->render('index.html.twig', array('brands' => Brand::getAll(), 'stores' => Store::getAll()));
  });

  $app->get("/stores", function() use ($app) {
    return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
  });

  $app->post("/stores", function() use ($app) {
    return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
  });

  $app->get("/brands", function() use ($app) {
    return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
  });

  $app->post("/brands", function() use ($app) {
    return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
  });


  return $app;
?>
