<?php

if(!shortcode_exists('ppdb')){
    add_shortcode('ppdb','homePublicFormPage');
}


if(!function_exists('homePublicFormPage')){
    function homePublicFormPage(){
        session_start();
        $process = false;
        if(isset($_POST['hasil']) && isset($_SESSION['hasil']) && $_POST['hasil'] == $_SESSION['hasil']){
            //---------------
            //PROSES DATA
            //---------------
            $process = publicFormController();
            //---------------
            //END PROSES DATA
            //---------------
        }

        //---------------
        //PERSIAPKAN DATA
        //---------------
        global $wp;
        $tahun_ajarans = get('ppdb_tahun_ajarans',"status = 1");
        $condition = '';
        if(isset($_GET['siswa_pendidikan_id']) && isset($_GET['tahun_ajaran_id'])){
            $condition = " pendidikan_id = ".$_GET['siswa_pendidikan_id']." AND tahun_ajaran_id = ".$_GET['tahun_ajaran_id'];
        }
        $gelombangs = get('ppdb_gelombangs',$condition);
        $pendidikans = get('ppdb_pendidikans');
        //---------------
        //END PERSIAPKAN DATA
        //---------------

        //---------------
        //CAPTCA
        //---------------
        $_SESSION['satu'] = rand(1,20);
        $_SESSION['dua'] = rand(1,10);
        $_SESSION['hasil'] = $_SESSION['satu'] + $_SESSION['dua'];
        //---------------
        //END CAPTCA
        //---------------

        ?>  
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>                        
            <style>
                body {
                    background-color: white;
                }
            </style>
            <div style="margin-right: 20px;">
                <h1>Data Pendaftaran</h1>
                <div class="row">
                    <h3>Data Calon Siswa</h3>
                </div>                
                <div class="row">
                    <div class="col-lg-6">
                        <form action="" method="POST">
                            <input type="hidden" name="id" value="<?php echo (isset($data->id)) ? $data->id : ''; ?>" / >
                            <div class="form-control">
                                <label for="exampleInputEmail1">Jenjang Pendidikan</label>
                                <select name="siswa_pendidikan_id" class="form-control form-control-lg" id="siswa_pendidikan_id" aria-describedby="siswa_pendidikan_id" required onchange="pendidikanId(this.value);">
                                    <?php
                                        foreach($pendidikans as $pendidikan):
                                    ?>
                                    <option value="<?php echo $pendidikan->id; ?>" <?php echo (isset($data->siswa_pendidikan_id) && $pendidikan->id == $data->siswa_pendidikan_id) ? 'selected' : ((isset($_GET['siswa_pendidikan_id']) && $_GET['siswa_pendidikan_id'] == $pendidikan->id) ? 'selected' : ''); ?>><?php echo $pendidikan->pendidikan; ?></option>
                                    <?php
                                        endforeach
                                    ?>
                                </select>
                            </div>
                            <div class="form-control">
                                <label for="exampleInputEmail1">Tahun Ajaran</label>
                                <select name="tahun_ajaran_id" class="form-control form-control-lg" id="tahun_ajaran_id" aria-describedby="tahun_ajaran_id" required>
                                    <?php
                                        foreach($tahun_ajarans as $tahun_ajaran):
                                    ?>
                                    <option value="<?php echo $tahun_ajaran->id; ?>" <?php echo (isset($data->tahun_ajaran_id) && $tahun_ajaran->id == $data->tahun_ajaran_id) ? 'selected' : ((isset($_GET['tahun_ajaran_id']) && $_GET['tahun_ajaran_id'] == $tahun_ajaran->id) ? 'selected' : ''); ?>><?php echo $tahun_ajaran->tahun_ajaran; ?></option>
                                    <?php
                                        endforeach
                                    ?>
                                </select>
                            </div>
                            <div class="form-control">
                                <label for="exampleInputEmail1">Gelombang</label>
                                <select name="gelombang_id" class="form-control form-control-lg" id="gelombang_id" aria-describedby="gelombang_id" required>
                                    <?php
                                        foreach($gelombangs as $gelombang):
                                    ?>
                                    <option value="<?php echo $gelombang->id; ?>" <?php echo (isset($data->gelombang_id) && $gelombang->id == $data->gelombang_id) ? 'selected' : ''; ?>><?php echo $gelombang->gelombang; ?></option>
                                    <?php
                                        endforeach
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Calon Siswa</label>
                                <input type="text" class="form-control form-control-lg" id="siswa_nama_lengkap" aria-describedby="siswa_nama_lengkap" placeholder="Nama Calon Siswa" name="siswa_nama_lengkap" value="<?php echo (isset($data->siswa_nama_lengkap)) ? $data->siswa_nama_lengkap : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tempat Lahir</label>
                                <input type="text" class="form-control form-control-lg" id="siswa_lahir_tmpt" aria-describedby="siswa_lahir_tmpt" placeholder="Tempat Lahir" name="siswa_lahir_tmpt" value="<?php echo (isset($data->siswa_lahir_tmpt)) ? $data->siswa_lahir_tmpt : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Lahir</label>
                                <input type="date" class="form-control form-control-lg" id="siswa_lahir_tgl" aria-describedby="siswa_lahir_tgl" placeholder="Tanggal Lahir" name="siswa_lahir_tgl" value="<?php echo (isset($data->siswa_lahir_tgl)) ? toDate($data->siswa_lahir_tgl, 'Y-m-d') : ''; ?>" required>
                            </div>
                    </div>
                    <div class="col-lg-6">
                            <div class="form-control">
                                <label for="exampleInputEmail1">Pendidikan Terakhir</label>
                                <select name="siswa_pendidikan_akhir" class="form-control form-control-lg" id="siswa_pendidikan_akhir" aria-describedby="siswa_pendidikan_akhir" required>
                                    <option value="PAUD/RA" <?php echo (isset($data->siswa_pendidikan_akhir) && $data->siswa_pendidikan_akhir == 'PAUD/RA') ? 'selected' : ''; ?>>PAUD/RA</option>
                                    <option value="TK/TPA" <?php echo (isset($data->siswa_pendidikan_akhir) && $data->siswa_pendidikan_akhir == 'TK/TPA') ? 'selected' : ''; ?>>TK/TPA</option>
                                    <option value="SD/MI" <?php echo (isset($data->siswa_pendidikan_akhir) && $data->siswa_pendidikan_akhir == 'SD/MI') ? 'selected' : ''; ?>>SD/MI</option>
                                    <option value="SMP/MTs" <?php echo (isset($data->siswa_pendidikan_akhir) && $data->siswa_pendidikan_akhir == 'SMP/MTs') ? 'selected' : ''; ?>>SMP/MTs</option>
                                    <option value="SMA/MA" <?php echo (isset($data->siswa_pendidikan_akhir) && $data->siswa_pendidikan_akhir == 'SMA/MA') ? 'selected' : ''; ?>>SMA/MA</option>
                                    <option value="Paket A" <?php echo (isset($data->siswa_pendidikan_akhir) && $data->siswa_pendidikan_akhir == 'Paket A') ? 'selected' : ''; ?>>Paket A</option>
                                    <option value="Paket B" <?php echo (isset($data->siswa_pendidikan_akhir) && $data->siswa_pendidikan_akhir == 'Paket B') ? 'selected' : ''; ?>>Paket B</option>
                                    <option value="Paket C" <?php echo (isset($data->siswa_pendidikan_akhir) && $data->siswa_pendidikan_akhir == 'Paket C') ? 'selected' : ''; ?>>Paket C</option>
                                    <option value="Lainnya" <?php echo (isset($data->siswa_pendidikan_akhir) && $data->siswa_pendidikan_akhir == 'Lainnya') ? 'selected' : ''; ?>>Lainnya</option>
                                </select>
                            </div>
                            <div class="form-control">
                                <label for="exampleInputEmail1">Status Dalam Keluarga</label>
                                <select name="siswa_status_keluarga" class="form-control form-control-lg" id="siswa_status_keluarga" aria-describedby="siswa_status_keluarga" required>
                                    <option value="Anak Kandung" <?php echo (isset($data->siswa_status_keluarga) && $data->siswa_status_keluarga == 'Anak Kandung') ? 'selected' : ''; ?>>Anak Kandung</option>
                                    <option value="Anak Angkat" <?php echo (isset($data->siswa_status_keluarga) && $data->siswa_status_keluarga == 'Anak Angkat') ? 'selected' : ''; ?>>Anak Angkat</option>
                                    <option value="Anak Tiri" <?php echo (isset($data->siswa_status_keluarga) && $data->siswa_status_keluarga == 'Anak Tiri') ? 'selected' : ''; ?>>Anak Tiri</option>
                                    <option value="Lainnya" <?php echo (isset($data->siswa_status_keluarga) && $data->siswa_status_keluarga == 'Lainnya') ? 'selected' : ''; ?>>Lainnya</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Berat Badan</label>
                                <input type="number" class="form-control form-control-lg" id="siswa_berat_badan" aria-describedby="siswa_berat_badan" placeholder="Berat Badan" name="siswa_berat_badan" value="<?php echo (isset($data->siswa_berat_badan)) ? $data->siswa_berat_badan : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tinggi Badan</label>
                                <input type="number" class="form-control form-control-lg" id="siswa_tinggi_badan" aria-describedby="siswa_tinggi_badan" placeholder="Tinggi Badan" name="siswa_tinggi_badan" value="<?php echo (isset($data->siswa_tinggi_badan)) ? $data->siswa_tinggi_badan : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Riwayat Penyakit</label>
                                <input type="text" class="form-control form-control-lg" id="siswa_riwayat_penyakit" aria-describedby="siswa_riwayat_penyakit" placeholder="Riwayat Penyakit" name="siswa_riwayat_penyakit" value="<?php echo (isset($data->siswa_riwayat_penyakit)) ? $data->siswa_riwayat_penyakit : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Keterangan</label>
                                <input type="text" class="form-control form-control-lg" id="keterangan" aria-describedby="keterangan" placeholder="Riwayat Penyakit" name="keterangan" value="<?php echo (isset($data->keterangan)) ? $data->keterangan : ''; ?>">
                            </div>
                    </div>
                </div>
                <hr />
                <br />
                <div class="row">
                    <div class="col-lg-6">
                            <h3>Data Ayah</h3>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nomor HP/WA Wali/Orang Tua Calon Siswa</label>
                                <input type="text" class="form-control form-control-lg" id="ayah_no_hp" aria-describedby="ayah_no_hp" placeholder="Nomor HP/WA Wali/Orang Tua Calon Siswa" name="ayah_no_hp" value="<?php echo (isset($data->ayah_no_hp)) ? $data->ayah_no_hp : ''; ?>" required>
                            </div>
                            <div class="form-control">
                                <label for="exampleInputEmail1">Status Dalam Keluarga</label>
                                <select name="ayah_status" class="form-control form-control-lg" id="ayah_status" aria-describedby="ayah_status" required>
                                    <option value="Ayah Kandung" <?php echo (isset($data->ayah_status) && $data->ayah_status == 'Ayah Kandung') ? 'selected' : ''; ?>>Ayah Kandung</option>
                                    <option value="Ayah Tiri" <?php echo (isset($data->ayah_status) && $data->ayah_status == 'Ayah Tiri') ? 'selected' : ''; ?>>Ayah Tiri</option>
                                    <option value="Ayah Angkat" <?php echo (isset($data->ayah_status) && $data->ayah_status == 'Ayah Angkat') ? 'selected' : ''; ?>>Ayah Angkat</option>
                                    <option value="Wali" <?php echo (isset($data->ayah_status) && $data->ayah_status == 'Wali') ? 'selected' : ''; ?>>Wali</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Ayah</label>
                                <input type="text" class="form-control form-control-lg" id="ayah_nama" aria-describedby="ayah_nama" placeholder="Nama Ayah Calon Siswa" name="ayah_nama" value="<?php echo (isset($data->ayah_nama)) ? $data->ayah_nama : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tempat Lahir Ayah</label>
                                <input type="text" class="form-control form-control-lg" id="ayah_lahir_tmpt" aria-describedby="ayah_lahir_tmpt" placeholder="Tempat Lahir Ayah" name="ayah_lahir_tmpt" value="<?php echo (isset($data->ayah_lahir_tmpt)) ? $data->ayah_lahir_tmpt : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Lahir Ayah</label>
                                <input type="date" class="form-control form-control-lg" id="ayah_lahir_tgl" aria-describedby="ayah_lahir_tgl" placeholder="Tanggal Lahir Ayah" name="ayah_lahir_tgl" value="<?php echo (isset($data->ayah_lahir_tgl)) ? toDate($data->ayah_lahir_tgl,'Y-m-d') : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Pekerjaan Ayah</label>
                                <input type="text" class="form-control form-control-lg" id="ayah_pekerjaan" aria-describedby="ayah_pekerjaan" placeholder="Pekerjaan Ayah" name="ayah_pekerjaan" value="<?php echo (isset($data->ayah_pekerjaan)) ? $data->ayah_pekerjaan : ''; ?>" required>
                            </div>
                            <div class="form-control">
                                <label for="exampleInputEmail1">Penghasilan Ayah</label>
                                <select name="ayah_penghasilan" class="form-control form-control-lg" id="ayah_penghasilan" aria-describedby="ayah_penghasilan" required>
                                    <option value="< Rp. 5.000.000" <?php echo (isset($data->ayah_penghasilan) && $data->ayah_penghasilan == '< Rp. 5.000.000') ? 'selected' : ''; ?>>< Rp. 5.000.000</option>
                                    <option value="Rp. 5.000.000 - Rp. 1.000.000" <?php echo (isset($data->ayah_penghasilan) && $data->ayah_penghasilan == 'Rp. 5.000.000 - Rp. 1.000.000') ? 'selected' : ''; ?>>Rp. 5.000.000 - Rp. 1.000.000</option>
                                    <option value="Rp. 1.000.001 - Rp. 2.000.000" <?php echo (isset($data->ayah_penghasilan) && $data->ayah_penghasilan == 'Rp. 1.000.001 - Rp. 2.000.000') ? 'selected' : ''; ?>>Rp. 1.000.001 - Rp. 2.000.000</option>
                                    <option value="Rp. 2.000.001 - Rp. 3.000.000" <?php echo (isset($data->ayah_penghasilan) && $data->ayah_penghasilan == 'Rp. 2.000.001 - Rp. 3.000.000') ? 'selected' : ''; ?>>Rp. 2.000.001 - Rp. 3.000.000</option>
                                    <option value="Rp. 3.000.001 - Rp. 4.000.000" <?php echo (isset($data->ayah_penghasilan) && $data->ayah_penghasilan == 'Rp. 3.000.001 - Rp. 4.000.000') ? 'selected' : ''; ?>>Rp. 3.000.001 - Rp. 4.000.000</option>
                                    <option value="Rp. 4.000.001 - Rp. 5.000.000" <?php echo (isset($data->ayah_penghasilan) && $data->ayah_penghasilan == 'Rp. 4.000.001 - Rp. 5.000.000') ? 'selected' : ''; ?>>Rp. 4.000.001 - Rp. 5.000.000</option>
                                    <option value="Rp. 5.000.001 - Rp. 10.000.000" <?php echo (isset($data->ayah_penghasilan) && $data->ayah_penghasilan == 'Rp. 5.000.001 - Rp. 10.000.000') ? 'selected' : ''; ?>>Rp. 5.000.001 - Rp. 10.000.000</option>
                                    <option value="> Rp. 10.000.000" <?php echo (isset($data->ayah_penghasilan) && $data->ayah_penghasilan == '> Rp. 10.000.000') ? 'selected' : ''; ?>>> Rp. 10.000.000</option>
                                </select>
                            </div>
                    </div>
                    <div class="col-lg-6">
                            <h3>Data Ibu</h3>
                            <div class="form-control">
                                <label for="exampleInputEmail1">Status Dalam Keluarga</label>
                                <select name="ibu_status" class="form-control form-control-lg" id="ibu_status" aria-describedby="ibu_status" required>
                                    <option value="Ibu Kandung" <?php echo (isset($data->ibu_status) && $data->ibu_status == 'Ibu Kandung') ? 'selected' : ''; ?>>Ibu Kandung</option>
                                    <option value="Ibu Tiri" <?php echo (isset($data->ibu_status) && $data->ibu_status == 'Ibu Tiri') ? 'selected' : ''; ?>>Ibu Tiri</option>
                                    <option value="Ibu Angkat" <?php echo (isset($data->ibu_status) && $data->ibu_status == 'Ibu Angkat') ? 'selected' : ''; ?>>Ibu Angkat</option>
                                    <option value="Wali" <?php echo (isset($data->ibu_status) && $data->ibu_status == 'Wali') ? 'selected' : ''; ?>>Wali</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Ibu</label>
                                <input type="text" class="form-control form-control-lg" id="ibu_nama" aria-describedby="ibu_nama" placeholder="Nama Ibu Calon Siswa" name="ibu_nama" value="<?php echo (isset($data->ibu_nama)) ? $data->ibu_nama : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tempat Lahir Ibu</label>
                                <input type="text" class="form-control form-control-lg" id="ibu_lahir_tmpt" aria-describedby="ibu_lahir_tmpt" placeholder="Tempat Lahir Ibu" name="ibu_lahir_tmpt" value="<?php echo (isset($data->ibu_lahir_tmpt)) ? $data->ibu_lahir_tmpt : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Lahir Ibu</label>
                                <input type="date" class="form-control form-control-lg" id="ibu_lahir_tgl" aria-describedby="ibu_lahir_tgl" placeholder="Tanggal Lahir Ibu" name="ibu_lahir_tgl" value="<?php echo (isset($data->ibu_lahir_tgl)) ? toDate($data->ibu_lahir_tgl,'Y-m-d') : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Pekerjaan Ibu</label>
                                <input type="text" class="form-control form-control-lg" id="ibu_pekerjaan" aria-describedby="ibu_pekerjaan" placeholder="Pekerjaan Ibu" name="ibu_pekerjaan" value="<?php echo (isset($data->ibu_pekerjaan)) ? $data->ibu_pekerjaan : ''; ?>" required>
                            </div>
                            <br />
                            <div class="form-group">
                                <label for="exampleInputEmail1"><b>Sebelum melakukan pendaftaran, pecahkan perhitungan berikut! <br />Berapakah Hasil dari <?php echo $_SESSION['satu']." + ".$_SESSION['dua']; ?>?</b></label>
                                <input type="number" class="form-control form-control-lg" id="hasil" aria-describedby="hasil" placeholder="Hasil Penjumlahan" name="hasil" value="" required>
                            </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4" style="margin-top: 10px;">
                            <button type="submit" class="btn btn-primary btn-lg">Daftar</button>
                        </form>
                    </div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4"></div>
                </div>
                <br />
                <script>
                    $('#siswa_pendidikan_id').change(function(){
                        console.log('Hello');
                        let siswa_pendidikan_id = document.getElementById("siswa_pendidikan_id").value;
                        let tahun_ajaran_id = document.getElementById("tahun_ajaran_id").value;
                        location.href = "<?php echo home_url(add_query_arg(array(),$wp->request )).'?siswa_pendidikan_id='; ?>" + siswa_pendidikan_id + "&tahun_ajaran_id=" + tahun_ajaran_id;
                    });
                    $('#tahun_ajaran_id').change(function(){
                        console.log('Test');
                        let siswa_pendidikan_id = document.getElementById("siswa_pendidikan_id").value;
                        let tahun_ajaran_id = document.getElementById("tahun_ajaran_id").value;
                        location.href = "<?php echo home_url(add_query_arg(array(),$wp->request )).'?siswa_pendidikan_id='; ?>" + siswa_pendidikan_id + "&tahun_ajaran_id=" + tahun_ajaran_id;
                    });
                </script>
            </div>
            <script>
                if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location.href );
                }
            </script>
        <?php
        if(isset($_POST['hasil'])){
            if($process){
                ?>
                    <!-- Modal -->
                    <div class="modal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Pendaftaran Berhasil</h5>
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Pendaftaran telah berhasil, silahkan menghubungi Admin.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        $(window).on('load', function() {
                            $('#exampleModalCenter').modal('show');
                        });                            
                    </script>
                <?php
            }else{
                ?>
                    <!-- Modal -->
                    <div class="modal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Pendaftaran Gagal</h5>
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Pendaftaran Gagal, silahkan cek perhitungan Anda.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="backButton()">Close</button>
                            </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        $(window).on('load', function() {
                            $('#exampleModalCenter').modal('show');
                        });            
                        function backButton() {
                           window.history.back();
                        }                                        
                    </script>
    
                <?php
            }
        }
    }
}