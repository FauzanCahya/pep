<?PHP  
    ob_start(); 
    $base_url2 =  ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ?  "https" : "http");
    $base_url2 .=  "://".$_SERVER['HTTP_HOST'];
    $base_url2 .=  str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
?>

<br>
<table align="center">
    <tr>
        <td align="center" style="font-weight: bold; font-size: 16px;"><u><?php echo $title; ?></u></td>
    </tr>
    <tr>
        <td align="center" style="font-weight: bold;">PT PRIMA ELEKTRIK POWER</td>
    </tr>
    <tr>
        <td align="center" style="font-weight: bold;">Per tanggal <?php echo $judul; ?></td>
    </tr>
</table>
<br>
<br>
<table align="right">
    <tr>
        <td>Tanggal Cetak : <?php echo date('d-m-Y'); ?></td>
    </tr>
</table>
<hr style="border:1px double">
<table>
    <tr>
        <td style="width: 400px;">&nbsp;</td>
        <td style="text-align: center;">Nilai Kurs yang Berlaku saat ini terhadap dollar Rp.</td>
        <td style="width: 350px; text-align: right;">1.00</td>
    </tr>
</table>
<hr style="border:1px double;">
<table>
    <tr>
        <td>Nama Bank/Kas : <?php echo $bank; ?></td>
        <td></td>
    </tr>
</table>

<table align="right">
<?php
    $sak = 0;
    foreach ($dt as $key => $value) {
        $sa = $value->SALDO_BLN_LALU;
        $mut = $value->MUTASI;
        $sak = $sa + $mut;
?>
    <tr>
        <td>Saldo Awal</td>
        <td><?php echo number_format($value->SALDO_BLN_LALU,0,',','.'); ?></td>
    </tr>
    <tr>
        <td>Mutasi</td>
        <td><?php echo number_format($mut,0,',','.'); ?></td>
    </tr>
<?php
    }
?>
    <tr>
        <td>&nbsp;</td>
        <td><hr></td>
    </tr>
    <tr>
        <td>Saldo Akhir</td>
        <td><?php echo number_format($sak,0,',','.'); ?></td>
    </tr>
</table>

<br>
<br>
<hr>
<h5>Pemasukan</h5>
<hr>
<h5>Pengeluaran</h5>
<hr>
Total Pemasukan - Total Pengeluaran
<hr>

<?PHP
    $width_custom = 14;
    $height_custom = 8.50;
    
    $content = ob_get_clean();
    $width_in_inches = $width_custom;
    $height_in_inches = $height_custom;
    $width_in_mm = $width_in_inches * 21.4;
    $height_in_mm = $height_in_inches * 19.8;
    $html2pdf = new HTML2PDF('L','A4','en');
    $html2pdf->pdf->SetTitle('Laporan Cash Flow');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output($filename.'.pdf');
?>