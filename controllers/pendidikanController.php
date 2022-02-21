<?php
require_once PLUGIN_PATH."functions/formatter.php";

if(!function_exists('pendidikanController')){
    function pendidikanController(){
        //MENGAMBIL DATA POS
        $id = (isset($_POST['id']) && $_POST['id'] !== '') ? $_POST['id'] : '';
        $pendidikan = (isset($_POST['pendidikan']) && $_POST['pendidikan'] !== '') ? $_POST['pendidikan'] : '';
        $lembaga = (isset($_POST['lembaga']) && $_POST['lembaga'] !== '') ? $_POST['lembaga'] : '';
        $alamat = (isset($_POST['alamat']) && $_POST['alamat'] !== '') ? $_POST['alamat'] : '';
        $logo = (isset($_FILES['logo']) && $_FILES['logo'] !== '') ? $_FILES['logo'] : '';
        $keterangan = (isset($_POST['keterangan']) && $_POST['keterangan'] !== '') ? $_POST['keterangan'] : '';
        $data = [
            'pendidikan' => $pendidikan,
            'lembaga' => $lembaga,
            'alamat' => $alamat,
            'keterangan' => $keterangan
        ];

        if(isset($_FILES['logo']) && $_FILES['logo']['name'] !== ''){
            if($_FILES['logo']['name'] !== "") {
                $file = uploadfile('images', $pendidikan.'.'.preg_replace('@.+\.@', '', $_FILES['logo']['name']),$_FILES['logo']['tmp_name']);
                $data['logo'] = $file;
            }    
        }

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
                wp_redirect(ADMIN_PAGE.'ppdb-pendidikan');
            }
        }

        //MENGAMBIL DATA UNTUK DITAMPILKAN
        $results = all('ppdb_pendidikans');
        pendidikanPage($results, $find);
    }
}