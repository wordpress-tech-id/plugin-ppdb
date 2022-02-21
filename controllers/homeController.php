<?php


if(!shortcode_exists('home')){
    add_shortcode('home_code','home');
}

if(!function_exists('homeController')){
    function homeController(){

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
        //FILTER
        $nama = (isset($_GET['nama']) && $_GET['nama'] !== '') ? $_GET['nama'] : '';
        $tahun_ajaran = (isset($_GET['tahun_ajaran_id']) && $_GET['tahun_ajaran_id'] !== '') ? $_GET['tahun_ajaran_id'] : '';
        if($tahun_ajaran == 'Semua'){
            $tahun_ajaran_query = '';
            $q_gelombang_tahun_ajaran = '';
        }else{
            $tahun_ajaran_query = "AND ppdb_gelombangs.tahun_ajaran_id = '$tahun_ajaran'";            
            $q_gelombang_tahun_ajaran = "AND tahun_ajaran_id = '$tahun_ajaran'";
        }
        $pendidikan = (isset($_GET['siswa_pendidikan_id']) && $_GET['siswa_pendidikan_id'] !== '') ? $_GET['siswa_pendidikan_id'] : '';
        if($pendidikan == 'Semua'){
            $pendidikan_query = '';
            $q_gelombang_pendidikan = '';
        }else{
            $pendidikan_query = "AND ppdb_pendaftars.siswa_pendidikan_id = '$pendidikan'";            
            $q_gelombang_pendidikan = "AND pendidikan_id = '$pendidikan'";
        }
        $gelombang = (isset($_GET['gelombang']) && $_GET['gelombang'] !== '') ? $_GET['gelombang'] : '';
        $gelombang_val = $gelombang;
        if($gelombang == 'Semua'){
            $gelombang_query = '';
            $q_gelombang = "WHERE 1=1";
        }else{
            $gelombang_query = "AND ppdb_pendaftars.gelombang_id LIKE '%$gelombang%'";
            $q_gelombang = "WHERE gelombang = '$gelombang'";
        }
        $q_find_gelombang = "
            SELECT
                id
            FROM
                ppdb_gelombangs
            $q_gelombang
            $q_gelombang_tahun_ajaran
            $q_gelombang_pendidikan
        ";
        $gelombang = query($q_find_gelombang);

        if($gelombang == 'Semua'){
            $gelombang_query = '';
        }else{
            if(count($gelombang) > 0){
                if(count($gelombang) > 1){
                    $gelombang_arras = [];
                    foreach($gelombang as $gel){
                        $gelombang_arras[] = "ppdb_pendaftars.gelombang_id LIKE '%$gel->id%'";
                    }
                    $gelombang_query = "AND (".implode(" OR ",$gelombang_arras).")";
                }else{
                    $idgel = $gelombang[0]->id;
                    $gelombang_query = "AND ppdb_pendaftars.gelombang_id LIKE '%$idgel%'";
                }
            }else{
                $gelombang_query = '';
            }
        }
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
        if(isset($_POST['id']) && $_POST['id'] !== ''){
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
        if(isset($_GET['nama']) && isset($_GET['siswa_pendidikan_id']) && isset($_GET['gelombang']) && isset($_GET['tahun_ajaran_id'])){
            $query = "
                SELECT 
                    ppdb_pendaftars.*,
                    ppdb_gelombangs.gelombang,
                    ppdb_tahun_ajarans.tahun_ajaran,
                    ppdb_pendidikans.lembaga,
                    ppdb_pendidikans.pendidikan,
                    ppdb_pendidikans.alamat,
                    ppdb_pendidikans.logo
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
                    ppdb_gelombangs.pendidikan_id = ppdb_pendidikans.id
                WHERE
                    ppdb_pendaftars.siswa_nama_lengkap LIKE '%$nama%'
                $pendidikan_query
                $gelombang_query
                $tahun_ajaran_query
                    ;
            ";
        }else{
            $query = "
                SELECT 
                    ppdb_pendaftars.*,
                    ppdb_gelombangs.gelombang,
                    ppdb_tahun_ajarans.tahun_ajaran,
                    ppdb_pendidikans.lembaga,
                    ppdb_pendidikans.pendidikan,
                    ppdb_pendidikans.alamat,
                    ppdb_pendidikans.logo
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
                    ppdb_gelombangs.pendidikan_id = ppdb_pendidikans.id
            ";
        }
        $results = query($query);
        $pendidikans = getDistinct('ppdb_pendidikans','',['id','pendidikan']);
        $tahun_ajarans = getDistinct('ppdb_tahun_ajarans',"status = 1",['id','tahun_ajaran']);
        $condition = '';
        $gelombangs = getDistinct('ppdb_gelombangs', '', ['gelombang']);

        if(isset($_GET['action']) && $_GET['action'] == 'export'){
            exportTablePage($results, $nama, $tahun_ajarans, $tahun_ajaran, $gelombangs, $gelombang_val, $pendidikans, $pendidikan);
        }if(isset($_GET['action']) && $_GET['action'] == 'print'){
            printFormulirPage($results, $nama, $tahun_ajarans, $tahun_ajaran, $gelombangs, $gelombang_val, $pendidikans, $pendidikan);
        }else{
            homeTablePage($results, $nama, $tahun_ajarans, $tahun_ajaran, $gelombangs, $gelombang_val, $pendidikans, $pendidikan);
        }
    }
}