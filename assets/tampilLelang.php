<?php

global $action, $idLelang;
$lelang = new lelang();
$lelang->setIdLelang($idLelang);
$lelang->setLelangRow();

//$content = $lelang->toString($action);

function getView($idLelang) {
    $lelang = new lelang();
    $lelang->setIdLelang($idLelang);
    $lelang->setLelangRow();
    $dataLelang = $lelang->tampilLelang($idLelang);
    //$dataKualifikasi = $lelang->tampilKualifikasi($idLelang);
    //$dataFitur = $lelang->tampilFitur($idLelang);
    //$jumlahPeserta = sizeof($lelang->tampilPesertaLelang($idLelang));
    $kualifikasi = new kualifikasi();
    $kualifikasi->setIdLelang($idLelang);
    $dataKualifikasi = $kualifikasi->getKualifikasibyLelang();
    $fitur = new fitur();
    $fitur->setIdLelang($idLelang);
    $dataFitur = $fitur->getFiturbyLelang();
    $pesertalelang = new pesertaLelang();
    $pesertalelang->setIdLelang($idLelang);
    $jumlahPeserta = count($pesertalelang->getPesertaLelangbyIdLelang());

    $content = '<div class="col-lg-10">
				<center><h2 class="page-header">Informasi Lelang</h2></center>
                <center><table class="reference" width="60%">
                <tr>
                    <td>Kode Lelang</td>
                    <td>' . $dataLelang["idLelang"] . '</td>
                </tr>
                <tr>
                    <td>Nama Lelang</td>
                    <td>' . $dataLelang["nama"] . '</td>
                </tr>
                <tr>
                    <td>Kategori</td>
                    <td>' . $dataLelang["kategori"] . '</td>
                </tr>
                <tr>
                    <td>Tahap Lelang</td>
                    <td><a href="/eprocurement/lelang/tahap/' . $idLelang . '">' . $dataLelang["namaTahap"] . '</a></td>
                </tr>
                <tr>
                    <td>Agency / Satuan Kerja</td>
                    <td>' . $dataLelang["agency"] . '</td>
                </tr>
                <tr>
                    <td>Lokasi Pekerjaan</td>
                    <td>' . $dataLelang["lokasi"] . '</td>
                </tr>
                <tr>
                    <td>Harga Minimal</td>
                    <td>' . $dataLelang["hargaMin"] . '</td>
                </tr>
                <tr>
                    <td>Harga Maksimal</td>
                    <td>' . $dataLelang["hargaMax"] . '</td>
                </tr>
                <tr>
                    <td>Tanggal Pengajuan</td>
                    <td>' . $dataLelang["tanggalPosting"] . '</td>
                </tr>
                <tr>
                    <td>Tanggal Batas Pengumuman</td>
                    <td>' . $dataLelang["tanggalDeadline"] . '</td>
                </tr>
                <tr>
                    <td>SIUP</td>
                    <td>' . $dataLelang["SIUP"] . '</td>
                </tr>
                <tr>
                    <td rowspan = "' . (sizeOf($dataKualifikasi) + 1) . '">Syarat Kualifikasi</td>
                </tr>';
    foreach ($dataKualifikasi as $hasil) {
        $content = $content . '<tr><td> ' . $hasil["kualifikasi"] . '</td></tr>';
    }
    $content = $content . '</td>
                 <tr>
                    <td rowspan = "' . (sizeOf($dataFitur) + 1) . '">Fitur</td>
                </tr>';
    foreach ($dataFitur as $hasil) {
        $content = $content . '<tr><td>' . $hasil["fitur"] . '</td></tr>';
    }
    $content = $content . '</td>
                <tr>
                    <td>Jumlah Peserta</td>
                    <td>' . $jumlahPeserta . ' Peserta <a href="/eprocurement/lelang/peserta/' . $dataLelang["idLelang"] . '">[Detil...]</a></td>
                </tr>
            </table></center></div>';

    return $content;
}

$content = '';
switch ($action) {
    case 'view':
        $content = getView($idLelang);
        if ($_SESSION["user"]["admin"] == 1) {
            $content = $content . '<div class="col-lg-offset-5"><a href="/eprocurement/admin/ganti-tahap/' . $idLelang . '" class="btn btn-default">
                <span class="glyphicon glyphicon-wrench"></span> Ganti Tahap</a>
                <a href="/eprocurement/admin/tambah/fitur/' . $idLelang . '" class="btn btn-default">
                <span class="glyphicon glyphicon-wrench"></span> Tambah Fitur</a>
                <a href="/eprocurement/admin/tambah/kualifikasi/' . $idLelang . '" class="btn btn-default">
                <span class="glyphicon glyphicon-wrench"></span> Tambah Kualifikasi</a></div>';
        }
        break;
    case 'peserta':
        $result = $lelang->tampilPesertaLelang($idLelang);
        $content = '
            <div class="col-lg-10">
            <h2 class="page-header">' . $lelang->getNama() . '</h2>';
        if (count($result) >= 1) {
            $content .= '
            <table class = "reference">
            <tr>
            <th>No</th>
            <th>Nama penyedia barang/jasa</th>
            <th>Harga Penawaran</th>';
            if ($_SESSION["user"]["admin"] == 1) {
                $content = $content . '<th>Fitur</th><th>Rating</th>';
                if (!($lelang->getIdPemenang() > 0)) {
                    $content = $content . '<th>Pilih Pemenang</th>';
                }
            }
        } else {
            $content .= '<p>Belum ada peserta yang mendaftar pada lelang ini</p>';
        }
        $content = $content . '</tr>';
        $i = 1;
        //LELANG PER PAGE = ??
        $jumlah = 0;
        foreach ($result as $hasil) {
            $jumlah += $hasil[4];
        }
        foreach ($result as $hasil) {
            $content = $content . '<tr>
            <td>' . $i . '</td>
            <td><strong>' . strtoupper($hasil[1]) . '</strong></td>
            <td>' . $hasil[2] . '</td>';
            if ($_SESSION["user"]["admin"] == 1) {
                $content = $content . '<td>' . $hasil[3] . '</td>
                <td>' . 100*number_format($hasil[4]/$jumlah,4) . '%</td>';
                if (!($lelang->getIdPemenang() > 0)) {
                    $content = $content . '<td><a href="/eprocurement/admin/pilih-pemenang/lelang/' .
                            $idLelang . '/peserta/' . $hasil[0] . '" class="btn btn-primary">
                    <span class="glyphicon glyphicon-thumbs-up"></span> Pilih </a></td>';
                }
            }
            $content = $content . '</tr>';
            $i++;
        }
        $content = $content . '</table></div>';
        break;
    case 'pemenang':
        $dataLelang = $lelang->tampilDataLelangPemenang($idLelang);
        $dataPemenang = $lelang->tampilPemenangLelang($idLelang);
        $content = $content . '
            <div class="col-lg-10">
            <h3 class="page-header">Pemenang Lelang - ' . $dataLelang["nama"] . '</h3>
                <table class="reference">
                <tr>
                    <td>Kode Lelang</td>
                    <td>:</td>
                    <td>' . $dataLelang["idLelang"] . '</td>
                </tr>
                <tr>
                    <td>Nama Lelang</td>
                    <td>:</td>
                    <td>' . $dataLelang["nama"] . '</td>
                </tr>
                <tr>
                    <td>Kategori</td>
                    <td>:</td>
                    <td>' . $dataLelang["kategori"] . '</td>
                </tr>               
                <tr>
                    <td>Agency / Satuan Kerja</td>
                    <td>:</td>
                    <td>' . $dataLelang["agency"] . '</td>
                </tr>
                <tr>
                    <td>Lokasi Pekerjaan</td>
                    <td>:</td>
                    <td>' . $dataLelang["lokasi"] . '</td>
                </tr>
                <tr>
                    <td>Harga Minimal</td>
                    <td>:</td>
                    <td>' . $dataLelang["hargaMin"] . '</td>
                </tr>
                <tr>
                    <td>Harga Maksimal</td>
                    <td>:</td>
                    <td>' . $dataLelang["hargaMax"] . '</td>
                </tr>
                <tr>
                    <td>Nama Pemenang</td>
                    <td>:</td>
                    <td><strong>' . strtoupper($dataPemenang["agency"]) . '</strong></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td><strong>' . $dataPemenang["alamat"] . '</strong></td>
                </tr>
                <tr>
                    <td>NPWP</td>
                    <td>:</td>
                    <td>' . $dataPemenang["NPWP"] . '</td>
                </tr>
                <tr>
                    <td>Harga Penawaran</td>
                    <td>:</td>
                    <td>' . $dataPemenang["hargaPenawaran"] . '</td>
                </tr>
                </table>
                <h3 class="page-header">Hasil Evaluasi</h3>
                <table class = "reference">
                    <tr>
                    <th>No</th>
                    <th>Nama Peserta</th>
                    <th>Kualifikasi</th>
                    <th>Rating</th>
                    <th>Harga Penawaran</th>
                    <th>Harga Fix</th>
                    <th>Pemenang</th>
                    <th>Alasan</th>
                    </tr>
                    ';
        $result = $lelang->tampilPesertaMenangLelang($idLelang);
        $i = 1;
        foreach ($result as $hasil) {
            $content = $content . '<tr>
                    <td>' . $i . '</td>
                    <td><strong>' . strtoupper($hasil[0]) . '</strong></td>';
            if ($hasil[1] == 1) {
                $content = $content . '<td><span class="glyphicon glyphicon-ok" ></span></td>';
            } else {
                $content = $content . '<td><span class="glyphicon glyphicon-remove"></span></td>';
            }
            $content = $content . '<td>' . $hasil[2] . '</td>
                    <td>' . $hasil[3] . '</td>
                    <td>' . $hasil[4] . '</td>';
            if ($hasil[5] == 1) {
                $content = $content . '<td><span class="glyphicon glyphicon-star"></span></td>';
            } else {
                $content = $content . '<td></td>';
            }
            $content = $content . '<td>' . $hasil[6] . '</td></tr>';
            $i++;
        }
        $content = $content . '</table>';
        break;
    case 'tahap':
        $result = $lelang->tampilTahapLelang($idLelang);
        $content = $content . '
            <div class="col-lg-10">
            <h2 class="page-header">' . $lelang->getNama() . '</h2>
            <table class = "reference">
            <tr>
            <th>No</th>
            <th>Tahap</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th>History Perubahan</th>
            </tr>';
        $i = 1;
        //LELANG PER PAGE = ??
        foreach ($result as $hasil) {
            $namatahap = new namatahap();
            //$tahap = new tahap();
            //$tahap->setIdTahap($lelang->getIdTahap());
            //$tahap->setTahapRow();
            //$namatahap->setIdNamaTahap($tahap->getIdNamaTahap());
            $namatahap->setIdNamaTahap($hasil[0]);
            $namatahap->setNamaTahapRow();
            $content = $content . '<tr>
            <td>' . $i . '</td>';
            //<td><strong>' . strtoupper($namatahap->getIdNamaTahap($tahap->getIdNamaTahap())) . '</strong></td>
            $content.='
            <td><strong>' . strtoupper($namatahap->getNamaTahap()) . '</strong></td>    
            <td>' . $hasil[1] . '</td>
            <td>' . $hasil[2] . '</td>
            <td>' . $hasil[3] . '</td>
            </tr>';
            $i++;
        }
        $content = $content . '</table>';
        break;
    case 'kategori':
        $result = $lelang->tampilKategori($idLelang);
        $content = $content . '
            <div class="col-lg-10">
            <h3 class="page-header">Kategori</h3>
            <table class="reference">
            <tr>
                <th>No</th>
                <th colspan="3">Nama Lelang</th>
                <th>Agency</th>
                <th>Tahap</th>
                <th>HPS</th>
            </tr>';
        $i = 1;
        foreach ($result as $hasil) {
            $content = $content . '
                    <tr>
                    <td rowspan="2">' . $i . '</td>
                    <td colspan="3"><a href="/eprocurement/lelang/view/' . $hasil[0] . '"><strong>' . strtoupper($hasil[1]) . '</strong></a><br>
                    <a href="/eprocurement/lelang/view/' . $hasil[0] . '">Pengumuman</a> - 
                    <a href="/eprocurement/lelang/peserta/' . $hasil[0] . '">Peserta & Penawaran</a> -
                    <a href="/eprocurement/lelang/pemenang/' . $hasil[0] . '">Pemenang</a>
                    </td>
                    <td>' . $hasil[2] . '</td>
                    <td><a href="/eprocurement/lelang/tahap/' . $hasil[0] . '">' . $hasil[3] . '</a></td>
                    <td>' . $hasil[4] . '</td>
                    </tr>
                    <td>Kategori</td>
                    <td>:</td>
                    <td><a href="/eprocurement/lelang/kategori/' . $hasil[5] . '">' . $hasil[6] . '</a> </td>
                    <td></td><td></td><td></td>
                    </tr>';

            $i++;
        }
        $content = $content . '</table>';
        break;
    case 'ikut':
        $hasil = getView($idLelang);
        print_r($hasil . '<hr class="featurette-divider" />');
        include_once 'formIkutLelang.php';
        break;
    case 'semua':
        global $pageID, $jenis;
        $pageID = $idLelang;
        include_once "assets/leftNavigation.php";
        include_once "assets/daftarLelang.php";
        $content = '';
        break;
}

if (isset($_SESSION["user"]) && $action != 'semua') {
    if ($_SESSION["user"]["admin"] != 1) {
        $url = 'href="/eprocurement/home"';
    } else {
        $url = 'onClick="javascript:history.go(-1);"';
    }
    $content.='<div class="col-lg-offset-6"><a class="btn btn-primary" ' . $url . '>
        <span class="glyphicon glyphicon-arrow-left"></span> Back </a></div>';
}
print_r($content);
?>