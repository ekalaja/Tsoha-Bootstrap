<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/tavarat', function() {
    TavaratController::index();
});

$routes->get('/tavarat/:id', function($id) {
    TavaratController::show($id);
});

$routes->get('/ideaalit', function() { 
    IdeaalitController::index();
});

$routes->post('/ideaalit', function() {
    IdeaalitController::store();
});

$routes->post('/ideaalit/:id/destroy', function($id) {
    IdeaalitController::destroy($id);
});

//$routes->get('ideaali/new', function() {
//    IdeaalitController::create();
//});

  $routes->get('/ideaali/:id', function($id) {
      IdeaalitController::show($id);
  });
//
//$routes->get('/ideaali/1', function() {
//    HelloWorldController::kirjautuminen();
//});

$routes->get('/kirjautuminen', function() {
    HelloWorldController::kirjautuminen();
});
