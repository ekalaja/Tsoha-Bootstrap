<?php

class TavaratController extends BaseController {

    public static function index() {
        self::check_logged_in();
        $tavarat = Tavara::all();

        View::make('tavarat/selailu.html', array('tavarat' => $tavarat));
    }

    public static function show($id) {
        self::check_logged_in();
        $tavara = Tavara::find($id);
        View::make('tavarat/tavara.html', array('tavara' => $tavara));
    }

    public static function kayttajanTavarat() {
        self::check_logged_in();
        $tavarat = Tavara::kayttajanTavarat($_SESSION['id']);
//        Kint::dump($tavarat);
        View::make('tavarat/omatTavarat.html', array('tavarat' => $tavarat));
    }

}
