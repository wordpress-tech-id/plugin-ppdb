<?php

require_once PLUGIN_PATH."pages/homeFormPage.php";    

if(!function_exists('homeFormController')){
    function homeFormController(){

        //MENGAMBIL DATA POS
        $id = (isset($_POST['id']) && $_POST['id'] !== '') ? $_POST['id'] : '';
        $gelombang_id = (isset($_POST['gelombang_id']) && $_POST['gelombang_id'] !== '') ? $_POST['gelombang_id'] : '';
        $siswa_nama_lengkap = (isset($_POST['siswa_nama_lengkap']) && $_POST['siswa_nama_lengkap'] !== '') ? $_POST['siswa_nama_lengkap'] : '';
        $siswa_lahir_tmpt = (isset($_POST['siswa_lahir_tmpt']) && $_POST['siswa_lahir_tmpt'] !== '') ? $_POST['siswa_lahir_tmpt'] : '';
        $siswa_lahir_tgl = (isset($_POST['siswa_lahir_tgl']) && $_POST['siswa_lahir_tgl'] !== '') ? $_POST['siswa_lahir_tgl'] : '';
        $siswa_pendidikan_id = (isset($_POST['siswa_pendidikan_id']) && $_POST['siswa_pendidikan_id'] !== '') ? $_POST['siswa_pendidikan_id'] : '';
        $siswa_pendidikan_akhir = (isset($_POST['siswa_pendidikan_akhir']) && $_POST['siswa_pendidikan_akhir'] !== '') ? $_POST['siswa_pendidikan_akhir'] : '';
        $siswa_status_keluarga = (isset($_POST['siswa_status_keluarga']) && $_POST['siswa_status_keluarga'] !== '') ? $_POST['siswa_status_keluarga'] : '';
        $siswa_berat_badan = (isset($_POST['siswa_berat_badan']) && $_POST['siswa_berat_badan'] !== '') ? $_POST['siswa_berat_badan'] : '';
        $siswa_tinggi_badan = (isset($_POST['siswa_tinggi_badan']) && $_POST['siswa_tinggi_badan'] !== '') ? $_POST['siswa_tinggi_badan'] : '';
        $siswa_riwayat_penyakit = (isset($_POST['siswa_riwayat_penyakit']) && $_POST['siswa_riwayat_penyakit'] !== '') ? $_POST['siswa_riwayat_penyakit'] : '';
        $ayah_no_hp = (isset($_POST['ayah_no_hp']) && $_POST['ayah_no_hp'] !== '') ? $_POST['ayah_no_hp'] : '';
        $ayah_status = (isset($_POST['ayah_status']) && $_POST['ayah_status'] !== '') ? $_POST['ayah_status'] : '';
        $ayah_nama = (isset($_POST['ayah_nama']) && $_POST['ayah_nama'] !== '') ? $_POST['ayah_nama'] : '';
        $ayah_lahir_tmpt = (isset($_POST['ayah_lahir_tmpt']) && $_POST['ayah_lahir_tmpt'] !== '') ? $_POST['ayah_lahir_tmpt'] : '';
        $ayah_lahir_tgl = (isset($_POST['ayah_lahir_tgl']) && $_POST['ayah_lahir_tgl'] !== '') ? $_POST['ayah_lahir_tgl'] : '';
        $ayah_pekerjaan = (isset($_POST['ayah_pekerjaan']) && $_POST['ayah_pekerjaan'] !== '') ? $_POST['ayah_pekerjaan'] : '';
        $ayah_penghasilan = (isset($_POST['ayah_penghasilan']) && $_POST['ayah_penghasilan'] !== '') ? $_POST['ayah_penghasilan'] : '';
        $ibu_status = (isset($_POST['ibu_status']) && $_POST['ibu_status'] !== '') ? $_POST['ibu_status'] : '';
        $ibu_nama = (isset($_POST['ibu_nama']) && $_POST['ibu_nama'] !== '') ? $_POST['ibu_nama'] : '';
        $ibu_lahir_tmpt = (isset($_POST['ibu_lahir_tmpt']) && $_POST['ibu_lahir_tmpt'] !== '') ? $_POST['ibu_lahir_tmpt'] : '';
        $ibu_lahir_tgl = (isset($_POST['ibu_lahir_tgl']) && $_POST['ibu_lahir_tgl'] !== '') ? $_POST['ibu_lahir_tgl'] : '';
        $ibu_pekerjaan = (isset($_POST['ibu_pekerjaan']) && $_POST['ibu_pekerjaan'] !== '') ? $_POST['ibu_pekerjaan'] : '';
        $keterangan = (isset($_POST['keterangan']) && $_POST['keterangan'] !== '') ? $_POST['keterangan'] : '';
        $data = [
            'gelombang_id' => $gelombang_id,
            'siswa_nama_lengkap' => $siswa_nama_lengkap,
            'siswa_lahir_tmpt' => $siswa_lahir_tmpt,
            'siswa_lahir_tgl' => $siswa_lahir_tgl,
            'siswa_pendidikan_id' => $siswa_pendidikan_id,
            'siswa_pendidikan_akhir' => $siswa_pendidikan_akhir,
            'siswa_status_keluarga' => $siswa_status_keluarga,
            'siswa_berat_badan' => $siswa_berat_badan,
            'siswa_tinggi_badan' => $siswa_tinggi_badan,
            'siswa_riwayat_penyakit' => $siswa_riwayat_penyakit,
            'ayah_no_hp' => $ayah_no_hp,
            'ayah_status' => $ayah_status,
            'ayah_nama' => $ayah_nama,
            'ayah_lahir_tmpt' => $ayah_lahir_tmpt,
            'ayah_lahir_tgl' => $ayah_lahir_tgl,
            'ayah_pekerjaan' => $ayah_pekerjaan,
            'ayah_penghasilan' => $ayah_penghasilan,
            'ibu_status' => $ibu_status,
            'ibu_nama' => $ibu_nama,
            'ibu_lahir_tmpt' => $ibu_lahir_tmpt,
            'ibu_lahir_tgl' => $ibu_lahir_tgl,
            'ibu_pekerjaan' => $ibu_pekerjaan,
            'keterangan' => $keterangan,
        ];
        if(isset($_POST['id']) && $_POST['id'] !== ''){
            $data['tanggal_update'] = date("Y-m-d H:i:s");
            if(
                $gelombang_id && 
                $siswa_nama_lengkap && 
                $siswa_lahir_tmpt && 
                $siswa_lahir_tgl && 
                $siswa_pendidikan_id &&
                $siswa_pendidikan_akhir &&
                $siswa_status_keluarga &&
                $siswa_berat_badan &&
                $siswa_tinggi_badan &&
                $siswa_riwayat_penyakit &&
                $ayah_no_hp &&
                $ayah_status &&
                $ayah_nama &&
                $ayah_lahir_tmpt &&
                $ayah_lahir_tgl &&
                $ayah_pekerjaan &&
                $ayah_penghasilan &&
                $ibu_status &&
                $ibu_nama &&
                $ibu_lahir_tmpt &&
                $ibu_lahir_tgl &&
                $ibu_pekerjaan
            ){
                updateId('ppdb_pendaftars', $data, $id);
                wp_redirect(ADMIN_PAGE.'ppdb');
                exit;
            }
        }else{
            $data['tanggal_daftar'] = date("Y-m-d H:i:s");
            if(
                $gelombang_id && 
                $siswa_nama_lengkap && 
                $siswa_lahir_tmpt && 
                $siswa_lahir_tgl && 
                $siswa_pendidikan_id &&
                $siswa_pendidikan_akhir &&
                $siswa_status_keluarga &&
                $siswa_berat_badan &&
                $siswa_tinggi_badan &&
                $siswa_riwayat_penyakit &&
                $ayah_no_hp &&
                $ayah_status &&
                $ayah_nama &&
                $ayah_lahir_tmpt &&
                $ayah_lahir_tgl &&
                $ayah_pekerjaan &&
                $ayah_penghasilan &&
                $ibu_status &&
                $ibu_nama &&
                $ibu_lahir_tmpt &&
                $ibu_lahir_tgl &&
                $ibu_pekerjaan
            ){
                insert('ppdb_pendaftars', $data);
                ?>
                    <div class="alert alert-success" role="alert" style="margin-right: 20px;">
                    Data added successfully.
                    </div>                
                <?php
            }
        }

        //MEMPROSES DATA UPDATE DAN DELETE
        $find = null;
        if(isset($_GET['id']) && $_GET['id'] !== ''){
            if(isset($_GET['action']) && $_GET['action'] == 'edit'){
                $find = find('ppdb_pendaftars',$_GET['id']);            
            }else if(isset($_GET['action']) && $_GET['action'] == 'delete'){
                destroy('ppdb_pendaftars',$_GET['id']);
            }
        }

        
        //MENGAMBIL DATA UNTUK DITAMPILKAN
        $query = "
            SELECT 
                ppdb_pendaftars.*,
                ppdb_gelombangs.gelombang,
                ppdb_tahun_ajarans.tahun_ajaran,
                ppdb_pendidikans.pendidikan
            FROM 
                ppdb_pendaftars
            LEFT JOIN
                ppdb_gelombangs
            ON
                ppdb_pendaftars.gelombang_id = ppdb_gelombangs.id
            LEFT JOIN
                ppdb_tahun_ajarans
            ON
                ppdb_gelombangs.tahun_ajaran_id = ppdb_tahun_ajarans.id
            LEFT JOIN
                ppdb_pendidikans
            ON
                ppdb_gelombangs.pendidikan_id = ppdb_pendidikans.id;
        ";
        $results = query($query);
        $pendidikans = get('ppdb_pendidikans');
        $tahun_ajarans = get('ppdb_tahun_ajarans',"status = 1");
        $condition = '';
        if(isset($_GET['siswa_pendidikan_id']) && isset($_GET['tahun_ajaran_id'])){
            $condition = "pendidikan_id = ".$_GET['siswa_pendidikan_id']." AND tahun_ajaran_id = ".$_GET['tahun_ajaran_id'];
            $gelombangs = get('ppdb_gelombangs',$condition);
        }else{
            $pendidikan = $pendidikans[0]->id;
            $tahun_ajaran = $tahun_ajarans[0]->id;
            $condition = "pendidikan_id = ".$pendidikan." AND tahun_ajaran_id = ".$tahun_ajaran." AND status = 1";
            $gelombangs = get('ppdb_gelombangs',$condition);
        }
        if(isset($_GET['id']) && isset($_GET['action'])){
            $id = $_GET['id'];
            $action = $_GET['action'];
        }else{
            $id = null;
            $action = null;
        }
        if(isset($_GET['action']) && $_GET['action'] == 'export'){
            exportTablePage($results);
        }else{
            homeFormPage($find, $tahun_ajarans, $gelombangs, $pendidikans, $id, $action);
        }
    }
}