<?php

require_once PLUGIN_PATH."functions/database.php";
if(!function_exists('ppdbActivate')){
    function ppdbActivate(){
        return createTables();
    }
}

if(!function_exists('ppdbUninstall')){
    function ppdbUninstall(){
        return dropTables();
    }
}