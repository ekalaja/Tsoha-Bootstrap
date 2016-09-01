<?php

Class TarjousController extends BaseController {

    public static function vaihdot() {
        self::check_logged_in();
        $tarjotut = Tarjous::tarjotutVaihdot($_SESSION['id']);
        $ehdotukset = Tarjous::ehdotetutVaihdot($_SESSION['id']);
//        View::make('/tavarat/vaihdot.html', array('ehdotukset' => $ehdotukset));

        View::make('/tavarat/vaihdot.html', array('tarjotut' => $tarjotut, 'ehdotukset' => $ehdotukset));
    }

    public static function poistaTarjous($id) {
        $tarjous = new Tarjous(array('id' => $id));
        $tarjous->destroy();
//        Redirect::to('/tavarat');
    }

    public static function teeTarjous($id) {
        $params = $_POST;
//        Kint::dump($params['id']);
        $tavara = new Tavara(array('id' => $params['omaTavara']));        
        $omistajaId = $tavara->haeTavaranOmistaja();
        self::authenticate_user_action($omistajaId);
        
        $attributes = array(
            'kohde_id' => $id,
            'tarjottava_id' => $params['omaTavara']
        );

        $tarjous = new Tarjous($attributes);
        $tarjous->save();
        Redirect::to('/tavarat/vaihdot.html', array('viesti' => 'Tarjous lisätty!'));
    }

    public static function destroy($id) {
        $tarjous = new Tarjous(array('id' => $id));
        $tarjous->destroy();
        Redirect::to('/tavarat/vaihdot.html');
    }
    
    public static function valmis() {
        View::make('/tavarat/onnistunutVaihto.html');
    }

}
