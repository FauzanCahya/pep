<?PHP  
ob_start(); 
$base_url2 =  ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ?  "https" : "http");
$base_url2 .=  "://".$_SERVER['HTTP_HOST'];
$base_url2 .=  str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
?>
<style>
.gridth {
    background: #1793d1;
    vertical-align: middle;
    color : #FFF;
    text-align: center;
    height: 30px;
    font-size: 20px;
}
.gridtd {
    background: #FFFFF0;
    vertical-align: middle;
    font-size: 14px;
    height: 30px;
    padding-left: 5px;
    padding-right: 5px;
}
.grid {
    background: #FAEBD7;
    border-collapse: collapse;
}

.grid td, table th {
  border: 1px solid black;
}

.kolom_header{
    height: 20px;
}

</style>

<br>
<table align="center">
    <tr>
        <td align="center">
            <h4>
                LAPORAN JURNAL UMUM <br>
                <hr>
                <?=$judul;?><br>
                PT. Prima Elektrik Power<br>
                Periode berlaku mulai tanggal 
            </h4>
        </td>
    </tr>
</table>
<table align="right">
    <tr>
        <td>Tanggal Cetak : </td>
    </tr>
</table>
<hr>

<div style="width: 100%;">
    <table style="border: 1px; border-collapse: collapse; width: 100%;">
    <?php
        $sql = "
            SELECT a.* FROM ak_input_voucher a
            WHERE a.TGL LIKE '%-$bulan-$tahun%' AND a.TIPE = 'JU'
            ORDER BY a.ID ASC
        ";
        $qry = $this->db->query($sql);
        $res = $qry->result();

        foreach ($res as $key => $val) {
    ?>
        <tr>
            <td>Tgl Transaksi</td>
            <td style="width: 60%;">: <?=$val->TGL;?></td>
            <td style="text-align:right;">Tgl Posting : <?=$val->TGL;?></td>
        </tr>
        <tr>
            <td>Reff</td>
            <td>: <?=$val->NO_VOUCHER;?></td>
        </tr>
        <tr>
            <td>Keterangan</td>
            <td>: <?=$val->KETERANGAN;?></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
    <?php
            $s = "
                SELECT a.*, b.NAMA_AKUN FROM ak_input_voucher_detail a 
                JOIN ak_kode_akuntansi b ON a.KODE_AKUN = b.KODE_AKUN
                WHERE a.TGL LIKE '%-$bulan-$tahun%' AND a.TIPE = 'JU'
                AND a.ID_VOUCHER = '".$val->ID."'
                ORDER BY a.ID ASC
            ";
            $q = $this->db->query($s);
            $r = $q->result();
    ?>
        <tr>
            <td style="border-bottom:1px dotted;">No Akun</td>
            <td style="border-bottom:1px dotted;">Nama Akun</td>
            <td style="border-bottom:1px dotted; text-align: center;">Debet</td>
            <td style="border-bottom:1px dotted; text-align: center;">Kredit</td>
        </tr>
    <?php
            $i = 0;
            $tot_debet = 0;
            $tot_kredit = 0;

            foreach ($r as $k => $value) {
                $tot_debet += $value->KREDIT;
                $tot_kredit += $value->DEBET;
    ?>
        <tr>
            <td><?=$value->KODE_AKUN;?></td>
            <td><?=$value->NAMA_AKUN;?></td>
            <td style="text-align: right;"><?=number_format($value->DEBET);?></td>
            <td style="text-align: right;"><?=number_format($value->KREDIT);?></td>
        </tr>
    <?php
            }
    ?>
        <tr>
            <td style="border-bottom: 1px solid black;">&nbsp;</td>
            <td style="border-bottom: 1px solid black;">&nbsp;</td>
            <td style="border-bottom: 1px solid black;">&nbsp;</td>
            <td style="border-bottom: 1px solid black;">&nbsp;</td>
            <td style="border-bottom: 1px solid black;">&nbsp;</td>
        </tr>
    <?php
        }
    ?>
        <tr>
            <td colspan="2" style="text-align: center;"><b>Jumlah Total</b></td>
            <td style="text-align: right;"><b><?=number_format($tot_debet);?></b></td>
            <td style="text-align: right;"><b><?=number_format($tot_kredit);?></b></td>
        </tr>
    </table>
</div>

<?PHP
    $width_custom = 14;
    $height_custom = 8.50;
    
    $content = ob_get_clean();
    $width_in_inches = $width_custom;
    $height_in_inches = $height_custom;
    $width_in_mm = $width_in_inches * 21.4;
    $height_in_mm = $height_in_inches * 19.8;
    $html2pdf = new HTML2PDF('P','A4','en');
    $html2pdf->pdf->SetTitle('Cetak Jurnal Umum');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('jurnal_umum.pdf');
?>