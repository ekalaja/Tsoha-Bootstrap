<?php


$routes->get('/', function() {
    KayttajaController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/tavarat', function() {
    TavaratController::index();
});

$routes->get('/tavarat/omatTavarat.html', function() {
    TavaratController::kayttajanTavarat();
});

$routes->post('/tarjous/:id', function($id) {
    TarjousController::teeTarjous($id);
});

$routes->post('/tavarat/omatTavarat.html', function() {
    TavaratController::store();
});

$routes->get('/tavarat/vaihdot.html', function() {
    TarjousController::vaihdot();
});

$routes->post('/tarjoukset/:id', function($id) {
    TarjousController::destroy($id);
});

$routes->get('/tavarat/:id', function($id) {
    TavaratController::show($id);
});

$routes->post('/tavarat/:id/destroy', function($id) {
    TavaratController::destroy($id);
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


$routes->get('ideaalit/new', function() {
    IdeaalitController::create();
});

$routes->get('/ideaalit/:id', function($id) {
    IdeaalitController::show($id);
});

$routes->get('/ideaalit/:id/edit', function($id) {
    IdeaalitController::edit($id);
});

$routes->post('/ideaalit/:id/edit', function($id) {
    IdeaalitController::update($id);
});

$routes->get('/kirjautuminen', function() {
    KayttajaController::kirjautuminen();
});

$routes->post('/kirjautuminen', function() {
    KayttajaController::kasittele_kirjautuminen();
});

$routes->post('/kirjaudu_ulos', function() {
    KayttajaController::kirjaudu_ulos();
});

$routes->get('/kayttajat', function() {
    KayttajaController::omat_tiedot();
});

$routes->post('/kayttajat/:id', function($id) {
    KayttajaController::update($id);
});

$routes->post('/tavarat/lukitut/:id', function($id) {
    TavaratController::lukitse($id);
});

