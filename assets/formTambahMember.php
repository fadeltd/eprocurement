<?php

$prioritas = new prioritasmember();
$dataPrioritas = $prioritas->getPrioritasMemberAll();
print_r('<div class="col-lg-10">
       <hr class="featurette-divider"> 
        <center><h1>Form Tambah Member</h1></center>
        <form action="" class="form-horizontal" method="post" enctype="multipart/form-data" name="daftar" id="daftar" onsubmit="validate()">
        <input type="hidden" name="action" value="tambah-member">
        <input type="hidden" id="validation" name="validation">
        <div class="form-group">
            <label for="prioritas" class="col-sm-4 control-label">Prioritas Member</label>
            <div class="col-lg-4">
                <select class="form-control" name="idPrioritas" onchange="UpdateFormMember(this.value)">');
foreach ($dataPrioritas as $hasil) {
print_r('           <option value="' . $hasil["idPrioritas"] . '">' . $hasil["prioritas"] . '</option>');
}
print_r('       </select>
            </div>
        </div>
        <div class="form-group">
            <label for="username" class="col-sm-4 control-label">Username</label>
            <div class="col-lg-4">
                <input pattern=".{6,20}" type="text" class="form-control" id="username" name = "username" required placeholder="Username" onkeydown="validasiUsername(event)">
                <div id="hasilUsername"></div>
            </div>
            <h6 style="text-align:left">*Terdiri dari 6-20 karakter</h6>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-4 control-label">Email</label>
            <div class="col-lg-4">
                <input type="email" class="form-control" id="email" name="email" required placeholder="Email" onkeydown="validasiEmail(event)">
                <div id="hasilEmail"></div>
            </div>
            <h6 style="text-align:left">*Pastikan email Anda belum terdaftar</h6>
         </div>
         <div class="form-group">
            <label for="password" class="col-sm-4 control-label">Password</label>
            <div class="col-lg-4">
                <input pattern=".{6,}" type="password" class="form-control" id="password"  name="password" required placeholder="Password" onkeydown="validasiPassword(event,1)">
                <div id="hasil"></div>
            </div>
            <h6 style="text-align:left">*Minimal 6 karakter</h6>
         </div>
         <div class="form-group">
            <label for="passwordKonfirm" class="col-sm-4 control-label">Konfirmasi Password</label>
                <div class="col-lg-4">
                    <input pattern=".{6,}" type="password" class="form-control" id="passwordKonfirm"  name="passwordKonfirm" required placeholder="Password" onkeydown="validasiPassword(event,2)">
                    <div id="cocok"></div>
                </div>
                <h6 style="text-align:left">*Pastikan password sama</h6>
            </div>
         <div class="form-group">
            <label for="agency" class="col-sm-4 control-label">Agency / Nama Perusahaan</label>
            <div class="col-lg-4">
                <input type="text" class="form-control" id="agency"  name="agency" required placeholder="Agency / Nama perusahaan">
            </div>
            <h6 style="text-align:left">*Wajib diisi</h6>
         </div>
         <div id="member"></div>
         <div class="form-group">
            <div class="col-sm-offset-4 col-sm-4">
                <button type="submit" class="btn btn-success" id = "submit" name = "submit">Tambah Member</button>
            </div>
         </div>
        </form>
      </div>
      </div>
      ');
?>
<script>
/*    function UpdateFormMember(idPrioritas){
        $.ajax({
            data: 'idPrioritas='+idPrioritas+'&action=form-member',
            type: "post", 
            dataType: "html",
            timeout: 10000,
            success: function(response){
                $('#member').html(response);
            }
        });
    }
*/
    function UpdateFormMember(idPrioritas){
        cetakForm("/eprocurement/admin/form-member?idPrioritas="+idPrioritas);
    }

    function cetakForm(fileCek) { //fungsi untuk menampilkan hasil pengecekan
        getAjax();
        ajaxRequest.open("GET", fileCek);
        ajaxRequest.onreadystatechange = function() {
            document.getElementById("member").innerHTML = ajaxRequest.responseText;
        }
        ajaxRequest.send(null);
    }
    
    function validasiPassword(keyEvent, pilihan) { //fungsi untuk mengambil nilai setiap huruf yang dimasukkan
        keyEvent = (keyEvent) ? keyEvent : window.event;
        input = (keyEvent.target) ? keyEvent.target : keyEvent.srcElement;
        if (input.value) { //jika input dimasukkan, masuk ke fungsi cekPass
            if (pilihan == 1) {
                cekPass("/eprocurement/admin/cekpass?password=1&pass=" + password + "&input=" + input.value, 1); //mengirim inputan ke file cekpass.php
            } else if (pilihan == 2) {
                password = document.getElementById("password").value; //mengambil nilai dari form password yang telah dicek
                cekPass("/eprocurement/admin/cekpass?password=2&pass=" + password + "&input=" + input.value, 2); //mengirim inputan konfirmasi password
            }
        }
    }

    function cekPass(fileCek, keterangan) { //fungsi untuk menampilkan hasil pengecekan
        getAjax();
        ajaxRequest.open("GET", fileCek);
        ajaxRequest.onreadystatechange = function() {
            if (keterangan == 1) {
                document.getElementById("hasil").innerHTML = ajaxRequest.responseText; //hasil cek kekuatan password
            } else if (keterangan == 2) {
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
            cekEmail("/eprocurement/admin/cekemail?email=" + email); //mengirim inputan email
        }
    }

    function cekEmail(fileCek) { //fungsi untuk menampilkan hasil pengecekan
        getAjax();
        ajaxRequest.open("GET", fileCek);
        ajaxRequest.onreadystatechange = function() {
            document.getElementById("hasilEmail").innerHTML = ajaxRequest.responseText; //hasil cek konfirmasi password
        }
        ajaxRequest.send(null);
    }

    function validasiUsername(keyEvent) { //fungsi untuk mengambil nilai setiap huruf yang dimasukkan
        keyEvent = (keyEvent) ? keyEvent : window.event;
        input = (keyEvent.target) ? keyEvent.target : keyEvent.srcElement;
        if (input.value) { //jika input dimasukkan, masuk ke fungsi cekEmail
            username = document.getElementById("username").value; //mengambil nilai dari form email yang telah dicek
            cekUsername("/eprocurement/admin/cekusername?username=" + username); //mengirim inputan email
        }
    }

    function cekUsername(fileCek) { //fungsi untuk menampilkan hasil pengecekan
        getAjax();
        ajaxRequest.open("GET", fileCek);
        ajaxRequest.onreadystatechange = function() {
            document.getElementById("hasilUsername").innerHTML = ajaxRequest.responseText; //hasil cek konfirmasi password
        }
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