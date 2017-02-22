<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of kualifikasi
 * Digunakan untuk melakukan operasi dengan tabel kualifikasi
 * @author Fadel
 */
class kualifikasi {

    private $idKualifikasi, $idLelang, $kualifikasi, $db, $namaTable;

    public function __construct() {
        $this->db = new DB();
        $this->namaTable = config::$TABLEPREFIX . "" . config::$TABLEKUALIFIKASI;
    }

    public function setIdKualifikasi($idKualifikasi) {
        $this->idKualifikasi = $idKualifikasi;
    }

    public function setIdLelang($idLelang) {
        $this->idLelang = $idLelang;
    }

    public function setKualifikasi($kualifikasi) {
        $this->kualifikasi = $kualifikasi;
    }

    public function setKualifikasiRow() {
    //private function setKualifikasiRow($data) {
        $data = $this->getKualifikasiRow();
        $this->setIdKualifikasi($data["idKualifikasi"]);
        $this->setIdLelang($data["idLelang"]);
        $this->setKualifikasi($data["kualifikasi"]);
    }

    public function getKualifikasiAll() {
        $query = "SELECT * FROM `$this->namaTable`
            ORDER BY idKualifikasi ASC";
        $data = $this->db->fetchAll($query);
        return $data;
    }

    public function getKualifikasiRow() {
        $query = "SELECT * FROM `$this->namaTable`
            WHERE idKualifikasi = '$this->idKualifikasi'";
        $data = $this->db->fetchRow($query);
        //$this->setKualifikasiRow($data);
        return $data;
    }

    public function getKualifikasibyLelang(){
        $query = "SELECT * FROM  `$this->namaTable`
            WHERE idLelang = '$this->idLelang'";
        $data = $this->db->fetchAll($query);
        return $data;
    }
    
    public function getIdKualifikasi() {
        return $this->idKualifikasi;
        //$data = $this->getKualifikasiRow();
        //return $data["idKualifikasi"];
    }

    public function getIdLelang() {
        return $this->idLelang;
        //$data = $this->getKualifikasiRow();
        //return $data["idLelang"];
    }

    public function getKualifikasi() {
        return $this->kualifikasi;
        //$data = $this->getKualifikasiRow();
        //return $data["kualifikasi"];
    }

    public function updateKualifikasi($idKualifikasi, $idLelang, $kualifikasi) {
        //$query = "UPDATE `$this->namaTable` SET `kualifikasi` = ?
        //    WHERE `idKualifikasi` = `$this->idKualifikasi`";
        $query = "UPDATE `$this->namaTable` SET `idLelang` = ?, `kualifikasi` = ?
            WHERE `idKualifikasi` = `$idKualifikasi`";
        $data = array($idLelang, $kualifikasi);
        $this->db->executeDB($data, $query);
        //return $this->db->dbh->rowCount() > 0 ? true : false; //Untuk Mengecek Apakah Update Berhasil atau tidak
    }

    public function tambahKualifikasi($idLelang, $kualifikasi) {
        $query = "INSERT INTO `$this->namaTable` (`idLelang`, `kualifikasi`)
                VALUES (?, ?)";
        $data = array($idLelang, $kualifikasi);
        $this->db->executeDB($data, $query);
        //return $this->db->dbh->rowCount() > 0 ? true : false; //Untuk Mengecek Apakah Update Berhasil atau tidak
    }

    //public function hapusKualifikasi($idKualifikasi) {
    //Membutuhkan setIdKualifikasi, $hapus bernilai 1 atau 0 (True / False), jika hapus ingin dikembalikan, dibuat False
    public function hapusKualifikasi($hapus) {
        $query = "UPDATE `$this->namaTable` SET `hapusKualifikasi` = ?
            WHERE `idKualifikasi` = `$this->idKualifikasi`";
        //$query = "UPDATE `$this->namaTable` SET `idLelang` = ?, `kualifikasi` = ?
        //    WHERE `idKualifikasi` = `$idKualifikasi`";
        $data = array($hapus);
        $this->db->executeDB($data, $query);
        //return $this->db->dbh->rowCount() > 0 ? true : false; //Untuk Mengecek Apakah Update Berhasil atau tidak
    }

}

?>
