<?PHP  
ob_start(); 
$base_url2 =  ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ?  "https" : "http");
$base_url2 .=  "://".$_SERVER['HTTP_HOST'];
$base_url2 .=  str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
?>

<style>
.gridth {
    vertical-align: middle;
    color : #FFF;
    text-align: center;
    font-size: 14px;
}
.gridtd {
    vertical-align: middle;
    font-size: 14px;
    padding-left: 5px;
    padding-right: 5px;
    border:1px dotted black;
}
.grid {
    border-collapse: collapse;
}

.grid {
  /*border: 1px solid black;*/
  padding-top:5px;
  padding-bottom:5px;
}

.kolom_header{
    height: 20px;
}

</style>

<table align="center" style="width:100%;">
    <tr>
        <td align="center">
            <h3>
                Laporan Buku Besar <br>
                <hr>
                PT. Prima Elektrik Power<br>
                Periode berlaku mulai tanggal <?php echo $judul; ?> 
            </h3>
        </td>
    </tr>
</table>

<table align="right">
    <tr>
        <td>Tanggal Cetak : <?php echo date('d-m-Y'); ?></td>
    </tr>
</table>
<hr>

<table align="center" class="grid" style="width:100%;">
<?php
    $u          = 1 ;
    $baris      = 0 ;
    $kolom      = 0 ;
    $debet      = 0 ;
    $kredit     = 0 ;
    $old_koper  = '' ;
    $next_koper = '' ;
    $last_key   = end(array_keys($dt));
    $total_debet  = 0;
    $total_kredit = 0;
    $debet2  = 0;
    $kredit2 = 0;

    foreach ($dt as $key => $row) {
        $koper = trim($row->KODE_AKUN);
        $nama_akun = $row->NAMA_AKUN;
        $kode_grup = $row->KODE_GRUP;
        $grup = $row->GRUP;

?>
    <tr>
        <td style='background:#FFF; border:none; height:25px;' class='isi_no_border' colspan='6'>&nbsp;</td>
    </tr>

    <tr>
        <td style='vertical-align:middle; height:15px; background:#FFF; border:none;' class='isi_no_border'><b style='font-size:15px;'><u><?php echo $koper; ?></u></b></td>
        <td style='vertical-align:middle; height:15px; background:#FFF; border:none;' class='isi_no_border' colspan='5'><b style='font-size:15px;'><u><?php echo $nama_akun; ?></u></b></td>
    </tr>

    <tr>
        <td style='vertical-align:middle; height:15px; background:#FFF; border:none;' class='isi_no_border'><i>Master Akun</i></td>
        <td style='vertical-align:middle; height:15px; background:#FFF; border:none;' class='isi_no_border'><i><?php echo $kode_grup; ?>&nbsp;&nbsp;<?php echo $grup; ?></i></td>
    </tr>

    <tr>
        <td style='vertical-align:middle; height:15px; background:#FFF; border:none;' class='isi_no_border' colspan='2'></td>
        <td style='vertical-align:middle; height:15px; background:#FFF; border:none; text-align:center;' class='isi_no_border' colspan='2'>Mutasi</td>
        <td style='vertical-align:middle; height:15px; background:#FFF; border:none; text-align:center;' class='isi_no_border' colspan='2'>Saldo</td>
    </tr>
<?php
    }
?>

    <tr>
        <td class='kolom_header' style='text-align:center; width:10%; border-bottom:1px solid black;'> Tanggal </td>
        <td class='kolom_header' style='text-align:center; width:30%; border-bottom:1px solid black;'> Keterangan </td>
        <td class='kolom_header' style='text-align:center; width:10%; border-bottom:1px solid black;'> Debit </td>
        <td class='kolom_header' style='text-align:center; width:10%; border-bottom:1px solid black;'> Kredit </td>
        <td class='kolom_header' style='text-align:center; width:10%; border-bottom:1px solid black;'> Debit </td>
        <td class='kolom_header' style='text-align:center; width:10%; border-bottom:1px solid black;'> Kredit </td>
    </tr>

<?php
    $sql = "
        SELECT
            a.ID,
            a.TGL,
            SUM(a.TOTAL) AS SALDO_AWAL
        FROM ak_input_voucher a
        WHERE a.TGL LIKE '%-$bulan_lalu-$tahun%'
        GROUP BY a.TGL
    ";
    $qry = $this->db->query($sql);
    $brs = $qry->row();
    $saldo_awal = $brs->SALDO_AWAL;
?>
    <tr>
        <td class='kolom_header' style='text-align:center; width:10%; border-bottom:1px solid black;'>&nbsp;</td>
        <td class='kolom_header' style='width:30%; border-bottom:1px solid black;'> Saldo Awal </td>
        <td class='kolom_header' style='text-align:center; width:10%; border-bottom:1px solid black;'>&nbsp;</td>
        <td class='kolom_header' style='text-align:center; width:10%; border-bottom:1px solid black;'>&nbsp;</td>
        <td class='kolom_header' style='text-align:right; width:10%; border-bottom:1px solid black;'><?php echo number_format($saldo_awal,2,'.',','); ?></td>
        <td class='kolom_header' style='text-align:right; width:10%; border-bottom:1px solid black;'>0.00</td>
    </tr>
<?php
    $s = "
        SELECT
            a.ID,
            a.NO_BUKTI,
            a.KODE_AKUN,
            a.KREDIT,
            a.TGL,
            a.KETERANGAN
        FROM ak_input_voucher_detail a
        JOIN ak_input_voucher b ON b.ID = a.ID_VOUCHER
        WHERE a.KREDIT != 0
        AND a.TGL LIKE '%-$bulan-$tahun%'
    ";
    $q = $this->db->query($s);
    $r = $q->result();
    $tot_debet_mut = 0;
    $tot_kredit_mut = 0;

    foreach ($r as $k => $v) {
        $nilDebet = 0;
        $nilKredit = 0;
        $nilKreditFix = $v->KREDIT;
        $nilDebetFix = $saldo_awal - $nilKreditFix;
        $tot_debet_mut += $nilDebet;
        $tot_kredit_mut += $nilKreditFix;
?>
    <tr>
        <td class='gridtd' style='text-align:center;'><?php echo $v->TGL; ?></td>
        <td class='gridtd'><?php echo $v->KETERANGAN; ?></td>
        <td class='gridtd'><?php echo number_format($nilDebet, 2, '.', ','); ?></td> 
        <td class='gridtd'><?php echo number_format($nilKreditFix, 2, '.', ','); ?></td> 
        <td class='gridtd'><?php echo number_format($nilDebetFix, 2, '.', ','); ?></td>
        <td class='gridtd'><?php echo number_format($nilKredit, 2, '.', ','); ?></td>
    </tr>
<?php
    }
?>
    <tr>
        <td style="text-align: center;" colspan="2">TOTAL MUTASI</td>
        <td style="text-align: right;"><?php echo number_format($tot_debet_mut, 2, '.', ','); ?></td>
        <td style="text-align: right;"><?php echo number_format($tot_kredit_mut, 2, '.', ','); ?></td>
        <td style="text-align: right;"><?php echo number_format(0, 2, '.', ','); ?></td>
        <td style="text-align: right;"><?php echo number_format(0, 2, '.', ','); ?></td>
    </tr>
</table>

<?PHP if(count($dt) == 0){ ?>
<table align="center" class="grid" style="width:100%;">
    <tr>
        <th style='text-align:center; width:15%;' class='kolom_header'> Tanggal </th>
        <th style='text-align:center; width:15%;' class='kolom_header'> Uraian </th>
        <th style='text-align:center; width:15%;' class='kolom_header'> Nomor Bukti </th>
        <th style='text-align:center; width:15%;' class='kolom_header'> Debet </th>
        <th style='text-align:center; width:15%;' class='kolom_header'> Kredit </th>
    </tr>
    <tr>
        <td class='gridtd' colspan='6' align="center"> <b> Tidak ada data yang dapat ditampilkan </b> </td>
    </tr>
</table>
<?PHP } ?>


<?PHP
    $width_custom = 14;
    $height_custom = 8.50; 
    $content = ob_get_clean();
    $width_in_inches = $width_custom;
    $height_in_inches = $height_custom;
    $width_in_mm = $width_in_inches * 26.4;
    $height_in_mm = $height_in_inches * 26.4;
    $html2pdf = new HTML2PDF('L',array($width_in_mm,$height_in_mm),'en');
    $html2pdf->pdf->SetTitle('Laporan Buku Besar');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('Laporan_buku_besar.pdf');
?>