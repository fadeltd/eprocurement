<?php

$content = '';
if(isset($_GET["kodeTiket"])){
    $content = '
        <div class="alert alert-success">Kode Tiket Anda adalah, <strong>'.$_GET["kodeTiket"].'</strong> silakan mengecek kembali halaman ini setelah beberapa waktu, Admin butuh waktu untuk menjawab.
        <br /><strong>Mohon jangan sampai kehilangan kode tiket ini. </strong>
        </div>';
}
?>

<br /><br /><br />
<div class="container">
    <!-- Three columns of text below the carousel -->
    <div class="row">
        <center>
            <h2>Form Ticket</h2>
            <h3 class="page-header" id="nav">Masukkan Kode Tiket Anda</h3>
            <p>Setelah Anda mengirimkan Ticket, Anda menerima kode ticket, masukkan ke sini untuk melihat tanggapan Admin.</p>
            <form action="" method="post">
                <input type="hidden" name="action" value="cektiket">
                <table class="table-hover" width="80%">
                    <!--tr>
                        <td>Email</td>
                        <td><input type="email" name="email" class="form-control" required placeholder="Email"></td>
                    </tr-->
                    <tr>
                        <td>Kode Tiket</td>
                        <td><input type="text" name="tiket" class="form-control" required placeholder="Kode Ticket"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><center><button name="submit" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span> Kirim</button></center></td>
                    </tr>
                </table>
            </form>
            <?php 
            echo $content;
            ?>
        </center>
    </div>