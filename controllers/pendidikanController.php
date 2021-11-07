<?php
if(!function_exists('pendidikanController')){
    function pendidikanController(){
        //MENGAMBIL DATA POS
        $id = (isset($_POST['id']) && $_POST['id'] !== '') ? $_POST['id'] : '';
        $pendidikan = (isset($_POST['pendidikan']) && $_POST['pendidikan'] !== '') ? $_POST['pendidikan'] : '';
        $keterangan = (isset($_POST['keterangan']) && $_POST['keterangan'] !== '') ? $_POST['keterangan'] : '';
        $data = [
            'pendidikan' => $pendidikan,
            'keterangan' => $keterangan
        ];
        if(isset($_POST['id']) && $_POST['id'] !== ''){
            if($pendidikan){
                updateId('ppdb_pendidikans', $data, $id);
                wp_redirect(ADMIN_PAGE.'ppdb-pendidikan');
                exit;
            }
        }else{
            if($pendidikan){
                insert('ppdb_pendidikans', $data);
            }    
        }

        //MEMPROSES DATA UPDATE DAN DELETE
        $find = null;
        if(isset($_GET['id']) && $_GET['id'] !== ''){
            if(isset($_GET['action']) && $_GET['action'] == 'edit'){
                $find = find('ppdb_pendidikans',$_GET['id']);            
            }else if(isset($_GET['action']) && $_GET['action'] == 'delete'){
                destroy('ppdb_pendidikans',$_GET['id']);
            }
        }

        //MENGAMBIL DATA UNTUK DITAMPILKAN
        $results = all('ppdb_pendidikans');
        pendidikanPage($results, $find);
    }
}