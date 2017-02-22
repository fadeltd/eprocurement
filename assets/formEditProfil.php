<?php
/*
 * /eprocurement/admin/edit-profil/idMember 
 * /eprocurement/edit-profil/
 */

global $idMember, $aksi;
print_r('<div class="col-lg-10"><center><h2>Form Edit Profile</h2></center>');
$member = new member();
$member->setIdMember($idMember);
$dataMember = $member->getMemberRow();

if (isset($_SESSION["user"])) {
    $url = '';
    if (isset($dataMember["blacklist"]) && $dataMember["blacklist"] == 1) {
        $url = 'checked';
    }
    if ($_SESSION["user"]["admin"] == 1) {
        //Menagani edit profil member by admin + blacklist
        if (isset($aksi) && isset($idMember)) {
            editProfilAdmin($idMember);
            editProfilMember($idMember);
            ?>
            <input type="hidden" name="idMember" value="<?php echo $idMember; ?>">
            <div class="form-group">
                <label class="col-sm-2 control-label">Blacklist</label>
                <div class="col-sm-8">
                    <div class="checkbox">
                        <label><input type="checkbox" name="blacklist" value="true" <?php echo $url ?> >Masuk Daftar Hitam</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Alasan Blacklist</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="alasanBlacklist" placeholder="Alasan Blacklist" value="<?php echo $dataMember["alasanBlacklist"]; ?>">
                </div>
            </div>
            <?php
            //Menagani edit profil by admin
        } else {
            editProfilAdmin($_SESSION["user"]["userid"]);
            print_r('<input type="hidden" name="action" value="edit-admin">');
        }
        //Menagani edit profil by member
    } else {
        editProfilAdmin($_SESSION["user"]["userid"]);
        editProfilMember($_SESSION["user"]["userid"]);
        print_r('
            <input type="hidden" name="idMember" value="' . $_SESSION["user"]["userid"] . '">
            <input type="hidden" name="blacklist" value="true" ' . $url . '>
            <input type="hidden" name="alasanBlacklist" value="' . $dataMember["alasanBlacklist"] . '"');
    }
} else {
    header('location:/eprocurement/daftar');
}

function editProfilAdmin($idMember) {
    $member = new member();
    $member->setIdMember($idMember);
    $dataMember = $member->getMemberRow();
    ?>
    <div class="bs-example">
        <form name="form" id="form" enctype="multipart/form-data" class="form-horizontal" method="POST" action="" onsubmit="getCounter()">
            <input type="hidden" name="idPrioritas" value="2">
            <div class="form-group">
                <label class="col-sm-2 control-label">Username</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo $dataMember["username"]; ?>" readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Email</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $dataMember["email"]; ?>" readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Password</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" id="password1" name="password" placeholder="Password" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Password <br />(Masukkan Lagi)</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" id="password2" placeholder="Password" required>
                </div>
            </div>
            <input type="hidden" name="currentavatar" value="<?php echo $dataMember["avatar"]; ?>">
            <div class="form-group">
                <label class="col-sm-2 control-label">Current Logo Perusahaan</label>
                <div class="col-sm-8">
                    <img class="img-circle" data-src="holder.js/140x140" alt="140x140" style="width: 140px; height: 140px;" src="<?php echo '/eprocurement/assets/images/member/'.$dataMember["avatar"]; ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Ganti Logo Perusahaan</label>
                <div class="col-sm-8">
                    <input type="file" class="form-control" name="avatar">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Agency</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="agency" placeholder="Agency" value="<?php echo $dataMember["agency"]; ?>" required>
                </div>
            </div>
            <?php
        }

        function editProfilMember($idMember) {
            $member = new member();
            $member->setIdMember($idMember);
            $dataMember = $member->getMemberRow();
            ?>
            <input type="hidden" name="action" value="edit-member">
            <div class="form-group">
                <label class="col-sm-2 control-label">Alamat</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="alamat" placeholder="Alamat" value="<?php echo $dataMember["alamat"]; ?>" required>
                </div>
            </div>
            <input type="hidden" name="currentcv" value="<?php echo $dataMember["cv"]; ?>">
            <div class="form-group">
                <label class="col-sm-2 control-label">Current CV</label>
                <div class="col-sm-8">
                    <a href="/eprocurement/assets/docs/cv/<?php echo $dataMember["cv"]; ?>" class="btn btn-success"><span class="glyphicon glyphicon-download"></span> CV</a>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Upload CV</label>
                <div class="col-sm-8">
                    <input type="file" class="form-control" name="cv" type="file" accept="application/msword,application/x-zip-compressed,application/pdf">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Faximile</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="fax" placeholder="Faximile" value="<?php echo $dataMember["fax"]; ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">NPWP</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="npwp" placeholder="NPWP" value="<?php echo $dataMember["npwp"]; ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Telepon</label>
                <div class="col-sm-10">
                    <button type='button' value='Add Fitur' id='addFitur' class="btn btn-default">
                        <span class="glyphicon glyphicon-plus"></span> Tambah Nomor Telepon</button>
                    <button type='button' value='Remove Fitur' id='removeFitur' class="btn btn-default">
                        <span class="glyphicon glyphicon-minus"></span> Hapus Nomor Telepon</button>
                </div>
            </div>
            <div id='Fitur'>
                <div id='DivLabelTextFitur1' class='form-group'>
                    <label class="col-sm-2 control-label">Telepon #1</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="Telepon #1" id="fitur1" name="fitur1">
                    </div>
                </div>
            </div>
            <input type="hidden" id="counterFitur" name="counterFitur">
        <?php } ?>
        <div class="form-group">
            <div class="col-sm-offset-5 col-sm-8">
                <button type="submit" class="btn btn-default" name="submit" id="submit">Edit</button>
                <button type="reset" class="btn btn-default">Reset</button>
                <a class="btn btn-default" onClick="javascript:history.go(-1);">Cancel </a>
            </div>
        </div>
    </form>
</div>
</div></div>