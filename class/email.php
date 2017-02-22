<?php

class email {
    
    public function __construct() {}

    public function sendEmailAktivasi($idMember) {
        $member = new member();
        $member->setIdMember($idMember);
        $member->setMemberRow();
        $agency = $member->getAgency();
        $tanggalDaftar = $member->getTanggalDaftar();
        $token = md5($idMember);
        $to = $member->getEmail();
        $server = $_SERVER['HTTP_HOST'];
        $subject = "Registration Successfull, please activate your account ";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
        $headers .= 'From:admin@eprocurement.meximas.com'. "\r\n";
        $message = '<center><div style="background:#eaeeeb;width:100%;max-width:640px;min-width:340px;padding:40px;margin:auto;">
                <div style="padding:0 0 32px 0;">
                    <p style="margin:0;line-height:1.4em;color:#A2ABA5;font-size:12px;text-align:center;">
                        <a target="_blank" href="' . $server . '/eprocurement/"><img src="' . $server . '/eprocurement/assets/images/logoPerusahaan.jpg"></a></p>
                    <hr style="background:none;height:0;border-top:1px solid #cfcccf;border-bottom:1px solid white;border-right:0;border-left:0;margin:32px 0 0 0;">
                    <h1 style="margin:0 0 20px 0;line-height:1;color:#2E2621;font-size:24px;">Selamat datang "' . $agency . '" pada Mitra Pembangunan Ciputri</h1>
                    <p style="color:#A2ABA5;font-size:12px;margin:0 0 20px 0;line-height:1;">' . $tanggalDaftar . ' Malang</p>
                    <p style="font-size:16px;line-height:24px;margin:0 0 20px 0;">
                        Halo, </p>
                    <p style="font-size:16px;line-height:24px;margin:0 0 20px 0;">
                        Akun Anda pada Mitra Pembangunan Ciputri sudah terdaftar,
                        kami hanya perlu memverifikasi email Anda untuk mengaktivasi akun Anda.
                        Mohon lakukan aktivasi dengan tautan
                        <a rel="nofollow" style="color:ff5e00;" target="_blank" href="' . $server . '/eprocurement/verify/' . $token . '">berikut</a>
                        untuk dapat mengikuti pelelangan yang tersedia pada sistem kami</p>
                    <p style="font-size:16px;line-height:24px;margin:0 0 20px 0;">
                        Jika Anda tidak merasa telah melakukan pendaftaran, abaikan saja pesan ini.</p>
                    <p style="font-size:16px;line-height:24px;margin:0 0 20px 0;">
                        <strong>Admin Mitra Pembangunan Ciputri.</strong></p>
                    <div style="color:white;font-size:12px;background:#373C40;padding:32px 40px;">
                        <p style="line-height:1.6em;text-align:center;">
                            Copyright &copy; 2013, Ciputri Land Group. All rights reserved.
                            <br>
                            <a rel="nofollow" style="color:#ff5e00;" target="_blank" href="' . $server . '/eprocurement">Home Page</a> &mdash; 
                            <a rel="nofollow" style="color:#ff5e00;" target="_blank" href="' . $server . '/eprocurement/page/tentang-kami">Tentang Kami</a> &mdash; 
                            <a rel="nofollow" style="color:#ff5e00;" target="_blank" href="' . $server . '/eprocurement/page/bantuan">Bantuan</a>
                            <br>
                            <a rel="nofollow" target="_blank" href="#"><img src="' . $server . '/eprocurement/assets/images/social/twitter.png" alt="Twitter"></a>
                            <a rel="nofollow" target="_blank" href="#"><img src="' . $server . '/eprocurement/assets/images/social/facebook.png" alt="Facebook"></a>
                            <a rel="nofollow" target="_blank" href="#"><img src="' . $server . '/eprocurement/assets/images/social/google-plus.png" alt="Google Plus"></a>
                        </p>
                    </div>
                </div>
            </div></center>';
        $emailSent = mail($to, $subject, $message, $headers);
        echo $emailSent ? "Mail sent" : "Mail failed";
    }
    
    public function sendEmailTiket($email, $kodeTiket, $username, $tanggal) {
        $to = $email;
        $server = $_SERVER['HTTP_HOST'];
        $subject = "Kode Tiket Kontak Kami Mitra Pembangunan Ciputri";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
        $headers .= 'From:admin@eprocurement.meximas.com'. "\r\n";
        $message = '<center><div style="background:#eaeeeb;width:100%;max-width:640px;min-width:340px;padding:40px;margin:auto;">
                <div style="padding:0 0 32px 0;">
                    <p style="margin:0;line-height:1.4em;color:#A2ABA5;font-size:12px;text-align:center;">
                        <a target="_blank" href="' . $server . '/eprocurement/"><img src="' . $server . '/eprocurement/assets/images/logoPerusahaan.jpg"></a></p>
                    <hr style="background:none;height:0;border-top:1px solid #cfcccf;border-bottom:1px solid white;border-right:0;border-left:0;margin:32px 0 0 0;">
                    <h1 style="margin:0 0 20px 0;line-height:1;color:#2E2621;font-size:24px;">Terimakasih ' . $username . ' telah mengirim pesan pada Mitra Pembangunan Ciputri</h1>
                    <p style="color:#A2ABA5;font-size:12px;margin:0 0 20px 0;line-height:1;">' . $tanggal . ' Malang</p>
                    <p style="font-size:16px;line-height:24px;margin:0 0 20px 0;">
                        Halo, "' . $username . '"</p>
                    <p style="font-size:16px;line-height:24px;margin:0 0 20px 0;">
                        Kode Tiket Anda adalah <strong>'.$kodeTiket.'</strong> atau ikuti link
                        <a rel="nofollow" style="color:ff5e00;" target="_blank" href="' . $server . '/eprocurement/tiket/cek/' . $kodeTiket . '">
                            <strong>berikut ini</strong>
                        </a>
                        untuk dapat mengecek apabila tiket Anda sudah mendapat tanggapan</p>
                    <p style="font-size:16px;line-height:24px;margin:0 0 20px 0;">
                        Jika Anda tidak merasa telah mengirim tiket, abaikan saja pesan ini.</p>
                    <p style="font-size:16px;line-height:24px;margin:0 0 20px 0;">
                        <strong>Admin Mitra Pembangunan Ciputri.</strong></p>
                    <div style="color:white;font-size:12px;background:#373C40;padding:32px 40px;">
                        <p style="line-height:1.6em;text-align:center;">
                            Copyright &copy; 2013, Ciputri Land Group. All rights reserved.
                            <br>
                            <a rel="nofollow" style="color:#ff5e00;" target="_blank" href="' . $server . '/eprocurement">Home Page</a> &mdash; 
                            <a rel="nofollow" style="color:#ff5e00;" target="_blank" href="' . $server . '/eprocurement/page/tentang-kami">Tentang Kami</a> &mdash; 
                            <a rel="nofollow" style="color:#ff5e00;" target="_blank" href="' . $server . '/eprocurement/page/bantuan">Bantuan</a>
                            <br>
                            <a rel="nofollow" target="_blank" href="#"><img src="' . $server . '/eprocurement/assets/images/social/twitter.png" alt="Twitter"></a>
                            <a rel="nofollow" target="_blank" href="#"><img src="' . $server . '/eprocurement/assets/images/social/facebook.png" alt="Facebook"></a>
                            <a rel="nofollow" target="_blank" href="#"><img src="' . $server . '/eprocurement/assets/images/social/google-plus.png" alt="Google Plus"></a>
                        </p>
                    </div>
                </div>
            </div></center>';
        $emailSent = mail($to, $subject, $message, $headers);
        echo $emailSent ? "Mail sent" : "Mail failed";
    }
    
    public function sendEmailTanggap($email, $kodeTiket, $username, $tanggal) {
        $to = $email;
        $server = $_SERVER['HTTP_HOST'];
        $subject = "Tanggapan Terhadap Tiket $kodeTiket Mitra Pembangunan Ciputri";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
        $headers .= 'From:admin@eprocurement.meximas.com'. "\r\n";
        $message = '<center><div style="background:#eaeeeb;width:100%;max-width:640px;min-width:340px;padding:40px;margin:auto;">
                <div style="padding:0 0 32px 0;">
                    <p style="margin:0;line-height:1.4em;color:#A2ABA5;font-size:12px;text-align:center;">
                        <a target="_blank" href="' . $server . '/eprocurement/"><img src="' . $server . '/eprocurement/assets/images/logoPerusahaan.jpg"></a></p>
                    <hr style="background:none;height:0;border-top:1px solid #cfcccf;border-bottom:1px solid white;border-right:0;border-left:0;margin:32px 0 0 0;">
                    <h1 style="margin:0 0 20px 0;line-height:1;color:#2E2621;font-size:24px;">' . $username . ', pesan Anda telah kami tanggapi</h1>
                    <p style="color:#A2ABA5;font-size:12px;margin:0 0 20px 0;line-height:1;">' . $tanggal . ' Malang</p>
                    <p style="font-size:16px;line-height:24px;margin:0 0 20px 0;">
                        Pesan Anda untuk kode tiket Anda <strong>'.$kodeTiket.'</strong> sudah kami tanggapi, silakan cek pada halaman
                        <a rel="nofollow" style="color:ff5e00;" target="_blank" href="'.$server.'/eprocurement/tiket/cek">'.
                            $server.'/eprocurement/tiket/cek</a>, atau ikuti tautan
                        <a rel="nofollow" style="color:ff5e00;" target="_blank" href="' . $server . '/eprocurement/tiket/cek/' . $kodeTiket . '">
                            <strong>berikut ini</strong>
                        </a>
                    </p>
                    <p style="font-size:16px;line-height:24px;margin:0 0 20px 0;">
                        Jika Anda tidak merasa telah mengirim tiket, abaikan saja pesan ini.</p>
                    <p style="font-size:16px;line-height:24px;margin:0 0 20px 0;">
                        <strong>Admin Mitra Pembangunan Ciputri.</strong></p>
                    <div style="color:white;font-size:12px;background:#373C40;padding:32px 40px;">
                        <p style="line-height:1.6em;text-align:center;">
                            Copyright &copy; 2013, Ciputri Land Group. All rights reserved.
                            <br>
                            <a rel="nofollow" style="color:#ff5e00;" target="_blank" href="' . $server . '/eprocurement">Home Page</a> &mdash; 
                            <a rel="nofollow" style="color:#ff5e00;" target="_blank" href="' . $server . '/eprocurement/page/tentang-kami">Tentang Kami</a> &mdash; 
                            <a rel="nofollow" style="color:#ff5e00;" target="_blank" href="' . $server . '/eprocurement/page/bantuan">Bantuan</a>
                            <br>
                            <a rel="nofollow" target="_blank" href="#"><img src="' . $server . '/eprocurement/assets/images/social/twitter.png" alt="Twitter"></a>
                            <a rel="nofollow" target="_blank" href="#"><img src="' . $server . '/eprocurement/assets/images/social/facebook.png" alt="Facebook"></a>
                            <a rel="nofollow" target="_blank" href="#"><img src="' . $server . '/eprocurement/assets/images/social/google-plus.png" alt="Google Plus"></a>
                        </p>
                    </div>
                </div>
            </div></center>';
        $emailSent = mail($to, $subject, $message, $headers);
        echo $emailSent ? "Mail sent" : "Mail failed";
    }
    
    public function sendEmailPemenang($idLelang, $idPemenang, $tanggal) {
        $member = new member();
        $member->setIdMember($idPemenang);
        $member->setMemberRow();
        $lelang = new lelang();
        $lelang->setIdLelang($idLelang);
        $lelang->setLelangRow();
        $judulLelang = $lelang->getNama();
        $agency = $member->getAgency();
        $to = $member->getEmail();
        $server = $_SERVER['HTTP_HOST'];
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
        $headers .= 'From:admin@eprocurement.meximas.com'. "\r\n";
        $subject = "Selamat, pengajuan Anda telah terpilih sebagai pemenang pada pelelangan ".$judulLelang;
        $message = '<center><div style="background:#eaeeeb;width:100%;max-width:640px;min-width:340px;padding:40px;margin:auto;">
                <div style="padding:0 0 32px 0;">
                    <p style="margin:0;line-height:1.4em;color:#A2ABA5;font-size:12px;text-align:center;">
                        <a target="_blank" href="' . $server . '/eprocurement/"><img src="' . $server . '/eprocurement/assets/images/logoPerusahaan.jpg"></a></p>
                    <hr style="background:none;height:0;border-top:1px solid #cfcccf;border-bottom:1px solid white;border-right:0;border-left:0;margin:32px 0 0 0;">
                    <h1 style="margin:0 0 20px 0;line-height:1;color:#2E2621;font-size:24px;">Selamat "' . $agency . '" anda terpilih sebagai pemenang pada pelelangan "'.$judulLelang.'" dengan kode "'.$idLelang.'"</h1>
                    <p style="color:#A2ABA5;font-size:12px;margin:0 0 20px 0;line-height:1;">Ditetapkan tanggal ' . $tanggal . '</p>
                    <p style="font-size:16px;line-height:24px;margin:0 0 20px 0;">
                        Selamat Pagi, </p>
                    <p style="font-size:16px;line-height:24px;margin:0 0 20px 0;">
                        Anda hanya perlu menyetujui dan menandatangani surat kontrak yang kami lampirkan pada lampiran 
                        Anda telah menyetujui segala peraturan yang berlaku pada sistem pelelangan kami, dan atas segala 
                        kecurangan atau pelanggaran hukum yang terjadi, perusahaan Anda bersedia untuk di usut sesuai 
                        dengan peraturan yang berlaku.
                    </p>
                    <p style="font-size:16px;line-height:24px;margin:0 0 20px 0;">
                        Bila Anda mengabaikan pesan ini dan tidak ada konfirmasi lebih lanjut, pelelangan kami batalkan, selanjutnya
                        sesuai dengan peraturan pada sistem kami, perusahaan/agency Anda akan masuk ke dalam daftar hitam kami.
                    </p>
                    <p style="font-size:16px;line-height:24px;margin:0 0 20px 0;">
                        <strong>Admin Mitra Pembangunan Ciputri.</strong></p>
                    <div style="color:white;font-size:12px;background:#373C40;padding:32px 40px;">
                        <p style="line-height:1.6em;text-align:center;">
                            Copyright &copy; 2013, Ciputri Land Group. All rights reserved.
                            <br>
                            <a rel="nofollow" style="color:#ff5e00;" target="_blank" href="' . $server . '/eprocurement">Home Page</a> &mdash; 
                            <a rel="nofollow" style="color:#ff5e00;" target="_blank" href="' . $server . '/eprocurement/page/tentang-kami">Tentang Kami</a> &mdash; 
                            <a rel="nofollow" style="color:#ff5e00;" target="_blank" href="' . $server . '/eprocurement/page/bantuan">Bantuan</a>
                            <br>
                            <a rel="nofollow" target="_blank" href="#"><img src="' . $server . '/eprocurement/assets/images/social/twitter.png" alt="Twitter"></a>
                            <a rel="nofollow" target="_blank" href="#"><img src="' . $server . '/eprocurement/assets/images/social/facebook.png" alt="Facebook"></a>
                            <a rel="nofollow" target="_blank" href="#"><img src="' . $server . '/eprocurement/assets/images/social/google-plus.png" alt="Google Plus"></a>
                        </p>
                    </div>
                </div>
            </div></center>';
        $emailSent = mail($to, $subject, $message, $headers);
        return $emailSent ? "Mail sent" : "Mail failed";
    }

    public function sendEmailKontrak(){
        
        //$this->lelang = new lelang($idLelang);
        //$this->lelang->tampilLelang($idLelang);
        //$this->lelang->tampilPemenangLelang($idPemenang);
        
        // fpdf object
        $pdf = new FPDF();
        // generate a simple PDF (for more info, see http://fpdf.org/en/tutorial/)
        $pdf->AddPage();
        $pdf->SetFont("Arial", "B", 14);
        $pdf->Cell(40, 10, "this is a pdf example");
        
        // email stuff (change data below)
        $to = $this->member->getEmail($idPemenang);
        $from = "admin@eprocurement.meximas.com /r/n"; 
        $subject = 'Selamat, Anda telah memenangkan Lelang';
        $message = "<p>Please see the attachment.</p>";
        // a random hash will be necessary to send mixed content
        $separator = md5(time());
        // carriage return type (we use a PHP end of line constant)
        $eol = PHP_EOL;
        // attachment name
        $filename = "example.pdf";
        // encode data (puts attachment in proper format)
        $pdfdoc = $pdf->Output("", "S");
        $attachment = chunk_split(base64_encode($pdfdoc));
        // main header (multipart mandatory)
        $headers = "From: " . $from . $eol;
        $headers .= "MIME-Version: 1.0" . $eol;
        $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol . $eol;
        $headers .= "Content-Transfer-Encoding: 7bit" . $eol;
        $headers .= "This is a MIME encoded message." . $eol . $eol;
        // message
        $headers .= "--" . $separator . $eol;
        $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"" . $eol;
        $headers .= "Content-Transfer-Encoding: 8bit" . $eol . $eol;
        $headers .= $message . $eol . $eol;
        // attachment
        $headers .= "--" . $separator . $eol;
        $headers .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"" . $eol;
        $headers .= "Content-Transfer-Encoding: base64" . $eol;
        $headers .= "Content-Disposition: attachment" . $eol . $eol;
        $headers .= $attachment . $eol . $eol;
        $headers .= "--" . $separator . "--";
        // send message
        $emailSent = @mail($to, $subject, $message, $headers);
        return $emailSent;
        //echo $emailSent ? "Mail sent" : "Mail failed";
    }
}
?>