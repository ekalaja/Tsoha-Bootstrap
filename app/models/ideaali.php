<?php



class Ideaali extends BaseModel {

    public $id, $nimi, $luokka, $vari;

    public function __construct($attributes) {
        parent::__construct($attributes);
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
    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Ideaali WHERE id = :id LIMIT 1');
        $query->execute(array('id'=> $id));
        
        $row = $query->fetch();
        if($row){
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
    
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Ideaali (nimi, luokka, vari) VALUES (:nimi, :luokka, :vari) RETURNING id');
        $query->execute(array('nimi' => $this->nimi, 'luokka' => $this->luokka, 'vari' => $this->vari));
        
        $row = $query->fetch();
        $this->id = $row['id'];
    }
    
    public function destroy($id){
        $query = DB::connection()->prepare('DELETE FROM Ideaali WHERE id :id LIMIT 1');
        $query->execute(array('id'=> $id));
    }
    
//    public function validate_nimi(){
//        $errors = array();
//        if($this->nimi == '' || $this->nimi==null) {
//            $errors[] = 'Nimi ei saa olla tyhjä';
//        }
//        if(strlen($this->nimi) < 3) {
//            $errors[] = 'Nimen tulee olla vähintään kolme merkkiä pitkä!';
//        }
//        return $errors;
//    }

}
