<?php
global $idPesan, $kodeTiket;
$pesan = new pesan();
$pesan->setIdPesan($idPesan);
$judul = 'Pesan Masuk';
$cetakTanggapan = '';
if (isset($kodeTiket)) {
    $pesan->setKodeTiket($kodeTiket);
    $dataPesan = $pesan->getPesanbyKodeTiket();
    $judul = '<br /><br />Tanggapan Kode Tiket ' . $kodeTiket;
    $content = '<div class="container marketting">
        <div class="col-xs-12">';
    if (isset($dataPesan["tanggapan"])) {
        $cetakTanggapan = '<div class="alert alert-success"><strong>Tanggapan atas tiket ini adalah: </strong><br /> ' . $dataPesan["tanggapan"] . '</div>';
        $content .= viewTicket($dataPesan, $judul);
    } else {
        $content .=  '<center><h3 class="page-header">' . $judul . '</h3>';
        $cetakTanggapan = '
            <div class="alert alert-danger">Maaf, untuk kode tiket <strong>' . $kodeTiket . '</strong> tidak dapat ditemukan atau 
            belum dilayani, <br /> silakan mengecek kembali halaman <a href="/eprocurement/tiket/">cek tiket</a>
            setelah beberapa waktu, <br /> Admin butuh waktu untuk menjawab.
            </div>';
    }
} else {
    $dataPesan = $pesan->getPesanRow();
    $content = '<div class="container marketting">
        <div class="col-lg-10">'.viewTicket($dataPesan, $judul);
}

function viewTicket($dataPesan, $judul) {
    $content = '<center><h3 class="page-header">' . $judul . '</h3>
                <table class="table-hover" width="60%">
                <tr>
                    <td>ID Pesan</td>
                    <td>' . $dataPesan["idPesan"] . '</td>
                </tr>
                <tr>
                    <td>Kode Tiket</td>
                    <td>' . $dataPesan["kodeTiket"] . '</td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td>' . $dataPesan["username"] . '</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>' . $dataPesan["email"] . '</td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>' . $dataPesan["tanggal"] . '</td>
                </tr>
                <tr>
                    <td>Judul</td>
                    <td>' . $dataPesan["judul"] . '</td>
                </tr>
                <tr>
                    <td>Pesan</td>
                    <td>' . $dataPesan["pesan"] . '</td>
                </tr>
                </table>';
    return $content;
}

print_r($content.'<br />'.$cetakTanggapan.'<a class="btn btn-primary" onClick="javascript:history.go(-1);">Back </a></center>');
if (!isset($kodeTiket)) {
    ?>
    <br/> 
    <hr class="featurette-divider"/>
    <center><h3 class="page-header">Tanggapan Pesan</h3>
        <form class="form-horizontal" method="POST" action="">
            <input type="hidden" name="action" value="tanggapi">
            <input type="hidden" name="idPesan" value="<?php echo $idPesan ?>">
            <div class="form-group">
                <label class="col-sm-2 control-label">Tanggapan</label>
                <div class="col-sm-8">
                    <textarea style="width:125%;height: 30%;" class="form-control" name="tanggapan" placeholder="Tanggapan" required></textarea>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-default" name="submit">Submit</button>
                <button type="reset" class="btn btn-default">Reset</button>
                <a onClick="javascript:history.go(-1);" class="btn btn-default">Cancel</a>
            </div>
        </form>
    </center>
    </div>
    <?php
}
?>