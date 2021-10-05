<?php
namespace Portfolio\App\Libraries;

use PDO;
use PDOException;

/**
 * PDO Database Class
 * Connect to database
 * Create prepared statements
 * Bind Values
 * Return rows and Results
 */

 class Database{
    private $db_driver = DB_DRIVER;
    private $host = HOST;
    private $dbname = DB_NAME;
    private $user = DB_USER;
    private $pass = DB_PASS;

    private $dbh;
    private $stmt;
    private $error;

    public function __construct(){
        // Set up the database
        $dsn = "$this->db_driver:host=$this->host;port=5432;dbname=$this->dbname";
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        // Create PDO Instance
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch(PDOException $e){
            $this->error = $e->getMessage();
            echo $this->error;
        }

    }

    // Prepare statement query
    public function query($sql){
        $this->stmt = $this->dbh->prepare($sql);
    }

    // Bind Values
    public function bind($param, $value, $type = null){
        if(is_null($type)){
            switch(true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    //Execute the prepared statement
    public function execute(){
        return $this->stmt->execute();
    }

    // Get results as array of objects
    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Get results as array of objects
    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // Get results as array of objects
    public function rowCount(){
        return $this->stmt->rowCount();
    }

    // Get results as fetch Mode
    public function setFetchMode(){
        $this->execute();
        return $this->stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
    }

 }