<?php

class DB {
    public $dbh = null, $db_location, $db_name, $db_username, $db_password;

    public function __construct() {
        $this->db_location = config::$DBLOCATION;
        $this->db_name = config::$DBNAME;
        $this->db_username = config::$DBUSER;
        $this->db_password = config::$DBPASSWORD;
    }

    public function connectDB() {
        try {
            $this->dbh = new PDO("mysql:host=$this->db_location;dbname=$this->db_name", $this->db_username, $this->db_password);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    /*
     * Fungsi Untuk Memasukkan / Update data ke dalam DataBase
     * tidak disediakan fungsi untuk mendelete database, karena
     */

    public function executeDB($data, $query) {
        $this->connectDB();
        $STH = $this->dbh->prepare($query);
        $STH->execute($data);
        $id = $this->dbh->lastInsertId();
        $this->closeDB();
        return $id;
    }
    
    public function fetchRow($query) {
        $this->connectDB();
        $STH = $this->dbh->prepare($query);
        $STH->execute();
        $result = $STH->fetch(PDO::FETCH_ASSOC);
        $this->closeDB();
        return $result;
    }

    public function fetchAll($query) {
        $this->connectDB();
        $STH = $this->dbh->prepare($query);
        $STH->execute();
        $result = $STH->fetchAll();
        $this->closeDB();
        return $result;
    }
    
    public function getLastInsertId(){
        return $this->dbh->lastInsertId();
    }
    
    public function closeDB() {
        $this->dbh = null;
    }

}

?>