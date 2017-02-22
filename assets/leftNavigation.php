<?php
if (isset($_SESSION["user"])){
    if ($_SESSION["user"]["admin"] == 1) {
        print_r('
            <br /><br /><br />
      <div class="container marketting">
      <div class="row">
      <div class="col-xs-2">
      	<center><img class="img-circle" data-src="holder.js/140x140" alt="140x140" style="width: 140px; height: 140px;" src="/eprocurement/assets/images/member/'.$_SESSION["user"]["avatar"].'"></center>
          <center><h4>Halo, ' . $_SESSION["user"]["username"]. '!</h4></center>
          <hr class="featurette-divider">
          <center><h5>Menu Navigasi</h5></center>
		  <a href="/eprocurement/admin/member/semua/"><span class="glyphicon glyphicon-wrench"></span> Kelola Semua Akun</a></i><br>
          <a href="/eprocurement/admin/tambah-member"><span class="glyphicon glyphicon-plus-sign"></span> Tambah akun</a><br>
          <a href="/eprocurement/edit-profil"><span class="glyphicon glyphicon-pencil"></span> Kelola Akun Pribadi</a><br>
          <a href="/eprocurement/logout"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></i>
          <hr class="featurette-divider">
          <center><h5>Menu Pengiklan</h5></center>
          <a href="/eprocurement/admin/buka-lelang"><span class="glyphicon glyphicon-hand-up"></span> Buka Lelang</a><br>
          <a href="/eprocurement/"><span class="glyphicon glyphicon-list-alt"></span> Lihat Daftar</a><br>
          <a href="/eprocurement/"><span class="glyphicon glyphicon-gift"></span> Pilih Pemenang</a><br>
        </div>');
    } else {
        print_r('
            <br /><br /><br /><br />
      <div class="container marketing">
      <div class="row">
      <div class="col-xs-2">
      	<center><img class="img-circle" data-src="holder.js/140x140" alt="140x140" style="width: 140px; height: 140px;" src="/eprocurement/assets/images/member/'.$_SESSION["user"]["avatar"].'"></center>
          <center><h4>Selamat datang, <br />'.$_SESSION["user"]["username"].'!</h4></center>
          <hr class="featurette-divider">
          <center><h5>Menu Navigasi</h5></center>
          <a href="/eprocurement/edit-profil"><span class="glyphicon glyphicon-pencil"></span> Edit Profile</a><br>
          <a href="/eprocurement/logout"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></i>
          <hr class="featurette-divider">
          <center><h5>Menu Pengiklan</h5></center>
          <a href="/eprocurement/mengikuti/"><span class="glyphicon glyphicon-share-alt"></span> Lelang diikuti</a><br>
          <a href="/eprocurement/home/"><span class="glyphicon glyphicon-list-alt"></span> Lihat Daftar Lelang</a><br>
        </div>');
    }
}
?>