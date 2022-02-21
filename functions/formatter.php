<?php

function toDate($date,$format = "d-m-Y"){
    return date_format (new DateTime($date), $format);
}

function toRupiah($value, $decimal = 0){
    return "Rp. " . number_format($value, $decimal, ",", ".");
}

function tgl_indo($tanggal, $cetak_hari = false){
    $hari = array ( 1 =>    'Senin',
    'Selasa',
    'Rabu',
    'Kamis',
    'Jumat',
    'Sabtu',
    'Minggu'
    );

    $bulan = array (1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $split 	  = explode('-', $tanggal);
    $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];

    if ($cetak_hari) {
        $num = date('N', strtotime($tanggal));
        return $hari[$num] . ', ' . $tgl_indo;
    }
    return $tgl_indo;
}

function usia($first,$second){
  $diff = date_diff(date_create($first), date_create($second));
  return $diff->y;
}

function uploadfile($directory, $origin, $tmp_name)
{

    $upload_dir = wp_upload_dir();
    $base_dir = $upload_dir['basedir'];
    $base_url = $upload_dir['baseurl'];
    $lokasi = $base_dir.'/'.$directory;
    if (!file_exists($lokasi)) {
        mkdir($lokasi, 0777);
    }
    $dest = $lokasi.'/';
    $baseurl = $base_url.'/'.$directory.'/'.strtolower($origin);
    $origin = strtolower(basename($origin));
    $fulldest = $dest.$origin;
    $filename = $origin;
    // for ($i=1; file_exists($fulldest); $i++)
    // {
    //     $fileext = (strpos($origin,'.')===false?'':'.'.substr(strrchr($origin, "."), 1));
    //     $filename = substr($origin, 0, strlen($origin)-strlen($fileext)).'['.$i.']'.$fileext;
    //     $fulldest = $dest.$newfilename;
    // }
    
    if (move_uploaded_file($tmp_name, $fulldest))
        return $baseurl;
    return false;
}