<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pesan
 * Digunakan untuk melakukan operasi dengan tabel pesan
 * @author Fadel
 */
class pesan {

    private $idPesan, $username, $email, $tanggal,
            $judul, $pesan, $tanggapan, $kodeTiket, $db, $namaTable;

    public function __construct() {
        $this->db = new DB();
        $this->namaTable = config::$TABLEPREFIX . "" . config::$TABLEPESAN;
    }

    public function setIdPesan($idPesan) {
        $this->idPesan = $idPesan;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setTanggal($tanggal) {
        $this->tanggal = $tanggal;
    }

    public function setJudul($judul) {
        $this->judul = $judul;
    }

    public function setPesan($pesan) {
        $this->pesan = $pesan;
    }
    
    public function setTanggapan($tanggapan) {
        $this->tanggapan = $tanggapan;
    }
    
    public function setKodeTiket($kodeTiket) {
        $this->kodeTiket = $kodeTiket;
    }
    
    public function getIdPesan() {
        return $this->idPesan;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getTanggal() {
        return $this->tanggal;
    }

    public function getJudul() {
        return $this->judul;
    }

    public function getPesan() {
        return $this->pesan;
    }
    
    public function getTanggapan() {
        return $this->tanggapan;
    }
    
    public function getKodeTiket() {
        return $this->kodeTiket;
    }
    
    public function setPesanRow() {
        //private function setPesanRow($data) {
        $data = $this->getPesanRow();
        //$this->setIdPesan($data["idPesan"]);
        $this->setUsername($data["username"]);
        $this->setEmail($data["email"]);
        $this->setJudul($data["judul"]);
        $this->setTanggal($data["tanggal"]);
        $this->setPesan($data["pesan"]);
        $this->setTanggapan($data["tanggapan"]);
        $this->setKodeTiket($data["kodeTiket"]);
    }

    public function getPesanAll() {
        $query = "SELECT * FROM `$this->namaTable`
            ORDER BY `idPesan` DESC";
        $data = $this->db->fetchAll($query);
        return $data;
    }
    
    public function getPesanPage($pageLimit) {
        $query = "SELECT * FROM `$this->namaTable` 
            ORDER BY `idPesan` DESC
            LIMIT $pageLimit, ".config::$MEMBERPERPAGE;
        $data = $this->db->fetchAll($query);
        return $data;
    }

    public function getPesanRow() {
        if (isset($this->idPesan)) {
            $query = "SELECT * FROM `$this->namaTable` WHERE idPesan = $this->idPesan";
            $data = $this->db->fetchRow($query);
            return $data;
        }
    }
    
    public function getPesanbyKodeTiket() {
        if (isset($this->kodeTiket)) {
            $query = "SELECT * FROM `$this->namaTable` WHERE kodeTiket = '$this->kodeTiket'";
            $data = $this->db->fetchRow($query);
            return $data;
        }
    }

    public function tambahPesan($username, $email, $tanggal, $judul, $pesan, $kodeTiket) {
        $query = "INSERT INTO `$this->namaTable` (`username`, `email`,
                `tanggal`, `judul`, `pesan`, `kodeTiket`) VALUES (?, ?, ?, ?, ?, ?)";
        $data = array($username, $email, $tanggal, $judul, $pesan, $kodeTiket);
        $this->db->executeDB($data, $query);
    }

    public function updateTanggapan($tanggapan) {
        if (isset($this->idPesan)) {
            $query = "UPDATE `$this->namaTable` SET `tanggapan`=? 
            WHERE `idPesan` = $this->idPesan";
            $data = array($tanggapan);
            $this->db->executeDB($data, $query);
        }
    }

}

?>
