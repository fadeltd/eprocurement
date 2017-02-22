<?php
global $idLelang, $idPesertaLelang;
$lelang = new lelang();
$lelang->setIdLelang($idLelang);
$lelang->setLelangRow();
$title = $lelang->getNama();
$result = $lelang->tampilPeserta($idLelang, $idPesertaLelang);
?>
<body>
    <div class="col-lg-10">
    <center><h2>Pilih Pemenang untuk Pelelangan <?php echo $title; ?></h2></center>
    <div class="bs-example">
        <form name="form" id="form" class="form-horizontal" method="POST" action="" onSubmit="getCounter()">
            <input type="hidden" name="action" value="pilih-pemenang">
            <input type="hidden" name="idLelang" value="<?php echo $idLelang ?>">
            <input type="hidden" name="idPesertaLelang" value="<?php echo $idPesertaLelang ?>">
            <div class="form-group">
                <label class="col-sm-2 control-label">Nama Peserta</label>
                <div class="col-sm-8">
                    <input type="text" name="username" class="form-control" disabled value="<?php echo $result["agency"] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Harga Penawaran</label>
                <div class="col-sm-8">
                    <input type="text" name="hargaPenawaran" class="form-control" disabled value="<?php echo $result["hargaPenawaran"] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Harga Fix</label>
                <div class="col-sm-8">
                    <input type="text" name="hargaFix" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Rating</label>
                <div class="col-sm-8">
                    <input type="text" name="rating" class="form-control" disabled value="<?php echo $result["rating"] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Kualifikasi</label>
                <div class="col-sm-8">
                    <div class="checkbox">
                        <label><input type="checkbox" name="kualifikasi" value="true">Sudah Terkualifikasi</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Alasan</label>
                <div class="col-sm-8">
                    <input type="text" name="alasan" class="form-control" placeholder="Alasan" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-5 col-sm-8">
                    <button type="submit" class="btn btn-success" name="submit" >Submit</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                </div>
            </div>
        </form>
    </div>
    </div></div>