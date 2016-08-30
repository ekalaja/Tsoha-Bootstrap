<?php

class Tarjous extends BaseModel {

    public $id, $tarjottava_id, $kohde_id, $lisatty;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    
    public static function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Tarjous WHERE id= :id');
        $query->execute(array('id' => $this->id));
    }
    
    public static function tarjotutVaihdot($kayttajaId) {
        $query = DB::connection()->prepare('SELECT T.id, I.nimi, Tar.tarjottava_id, Tar.id AS tarjous_id FROM Tarjous Tar LEFT JOIN Tavara T ON T.id=Tar.kohde_id LEFT JOIN Kayttaja K ON K.id=T.kayttaja_id JOIN Ideaali I ON T.ideaali_id=I.id WHERE K.id=:id');
        $query->execute(array('id' => $kayttajaId));
        $rows = $query->fetchAll();
        $tarjotut = array();
        foreach ($rows as $row) {
            $query2 = DB::connection()->prepare('SELECT K.nimi AS k_nimi, T.kunto, I.nimi FROM Tarjous Tar JOIN Tavara T ON Tar.tarjottava_id=T.id LEFT JOIN Kayttaja K ON K.id=T.kayttaja_id LEFT JOIN Ideaali I ON I.id=T.ideaali_id WHERE Tar.tarjottava_id=:tarjottava_id');
            $query2->execute(array('tarjottava_id' => $row['tarjottava_id']));
            $tarjottava = $query2->fetch();
            $tarjotut[] = array(
                'kohde_id' => $row['id'],
                'tar_kunto' => $tarjottava['kunto'],
                'tar_omistaja' => $tarjottava['k_nimi'],
                'tar_nimi' => $tarjottava['nimi'],
                'kohde' => $row['nimi'],
                'tarjous_id' => $row['tarjous_id']
            );
        }
        return $tarjotut;
    }
}
