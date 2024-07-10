<?php

class Home extends Controller
{
    public function __construct()
    {
        session_start();
        if (!empty($_SESSION['active'])) {
            header("location: " . APP_URL . "Administracion/home");
        }
        parent::__construct();
    }

    public function index()
    {
        $this->views->getView($this, "index");
    }
}
