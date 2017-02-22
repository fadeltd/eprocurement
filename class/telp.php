<?php

class telp {

    private $idTelp, $idMember, $noTelp, $db, $namaTable;

    public function __construct() {
        $this->db = new DB();
        $this->namaTable = config::$TABLEPREFIX . "" . config::$TABLETELP;
    }

    public function setIdTelp($idTelp) {
        $this->idTelp = $idTelp;
    }

    public function setIdMember($idMember) {
        $this->idMember = $idMember;
    }

    public function setNoTelp($noTelp) {
        $this->noTelp = $noTelp;
    }
    
    public function setTelpRow() {
    //private function setTelpRow($data) {
        $data = $this->getTelpRow();
        $this->setIdTelp($data["idTelp"]);
        $this->setIdMember($data["idMember"]);
        $this->setNoTelp($data["noTelp"]);
    }
    
    public function getTelpAll() {
        $query = "SELECT * FROM `$this->namaTable`";
        $data = $this->db->fetchAll($query);
        return $data;
    }

    public function getTelpRow() {
        $query = "SELECT * FROM `$this->namaTable` WHERE idTelp = $this->idTelp";
        $data = $this->db->fetchRow($query);
        //$this->setTelpRow($data);
        return $data;
    }
    
    public function getTelpbyMember() {
        $query = "SELECT * FROM `$this->namaTable` WHERE `idMember` = $this->idMember";
        $data = $this->db->fetchAll($query);
        return $data;
    }

    public function getIdTelp() {
        return $this->idTelp;
    }

    public function getIdMember() {
        return $this->idMember;
    }

    public function getNoTelp() {
        return $this->noTelp;
    }

    /*
     * Tidak membutuhkan setIdMember($idMember)
     * Untuk menangani post_handler edit profil
     * (/eprocurement/admin/edit-member/#$idMember)
     * (/eprocurement/edit-profil)
     */

    public function tambahTelp($idMember, $noTelp) {
        $query = "INSERT INTO `$this->namaTable` (`idMember`, `noTelp`) VALUES (?, ?)";
        $data = array($idMember, $noTelp);
        $this->db->executeDB($data, $query);
        //return $this->db->dbh->rowCount() > 0 ? true : false; //Untuk Mengecek Apakah Update Berhasil atau tidak
    }

    /*
     * Harus memanggil setIdTelp($idTelp) terlebih dahulu
     * Untuk menangani post_handler ganti-telp
     * (/eprocurement/admin/ganti-telp/#idTelp)
     */

    public function updateTelp($idMember, $noTelp) {
        if (isset($this->idTelp)) {
            $query = "UPDATE `$this->namaTable` SET `idMember`=?,`noTelp=?`
                WHERE `idTelp` = `$this->idTelp`";
            $data = array($idMember, $noTelp);
            $this->db->executeDB($data, $query);
            //return $this->db->dbh->rowCount() > 0 ? true : false; //Untuk Mengecek Apakah Update Berhasil atau tidak
        }
    }

}

?>
