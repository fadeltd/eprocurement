<?php

global $token, $idMember, $found;
$member = new member();
$member->setIdMember($idMember);
$member->setMemberRow();
$content = '<center>';
if ($found) {
    $content .= '<br /><br /><h3 class="page-header">Selamat Aktivasi Anda berhasil</h3>
        <div class="container marketting">
        <div class="col-xs-12">
        <div class="alert alert-success">
            Verifikasi Akun Anda dengan username "' . $member->getUsername() . '" dan Kode <strong>' . $token . '</strong> berhasil <br />
            Silakan login dengan username dan password yang Anda gunakan untuk mendaftar
        </div>';
} else {
    $content .= '<br /><br /><h3 class="page-header">Aktivasi Anda gagal</h3>
        <div class="container marketting">
        <div class="col-xs-12">
        <div class="alert alert-danger">
                Maaf, kode verifikasi <strong>' . $token . '</strong> tidak dapat ditemukan.
                Mungkin Kode yang Anda masukkan salah.
        </div>';
}
print_r($content.'<br /> <a class="btn btn-primary" href="/eprocurement/"><span class="glyphicon glyphicon-home"></span> Home</a></div></center>');
?>