<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/hiekkaa', function() { //testiä
      TavaratController::index();
  });
  
  $routes->get('/ideaali', function() { //testiä
      IdeaalitController::index();
  });
  
  $routes->post('/ideaali', function(){
  IdeaalitController::store();
  });
  
  $routes->post('/ideaali/poista', function(){
  IdeaalitController::delete();
  });
  
  $routes->get('ideaali/new', function() {
      IdeaaliController::create();
  });
  
  $routes->get('/kirjautuminen', function() { 
    HelloWorldController::kirjautuminen();
  });
