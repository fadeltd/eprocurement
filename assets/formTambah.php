<?php
global $idLelang, $aksi;
$lelang = new lelang();
$lelang->setIdLelang($idLelang);
$lelang->setLelangRow();
$title = $lelang->getNama();
?>
<div class="col-lg-10">
    <center><h2>Tambahkan <?php echo $aksi ?> Untuk Pelelangan <?php echo $title; ?></h2></center>
    <form class="form-horizontal" method="POST" action="" onsubmit="getCounter()">
        <input type="hidden" name="idLelang" value="<?php echo $idLelang ?>">
        <input type="hidden" name="action" value="tambah">
        <?php
        if ($aksi == 'kualifikasi') {
            ?>
            <input type="hidden" id="counterKualifikasi" name="counterKualifikasi">
            <input type="hidden" name="do" value="kualifikasi">
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
                    <div class="col-sm-8">
                        <textarea class="form-control" rows="3" placeholder="Kualifikasi #1" id="textarea1" name="kualifikasi1"></textarea>
                    </div>
                </div>
            </div>
            <?php
        } else {
            ?>
            <input type="hidden" id="counterFitur" name="counterFitur">
            <input type="hidden" name="do" value="fitur">
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
                    <li class="col-sm-offset-2"><h6 style="text-align:left">Bobot adalah seberapa penting nilai fitur (Range 1-25)</h6></li>
                    <li class="col-sm-offset-2"><h6 style="text-align:left">Keterangan adalah keterangan untuk membantu user mengisi fitur </h6></li>
                    <li class="col-sm-offset-2"><h6 style="text-align:left">Indeks (+/-) untuk Sistem Pendukung Keputusan, apabila nilai semakin kecil semakin baik maka (-), dan sebaliknya</h6></li>
                </ul>
            </div>
        <?php
        }
        ?>
        <div class="form-group">
            <div class="col-sm-offset-5 col-sm-8">
                <button type="submit" class="btn btn-success" name="submit" >Submit</button>
                <a class="btn btn-danger" onClick="javascript:history.go(-1);">Cancel </a>
            </div>
        </div>
    </form>
</div>
</div>