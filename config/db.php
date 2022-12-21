<?php

class Database{
    public static function connect(){
        try {
            $usr = "root";
            $pwd = "";
            $mdb = new PDO('mysql:host=localhost;port=3308;dbname=evaluacion',$usr, $pwd);
            return $mdb;
        } catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage() . "<br/>";
            die();
        }        
    }
}