<?php

function get_handler() {
    //mengambil url dan memisahkan berdasarkan '/' untuk memecah mecah menu
    if (isset($_GET['q']))
        $query = (array) explode('/', strtolower($_GET['q']));
    else
        $query = array('');
    //menu jika user login
    if (isLoggedIn()) {
        switch (strtolower($query[0])) {
            case '':index();
                break;
            case 'logout':
                logout();
                header('location:/eprocurement/');
                break;
            case 'home':index();
                break;
            case 'admin':admin($query);
                break;
            case 'lelang':lelang($query);
                break;
            case 'edit-profil':edit_profil();
                break;
            case 'mengikuti':mengikuti();
                break;
            case 'page':page($query);
                break;
            case 'tiket':tiket($query);
                break;
            case 'tanggapi':tanggapi($query);
                break;
            case 'verify':verify($query);
                break;
            case 'ikut-lelang':
                $harga = $_GET['harga'];
                $idLelang = $_GET['idLelang'];
                form_harga($harga, $idLelang);
                break;
            case 'ajaxfitur':
                $cek = $_GET['cek'];
                $idFitur = $_GET['idFitur'];
                ajax_fitur($cek, $idFitur);
                break;
            //case 'content':content($query);
            //    break;
            default:
                error($query);
                break;
        }
    }
    //menu jika user belum login menu login dan menu register 
    else {
        switch (strtolower($query[0])) {
            case '':index();
                break;
            case 'daftar':halaman_daftar();
                break;
            case 'pagenotfound':pagenotfound();
                break;
            case 'page':page($query);
                break;
            case 'tiket':tiket($query);
                break;
            case 'verify':verify($query);
                break;
            case 'cekpass':
                $input = $_GET['input']; //menangkap password yang diinput oleh user
                $cek = $_GET['password']; //menangkap nilai apakah untuk input password atau konfirmasi
                $pass = $_GET['pass']; //menangkap nilai dari form password yang diisi
                cekpass($input, $cek, $pass);
                break;
            case 'cekemail':
                $email = $_GET['email']; //menangkap password yang diinput oleh user
                cekemail($email);
                break;
            case 'cekusername':
                $username = $_GET['username']; //menangkap password yang diinput oleh user
                cekusername($username);
                break;
            //case 'content':content($query);
            //    break;
            default:error($query);
                break;
        }
    }
}

function error($query) {
    global $message, $success;
    $success = false;
    if ($query[0] == 'admin') {
        $message = 'Anda tidak memiliki akses untuk membuka halaman Ini';
        include_once('assets/navbar.php');
        include_once('assets/alert.php');
        include_once('assets/content.php');
        include_once('assets/footer.php');
    } else if ($query == 'login') {
        $message = 'Password/Username Anda Salah';
        include_once('assets/alert.php');
    } else if ($query == 'aktivasi') {
        $message = 'akun Anda belum di verifikasi,
            silakan cek kembali email Anda dan cek verifikasi pada link yang terdapat pada email Anda';
        include_once('assets/alert.php');
    } else if ($query == 'regfail') {
        $message = 'maaf username atau email anda telah terdaftar, silakan gunakan username atau email lain';
        include_once('assets/alert.php');
    } else if ($query == 'regsuccess') {
        $success = true;
        $message = 'registrasi berhasil, silakan cek email Anda untuk melakukan aktivasi';
        include_once('assets/alert.php');
    } else if ($query == 'fitur') {
        $message = 'Anda harus memasukkan Angka pada nilai fitur';
        include_once('assets/alert.php');
    } else if ($query == 'sql') {
        $message = 'SQL Injection gagal';
        include_once('assets/alert.php');
    } else {
        header('location:/eprocurement/pagenotfound');
    }
}

function pagenotfound() {
    include_once('assets/navbar.php');
    include_once('assets/pagenotfound.php');
    include_once('assets/footer.php');
}

function halaman_daftar() {
    include_once('assets/daftar.php');
}

function logout() {
    if (isset($_SESSION["user"])) {
        unset($_SESSION["user"]);
    }
    //if(array_key_exists('USER_AUTH', $_COOKIE))setcookie('USER_AUTH', '', time() - 3600, '/');
}

function lelang($query) {
    global $idLelang, $action;
    $action = $query[1];
    include_once('assets/navbar.php');
    include_once('assets/leftNavigation.php');
    if(is_numeric($query[2])){
    $idLelang = $query[2];
        include_once('assets/tampilLelang.php');
    }else{
        error('sql');
    }
    include_once('assets/footer.php');
}

function edit_profil() {
    include_once('assets/navbar.php');
    include_once('assets/leftNavigation.php');
    include_once('assets/formEditProfil.php');
    include_once('assets/footer.php');
}

function page($query) {
    if (isset($query[1])) {
        global $url;
        $url = $query[1];
        include_once "assets/navbar.php";
        /*        switch ($query[1]) {
          case 'tentang-kami':
          include_once('assets/tentang.php');
          break;
          case 'contact-us':
          include_once('assets/kontakKami.php');
          break;
          case 'bantuan':
          include_once('assets/help.php');
          break;
          case 'privacy-policy':
          include_once('assets/privacypolicy.php');
          break;
          default:
          pagenotfound();
          break;
          }
         */
        include_once "assets/page.php";
        include_once "assets/footer.php";
    } else {
        pagenotfound();
    }
}

function admin($query) {
    if ($_SESSION["user"]["admin"] == 1) {
        global $idLelang, $idPesertaLelang, $idMember, $aksi, $url;
        if (isset($query[1])) {
            switch ($query[1]) {
                case 'buka-lelang':
                    include_once "assets/navbar.php";
                    include_once "assets/leftNavigation.php";
                    include_once "assets/formBukaLelang.php";
                    include_once "assets/footer.php";
                    break;
                //Menangani /eprocurement/admin/pilih-pemenang/lelang/1/peserta/2/
                case 'pilih-pemenang':
                    if(isset($query[3]) && is_numeric($query[3]) && isset($query[5]) && is_numeric($query[5])){
                        $idLelang = $query[3];
                        $idPesertaLelang = $query[5];
                        include_once('assets/pilihPemenang.php');
                    }else{
                        error('sql');
                    }
                    break;
                //Menangani /eprocurement/admin/ganti-tahap/
                case 'ganti-tahap':
                    include_once "assets/navbar.php";
                    include_once "assets/leftNavigation.php";
                    if(isset($query[2]) && is_numeric($query[2])){
                        $idLelang = $query[2];
                        include_once "assets/formGantiTahap.php";
                    }else{
                        error('sql');
                    }
                    include_once "assets/footer.php";
                    break;
                /*
                 * Menangani /eprocurement/admin/tambah/fitur/
                 * ataupun /eprocurement/admin/tambah/kualifikasi/
                 */
                case 'tambah':
                    if (isset($query[2]) && isset($query[3])) {
                        $aksi = $query[2];
                        $idLelang = $query[3];
                        include_once "assets/navbar.php";
                        include_once "assets/leftNavigation.php";
                        include_once "assets/formTambah.php";
                        include_once "assets/footer.php";
                    } else {
                        error($query);
                    }
                    break;
                case 'tambah-member':
                    include_once "assets/navbar.php";
                    include_once "assets/leftNavigation.php";
                    include_once "assets/formTambahMember.php";
                    include_once "assets/footer.php";
                    break;
                case 'edit-member':
                    include_once "assets/navbar.php";
                    include_once "assets/leftNavigation.php";
                    if (isset($query[2]) && is_numeric($query[2])) {
                        $aksi = $query[1];
                        $idMember = $query[2];
                        include_once "assets/formEditProfil.php";
                    } else {
                        error('sql');
                    }
                    include_once "assets/footer.php";
                    break;
                case 'pesan':
                    $url = $query[1];
                    include_once "assets/navbar.php";
                    include_once "assets/leftNavigation.php";
                    include_once "assets/daftarPesan.php";
                    include_once "assets/footer.php";
                    break;
                case 'tanggapi':
                    tanggapi($query);
                    break;
                case 'member':
                    member($query);
                    break;
                case 'form-member':form_member();
                    break;
                case 'cekpass':
                $input = $_GET['input']; //menangkap password yang diinput oleh user
                $cek = $_GET['password']; //menangkap nilai apakah untuk input password atau konfirmasi
                $pass = $_GET['pass']; //menangkap nilai dari form password yang diisi
                cekpass($input, $cek, $pass);
                break;
            case 'cekemail':
                $email = $_GET['email']; //menangkap email yang diinput oleh user
                cekemail($email);
                break;
            case 'cekusername':
                $username = $_GET['username']; //menangkap username yang diinput oleh user
                cekusername($username);
                break;
            case 'cekharga':
                $input = $_GET['input']; //menangkap password yang diinput oleh user
                $cek = $_GET['harga']; //menangkap nilai apakah untuk input password atau konfirmasi
                $hargaMin = $_GET['hargaMin']; //menangkap nilai dari form password yang diisi
                cekharga($input,$cek,$hargaMin);
                break;
            }
        } else {
            index();
        }
    } else {
        error($query);
    }
}

function mengikuti() {
    include_once "assets/navbar.php";
    include_once "assets/leftNavigation.php";
    include_once "assets/daftarMengikuti.php";
    include_once "assets/footer.php";
}

function member($query) {
    global $pageID, $idMember;
    include_once "assets/navbar.php";
    include_once "assets/leftNavigation.php";
    switch ($query[2]) {
        case 'semua':
            if (isset($query[3])) {
                $pageID = $query[3];
            } else {
                $pageID = 1;
            }
            include_once "assets/daftarMember.php";
            break;
        case 'view':
            if (isset($query[3]) && is_numeric($query[3])) {
                $idMember = $query[3];
                include_once "assets/tampilMember.php";
            }else{
                error('sql');
            }
            break;
    }
    include_once "assets/footer.php";
}

function tanggapi($query) {
    include_once "assets/navbar.php";
    include_once "assets/leftNavigation.php";
    if (isset($query[2]) && is_numeric($query[2])) {
        global $idPesan;
        $idPesan = $query[2];
        include_once "assets/tampilPesan.php";
    } else {
        error('sql');
    }
    include_once "assets/footer.php";
}

function tiket($query) {
    if (isset($query[1])) {
        switch ($query[1]) {
            case '':
                error($query);
            case 'cek':
                if (isset($query[2])) {
                    global $kodeTiket;
                    $kodeTiket = $query[2];
                    include_once "assets/navbar.php";
                    include_once "assets/tampilPesan.php";
                    include_once "assets/footer.php";
                } else {
                    global $url;
                    $url = $query[1];
                    include_once "assets/navbar.php";
                    include_once "assets/formTicket.php";
                    include_once "assets/footer.php";
                }
                break;
            default:
                break;
        }
    } else {
        error($query);
    }
}

function verify($query) {
    global $token, $idMember, $found;
    $token = $query[1];
    $member = new member();
    $dataMember = $member->getMemberAll();
    $found = false;
    foreach ($dataMember as $data) {
        if ($token == md5($data["idMember"])) {
            $idMember = $data["idMember"];
            $found = true;
            $aktivasi = new member();
            $aktivasi->setIdMember($idMember);
            $aktivasi->updateAktivasi();
            break;
        }
    }
    include_once "assets/navbar.php";
    include_once "assets/verifikasimember.php";
    include_once "assets/footer.php";
}

function cekharga($input, $cek, $hargaMin) {
    if ($cek == 1) {
        if (!is_numeric($input)) {
            echo "<div class=\"alert alert-danger\"><span class=\"glyphicon glyphicon-remove\"></span> Input salah, Harga Min harus berupa Angka</div>";
        }else{
            echo "<div class=\"alert alert-success\"><span class=\"glyphicon glyphicon-ok\"></span> Harga diizinkan</div>";
        }
    } else if ($cek == 2) { //untuk melakukan pengecekan konfirmasi password
        if (!is_numeric($input)) {
            echo "<div class=\"alert alert-danger\"><span class=\"glyphicon glyphicon-remove\"></span> Input salah, Harga Max harus berupa Angka</div>";
        }else if ( $hargaMin < $input) {
            echo "<div class=\"alert alert-success\"><span class=\"glyphicon glyphicon-ok\"></span> Harga Max lebih dari Harga Min</div>";
        } else {
            echo "<div class=\"alert alert-danger\"><span class=\"glyphicon glyphicon-remove\"></span> Harga Max kurang dari Harga Min</div>";
        }
    }
}

function cekemail($email) {
    if (strlen($email) == 1) {
        echo "";
    } else {
        $at = strpos($email, "@");
        $dot = strpos ($email, ".");
        if ($at < 1 || $dot < $at + 2 || $dot + 2 >= strlen($email)) {
            echo "<div class=\"alert alert-warning\"><span class=\"glyphicon glyphicon-info-sign\"></span> Email tidak valid</div>";
        } else {
            $member = new member();
            $member->setEmail($email);
            $dataMember = $member->getMemberbyEmail();
            if (!isset($dataMember["email"])) {
                echo "<div class=\"alert alert-success\"><span class=\"glyphicon glyphicon-ok\"></span> Email Tersedia</div>";
            } else {
                echo "<div class=\"alert alert-danger\"><span class=\"glyphicon glyphicon-info-sign\"></span> Email ini telah terdaftar dengan username: <b>" . $dataMember["username"] . "</b> pada <b>" . $dataMember["tanggalDaftar"] . "</b></div>";
            }
        }
    }
}

function cekusername($username) {
    if (strlen($username) == 1) {
        echo "";
    } else if (strlen($username) < 6) {
        echo "<div class=\"alert alert-warning\"><span class=\"glyphicon glyphicon-info-sign\"></span> Username kurang dari 6 karakter</div>";
    } else {
        $member = new member();
        $member->setUsername($username);
        $dataMember = $member->getMemberbyUsername();
        if (!isset($dataMember["username"])) {
            echo "<div class=\"alert alert-success\"><span class=\"glyphicon glyphicon-ok\"></span> Username Tersedia</div>";
        } else {
            echo "<div class=\"alert alert-danger\"><span class=\"glyphicon glyphicon-info-sign\"></span> Username ini telah terdaftar </div>";
        }
    }
}

function cekpass($input, $cek, $pass) {
    if ($cek == 1) { 
        if (strlen($input) == 1) {
            echo "";
        } else if (strlen($input) < 6) {
            echo "<div class=\"alert alert-danger\"><span class=\"glyphicon glyphicon-info-sign\"></span> Password kurang dari 6 karakter</div>";
        }  else if (strlen($input) > 5 && preg_match("/[[:alnum:]-@. ]+[[:punct:]-@. ]/", stripslashes(trim($input)))) {
            echo "<div class=\"alert alert-success\"><span class=\"glyphicon glyphicon-thumbs-up\"></span> Password Kuat</div>";
        } else if (strlen($input) > 5 && (preg_match("/^[_a-zA-Z- ]+$/", stripslashes(trim($input))) || preg_match("/^[_0-9- ]+$/", stripslashes(trim($input)))))  {
            echo "<div class=\"alert alert-warning\"><span class=\"glyphicon glyphicon-thumbs-down\"></span> Password Lemah</div>";
        } else if (strlen($input) > 5 && (preg_match("/^[_a-zA-Z0-9- ]+$/", stripslashes(trim($input))))) {
            echo "<div class=\"alert alert-info\"><span class=\"glyphicon glyphicon-ok\"></span> Password Sedang</div>";
        } 
    } else if ($cek == 2) { //untuk melakukan pengecekan konfirmasi password
        if (strlen($input) == 1) {
            echo "";
        } else if (strlen($input) > 5 && ($pass == $input)) {
            echo "<div class=\"alert alert-success\"><span class=\"glyphicon glyphicon-ok\"></span> Password sama</div>";
        } else {
            echo "<div class=\"alert alert-danger\"><span class=\"glyphicon glyphicon-remove\"></span> Password tidak sama</div>";
        }
    }
}

function form_harga($harga, $idLelang){
    $lelang = new lelang();
    $lelang->setIdLelang($idLelang);
    $dataLelang = $lelang->getLelangRow();
    if (!is_numeric($harga)) {
        echo "<div class=\"alert alert-danger\"><span class=\"glyphicon glyphicon-remove\"></span> Input Anda salah, silakan masukkan angka</div>";
    }else if ($harga < $dataLelang["hargaMin"]) {
        echo "<div class=\"alert alert-danger\"><span class=\"glyphicon glyphicon-remove\"></span> Harga kurang dari harga minimum</div>";
    }  else if ($harga > $dataLelang["hargaMax"]) {
        echo "<div class=\"alert alert-danger\"><span class=\"glyphicon glyphicon-remove\"></span> Harga lebih dari harga maksimum</div>";
    } else {
        echo "<div class=\"alert alert-success\"><span class=\"glyphicon glyphicon-ok\"></span> Harga diizinkan</div>";
    }
}

function form_member(){
    $idPrioritas = $_GET["idPrioritas"];
    if ($idPrioritas == "1") {
        print_r('');
    } else {
        print_r('
         <div class="form-group">
            <label for="alamat" class="col-sm-4 control-label">Alamat Perusahaan</label>
            <div class="col-lg-4">
                <textarea class="form-control" rows="3" id="alamat" name="alamat" placeholder="Alamat Perusahaan" required></textarea>
            </div>
            <h6 style="text-align:left">*Tuliskan dengan jelas</h6>
         </div>
         <div class="form-group">
            <label for="faxPer" class="col-sm-4 control-label">Faximile</label>
            <div class="col-lg-4">
                <input type="text" class="form-control" id="fax" name="fax" required placeholder="Faximile">
            </div>
         <h6 style="text-align:left">*Wajib Diisi</h6>
         </div>
         <div class="form-group">
            <label for="npwp" class="col-sm-4 control-label">NPWP</label>
            <div class="col-lg-4">
                <input pattern=".{15,25}" type="text" class="form-control" id="npwp"  name="npwp" required placeholder="NPWP">
            </div>
            <h6 style="text-align:left">*Masukkan nomor NPWP Saudara (beserta titik dan tanda [-] ) tanpa spasi</h6>
         </div>
         <div class="form-group">
            <label for="telp" class="col-sm-4 control-label" >Nomor Telepon</label>
                <div class="col-lg-4">
                    <input type="text" pattern="[0-9]{5,12}" class="form-control" id="telp" name="telp" required placeholder="Telepon">
                </div>
                <h6 style="text-align:left">*Wajib diisi</h6>
             </div>
         <div class="form-group">
            <label for="cv" class="col-sm-4 control-label" >CV Perusahaan</label>
            <div class="col-lg-4">
                <input type="file" name="cv" type="file" accept="application/msword,application/x-zip-compressed,application/pdf" required>
            </div>
            <h6 style="text-align:left">*Wajib Diisi (Berupa file zip/doc/pdf</h6>
         </div>
         <div class="form-group">
            <label for="avatar" class="col-sm-4 control-label" >Logo Perusahaan</label>
            <div class="col-lg-4">
                <input type="file" name="avatar" type="file" accept="image/jpeg,images/png">
            </div>
            <h6 style="text-align:left">*Tidak Wajib</h6>
         </div>');
    }
}

function ajax_fitur($cek, $idFitur){
    $fitur = new fitur();
    $fitur->setIdFitur($idFitur);
    $hasil = $fitur->getFiturRow(); 
    if($cek == 'true'){   
    print_r('<div class="col-sm-5">
                <input type="text" name="keterangan[]" class="form-control" placeholder="' . $hasil["keterangan"]  . '" required>
             </div>');
    }else{
        print_r('<div class="col-sm-5">
                    <input type="text" name="keterangan[]" class="form-control" value="0" placeholder="' . $hasil["keterangan"]  . '" readonly>
                </div>');
    }
}

function index() {
    include_once "assets/navbar.php";
    include_once "assets/leftNavigation.php";
    include_once "assets/content.php";
    //di dalam content sudah di set, klo dia sdh login maka nampilin daftarLelang juga
    //non ajax
    //include_once "assets/daftarLelang.php";
    //ajax
    //include_once "assets/paginatorAjax.php";
    include_once "assets/footer.php";
}

function isLoggedIn() {
    //jika ada cookie pada browser masukan data cookie tersebut kedalam session
    return isset($_SESSION['user']) ? true : false;
}

?>