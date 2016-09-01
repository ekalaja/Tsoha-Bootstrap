<?php

class BaseController {

    public static function get_user_logged_in() {
        // Katsotaan onko user-avain sessiossa
        if (isset($_SESSION['id'])) {
            $kayttaja_id = $_SESSION['id'];
            // Pyydetään User-mallilta käyttäjä session mukaisella id:llä
            $kayttaja = Kayttaja::find($kayttaja_id);

            return $kayttaja;
        }
    }

    public static function check_logged_in() {
        // Toteuta kirjautumisen tarkistus tähän.
        // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).
        if (!isset($_SESSION['id'])) {
            Redirect::to('/kirjautuminen', array('viesti' => 'Kirjaudu ensin sisään!'));
        }
    }

    public static function logged_in() {
        if (!isset($_SESSION['id'])) {
            return true;
        } else {
            return false;
        }
    }

    public static function authenticate_user_action($id) {
        if ($_SESSION['id'] != $id) {
            Redirect::to('/', array('varoitus' => 'Oikeudet toimintoon puuttuvat!'));
        }
    }

}
