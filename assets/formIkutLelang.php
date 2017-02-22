<?php
global $idLelang;
$lelang = new lelang();
$lelang->setIdLelang($idLelang);
$lelang->setLelangRow();
$fitur = new fitur();
$fitur->setIdLelang($idLelang);
$dataFitur = $fitur->getFiturbyLelang();
//$dataFitur = $lelang->getFitur($idLelang);
$pesertalelang = new pesertaLelang();
$pesertalelang->setIdLelang($idLelang);
$pesertalelang->setIdMember($_SESSION["user"]["userid"]);
$idPesertaLelang = $pesertalelang->getIdPesertaLelangbyLelangAndMember();
?>
</div>
<div class="col-lg-offset-2">
    <center><h2 class="page-header">Form Ikut Lelang</h2></center>
    <div class="bs-example">
        <form class="form-horizontal" method="POST" action="">
            <?php
            //$idPesertaLelang = $lelang->getIdPesertaLelang($idLelang, $_SESSION["user"]["userid"]);
            if (isset($idPesertaLelang)) {
                $pesertalelang->setIdPesertaLelang($pesertalelang->getIdPesertaLelangbyLelangAndMember());
                $pesertalelang->setPesertaLelangRow();
                $hargaPenawaran = $pesertalelang->getHargaPenawaran();
                print_r('<input type="hidden" name="do" value="edit">
                    <input type="hidden" name="idPesertaLelang" value="' . $pesertalelang->getIdPesertaLelangbyLelangAndMember() . '">');
            } else {
                print_r('<input type="hidden" name="do" value="ikut">');
            }
            ?>
            <input type="hidden" name="action" value="ikut-lelang">
            <input type="hidden" name="idLelang" value="<?php echo $idLelang ?>">
            <div class="form-group">
                <label class="col-sm-2 control-label">Harga Penawaran</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="hargaPenawaran" name="hargaPenawaran" placeholder="Harga Penawaran" onkeyup="validasiHarga(event)" required
                           value="<?php
                           //$hargaPenawaran = $lelang->getHargaPenawaranPesertaLelang($idPesertaLelang);
                           if (isset($hargaPenawaran)) {
                               echo $hargaPenawaran;
                           }
                           ?>">
                    <div id="harga"></div>
                </div>
            </div>
            <?php
            $counter = 1;
            foreach ($dataFitur as $hasil) {
                print_r('<div class="form-group">
                    <label class="col-sm-2 control-label">Fitur #' . $counter . '</label>
                    <div class="col-sm-3">
                        <div class="checkbox">
                            <input type="hidden" name="fitur[]" value="' . $hasil["idFitur"] . '">
                            <label><input checked type="checkbox" onclick="UpdateForm(this,'.$hasil["idFitur"].','.$counter.')"> ' . $hasil["fitur"] . '</label>
                        </div>
                    </div>
                    <div id="fitur'.$counter.'">
                        <div class="col-sm-5" id="fiturdiv'.$counter.'">
                            <input type="text" name="keterangan[]" class="form-control" placeholder="' . $hasil["keterangan"] . '" required>
                        </div>
                    </div>
                 </div>');
                $counter++;
            }
            ?>
            <div class="form-group">
                <div class="col-sm-offset-5 col-sm-8">
                    <button type="submit" class="btn btn-default" name="submit"><?php
                        if (!isset($idPesertaLelang)) {
                            print_r('Submit');
                        } else {
                            print_r('Edit');
                        }
                        ?></button>
                    <button type="reset" class="btn btn-default">Reset</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function validasiHarga(keyEvent) { //fungsi untuk mengambil nilai setiap huruf yang dimasukkan
        keyEvent = (keyEvent) ? keyEvent : window.event;
        input = (keyEvent.target) ? keyEvent.target : keyEvent.srcElement;
        if (input.value) { //jika input dimasukkan, masuk ke fungsi cekEmail
            harga = document.getElementById("hargaPenawaran").value; //mengambil nilai dari form email yang telah dicek
            cekHarga("/eprocurement/ikut-lelang/?harga=" + harga + "&idLelang=" + <?php echo $idLelang ?>); //mengirim inputan email
        }
    }
    function cekHarga(fileCek) { //fungsi untuk menampilkan hasil pengecekan
        getAjax();
        ajaxRequest.open("GET", fileCek);
        ajaxRequest.onreadystatechange = function() {
            document.getElementById("harga").innerHTML = ajaxRequest.responseText; //hasil cek konfirmasi password
        };
        ajaxRequest.send(null);
    }
    
    function UpdateForm(cek, idFitur, counter){
        console.log(cek.checked);
        $("#fiturdiv" + counter).remove();
        cetakForm("/eprocurement/ajaxfitur/?idFitur="+idFitur+"&cek="+cek.checked, counter);
    }
    
    function cetakForm(fileCek, counter) { //fungsi untuk menampilkan hasil pengecekan
        getAjax();
        ajaxRequest.open("GET", fileCek);
        ajaxRequest.onreadystatechange = function() {
            document.getElementById("fitur"+counter).innerHTML = ajaxRequest.responseText;
        };
        ajaxRequest.send(null);
    }
</script>