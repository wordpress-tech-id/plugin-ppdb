<?php

function toDate($date,$format = "d-m-Y"){
    return date_format (new DateTime($date), $format);
}

function toRupiah($value, $decimal = 0){
    return "Rp. " . number_format($value, $decimal, ",", ".");
}