<?php
abstract class Connexion {
    private static $pdo;
    private static $servername = 'localhost';
    private static $username = 'root'; 
    //private static $username = 'u999200200_tophe4';
    private static $password = '';
    //private static $password = 'Totophe4';
    private static $dbname = 'CAFOMABDD';
    //private static $dbname = 'u999200200_elearning';
   
    private static function setBdd(){
        self::$pdo = new PDO("mysql:host=".self::$servername.";dbname=".self::$dbname.";charset=utf8",self::$username,self::$password);
        //self::$pdo = new PDO("mysql:host=localhost;dbname=biblio;charset=utf8","root","");
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
    }
    protected function getBdd(){
        if(self::$pdo === null){
            self::setBdd();
        }
        return self::$pdo;
    }
}
