<?php
declare(strict_types=1);
class Controller
{
    protected function model($model)
    {
        require_once '../emails_interface_microservice/models/'. $model . '.php';
        return new $model();
    }

    protected function view($view, $data = [])
    {
        require_once '../emails_interface_microservice/views/'. $view . '.php';
    }
}
?>