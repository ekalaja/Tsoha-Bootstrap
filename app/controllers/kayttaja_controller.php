<?php

class KayttajaController extends BaseController {

    public static function index() {
        View::make('home.html');
    }

    public static function kirjautuminen() {
        View::make('kayttajat/kirjautuminen.html');
    }
    
    public static function kirjaudu_ulos() {
        $_SESSION['id'] = null;
        Redirect::to('/kirjautuminen', array('viesti' => 'Olet kirjautunut ulos.'));
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

    public static function update($id) {
        self::check_logged_in();

        $params = $_POST;
        $attributes = array(
            'nimi' => $params['nimi'],
            'email' => $params['email'],
            'id' => $id
        );
        $kayttaja = new Kayttaja($attributes);
        $errors = $kayttaja->errors();
//        Kint::dump($errors);
        if (count($errors) > 0) {
            View::make('/kayttajat/omatTiedot.html', array('errors' => $errors, 'attributes' => $attributes));
        }else{
        $kayttaja->update();
        Redirect::to('/kayttajat', array('viesti' => 'Muutokset päivitetty!'));
        }
    }

}
