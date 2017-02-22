<?php

class member {

    private $idMember, $idPrioritas, $username, $email, $password,
            $avatar, $agency, $alamat, $cv, $fax, $tanggalDaftar,
            $aktivasi, $npwp, $blacklist, $alasanBlacklist,
            $db, $namaTable;

    public function __construct() {
        $this->db = new DB();
        $this->namaTable = config::$TABLEPREFIX . "" . config::$TABLEMEMBER;
    }

    public function setIdMember($idMember) {
        $this->idMember = $idMember;
    }

    public function setIdPrioritas($idPrioritas) {
        $this->idPrioritas = $idPrioritas;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setAvatar($avatar) {
        $this->avatar = $avatar;
    }

    public function setAgency($agency) {
        $this->agency = $agency;
    }

    public function setAlamat($alamat) {
        $this->alamat = $alamat;
    }

    public function setCv($cv) {
        $this->cv = $cv;
    }

    public function setFax($fax) {
        $this->fax = $fax;
    }

    public function setTanggalDaftar($tanggalDaftar) {
        $this->tanggalDaftar = $tanggalDaftar;
    }

    public function setAktivasi($aktivasi) {
        $this->aktivasi = $aktivasi;
    }

    public function setNpwp($npwp) {
        $this->npwp = $npwp;
    }

    public function setBlacklist($blacklist) {
        $this->blacklist = $blacklist;
    }

    public function setAlasanBlacklist($alasanBlacklist) {
        $this->alasanBlacklist = $alasanBlacklist;
    }

    public function setMemberRow() {
    //private function setMemberRow($data) {
        $data = $this->getMemberRow();
        $this->setIdMember($data["idMember"]);
        $this->setIdPrioritas($data["idPrioritas"]);
        $this->setUsername($data["username"]);
        $this->setEmail($data["email"]);
        $this->setPassword($data["password"]);
        $this->setAvatar($data["avatar"]);
        $this->setAgency($data["agency"]);
        $this->setAlamat($data["alamat"]);
        $this->setCv($data["cv"]);
        $this->setFax($data["fax"]);
        $this->setTanggalDaftar($data["tanggalDaftar"]);
        $this->setAktivasi($data["aktivasi"]);
        $this->setNpwp($data["npwp"]);
        $this->setBlacklist($data["blacklist"]);
        $this->setAlasanBlacklist($data["alasanBlacklist"]);
    }
    
    public function getMemberAll() {
        $query = "SELECT * FROM `$this->namaTable`";
        $data = $this->db->fetchAll($query);
        //$this->setMemberRow($data) ;
        return $data;
    }
    
    public function getMemberPage($pageLimit) {
        $query = "SELECT * FROM `$this->namaTable`
            ORDER BY idMember ASC 
            LIMIT $pageLimit," . config::$MEMBERPERPAGE;
        $data = $this->db->fetchAll($query);
        return $data;
    }
    
    public function getMemberRow() {
        $query = "SELECT * FROM `$this->namaTable` WHERE `idMember` = '$this->idMember'";
        $data = $this->db->fetchRow($query);
        //$this->setMemberRow($data) ;
        return $data;
    }
    
    public function getMemberbyEmail() {
        $query = "SELECT * FROM `$this->namaTable` WHERE `email` = '$this->email'";
        $data = $this->db->fetchRow($query);
        //$this->setMemberRow($data) ;
        return $data;
    }
    
    public function getMemberbyUsername() {
        $query = "SELECT * FROM `$this->namaTable` WHERE `username` = '$this->username'";
        $data = $this->db->fetchRow($query);
        //$this->setMemberRow($data) ;
        return $data;
    }
    
    public function getIdMember() {
        return $this->idMember;
    }

    public function getIdPrioritas() {
        return $this->idPrioritas;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getAvatar() {
     return $this->avatar;
    }

    public function getagency() {
        return $this->agency;
    }

    public function getAlamat() {
        return $this->alamat;
    }

    public function getCv() {
        return $this->cv;
    }

    public function getFax() {
        return $this->fax;
    }

    public function getTanggalDaftar() {
        return $this->tanggalDaftar;
    }

    public function getAktivasi() {
        return $this->aktivasi;
    }

    public function getNpwp() {
        return $this->npwp;
    }

    public function getBlacklist() {
        return $this->blacklist;
    }

    public function getAlasanBlacklist() {
        return $this->alasanBlacklist;
    }

    public function tambahMember($idPrioritas, $username, $email, $password, $avatar,
            $agency, $alamat, $cv, $fax, $date, $aktivasi, $npwp) {
        $query = "INSERT INTO " . $this->namaTable . " (`idPrioritas`, `username`, `email`,
            `password`, `avatar`, `agency`, `alamat`, `cv`, `fax`, `tanggalDaftar`, `npwp`, `aktivasi`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $data = array($idPrioritas, $username, $email, $password, $avatar, $agency, $alamat, $cv, $fax, $date, $npwp, $aktivasi);
        return $this->db->executeDB($data, $query);
    }
    
    public function updateMember($username, $email, $password, 
            $agency, $alamat, $cv, $avatar, $fax, $npwp, $blacklist, $alasanBlacklist) {
        $query = "UPDATE `$this->namaTable` SET `username`=?,
            `email`=?, `password`=?, `agency`=?, `alamat`=?,
            `cv`=?, `avatar`=?, `fax`=?, `npwp`=?, `blacklist`=?, `alasanBlacklist`=?
            WHERE `idMember` = '$this->idMember'";
        $data = array($username, $email, $password, $agency, $alamat, $cv, $avatar, $fax, $npwp, $blacklist, $alasanBlacklist);
        $this->db->executeDB($data, $query);
    }

    public function updateAdmin($email, $password, $agency, $avatar) {
        $query = "UPDATE `$this->namaTable` SET `email`=?, `password`=?, `agency`=?, `avatar`=? 
            WHERE `idMember` = '$this->idMember'";
        $data = array($email, $password, $agency, $avatar);
        $this->db->executeDB($data, $query);
    }
    
    public function updateAktivasi() {
        $query = "UPDATE `$this->namaTable` SET `aktivasi`=? 
            WHERE `idMember` = '$this->idMember'";
        $data = array(1);
        $this->db->executeDB($data, $query);
    }
    
    public function cekAda($username, $email) {
        $ada = false;
        $query = "SELECT * FROM " . $this->namaTable . " where username = '$username' or email = '$email'";
        $data = $this->db->fetchRow($query);
        if ($data['username'] == $username || $data['email'] == $email) {
            $ada = true;
        }
        return $ada;
    }
    
    public function login($username, $password) {
        //$admin = false;
        $loginSuccess = false;
        $namaTable = config::$TABLEPREFIX . "" . config::$TABLEMEMBER;
        $query = "SELECT * FROM " . $namaTable . " where username = '$username' or email = '$username'";
        $data = $this->db->fetchRow($query);

        if ($data["password"] == $password) {
            if($data["aktivasi"] == 1){
                $loginSuccess = true;
                if ($data["idPrioritas"] == 1) {
                    $this->admin = true;
                }
            }else{
                $loginSuccess = false;
            }
        }
        
        $login = array(
            "loginSuccess" => $loginSuccess,
            "idMember" => $data["idMember"],
            "admin" => $this->admin,
            "avatar" => $data["avatar"],
            "aktivasi" => $data["aktivasi"]
        );
        
        return $login;
    }
    
/*    public function tampilLelangDiikuti($idMember) {
        $query = "SELECT l.nama FROM " . config::$TABLEPREFIX . '' . config::$TABLELELANG . " l
            LEFT JOIN " . config::$TABLEPREFIX . '' . config::$TABLEPESERTALELANG . " pl on l.idLelang = pl.idLelang
            and pl.idMember = '$idMember');";
        $data = $this->db->fetchAll($query);
        return $data;
    }
*/
/*    public function getIdLelang($idMember) {
        $namaTable = config::$TABLEPREFIX . '' . config::$TABLEPESERTALELANG;
        $query = "SELECT idLelang FROM " . $namaTable . " WHERE idMember = '$idMember'";
        $data = $this->db->fetchAll($query);
        return $data;
    }
*/
/*    public function getEmail($idMember) {
        $data = $this->getMember($idMember);
        $email = $data["email"];
        return $email;
    }
*/
/*    public function getAgency($idMember) {
        $data = $this->getMember($idMember);
        $agency = $data["agency"];
        return $agency;
    }
*/
/*    public function getTanggalDaftar($idMember) {
        $data = $this->getMember($idMember);
        $tanggalDaftar = $data["tanggalDaftar"];
        return $tanggalDaftar;
    }
*/
/*    public function getIdMember($idPesertaLelang) {
        $namaTable = config::$TABLEPREFIX . '' . config::$TABLEPESERTALELANG;
        $query = "SELECT idMember FROM " . $namaTable . " WHERE idPesertaLelang = '$idPesertaLelang'";
        $data = $this->db->fetchRow($query);
        $idMember = $data["idMember"];
        return $idMember;
    }
*/
/*    public function pilihPemenang($idLelang, $idPesertaLelang, $kualifikasi, $hargaFix, $alasan) {
        $idPemenang = $this->getIdMember($idPesertaLelang);
        $query = "UPDATE " . config::$TABLEPREFIX . '' . config::$TABLELELANG . "
            SET idPemenang=? WHERE idLelang = '$idLelang'";
        $data = array($idPemenang);
        $this->db->executeDB($data, $query);
        $query = "UPDATE " . config::$TABLEPREFIX . '' . config::$TABLEPESERTALELANG . "
            SET kualifikasi=?, hargaFix=?, pemenang=?, alasan=?
            WHERE idPesertaLelang = '$idPesertaLelang'";
        $data = array($kualifikasi, $hargaFix, 1, $alasan);
        $this->db->executeDB($data, $query);
    }
*/
/*    public function getKategori() {
        $namaTable = config::$TABLEPREFIX . "" . config::$TABLEKATEGORI;
        $query = "SELECT kategori FROM " . $namaTable . " ORDER BY idKategori ASC;";
        $data = $this->db->fetchAll($query);
        return $data;
    }
*/
/*    public function getTahap() {
        $namaTable = config::$TABLEPREFIX . "" . config::$TABLENAMATAHAP;
        $query = "SELECT nama FROM " . $namaTable . " ORDER BY idNamaTahap ASC;";
        $data = $this->db->fetchAll($query);
        return $data;
    }
*/
    /*
     * Menambahkan data pada tabel Lelang saat Membuka Lelang
     */

/*    public function bukaLelang($idKategori, $idAdmin, $nama, $hargaMin, $hargaMax, $tglPost, $tglDeadline, $lokasi, $SIUP) {
        $namaTable = config::$TABLEPREFIX . "" . config::$TABLELELANG;
        $query = "INSERT INTO " . $namaTable . " (`idKategori`, `idAdmin`, `nama`,
                `hargaMin`, `hargaMax`, `tanggalPosting`, `tanggalDeadline`, `lokasi`, `SIUP`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $data = array($idKategori, $idAdmin, $nama, $hargaMin, $hargaMax, $tglPost, $tglDeadline, $lokasi, $SIUP);
        return $this->db->executeDB($data, $query);
    }
*/
    /*
     * Menambahkan data pada tabel Kualifikasi
     */

/*    public function bukaLelangKualifikasi($idLelang, $kualifikasi) {
        $namaTable = config::$TABLEPREFIX . "" . config::$TABLEKUALIFIKASI;
        $query = "INSERT INTO " . $namaTable . "(`idLelang`, `kualifikasi`) VALUES (?, ?)";
        $data = array($idLelang, $kualifikasi);
        $this->db->executeDB($data, $query);
    }
*/
    /*
     *  Menambahkan data pada tabel fitur
     */

/*
    public function bukaLelangFitur($idLelang, $fitur) {
        $namaTable = config::$TABLEPREFIX . "" . config::$TABLEFITUR;
        $query = "INSERT INTO " . $namaTable . "(`idLelang`, `fitur`) VALUES (?, ?)";
        $data = array($idLelang, $fitur);
        $this->db->executeDB($data, $query);
    }
*/
/*
    public function bukaLelangTahap($idLelang, $idNamaTahap, $tglMulai, $tglSelesai) {
        $namaTable = config::$TABLEPREFIX . "" . config::$TABLETAHAP;
        $query = "INSERT INTO " . $namaTable . "(`idLelang`, `idNamaTahap`,
                `tanggalMulai`, `tanggalSelesai`, `historyPerubahan`) VALUES (?, ?, ?, ?, ?)";
        $data = array($idLelang, $idNamaTahap, $tglMulai, $tglSelesai, 0);
        $this->db->executeDB($data, $query);
    }
*/
/*    public function updateLelangTahap($idLelang) {
        $namaTable = config::$TABLEPREFIX . "" . config::$TABLETAHAP;
        $query = "SELECT MAX(idTahap) as idTahap FROM " . $namaTable;
        $data = $this->db->fetchRow($query);
        $idTahap = (($data['idTahap'] - 4) + 1);

        $query = "UPDATE " . config::$TABLEPREFIX . '' . config::$TABLELELANG . "
            SET idTahap=? WHERE idLelang = '$idLelang'";
        $data = array($idTahap);
        $this->db->executeDB($data, $query);
    }
*/
/*    public function ikutLelang($idLelang, $idMember, $fitur, $rating, $hargaPenawaran) {
        $namaTable = config::$TABLEPREFIX . "" . config::$TABLEPESERTALELANG;
        $query = "INSERT INTO " . $namaTable . "(`idLelang`, `idMember`,
                `fitur`, `rating`, `hargaPenawaran`) VALUES (?, ?, ?, ?, ?)";
        $data = array($idLelang, $idMember, $fitur, $rating, $hargaPenawaran);
        $this->db->executeDB($data, $query);
    }
*/
    
/*
    public function editIkutLelang($idLelang, $idMember, $fitur, $rating, $hargaPenawaran, $idPesertaLelang) {
        $namaTable = config::$TABLEPREFIX . "" . config::$TABLEPESERTALELANG;
        $query = "UPDATE " . $namaTable . " SET `idLelang`=?, `idMember`=?, 
            `fitur`=?, `rating`=?, `hargaPenawaran`=? 
            WHERE `idPesertaLelang` = '$idPesertaLelang'";
        $data = array($idLelang, $idMember, $fitur, $rating, $hargaPenawaran);
        $this->db->executeDB($data, $query);
    }
*/

/*    public function register($idPrioritas, $username, $email, $password, $agency, $cv, $fax, $date, $aktivasi, $npwp, $telp) {
        $namaTable = config::$TABLEPREFIX . "" . config::$TABLEMEMBER;
        $query = "INSERT INTO " . $namaTable . " (`idPrioritas`, `username`, `email`,
            `password`, `agency`, `cv`, `fax`, `tanggalDaftar`, `npwp`, `aktivasi`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $data = array($idPrioritas, $username, $email, $password, $agency, $cv, $fax, $date, $npwp, $aktivasi);
        $this->db->executeDB($data, $query);
        $idMember = $this->db->getLastInsertId();

        $data = array($idMember, $telp);
        $namaTable = config::$TABLEPREFIX . "" . config::$TABLETELP;
        $query = "INSERT INTO " . $namaTable . " (idMember, noTelp) VALUES (?,?)";
        $this->db->executeDB($data, $query);
    }
*/
}

?>