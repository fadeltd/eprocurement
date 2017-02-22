<?php

function post_handler() {
    if (isset($_POST['submit'])) {
        $action = isset($_POST['action']) ? strtolower($_POST['action']) : false;
        if ($action) {
            switch ($action) {
                case 'batal-ikut-lelang':batal_ikut_lelang(); // g ada
                    break;
                case 'batal-lelang':batal_lelang(); // g ada
                    break; //admin
                case 'buka-lelang':buka_lelang();
                    break; //admin
                case 'ganti-tahap':ganti_tahap();
                    break; //admin
                case 'tambah':tambah();
                    break; //admin
                case 'edit-member':edit_member();
                    break;
                case 'edit-admin':edit_admin();
                    break;
                case 'edit-lelang':edit_lelang();
                    break;
                case 'ikut-lelang':ikut_lelang();
                    break;
                case 'login':login();
                    break;
                case 'pilih-pemenang':pilih_pemenang();
                    break; //admin
                case 'register':register();
                    break;
                case 'tambah-member':tambah_member();
                    break; //admin
                case 'kontak':contact();
                    break;
                case 'tanggapi':tanggap();
                    break;
                case 'cektiket':cekTiket();
                    break;
//		case 'blacklist-member':blacklist();break;
                default:break;
            }
        }
    }
}

function login() {
    $member = new member();
    $login = $member->login($_POST['username'], md5($_POST['password']));
    if ($login['loginSuccess'] == 1) {
        $_SESSION['user'] = array('userid' => $login['idMember'], 'username' => $_POST['username'], 'admin' => $login['admin'], 'avatar' => $login['avatar']);
        header('location:' . $_SERVER['HTTP_REFERER']);
    } else {
        if ($login['aktivasi'] == 0) {
            error('aktivasi');
        } else {
            error('login');
        }
    }
}

function get_dateNow() {
    $timezone = "Asia/Jakarta";
    if (function_exists('date_default_timezone_set'))
        date_default_timezone_set($timezone);
    $date = date('Y-m-d H:i:s');
    return $date;
}

function register() {
    if ($_POST["validation"]) {
        $idPrioritas = 2;
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $agency = $_POST['agency'];
        $alamat = $_POST['alamat'];
        $fax = $_POST['fax'];
        $date = get_dateNow();
        $aktivasi = 0;
        $npwp = $_POST['npwp'];
        if (($_FILES['cv']['tmp_name']) && $_FILES['cv'] != '' && isset($_FILES['cv']) && !empty($_FILES['cv'])) {
            $cv = stripslashes(upload_cv($_FILES['cv']));
        } else {
            $cv = '';
        }
        if (($_FILES['avatar']['tmp_name']) && $_FILES['avatar'] != '' && isset($_FILES['avatar']) && !empty($_FILES['avatar'])) {
            $avatar = stripslashes(upload_avatar($_FILES['avatar']));
        } else {
            $avatar = 'member.jpg';
        }
        $member = new member();
        if (!$member->cekAda($_POST['username'], $_POST['email'])) {
            $idMember = $member->tambahMember($idPrioritas, $username, $email, $password, $avatar, $agency, $alamat, $cv, $fax, $date, $aktivasi, $npwp);
            $telp = new telp();
            $telp->tambahTelp($idMember, $_POST["telp"]);
            /* if (isset($_POST['counterFitur'])) {
              for ($i = 1; $i <= $_POST['counterFitur']; $i++) {
              if (isset($_POST["fitur$i"])) {
              $telp->tambahTelp($idMember, $_POST["fitur$i"]);
              }
              }
              } */
            $kirimEmail = new email();
            $kirimEmail->sendEmailAktivasi($idMember);
            error('regsuccess');
        } else {
            error('regfail');
        }
    } else {
        error('regfail');
    }
}

function tambah_member() {
    $idPrioritas = $_POST['idPrioritas'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $agency = $_POST['agency'];
    $date = get_dateNow();
    $aktivasi = 0;
    $member = new member();
    if ($idPrioritas == 1) {
        $member->tambahMemberAdmin($idPrioritas, $username, $email, $password, $agency);
        header('location:/eprocurement/admin');
    } else {
        $fax = $_POST['fax'];
        $npwp = $_POST['npwp'];
        if (($_FILES['cv']['tmp_name']) && $_FILES['cv'] != '' && isset($_FILES['cv']) && !empty($_FILES['cv'])) {
            $cv = stripslashes(upload_cv($_FILES['cv']));
        } else {
            $cv = '';
        }
        if (!$member->cekAda($_POST['username'], $_POST['email'])) {
            $idMember = $member->tambahMember($idPrioritas, $username, $email, $password, $agency, $cv, $fax, $date, $aktivasi, $npwp);
            $telp = new telp();
            //$telp = $_POST['telp'];
            $telp->tambahTelp($idMember, $_POST["telp"]);
            /*
              if (isset($_POST['counterFitur'])) {
              for ($i = 1; $i <= $_POST["counterFitur"]; $i++) {
              if (isset($_POST["fitur$i"])) {
              $telp->tambahTelp($idMember, $_POST["fitur$i"]);
              }
              }
              } */
            header('location:/eprocurement/');
        } else {
            echo "Maaf Username atau Email anda telah terdaftar";
        }
    }
}

function pilih_pemenang() {
    $email = new email();
    $kualifikasi = NULL;
    if (isset($_POST["kualifikasi"])) {
        $kualifikasi = 1;
    }
    $pesertalelang = new pesertaLelang();
    $pesertalelang->setIdPesertaLelang($_POST["idPesertaLelang"]);
    $pesertalelang->setPesertaLelangRow();
    $lelang = new lelang();
    $lelang->setIdLelang($_POST["idLelang"]);
    $lelang->updateLelangbyAdmin($pesertalelang->getIdMember());
    $lelang->setLelangRow();
    $idTahap = $lelang->getIdTahap();
    for ($i = $idTahap; $i <= $idTahap + 4; $i++) {
        if ($idTahap % 4 == 0) {
            break;
        } else {
            $idTahap++;
        }
    }
    $lelang->updateLelangTahapbyAdmin($idTahap);
    $pesertalelang->updatePesertaLelangbyAdmin($kualifikasi, $_POST["hargaFix"], $_POST["alasan"]);
    //$member->pilihPemenang($_POST["idLelang"], $_POST["idPesertaLelang"], $kualifikasi, $_POST["hargaFix"], $_POST["alasan"]);
    $emailStatus = $email->sendEmailPemenang($_POST["idLelang"], $pesertalelang->getIdMember(), get_dateNow());
    echo $emailStatus;
    header('location:/eprocurement/');
}

function ikut_lelang() {
    //$member = new member();
    $lelang = new lelang($_POST["idLelang"]);
    $data = $lelang->tampilLelang($_POST["idLelang"]);
    $harga = $data["hargaMax"];
    $countFitur = 0;
    $rating = 1;
    if (isset($_POST['fitur']) && isset($_POST['keterangan'])) {
        $cek = true;
        foreach ($_POST['keterangan'] as $keterangan) {
            if (!is_numeric($keterangan)) {
                $cek = false;
            }
        }
        if ($cek) {
            foreach ($_POST['fitur'] as $value) {
                $fitur = new fitur();
                $fitur->setIdFitur($value);
                $fitur->setFiturRow();
                $wp[$countFitur] = array($fitur->getBobot(), $fitur->getIndeks());
                $countFitur++;
            }
            for ($i = 0; $i < sizeof($wp); $i++) {
                $jumlah = 0;
                for ($j = 0; $j < sizeOf($wp); $j++) {
                    $jumlah += $wp[$j][0];
                }
                $w[$i] = $wp[$i][0] / $jumlah;
            }
            $count = 0;
            $item[$count++] = $harga;
            foreach ($_POST['keterangan'] as $keterangan) {
                $item[$count++] = $keterangan;
            }
            $counterw = 0;
            for ($i = 0; $i < sizeOf($wp); $i++) {
                if ($wp[$i][1]) {
                    $rating *= pow($item[$i], $w[$counterw]);
                } else {
                    $rating *= pow($item[$i], -$w[$counterw]);
                }
                $counterw++;
            }
        } else {
            error('fitur');
        }
    }
    /*if (!($harga - $_POST["hargaPenawaran"] == 0)) {
        $rating = (($harga - $_POST["hargaPenawaran"]) / $harga) * 10;
    }
    if (isset($_POST['fitur'])) {
        foreach ($_POST['fitur'] as $value) {
            $countFitur++;
        }
    }
    $rating+=$countFitur;
    */
    $pesertalelang = new pesertalelang();
    if (isset($_POST["do"])) {
        if ($_POST["do"] == 'ikut') {
            $pesertalelang->tambahPesertaLelang($_POST["idLelang"], $_SESSION["user"]["userid"], $countFitur, $rating, $_POST["hargaPenawaran"]);
            //$member->ikutLelang($_POST["idLelang"], $_SESSION["user"]["userid"], $countFitur, $rating, $_POST["hargaPenawaran"]);
        } else {
            $pesertalelang->setIdPesertaLelang($_POST["idPesertaLelang"]);
            $pesertalelang->updatePesertaLelang($_POST["idLelang"], $_SESSION["user"]["userid"], $countFitur, $rating, $_POST["hargaPenawaran"]);
            //$member->editIkutLelang($_POST["idLelang"], $_SESSION["user"]["userid"], $countFitur, $rating, $_POST["hargaPenawaran"], $_POST["idPesertaLelang"]);
        }
    }
    header('location:/eprocurement/lelang/peserta/' . $_POST["idLelang"]);
}

function buka_lelang() {
    //$member = new member();
    $lelang = new lelang();
    $namatahap = new namatahap();
    $tahap = new tahap();
    //$fitur = new fitur();
    //$kualifikasi = new kualifikasi();
    if (isset($_POST['counterFitur']) && isset($_POST['counterKualifikasi'])) {
        $counterKualifikasi = $_POST['counterKualifikasi'];
        $counterFitur = $_POST['counterFitur'];
        $idLelang = $lelang->tambahLelang($_POST['idKategori'], $_SESSION['user']['userid'], $_POST['nama'], $_POST['hargaMin'], $_POST['hargaMax'], $_POST['tanggalPosting'], $_POST['tanggalDeadline'], $_POST['lokasi'], $_POST['SIUP']);
        $kualifikasi = new kualifikasi();
        $kualifikasi->setIdLelang($idLelang);
        for ($i = 1; $i <= $counterKualifikasi; $i++) {
            if (isset($_POST["kualifikasi$i"])) {
                $kualifikasi->tambahKualifikasi($idLelang, $_POST["kualifikasi$i"]);
            }
        }
        $fitur = new fitur();
        $fitur->setIdLelang($idLelang);
        for ($i = 1; $i <= $counterFitur; $i++) {
            if (isset($_POST["fitur$i"]) && isset($_POST["bobot$i"]) && isset($_POST["indeks$i"]) && isset($_POST["keterangan$i"])) {
                $fitur->tambahFitur($idLelang, $_POST["fitur$i"], $_POST["bobot$i"], $_POST["indeks$i"], $_POST["keterangan$i"]);
            }
        }
        for ($i = 1; $i <= sizeof($namatahap->getNamaTahapAll()); $i++) {
            $tahap->tambahTahap($idLelang, $i, $_POST["tglMulai$i"], $_POST["tglSelesai$i"], 0);
        }
        $lelang = new lelang();
        $lelang->setIdLelang($idLelang);
        $tahap = new tahap();
        $idTahap = ((sizeof($tahap->getTahapAll()) - 4) + 1);
        $lelang->updateLelangTahapbyAdmin($idTahap);
    }
    header('location:/eprocurement/');
}

function ganti_tahap() {
    if (isset($_POST["idTahap"]) && isset($_POST["idLelang"])) {
        $lelang = new lelang();
        $lelang->setIdLelang($_POST["idLelang"]);
        $lelang->updateLelangTahapbyAdmin($_POST["idTahap"]);
        //$member = new member();
        //$member->editTahap($_POST["idTahap"], $_POST["idLelang"]);
        header('location:/eprocurement/admin');
    }
}

function tambah() {
    if (isset($_POST["do"])) {
        if ($_POST["do"] == 'kualifikasi' && isset($_POST['counterKualifikasi'])) {
            $kualifikasi = new kualifikasi();
            $kualifikasi->setIdLelang($_POST["idLelang"]);
            $jumlahKualifikasiLelang = sizeof($kualifikasi->getKualifikasibyLelang());
            if ($jumlahKualifikasiLelang < 10) {
                for ($i = 1; $i <= (10 - $jumlahKualifikasiLelang); $i++) {
                    if (isset($_POST["kualifikasi$i"])) {
                        $kualifikasi->tambahKualifikasi($_POST["idLelang"], $_POST["kualifikasi$i"]);
                    }
                }
            }
        } else if ($_POST["do"] == 'fitur' && isset($_POST['counterFitur'])) {
            $fitur = new fitur();
            $fitur->setIdLelang($_POST["idLelang"]);
            $jumlahFiturLelang = sizeof($fitur->getFiturbyLelang());
            if ($jumlahFiturLelang < 10) {
                for ($i = 1; $i <= (10 - $jumlahFiturLelang); $i++) {
                    if (isset($_POST["fitur$i"]) && isset($_POST["bobot$i"]) && isset($_POST["indeks$i"]) && isset($_POST["keterangan$i"])) {
                        $fitur->tambahFitur($_POST["idLelang"], $_POST["fitur$i"], $_POST["bobot$i"], $_POST["indeks$i"], $_POST["keterangan$i"]);
                    }
                }
            }
        }
        header('location:/eprocurement/lelang/view/' . $_POST["idLelang"]);
    }
}

function edit_member() {
    if (($_FILES['cv']['tmp_name']) && $_FILES['cv'] != '' && isset($_FILES['cv']) && !empty($_FILES['cv'])) {
        $cv = stripslashes(upload_cv($_FILES['cv']));
    } else {
        if (isset($_POST['currentcv'])) {
            $cv = $_POST['cv'];
        } else {
            $cv = NULL;
        }
    }

    if (($_FILES['avatar']['tmp_name']) && $_FILES['avatar'] != '' && isset($_FILES['avatar']) && !empty($_FILES['avatar'])) {
        $avatar = stripslashes(upload_avatar($_FILES['avatar']));
        if ($_POST['currentavatar'] != 'member.jpg') {
            unlink('assets/images/member/' . $_POST['currentavatar']);
        }
    } else {
        if (isset($_POST['currentavatar'])) {
            $avatar = $_POST['currentavatar'];
        } else {
            $avatar = 'member.jpg';
        }
    }

    if (isset($_POST["blacklist"]))
        $blacklist = 1;
    else
        $blacklist = NULL;

    $member = new member();
    $member->setIdMember($_POST["idMember"]);
    $member->updateMember($_POST["username"], $_POST["email"], md5($_POST["password"]), $_POST["agency"], $_POST["alamat"], $cv, $avatar, $_POST["fax"], $_POST["npwp"], $blacklist, $_POST["alasanBlacklist"]);
    //$member->editProfil($_POST["idMember"], $_POST["username"], $_POST["email"], md5($_POST["password"]), $_POST["agency"], $_POST["alamat"], $cv, $_POST["fax"], $_POST["npwp"], $_POST["alasanBlacklist"], $blacklist);
    if (isset($_POST["counterFitur"])) {
        $telp = new telp();
        $telp->setIdMember($_POST["idMember"]);
        for ($i = 1; $i <= $_POST["counterFitur"]; $i++) {
            if (isset($_POST["fitur$i"]) && $_POST["fitur$i"] != '') {
                $telp->tambahTelp($_POST["idMember"], $_POST["fitur$i"]);
            }
        }
    }
    if (isset($_SESSION["user"]["avatar"])) {
        unset($_SESSION["user"]["avatar"]);
    }

    $_SESSION['user']["avatar"] = $avatar;

    if ($_SESSION["user"]["admin"] == 1) {
        header('location:/eprocurement/admin/daftar-member');
    } else {
        header('location:/eprocurement/');
    }
}

function edit_admin() {
    if (($_FILES['avatar']['tmp_name']) && $_FILES['avatar'] != '' && isset($_FILES['avatar']) && !empty($_FILES['avatar'])) {
        $avatar = stripslashes(upload_avatar($_FILES['avatar']));
        if ($_POST['currentavatar'] != 'admin.jpg') {
            unlink('assets/images/member/' . $_POST['currentavatar']);
        }
    } else {
        if (isset($_POST['currentavatar'])) {
            $avatar = $_POST['currentavatar'];
        } else {
            $avatar = 'admin.jpg';
        }
    }

    $member = new member();
    $member->setIdMember($_SESSION["user"]["userid"]);
    $member->updateAdmin($_POST["email"], md5($_POST["password"]), $_POST["agency"], $avatar);
    //$member->editAdmin($_SESSION["user"]["userid"], $_POST["email"], md5($_POST["password"]), $_POST["agency"], $avatar);
    header('location:/eprocurement/');
}

function contact() {
    $pesan = new pesan();
    $kodeTiket = generateKey(10);
    $pesan->tambahPesan($_POST["username"], $_POST["email"], get_dateNow(), $_POST["judul"], $_POST["pesan"], $kodeTiket);
    $email = new email();
    $emailStatus = $email->sendEmailTiket($_POST["email"], $kodeTiket, $_POST["username"], get_dateNow());
    echo $emailStatus;
    header('location:/eprocurement/tiket/cek?kodeTiket=' . $kodeTiket);
}

function tanggap() {
    $email = new email();
    $pesan = new pesan();
    $pesan->setIdPesan($_POST["idPesan"]);
    $pesan->setPesanRow();
    $pesan->updateTanggapan($_POST["tanggapan"]);
    $email->sendEmailTanggap($pesan->getEmail(), $pesan->getKodeTiket(), $pesan->getUsername(), get_dateNow());
    header('location:/eprocurement/admin/pesan');
}

function cekTiket() {
    //$email = $_POST["email"];
    $tiket = $_POST["tiket"];
    header('location:/eprocurement/tiket/cek/' . $tiket);
}

function getPagination($count, $perpage) {
    $paginationCount = floor($count / $perpage);
    $paginationModCount = $count % $perpage;
    if (!empty($paginationModCount)) {
        $paginationCount++;
    }
    return $paginationCount;
}

?>