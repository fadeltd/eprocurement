<?php
/**
 * Description of config
 * Mengatur seluruh konstan yang digunakan pada semua apikasi
 * @author Fadel
 */
class config {
    public static $SITE_TITLE = "Mitra Pembangunan Ciputri"; // Set Site Title
    //public static $DBLOCATION = "mysql.idhostinger.com"; // Set the IP or hostname of the database server you wish to connect to
    //public static $DBNAME = "u645812181_eproc"; // Set the name of the database you wish to connect to
    //public static $DBUSER = "u645812181_root"; // set the database user name you wish to use to connect to the database server
    //public static $DBPASSWORD = "HJr9TD9a3C"; // set the password for the username above
    public static $DBLOCATION = "localhost"; 
    public static $DBNAME = "eproc"; 
    public static $DBUSER = "root"; 
    public static $DBPASSWORD = ""; 
    public static $TABLEPREFIX = "ep_";
    public static $TABLEFITUR = "fitur";
    public static $TABLEKATEGORI = "kategori";
    public static $TABLEKUALIFIKASI = "kualifikasi";
    public static $TABLELELANG = "lelang";
    public static $TABLEMEMBER = "member";
    public static $TABLENAMATAHAP = "namatahap";
    public static $TABLEPESERTALELANG = "pesertalelang";
    public static $TABLEPESAN = "pesan";
    public static $TABLEPRIORITASMEMBER = "prioritasmember";
    public static $TABLETAHAP = "tahap";
    public static $TABLETELP = "telp";
    public static $LELANGPERPAGE = 5; // number of results per page.
    public static $MEMBERPERPAGE = 7; // number of results per page.
}

?>
