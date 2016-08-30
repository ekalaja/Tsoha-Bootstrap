<?php

class TavaratController extends BaseController {

    
    
    
    public static function index() {
        self::check_logged_in();
        $tavarat = Tavara::all();
//        Kint::dump($tavarat);

        View::make('tavarat/selailu.html', array('tavarat' => $tavarat));
    }

    public static function show($id) {
        self::check_logged_in();
        $tavara = Tavara::find($id);
//        Kint::dump($tavara->kayttaja_id);
        if ($_SESSION['id'] == $tavara->kayttaja_id) {
            View::make('tavarat/tavara.html', array('tavara' => $tavara));
        }else{
            View::make('tavarat/vierasTavara.html', array('tavara' => $tavara));
        }
    }

    public static function kayttajanTavarat() {
        self::check_logged_in();
        $tavarat = Tavara::kayttajanTavarat($_SESSION['id']);
        $ideaalit = Ideaali::all();
//        Kint::dump($tavarat);
        View::make('tavarat/omatTavarat.html', array('tavarat' => $tavarat, 'ideaalit' => $ideaalit));
    }

    public static function store() {
        $params = $_POST;
//        Kint::dump($params);
        $attributes = array(
            'kayttaja_id' => $params['kayttaja_id'],
            'ideaali_id' => $params['tavara'],
            'kunto' => $params['kunto']
        );
        if ($params['kohde'] != "") {
            $attributes['vaihtokohde_id'] = $params['kohde'];
        }

        $tavara = new Tavara($attributes);
        $tavara->save();
        Redirect::to('/tavarat/omatTavarat.html', array('viesti' => 'Tavara lisätty!'));
    }

    public static function destroy($id) {
        $tavara = new Tavara(array('id' => $id));
        $tavara->destroy();
        Redirect::to('/tavarat/omatTavarat.html', array('viesti' => 'Tavara poistettu.'));
    }
    
    public static function lukitse($id) {
        $tavara = new Tavara(array('id' => $id));
        $tavara->lukitse();
        Redirect::to('/tavarat');
        //kirjoita lukitsemiskoodi tavaralle ja kutsu sitä
    }
    
}
