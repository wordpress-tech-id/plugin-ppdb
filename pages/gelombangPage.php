<?php

if(!function_exists('gelombangPage')){
    function gelombangPage($datas = null, $data = null, $tahun_ajarans = null, $pendidikans = null){
        ?>  
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
            <style>
                body {
                    background-color: white;
                }
            </style>
            <div style="margin-right: 20px;">
                <h1>Gelombang</h1>
                <div class="row">
                    <h3>Gelombang Penerimaan</h3>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <form action="" method="POST">
                            <input type="hidden" name="id" value="<?php echo (isset($data->id)) ? $data->id : ''; ?>" / >
                            <div class="form-control">
                                <label for="exampleInputEmail1">Tahun Ajaran</label>
                                <select name="tahun_ajaran_id" class="form-control form-control-lg" id="tahun_ajaran_id" aria-describedby="tahun_ajaran_id" required>
                                    <?php
                                        foreach($tahun_ajarans as $tahun_ajaran):
                                    ?>
                                    <option value="<?php echo $tahun_ajaran->id; ?>" <?php echo (isset($data->tahun_ajaran_id) && $tahun_ajaran->id == $data->tahun_ajaran_id) ? 'selected' : ''; ?>><?php echo $tahun_ajaran->tahun_ajaran; ?></option>
                                    <?php
                                        endforeach
                                    ?>
                                </select>
                            </div>
                            <div class="form-control">
                                <label for="exampleInputEmail1">Jenjang Pendidikan</label>
                                <select name="pendidikan_id" class="form-control form-control-lg" id="pendidikan_id" aria-describedby="pendidikan_id" required>
                                    <?php
                                        foreach($pendidikans as $pendidikan):
                                    ?>
                                    <option value="<?php echo $pendidikan->id; ?>" <?php echo (isset($data->pendidikan_id) && $pendidikan->id == $data->pendidikan_id) ? 'selected' : ''; ?>><?php echo $pendidikan->pendidikan; ?></option>
                                    <?php
                                        endforeach
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Gelombang</label>
                                <input type="text" class="form-control form-control-lg" id="gelombang" aria-describedby="gelombang" placeholder="Gelombang" name="gelombang" value="<?php echo (isset($data->gelombang)) ? $data->gelombang : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Buka</label>
                                <input type="date" class="form-control form-control-lg" id="tgl_buka" aria-describedby="tgl_buka" placeholder="Tanggal Buka" name="tgl_buka" value="<?php echo (isset($data->tgl_buka)) ? toDate($data->tgl_buka,'Y-m-d') : ''; ?>"  required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Tutup</label>
                                <input type="date" class="form-control form-control-lg" id="tgl_tutup" aria-describedby="tgl_tutup" placeholder="Tanggal Tutup" name="tgl_tutup" value="<?php echo (isset($data->tgl_tutup)) ? toDate($data->tgl_tutup,'Y-m-d') : ''; ?>" required>
                            </div>
                    </div>
                    <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Biaya Pendaftaran</label>
                                <input type="number" class="form-control form-control-lg" id="biaya_pendaftaran" aria-describedby="biaya_pendaftaran" placeholder="Biaya Pendaftaran" name="biaya_pendaftaran" value="<?php echo (isset($data->biaya_pendaftaran)) ? $data->biaya_pendaftaran : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kuota Pendaftar</label>
                                <input type="number" class="form-control form-control-lg" id="kuota" aria-describedby="kuota" placeholder="Kuota Pendaftaran" name="kuota" value="<?php echo (isset($data->kuota)) ? $data->kuota : ''; ?>" required>
                            </div>
                            <br />
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="status" name="status" <?php echo (isset($data->status) && $data->status) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="status">Status</label>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Keterangan</label>
                                <input type="text" class="form-control form-control-lg" id="keterangan" aria-describedby="keterangan" placeholder="Keterangan" name="keterangan" value="<?php echo (isset($data->keterangan)) ? $data->keterangan : ''; ?>">
                            </div>
                    </div>
                    <div class="col-lg-4"></div>
                </div>
                <div class="row">
                    <div class="col-lg-4" style="margin-top: 10px;">
                            <div class="btn-group" role="group" aria-label="Aksi">
                                <button type="submit" class="btn btn-primary"><?php echo (isset($_GET['action']) && $_GET['action'] == 'edit') ? 'Ubah Data' : 'Tambah Data'; ?></button><a href="<?php echo ADMIN_PAGE.'ppdb-gelombang'; ?>" class="btn btn-warning">Batal</a>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4"></div>
                </div>
                <br />
                <div class="row">
                    <div class="col-lg-11">
                        <h3>Daftar Gelombang Penerimaan</h3>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                <th style="width: 5%" class="text-center">No.</th>
                                <th style="width: 10%" class="text-center">Tahun Ajaran</th>
                                <th style="width: 10%" class="text-center">Pendidikan</th>
                                <th style="width: 10%" class="text-center">Gelombang</th>
                                <th style="width: 15%" class="text-center">Tanggal Buka</th>
                                <th style="width: 15%" class="text-center">Tanggal Tututp</th>
                                <th style="width: 10%" class="text-center">Biaya Pendaftaran</th>
                                <th style="width: 10%" class="text-center">Kuota</th>
                                <th style="width: 5%" class="text-center">Status</th>
                                <th style="width: 10%" class="text-center">Keterangan</th>
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
                                    <td class="text-center"><?php echo toDate($data->tgl_buka); ?></td>
                                    <td class="text-center"><?php echo toDate($data->tgl_tutup); ?></td>
                                    <td class="text-center"><?php echo toRupiah($data->biaya_pendaftaran); ?></td>
                                    <td class="text-center"><?php echo $data->kuota; ?></td>
                                    <td class="text-center"><?php echo ($data->status) ? '<img src="'.PLUGIN_URL.'images/true.png'.'" width="20px" height="20px"/>' : '<img src="'.PLUGIN_URL.'images/false.png'.'" width="20px" height="20px"/>' ?></td>
                                    <td class="text-center"><?php echo $data->keterangan; ?></td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Aksi">
                                            <a href="<?php echo ADMIN_PAGE.'ppdb-gelombang&id='.$data->id.'&action=edit'; ?>" class="btn btn-success btn-sm btn-secondary">Edit</a>
                                            <a href="<?php echo ADMIN_PAGE.'ppdb-gelombang&id='.$data->id.'&action=delete'; ?>" class="btn btn-danger btn-sm btn-secondary" onclick="return confirm('Yakin menghapus data?');">Hapus</a>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                    endforeach
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-1"></div>
                </div>
            </div>
        <?php
    }
}