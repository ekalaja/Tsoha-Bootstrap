<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Tavara extends BaseModel {

    public $id, $ideaali_id, $kayttaja_id, $kunto, $lukittu, $vaihtokohde_id, $vaihtokohde_nimi, $lukitus_aika, $nimi, $k_nimi, $k_tunnus;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT Tavara.id, Tavara.ideaali_id, Tavara.kayttaja_id, Tavara.kunto, Tavara.lukittu, Tavara.vaihtokohde_id, Tavara.lukitus_aika, Ideaali.nimi, Kayttaja.tunnus AS k_tunnus FROM Tavara LEFT JOIN Ideaali ON Tavara.ideaali_id=Ideaali.id LEFT JOIN Kayttaja ON Kayttaja.id=Tavara.kayttaja_id');
        $query->execute();

        $rows = $query->fetchAll();
        $tavarat = array();

        foreach ($rows as $row) {
            $tavarat[] = new Tavara(array(
                'id' => $row['id'],
                'ideaali_id' => $row['ideaali_id'],
                'kayttaja_id' => $row['kayttaja_id'],
                'kunto' => $row['kunto'],
                'vaihtokohde_id' => $row['vaihtokohde_id'],
                'lukittu' => $row['lukittu'],
                'lukitus_aika' => $row['lukitus_aika'],
                'nimi' => $row['nimi'],
                'k_tunnus' => $row['k_tunnus']
            ));
        }
        return $tavarat;
    }

    public static function kayttajanTavarat($id) {
        $query = DB::connection()->prepare('SELECT Tavara.id, Tavara.ideaali_id, Tavara.kayttaja_id, Tavara.kunto, Tavara.lukittu, Tavara.vaihtokohde_id, Tavara.lukitus_aika, Ideaali.nimi'
                . ' FROM Kayttaja LEFT JOIN Tavara ON Kayttaja.id=Tavara.kayttaja_id LEFT JOIN Ideaali ON Ideaali.id=Tavara.ideaali_id WHERE Kayttaja.id=:id');
        $query->execute(array('id' => $id));

        $rows = $query->fetchAll();
        $tavarat = array();

        foreach ($rows as $row) {
            $query2 = DB::connection()->prepare('SELECT nimi AS vaihtokohde_nimi FROM Ideaali WHERE id=:id LIMIT 1');
            $query2->execute(array('id' => $row['vaihtokohde_id']));
            $rowKohdeNimi = $query2->fetch();

            $tavarat[] = new Tavara(array(
                'id' => $row['id'],
                'ideaali_id' => $row['ideaali_id'],
                'kayttaja_id' => $row['kayttaja_id'],
                'kunto' => $row['kunto'],
                'vaihtokohde_id' => $row['vaihtokohde_id'],
                'lukittu' => $row['lukittu'],
                'lukitus_aika' => $row['lukitus_aika'],
                'nimi' => $row['nimi'],
                'vaihtokohde_nimi' => $rowKohdeNimi['vaihtokohde_nimi']
            ));
        }
        return $tavarat;
    }
    
    public static function omatVapaatIdJaNimi($id) {
        $query = DB::connection()->prepare('SELECT Tavara.id, Ideaali.nimi FROM Kayttaja LEFT JOIN Tavara ON Kayttaja.id=Tavara.kayttaja_id LEFT JOIN Ideaali ON Ideaali.id=Tavara.ideaali_id WHERE Kayttaja.id=:id');
        $query->execute(array('id' => $id));
        $rows = $query->fetchAll();
        $omatVapaat = array();
        
        foreach ($rows as $row) {
            $omatVapaat[] = new Tavara(array(
                'id' => $row['id'],
                'nimi' => $row['nimi']
            ));
        }
        return $omatVapaat;
    }

    

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT Kayttaja.nimi AS k_nimi, Tavara.id, Tavara.ideaali_id, Tavara.kayttaja_id, Tavara.kunto, Tavara.lukittu, Tavara.vaihtokohde_id, Tavara.lukitus_aika, Ideaali.nimi FROM Tavara LEFT JOIN Ideaali ON Tavara.ideaali_id=Ideaali.id LEFT JOIN Kayttaja ON Kayttaja.id=Tavara.kayttaja_id WHERE Tavara.id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        $query2 = DB::connection()->prepare('SELECT nimi AS vaihtokohde_nimi FROM Ideaali WHERE id=:id LIMIT 1');
        $query2->execute(array('id' => $row['vaihtokohde_id']));
        $rowKohdeNimi = $query2->fetch();

        if ($row) {
            $tavara = new Tavara(array(
                'id' => $row['id'],
                'ideaali_id' => $row['ideaali_id'],
                'kayttaja_id' => $row['kayttaja_id'],
                'k_nimi' => $row['k_nimi'],
                'kunto' => $row['kunto'],
                'lukittu' => $row['lukittu'],
                'lukitus_aika' => $row['lukitus_aika'],
                'vaihtokohde_id' => $row['vaihtokohde_id'],
                'nimi' => $row['nimi'],
                'kohde_nimi' => $rowKohdeNimi['vaihtokohde_nimi']
            ));

            return $tavara;
        }
        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Tavara (ideaali_id, kayttaja_id, vaihtokohde_id, kunto) VALUES (:ideaali_id, :kayttaja_id, :vaihtokohde_id, :kunto) RETURNING id');
        $query->execute(array('ideaali_id' => $this->ideaali_id, 'kayttaja_id' => $this->kayttaja_id, 'vaihtokohde_id' => $this->vaihtokohde_id, 'kunto' => $this->kunto));

        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Tavara WHERE id= :id');
        $query->execute(array('id' => $this->id));
    }

    public function lukitse() {
        $query = DB::connection()->prepare('UPDATE Tavara set lukittu=TRUE WHERE id=:id');
        $query->execute(array('id' => $this->id));
    }

//    public static function vaihdot() {
//        kirjoita tämä metodi
//    }
}
