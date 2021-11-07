<?php
if(!function_exists('tahunAjaranPage')){
    function tahunAjaranPage($datas = null, $data = null){
        ?>  
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
            <style>
                body {
                    background-color: white;
                }
            </style>
            <div style="margin-right: 20px;">
                <h1>Tahun Ajaran</h1>
                <div class="row">
                    <h3>Formulir Tahun Ajaran</h3>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <form action="" method="POST">
                            <input type="hidden" name="id" value="<?php echo (isset($data->id)) ? $data->id : ''; ?>" / >
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tahun Ajaran</label>
                                <input type="text" class="form-control form-control-lg" id="tahun_ajaran" aria-describedby="tahun_ajaran" placeholder="Tahun Ajaran" name="tahun_ajaran" value="<?php echo (isset($data->tahun_ajaran)) ? $data->tahun_ajaran : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tahun</label>
                                <input type="number" class="form-control form-control-lg" id="tahun" aria-describedby="tahun" placeholder="Tahun" name="tahun" value="<?php echo (isset($data->tahun)) ? $data->tahun : ''; ?>" required>
                            </div>
                            <br />
                    </div>
                    <div class="col-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="tahun_aktif" name="tahun_aktif" <?php echo (isset($data->tahun_aktif) && $data->tahun_aktif) ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="tahun_aktif">Tahun Aktif</label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="status" name="status" <?php echo (isset($data->status) && $data->status) ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="status">Status</label>
                                    </div>
                                </div>
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
                                <button type="submit" class="btn btn-primary"><?php echo (isset($_GET['action']) && $_GET['action'] == 'edit') ? 'Ubah Data' : 'Tambah Data'; ?></button><a href="<?php echo ADMIN_PAGE.'ppdb-tahun-ajaran'; ?>" class="btn btn-warning">Batal</a>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4"></div>
                </div>
                <br />
                <div class="row">
                    <div class="col-lg-11">
                        <h3>Daftar Tahun Ajaran</h3>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                <th style="width: 4%" class="text-center">No.</th>
                                <th style="width: 20%" class="text-center">Tahun Ajaran</th>
                                <th style="width: 20%" class="text-center">Tahun</th>
                                <th style="width: 8%" class="text-center">Tahun Aktif</th>
                                <th style="width: 8%" class="text-center">Status</th>
                                <th style="width: 20%" class="text-center">Keterangan</th>
                                <th style="width: 20%" class="text-center">Aksi</th>
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
                                    <td class="text-center"><?php echo $data->tahun; ?></td>
                                    <td class="text-center"><?php echo ($data->tahun_aktif) ? '<img src="'.PLUGIN_URL.'images/true.png'.'" width="20px" height="20px"/>' : '<img src="'.PLUGIN_URL.'images/false.png'.'" width="20px" height="20px"/>' ?></td>
                                    <td class="text-center"><?php echo ($data->status) ? '<img src="'.PLUGIN_URL.'images/true.png'.'" width="20px" height="20px"/>' : '<img src="'.PLUGIN_URL.'images/false.png'.'" width="20px" height="20px"/>' ?></td>
                                    <td class="text-center"><?php echo $data->keterangan; ?></td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Aksi">
                                            <a href="<?php echo ADMIN_PAGE.'ppdb-tahun-ajaran&id='.$data->id.'&action=edit'; ?>" class="btn btn-success btn-sm btn-secondary">Edit</a>
                                            <a href="<?php echo ADMIN_PAGE.'ppdb-tahun-ajaran&id='.$data->id.'&action=delete'; ?>" class="btn btn-danger btn-sm btn-secondary" onclick="return confirm('Yakin menghapus data?');">Hapus</a>
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