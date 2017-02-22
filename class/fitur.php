<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of fitur
 * Digunakan untuk melakukan operasi dengan tabel fitur
 * @author Fadel
 */
class fitur {

    private $idFitur, $idLelang, $fitur, $bobot, $indeks, $keterangan, $db, $namaTable;

    public function __construct() {
        $this->db = new DB();
        $this->namaTable = config::$TABLEPREFIX . "" . config::$TABLEFITUR;
    }

    public function setIdFitur($idFitur) {
        $this->idFitur = $idFitur;
    }

    public function setIdLelang($idLelang) {
        $this->idLelang = $idLelang;
    }

    public function setFitur($fitur) {
        $this->fitur = $fitur;
    }

    public function setBobot($bobot) {
        $this->bobot = $bobot;
    }
    
    public function setIndeks($indeks) {
        $this->indeks = $indeks;
    }
    
    public function setKeterangan($keterangan) {
        $this->keterangan = $keterangan;
    }
    
    public function setFiturRow() {
    //private function setFiturRow($data) {
        $data = $this->getFiturRow();
        $this->setIdFitur($data["idFitur"]);
        $this->setIdLelang($data["idLelang"]);
        $this->setFitur($data["fitur"]);
        $this->setIndeks($data["indeks"]);
        $this->setKeterangan($data["keterangan"]);
        $this->setBobot($data["bobot"]);
    }

    public function getFiturAll() {
        $query = "SELECT * FROM `$this->namaTable`
                ORDER BY idFitur ASC";
        $data = $this->db->fetchAll($query);
        return $data;
    }

    public function getFiturbyLelang() {
        $query = "SELECT * FROM `$this->namaTable`
            WHERE `idLelang` = '$this->idLelang'";
        $data = $this->db->fetchAll($query);
        return $data;
    }
    
    public function getFiturRow() {
        $query = "SELECT * FROM `$this->namaTable`
            WHERE `idFitur` = '$this->idFitur'";
        $data = $this->db->fetchRow($query);
        //$this->setFiturRow($data);
        return $data;
    }

    public function getIdFitur() {
        return $this->idFitur;
        //$data = $this->getFiturRow();
        //return $data["idFitur"];
    }

    public function getIdLelang() {
        return $this->idLelang;
        //$data = $this->getFiturRow();
        //return $data["idLelang"];
    }

    public function getFitur() {
        return $this->fitur;
        //$data = $this->getFiturRow();
        //return $data["fitur"];
    }

    public function getBobot() {
        return $this->bobot;
        //$data = $this->getFiturRow();
        //return $data["bobot"];
    }
    
    public function getIndeks() {
        return $this->indeks;
        //$data = $this->getFiturRow();
        //return $data["indeks"];
    }
    
    public function getKeterangan() {
        return $this->keterangan;
        //$data = $this->getFiturRow();
        //return $data["keterangan"];
    }
    
    //UNUSED
    public function updateFitur($idLelang, $fitur, $bobot, $keterangan) {
        //$query = "UPDATE `$this->namaTable` SET `fitur` = ?
        //    WHERE `idFitur` = `$this->idFitur`";
        $query = "UPDATE `$this->namaTable` SET `idLelang` = ?, `fitur` = ?
            WHERE `idFitur` = `$this->idFitur`";
        $data = array($idLelang, $fitur, $bobot, $keterangan);
        $this->db->executeDB($data, $query);
        //return $this->db->dbh->rowCount() > 0 ? true : false; //Untuk Mengecek Apakah Update Berhasil atau tidak
    }

    public function tambahFitur($idLelang, $fitur, $bobot, $indeks, $keterangan) {
        $query = "INSERT INTO `$this->namaTable` (`idLelang`, `fitur`, `bobot`, `indeks`, `keterangan`)
                VALUES (?, ?, ?, ?, ?)";
        $data = array($idLelang, $fitur, $bobot, $indeks, $keterangan);
        $this->db->executeDB($data, $query);
        //return $this->db->dbh->rowCount() > 0 ? true : false; //Untuk Mengecek Apakah Update Berhasil atau tidak
    }

    //public function hapusFitur($idFitur) {
    //Membutuhkan setIdFitur($idFitur),
    //$hapus bernilai 1 atau 0 (True / False), jika hapus ingin dikembalikan, dibuat False
    //UNUSED
    public function hapusFitur($hapus) {
        $query = "UPDATE `$this->namaTable` SET `hapusFitur` = ?
            WHERE `idFitur` = `$this->idFitur`";
        //$query = "UPDATE `$this->namaTable` SET `idLelang` = ?, `fitur` = ?
        //    WHERE `idFitur` = `$idFitur`";
        $data = array($hapus);
        $this->db->executeDB($data, $query);
        //return $this->db->dbh->rowCount() > 0 ? true : false; //Untuk Mengecek Apakah Update Berhasil atau tidak
    }

}

?>
