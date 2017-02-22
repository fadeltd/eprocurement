<?php
/*global $pageID, $jumlahHalaman, $jenis;
if (isset($pageID) && $pageID != '') {
    $id = $pageID - 1;
} else {
    $id = '0';
}

$pageLimit = config::$MEMBERPERPAGE * $id;*/
$pesan = new pesan();
$result = $pesan->getPesanAll();
//$result = $pesan->getPesanPage($pageLimit);
//$jumlahHalaman = getPagination(count($pesan->getMemberAll()), config::$MEMBERPERPAGE);
//$jenis = 'pesan';

$content = '<div class="col-lg-10">
        <h2>Daftar Pesan</h2>
        <p>Anda Membuka Daftar Member</p>
        <table class="reference">
            <tr>
                <th>Pesan ID</th>
                <th>Tanggal</th>
                <th>Judul</th>
                <th>Username</th>
                <th>Email</th>
                <th>Kode Tiket</th>';
$content = $content . '<th>Tanggapi</th>';

$i = 1;
foreach ($result as $hasil) {
    $content = $content . '
        <tr>
        <td>' . $i . '</td>
        <td>' . $hasil["tanggal"] . '</td>
        <td>' . $hasil["judul"] . '</td>
        <td>' . $hasil["username"] . '</td>
        <td>' . $hasil["email"] . '</td>
        <td>' . $hasil["kodeTiket"] . '</td>';
    if(isset($hasil["tanggapan"])){
        $url = 'disabled';
    }else{
        $url = 'href="/eprocurement/admin/tanggapi/'.$hasil[0].'"';
    }
    $content.='
        <td><a ' . $url. ' class="btn btn-success">
        <span class="glyphicon glyphicon-envelope"></span> Tanggapi</a></td>
        </tr>';
    $i++;
}
$content = $content . '
            </table>
            <div align="center">
                <ul id="paging"></ul>
            </div>
        </div></div>';
print_r($content);

?>