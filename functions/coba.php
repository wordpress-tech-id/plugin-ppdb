<?php

if(!function_exists('coba')){
    function coba(){
        return "Percobaan Nih";
    }    
}

if(!shortcode_exists('coba')){
    add_shortcode('coba','coba');
}