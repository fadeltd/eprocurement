<?php

global $idMember;
$member = new member();
$member->setIdMember($idMember);
$dataMember = $member->getMemberRow();
$telp = new telp();
$telp->setIdMember($idMember);
$dataTelp = $telp->getTelpbyMember();
$prioritas = new prioritasmember();
$prioritas->setIdPrioritasMember($dataMember["idPrioritas"]);
$prioritas->setPrioritasMemberRow();

$url = '/eprocurement/edit-profil/';

$content = '<div class="col-lg-10">
                <center><h2>Informasi Member</h2></center>
                <center><table class="table-condensed" width="60%">
                <tr>
                    <td>ID Member</td>
                    <td>' . $dataMember["idMember"] . '</td>
                </tr>
                <tr>
                    <td>Prioritas</td>
                    <td>' . $prioritas->getPrioritasMember() . '</td>
                </tr>
                <tr>
                    <td>Username Member</td>
                    <td>' . $dataMember["username"] . '</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>' . $dataMember["email"] . '</td>
                </tr>
                <tr>
                    <td>Agency</td>
                    <td>' . $dataMember["agency"] . '</td>
                </tr>';
if (!($prioritas->getPrioritasMember() == 'admin')) {
    $url = '/eprocurement/admin/edit-member/'.$idMember;
    $content.=' <tr>
                    <td>Alamat</td>
                    <td>' . $dataMember["alamat"] . '</td>
                </tr>
                <tr>
                    <td>Tanggal Daftar</td>
                    <td>' . $dataMember["tanggalDaftar"] . '</td>
                </tr>
                <tr>
                    <td>CV</td>
                    <td><a class="btn btn-success" href="/eprocurement/assets/docs/cv/' . $dataMember["cv"] . '"><span class="glyphicon glyphicon-download"></span> Download</a></td>
                </tr>
                <tr>
                    <td>NPWP</td>
                    <td>' . $dataMember["npwp"] . '</td>
                </tr>
                <tr>
                    <td>Fax</td>
                    <td>' . $dataMember["fax"] . '</td>
                </tr>';

    /* $content.='     <tr>
      <td>Aktivasi</td>
      <td>' . $dataMember["aktivasi"] . '</td>
      </tr>
      <tr>
      <td>Blacklist</td>
      <td>' . $dataMember["blacklist"] . '</td>
      </tr>
      <tr>
      <td>Alasan Blacklist</td>
      <td>' . $dataMember["alasanBlacklist"] . '</td>
      </tr>
     */
    $content.='     <tr>
                    <td rowspan = "' . (sizeOf($dataTelp) + 1) . '">No Telp</td>
                </tr>';
    foreach ($dataTelp as $hasil) {
        $content .= '<tr><td>' . $hasil["noTelp"] . '</td></tr>';
    }
}
$content .= '</td>
            </table></center></div>';
if ($_SESSION["user"]["admin"] == 1) {
    $content = $content . '<div align="center"><a href="'.$url.'" class="btn btn-default">
                <span class="glyphicon glyphicon-wrench"></span> Edit</a>
                <a class="btn btn-danger" onClick="javascript:history.go(-1);">Cancel </a></div>';
}

print_r($content);
?>