<?php

if(!function_exists('exportTablePage')){
    function exportTablePage($datas = null){
        $encoded = json_encode($datas);
        header('Location: '.PLUGIN_URL.'pages/exportTemplate.php?datas='.$encoded);
    }
}