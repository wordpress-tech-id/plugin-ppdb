<?php

if(!function_exists('homeTablePage')){
    function homeTablePage($datas = null){
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
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Daftar Gelombang Penerimaan</h3>
                            </div>
                            <div class="col-md-5">
                            </div>
                            <div class="col-md-1">
                                <a href="<?php echo ADMIN_PAGE.'ppdb&action=export'; ?>" target="_blank" class="btn btn-success btn-sm">Export</a>
                            </div>
                        </div>
                        <table class="table table-bordered table-hover">
                            <thead>
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
                                            <a href="<?php echo ADMIN_PAGE.'ppdb&id='.$data->id.'&action=edit'; ?>" class="btn btn-success btn-sm btn-secondary">Edit</a>
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
                <script>
                    $('#siswa_pendidikan_id').change(function(){
                        let siswa_pendidikan_id = document.getElementById("siswa_pendidikan_id").value;
                        let tahun_ajaran_id = document.getElementById("tahun_ajaran_id").value;
                        location.href = "<?php echo ADMIN_PAGE.'ppdb&siswa_pendidikan_id='; ?>" + siswa_pendidikan_id + "&tahun_ajaran_id=" + tahun_ajaran_id;
                    });
                    $('#tahun_ajaran_id').change(function(){
                        let siswa_pendidikan_id = document.getElementById("siswa_pendidikan_id").value;
                        let tahun_ajaran_id = document.getElementById("tahun_ajaran_id").value;
                        location.href = "<?php echo ADMIN_PAGE.'ppdb&siswa_pendidikan_id='; ?>" + siswa_pendidikan_id + "&tahun_ajaran_id=" + tahun_ajaran_id;
                    });
                </script>
            </div>
        <?php
    }
}