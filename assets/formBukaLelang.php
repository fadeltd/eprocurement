<?php
// /eprocurement/admin/buka-lelang/
//$member = new member();
$kategori = new kategori();
$dataKategori = $kategori->getKategoriAll();
//$dataKategori = $member->getKategori();

$namatahap = new namatahap();
$dataTahap = $namatahap->getNamaTahapAll();
?>
<center><h2>Form Buka Lelang</h2></center>
<div class="col-lg-10">
    <div class="bs-example">
        <form name="form" id="form" class="form-horizontal" method="POST" action="" onsubmit="getCounter()">
            <input type="hidden" name="action" value="buka-lelang">
            <div class="form-group">
                <label class="col-sm-2 control-label">Judul Lelang</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="nama" placeholder="Judul Lelang" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Kategori</label>
                <div class="col-sm-9">
                    <select class="form-control" name="idKategori">
                        <?php
                        $counterKategori = 1;
                        foreach ($dataKategori as $hasil) {
                            print('<option value="' . $counterKategori . '">' . $hasil["kategori"] . '</option>');
                            $counterKategori++;
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Harga Minimal</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="hargaMin" name="hargaMin" placeholder="Harga Minimal" onkeyup="validasiHarga(event, 1)" required>
                    <div id="hasil"></div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Harga Maksimal</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="hargaMax" name="hargaMax" placeholder="Harga Maksimal" onkeyup="validasiHarga(event, 2)" required>
                    <div id="cocok"></div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Tanggal Pengajuan</label>
                <div class="col-sm-9">
                    <input type="date" class="form-control" name="tanggalPosting" value="<?php echo date('Y-m-d'); ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Tanggal Deadline</label>
                <div class="col-sm-9">
                    <input type="date" class="form-control" name="tanggalDeadline" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Lokasi</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="lokasi" placeholder="Lokasi" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">SIUP</label>
                <div class="col-sm-9">
                    <select class="form-control" name="SIUP">
                        <option>Perusahaan Non Kecil</option>
                        <option>Perusahaan Kecil</option>
                    </select>
                </div>
            </div>
            <input type="hidden" id="counterKualifikasi" name="counterKualifikasi" value="">
            <div class="form-group">
                <label class="col-sm-2 control-label">Syarat Kualifikasi</label>
                <div class="col-sm-10">
                    <button type='button' id='addKualifikasi' class="btn btn-default">
                        <span class="glyphicon glyphicon-plus"></span> Tambah Kualifikasi
                    </button>
                    <button type='button' id='removeKualifikasi' class="btn btn-default">
                        <span class="glyphicon glyphicon-minus"></span> Hapus Kualifikasi
                    </button>
                </div>
            </div>
            <div id="Kualifikasi">
                <div class="form-group" id="KualifikasiDiv1">
                    <label class="col-sm-2 control-label">Kualifikasi #1 : </label>
                    <div class="col-sm-9">
                        <textarea class="form-control" rows="3" placeholder="Kualifikasi #1" id="textarea1" name="kualifikasi1"></textarea>
                    </div>
                </div>
            </div>
            <input type="hidden" id="counterFitur" name="counterFitur" value="">
            <div class="form-group">
                <label class="col-sm-2 control-label">Fitur</label>
                <div class="col-sm-10">
                    <button type='button' id='addFitur' class="btn btn-default">
                        <span class="glyphicon glyphicon-plus"></span> Tambah Fitur
                    </button>
                    <button type='button' id='removeFitur' class="btn btn-default">
                        <span class="glyphicon glyphicon-minus"></span> Hapus Fitur
                    </button>
                </div>
            </div>
            <div id="Fitur">
                <div class="form-group" id="FiturDiv1">
                    <label class="col-sm-2 control-label">Fitur #1 : </label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" placeholder="Fitur #1" id="textbox1" name="fitur1">
                    </div>
                    <div class="col-sm-2 form-group">
                        <input type="text" class="form-control" placeholder="Bobot Fitur #1" id="textbox1" name="bobot1" required>
                    </div>
                    <div class="col-sm-3 form-group">
                        <input type="text" class="form-control" placeholder="Keterangan Fitur #1" id="textbox1" name="keterangan1" required>
                    </div>
                    <div class="col-sm-2 form-group">
                        <select class="form-control" name="indeks1">
                            <option value="1">+</option>
                            <option value="0">-</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Catatan : </label>
                <ul class="form-group">
                    <li class="col-sm-offset-2"><h6 style="text-align:left">Bobot adalah seberapa penting nilai fitur</h6></li>
                    <li class="col-sm-offset-2"><h6 style="text-align:left">Keterangan adalah keterangan untuk membantu user mengisi fitur</h6></li>
                    <li class="col-sm-offset-2"><h6 style="text-align:left">Indeks (+/-) untuk Sistem Pendukung Keputusan, apabila nilai semakin kecil semakin baik maka (-), dan sebaliknya</h6></li>
                </ul>
            </div>
            <h2>Tahap</h2>
            <?php
            $counter = 1;
            foreach ($dataTahap as $hasil) {
                print_r('<div class="form-group">
                    <label class="col-sm-2 control-label">Tahap</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="' . $hasil["nama"] . '" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Tanggal Mulai</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" name="tglMulai' . $counter . '" value="' . date('Y-m-d') . '">
                        </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Tanggal Selesai</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" name="tglSelesai' . $counter . '" value="' . date('Y-m-d') . '">
                    </div>
                </div>');
                $counter++;
            }
            ?>
            <div class="form-group">
                <div class="col-sm-offset-5 col-sm-9">
                    <button type="submit" class="btn btn-default" name="submit" id="submit">Submit</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function validasiHarga(keyEvent, pilihan) { //fungsi untuk mengambil nilai setiap huruf yang dimasukkan
        keyEvent = (keyEvent) ? keyEvent : window.event;
        input = (keyEvent.target) ? keyEvent.target : keyEvent.srcElement;
        if (input.value) { //jika input dimasukkan, masuk ke fungsi cekPass
            if (pilihan == 1) {
                cekHarga("/eprocurement/admin/cekharga?harga=1&hargaMin=" + hargaMin + "&input=" + input.value, 1);
            } else if (pilihan == 2) {
                hargaMin = document.getElementById("hargaMin").value;
                cekHarga("/eprocurement/admin/cekharga?harga=2&hargaMin=" + hargaMin + "&input=" + input.value, 2); //mengirim inputan konfirmasi password
            }
        }
    }
    function cekHarga(fileCek, keterangan) { //fungsi untuk menampilkan hasil pengecekan
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
</script>