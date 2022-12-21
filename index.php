<?php
session_start();
require_once 'autoload.php';
require_once 'config/db.php';
require_once 'config/parameters.php';
require_once 'helpers/utils.php';
require_once 'views/layout/header.php';

if(isset($_GET['controller'])){
    $nombre_controlador = $_GET['controller'].'Controller';
    
    if(class_exists($nombre_controlador)){
        $controlador = new $nombre_controlador();
        
        if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){
            $action = $_GET['action'];
            $controlador->$action();
        }else{
            $error = new ErrorController();
            $error->index();
            exit();
        }
    }else{
        $error = new ErrorController();
        $error->index();
        exit();
    }
}else{
    $controlador = new MenuController();
    $controlador->home();
}

require_once 'views/layout/footer.php';