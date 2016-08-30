<?php

class Kayttaja extends BaseModel {

    public $id, $tunnus, $salasana, $email, $nimi;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_nimi', 'validate_email');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja');
        $query->execute();

        $rows = $query->fetchAll();
        $kayttajat = array();

        foreach ($rows as $row) {
            $kayttajat[] = new Kayttaja(array(
                'id' => $row['id'],
                'tunnus' => $row['tunnus'],
                'salasana' => $row['salasana'],
                'email' => $row['email'],
                'nimi' => $row['nimi']
            ));
        }
        return $kayttajat;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));

        $row = $query->fetch();
        if ($row) {
            $kayttaja = new Kayttaja(array(
                'id' => $row['id'],
                'tunnus' => $row['tunnus'],
                'salasana' => $row['salasana'],
                'email' => $row['email'],
                'nimi' => $row['nimi']
            ));
            return $kayttaja;
        }
        return null;
    }

    public static function authenticate($tunnus, $salasana) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE tunnus = :tunnus AND salasana = :salasana LIMIT 1');
        $query->execute(array('tunnus' => $tunnus, 'salasana' => $salasana));
        $row = $query->fetch();

        if ($row) {
            $kayttaja = new Kayttaja($row);
            return $kayttaja;
        } else {
            return null;
        }
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Kayttaja SET nimi=:nimi, email=:email WHERE Kayttaja.id=:id');
        $query->execute(array('nimi' => $this->nimi, 'email' => $this->email, 'id' => $this->id));

//        $row = $query->fetch();
    }

}
