<?php

class IdeaalitController extends BaseController {

    public static function index() {
        $ideaalit = Ideaali::all();

        View::make('ideaalit/selaIdeaaleja.html', array('ideaalit' => $ideaalit));
//        View::make('home.html');
    }

    public static function show($id) {
        $ideaali = Ideaali::find($id);

        View::make('ideaalit/ideaali.html', array('ideaali' => $ideaali));
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

    public static function destroy($id) {
        $ideaali = new Ideaali(array('id' => $id));
        $ideaali->destroy();
        Redirect::to('/ideaali');
    }

}
