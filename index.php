<?php
    session_start();
    ini_set('max_execution_time', 300);
    include_once "class/config.php";
    include_once "class/db.php";
    include_once "class/email.php";
    include_once "class/fitur.php";
    include_once "class/kategori.php";
    include_once "class/kualifikasi.php";
    include_once "class/lelang.php";
    include_once "class/member.php";
    include_once "class/namatahap.php";
    include_once "class/pesan.php";
    include_once "class/pesertaLelang.php";   
    include_once "class/prioritasmember.php";
    include_once "class/tahap.php";
    include_once "class/telp.php";
    
    include_once "controllers/upload.php";
    include_once "controllers/menu.php";
    include_once "controllers/controller.php";
    post_handler();
    get_handler();
    
?>