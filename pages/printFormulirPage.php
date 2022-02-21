<?php

if(!function_exists('printFormulirPage')){
    function printFormulirPage($result = null, $nama = null, $tahun_ajarans = [], $tahun_ajaran = null, $gelombangs = [], $gelombang_val = null, $pendidikans = [], $pendidikan = null){
        $datas['datas'] = $result;
        $datas['nama'] = $nama;
        $datas['tahun_ajarans'] = $tahun_ajarans;
        $datas['tahun_ajaran'] = $tahun_ajaran;
        $datas['gelombangs'] = $gelombangs;
        $datas['gelombang_val'] = $gelombang_val;
        $datas['pendidikans'] = $pendidikans;
        $datas['pendidikan'] = $pendidikan;
        $encoded = json_encode($datas);
        header('Location: '.PLUGIN_URL.'pages/printFormulirTemplate.php?datas='.$encoded);
    }
}