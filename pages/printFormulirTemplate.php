<?php
    // require_once "../lib/fpdf184/fpdf.php";
    // $pdf = new FPDF();
    // $pdf->AddPage();
    // $pdf->SetFont('Arial','B',16);
    // $pdf->Cell(40,10,'Hello World!');
    // $pdf->Output();

    require_once "../lib/dompdf/autoload.inc.php";
    require_once "../functions/formatter.php";

    use Dompdf\Dompdf;

    // instantiate and use the dompdf class
    $dompdf = new Dompdf();
    // $dompdf->getOptions()->setChroot('/path/to/common/assets-directory');
    $html = <<<HTML
    HTML;
    
    $datas = json_decode($_GET['datas']);
    foreach($datas->datas as $data){
        $lembaga = strtoupper($data->lembaga);
        $jenjang = strtoupper($data->pendidikan);

        $imageData = base64_encode(file_get_contents($data->logo));
        $extension = pathinfo($data->logo, PATHINFO_EXTENSION);
        $logo_src = 'data:image/'.$extension.';base64,'.$imageData;

        $siswa_nama_lengkap = strtoupper($data->siswa_nama_lengkap);
        $siswa_lahir_tmpt = strtoupper($data->siswa_lahir_tmpt);
        $siswa_pendidikan_akhir = strtoupper($data->siswa_pendidikan_akhir);
        $siswa_status_keluarga = strtoupper($data->siswa_status_keluarga);
        $siswa_riwayat_penyakit = strtoupper($data->siswa_riwayat_penyakit);
        $ayah_nama = strtoupper($data->ayah_nama);
        $ayah_lahir_tmpt = strtoupper($data->ayah_lahir_tmpt);
        $ayah_pekerjaan = strtoupper($data->ayah_pekerjaan);
        $ibu_nama = strtoupper($data->ibu_nama);
        $ibu_lahir_tmpt = strtoupper($data->ibu_lahir_tmpt);
        $ibu_pekerjaan = strtoupper($data->ibu_pekerjaan);
        $anak_tgl = tgl_indo(date('Y-m-d',strtotime($data->siswa_lahir_tgl)));
        $ayah_tgl = tgl_indo(date('Y-m-d',strtotime($data->ayah_lahir_tgl)));
        $ibu_tgl = tgl_indo(date('Y-m-d',strtotime($data->ibu_lahir_tgl)));
        $tanggal_daftar = tgl_indo(date('Y-m-d',strtotime($data->tanggal_daftar)));
        $usia = usia(date('Y-m-d',strtotime($data->siswa_lahir_tgl)),date("Y-m-d"));
        $html .= <<<HTML
        <table width="100%">
            <tr>
                <td width="30%"><img src="$logo_src" width="150" height="150"></td>
                <td width="70%" align="center">
                    <h2>$lembaga</h2>
                    $data->alamat
                </td>
            </tr>
        </table>
        <br />
        <center>
        <h3>FORMULIR PENDAFTRAN CALON SANTRI BARU<br />$lembaga<br />TAHUN AJARAN 2021-2023<br />(JENJANG $jenjang)</h3>
        <h3></h3>
        </center>
        <table width="100%">
            <tr>
                <td><b>A.</b></td>
                <td colspan="4"><b>IDENTITAS CALON SANTRI</b></td>
            </tr>
            <tr>
                <td width="3%"></td>
                <td width="3%">1.</td>
                <td width="25%">Nama Lengkap</td>
                <td width="3%">:</td>
                <td>$siswa_nama_lengkap</td>
            </tr>
            <tr>
                <td></td>
                <td>2.</td>
                <td>Tempat/Tanggal Lahir</td>
                <td>:</td>
                <td>$siswa_lahir_tmpt/$anak_tgl</td>
            </tr>
            <tr>
                <td></td>
                <td>3.</td>
                <td>Usia</td>
                <td>:</td>
                <td>$usia</td>
            </tr>
            <tr>
                <td></td>
                <td>4.</td>
                <td>Pendidikan Terakhir</td>
                <td>:</td>
                <td>$siswa_pendidikan_akhir</td>
            </tr>
            <tr>
                <td></td>
                <td>5.</td>
                <td>Status dalam Keluarga</td>
                <td>:</td>
                <td>$siswa_status_keluarga</td>
            </tr>
            <tr>
                <td></td>
                <td>6.</td>
                <td>Keadaan Jasmani Anak</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>a. Berat/Tinggi Badan</td>
                <td>:</td>
                <td>$data->siswa_berat_badan/$data->siswa_tinggi_badan</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>b. Riwayat Penyakit</td>
                <td>:</td>
                <td>$siswa_riwayat_penyakit</td>
            </tr>
            <tr>
                <td colspan="5"></td>
            </tr>
            <tr>
                <td><b>B.</b></td>
                <td colspan="4"><b>IDENTITAS CALON WALI SANTRI/ORANG TUA</b></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td colspan="3"><b>Ayah Kandung/Tiri/Angkat/Wali</b></td>
            </tr>
            <tr>
                <td></td>
                <td>1.</td>
                <td>Nama</td>
                <td>:</td>
                <td>$ayah_nama</td>
            </tr>
            <tr>
                <td></td>
                <td>2.</td>
                <td>Tempat/Tanggal Lahir</td>
                <td>:</td>
                <td>$ayah_lahir_tmpt/$ayah_tgl</td>
            </tr>
            <tr>
                <td></td>
                <td>3.</td>
                <td>Pekerjaan</td>
                <td>:</td>
                <td>$ayah_pekerjaan</td>
            </tr>
            <tr>
                <td></td>
                <td>4.</td>
                <td>Penghasilan Per Bulan</td>
                <td>:</td>
                <td>$ayah_penghasilan</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td colspan="3"><b>Ibu Kandung/Tiri/Angkat/Wali</b></td>
            </tr>
            <tr>
                <td></td>
                <td>1.</td>
                <td>Nama</td>
                <td>:</td>
                <td>$ibu_nama</td>
            </tr>
            <tr>
                <td></td>
                <td>2.</td>
                <td>Tempat/Tanggal Lahir</td>
                <td>:</td>
                <td>$ibu_lahir_tmpt/$ibu_tgl</td>
            </tr>
            <tr>
                <td></td>
                <td>3.</td>
                <td>Pekerjaan</td>
                <td>:</td>
                <td>$ibu_pekerjaan</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><b>No WA Wali Santri</b></td>
                <td>:</td>
                <td>$data->ayah_no_hp</td>
            </tr>
        </table>
        <br />
        <table width="100%">
            <tr>
                <td width="60%"><td>
                <td width="40%">
                    Rangkasbitung, $tanggal_daftar 
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <b>$ayah_nama</b>
                <td>
            </tr>
        </table>
        <div style="page-break-before: always;"></div>
        HTML;
    }

    // var_dump($html);
    $dompdf->loadHtml($html);
    
    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'portrait');
    
    // Render the HTML as PDF
    $dompdf->render();
    
    // Output the generated PDF to Browser
    $dompdf->stream();
?>