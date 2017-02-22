<?php

//$member = new member();
$idMember = $_SESSION["user"]["userid"];
$pesertalelang = new pesertaLelang();
$pesertalelang->setIdMember($idMember);
$result = $pesertalelang->getPesertaLelangbyIdMember();
//$result = $member->getIdLelang($_SESSION["user"]["userid"]);

$content = '<div class="col-lg-10">
            <center><h2>Daftar Lelang yang Diikuti</h2></center>
                <table class="reference">
                    <tr>
                        <th>No</th>
                        <th>Nama Lelang</th>
                        <th>Kategori</th>
                        <th>Tahap</th>
                        <th>Edit Ikuti Lelang</th>
                    </tr>';
$i = 1;
foreach ($result as $pelelangan) {
    $lelang = new lelang();
    $lelang->setIdLelang($pelelangan["idLelang"]);
    $lelang->setLelangRow();
    $kategori = new kategori();
    $kategori->setIdKategori($lelang->getIdKategori());
    $kategori->setKategoriRow();
    $content = $content . '<tr>
        <td>' . $i . '</td>
        <td>' . $lelang->getNama();
    if (!($lelang->getIdPemenang() > 0)) {
        $content = $content . '</td>';
        $url = 'href="/eprocurement/lelang/ikut/' . $pelelangan["idLelang"] . '" ';
    } else {
        $content = $content . '<br /><a href="/eprocurement/lelang/pemenang/' . $pelelangan["idLelang"] . '">Pemenang</a></td>';
        $url = 'disabled';
    }
    $tahap = new tahap();
    $tahap->setIdTahap($lelang->getIdTahap());
    $tahap->setTahapRow();
    $namatahap = new namatahap();
    $namatahap->setIdNamaTahap($tahap->getIdNamaTahap());
    $namatahap->setNamaTahapRow();
    $content = $content .  '
        <td>
            <a href="/eprocurement/lelang/kategori/' . $lelang->getIdKategori() . '">' .
                $kategori->getKategori() . '</a>
        </td>
        <td>
            <a href="/eprocurement/lelang/tahap/' . $pelelangan["idLelang"] . '">' .
            //$lelang->getNamaTahap($lelang->getIdNamaTahap($idLelang[0]))
            
            $namatahap->getNamaTahap(). '</a>
        </td>
        <td>
            <a ' . $url . ' class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span> Edit Ikut</a>
        </td>
    </tr>';
    $i++;
    /* $content = $content . '<tr>
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
      $url = 'href="/eprocurement/lelang/ikut/' . $idLelang[0] . '" ';
      } else {
      $url = 'disabled';
      }
      $content = $content . '<td rowspan="2"><a ' . $url . ' class="btn btn-primary">
      <span class="glyphicon glyphicon-thumbs-up"></span> Edit Ikut</a></td>
      <td><a href="/eprocurement/lelang/kategori/'.$lelang->getIdKategori() . '">' . $kategori->getNamaKategori($lelang->getIdKategori()) . '</a> </td>
      </tr>';
     */
}
$content = $content . '</table></div>
        <center><a class="btn btn-primary" onClick="javascript:history.go(-1);">
        <span class="glyphicon glyphicon-arrow-left"></span> Back </a></center></div>';
print_r($content);
?>