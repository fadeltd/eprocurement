<?php

/**
 * Description of kualifikasi
 * Digunakan untuk melakukan operasi dengan tabel kategori
 * @author Fadel
 */

class kategori{
    private $idKategori, $kategori, $db, $namaTable;

    public function __construct() {
        $this->db = new DB();
        $this->namaTable = config::$TABLEPREFIX . "" . config::$TABLEKATEGORI;
    }

    public function setIdKategori($idKategori) {
        $this->idKategori = $idKategori;
    }

    public function setKategori($kategori) {
        $this->kategori = $kategori;
    }
    
    public function setKategoriRow() {
    //private function setKategoriRow($data) {
        $data = $this->getKategoriRow();
        $this->setIdKategori($data["idKategori"]);
        $this->setKategori($data["kategori"]);
    }
    
    public function getKategoriAll() {
        $query = "SELECT * FROM `$this->namaTable`  ORDER BY idKategori ASC;";
        $data = $this->db->fetchAll($query);
        return $data;
    }

    public function getKategoriRow() {
        $query = "SELECT * FROM " . $this->namaTable . "
            WHERE idKategori = '$this->idKategori'";
        $data = $this->db->fetchRow($query);
        //$this->setKategoriRow($data);
        return $data;
    }

    public function getIdKategori() {
        return $this->idKategori;
        //$data = $this->getKategoriRow();
        //return $data["idKategori"];
    }

    public function getKategori() {
        return $this->kategori;
        //$data = $this->getKategoriRow();
        //return $data["kategori"];
    }

    public function updateKategori($idKategori, $kategori) {
        //$query = "UPDATE `$this->namaTable` SET `kategori` = ?
        //    WHERE `idKategori` = `$this->idKategori`";
        $query = "UPDATE `$this->namaTable` SET `kategori` = ?
            WHERE `idKategori` = `$idKategori`";
        $data = array($kategori);
        $this->db->executeDB($data, $query);
        //return $this->db->dbh->rowCount() > 0 ? true : false; //Untuk Mengecek Apakah Update Berhasil atau tidak
    }
    
    public function tambahKategori($kategori) {
        $query = "INSERT INTO `$this->namaTable` (`kategori`)
                VALUES (?)";
        $data = array($kategori);
        $this->db->executeDB($data, $query);
        //return $this->db->dbh->rowCount() > 0 ? true : false; //Untuk Mengecek Apakah Update Berhasil atau tidak
    }
}
?>
