<?php
global $url;
?>
<br /><br /><br />
<div class="container marketing">
    <div class="row">
        <?php if(isset($_SESSION["user"]) && $_SESSION["user"]["admin"] == 1){
                print_r('<h2 class="pull-right"><a href="/eprocurement/admin/edit-page/'.$url.'"><span class="glyphicon glyphicon-pencil"></span></a></h2>');
            }
        ?>
        <?php
            switch($url){
                case 'contact-us':
        ?>
        <br/> <br/> 
        <div class="col-xs-2">
            <br />
            <center><h4><b>Kemana Saya Harus Menghubungi Jika Membutuhkan Bantuan?</b></h4>
                <p>Anda dapat menguhubungi kami melalui form yang telah disediakan ataupun langsung menghubungi ke Contact Person yang tersedia.</p>
                <p>Kami berusaha secepat mungkin merespon permintaan Anda.</p></center>
        </div>
        <div class="col-lg-8">
            <center><h2>Form Kontak Kami</h2>
                <form class="form-horizontal" method="POST" action="">
                    <input type="hidden" name="action" value="kontak">
                    <table class="table-hover" width="80%">
                        <tr>
                            <td>Username</td>
                            <td><input type="text" name="username" class="form-control" required placeholder="Username"></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><input type="email" name="email" class="form-control" required placeholder="Email"></td>
                        </tr>
                        <tr>
                            <td>Judul</td>
                            <td><input type="text" name="judul" class="form-control" required placeholder="Contoh: Lupa Password"></td>
                        </tr>
                        <tr>
                            <td>Pesan</td>
                            <td><textarea name="pesan" class="form-control" required></textarea></td>
                        </tr>
                        <tr>
                            <td colspan="2"><center><button name="submit" type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-send"></span> Kirim</button></center></td>
                        </tr>
                    </table>
                </form>
                <a href="/eprocurement/tiket/cek" class="btn btn-warning"><span class="glyphicon glyphicon-transfer"></span> Check Ticket</a>
            </center>
            <br />
            <div class="col-sm-offset-1 col-sm-8">
                <h4>Contact Person:</h4>
                <div><span class="glyphicon glyphicon-earphone"></span> +62 856 351 4370</div>
                <div><span class="glyphicon glyphicon-earphone"></span> +62 857 556 70204</div>
                <div><span class="glyphicon glyphicon-envelope"></span> admin@eprocurement.meximas.com</div>
                <div><span class="glyphicon glyphicon-home"></span> Kantor Pusat Marketing Ciputri: Jalan Maju Terus no 1 Malang, Indonesia</div>
                <center>
                    <a href="https://www.twitter.com/darkiendra"><img src="../assets/images/social/twitter.png" /></a>
                    <a href="https://www.facebook.com/fadel.trivandi"><img src="../assets/images/social/facebook.png" /></a>
                    <a href="https://plus.google.com/108302503561664025234/"><img src="../assets/images/social/google-plus.png" /></a>
                </center>
            </div>
        </div>
        <?php
                    break;
                case 'bantuan':
        ?>
                <center><h2>Bantuan</h2>
        </center>
        <h3 class="page-header" id="nav">Memulai: Pertanyaan yang Sering Ditanyakan (FAQs) dan Dasar</h3>
        <h3 class="page-header" id="dasar">Dasar</h3>
        <p>Untuk dapat selalu memberikan pelayanan yang prima, kami memberikan kemudahan kepada setiap user untuk dapat menggunakan Sistem Eprocurement Mitra Pembangunan Ciputri ini.
            Untuk dapat melihat seluruh daftar pelelangan yang ada, Anda sebagai sebuah Agency, Perusahaan ataupun Perusahaan Kecil dapat <a href="/eprocurement/#daftar"><strong>mendaftar</strong></a> untuk ikut serta bersama kami membangun dunia.
            Sesuai dengan tagline kami, yaitu: Help Us Build the World, Anda dapat membantu kami dengan melakukan penyediaan barang seperti yang kami butuhkan, sesuai dengan daftar lelang-lelang yang tersedia.
            Setelah login dengan menggunakan <i>email atau username</i>, disertakan dengan password yang Anda gunakan untuk mendaftar, Anda dapat menemukan semua menu navigasi yang Anda butuhkan di sebelah kiri Anda.
            Anda <strong>tidak dapat</strong> mengubah profil Anda, didasarkan kekhawatiran terjadi kecurangan ketika pemenang sudah di tetapkan, dimana Anda mengubah seluruh informasi yang terdapat pada akun Anda.
            Kami selalu menjaga kerahasiaan dan privacy Anda, sehingga Anda tidak perlu khawatir email yang Anda gunakan akan di gunakan sebagai target spam, dan lain sebagainya.
            Melalui menu navigasi, Anda dapat menemukan semua informasi lelang yang tersedia, yang masih bisa Anda ikuti, maupun yang sudah selesia.
            Anda bahkan dapat mengikuti status lelang yang sudah Anda ikuti, melalui menu navigasi <a href="/eprocurement/mengikuti/">mengikuti</a> (namun sebelumnya Anda harus login terlebih dahulu).
            Setelah pemenang dari suatu pelelangan di pilih, akan terdapat informasi yang menjelaskan pemenang, berserta alasan mengapa peserta lelang tersebut bisa menang.
        <h3 class="page-header" id="FAQ">FAQs</h3>
        <ul>
            <li>
                <i><b>Q: Bagaimana cara saya mendaftar pada Sistem ini?</b></i>
            </li>
            <li>
                <b>A</b>: Sangat mudah, Anda hanya perlu mendaftar melalui halaman utama, atau pada menu dropdown login, ataupun melalui <a href="/eprocurement/daftar">link ini</a>.
            </li>
            <li>
                <i><b>Q: Bagaimana cara login?</b></i>
            </li>
            <li>
                <b>A</b>: Sangat mudah, Anda dapat mengklik menu dropdown yang ada di bagian pojok kanan atas, dan memasukkan email atau username dan password Anda
            </li>
            <li>
                <i><b>Q: Bagaimana jika saya lupa password saya?</b></i>
            </li>
            <li>
                <b>A</b>: Anda dapat segera menghubungi kami melalui menu hubungi kami
            </li>
            <li>
                <i><b>Q: Bagaimana jika saya lupa password saya?</b></i>
            </li>
            <li>
                <b>A</b>: Anda dapat segera menghubungi kami melalui menu <a href="/eprocurement/page/contact-us">hubungi kami</a> yang dapat Anda temukan di bagian atas sebelah menu bantuan
            </li>
            <li>
                <i><b>Q: Bagaimana saya dapat mengikuti lelang?</b></i>
            </li>
            <li>
                <b>A</b>: Anda dapat terlebih dahulu melihat informasi lelang yang tersedia, lalu kemudian memilih menu ikut yang ada di bagian sebelah kanan pada tabel seluruh daftar lelang yang tersedia
            </li>
            <li>
                <i><b>Q: Saya salah memasukkan informasi lelang yang saya berikan, bagaimana cara mengubahnya?</b></i>
            </li>
            <li>
                <b>A</b>: Anda dapat secara langsung memilih menu ikut lelang yang sebelumnya, sistem akan secara otomatis mendeteksi apakah Anda sudah mengikuti lelang, atau Anda baru mau ikut serta mendaftar lelang
            </li>
            <li>
                <i><b>Q: Bagaimana saya bisa tahu mengenai Tahap lelang yang sudah saya ikuti?</b></i>
            </li>
            <li>
                <b>A</b>: Anda dapat mengklik menu tahap yang terdapat pada daftar lelang pada home Anda, untuk dapat melihat tanggal-tanggalnya, atau apabila Anda ingin melihat lelang yang Anda ikuti saja, Anda dapat mengklik menu <a href="/eprocurement/mengikuti">Lelang Diikuti</a> yang terdapat pada menu navigasi di sebelah kiri home Anda
            </li>
            <li>
                <i><b>Q: Saya sudah menekan link yang terdapat diatas, tapi page not found?</b></i>
            </li>
            <li>
                <b>A</b>: Anda harus login terlebih dahulu dengan menu login
            </li>
            <li>
                <i><b>Q: Saya ingin melihat informasi pemenang lelang, bagaimana saya melakukannya?</b></i>
            </li>
            <li>
                <b>A</b>: Anda dapat mengklik menu pemenang yang terdapat daftar lelang, namun menu pemenang hanya dapat di klik setelah lelang memiliki pemenang.
            </li>
            <li>
                <i><b>Q: Kenapa pengajuan saya tidak pernah menang lelang?</b></i>
            </li>
            <li>
                <b>A</b>: Mungkin penawaran Anda terlalu mahal, tidak memenuhi kualifikasi, tidak memiliki banyak fitur, ataupun wajah Anda kurang tampan
            </li>
            <li>
                <i><b>Q: Kenapa adminnya ganteng banget?</b></i>
            </li>
            <li>
                <b>A</b>: Wah, kalau itu admin juga tidak tau, sudah bawaan dari lahir mungkin ya :P
            </li>
        </ul>
        </p>
        <h3 class="page-header">Troubleshooting</h3>
        <p>
            Segala permasalahan, keluhan, kritik, saran, ataupun permasalahan seperti lupa password bisa ditanyakan langsung ke pada kami melalui <a href="/eprocurement/page/contact-us"><strong>form hubungi kami</strong></a>, yang dapat anda temukan dibagian atas di sebelah bantuan.
            apabila akun Anda mengalami permasalahan seperti lupa password, tidak dapat di access, dan lain sebagainya akan kami tanggapi dan tindak lanjuti secepatnya.
        </p>
        <?php
                    break;
                case 'privacy-policy':
        ?>
        <center><h2 class="page-header">Syarat dan Ketentuan</h2></center>
        <br/>
        <ol type="A">
            <li><strong>KETENTUAN UMUM</strong></li>
            <p>
            <ol type="1">
                <li>Sitem Mitra Pembangunan Ciputri selanjutnya disingkat MPC adalah sistem yang dibentuk
                    untuk menyelenggarakan sistem pelayanan pengadaan barang/jasa secara elektronik.</li>
                <li>Aplikasi SPSE adalah aplikasi perangkat lunak Sistem Pengadaan Secara Elektronik (SPSE)
                    berbasis web yang terpasang di <em>server</em> MPC yang dapat diakses melalui <em>website</em>
                    <?php echo $_SERVER["HTTP_HOST"]?>.</li>
                <li>Pengguna SPSE adalah perorangan/badan usaha yang memiliki hak akses kepada aplikasi SPSE,
                    direpresentasikan oleh <em>username</em> dan <em>password</em> yang diberikan oleh MPC,
                    antara lain Pejabat Pembuat Komitmen (PPK), Kelompok Kerja Unit Layanan Pengadaan (Pokja ULP),
                    Penyedia Barang/Jasa.</li>
                <li><em>username</em> adalah nama atau pengenal unik sebagai identitas diri dari Pengguna yang
                    digunakan untuk beroperasi di dalam aplikasi SPSE.</li>
                <li><em>password</em> adalah kumpulan karakter atau <em>string</em> yang digunakan oleh Pengguna
                    untuk memvalidasi login <em>username</em> kepada aplikasi SPSE.</li>
                <li><em>username</em> dan <em>password</em> yang masih aktif dapat digunakan oleh Pengguna untuk
                    mengikuti pengadaan dan aktivitas lain dalam aplikasi SPSE pada MPC yang bersangkutan terdaftar
                    atau MPC lain yang telah teragregasi.</li>
                <li>Pengguna dapat melaksanakan proses pengadaan barang/jasa secara elektronik dari lokasi lain 
                    yang terhubung dengan <em>internet</em> (misal: kantor Pengguna, warung <em>internet</em>,
                    <em>hotspot</em> umum dan lain-lain) dan tersambung ke jaringan <em>internet</em>.</li>
                <li>Pengguna dapat mengganti <em>password</em> sesuai dengan keinginannya, dan menjaganya agar 
                    selalu bersifat rahasia.</li>
                <li>Waktu yang digunakan untuk proses pengadaan melalui <em>website</em> MPC adalah waktu dari <em>server</em>
                    MPC setempat.</li>
                <li>Dengan menjadi Pengguna SPSE maka Pengguna dianggap telah memahami/mengerti dan menyetujui
                    semua isi di dalam Persyaratan dan Ketentuan Penggunaan Sistem Pengadaan Secara Elektronik,
                    Panduan Pengguna, dan ketentuan lain yang diterbitkan oleh <strong>Ciputri Land Group (CLG)</strong>.</li>
            </ol>
            </p>
            <br/>
            <li><strong>KEANGGOTAAN PENGGUNA</strong></li>
            <ol type="1"><br/>
                <li><strong>Registrasi Pengguna</strong></li>
                <ol type="a">
                    <li>Pejabat Pembuat Komitmen (PPK) dan ULP mengajukan permintaan sebagai Pengguna
                        SPSE kepada pengelola MPC dengan menunjukan surat tugas/surat keputusan/surat penunjukan 
                        yang berlaku.</li>
                    <li>Penyedia barang/jasa melakukan pendaftaran secara <em>online</em> pada <em>website</em> 
                        MPC dan selanjutnya mengikuti proses verifikasi dokumen pendukung yang dipersyaratkan oleh MPC.</li>
                    <li>Dengan membuat dan/atau mendaftar sebagai peserta lelang pada paket pekerjaan dalam SPSE, maka PPK/ULP
                        dan Penyedia barang/jasa telah memberikan persetujuannya pada Pakta Integritas.</li>
                </ol>
                <br/>
                <li><strong>Kewajiban Pengguna</strong></li><ol type="a">
                    <li>Memenuhi ketentuan peraturan perundang-undangan dan kebijakan yang berlaku dalam pengadaan barang/jasa.</li>
                    <li>Masing-masing Penyedia barang/jasa hanya diperkenankan memiliki 1 (satu) <em>username</em> dan <em>password</em> 
                        untuk <em>roaming</em> pada MPC yang telah teragregasi. Pada kondisi MPC belum teragregasi penyedia memungkinkan
                        memiliki lebih dari 1 (satu) <em>username</em> dan <em>Password</em> sesuai dengan jumlah MPC tempat penyedia mendaftar.</li>
                    <li>Setiap Pengguna bertanggungjawab melindungi kerahasiaan hak akses, dan aktivitas lainnya pada SPSE.</li>
                    <li>Setiap penyalahgunaan hak akses oleh pihak lain menjadi tanggung jawab pemilik <em>username</em> dan <em>password</em>.</li>
                    <li>Penyedia barang/jasa wajib memutakhirkan data kualifikasi (jika terjadi perubahan seperti alamat, 
                        status kepemilikan, kondisi keuangan, kontak person, klasifikasi bidang usaha, jenis barang/jasa
                        yang disediakan, dan data atau informasi lain yang dianggap perlu dalam SPSE).</li>
                    <li>Menjaga kerahasiaan dan mencegah penyalahgunaan data dan informasi yang tidak diperuntukkan bagi
                        khalayak umum.</li><li>Penyedia barang/jasa bertanggung jawab terhadap setiap kekeliruan dan/atau
                        kelalaian atas penggunaan data kualifikasi yang tidak mutakhir (update) yang tidak menjadi tanggung
                        jawab MPC maupun ULP. </li></ol><br/><li><strong>Ketentuan Pengguna</strong>
                        </li>
                        <ol type="a">
                            <li>Pengguna setuju bahwa transaksi yang dilakukan melalui SPSE tidak boleh melanggar peraturan 
                                perundang-undangan yang berlaku di Indonesia.</li>
                            <li>Pengguna wajib tunduk dan taat pada semua peraturan yang berlaku di Indonesia yang berhubungan
                                dengan penggunaan jaringan dan komunikasi data baik di wilayah Indonesia maupun dari dan keluar
                                wilayah Indonesia melalui <em>website</em> MPC.</li>
                            <li>Pengguna bertanggungjawab penuh atas isi transaksi yang dilakukan dengan menggunakan SPSE.</li>
                            <li>Pengguna dilarang saling mengganggu proses transaksi dan/atau layanan lain yang dilakukan dalam SPSE.</li>
                            <li>Pengguna setuju bahwa usaha untuk memanipulasi data, mengacaukan sistem elektronik dan jaringannya
                                adalah tindakan melanggar hukum.</li>
                        </ol><br/>
                                <li><strong>Pembatalan Keanggotaan Pengguna</strong></li>
                                <ol type="a">
                                    <li>Pengelola MPC berhak menunda/menghalangi sementara/membatalkan hak akses Pengguna apabila 
                                        ditemukan adanya informasi/transaksi/aktivitas lain yang tidak dibenarkan sesuai ketentuan
                                        yang berlaku.</li>
                                    <li>Pengguna mengundurkan diri dengan cara mengirimkan surat permohonan dan disampaikan kepada
                                        pengelola MPC (tempat Pengguna terdaftar) yang dapat dikirimkan melalui sarana elektronik
                                        (<em>email</em>).</li>
                                </ol>
            </ol><br/>
            <li><strong>TANGGUNG JAWAB DAN AKIBAT</strong></li>
            <ol type="1">
                <li>CLG dan afiliasinya tidak bertanggung jawab atas semua akibat karena keterlambatan/kesalahan/kerusakan penerimaan data pengadaan yang terjadi pada SPSE yang dilakukan Pengguna dan pihak lain.</li>
                <li>CLG dan afiliasinya tidak bertanggung jawab atas semua akibat adanya gangguan infrastruktur yang berakibat pada terganggunya proses penggunaan SPSE.</li>
                <li>CLG dan afiliasinya tidak bertanggung jawab atas segala akibat penyalahgunaan yang dilakukan oleh Pengguna atau pihak lain.</li>
                <li>CLG dan afiliasinya tidak menjamin SPSE berlangsung terus secara tepat, handal/tanpa adanya gangguan. </li>
                <li>Lembaga Sandi Negara dan CLG berusaha terus meningkatkan dan memperbaiki <em>performance</em> aplikasinya. </li>
                <li>CLG dan afiliasinya dapat membantu pengguna SPSE terkait dengan penyelesaian kesalahan penggunaan atau penyelesaian keterbatasan fasilitas aplikasi namun tidak bertanggungjawab atas hasil yang diakibatkan oleh tindakannya.</li>
                <li>CLG dan afiliasinya dapat melakukan suatu tindakan yang dianggap perlu terhadap <em>file-file</em> yang dinyatakan tidak dapat didekripsi atau dapat didekripsi dengan menggunakan namun salah satu/beberapa/semua <em>file</em> tidak bisa dibuka oleh ULP.</li>
                <li>Pengguna menanggung segala akibat terhadap dokumen (<em>file</em>) yang tidak dapat dilakukannya proses dekripsi atau tidak dapat dibukanya salah satu/beberapa/semua <em>file</em> akibat dari kesalahan dan/atau kelalaian penggunaan.</li>
                <li>Pengguna bertanggung jawab atas segala resiko dan tidak terbatas pada tidak dapat dilanjutkannya proses pengadaan barang/jasa apabila dalam penggunaan SPSE tidak mengindahkan ketentuan ini.</li></ol><br/>
                <li><strong>PERSELISIHAN</strong></li>
                <p>Perselisihan yang terjadi antara Pengguna dan CLG dan/atau afiliasinya diselesaikan melalui musyawarah untuk mufakat. Apabila musyawarah tidak dapat mencapai mufakat, pengguna dan CLG sepakat untuk membawa kasus tersebut ke pengadilan yang berada di wilayah Indonesia.</p><br/>
                <li><strong>HAK CIPTA</strong></li>
                <ol type="1">
                    <li>Pengguna atau pihak lain dilarang mengutip atau meng-<em>copy</em> sebagian atau seluruh isi yang terdapat di dalam SPSE tanpa ijin tertulis dari CLG. Pelanggaran atas ketentuan ini akan dituntut dan digugat berdasarkan peraturan hukum pidana dan perdata yang berlaku di Indonesia.</li>
                    <li>Pengguna setuju tidak akan dengan cara apapun memanfaatkan, memperbanyak, atau berperan dalam penjualan/menyebarkan setiap isi yang diperoleh dari SPSE untuk kepentingan pribadi dan/atau komersial.</li></ol><br/>
                    <li><strong>PERUBAHAN</strong></li>
                    <ol type="1">
                        <li>CLG dan afiliasinya berhak/dapat menambah, mengurangi, memperbaiki aturan dan ketentuan SPSE ini setiap saat, dengan atau tanpa pemberitahuan sebelumnya.</li>
                        <li>CLG dan afiliasinya berhak/dapat menambah, mengurangi, memperbaiki fasilitas yang disediakan aplikasi ini setiap saat, dengan atau tanpa pemberitahuan sebelumnya. </li>
                        <li>Pengguna wajib taat kepada aturan dan ketentuan yang telah ditambah, dikurangi, diperbaiki tersebut. Apabila pengguna tidak setuju dapat mengajukan keberatan dan mengundurkan diri dari keikutsertaannya sebagai Pengguna SPSE. </li>
                        <li>Dengan maupun tanpa alasan, CLG dan afiliasinya berhak menghentikan penggunaan SPSE dan akses jasa ini tanpa menanggung kewajiban apapun kepada pengguna apabila penghentian operasional ini terpaksa dilakukan.</li>
                    </ol>
        </ol>
        <?php
                    break;
                case 'tentang-kami':
        ?>
         <center><h2>Tentang Kami</h2>
            <img src="/eprocurement/assets/images/logoPerusahaan.jpg">
        </center>
        <h3 class="page-header">Latar Belakang</h3>
        <p>Mitra Pembangunan Ciputri adalah sebuah sistem e-procurement yang menyediakan sebuah pelelangan supply yang dalam kasus ini adalah material bangunan seperti semen, batu bata, dan lain sebagainya. Melalui sistem kami, admin dan pemilik modal dari ciputri akan lebih mudah untuk mendapatkan informasi mengenai supply bahan yang akan digunakan untuk membangun perumahan yang sejuk nan asri. Sistem kami akan melakukan pengurutan atau sorting berdasarkan fitur-fitur yang diinginkan oleh admin. Dengan demikian, pencarian pemenang lelang akan lebih mudah, lebih cepat dan lebih efisien.</p>
        <h3 class="page-header">Nilai Tambah</h3>
        <p>
        <ol>
            <li>Sistem kami menyajikan interface sederhana dan ramah pengguna, sehingga setiap user yang ingin mengajukan tender akan lebih mudah untuk melakukan submission product mereka.</li>
            <li>Sistem kami disajikan secara online sehingga dapat di akses dengan mudah kapan saja dan di mana saja.</li>
            <li>Sistem kami menggunakan sistem sorting dengan penentu variabel-variabel penentu untuk menentukan pilihan sementara yang kemudian akan dikaji ulang oleh admin.</li>
        </ol>
        </p>
        <h3 class="page-header">Filosofi Perusahaan</h3>
        <p>
        <ul>
            <li>Kami memilih warna hijau karena warna hijau menandakan warna alam, sehat dan segar sehingga bisa menyegarkan pikiran.</li>
            <li>Sedangkan warna coklat menandakan unsur energi, keseimbangan, tanah/bumi.</li>
            <li>Kami lebih menekankan hunian yang indah, asri dan mengedepankan  sisi alam.</li>
            <li>“Green Living Solution” menandakan bahwa perusahaan ini mengedepankan visi misi tentang hidup sehat dan alami.</li>
            <li>Pohon dengan jumlah daun yang banyak, menggambarkan bahwasanya perusahaan kami ingin mengembangkan perusahaan kami secara global.</li>
            <li>Daun gugur, menggambarkan unsur regenerasi. Sehingga bangunan dari perusahaan yang kami bangun diharapkan dapat digunakan dari generasi ke generasi.  </li>
        </ul>
        </p>
        <h3 class="page-header">Profil Pengembang</h3>
        <div class="row">
            <div class="col-lg-10"><h4 class="panel-title">Project Manager</h4>
                <p>
                <ul>
                    <li><strong>Nama</strong>: Harim Adi Saputro</li>
                    <li><strong>Tempat/Tanggal Lahir</strong>: Tulung Agung, 12 Februari 1993</li>
                    <li><strong>Pendidikan Terakhir</strong>:: S-1 Informatika Universitas Brawijaya</li>
                    <li><strong>Bidang Konsentrasi</strong>:: Artificial Intelligence(Kecerdasan Visual)</li>
                </ul>
                </p>
            </div>
            <div class="col-xs-2">
                <img class="img-circle" data-src="holder.js/140x140" alt="140x140" style="width: 100px; height: 100px;" src="/eprocurement/assets/images/tentang/harim.jpg">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10"><h4 class="panel-title">Designer</h4>
                <p>
                <ul>
                    <li><strong>Nama</strong>: Indrahidayati Nur Rohmah</li>
                    <li><strong>Tempat/Tanggal Lahir</strong>: Sidoarjo, 13 Juni 1993</li>
                    <li><strong>Pendidikan Terakhir</strong>:: S-1 Informatika Universitas Brawijaya</li>
                    <li><strong>Bidang Konsentrasi</strong>:: Game & Multimedia</li>
                </ul>
                </p>
            </div>
            <div class="col-xs-2">
                <img class="img-circle" data-src="holder.js/140x140" alt="140x140" style="width: 100px; height: 100px;" src="/eprocurement/assets/images/tentang/indra.jpg">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10"><h4 class="panel-title">Documentation</h4>
                <p>
                <ul>
                    <li><strong>Nama</strong>: Ayu Leonitami</li>
                    <li><strong>Tempat/Tanggal Lahir</strong>: Malang, 1993</li>
                    <li><strong>Pendidikan Terakhir</strong>:</strong>: S-1 Informatika Universitas Brawijaya</li>
                    <li><strong>Bidang Konsentrasi</strong>:</strong>: Game & Multimedia</li>
                </ul>
                </p>
            </div>
            <div class="col-xs-2">
                <img class="img-circle" data-src="holder.js/140x140" alt="140x140" style="width: 100px; height: 100px;" src="/eprocurement/assets/images/tentang/leon.jpg">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10">
                <p>
                <ul>
                    <li><strong>Nama</strong>: Atiqotuzzumah</li>
                    <li><strong>Tempat/Tanggal Lahir</strong>:  1993</li>
                    <li><strong>Pendidikan Terakhir</strong>:: S-1 Informatika Universitas Brawijaya</li>
                    <li><strong>Bidang Konsentrasi</strong>:: Networking (Jaringan)</li>
                </ul>
                </p>
            </div>
            <div class="col-xs-2">
                <img class="img-circle" data-src="holder.js/140x140" alt="140x140" style="width: 100px; height: 100px;" src="/eprocurement/assets/images/tentang/tiqo.jpg">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10"><h4 class="panel-title">Programmer</h4>
                <p>
                <ul>
                    <li><strong>Nama</strong>: Fadel Trivandi Dipantara (파델 트리판디 디판타라)</li>
                    <li><strong>Tempat/Tanggal Lahir</strong>: Bekasi, 8 Desember 1993</li>
                    <li><strong>Pendidikan Terakhir</strong>:</strong>: S-1 Informatika Universitas Brawijaya</li>
                    <li><strong>Bidang Konsentrasi</strong>:</strong>: Game & Multimedia</li>
                </ul>
                </p>
            </div>
            <div class="col-xs-2">
                <img class="img-circle" data-src="holder.js/140x140" alt="140x140" style="width: 100px; height: 100px;" src="/eprocurement/assets/images/tentang/fadel.jpg">
            </div>
        </div>
        <?php 
                    break;
            }
        ?>
    </div>