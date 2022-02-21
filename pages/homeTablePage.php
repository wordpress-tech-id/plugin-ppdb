<?php
if(!function_exists('homeTablePage')){
    function homeTablePage($datas = null, $nama = null, $tahun_ajarans = null, $tahun_ajaran_val =null, $gelombangs = null, $gelombang_val = null, $pendidikans = null, $pendidikan_val = null){
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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Daftar Calon Siswa</h3>
                            </div>
                            <div class="row">
                            </div>
                        </div>
                        <br />
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <form action="" method="GET" id="filter">
                                    <input type="hidden" value="ppdb" name="page"/>
                                    <th style="width: 5%" class="text-center"></th>
                                    <th style="width: 10%" class="text-center">
                                        <select name="tahun_ajaran_id" class="form-control form-control-md" id="tahun_ajaran_id" aria-describedby="tahun_ajaran_id" required>
                                            <option value="Semua" <?php echo (isset($tahun_ajaran_val) && $tahun_ajaran_val == 'semua') ? 'selected' : ''; ?>>Semua</option>
                                            <?php
                                                foreach($tahun_ajarans as $tahun_ajaran):
                                            ?>
                                            <option value="<?php echo $tahun_ajaran->id; ?>" <?php echo (isset($tahun_ajaran_val) && $tahun_ajaran->id == $tahun_ajaran_val) ? 'selected' : ''; ?>><?php echo $tahun_ajaran->tahun_ajaran; ?></option>
                                            <?php
                                                endforeach;
                                            ?>
                                        </select>
                                    </th>
                                    <th style="width: 5%" class="text-center">
                                        <select name="siswa_pendidikan_id" class="form-control form-control-md" id="siswa_pendidikan_id" aria-describedby="siswa_pendidikan_id" required onchange="pendidikanId(this.value);">
                                            <option value="Semua" <?php echo (isset($pendidikan_val) && $pendidikan_val == 'semua') ? 'selected' : ''; ?>>Semua</option>
                                            <?php
                                                foreach($pendidikans as $pendidikan):
                                            ?>
                                            <option value="<?php echo $pendidikan->id; ?>" <?php echo (isset($pendidikan_val) && $pendidikan->id == $pendidikan_val) ? 'selected' : ''; ?>><?php echo $pendidikan->pendidikan; ?></option>
                                            <?php
                                                endforeach;
                                            ?>
                                        </select>
                                    </th>
                                    <th style="width: 15%" class="text-center">
                                        <select name="gelombang" class="form-control form-control-md" id="gelombang" aria-describedby="gelombang" required>
                                            <option value="Semua" <?php echo (isset($gelombang_val) && $gelombang_val == 'semua') ? 'selected' : ''; ?>>Semua</option>
                                            <?php
                                                if(count($gelombangs) > 0){
                                                    foreach($gelombangs as $gelombang):
                                                        ?>
                                                            <option value="<?php echo $gelombang->gelombang; ?>" <?php echo (isset($gelombang_val) && $gelombang->gelombang == $gelombang_val) ? 'selected' : ''; ?>><?php echo $gelombang->gelombang; ?></option>
                                                        <?php
                                                    endforeach;
                                                }else{
                                                    ?>
                                                        <option selected>Pilih lembaga dan tahun ajaran terlebih dahulu</option>
                                                    <?php
                                                }
                                            ?>
                                        </select>
                                    </th>
                                    <th style="width: 10%" class="text-center">
                                        <input type="text" class="form-control form-control-md" id="nama" name="nama" value="<?php echo isset($_GET['nama']) ? $_GET['nama'] : '' ?>"/>
                                    </th>
                                    <th style="width: 15%" class="text-center"></th>
                                    <th style="width: 15%" class="text-center"></th>
                                    <th style="width: 15%" class="text-center" colspan="5"></th>
                                    <th style="width: 15%" class="text-center" colspan="5">
                                        <div class="row">
                                            <div class="col">
                                                <button type="submit" class="form-control form-control-md btn btn-success btn-sm">Filter</button>
                                            </div>
                                            <div class="col">
                                                <?php
                                                    if(isset($_GET['tahun_ajaran_id'])){
                                                        ?>
                                                            <a href="<?php echo ADMIN_PAGE.'ppdb&action=export&tahun_ajaran_id='.$tahun_ajaran_val.'&siswa_pendidikan_id='.$pendidikan_val.'&gelombang='.$gelombang_val.'+2&nama='.$nama.''; ?>" target="_blank" class="form-control form-control-md btn btn-primary btn-sm">Export</a>
                                                        <?php
                                                    }else{
                                                        ?>
                                                            <a href="<?php echo ADMIN_PAGE.'ppdb&action=export'; ?>" target="_blank" class="form-control form-control-md btn btn-primary btn-sm">Export</a>
                                                        <?php
                                                    }
                                                ?>
                                            </div>
                                            <div class="col">
                                                <?php
                                                    if(isset($_GET['tahun_ajaran_id'])){
                                                        ?>
                                                            <a href="<?php echo ADMIN_PAGE.'ppdb&action=print&tahun_ajaran_id='.$tahun_ajaran_val.'&siswa_pendidikan_id='.$pendidikan_val.'&gelombang='.$gelombang_val.'+2&nama='.$nama.''; ?>" target="_blank" class="form-control form-control-md btn btn-warning btn-sm">Print</a>
                                                        <?php
                                                    }else{
                                                        ?>
                                                            <a href="<?php echo ADMIN_PAGE.'ppdb&action=print'; ?>" target="_blank" class="form-control form-control-md btn btn-warning btn-sm">Print</a>
                                                        <?php
                                                    }
                                                ?>
                                            </div>
                                            <div class="col">
                                                <a href="<?php echo ADMIN_PAGE.'ppdb'; ?>" target="_parent" class="form-control form-control-md btn btn-danger btn-sm">Clear</a>
                                            </div>
                                        </div>
                                    </th>
                                    </form>
                                </tr>
                                <tr>
                                    <th style="width: 5%" class="text-center" rowspan="2">No.</th>
                                    <th style="width: 10%" class="text-center" rowspan="2">Tahun</th>
                                    <th style="width: 10%" class="text-center" rowspan="2">Lembaga</th>
                                    <th style="width: 10%" class="text-center" rowspan="2">Gelombang</th>
                                    <th style="width: 10%" class="text-center" rowspan="2">Nama</th>
                                    <th style="width: 15%" class="text-center" rowspan="2">TTL</th>
                                    <th style="width: 15%" class="text-center" rowspan="2">Pendidikan</th>
                                    <th style="width: 15%" class="text-center" colspan="5">Ayah</th>
                                    <th style="width: 15%" class="text-center" colspan="5">Ibu</th>
                                </tr>
                                <tr>
                                    <th style="width: 15%" class="text-center">Nama</th>
                                    <th style="width: 15%" class="text-center">TTL</th>
                                    <th style="width: 15%" class="text-center">HP</th>
                                    <th style="width: 15%" class="text-center">Pekerjaan</th>
                                    <th style="width: 15%" class="text-center">Penghasilan</th>
                                    <th style="width: 15%" class="text-center">Ibu</th>
                                    <th style="width: 15%" class="text-center">TTL</th>
                                    <th style="width: 15%" class="text-center">Pekerjaan</th>
                                    <th style="width: 10%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no = 1;
                                    foreach($datas as $data):
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $no++; ?></td>
                                    <td class="text-center"><?php echo $data->tahun_ajaran; ?></td>
                                    <td class="text-center"><?php echo $data->pendidikan; ?></td>
                                    <td class="text-center"><?php echo $data->gelombang; ?></td>
                                    <td class="text-center"><?php echo $data->siswa_nama_lengkap; ?></td>
                                    <td class="text-center"><?php echo $data->siswa_lahir_tmpt.", ".toDate($data->siswa_lahir_tgl); ?></td>
                                    <td class="text-center"><?php echo $data->siswa_pendidikan_akhir; ?></td>
                                    <td class="text-center"><?php echo $data->ayah_nama; ?></td>
                                    <td class="text-center"><?php echo $data->ayah_lahir_tmpt.", ".toDate($data->ayah_lahir_tgl); ?></td>
                                    <td class="text-center"><?php echo $data->ayah_no_hp; ?></td>
                                    <td class="text-center"><?php echo $data->ayah_pekerjaan; ?></td>
                                    <td class="text-center"><?php echo $data->ayah_penghasilan; ?></td>
                                    <td class="text-center"><?php echo $data->ibu_nama; ?></td>
                                    <td class="text-center"><?php echo $data->ibu_lahir_tmpt.", ".toDate($data->ibu_lahir_tgl); ?></td>
                                    <td class="text-center"><?php echo $data->ibu_pekerjaan; ?></td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Aksi">
                                            <a href="<?php echo ADMIN_PAGE.'ppdb-form&id='.$data->id.'&action=edit'; ?>" class="btn btn-success btn-sm btn-secondary">Edit</a>
                                            <a href="<?php echo ADMIN_PAGE.'ppdb&id='.$data->id.'&action=delete'; ?>" class="btn btn-danger btn-sm btn-secondary" onclick="return confirm('Yakin menghapus data?');">Hapus</a>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                    endforeach
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php
    }
}