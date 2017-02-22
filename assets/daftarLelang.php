<?php

/* AJAX
 */
// $member = new member();
// $semuaLelang = $member->tampilLelangSemua();
// Untuk Mengecek Halaman yang di pilih pagination dari AJAX loader
/*
if (isset($_POST["pageId"]) && !empty($_POST["pageId"])) {
    $id = $_POST["pageId"];
} else {
    $id = '0';
}
*/


//NON AJAX
global $pageID, $jumlahHalaman, $jenis;
if (isset($pageID) && $pageID != '') {
    $id = $pageID - 1;
} else {
    $id = '0';
}

$pageLimit = config::$LELANGPERPAGE * $id;
$lelang = new lelang();
$result = $lelang->getLelangPage($pageLimit);
$jumlahHalaman = getPagination(count($lelang->getLelangAll()), config::$LELANGPERPAGE);
$jenis = 'lelang';
//$paginationCount = getPagination(count($semuaLelang), config::$LELANGPERPAGE);

if (count($result) > 0) {
    $content = '
        <div class="col-lg-10">
        <center><h2 class="page-header">Daftar Lelang Terbaru </h2></center>
        <center><table class="reference">
            <tr>
                <th>No</th>
                <th colspan="3">Nama Lelang</th>
                <th>Agency</th>
                <th>Tahap</th>
                <th>Harga Minimum</th>';
    if (isset($_SESSION["user"])) {
        if ($_SESSION["user"]["admin"] == 1) {
            $content = $content . '<th>Ganti Tahap</th>
            <th>Pilih Pemenang</th>
        </tr>';
            $i = $id * config::$LELANGPERPAGE + 1;
//LELANG PER PAGE = ??
            foreach ($result as $hasil) {
                $lelang = new lelang();
                $lelang->setIdLelang($hasil[0]);
                $lelang->setLelangRow();
                $content .= '<tr>
            <td rowspan="2">' . $i . '</td>
            <td colspan="3"><a href="/eprocurement/lelang/view/' . $hasil[0] . '"><strong>' . strtoupper($hasil[1]) . '</strong></a><br>
                    <a href="/eprocurement/lelang/view/' . $hasil[0] . '">Pengumuman</a> - 
                    <a href="/eprocurement/lelang/peserta/' . $hasil[0] . '">Peserta & Penawaran</a>';
                if ($hasil[7] > 0) {
                    $content .= ' - <a href="/eprocurement/lelang/pemenang/' . $hasil[0] . '">Pemenang</a></td>';
                }
                $content .= '<td>' . $hasil[2] . '</td>
            <td><a href="/eprocurement/lelang/tahap/' . $hasil[0] . '">' . $hasil[3] . '</a></td>
            <td>' . $hasil[4] . '</td>';
                if (!($lelang->getIdPemenang() > 0)) {
                    $urlEdit = 'href="/eprocurement/lelang/view/' . $hasil[0] . '"';
                    $urlView = 'href="/eprocurement/lelang/peserta/' . $hasil[0] . '"';
                } else {
                    $urlEdit = 'disabled';
                    $urlView = 'disabled';
                }
                $content .= '<td rowspan="2"><a class="btn btn-warning" ' . $urlEdit . '>
            <span class="glyphicon glyphicon-wrench"></span> Edit</a></td>
            <td rowspan="2"><a class="btn btn-primary" ' . $urlView . '>
            <span class="glyphicon glyphicon-thumbs-up"></span> Pilih</a></td>
            </tr>
            <td>Kategori</td>
            <td>:</td>
            <td><a href="/eprocurement/lelang/kategori/' . $hasil[5] . '">' . $hasil[6] . '</a> </td>
            <td></td><td></td><td></td>
            </tr>';
                $i++;
            }
            //print_r($content);
//Menangani Content Member
        } else {
            $content .= view($result);
            //print_r($content);
        }
    } else {
        $content .= view($result);
        //print_r($content);
    }
    $content .= '
                    </table>
                </center>
            </div><!-- /.col-lg-10 -->
            <div align="center">
                <ul id="paging"></ul>
            </div><!-- /.paging -->
        </div><!-- /.row -->';
} else {
    $content = 'Tabel Kosong';
}

function view($result) {
    $content = '<th>Ikuti Lelang</th>
            </tr>';
    $i = 1;
    foreach ($result as $hasil) {
        $lelang = new lelang();
        $lelang->setIdLelang($hasil[0]);
        $lelang->setLelangRow();
        $content = $content . '<tr>
            <td rowspan="2">' . $i . '</td>
            <td colspan="3"><a href="/eprocurement/lelang/view/' . $hasil[0] . '"><strong>' . strtoupper($hasil[1]) . '</strong></a><br>
                    <a href="/eprocurement/lelang/view/' . $hasil[0] . '">Pengumuman</a> - 
                    <a href="/eprocurement/lelang/peserta/' . $hasil[0] . '">Peserta & Penawaran</a>';
        if ($hasil[7] > 0) {
            $content = $content . ' - <a href="/eprocurement/lelang/pemenang/' . $hasil[0] . '">Pemenang</a></td>';
        }
        $content = $content . '<td>' . $hasil[2] . '</td>
            <td><a href="/eprocurement/lelang/tahap/' . $hasil[0] . '">' . $hasil[3] . '</a></td>
            <td>' . $hasil[4] . '</td>';
        if (!($lelang->getIdPemenang() > 0)) {
            $url = 'href="/eprocurement/lelang/ikut/' . $hasil[0] . '" ';
        } else {
            $url = 'disabled';
        }
        $content = $content . '<td rowspan="2"><a '. $url .' class="btn btn-primary">
                <span class="glyphicon glyphicon-thumbs-up"></span> Ikuti</a></td>
                </tr>
                <td>Kategori</td>
                <td>:</td>
                <td><a href="/eprocurement/lelang/kategori/' . $hasil[5] . '">' . $hasil[6] . '</a> </td>
                <td></td><td></td><td></td>
                </tr>';
        $i++;
    }
    return $content;
}

print_r($content);
?>