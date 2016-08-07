<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/hiekkaa', function() { //testiä
    HelloWorldController::hiekkaa();
  });
  
  $routes->get('/kirjautuminen', function() { 
    HelloWorldController::kirjautuminen();
  });
