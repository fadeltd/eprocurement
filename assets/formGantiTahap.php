<?php
global $idLelang;
$lelang = new lelang();
$lelang->setIdLelang($idLelang);
$lelang->setLelangRow();
//$dataTahap = $lelang->getTahap($idLelang);
$tahap = new tahap();
$tahap->setIdLelang($idLelang);
$dataTahap = $tahap->getTahapbyIdLelang();
?>
<div class="col-lg-10">
    <h2>Form Ganti Tahap <?php echo $lelang->getNama() ?></h2>
    <div class="bs-example">
        <form class="form-horizontal" method="POST" action="">
            <input type="hidden" name="action" value="ganti-tahap">
            <input type="hidden" name="idLelang" value="<?php echo $idLelang ?>">
            <div class="form-group">
                <label class="col-sm-2 control-label">Tahap</label>
                <div class="col-sm-8">
                    <select class="form-control" name="idTahap">
                        <?php
                        foreach ($dataTahap as $hasil) {
                            $namatahap = new namatahap();
                            $namatahap->setIdNamaTahap($hasil["idNamaTahap"]);
                            $namatahap->setNamaTahapRow();
                            $url = '';
                            if ($lelang->getIdTahap() == $hasil[0]) {
                                $url = ' selected';
                            }
                            print('<option value="' . $hasil[0] . '"'.$url.'>' . $namatahap->getNamaTahap() . '</option><br />');
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-5 col-sm-8">
                    <button type="submit" class="btn btn-success" name="submit">Submit</button>
                    <a class="btn btn-danger" onClick="javascript:history.go(-1);">Cancel </a>
                </div>
            </div>
        </form>
    </div>
</div>