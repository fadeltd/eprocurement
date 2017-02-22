<?php
global $url;
$urlhome = '';
$urlabout = '';
$urlcontact = '';
$urlhelp = '';
$urlpesan = '';
$urlprivacy = '';
$urltiket = '';
$navigate = '';
switch ($url) {
    case '':
        $urlhome = ' class="active"';
        $navigate = ' onclick="navigate(event)"';
        break;
    case 'cek':
        $urltiket = ' class="active"';
        break;
    case 'tentang-kami':
        $urlabout = ' class="active"';
        break;
    case 'bantuan':
        $urlhelp = ' class="active"';
        break;
    case 'contact-us':
        $urlcontact = ' class="active"';
        break;
    case 'pesan':
        $urlpesan = ' class="active"';
        break;
    case 'privacy-policy':
        $urlprivacy = ' class="active"';
        break;
}
$pesan = new pesan();
$dataPesan = $pesan->getPesanAll();
$jumlahPesan = 0;
foreach ($dataPesan as $hasil) {
    if (!(isset($hasil["tanggapan"]))) {
        $jumlahPesan++;
    }
}
$cetakPesan = '';
if ($jumlahPesan != 0) {
    $cetakPesan = ' ( ' . $jumlahPesan . ' )';
}
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="/eprocurement/assets/images/favicon.ico">
        <title>Mitra Pembangunan Ciputri | Home</title>

        <!-- Bootstrap core CSS -->
        <link href="/eprocurement/assets/css/bootstrap.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <!-- Fixed navbar -->
        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/eprocurement/">
                        <img src="/eprocurement/assets/images/logoPerusahaanMiniWhite.png">
                        Mitra Pembangunan Ciputri
                    </a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li<?php echo $urlhome ?>><a href="/eprocurement/">Home</a></li>
                        <li<?php echo $urlabout ?>><a href="/eprocurement/page/tentang-kami">Tentang Kami</a></li>
                        <li<?php echo $urlhelp ?>><a href="/eprocurement/page/bantuan">Bantuan</a></li>
                        <li<?php echo $urlprivacy ?>><a href="/eprocurement/page/privacy-policy">Syarat & Ketentuan</a></li>
                        <?php
                        if (isset($_SESSION["user"])) {
                            if ($_SESSION["user"]["admin"] == 1) {
                                print_r('<li' . $urlpesan . '><a href="/eprocurement/admin/pesan">Pesan Masuk' . $cetakPesan . '</a></li>');
                            } else {
                                print_r('<li' . $urlcontact . '><a href="/eprocurement/page/contact-us">Kontak Kami</a></li>
                                    <li' . $urltiket . '><a href="/eprocurement/tiket/cek">Cek Tiket</a></li>
                                    </ul>');
                            }
                            print_r('</ul><ul class="nav navbar-nav navbar-right"><li><a href="/eprocurement/logout">Logout　<span class="glyphicon glyphicon-log-out"></span></a></li></ul>');
                        } else {
                            print_r('<li' . $urlcontact . '><a href="/eprocurement/page/contact-us">Kontak Kami</a></li>
                                <li' . $urltiket . '><a href="/eprocurement/tiket/cek">Cek Tiket</a></li>
                                </ul>');
                            //Login Dropdown
                            print_r('
                                <ul class="nav navbar-nav navbar-right">
                                    <li class="dropdown">
                                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Login <span class="glyphicon glyphicon-log-in"></span></a>
                                      <ul class="dropdown-menu">
                                        <li style="width:275px;padding:12px;">
                                        <div class="front-signin js-front-signin">
                                        <form class="signin" method="POST" action="">
                                            <input type="hidden" name="action" value="login">
                                            <input style="width:250px;" type="text" name="username" class="form-control" required placeholder="Username / Email">
                                            <input style="width:250px;" type="password" name="password" class="form-control" required placeholder="Password">
                                            <a href="/eprocurement/#daftar" id="nav" class="pull-left btn btn-success" '.$navigate.' >Daftar</a>
                                            <button class="pull-right btn btn-primary" name="submit" type="submit">Login</button>
                                        </form>
                                        </li>
                                      </ul>
                                    </li>
                                  </ul>');
                        }
                        ?>
                </div><!--/.nav-collapse -->
            </div>
        </div>