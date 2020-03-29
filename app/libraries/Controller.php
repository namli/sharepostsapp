<?php
/*
* Base Controller
* Loads models and views
*/
class Controller
{
    // Load model
    public function model($model)
    {
        // Require Model File
        require_once '../app/models/' . $model . '.php';

        //Instatiate Model
        return new $model();
    }

    public function view($view, $data = [])
    {
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            die('View does not exist');
        }
    }
}
