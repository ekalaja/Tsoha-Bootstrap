<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Tavara extends BaseModel {

    public $id, $ideaali_id, $kayttaja_id, $kunto, $lukittu, $lukitus_aika, $nimi, $k_nimi;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT Tavara.id, Tavara.ideaali_id, Tavara.kayttaja_id, Tavara.kunto, Tavara.lukittu, Tavara.vaihtokohde_id, Tavara.lukitus_aika, Ideaali.nimi FROM Tavara LEFT JOIN Ideaali ON Tavara.ideaali_id=Ideaali.id');
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
                'nimi' => $row['nimi']
            ));
        }
        return $tavarat;
    }
    public static function find($id){
        $query = DB::connection()->prepare('SELECT Kayttaja.nimi AS k_nimi, Tavara.id, Tavara.ideaali_id, Tavara.kayttaja_id, Tavara.kunto, Tavara.lukittu, Tavara.vaihtokohde_id, Tavara.lukitus_aika, Ideaali.nimi FROM Tavara LEFT JOIN Ideaali ON Tavara.ideaali_id=Ideaali.id LEFT JOIN Kayttaja ON Kayttaja.id=Tavara.kayttaja_id WHERE Tavara.id = :id LIMIT 1');
        $query->execute(array('id'=> $id));
        $row = $query->fetch();
        
        if($row){
            $tavara = new Tavara(array(
                'id' => $row['id'],
                'ideaali_id' => $row['ideaali_id'],
                'kayttaja_id' => $row['kayttaja_id'],
                'kunto' => $row['kunto'],
                'lukittu' => $row['lukittu'],
                'lukitus_aika' => $row['lukitus_aika'],
                'vaihtokohde_id' => $row['vaihtokohde_id'],
                'nimi' => $row['nimi'],
                'k_nimi' => $row['k_nimi']
            ));
            
            return $tavara;
        }
        return null;
    }

}
