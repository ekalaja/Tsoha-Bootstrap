<?php

class Testi extends BaseModel {

    public $id, $nimi, $luokka, $vari;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_nimi', 'validate_luokka', 'validate_vari', 'validate_uniikki_nimi');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Ideaali');
        $query->execute();

        $rows = $query->fetchAll();
        $ideaalit = array();

        foreach ($rows as $row) {
            $ideaalit[] = new Ideaali(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'luokka' => $row['luokka'],
                'vari' => $row['vari']
            ));
        }
        return $ideaalit;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Ideaali WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));

        $row = $query->fetch();
        if ($row) {
            $ideaali = new Ideaali(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'luokka' => $row['luokka'],
                'vari' => $row['vari']
            ));
            return $ideaali;
        }
        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Ideaali (nimi, luokka, vari) VALUES (:nimi, :luokka, :vari) RETURNING id');
        $query->execute(array('nimi' => $this->nimi, 'luokka' => $this->luokka, 'vari' => $this->vari));

        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Ideaali SET nimi=:nimi, luokka=:luokka, vari=:vari WHERE Ideaali.id=:id');
        $query->execute(array('nimi' => $this->nimi, 'luokka' => $this->luokka, 'vari' => $this->vari, 'id' => $this->id));

//        $row = $query->fetch();
    }

    public function destroy() {
        $query0 = DB::connection()->prepare('SELECT id FROM Tavara WHERE Tavara.ideaali_id=:id OR Tavara.vaihtokohde_id=:id');
        $query0->execute(array('id' => $this->id));
        $rows = $query0->fetchAll();

//        Kint::dump($rows);
        foreach ($rows as $row) {
            $query1 = DB::connection()->prepare('DELETE FROM Tavara WHERE id= :id');
            $query1->execute(array('id' => $row['id']));
        }
        $query = DB::connection()->prepare('DELETE FROM Ideaali WHERE id= :id');
        $query->execute(array('id' => $this->id));
    }

}
