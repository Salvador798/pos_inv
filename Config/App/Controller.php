<?php

class Controller
{
    protected $model, $views;
    public function __construct()
    {
        // Declara la vista
        $this->views = new Views();
        // Declara el metodo cargarModel
        $this->cargarModel();
    }

    public function cargarModel()
    {
        // Declarar el archivo modeloModel
        $model = get_class($this) . "Model";
        // Declarar la ruta de la carpeta Models
        $ruta = "Models/" . $model . ".php";
        // Verificar si existe ese modelo
        if (file_exists($ruta)) {
            require_once $ruta;
            $this->model = new $model();
        }
    }
}
