<?php

class IdeaalitController extends BaseController {

    public static function index() {
        $ideaalit = Ideaali::all();

        View::make('selaaIdeaaleja.html', array('ideaalit' => $ideaalit));
    }

    public static function store() {
        $params = $_POST;

        $ideaali = new Ideaali(array(
            'nimi' => $params['nimi'],
            'luokka' => $params['luokka'],
            'vari' => $params['vari']
        ));
//        Kint::dump($params);
        $ideaali->save();
        Redirect::to('/ideaali');
    }
    
    public static function delete() {
        Ideaali::delete();
    }

}
