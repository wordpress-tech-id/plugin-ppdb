<?php

if(!function_exists('homeFormPage')){
    function homeFormPage($data = null, $tahun_ajarans = null, $gelombangs = null, $pendidikans = null, $id = null, $action = null){
        ?>  
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>                        
            <style>
                body {
                    background-color: white;
                }
            </style>
            <div style="margin-right: 20px; margin-top: 20px;">                
                <form action="" method="POST">
                <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Data Calon Siswa
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <input type="hidden" name="id" value="<?php echo (isset($data->id)) ? $data->id : ''; ?>" / >
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jenjang Pendidikan</label>
                                <select name="siswa_pendidikan_id" class="form-control form-control-md" id="siswa_pendidikan_id" aria-describedby="siswa_pendidikan_id" required onchange="pendidikanId(this.value);">
                                    <?php
                                        foreach($pendidikans as $pendidikan):
                                    ?>
                                    <option value="<?php echo $pendidikan->id; ?>" <?php echo (isset($data->siswa_pendidikan_id) && $pendidikan->id == $data->siswa_pendidikan_id) ? 'selected' : ((isset($_GET['siswa_pendidikan_id']) && $_GET['siswa_pendidikan_id'] == $pendidikan->id) ? 'selected' : ''); ?>><?php echo $pendidikan->pendidikan; ?></option>
                                    <?php
                                        endforeach;
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tahun Ajaran</label>
                                <select name="tahun_ajaran_id" class="form-control form-control-md" id="tahun_ajaran_id" aria-describedby="tahun_ajaran_id" required>
                                    <?php
                                        foreach($tahun_ajarans as $tahun_ajaran):
                                    ?>
                                    <option value="<?php echo $tahun_ajaran->id; ?>" <?php echo (isset($data->tahun_ajaran_id) && $tahun_ajaran->id == $data->tahun_ajaran_id) ? 'selected' : ((isset($_GET['tahun_ajaran_id']) && $_GET['tahun_ajaran_id'] == $tahun_ajaran->id) ? 'selected' : ''); ?>><?php echo $tahun_ajaran->tahun_ajaran; ?></option>
                                    <?php
                                        endforeach;
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Gelombang</label>
                                <select name="gelombang_id" class="form-control form-control-md" id="gelombang_id" aria-describedby="gelombang_id" required>
                                    <?php
                                        if(count($gelombangs) > 0){
                                            foreach($gelombangs as $gelombang):
                                                ?>
                                                    <option value="<?php echo $gelombang->id; ?>" <?php echo (isset($data->gelombang_id) && $gelombang->id == $data->gelombang_id) ? 'selected' : ''; ?>><?php echo $gelombang->gelombang; ?></option>
                                                <?php
                                            endforeach;
                                        }else{
                                            ?>
                                                <option selected>Pilih lembaga dan tahun ajaran terlebih dahulu</option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Calon Siswa</label>
                                <input type="text" class="form-control form-control-md" id="siswa_nama_lengkap" aria-describedby="siswa_nama_lengkap" placeholder="Nama Calon Siswa" name="siswa_nama_lengkap" value="<?php echo (isset($data->siswa_nama_lengkap)) ? $data->siswa_nama_lengkap : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tempat Lahir</label>
                                <input type="text" class="form-control form-control-md" id="siswa_lahir_tmpt" aria-describedby="siswa_lahir_tmpt" placeholder="Tempat Lahir" name="siswa_lahir_tmpt" value="<?php echo (isset($data->siswa_lahir_tmpt)) ? $data->siswa_lahir_tmpt : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Lahir</label>
                                <input type="date" class="form-control form-control-md" id="siswa_lahir_tgl" aria-describedby="siswa_lahir_tgl" placeholder="Tanggal Lahir" name="siswa_lahir_tgl" value="<?php echo (isset($data->siswa_lahir_tgl)) ? toDate($data->siswa_lahir_tgl, 'Y-m-d') : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Pendidikan Terakhir</label>
                                <select name="siswa_pendidikan_akhir" class="form-control form-control-md" id="siswa_pendidikan_akhir" aria-describedby="siswa_pendidikan_akhir" required>
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
                            <div class="form-group">
                                <label for="exampleInputEmail1">Status Dalam Keluarga</label>
                                <select name="siswa_status_keluarga" class="form-control form-control-md" id="siswa_status_keluarga" aria-describedby="siswa_status_keluarga" required>
                                    <option value="Anak Kandung" <?php echo (isset($data->siswa_status_keluarga) && $data->siswa_status_keluarga == 'Anak Kandung') ? 'selected' : ''; ?>>Anak Kandung</option>
                                    <option value="Anak Angkat" <?php echo (isset($data->siswa_status_keluarga) && $data->siswa_status_keluarga == 'Anak Angkat') ? 'selected' : ''; ?>>Anak Angkat</option>
                                    <option value="Anak Tiri" <?php echo (isset($data->siswa_status_keluarga) && $data->siswa_status_keluarga == 'Anak Tiri') ? 'selected' : ''; ?>>Anak Tiri</option>
                                    <option value="Lainnya" <?php echo (isset($data->siswa_status_keluarga) && $data->siswa_status_keluarga == 'Lainnya') ? 'selected' : ''; ?>>Lainnya</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Berat Badan</label>
                                <input type="number" class="form-control form-control-md" id="siswa_berat_badan" aria-describedby="siswa_berat_badan" placeholder="Berat Badan" name="siswa_berat_badan" value="<?php echo (isset($data->siswa_berat_badan)) ? $data->siswa_berat_badan : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tinggi Badan</label>
                                <input type="number" class="form-control form-control-md" id="siswa_tinggi_badan" aria-describedby="siswa_tinggi_badan" placeholder="Tinggi Badan" name="siswa_tinggi_badan" value="<?php echo (isset($data->siswa_tinggi_badan)) ? $data->siswa_tinggi_badan : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Riwayat Penyakit</label>
                                <input type="text" class="form-control form-control-md" id="siswa_riwayat_penyakit" aria-describedby="siswa_riwayat_penyakit" placeholder="Riwayat Penyakit" name="siswa_riwayat_penyakit" value="<?php echo (isset($data->siswa_riwayat_penyakit)) ? $data->siswa_riwayat_penyakit : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Keterangan</label>
                                <input type="text" class="form-control form-control-md" id="keterangan" aria-describedby="keterangan" placeholder="Riwayat Penyakit" name="keterangan" value="<?php echo (isset($data->keterangan)) ? $data->keterangan : ''; ?>">
                            </div>                        
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Data Ayah
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nomor HP/WA Wali/Orang Tua Calon Siswa</label>
                                <input type="text" class="form-control form-control-md" id="ayah_no_hp" aria-describedby="ayah_no_hp" placeholder="Nomor HP/WA Wali/Orang Tua Calon Siswa" name="ayah_no_hp" value="<?php echo (isset($data->ayah_no_hp)) ? $data->ayah_no_hp : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Status Dalam Keluarga</label>
                                <select name="ayah_status" class="form-control form-control-md" id="ayah_status" aria-describedby="ayah_status" required>
                                    <option value="Ayah Kandung" <?php echo (isset($data->ayah_status) && $data->ayah_status == 'Ayah Kandung') ? 'selected' : ''; ?>>Ayah Kandung</option>
                                    <option value="Ayah Tiri" <?php echo (isset($data->ayah_status) && $data->ayah_status == 'Ayah Tiri') ? 'selected' : ''; ?>>Ayah Tiri</option>
                                    <option value="Ayah Angkat" <?php echo (isset($data->ayah_status) && $data->ayah_status == 'Ayah Angkat') ? 'selected' : ''; ?>>Ayah Angkat</option>
                                    <option value="Wali" <?php echo (isset($data->ayah_status) && $data->ayah_status == 'Wali') ? 'selected' : ''; ?>>Wali</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Ayah</label>
                                <input type="text" class="form-control form-control-md" id="ayah_nama" aria-describedby="ayah_nama" placeholder="Nama Ayah Calon Siswa" name="ayah_nama" value="<?php echo (isset($data->ayah_nama)) ? $data->ayah_nama : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tempat Lahir Ayah</label>
                                <input type="text" class="form-control form-control-md" id="ayah_lahir_tmpt" aria-describedby="ayah_lahir_tmpt" placeholder="Tempat Lahir Ayah" name="ayah_lahir_tmpt" value="<?php echo (isset($data->ayah_lahir_tmpt)) ? $data->ayah_lahir_tmpt : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Lahir Ayah</label>
                                <input type="date" class="form-control form-control-md" id="ayah_lahir_tgl" aria-describedby="ayah_lahir_tgl" placeholder="Tanggal Lahir Ayah" name="ayah_lahir_tgl" value="<?php echo (isset($data->ayah_lahir_tgl)) ? toDate($data->ayah_lahir_tgl,'Y-m-d') : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Pekerjaan Ayah</label>
                                <input type="text" class="form-control form-control-md" id="ayah_pekerjaan" aria-describedby="ayah_pekerjaan" placeholder="Pekerjaan Ayah" name="ayah_pekerjaan" value="<?php echo (isset($data->ayah_pekerjaan)) ? $data->ayah_pekerjaan : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Penghasilan Ayah</label>
                                <select name="ayah_penghasilan" class="form-control form-control-md" id="ayah_penghasilan" aria-describedby="ayah_penghasilan" required>
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
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Data Ibu
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Status Dalam Keluarga</label>
                                <select name="ibu_status" class="form-control form-control-md" id="ibu_status" aria-describedby="ibu_status" required>
                                    <option value="Ibu Kandung" <?php echo (isset($data->ibu_status) && $data->ibu_status == 'Ibu Kandung') ? 'selected' : ''; ?>>Ibu Kandung</option>
                                    <option value="Ibu Tiri" <?php echo (isset($data->ibu_status) && $data->ibu_status == 'Ibu Tiri') ? 'selected' : ''; ?>>Ibu Tiri</option>
                                    <option value="Ibu Angkat" <?php echo (isset($data->ibu_status) && $data->ibu_status == 'Ibu Angkat') ? 'selected' : ''; ?>>Ibu Angkat</option>
                                    <option value="Wali" <?php echo (isset($data->ibu_status) && $data->ibu_status == 'Wali') ? 'selected' : ''; ?>>Wali</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Ibu</label>
                                <input type="text" class="form-control form-control-md" id="ibu_nama" aria-describedby="ibu_nama" placeholder="Nama Ibu Calon Siswa" name="ibu_nama" value="<?php echo (isset($data->ibu_nama)) ? $data->ibu_nama : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tempat Lahir Ibu</label>
                                <input type="text" class="form-control form-control-md" id="ibu_lahir_tmpt" aria-describedby="ibu_lahir_tmpt" placeholder="Tempat Lahir Ibu" name="ibu_lahir_tmpt" value="<?php echo (isset($data->ibu_lahir_tmpt)) ? $data->ibu_lahir_tmpt : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Lahir Ibu</label>
                                <input type="date" class="form-control form-control-md" id="ibu_lahir_tgl" aria-describedby="ibu_lahir_tgl" placeholder="Tanggal Lahir Ibu" name="ibu_lahir_tgl" value="<?php echo (isset($data->ibu_lahir_tgl)) ? toDate($data->ibu_lahir_tgl,'Y-m-d') : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Pekerjaan Ibu</label>
                                <input type="text" class="form-control form-control-md" id="ibu_pekerjaan" aria-describedby="ibu_pekerjaan" placeholder="Pekerjaan Ibu" name="ibu_pekerjaan" value="<?php echo (isset($data->ibu_pekerjaan)) ? $data->ibu_pekerjaan : ''; ?>" required>
                            </div>
                            <div class="col-lg-4" style="margin-top: 10px;">
                            <div class="btn-group" role="group" aria-label="Aksi">
                                <button type="submit" class="btn btn-primary"><?php echo (isset($_GET['action']) && $_GET['action'] == 'edit') ? 'Ubah Data' : 'Tambah Data'; ?></button><a href="<?php echo ADMIN_PAGE.'ppdb-gelombang'; ?>" class="btn btn-warning">Batal</a>
                            </div>                        
                        </div>
                    </div>
                </div>
                <script>
                    $('#siswa_pendidikan_id').change(function(){
                        let siswa_pendidikan_id = document.getElementById("siswa_pendidikan_id").value;
                        let tahun_ajaran_id = document.getElementById("tahun_ajaran_id").value;
                        <?php
                            if($action == 'edit'){
                                ?>
                                location.href = "<?php echo ADMIN_PAGE.'ppdb-form&id='.$id.'&action=edit&siswa_pendidikan_id='; ?>" + siswa_pendidikan_id + "&tahun_ajaran_id=" + tahun_ajaran_id;
                                <?php
                            }else{
                                ?>
                                location.href = "<?php echo ADMIN_PAGE.'ppdb-form&siswa_pendidikan_id='; ?>" + siswa_pendidikan_id + "&tahun_ajaran_id=" + tahun_ajaran_id;
                                <?php
                            }
                        ?>
                    });
                    $('#tahun_ajaran_id').change(function(){
                        let siswa_pendidikan_id = document.getElementById("siswa_pendidikan_id").value;
                        let tahun_ajaran_id = document.getElementById("tahun_ajaran_id").value;
                        <?php
                            if($action == 'edit'){
                                ?>
                                location.href = "<?php echo ADMIN_PAGE.'ppdb-form&id='.$id.'&action=edit&siswa_pendidikan_id='; ?>" + siswa_pendidikan_id + "&tahun_ajaran_id=" + tahun_ajaran_id;
                                <?php
                            }else{
                                ?>
                                location.href = "<?php echo ADMIN_PAGE.'ppdb-form&siswa_pendidikan_id='; ?>" + siswa_pendidikan_id + "&tahun_ajaran_id=" + tahun_ajaran_id;
                                <?php
                            }
                        ?>
                    });
                </script>
        <?php
    }
}