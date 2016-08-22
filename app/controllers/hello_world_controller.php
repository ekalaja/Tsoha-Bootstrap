<?php

//require 'app/models/kayttaja.php';

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        View::make('home.html');
    }

    public static function sandbox() {
        $dark = new Ideaali(array(
            'nimi' => 'doge',
            'luokka' => '',
            'vari' => 'musta'
        ));
        $errors = $dark->errors();
        Kint::dump($errors);
        
        
//        $kayttajat = Kayttaja::all();
//        $mattiko = Kayttaja::find(1);
//        $tavarat = Tavara::all();
//        $tavarako = Tavara::find(1);
        // Testaa koodiasi täällä
//      View::make('helloworld.html');
//        Kint::dump($kayttajat);
//        Kint::dump($mattiko);
//        Kint::dump($tavarat);
//        Kint::dump($tavarako);
    }


    public static function kirjautuminen() {
        View::make('kirjautuminen.html');
    }

}
