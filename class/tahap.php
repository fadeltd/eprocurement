<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tahap
 * Digunakan untuk melakukan operasi dengan tabel tahap
 * @author Fadel
 */
class tahap {
    private $idTahap, $idLelang, $idNamaTahap,
            $tanggalMulai, $tanggalSelesai, $historyPerubahan,
            $db, $namaTable;

    public function __construct() {
        $this->db = new DB();
        $this->namaTable = config::$TABLEPREFIX . "" . config::$TABLETAHAP;
    }

    public function setIdTahap($idTahap) {
        $this->idTahap = $idTahap;
    }

    public function setIdLelang($idLelang) {
        $this->idLelang = $idLelang;
    }

    public function setIdNamaTahap($idNamaTahap) {
        $this->idNamaTahap = $idNamaTahap;
    }

    public function setTanggalMulai($tanggalSelesai) {
        $this->tanggalMulai = $tanggalSelesai;
    }

    public function setTanggalSelesai($tanggalSelesai) {
        $this->tanggalSelesai = $tanggalSelesai;
    }

    public function setHistoryPerubahan($historyPerubahan) {
        $this->historyPerubahan = $historyPerubahan;
    }

    public function setTahapRow() {
    //private function setTahapRow($data) {
        $data = $this->getTahapRow();
        $this->setTanggalMulai($data["tanggalSelesai"]);
        $this->setTanggalSelesai($data["tanggalSelesai"]);
        $this->setHistoryPerubahan($data["historyPerubahan"]);
    }

    public function getTahapAll() {
        $query = "SELECT * FROM `$this->namaTable`";
        $data = $this->db->fetchAll($query);
        return $data;
    }

    /* Membutuhkan setIdLelang($idLelang);
     * Untuk menu lihat tahap
     * (/eprocurement/lelang/tahap/#idTahap/)
     */
    public function getTahapbyIdLelang() {
        if (isset($this->idLelang)) {
            $query = "SELECT * FROM `$this->namaTable` WHERE `idLelang` = $this->idLelang
                     ORDER BY idTahap ASC;";
            $data = $this->db->fetchAll($query);
            return $data;
        }
    }

    public function getTahapRow() {
        if (isset($this->idTahap)) {
            $query = "SELECT * FROM `$this->namaTable` WHERE idTahap = $this->idTahap";
            $data = $this->db->fetchRow($query);
            //$this->setTahapRow($data);
            return $data;
        }
    }

    public function getIdTahap() {
        return $this->idTahap;
    }

    public function getIdLelang() {
        return $this->idLelang;
    }

    public function getIdNamaTahap() {
        return $this->idNamaTahap;
    }

    public function getTanggalMulai() {
        return $this->tanggalMulai;
        //$data = $this->getTahapRow();
        //return $data["tanggalMulai"];
    }

    public function getTanggalSelesai() {
        return $this->tanggalSelesai;
        //$data = $this->getTahapRow();
        //return $data["tanggalSelesai"];
    }

    public function getHistoryPerubahan() {
        return $this->historyPerubahan;
        //$data = $this->getTahapRow();
        //return $data["historyPerubahan"];
    }

    /*
     * Tidak membutuhkan setIdTahap($idTahap)
     * Untuk menangani post_handler admin buka lelang baru
     * (/eprocurement/admin/buka-lelang/)
     */

    public function tambahTahap($idLelang, $idNamaTahap, $tglMulai, $tglSelesai, $historyPerubahan) {
        $query = "INSERT INTO `$this->namaTable` (`idLelang`, `idNamaTahap`,
                `tanggalMulai`, `tanggalSelesai`, `historyPerubahan`) VALUES (?, ?, ?, ?, ?)";
        $data = array($idLelang, $idNamaTahap, $tglMulai, $tglSelesai, $historyPerubahan);
        $this->db->executeDB($data, $query);
        //return $this->db->dbh->rowCount() > 0 ? true : false; //Untuk Mengecek Apakah Update Berhasil atau tidak
    }

    /*
     * Harus memanggil setIdTahap($idTahap) terlebih dahulu
     * Untuk menangani post_handler ganti-tanggal-tahap
     * (/eprocurement/admin/ganti-tanggal-tahap/#idTahap)
     */

    public function updateTahap($tglMulai, $tglSelesai, $historyPerubahan) {
        if (isset($this->idTahap)) {
            $query = "UPDATE `$this->namaTable` SET `tanggalMulai`=?,
            `tanggalSelesai=?`, `historyPerubahan`=? 
            WHERE `idTahap` = `$this->idTahap`";
            $data = array($tglMulai, $tglSelesai, (++$historyPerubahan));
            $this->db->executeDB($data, $query);
            //return $this->db->dbh->rowCount() > 0 ? true : false; //Untuk Mengecek Apakah Update Berhasil atau tidak
        }
    }

}

?>
