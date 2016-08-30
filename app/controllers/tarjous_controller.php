<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Class TarjousController extends BaseController {
    
    
    public static function vaihdot() {
        self::check_logged_in();
//        Kint::dump($_SESSION['id']);
        $attributes = array(
            'nimi' => 'joku',
            'luokka' => 'hieno',
            'vari' => 'vari'
        );


        $ideaali = new Testi($attributes);
        
        
        
        
        
//        $tarjotut = Tarjous::tarjotutVaihdot($_SESSION['id']);
        Kint::dump($ideaali);
        
//        View::make('/tavarat/vaihdot.html', array('tarjotut' => $tarjotut));
    }
    
    
    public static function poistaTarjous($id) {
        $tarjous = new Tarjous(array('id' => $id));
        Kint::dump($tarjous);
//        $tarjous->destroy();
//        Redirect::to('/tavarat');
//        SELVITÄ MIKSI EI NÄE TARJOUS LUOKKAA!!
    }
    
}
 