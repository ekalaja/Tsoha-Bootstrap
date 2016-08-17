<?php

class TavaratController extends BaseController {

    public static function index() {
        $tavarat = Tavara::all();

        View::make('tavarat/selailu.html', array('tavarat' => $tavarat));
    }
    
        public static function show($id) {
        $tavara = Tavara::find($id);
        View::make('tavarat/tavara.html', array('tavara' => $tavara));
    }

}
