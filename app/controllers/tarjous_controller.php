<?php

Class TarjousController extends BaseController {

    public static function vaihdot() {
        self::check_logged_in();
        $tarjotut = Tarjous::tarjotutVaihdot($_SESSION['id']);
        $ehdotukset = Tarjous::ehdotetutVaihdot($_SESSION['id']);
//        Kint::dump($ehdotukset);
//        View::make('/tavarat/vaihdot.html', array('ehdotukset' => $ehdotukset));

        View::make('/tavarat/vaihdot.html', array('tarjotut' => $tarjotut, 'ehdotukset' => $ehdotukset));
    }

    public static function poistaTarjous($id) {
        $tarjous = new Tarjous(array('id' => $id));
//        Kint::dump($tarjous);
        $tarjous->destroy();
//        Redirect::to('/tavarat');
    }

    public static function destroy($id) {
        $tarjous = new Tarjous(array('id' => $id));
        $tarjous->destroy();
        Redirect::to('/tavarat/vaihdot.html');
    }

}
