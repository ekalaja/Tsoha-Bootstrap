<?php

class TavaratController extends BaseController {

    public static function index() {
        $tavarat = Tavara::all();

        View::make('selailu.html', array('tavarat' => $tavarat));
    }

    public static function testi() {
        $tavarat = Tavara::all();
        View::make('jotkutTavarat.html', array('tavarat' => $tavarat));
    }

}
