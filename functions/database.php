<?php

if(!function_exists('createTable')){
    function createTables(){
        global $wpdb;
        $pendidikan = "
            CREATE TABLE 
                ppdb_pendidikans (
                    id int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    pendidikan char(20),
                    keterangan char(100) DEFAULT NULL
                );
        ";

        $tahun_ajaran = "
            CREATE TABLE 
                ppdb_tahun_ajarans (
                    id int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    tahun_ajaran char(20),
                    tahun int(4),
                    tahun_aktif BOOLEAN,
                    status BOOLEAN,
                    keterangan char(100) DEFAULT NULL
                );
        ";
        $gelombang = "
            CREATE TABLE
                ppdb_gelombangs (
                    id int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    pendidikan_id char(11),
                    tahun_ajaran_id char(11),
                    gelombang char(50),
                    tgl_buka datetime,
                    tgl_tutup datetime,
                    biaya_pendaftaran int(11),
                    kuota int(11),
                    status BOOLEAN,
                    keterangan char(100) DEFAULT NULL
                );
        ";
        $pendaftar = "
            CREATE TABLE
                ppdb_pendaftars (
                    id int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    gelombang_id int(11),
                    siswa_nama_lengkap char(100),
                    siswa_lahir_tmpt char(50),
                    siswa_lahir_tgl datetime,
                    siswa_pendidikan_id int(11),
                    siswa_pendidikan_akhir char(50),
                    siswa_status_keluarga char(50),
                    siswa_berat_badan int(4),
                    siswa_tinggi_badan int(10),
                    siswa_riwayat_penyakit char(100),
                    ayah_no_hp char(20),
                    ayah_status char(50),
                    ayah_nama char(100),
                    ayah_lahir_tmpt char(50),
                    ayah_lahir_tgl datetime,
                    ayah_pekerjaan char(50),
                    ayah_penghasilan char(50),
                    ibu_status char(50),
                    ibu_nama char(100),
                    ibu_lahir_tmpt char(50),
                    ibu_lahir_tgl datetime,
                    ibu_pekerjaan char(50),
                    keterangan char(100) DEFAULT NULL
                );
        ";
        $result0 = $wpdb->query($pendidikan);
        $result1 = $wpdb->query($tahun_ajaran);
        $result2 = $wpdb->query($gelombang);
        $result3 = $wpdb->query($pendaftar);
        return ($result0 && $result1 && $result2 && $result3) ? true : false;
    }

    function dropTables(){
        global $wpdb;
        $pendidikan = "DROP TABLE ppdb_pendidikans;";
        $tahun_ajaran = "DROP TABLE ppdb_tahun_ajarans;";
        $gelombang = "DROP TABLE ppdb_gelombangs;";
        $pendaftar = "DROP TABLE ppdb_pendaftars;";
        $result0 = $wpdb->query($pendidikan);
        $result1 = $wpdb->query($tahun_ajaran);
        $result2 = $wpdb->query($gelombang);
        $result3 = $wpdb->query($pendaftar);
        return ($result0 && $result1 && $result2 && $result3) ? true : false;
    }
    function all($tableName = null, $condition = null){
        global $wpdb;
        $query = "SELECT * FROM ".$tableName;
        return $wpdb->get_results($query);
    }
    function find($tableName = null, $id = null){
        global $wpdb;
        $query = "SELECT * FROM ".$tableName." WHERE id = ".$id;
        return $wpdb->get_row($query);
    }
    function get($tableName = null, $condition = null){
        global $wpdb;
        $where = ($condition != null || $condition != '') ? " AND ".$condition : '';
        $query = "SELECT * FROM ".$tableName." WHERE 1".$where;
        return $wpdb->get_results($query);
    }
    function insert($table, $data){
        global $wpdb;
        $wpdb->insert($table, $data);
        return $wpdb->insert_id;
    }
    function destroy($tableName = null, $id = null){
        global $wpdb;
        $data = [
            'id' => $id
        ];
        return $wpdb->delete($tableName, $data);
    }
    function destroyAll($tableName = null, $data = null){
        global $wpdb;
        return $wpdb->delete($tableName, $id);
    }
    function updateId($tableName = null, $data = null, $id = null){
        global $wpdb;
        $where = [
            'id' => $id
        ];
        return $wpdb->update($tableName, $data, $where);
    }
    function update($tableName = null, $data = null, $where = null, $id = null){
        global $wpdb;
        $wheres = [
            $where => $id
        ];
        return $wpdb->update($tableName, $data, $wheres);
    }
    function query($query){
        global $wpdb;
        $hasil = $wpdb->get_results($query);
        return $hasil;
    }
}