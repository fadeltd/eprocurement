<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of namatahap
 * Digunakan untuk melakukan operasi dengan tabel namaTahap
 * @author Fadel
 */

class namatahap {
    private $idNamaTahap, $namaTahap, $db, $namaTable;

    public function __construct() {
        $this->db = new DB();
        $this->namaTable = config::$TABLEPREFIX . "" . config::$TABLENAMATAHAP;
    }

    public function setIdNamaTahap($idNamaTahap) {
        $this->idNamaTahap = $idNamaTahap;
    }

    public function setNamaTahap($namaTahap) {
        $this->namaTahap = $namaTahap;
    }
    
    public function setNamaTahapRow() {
    //private function setNamaTahapRow($data) {
        $data = $this->getNamaTahapRow();
        $this->setIdNamaTahap($data["idNamaTahap"]);
        $this->setNamaTahap($data["nama"]);
    }
    
    public function getNamaTahapAll() {
        $query = "SELECT * FROM `$this->namaTable`
            ORDER BY idNamaTahap ASC;";
        $data = $this->db->fetchAll($query);
        return $data;
    }

    public function getNamaTahapRow() {
        $query = "SELECT * FROM " . $this->namaTable . "
            WHERE idNamaTahap = '$this->idNamaTahap'";
        $data = $this->db->fetchRow($query);
        //$this->setNamaTahapRow($data);
        return $data;
    }

    public function getIdNamaTahap() {
        return $this->idNamaTahap;
        //$data = $this->getNamaTahapRow();
        //return $data["idNamaTahap"];
    }

    public function getNamaTahap() {
        return $this->namaTahap;
        //$data = $this->getNamaTahapRow();
        //return $data["namaTahap"];
    }

    public function updateNamaTahap($idNamaTahap, $namaTahap) {
        //$query = "UPDATE `$this->namaTable` SET `namaTahap` = ?
        //    WHERE `idNamaTahap` = `$this->idNamaTahap`";
        $query = "UPDATE `$this->namaTable` SET `namaTahap` = ?
            WHERE `idNamaTahap` = `$idNamaTahap`";
        $data = array($namaTahap);
        $this->db->executeDB($data, $query);
        //return $this->db->dbh->rowCount() > 0 ? true : false; //Untuk Mengecek Apakah Update Berhasil atau tidak
    }
    
    public function tambahNamaTahap($namaTahap) {
        $query = "INSERT INTO `$this->namaTable` (`namaTahap`)
                VALUES (?)";
        $data = array($namaTahap);
        $this->db->executeDB($data, $query);
        //return $this->db->dbh->rowCount() > 0 ? true : false; //Untuk Mengecek Apakah Update Berhasil atau tidak
    }
}
?>
