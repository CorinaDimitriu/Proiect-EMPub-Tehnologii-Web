<?php
declare(strict_types=1);
class Controller
{
    protected function model($model)
    {
        require_once '../administrative_microservice/models/'. $model . '.php';
        return new $model();
    }

    protected function view($view, $data = [])
    {
        require_once '../administrative_microservice/views/'. $view . '.php';
    }
}
?>