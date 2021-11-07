<?php
if(!function_exists('tahunAjaranController')){
    function tahunAjaranController(){
        //MENGAMBIL DATA POS
        $id = (isset($_POST['id']) && $_POST['id'] !== '') ? $_POST['id'] : '';
        $tahun_ajaran = (isset($_POST['tahun_ajaran']) && $_POST['tahun_ajaran'] !== '') ? $_POST['tahun_ajaran'] : '';
        $tahun = (isset($_POST['tahun']) && $_POST['tahun'] !== '') ? $_POST['tahun'] : '';
        $tahun_aktif = (isset($_POST['tahun_aktif']) && $_POST['tahun_aktif']) ? true : false;
        $status = (isset($_POST['status']) && $_POST['status']) ? true : false;
        $keterangan = (isset($_POST['keterangan']) && $_POST['keterangan'] !== '') ? $_POST['keterangan'] : '';
        $data = [
            'tahun_ajaran' => $tahun_ajaran,
            'tahun' => $tahun,
            'tahun_aktif' => $tahun_aktif,
            'status' => $status,
            'keterangan' => $keterangan
        ];
        if(isset($_POST['id']) && $_POST['id'] !== ''){
            if($tahun_ajaran && $tahun){
                updateId('ppdb_tahun_ajarans', $data, $id);
                wp_redirect(ADMIN_PAGE.'ppdb-tahun-ajaran');
                exit;
            }
        }else{
            if($tahun_ajaran && $tahun){
                insert('ppdb_tahun_ajarans', $data);
            }    
        }

        //MEMPROSES DATA UPDATE DAN DELETE
        $find = null;
        if(isset($_GET['id']) && $_GET['id'] !== ''){
            if(isset($_GET['action']) && $_GET['action'] == 'edit'){
                $find = find('ppdb_tahun_ajarans',$_GET['id']);            
            }else if(isset($_GET['action']) && $_GET['action'] == 'delete'){
                destroy('ppdb_tahun_ajarans',$_GET['id']);
            }
        }

        //MENGAMBIL DATA UNTUK DITAMPILKAN
        $results = all('ppdb_tahun_ajarans');
        tahunAjaranPage($results, $find);
    }
}