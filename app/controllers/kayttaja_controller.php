<?php

class KayttajaController extends BaseController {

    public static function index() {
        View::make('home.html');
    }

    public static function kirjautuminen() {
        View::make('kayttajat/kirjautuminen.html');
    }

    public static function kasittele_kirjautuminen() {
        $params = $_POST;
        $kayttaja = Kayttaja::authenticate($params['tunnus'], $params['salasana']);


        if (!$kayttaja) {
            View::make('kayttajat/kirjautuminen.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'tunnus' => $params['tunnus']));
        } else {
            $_SESSION['id'] = $kayttaja->id;
            self::get_user_logged_in();
            Redirect::to('/', array('viesti' => 'Tervetuloa takaisin ' . $kayttaja->nimi . '!'));
        }
    }

    public static function omat_tiedot() {
        self::check_logged_in();
        View::make('kayttajat/omatTiedot.html');
    }

}
