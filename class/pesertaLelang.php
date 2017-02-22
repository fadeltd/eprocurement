<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pesertaLelang
 * Digunakan untuk melakukan operasi dengan tabel pesertaLelang
 * @author Fadel
 */
class pesertaLelang {

    private $idPesertaLelang;
    private $idLelang; //Foreign Key idLelang yang diikuti
    private $idMember; //Foreign Key member yang mengikuti
    private $kualifikasi;
    private $fitur; //Jumlah Fitur yang di penuhi, untuk kebutuhan sistem pendukung keputusan
    /* Perhitungan score untuk kebutuhan sistem pendukung keputusan, 
     * di hitung berdasar fitur yang di penuhi + perbandingan harga
     * dari harga minimum lelang */
    private $rating;
    private $hargaPenawaran; //Harga yang ditawarkan ketika mengajukan penawaran untuk mengikuti lelang
    private $hargaFix; //Harga yang di atur oleh admin dari sistem setelah di sepakati
    private $pemenang; //Merupakan pemenang dari lelang yang diikuti atau bukan, dalam 1 lelang hanya boleh ada 1 pemenang
    private $alasan; //Alasan mengapa dimenangkan, memiliki dependency dengan $pemenang, harus diisi bila $pemenang bernilai TRUE
    private $db;
    private $namaTable;

    public function __construct() {
        $this->db = new DB();
        $this->namaTable = config::$TABLEPREFIX . "" . config::$TABLEPESERTALELANG;
    }

    public function setIdPesertaLelang($idPesertaLelang) {
        $this->idPesertaLelang = $idPesertaLelang;
    }

    public function setIdLelang($idLelang) {
        $this->idLelang = $idLelang;
    }

    public function setIdMember($idMember) {
        $this->idMember = $idMember;
    }

    public function setKualifikasi($kualifikasi) {
        $this->kualifikasi = $kualifikasi;
    }

    public function setFitur($fitur) {
        $this->fitur = $fitur;
    }

    public function setRating($rating) {
        $this->rating = $rating;
    }

    public function setHargaPenawaran($hargaPenawaran) {
        $this->hargaPenawaran = $hargaPenawaran;
    }

    public function setHargaFix($hargaFix) {
        $this->hargaFix = $hargaFix;
    }

    public function setPemenang($pemenang) {
        $this->pemenang = $pemenang;
    }

    public function setAlasan($alasan) {
        $this->alasan = $alasan;
    }
    
    public function setPesertaLelangRow() {
    //private function setPesertaLelangRow($data) {
        $data = $this->getPesertaLelangRow();
        $this->setIdLelang($data["idLelang"]);
        $this->setIdMember($data["idMember"]);
        $this->setKualifikasi($data["kualifikasi"]);
        $this->setFitur($data["fitur"]);
        $this->setRating($data["rating"]);
        $this->setHargaPenawaran($data["hargaPenawaran"]);
        $this->setHargaFix($data["hargaFix"]);
        $this->setPemenang($data["pemenang"]);
        $this->setAlasan($data["alasan"]);
    }
    
    public function getPesertaLelangAll() {
        $query = "SELECT * FROM " . $this->namaTable;
        $data = $this->db->fetchAll($query);
        return $data;
    }

    /* Membutuhkan setIdPesertaLelang($idPesertaLelang);
     * Untuk menu edit keikutsertaan lelang (/eprocurement/ikut-lelang/#idLelang|#idPesertaLelang/)
     */

    public function getPesertaLelangRow() {
        if (isset($this->idPesertaLelang)) {
            $query = "SELECT * FROM " . $this->namaTable . "
            WHERE idPesertaLelang = '$this->idPesertaLelang'";
            $data = $this->db->fetchRow($query);
            //$this->setPesertaLelangRow($data);
            return $data;
        }
    }



    /* Membutuhkan setIdLelang($idLelang); 
     * Untuk Menu Lihat Siapa saja yang mengikuti Lelang
     * (/eprocurement/lelang/peserta/)
     * (/eprocurement/lelang/pemenang/)
     */

    public function getPesertaLelangbyIdLelang() {
        if (isset($this->idLelang)) {
            $query = "SELECT * FROM `$this->namaTable`
            WHERE `idLelang` = $this->idLelang";
            $data = $this->db->fetchAll($query);
            return $data;
        }
    }

    /* Membutuhkan setIdMember($idMember);
     * Untuk Menu Following Lelang
     * (/eprocurement/mengikuti/)
     */

    public function getPesertaLelangbyIdMember() {
        if (isset($this->idMember)) {
            $query = "SELECT * FROM " . $this->namaTable . "
            WHERE idMember = '$this->idMember'";
            $data = $this->db->fetchAll($query);
            return $data;
        }
    }
    
    public function getIdPesertaLelangbyLelangAndMember() {
        $query = "SELECT idPesertaLelang FROM `$this->namaTable`
            WHERE `idLelang` = '$this->idLelang' and `idMember` = '$this->idMember'";
        $data = $this->db->fetchRow($query);
        return $data["idPesertaLelang"];
    }
    
    public function getIdPsertaLelang() {
        return $this->idPesertaLelang;
        //$data = $this->getPesertaLelangRow();
        //return $data["idPesertaLelang"];
        //return (!is_null($data["idPesertaLelang"])) ? $data["idPesertaLelang"] : NULL;
    }

    public function getIdLelang() {
        return $this->idLelang;
        //$data = $this->getPesertaLelangRow();
        //return $data["idLelang"];
        //return (!is_null($data["idLelang"])) ? $data["idLelang"] : NULL;
    }

    public function getIdMember() {
        return $this->idMember;
        //$data = $this->getPesertaLelangRow();
        //return $data["idMember"];
        //return(!is_null($data["idMember"])) ? $data["idMember"] : NULL;
    }

    public function getKualifikasi() {
        return $this->kualifikasi;
        //$data = $this->getPesertaLelangRow();
        //return $data["kualifikasi"];
        //return(!is_null($data["kualifikasi"])) ? $data["kualifikasi"] : NULL;
    }

    public function getFitur() {
        return $this->fitur;
        //$data = $this->getPesertaLelangRow();
        //return $data["fitur"];
        //return(!is_null($data["fitur"])) ? $data["fitur"] : NULL;
    }

    public function getRating() {
        return $this->rating;
        //$data = $this->getPesertaLelangRow();
        //return $data["rating"];
        //return(!is_null($data["rating"])) ? $data["rating"] : NULL;
    }

    public function getHargaPenawaran() {
        return $this->hargaPenawaran;
        //$data = $this->getPesertaLelangRow();
        //return $data["hargaPenawaran"];
        //return(!is_null($data["hargaPenawaran"])) ? $data["hargaPenawaran"] : NULL;
    }

    public function getHargaFix() {
        return $this->hargaFix;
        //$data = $this->getPesertaLelangRow();
        //return $data["hargaFix"];
        //return(!is_null($data["hargaFix"])) ? $data["hargaFix"] : NULL;
    }

    public function getPemenang() {
        return $this->pemenang;
        //$data = $this->getPesertaLelangRow();
        //return $data["pemenang"];
        //return(!is_null($data["pemenang"])) ? $data["pemenang"] : NULL;
    }

    public function getAlasan() {
        return $this->alasan;
        //$data = $this->getPesertaLelangRow();
        //return $data["alasan"];
        //return(!is_null($data["alasan"])) ? $data["alasan"] : NULL;
    }

    /*
     * Tidak membutuhkan setIdPesertaLelang($idPesertaLelang)
     * Untuk menangani post_handler form ikut lelang
     * (/eprocurement/ikut-lelang/#idLelang)
     */

    public function tambahPesertaLelang($idLelang, $idMember, $fitur, $rating, $hargaPenawaran) {
        $query = "INSERT INTO " . $this->namaTable . "(`idLelang`, `idMember`,
                `fitur`, `rating`, `hargaPenawaran`) VALUES (?, ?, ?, ?, ?)";
        $data = array($idLelang, $idMember, $fitur, $rating, $hargaPenawaran);
        $this->db->executeDB($data, $query);
        //return $this->db->dbh->rowCount() > 0 ? true : false; //Untuk Mengecek Apakah Update Berhasil atau tidak
    }

    /*
     * Harus memanggil setIdPesertaLelang($idPesertaLelang) terlebih dahulu
     * Untuk menangani post_handler pilih pemenang
     * (/eprocurement/admin/pilih-pemenang/#idLelang)
     */

    public function updatePesertaLelangbyAdmin($kualifikasi, $hargaFix, $alasan) {
        $query = "UPDATE `$this->namaTable` 
            SET `kualifikasi`=?, `hargaFix`=?, `pemenang`=?, `alasan`=? 
            WHERE `idPesertaLelang` = $this->idPesertaLelang";
        $data = array($kualifikasi, $hargaFix, 1, $alasan);
        $this->db->executeDB($data, $query);
        //return $this->db->dbh->rowCount() > 0 ? true : false; //Untuk Mengecek Apakah Update Berhasil atau tidak
    }

    /*
     * Harus memanggil setIdPesertaLelang($idPesertaLelang) terlebih dahulu
     * Untuk menangani post_handler edit-ikut-lelang
     * (/eprocurement/ikut-lelang/#idLelang)
     */

    public function updatePesertaLelang($idLelang, $idMember, $fitur, $rating, $hargaPenawaran) {
        if (isset($this->idPesertaLelang)) {
            $query = "UPDATE " . $this->namaTable . " SET `idLelang`=?, `idMember`=?, 
            `fitur`=?, `rating`=?, `hargaPenawaran`=? 
            WHERE `idPesertaLelang` = '$this->idPesertaLelang'";
            $data = array($idLelang, $idMember, $fitur, $rating, $hargaPenawaran);
            $this->db->executeDB($data, $query);
            //return $this->db->dbh->rowCount() > 0 ? true : false; //Untuk Mengecek Apakah Update Berhasil atau tidak
        }
    }

    /*
     * Harus memanggil setIdPesertaLelang($idPesertaLelang) terlebih dahulu
     * Untuk menangani post_handler batal-ikut-lelang
     * $batal bernilai 1 atau 0 (True / False), jika hapus ingin dikembalikan, dibuat False
     * (/eprocurement/batal-ikut-lelang/#idLelang)
     */

    public function batalPesertaLelang($batal) {
        if (isset($this->idPesertaLelang)) {
            $query = "UPDATE `$this->namaTable` SET `batalPesertaLelang` = ?
            WHERE `idPesertaLelang` = `$this->idPesertaLelang`";
            $data = array($batal);
            $this->db->executeDB($data, $query);
            //return $this->db->dbh->rowCount() > 0 ? true : false; //Untuk Mengecek Apakah Update Berhasil atau tidak
        }
    }

}

?>