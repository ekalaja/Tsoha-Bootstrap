<?php

class IdeaalitController extends BaseController {

    public static function index() {
        self::check_logged_in();
        $ideaalit = Ideaali::all();

        View::make('ideaalit/selaIdeaaleja.html', array('ideaalit' => $ideaalit));
    }

    public static function show($id) {
        self::check_logged_in();
        $ideaali = Ideaali::find($id);

        View::make('ideaalit/ideaali.html', array('ideaali' => $ideaali));
    }

    public static function edit($id) {
        $ideaali = Ideaali::find($id);
        View::make('ideaalit/edit.html', array('attributes' => $ideaali));
    }

    public static function update($id) {
        $params = $_POST;

        $attributes = array(
            'nimi' => $params['nimi'],
            'luokka' => $params['luokka'],
            'vari' => $params['vari'],
            'id' => $id
        );


        $ideaali = new Ideaali($attributes);
        $errors = $ideaali->errors();
//        Kint::dump($errors, $attributes['id']);
        if (count($errors) > 0) {
            View::make('ideaalit/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $ideaali->update();
            Redirect::to('/ideaalit', array('viesti' => 'Ideaali päivitetty!'));
        }
    }

    public static function store() {
        $ideaalit = Ideaali::all();
        $params = $_POST;
        $attributes = array(
            'nimi' => $params['nimi'],
            'luokka' => $params['luokka'],
            'vari' => $params['vari']
        );

        $ideaali = new Ideaali($attributes);
        $errors = $ideaali->errors();
//        Kint::dump(count($errors));
        if (count($errors) == 0) {
            $ideaali->save();
//            Redirect::to('/ideaalit/' . $ideaali->id, array('message' => 'Ideaali lisätty!'));
            Redirect::to('/ideaalit', array('viesti' => 'Ideaali lisätty!'));
        } else {
//            Redirect::to('/ideaalit');
            View::make('/ideaalit/selaIdeaaleja.html', array('errors' => $errors, 'attributes' => $attributes, 'ideaalit' => $ideaalit));
        }
    }

    public static function destroy($id) {
        $ideaali = new Ideaali(array('id' => $id));
        $ideaali->destroy();
        Redirect::to('/ideaalit', array('viesti' => 'Ideaali poistettu.'));
    }

}
