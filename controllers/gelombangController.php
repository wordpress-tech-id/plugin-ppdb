<?php

if(!function_exists('gelombangController')){
    function gelombangController(){
        //MENGAMBIL DATA POS
        $id = (isset($_POST['id']) && $_POST['id'] !== '') ? $_POST['id'] : '';
        $pendidikan_id = (isset($_POST['pendidikan_id']) && $_POST['pendidikan_id'] !== '') ? $_POST['pendidikan_id'] : '';
        $tahun_ajaran_id = (isset($_POST['tahun_ajaran_id']) && $_POST['tahun_ajaran_id'] !== '') ? $_POST['tahun_ajaran_id'] : '';
        $gelombang = (isset($_POST['gelombang']) && $_POST['gelombang'] !== '') ? $_POST['gelombang'] : '';
        $tgl_buka = (isset($_POST['tgl_buka']) && $_POST['tgl_buka'] !== '') ? $_POST['tgl_buka'] : '';
        $tgl_tutup = (isset($_POST['tgl_tutup']) && $_POST['tgl_tutup'] !== '') ? $_POST['tgl_tutup'] : '';
        $biaya_pendaftaran = (isset($_POST['biaya_pendaftaran']) && $_POST['biaya_pendaftaran'] !== '') ? $_POST['biaya_pendaftaran'] : '';
        $kuota = (isset($_POST['kuota']) && $_POST['kuota'] !== '') ? $_POST['kuota'] : '';
        $status = (isset($_POST['status']) && $_POST['status']) ? true : false;
        $keterangan = (isset($_POST['keterangan']) && $_POST['keterangan'] !== '') ? $_POST['keterangan'] : '';
        $data = [
            'pendidikan_id' => $pendidikan_id,
            'tahun_ajaran_id' => $tahun_ajaran_id,
            'gelombang' => $gelombang,
            'tgl_buka' => $tgl_buka,
            'tgl_tutup' => $tgl_tutup,
            'biaya_pendaftaran' => $biaya_pendaftaran,
            'kuota' => $kuota,
            'status' => $status,
            'keterangan' => $keterangan
        ];
        if(isset($_POST['id']) && $_POST['id'] !== ''){
            if($pendidikan_id && $tahun_ajaran_id && $gelombang && $tgl_buka && $tgl_tutup && $biaya_pendaftaran){
                updateId('ppdb_gelombangs', $data, $id);
                wp_redirect(ADMIN_PAGE.'ppdb-gelombang');
                exit;
            }
        }else{
            if($pendidikan_id && $tahun_ajaran_id && $gelombang && $tgl_buka && $tgl_tutup && $biaya_pendaftaran){
                insert('ppdb_gelombangs', $data);
            }    
        }

        //MEMPROSES DATA UPDATE DAN DELETE
        $find = null;
        if(isset($_GET['id']) && $_GET['id'] !== ''){
            if(isset($_GET['action']) && $_GET['action'] == 'edit'){
                $find = find('ppdb_gelombangs',$_GET['id']);            
            }else if(isset($_GET['action']) && $_GET['action'] == 'delete'){
                destroy('ppdb_gelombangs',$_GET['id']);
                wp_redirect(ADMIN_PAGE.'ppdb-gelombang');
            }
        }

        //MENGAMBIL DATA UNTUK DITAMPILKAN
        $query = "
            SELECT 
                ppdb_gelombangs.*,
                ppdb_tahun_ajarans.tahun_ajaran,
                ppdb_pendidikans.pendidikan
            FROM 
                ppdb_gelombangs
            LEFT JOIN
                ppdb_tahun_ajarans
            ON
                ppdb_gelombangs.tahun_ajaran_id = ppdb_tahun_ajarans.id
            LEFT JOIN
                ppdb_pendidikans
            ON
                ppdb_gelombangs.pendidikan_id = ppdb_pendidikans.id
            ORDER BY 
                ppdb_gelombangs.tahun_ajaran_id DESC;
        ";
        $results = query($query);
        $pendidikans = get('ppdb_pendidikans');
        $tahun_ajarans = get('ppdb_tahun_ajarans',"status = 1");
        gelombangPage($results, $find, $tahun_ajarans, $pendidikans);
    }
}

