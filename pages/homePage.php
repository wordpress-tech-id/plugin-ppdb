<?php

require_once PLUGIN_PATH."pages/homeFormPage.php";    
require_once PLUGIN_PATH."pages/homeTablePage.php";    

if(!function_exists('homePage')){
    function homePage($datas = null, $data = null, $tahun_ajarans = null, $gelombangs = null, $pendidikans = null){
        homeFormPage($data, $tahun_ajarans, $gelombangs, $pendidikans);
        homeTablePage($datas);
    }
}