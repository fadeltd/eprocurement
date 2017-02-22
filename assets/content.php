<?php
if (!isset($_SESSION["user"])) {
    print_r('
         <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
      </ol>
      <div class="carousel-inner">
        <div class="item active">
          <img data-src="holder.js/900x500/auto/#777:#7a7a7a/text:First slide" alt="First slide" src="/eprocurement/assets/images/firstSlide.png">
          <div class="container">
            <div class="carousel-caption">
              <h1>Help Us Build The World!</h1>
              <p><b>Login untuk memulai!</b></p>
              <form class="form-horizontal" method="POST" action="">
              <div class="form-group">
            <input type="hidden" name="action" value="login">
              <label>Username</label>
              <input type="text" name="username" class="form-control" required placeholder="Username / Email">
              </div>
              <div class="form-group">
              <p>Password</p>
              <input type="password" name="password" class="form-control" required placeholder="Password">
              </div>
              <div class="form-group">
              <button name="submit" type="submit" class="btn btn-lg btn-primary">Login</button>
              <a class="btn btn-lg btn-success" href="#daftar" onclick="navigate(event)">Daftar sekarang!</a>
              </div>
              </form>
            </div>
          </div>
        </div>
        <div class="item">
          <img data-src="holder.js/900x500/auto/#666:#6a6a6a/text:Second slide" alt="Second slide" src="/eprocurement/assets/images/secondSlide.png">
          <div class="container">
            <div class="carousel-caption">
              <h1>Kami Memberikan Kesempatan Bagi Anda!</h1>
              <p>Lelang yang kami tawarkan akan selalu terupdate.</p>
              <p><a class="btn btn-lg btn-primary" href="/eprocurement/page/tentang-kami" role="button">Learn more</a></p>
            </div>
          </div>
        </div>
        <!--<div class="item">
          <img data-src="holder.js/900x500/auto/#555:#5a5a5a/text:Third slide" alt="Third slide" src="images/Third slide.png">
          <div class="container">
            <div class="carousel-caption">
              <h1>One more for good measure.</h1>
              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
            </div>
          </div>
        </div>-->
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      	<span class="glyphicon glyphicon-chevron-left"></span>
      </a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">
      	<span class="glyphicon glyphicon-chevron-right"></span>
      </a>
    </div><!-- /.carousel -->
    
    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->
    <div class="container marketing">
      <!-- Three columns of text below the carousel -->
      <br /><br />
      <div class="row">
      <center><h2 class="page-header">Mitra Pembangunan Ciputri</h2></center>
      <p>Merupakan sebuah usaha kami untuk mewujudkan komplek hunian yang asri, alami, sesuai moto kami. Kami menginginkan partisipasi anda untuk mewujudkannya dengan sistem pengadaan barang.</p>
      <p>Kami berkomitmen untuk memberikan yang terbaik bagi setiap pelanggan kami, maka kami membutuhkan Anda selaku pemilik jasa dan barang untuk mewujudkannya! Kami akan menggunakan barang dan jasa berkualitas yang akan Anda tawarkan kepada kami sesuai dengan permintaan lelang yang kami buka. Maka, tunggu apalagi? Daftarkan perusahaan Anda sekrang juga! </p>
      <hr class="featurette-divider" id="daftar"> 
      <center><h2 class="page-header">Form Pendaftaran Akun Baru</h2></center>
      <form action="" class="form-horizontal" method="post" enctype="multipart/form-data" name="daftar" onsubmit="validate()">
        <input type="hidden" name="action" value="register">
        <input type="hidden" id="validation" name="validation">
        <div class="form-group">
            <label for="username" class="col-sm-4 control-label">Username</label>
            <div class="col-lg-4">
                <input pattern=".{6,20}" type="text" class="form-control" id="username" name = "username" required placeholder="Username" onkeydown="validasiUsername(event)">
                <div align="center" class="loadingUser"></div>
                <div id="hasilUsername"></div>
            </div>
            <h6 style="text-align:left">*Terdiri dari 6-20 karakter</h6>
        </div>
                <div class="form-group">
                    <label for="email" class="col-sm-4 control-label">Email</label>
                    <div class="col-lg-4">
                        <input type="email" class="form-control" id="email" name="email" required placeholder="Email" onkeydown="validasiEmail(event)">
                        <div align="center" class="loadingEmail"></div>
                        <div id="hasilEmail"></div>
                    </div>
                    <h6 style="text-align:left">*Pastikan email Anda belum terdaftar</h6>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-4 control-label">Password</label>
                    <div class="col-lg-4">
                        <input pattern=".{6,}" type="password" class="form-control" id="password"  name="password" required placeholder="Password" onkeydown="validasiPassword(event,1)">
                        <div align="center" class="loadingPassword"></div>
                        <div id="hasil"></div>
                    </div>
                    <h6 style="text-align:left">*Minimal 6 karakter</h6>
                </div>
                <div class="form-group">
                    <label for="passwordKonfirm" class="col-sm-4 control-label">Konfirmasi Password</label>
                    <div class="col-lg-4">
                        <input pattern=".{6,}" type="password" class="form-control" id="passwordKonfirm"  name="passwordKonfirm" required placeholder="Password" onkeydown="validasiPassword(event,2)">
                        <div align="center" class="loadingPwd"></div>
                        <div id="cocok"></div>
                    </div>
                    <h6 style="text-align:left">*Pastikan password sama</h6>
                </div>
                <div class="form-group">
                    <label for="agency" class="col-sm-4 control-label">Agency / Nama Perusahaan</label>
                    <div class="col-lg-4">
                        <input type="text" class="form-control" id="agency" name="agency" required placeholder="Agency / Nama perusahaan">
                    </div>
                    <h6 style="text-align:left">*Wajib diisi</h6>
                </div>
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
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-4">
                        <input type="checkbox" value="true"/> Saya menyetujui <a href="/eprocurement/page/privacy-policy" target="blank">Syarat dan Ketentuan</a> yang berlaku
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-4">
                        <button type="submit" class="btn btn-success" id = "submit" name = "submit">Daftar</button>
                    </div>
                </div>
        </form>
      </div><!-- /.row -->');
?>
<script>
    function validasiPassword(keyEvent, pilihan) { //fungsi untuk mengambil nilai setiap huruf yang dimasukkan
        keyEvent = (keyEvent) ? keyEvent : window.event;
        input = (keyEvent.target) ? keyEvent.target : keyEvent.srcElement;
        if (input.value) { //jika input dimasukkan, masuk ke fungsi cekPass
            if (pilihan == 1) {
                $(".loadingPassword").show();
                $(".loadingPassword").fadeIn(500).html('<br /><img src="assets/images/ajax-loader.gif" />');
                cekPass("/eprocurement/cekpass?password=1&pass=" + password + "&input=" + input.value, 1); //mengirim inputan ke file cekpass.php
            } else if (pilihan == 2) {
                $(".loadingPwd").show();
                $(".loadingPwd").fadeIn(500).html('<br /><img src="assets/images/ajax-loader.gif" />');
                password = document.getElementById("password").value; //mengambil nilai dari form password yang telah dicek
                cekPass("/eprocurement/cekpass?password=2&pass=" + password + "&input=" + input.value, 2); //mengirim inputan konfirmasi password
            }
        }
    }

    function cekPass(fileCek, keterangan) { //fungsi untuk menampilkan hasil pengecekan
        getAjax();
        ajaxRequest.open("GET", fileCek);
        ajaxRequest.onreadystatechange = function() {
            if (keterangan == 1) {
                $(".loadingPassword").hide();
                document.getElementById("hasil").innerHTML = ajaxRequest.responseText; //hasil cek kekuatan password
            } else if (keterangan == 2) {
                $(".loadingPwd").hide();
                document.getElementById("cocok").innerHTML = ajaxRequest.responseText; //hasil cek konfirmasi password
            }
        }
        ajaxRequest.send(null);
    }

    function validasiEmail(keyEvent) { //fungsi untuk mengambil nilai setiap huruf yang dimasukkan
        keyEvent = (keyEvent) ? keyEvent : window.event;
        input = (keyEvent.target) ? keyEvent.target : keyEvent.srcElement;
        if (input.value) { //jika input dimasukkan, masuk ke fungsi cekEmail
            email = document.getElementById("email").value; //mengambil nilai dari form email yang telah dicek
            cekEmail("/eprocurement/cekemail?email=" + email); //mengirim inputan email
        }
    }

    function cekEmail(fileCek) { //fungsi untuk menampilkan hasil pengecekan
        $(".loadingEmail").show();
        $(".loadingEmail").fadeIn(500).html
                ('<br /><img src="assets/images/ajax-loader.gif" />');
        getAjax();
        ajaxRequest.open("GET", fileCek);
        ajaxRequest.onreadystatechange = function() {
            $(".loadingEmail").hide();
            document.getElementById("hasilEmail").innerHTML = ajaxRequest.responseText; //hasil cek konfirmasi password
        }
        ajaxRequest.send(null);
    }

    function validasiUsername(keyEvent) { //fungsi untuk mengambil nilai setiap huruf yang dimasukkan
        keyEvent = (keyEvent) ? keyEvent : window.event;
        input = (keyEvent.target) ? keyEvent.target : keyEvent.srcElement;
        if (input.value) { //jika input dimasukkan, masuk ke fungsi cekEmail
            username = document.getElementById("username").value; //mengambil nilai dari form email yang telah dicek
            cekUsername("/eprocurement/cekusername?username=" + username); //mengirim inputan email
        }
    }

    function cekUsername(fileCek) { //fungsi untuk menampilkan hasil pengecekan
        getAjax();
        $(".loadingUser").show();
        $(".loadingUser").fadeIn(500).html
                ('<br /><img src="assets/images/ajax-loader.gif" />');
        ajaxRequest.open("GET", fileCek);
        ajaxRequest.onreadystatechange = function() {
            $(".loadingUser").hide();
            document.getElementById("hasilUsername").innerHTML = ajaxRequest.responseText; //hasil cek konfirmasi password
        };
        ajaxRequest.send(null);
    }

    function validate() {
        validation = true;
        var username = document.forms["daftar"]["username"].value;
        var email = document.forms["daftar"]["email"].value;
        var password = document.forms["daftar"]["password"].value;
        var at = email.indexOf("@");
        var dot = email.lastIndexOf(".");
        if (username == null || username == "") {
            alert("Username harus di isi");
            validation = false;
            return false;
        } else if (username.length < 6 || username.length > 20) {
            alert("Username harus terdiri antara 6-20 karakter");
            validation = false;
            return false;
        } else if (password.length < 6) {
            alert("Password minimal 6 karakter");
            validation = false;
            return false;
        } else if (email == null || email == "") {
            alert("Email harus di isi");
            validation = false;
            return false;
        }else if (at < 1 || dot < at + 2 || dot + 2 >= email.length) {
            alert("Masukkan alamat Email yang valid");
            validation = false;
            return false;
        }
        document.form.validation.value = validation;
    }
</script>
<?php
} else {
    include_once "assets/daftarLelang.php";
}
?>