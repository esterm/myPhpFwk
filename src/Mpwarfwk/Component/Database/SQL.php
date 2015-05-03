<?php

namespace Mpwarfwk\Component\Database;


class SQL extends \PDO
{
    private $host,$port,$dbname,$user,$pass,$charset;

    const HOST="localhost";
    const DB="sphinx_demo";
    const USER="sphinx";
    const PASS="sspphhiinnxx001122";

    private static $db;

    private $database;

 
    public function __construct() 
    {
        $this->database = $this->getDB();
    }

   
    private static function getDB()
    {
        if (!self::$db)
        {
             $options = array(
                \PDO::ATTR_PERSISTENT => true,
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION);

            try 
            {
                 self::$db = new \PDO('mysql:host='.self::HOST.';dbname='.self::DB,self::USER, self::PASS);
            } 
            catch (PDOException $e) {
                die($e->getMessage());
            }
        }

        return self::$db;
    }

    public function selectAllFromTable($table) 
    {
        $statement = $this->database->prepare("SELECT * FROM $table");
        $statement->execute();
        return $statement->fetchAll();
    }

    public function selectFromTable($query, $data = NULL) 
    {
        $statement = $this->database->prepare($query);
        if($data != NULL){
            foreach ($data as $key => $actualValue) {
                $statement->bindValue(":$key", $actualValue);
            }
        }
        $statement->execute();
        return $statement->fetchAll();
    }

    public function insertInTable($query, $data) 
    {
        $statement = $this->database->prepare($query);
        foreach ($data as $key => $actualValue) {
            $statement->bindValue(":$key", $actualValue);
        }
        return $statement->execute();
    }

    public function deleteFromTable($table, $id, $value) 
    {
        $statement = $this->database->prepare("DELETE FROM $table WHERE $id = '$value' LIMIT 1");
        return $statement->execute();
    }

    public function updateTable($query, $data) 
    {
        
        $statement = $this->database->prepare($query);
        foreach ($data as $key => $actualValue) {
            $statement->bindValue(":$key", $actualValue);
        }
        return $statement->execute();
    }  
}