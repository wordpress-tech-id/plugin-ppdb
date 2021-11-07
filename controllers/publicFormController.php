<?php


if(!function_exists('publicFormController')){
    function publicFormController(){
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
            'keterangan' => $keterangan
        ];
        var_dump($data);
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
            $result = insert('ppdb_pendaftars', $data);
            if($result){
                return true;
            }else{
                return false;
            }
        }

    }
}