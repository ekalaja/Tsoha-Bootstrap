<?php

class BaseModel {

    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null) {
        // Käydään assosiaatiolistan avaimet läpi
        foreach ($attributes as $attribute => $value) {
            // Jos avaimen niminen attribuutti on olemassa...
            if (property_exists($this, $attribute)) {
                // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
                $this->{$attribute} = $value;
            }
        }
    }

    public function validate_nimi() {
        $errors = array();
        if ($this->nimi == '' || $this->nimi == null) {
            $errors[] = 'Nimi ei saa olla tyhjä';
        }
        if (strlen($this->nimi) < 3) {
            $errors[] = 'Nimen tulee olla vähintään kolme merkkiä pitkä!';
        }
        return $errors;
    }

    public function validate_uniikki_nimi() {
        $query = DB::connection()->prepare('SELECT * FROM Ideaali WHERE nimi = :nimi LIMIT 1');
        $query->execute(array('nimi' => $this->nimi));
        $row = $query->fetch();
        $errors = array();

//        Kint::dump($row['id'], $this->id);
        if ($row['id'] != NULL) {
            if ($this->id != $row['id']) {
                $errors[] = 'Nimi on jo käytössä!';
            }
        }

        return $errors;
    }

    public function validate_luokka() {
        $errors = array();
        if ($this->luokka == '' || $this->luokka == null) {
            $errors[] = 'Luokka ei saa olla tyhjä';
        }
        if (strlen($this->luokka) < 3) {
            $errors[] = 'Luokan tulee olla vähintään kolme merkkiä pitkä!';
        }
        return $errors;
    }

    public function validate_vari() {
        $errors = array();
        if ($this->vari == '' || $this->vari == null) {
            $errors[] = 'Väri ei saa olla tyhjä';
        }
        if (strlen($this->vari) < 3) {
            $errors[] = 'Värin tulee olla vähintään kolme merkkiä pitkä!';
        }
        return $errors;
    }

    public function errors() {
        // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
        $errors = array();

        foreach ($this->validators as $validator) {
            // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
            $validator_errors = $this->{$validator}();
            $errors = array_merge($errors, $validator_errors);
        }

        return $errors;
    }

}
