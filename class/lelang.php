<?php

class lelang {

    private $idLelang, $idKategori, $idPemenang, $idAdmin,
            $idTahap, $nama, $hargaMin, $hargaMax,
            $tanggalPosting, $tanggalDeadline, $lokasi, $SIUP,
            $db, $namaTable;

    public function __construct() {
        $this->db = new DB();
        $this->namaTable = config::$TABLEPREFIX . "" . config::$TABLELELANG;
    }

    public function setIdLelang($idLelang) {
        $this->idLelang = $idLelang;
    }

    public function setIdKategori($idKategori) {
        $this->idKategori = $idKategori;
    }

    public function setIdPemenang($idPemenang) {
        $this->idPemenang = $idPemenang;
    }

    public function setIdAdmin($idAdmin) {
        $this->idAdmin = $idAdmin;
    }

    public function setidTahap($idTahap) {
        $this->idTahap = $idTahap;
    }

    public function setNama($nama) {
        $this->nama = $nama;
    }

    public function setHargaMin($hargaMin) {
        $this->hargaMin = $hargaMin;
    }

    public function setHargaMax($hargaMax) {
        $this->hargaMax = $hargaMax;
    }

    public function setTanggalPosting($tanggalPosting) {
        $this->tanggalPosting = $tanggalPosting;
    }

    public function setTanggalDeadline($tanggalDeadline) {
        $this->tanggalDeadline = $tanggalDeadline;
    }

    public function setLokasi($lokasi) {
        $this->lokasi = $lokasi;
    }

    public function setSIUP($SIUP) {
        $this->SIUP = $SIUP;
    }

    public function setLelangRow() {
    //private function setLelangRow($data) {
        $data = $this->getLelangRow();
        $this->setIdLelang($data["idLelang"]);
        $this->setIdKategori($data["idKategori"]);
        $this->setIdPemenang($data["idPemenang"]);
        $this->setIdAdmin($data["idAdmin"]);
        $this->setidTahap($data["idTahap"]);
        $this->setNama($data["nama"]);
        $this->setHargaMin($data["hargaMin"]);
        $this->setHargaMax($data["hargaMax"]);
        $this->setTanggalPosting($data["tanggalPosting"]);
        $this->setLokasi($data["lokasi"]);
        $this->setSIUP($data["SIUP"]);
    }

    public function getLelangAll() {
        $query = "SELECT * FROM `$this->namaTable`";
        $data = $this->db->fetchAll($query);
        return $data;
    }
    
    public function getLelangPage($pageLimit){
        //$query = "SELECT * FROM " . $namaTable;
        $query = "SELECT l.idLelang, l.nama, mb.agency, nt.nama, l.hargaMin, l.idKategori, kt.kategori, l.idPemenang
            FROM " . config::$TABLEPREFIX . '' . config::$TABLELELANG . " l
            LEFT JOIN " . config::$TABLEPREFIX . '' . config::$TABLEMEMBER . " mb on l.idAdmin = mb.idMember
            LEFT JOIN " . config::$TABLEPREFIX . '' . config::$TABLETAHAP . " th on l.idTahap = th.idTahap and l.idLelang = th.idLelang
            LEFT JOIN " . config::$TABLEPREFIX . '' . config::$TABLENAMATAHAP . " nt on nt.idNamaTahap = th.idNamaTahap
            LEFT JOIN " . config::$TABLEPREFIX . '' . config::$TABLEKATEGORI . " kt on l.idKategori = kt.idKategori
            ORDER BY l.idLelang DESC 
            LIMIT $pageLimit," . config::$LELANGPERPAGE;
        $data = $this->db->fetchAll($query);
        return $data;
    }

    public function getLelangRow() {
        $query = "SELECT * FROM `$this->namaTable` WHERE idLelang = $this->idLelang";
        $data = $this->db->fetchRow($query);
        //$this->setLelangRow($data);
        return $data;
    }

    public function getLelangbyMember() {
        $query = "SELECT * FROM `$this->namaTable` WHERE `idMember` = $this->idMember";
        $data = $this->db->fetchAll($query);
        return $data;
    }
    
    /*
     * Untuk melihat semua lelang yang sudah di post oleh Admin
     */

    public function getLelangbyAdmin() {
        $query = "SELECT * FROM `$this->namaTable` WHERE `idAdmin` = $this->idAdmin";
        $data = $this->db->fetchAll($query);
        return $data;
    }

    public function getIdLelang() {
        return $this->idLelang;
    }

    public function getIdKategori() {
        return $this->idKategori;
    }

    public function getIdPemenang() {
        return $this->idPemenang;
    }

    public function getIdAdmin() {
        return $this->idAdmin;
    }

    public function getIdTahap() {
        return $this->idTahap;
    }

    public function getNama() {
        return $this->nama;
    }

    public function getHargaMin() {
        return $this->hargaMin;
    }

    public function getHargaMax() {
        return $this->hargaMax;
    }

    public function getTanggalPosting() {
        return $this->tanggalPosting;
    }

    public function getTanggalDeadline() {
        return $this->tanggalDeadline;
    }

    public function getLokasi() {
        return $this->lokasi;
    }

    public function getSIUP() {
        return $this->SIUP;
    }

    /*
     * Harus memanggil setIdLelang($idLelang) terlebih dahulu
     * Untuk menangani post_handler pilih-pemenang
     * (/eprocurement/admin/pilih-pemenang/#idLelang)
     */

    public function updateLelangbyAdmin($idPemenang) {
        $query = "UPDATE `$this->namaTable` 
            SET `idPemenang`=? WHERE `idLelang` = $this->idLelang";
        $data = array($idPemenang);
        $this->db->executeDB($data, $query);
    }

    public function updateLelangTahapbyAdmin($idTahap) {
        $query = "UPDATE `$this->namaTable`
            SET idTahap=? WHERE idLelang = '$this->idLelang'";
        $data = array($idTahap);
        $this->db->executeDB($data, $query);
    }
    
    public function tambahLelang($idKategori, $idAdmin, $nama, $hargaMin, $hargaMax, $tglPost, $tglDeadline, $lokasi, $SIUP) {
        $query = "INSERT INTO " . $this->namaTable . " (`idKategori`, `idAdmin`, `nama`,
                `hargaMin`, `hargaMax`, `tanggalPosting`, `tanggalDeadline`, `lokasi`, `SIUP`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $data = array($idKategori, $idAdmin, $nama, $hargaMin, $hargaMax, $tglPost, $tglDeadline, $lokasi, $SIUP);
        return $this->db->executeDB($data, $query);
        //return $this->db->getLastInsertId();
    }
    
    public function tampilLelangSemua() {
        //$query = "SELECT * FROM " . $namaTable;
        $query = "SELECT l.idLelang, l.nama, mb.agency, nt.nama, l.hargaMin, l.idKategori, kt.kategori, l.idPemenang
            FROM " . config::$TABLEPREFIX . '' . config::$TABLELELANG . " l
            LEFT JOIN " . config::$TABLEPREFIX . '' . config::$TABLEMEMBER . " mb on l.idAdmin = mb.idMember
            LEFT JOIN " . config::$TABLEPREFIX . '' . config::$TABLETAHAP . " th on l.idTahap = th.idTahap and l.idLelang = th.idLelang
            LEFT JOIN " . config::$TABLEPREFIX . '' . config::$TABLENAMATAHAP . " nt on nt.idNamaTahap = th.idNamaTahap
            LEFT JOIN " . config::$TABLEPREFIX . '' . config::$TABLEKATEGORI . " kt on l.idKategori = kt.idKategori
            ORDER BY l.idLelang DESC";
        $data = $this->db->fetchAll($query);
        return $data;
    }
    
    public function tampilLelang($idLelang) {
        $query = "SELECT l.idLelang, l.nama, kt.kategori, nt.nama as namaTahap, mb.agency,
            l.lokasi, l.hargaMin, l.hargaMax, l.tanggalPosting, l.tanggalDeadline, l.SIUP, l.idTahap
            FROM " . config::$TABLEPREFIX . '' . config::$TABLELELANG . " l
            LEFT JOIN " . config::$TABLEPREFIX . '' . config::$TABLEMEMBER . " mb on l.idAdmin = mb.idMember
            LEFT JOIN " . config::$TABLEPREFIX . '' . config::$TABLETAHAP . "  th on l.idTahap = th.idTahap and l.idLelang = th.idLelang
            LEFT JOIN " . config::$TABLEPREFIX . '' . config::$TABLENAMATAHAP . " nt on nt.idNamaTahap = th.idNamaTahap
            LEFT JOIN " . config::$TABLEPREFIX . '' . config::$TABLEKATEGORI . " kt on l.idKategori = kt.idKategori
            where l.idLelang = '$idLelang'";
        $data = $this->db->fetchRow($query);
        return $data;
    }

    public function tampilTahapLelang($idLelang) {
        $namaTable = config::$TABLEPREFIX . "" . config::$TABLETAHAP;
        $query = "SELECT idNamaTahap, tanggalMulai, tanggalSelesai, historyPerubahan
            FROM " . $namaTable . " where idLelang = '$idLelang'";
        $data = $this->db->fetchAll($query);

        return $data;
    }

    public function tampilPesertaLelang($idLelang) {
        //$namaTable = config::$TABLEPREFIX . "" . config::$TABLEPESERTALELANG;
        $query = "SELECT pl.idPesertaLelang, mb.agency, pl.hargaPenawaran, pl.fitur, pl.rating
            FROM " . config::$TABLEPREFIX . "" . config::$TABLEPESERTALELANG . " pl
            LEFT JOIN " . config::$TABLEPREFIX . "" . config::$TABLEMEMBER . " mb on pl.idMember = mb.idMember
            where pl.idLelang = '$idLelang' ORDER by pl.fitur DESC, pl.rating DESC";
        $data = $this->db->fetchAll($query);
        return $data;
    }

    public function tampilPeserta($idLelang, $idPesertaLelang) {
        //$namaTable = config::$TABLEPREFIX . "" . config::$TABLEPESERTALELANG;
        $query = "SELECT mb.agency, pl.hargaPenawaran, pl.rating
            FROM " . config::$TABLEPREFIX . "" . config::$TABLEPESERTALELANG . " pl
            LEFT JOIN " . config::$TABLEPREFIX . "" . config::$TABLEMEMBER . " mb on pl.idMember = mb.idMember
            where pl.idLelang = '$idLelang' and pl.idPesertaLelang='$idPesertaLelang'";
        $data = $this->db->fetchRow($query);

        return $data;
    }

    public function tampilPesertaMenangLelang($idLelang) {
        $query = "SELECT mb.agency, pl.kualifikasi, pl.rating, pl.hargaPenawaran, pl.hargaFix, pl.pemenang, pl.alasan
            FROM " . config::$TABLEPREFIX . "" . config::$TABLEPESERTALELANG . " pl
            LEFT JOIN " . config::$TABLEPREFIX . "" . config::$TABLEMEMBER . " mb on pl.idMember = mb.idMember
            WHERE pl.idLelang = '$idLelang'";
        $data = $this->db->fetchAll($query);

        return $data;
    }

    public function tampilDataLelangPemenang($idLelang) {
        $query = "SELECT l.idLelang, l.nama, kt.kategori, mb.agency,
            l.lokasi, l.hargaMin, l.hargaMax
            FROM " . config::$TABLEPREFIX . "" . config::$TABLELELANG . " l
            LEFT JOIN " . config::$TABLEPREFIX . "" . config::$TABLEKATEGORI . " kt on kt.idKategori = l.idKategori
            LEFT JOIN " . config::$TABLEPREFIX . "" . config::$TABLEMEMBER . " mb on mb.idMember = l.idAdmin
            WHERE l.idLelang = '$idLelang'";
        $data = $this->db->fetchRow($query);

        return $data;
    }

    public function tampilPemenangLelang($idLelang) {
        $query = "SELECT mb.agency, mb.alamat, mb.NPWP, pl.hargaPenawaran
            FROM " . config::$TABLEPREFIX . "" . config::$TABLELELANG . " l
            LEFT JOIN " . config::$TABLEPREFIX . "" . config::$TABLEPESERTALELANG . " pl on pl.idLelang = l.idLelang
            LEFT JOIN " . config::$TABLEPREFIX . "" . config::$TABLEMEMBER . " mb on mb.idMember = l.idPemenang
            WHERE l.idLelang = '$idLelang'";
        $data = $this->db->fetchRow($query);
        return $data;
    }
    
    public function tampilKategori($idKategori) {
        //$query = "SELECT * FROM " . $namaTable;
        $query = "SELECT l.idLelang, l.nama, mb.agency, nt.nama, l.hargaMin, l.idKategori, kt.kategori
            FROM " . config::$TABLEPREFIX . '' . config::$TABLELELANG . " l
            LEFT JOIN " . config::$TABLEPREFIX . '' . config::$TABLEMEMBER . " mb on l.idAdmin = mb.idMember
            LEFT JOIN " . config::$TABLEPREFIX . '' . config::$TABLETAHAP . " th on l.idTahap = th.idTahap and l.idLelang = th.idLelang
            LEFT JOIN " . config::$TABLEPREFIX . '' . config::$TABLENAMATAHAP . " nt on nt.idNamaTahap = th.idNamaTahap
            LEFT JOIN " . config::$TABLEPREFIX . '' . config::$TABLEKATEGORI . " kt on l.idKategori = kt.idKategori
            where kt.idKategori = '$idKategori'";
        $data = $this->db->fetchAll($query);
        return $data;
    }
    
/*    public function tampilKualifikasi($idLelang) {
        $namaTable = config::$TABLEPREFIX . "" . config::$TABLEKUALIFIKASI;
        $query = "SELECT kualifikasi from " . $namaTable . " where idLelang = '$idLelang'";
        $data = $this->db->fetchAll($query);

        return $data;
    }
*/
/*    public function tampilFitur($idLelang) {
        $namaTable = config::$TABLEPREFIX . "" . config::$TABLEFITUR;
        $query = "SELECT fitur from " . $namaTable . " where idLelang = '$idLelang'";
        $data = $this->db->fetchAll($query);
        return $data;
    }
*/

/*    public function editLelang($idLelang, $idKategori, $idPemenang, $idAdmin, $nama, $tglPost, $tglDeadline, $lokasi, $SIUP) {
        $namaTable = config::$TABLEPREFIX . "" . config::$TABLELELANG;
        $query = "UPDATE " . $namaTable . " SET `idKategori`=?, `idPemenang`=?, `idAdmin`=?,
                `nama`=?, `tanggalPosting`=?, `tanggalDeadline`=?, `lokasi`=?, `SIUP`=?, `jumlahPeserta`=?
                where `idLelang` = '$idLelang'";
        $data = array($idKategori, $idPemenang, $idAdmin, $nama, $tglPost, $tglDeadline, $lokasi, $SIUP);
        $this->db->executeDB($data, $query);
    }
*/
/*    public function getFitur($idLelang) {
        $namaTable = config::$TABLEPREFIX . "" . config::$TABLEFITUR;
        $query = "SELECT fitur FROM " . $namaTable . " WHERE `idLelang` = '$idLelang' ORDER BY idFitur ASC;";
        $data = $this->db->fetchAll($query);
        return $data;
    }
*/
/*    public function getTahap($idLelang) {
        $namaTable = config::$TABLEPREFIX . "" . config::$TABLETAHAP;
        $query = "SELECT idTahap, idNamaTahap FROM " . $namaTable . " WHERE `idLelang` = '$idLelang' ORDER BY idTahap ASC;";
        $data = $this->db->fetchAll($query);
        return $data;
    }
*/
/*    public function getIdPesertaLelang($idLelang, $idMember) {
        $namaTable = config::$TABLEPREFIX . "" . config::$TABLEPESERTALELANG;
        $query = "SELECT idPesertaLelang FROM " . $namaTable . " WHERE `idLelang` = '$idLelang' and `idMember` = '$idMember'";
        $data = $this->db->fetchRow($query);
        $idPesertaLelang = $data["idPesertaLelang"];
        return $idPesertaLelang;
    }
*/
/*    public function getHargaPenawaranPesertaLelang($idPesertaLelang) {
        $namaTable = config::$TABLEPREFIX . "" . config::$TABLEPESERTALELANG;
        $query = "SELECT hargaPenawaran FROM " . $namaTable . " WHERE `idPesertaLelang` = '$idPesertaLelang'";
        $data = $this->db->fetchRow($query);
        $harga = $data["hargaPenawaran"];
        return $harga;
    }
*/
/*    public function getIdNamaTahap($idTahap) {
        $namaTable = config::$TABLEPREFIX . "" . config::$TABLETAHAP;
        $query = "SELECT idNamaTahap FROM " . $namaTable . " where idTahap = '$idTahap'";
        $data = $this->db->fetchRow($query);
        return $data["idNamaTahap"];
    }
*/
    /*
    public function getNamaTahap($idNamaTahap) {
        $namaTable = config::$TABLEPREFIX . "" . config::$TABLENAMATAHAP;
        $query = "SELECT nama FROM " . $namaTable . " where idNamaTahap = '$idNamaTahap'";
        $data = $this->db->fetchRow($query);
        $nama = $data["nama"];
        return $nama;
    }
    */
/*    public function getKategori($idKategori) {
        $query = "SELECT kategori FROM " . config::$TABLEPREFIX . '' . config::$TABLEKATEGORI . "
            WHERE idKategori = '$idKategori'";
        $data = $this->db->fetchRow($query);
        $kategori = $data["kategori"];
        return $kategori;
    }
*/
/*
     public function getIdTahap($idLelang) {
        $data = $this->tampilLelang($idLelang);
        $idTahap = $data["idTahap"];
        return $idTahap;
    }

    public function getIdKategori($idLelang) {
        $query = "SELECT idKategori FROM " . config::$TABLEPREFIX . '' . config::$TABLELELANG . "
  WHERE idLelang = '$idLelang'";
        $data = $this->db->fetchRow($query);
        $idKategori = $data["idKategori"];
        return $idKategori;
    }

    public function getNama($idLelang) {
        $namaTable = config::$TABLEPREFIX . "" . config::$TABLELELANG;
        $query = "SELECT nama FROM " . $namaTable . " where idLelang = '$idLelang'";
        $data = $this->db->fetchRow($query);
        $nama = $data["nama"];
        return $nama;
    }

    public function getIdPemenang($idLelang) {
        $namaTable = config::$TABLEPREFIX . "" . config::$TABLELELANG;
        $query = "SELECT idPemenang FROM " . $namaTable . " WHERE `idLelang` = '$idLelang'";
        $data = $this->db->fetchRow($query);
        $idPemenang = $data["idPemenang"];
        return $idPemenang;
    }
*/
}

?>