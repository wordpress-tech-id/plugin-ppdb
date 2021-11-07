<?php

add_action('admin_menu', 'homeMenu');
if(!function_exists('homeMenu')){
    function homeMenu(){
        add_menu_page(
            'Penerimaan Peserta Didik Baru',
            'PPDB',
            'manage_options',
            'ppdb',
            'homeController',
            'dashicons-admin-generic',
            20
        );
    }
}

add_action('admin_menu', 'gelombangMenu');
if(!function_exists('gelombangMenu')){
    function gelombangMenu(){
        add_submenu_page(
            'ppdb',
            'Penerimaan Peserta Didik Baru',
            'Gelombang',
            'manage_options',
            'ppdb-gelombang',
            'gelombangController'
        );
    }
}

add_action('admin_menu', 'tahunAjaranMenu');
if(!function_exists('tahunAjaranMenu')){
    function tahunAjaranMenu(){
        add_submenu_page(
            'ppdb',
            'Penerimaan Peserta Didik Baru',
            'Tahun Ajaran',
            'manage_options',
            'ppdb-tahun-ajaran',
            'tahunAjaranController'
        );
    }
}

add_action('admin_menu', 'pendidikanMenu');
if(!function_exists('pendidikanMenu')){
    function pendidikanMenu(){
        add_submenu_page(
            'ppdb',
            'Jenis Pendidikan',
            'Jenis Pendidikan',
            'manage_options',
            'ppdb-pendidikan',
            'pendidikanController'
        );
    }
}