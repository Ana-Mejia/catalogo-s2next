<?php
require_once 'models/Menu.php';

class MenuController{
    public function home(){
        $menu = new Menu();
        $menus = $menu->allDetail();
        require_once 'home.php';
    }

    public function index(){
        $menu = new Menu();
        $menus = $menu->all();
    }

    public function create(){
        $menu = new Menu();
        $menus = $menu->all();
        require_once 'views/menus/alta.php';
    }

    public function store(){
        if(isset($_POST)){
            //var_dump($_POST);
            $menu_id = isset($_POST['menu_id']) ? $_POST['menu_id'] : false;
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            
            if( $menu_id !== false && $nombre !== false && $descripcion !== false){
                $menu = new Menu();
                $menu->setMenuId($menu_id);
                $menu->setNombre($nombre);
                $menu->setDescripcion($descripcion);
                $menu->setActivo(1);
                
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $menu->setId($id);
                    
                    $save = $menu->edit();
                }else{
                    $save = $menu->save();
                }
                
                if($save){
                    $_SESSION['register'] = "complete";
                }else{
                    $_SESSION['register'] = "failed";
                }
            }else{
                $_SESSION['register'] = "failed (2)";
            }
        }else{
            $_SESSION['register'] = "fail";
        }
        header("Location:".base_url.'Menu/create');
    }

    public function editar(){
        if(isset($_GET['id'])){
            $editar = true;

            /* select options */
            $menu = new Menu();
            $menus = $menu->all();

            $menu = new Menu();
            $menu->setId($_GET['id']);
            $menu_find = $menu->find();

            require_once 'views/menus/alta.php';
        }else{
            header("Location:".base_url);
        }
    }

    public function eliminar(){
        if(isset($_GET['id'])){
            $menu = new Menu();
            $menu->setId($_GET['id']);
            $delete = $menu->delete();
            if($delete){
                $_SESSION['delete'] = "complete";
            }else{
                $_SESSION['delete'] = "failed";
            }
        }else{
            $_SESSION['delete'] = "failed";
        }
        header("Location:".base_url);
    }

    public function visualizar(){
        $menu = new Menu();
        $menus = $menu->views();
        require_once 'views/menus/visualizar.php';
    }
}