<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
          View::make('home.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      View::make('helloworld.html');
    }
    
    public static function hiekkaa(){//testiä
      View::make('tarjouksetLukitut.html');
    }
    
    public static function kirjautuminen(){
      View::make('kirjautuminen.html');
    }
    
  }
