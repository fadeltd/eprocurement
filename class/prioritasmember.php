<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of prioritasmember
 * Digunakan untuk melakukan operasi dengan tabel prioritasMember
 * @author Fadel
 */
class prioritasmember {

    private $idPrioritas, $prioritasMember, $db, $namaTable;

    public function __construct() {
        $this->db = new DB();
        $this->namaTable = config::$TABLEPREFIX . "" . config::$TABLEPRIORITASMEMBER;
    }

    public function setIdPrioritasMember($idPrioritas) {
        $this->idPrioritas = $idPrioritas;
    }

    public function setPrioritasMember($prioritasMember) {
        $this->prioritasMember = $prioritasMember;
    }
    
    public function setPrioritasMemberRow() {
    //private function setPrioritasMemberRow($data) {
        $data = $this->getPrioritasMemberRow();
        $this->setIdPrioritasMember($data["idPrioritas"]);
        $this->setPrioritasMember($data["prioritas"]);
    }

    public function getPrioritasMemberAll() {
        $query = "SELECT * FROM " . $this->namaTable;
        $data = $this->db->fetchAll($query);
        return $data;
    }

    public function getPrioritasMemberRow() {
        $query = "SELECT * FROM " . $this->namaTable . "
            WHERE idPrioritas = '$this->idPrioritas'";
        $data = $this->db->fetchRow($query);
        //$this->setPrioritasMemberRow($data);
        return $data;
    }

    public function getIdPrioritasMember() {
        return $this->idPrioritas;
        //$data = $this->getIdPrioritasMemberRow();
        //return $data["idPrioritas"];
    }

    public function getPrioritasMember() {
        return $this->prioritasMember;
        //$data = $this->getIdPrioritasMemberRow();
        //return $data["prioritasMember"];
    }

    public function updatePrioritasMember($idPrioritas, $prioritasMember) {
        //$query = "UPDATE `$this->namaTable` SET `prioritasMember` = ?
        //    WHERE `idPrioritas` = `$this->idPrioritas`";
        $query = "UPDATE `$this->namaTable` SET `prioritasMember` = ?
            WHERE `idPrioritas` = `$idPrioritas`";
        $data = array($prioritasMember);
        $this->db->executeDB($data, $query);
        //return $this->db->dbh->rowCount() > 0 ? true : false; //Untuk Mengecek Apakah Update Berhasil atau tidak
    }

    public function tambahPrioritasMember($prioritasMember) {
        $query = "INSERT INTO `$this->namaTable` (`prioritasMember`)
                VALUES (?)";
        $data = array($prioritasMember);
        $this->db->executeDB($data, $query);
        //return $this->db->dbh->rowCount() > 0 ? true : false; //Untuk Mengecek Apakah Update Berhasil atau tidak
    }

}

?>
