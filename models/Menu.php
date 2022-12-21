<?php

class Menu{
    private $id;
    private $menu_id;
    private $nombre;
    private $descripcion;
    private $activo;
    private $db;

    public function __construct(){
        $this->db = Database::connect();
    }
    

    function getID(){
        return $this->id;
    }

    function getMenuID(){
        return $this->menu_id;
    }

    function getNombre(){
        return $this->nombre;
    }

    function getDescripcion(){
        return $this->descripcion;
    }

    function getActivo(){
        return $this->activo;
    }


    function setId($id){
        $this->id = $id;
    }

    function setMenuId($menu_id){
        $this->menu_id = $menu_id;
    }

    function setNombre($nombre){
        $this->nombre = $nombre;
    }

    function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }

    function setActivo($activo){
        $this->activo = $activo;
    }


    public function save(){
        $fecha = new DateTime();
        $fecha = $fecha->format('Y-m-d H:i:s');
        $menuid = $this->getMenuID()==="0" ? 'NULL' : $this->getMenuID();
        
        $sql = "INSERT INTO menu VALUES(NULL, {$menuid},'{$this->getNombre()}', '{$this->getDescripcion()}', '{$this->getActivo()}','{$fecha}','{$fecha}')";
        echo $sql;
        $stmt = $this->db->prepare($sql);
        $save = $stmt->execute();

        $result = false;
        if( $save ){
            $result = true;
        }
        return $result;
    }

    public function all(){
        $sql = "SELECT * FROM menu WHERE activo=1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $menus;
    }

    public function allDetail(){
        $sql = "SELECT * FROM menu WHERE activo=1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $menus_res = [];
        foreach($menus as $menu){
            $menu_padre = "";
            if( $menu['menu_id'] !== 'NULL'){
                $sql_menu = "SELECT * FROM menu WHERE id={$menu['menu_id']}";
                $stmt_menu = $this->db->prepare($sql_menu);
                $stmt_menu->execute();
                while( $row = $stmt_menu->fetch(PDO::FETCH_OBJ) ){
                    $menu_padre = $row->nombre;
                }
            }
            $elem = [
                "id" => $menu['id'],
                "nombre" => $menu['nombre'],
                "descripcion" => $menu['descripcion'],
                "menu" => $menu_padre
            ];
            array_push($menus_res,$elem);
        }
        return $menus_res;
    }

    public function delete(){
        $sql = "UPDATE menu SET activo=0 WHERE id={$this->id}";
        $stmt = $this->db->prepare($sql);
        $exe = $stmt->execute();
        if( $exe ){
            return true;
        }else{
            return false;
        }
    }

    public function find(){
        $sql = "SELECT * FROM menu WHERE id={$this->getId()}";
        $stmt = $this->db->prepare($sql);
        $exe = $stmt->execute();
        
        if( $exe ){
            $row = $stmt->fetch(PDO::FETCH_OBJ);
            return $row;
        }else{
            return false;
        }
    }

    public function edit(){
        $menuid = $this->getMenuID()==="0" ? 'NULL' : $this->getMenuID();
        $sql = "UPDATE menu SET menu_id={$menuid}, nombre='{$this->getNombre()}', descripcion='{$this->getDescripcion()}' WHERE id={$this->id}";
        echo $sql;
        $stmt = $this->db->prepare($sql);
        $save = $stmt->execute();

        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

    public function views(){
        $menus_list = $this->all();
        $menus_response = [];
        foreach($menus_list as $menu_item){
            $elem = [
                "id" => $menu_item['id'],
                "nombre" => $menu_item['nombre'],
                "descripcion" => $menu_item['descripcion'],
                "hijos" => $this->getHijos($menu_item['id'])
            ];
            array_push($menus_response,$elem);
        }
        return $menus_response;
    }

    public function getHijos($padre){
        $sql = "SELECT * FROM menu WHERE menu_id=$padre";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $hijos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $hijos_res = [];
        foreach($hijos as $hijo){
            $elem = [
                "id" => $hijo['id'],
                "nombre" => $hijo['nombre'],
                "descripcion" => $hijo['descripcion'],
                "hijos" => $this->getHijos($hijo['id'])
            ];
            array_push($hijos_res,$elem);
        }
        return $hijos_res;
    }

}