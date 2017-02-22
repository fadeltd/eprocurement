<?php

global $pageID, $jumlahHalaman, $jenis;
if (isset($pageID) && $pageID != '') {
    $id = $pageID - 1;
} else {
    $id = '0';
}

$pageLimit = config::$MEMBERPERPAGE * $id;
$member = new member();
$result = $member->getMemberPage($pageLimit);
$jumlahHalaman = getPagination(count($member->getMemberAll()), config::$MEMBERPERPAGE);
$jenis = 'member';

$content = '<div class="col-lg-10">
        <h2>Daftar Member</h2>
        <p>Anda Membuka Daftar Member</p>
        <div align="center">
        <table class="reference">
            <tr>
                <th>Member ID</th>
                <th>Prioritas</th>
                <th>Username</th>
                <th>Email</th>';
//<th>Agency</th>
//<th>Alamat</th>
//<th>CV</th>
//<th>Fax</th>
//<th>Tanggal Daftar</th>
//<th>NPWP</th>
//<th>Blacklist</th>
//<th>Alasan Blacklist</th>
//<th>No Telp</th>
$content = $content . '<th>Edit</th>';


$i = 0;
foreach ($result as $hasil) {
    if ($hasil[1] == 1) {
        $urlCV = '';
        if ($hasil[0] == $_SESSION["user"]["userid"]) {
            $urlEdit = 'href="/eprocurement/edit-profil/"';
        }
    } else if ($hasil[1] != 1) {
        $urlEdit = 'href="/eprocurement/admin/edit-member/' . $hasil[0] . '"';
        $urlCV = '<a href="/eprocurement/assets/docs/cv/' . $hasil[8] . '" class="btn btn-success"><span class="glyphicon glyphicon-download"></span> CV</a>';
    } else {
        $urlEdit = 'disabled';
    }
//    $ambilIdTelp = new telp();
//    $ambilIdTelp->setIdMember($hasil[0]);
//    $arrayNoTelp = $ambilIdTelp->getTelpbyMember();
    $prioritas = new prioritasmember();
    $prioritas->setIdPrioritasMember($hasil[1]);
    $prioritas->setPrioritasMemberRow();

    $content = $content . '
        <tr>
        <td><a href="/eprocurement/admin/member/view/'.$hasil[0].'">' . $hasil[0] . '</a></td>
        <td><a href="/eprocurement/admin/member/view/'.$hasil[0].'">' . $prioritas->getPrioritasMember() . '</a></td>
        <td><a href="/eprocurement/admin/member/view/'.$hasil[0].'">' . $hasil[2] . '</a></td>
        <td><a href="/eprocurement/admin/member/view/'.$hasil[0].'">' . $hasil[3] . '</a></td>';
//        <td>' . $hasil[6] . '</td>
//        <td>' . $hasil[7] . '</td>
//        <td>' . $urlCV . '</td>
//        <td>' . $hasil[9] . '</td>
//        <td>' . $hasil[10] . '</td>
//       <td>' . $hasil[12] . '</td>
//        <td>';
//    foreach ($arrayNoTelp as $idTelp) {
//        $noTelp = new telp();
//        $noTelp->setIdTelp($idTelp[0]);
//        $noTelp->setTelpRow();
//        $content.= $noTelp->getNoTelp() . '<br />';
//    }
//    $content.='
//        </td>
    $content.='
        <td><a ' . $urlEdit . ' class="btn btn-success">
        <span class="glyphicon glyphicon-wrench"></span> Edit</a></td>
        </tr>';
    $i++;
}
$content = $content . '
            </table>
                <ul id="paging"></ul>
            </div>
        </div></div>';
print_r($content);
?>