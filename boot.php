<?php

add_action('init', 'start_buffer_output');
function start_buffer_output() {
        ob_start();
}

if(!defined('PLUGIN_PATH')){
    define('PLUGIN_PATH', plugin_dir_path(__FILE__));
}

if(!defined('PLUGIN_URL')){
    define('PLUGIN_URL', get_site_url().'/wp-content/plugins/ppdb/');
}

if(!defined('ADMIN_PAGE')){
    define('ADMIN_PAGE', admin_url().'admin.php?page=');
}

require_once "functions/index.php";
require_once "controllers/index.php";
require_once "pages/index.php";
require_once "menu/index.php";