<?php
    require_once "../functions/formatter.php";
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Data Pegawai.xls");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pendaftar</title>
</head>
<body>
<div style="margin-right: 20px;">
    <h1>Data Pendaftaran</h1>
    <div class="row">
        <div class="col-lg-12">
            <h3>Daftar Gelombang Penerimaan</h3>
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
                        <th style="width: 15%" class="text-center" rowspan="2">Status Keluarga</th>
                        <th style="width: 15%" class="text-center" rowspan="2">Berat Badan</th>
                        <th style="width: 15%" class="text-center" rowspan="2">Tinggi Badan</th>
                        <th style="width: 15%" class="text-center" rowspan="2">Riwayat Penyakit</th>
                        <th style="width: 15%" class="text-center" colspan="5">Ayah</th>
                        <th style="width: 15%" class="text-center" colspan="3">Ibu</th>
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
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $datas = json_decode($_GET['datas']);
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
                        <td class="text-center"><?php echo $data->siswa_status_keluarga; ?></td>
                        <td class="text-center"><?php echo $data->siswa_berat_badan; ?></td>
                        <td class="text-center"><?php echo $data->siswa_tinggi_badan; ?></td>
                        <td class="text-center"><?php echo $data->siswa_riwayat_penyakit; ?></td>
                        <td class="text-center"><?php echo $data->ayah_nama; ?></td>
                        <td class="text-center"><?php echo $data->ayah_lahir_tmpt.", ".toDate($data->ayah_lahir_tgl); ?></td>
                        <td class="text-center"><?php echo $data->ayah_no_hp; ?></td>
                        <td class="text-center"><?php echo $data->ayah_pekerjaan; ?></td>
                        <td class="text-center"><?php echo $data->ayah_penghasilan; ?></td>
                        <td class="text-center"><?php echo $data->ibu_nama; ?></td>
                        <td class="text-center"><?php echo $data->ibu_lahir_tmpt.", ".toDate($data->ibu_lahir_tgl); ?></td>
                        <td class="text-center"><?php echo $data->ibu_pekerjaan; ?></td>
                    </tr>
                    <?php
                        endforeach
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>   
</body>
</html>