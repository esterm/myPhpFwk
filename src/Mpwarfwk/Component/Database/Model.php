<?php

namespace Mpwarfwk\Component\Database;


class Model extends \PDO
{
    private $host,$port,$dbname,$user,$pass,$charset;

    const HOST="localhost";
    const DB="sphinx_demo";
    const USER="sphinx";
    const PASS="sspphhiinnxx001122";

    private static $db;

    protected $database;

 
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
        $result = $statement->fetchAll();

        return  $result;
    }

    public function selectFromTable($columns, $table, $data = NULL)  
    {
        $statement = $this->buildQuery($columns, $table, $data);
        $statement->execute();
        $result = $statement->fetchAll();
        
        return $result;
    }

    private function buildQuery($columns, $table, $data, $like=false)
    {
        //It builds a query like for example: $query = "SELECT provincia FROM provincias WHERE id_provincia = :id";
        
        $query="SELECT ";

      
        for ($i=0; $i<count($columns); $i++) 
        {
           $query .= $columns[$i];

           if ($i<count($columns)-1) {
                 $query .= ", ";
           } 
        }
        

        $query .= " FROM ".$table;

        if($data != NULL)
        {
            $query.=" WHERE ";

            foreach ($data as $key => $actualValue) 
            {
                if (!$like){
                    $query .= $key ." = :". $key;
                }else{
                    $query .= $key ." LIKE :". $key;
                }
                 
            }
        }
  
        $statement = $this->database->prepare($query);

        if($data != NULL)
        {
            foreach ($data as $key => $actualValue) 
            {
                $statement->bindValue(":$key", $actualValue);
            }
        }

        return $statement;
    }



    public function selectFromTableLike($columns, $table, $data = NULL)  
    {

        $statement = $this->buildQuery($columns, $table, $data, true);
        $statement->execute();
        $result = $statement->fetchAll();
        
        return $result; 
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