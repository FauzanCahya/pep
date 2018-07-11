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

<br>
<table align="center">
    <tr>
        <td align="center">
            <h4>
                LAPORAN TRIAL BALANCE <br>
                <hr>
                PT. Prima Elektrik Power<br>
                Periode berlaku mulai tanggal <?php echo $judul; ?> 
            </h4>
        </td>
    </tr>
</table>
<table align="right">
    <tr>
        <td>Tanggal Cetak : <?php echo date('d-m-Y'); ?></td>
    </tr>
</table>
<hr>

<table class="grid" style="width: 100%;">
    <tr>
        <td></td>
        <td></td>
        <td colspan="2" style="text-align: center;">Saldo Awal</td>
        <td colspan="2" style="text-align: center;">Saldo Mutasi</td>
        <td colspan="2" style="text-align: center;">Saldo Akhir</td>
    </tr>

    <tr>
        <td class='kolom_header' style='width:10%; border-bottom:1px solid black;'> No. Akun </td>
        <td class='kolom_header' style='width:30%; border-bottom:1px solid black;'> Nama Akun </td>
        <td class='kolom_header' style='text-align:center; width:10%; border-bottom:1px solid black;'> Debit </td>
        <td class='kolom_header' style='text-align:center; width:10%; border-bottom:1px solid black;'> Kredit </td>
        <td class='kolom_header' style='text-align:center; width:10%; border-bottom:1px solid black;'> Debit </td>
        <td class='kolom_header' style='text-align:center; width:10%; border-bottom:1px solid black;'> Kredit </td>
        <td class='kolom_header' style='text-align:center; width:10%; border-bottom:1px solid black;'> Debit </td>
        <td class='kolom_header' style='text-align:center; width:10%; border-bottom:1px solid black;'> Kredit </td>
    </tr>

<?php
    $tot_debet_lalu = 0;
    $tot_kredit_lalu = 0;
    $tot_debet_mutasi = 0;
    $tot_kredit_mutasi = 0;
    $tot_debet_sa = 0;
    $tot_kredit_sa = 0;

    foreach ($dt_aktiva as $key => $row_aktiva) {
        $debet_lalu = $row_aktiva->DEBET_LALU;
        $kredit_lalu = $row_aktiva->KREDIT_LALU;
        $debet_mutasi = $row_aktiva->DEBET;
        $kredit_mutasi = $row_aktiva->KREDIT;
        $saldo_awal = $debet_lalu - $kredit_lalu;
        $saldo_mutasi = $debet_mutasi - $kredit_mutasi;
        $saldo_akhir = $saldo_awal - $saldo_mutasi;
        $debet_sa = 0;
        $kredit_sa = 0;

        if($saldo_akhir < 0){
            $debet_sa = $debet_sa;
            $kredit_sa = $saldo_akhir*(-1);
        }else{
            $debet_sa = $saldo_akhir;
            $kredit_sa = $kredit_sa;
        }

        $tot_debet_lalu += $debet_lalu;
        $tot_kredit_lalu += $kredit_lalu;
        $tot_debet_mutasi += $debet_mutasi;
        $tot_kredit_mutasi += $kredit_mutasi;
        $tot_debet_sa += $debet_sa;
        $tot_kredit_sa += $kredit_sa;
?>
    <tr>
        <td class='kolom_header' style=' width:10%; border-bottom:1px solid black;'><?php echo $row_aktiva->KODE_AKUN; ?></td>
        <td class='kolom_header' style='width:30%; border-bottom:1px solid black;'><?php echo $row_aktiva->NAMA_AKUN; ?></td>
        <td class='kolom_header' style='text-align:right; width:10%; border-bottom:1px solid black;'><?php echo number_format($debet_lalu,0,',','.'); ?></td>
        <td class='kolom_header' style='text-align:right; width:10%; border-bottom:1px solid black;'><?php echo number_format($kredit_lalu,0,',','.'); ?></td>
        <td class='kolom_header' style='text-align:right; width:10%; border-bottom:1px solid black;'><?php echo number_format($debet_mutasi,0,',','.'); ?></td>
        <td class='kolom_header' style='text-align:right; width:10%; border-bottom:1px solid black;'><?php echo number_format($kredit_mutasi,0,',','.'); ?></td>
        <td class='kolom_header' style='text-align:right; width:10%; border-bottom:1px solid black;'><?php echo number_format($debet_sa,0,',','.'); ?></td>
        <td class='kolom_header' style='text-align:right; width:10%; border-bottom:1px solid black;'><?php echo number_format($kredit_sa,0,',','.'); ?></td>
    </tr>
<?php
    }
?>
    <tr style="font-weight: bold;">
        <td class='kolom_header' style=' width:10%; border-bottom:1px solid black;'>&nbsp;</td>
        <td class='kolom_header' style='width:30%; border-bottom:1px solid black;'>TOTAL</td>
        <td class='kolom_header' style='text-align:right; width:10%; border-bottom:1px solid black;'><?php echo number_format($tot_debet_lalu,0,',','.'); ?></td>
        <td class='kolom_header' style='text-align:right; width:10%; border-bottom:1px solid black;'><?php echo number_format($tot_kredit_lalu,0,',','.'); ?></td>
        <td class='kolom_header' style='text-align:right; width:10%; border-bottom:1px solid black;'><?php echo number_format($tot_debet_mutasi,0,',','.'); ?></td>
        <td class='kolom_header' style='text-align:right; width:10%; border-bottom:1px solid black;'><?php echo number_format($tot_kredit_mutasi,0,',','.'); ?></td>
        <td class='kolom_header' style='text-align:right; width:10%; border-bottom:1px solid black;'><?php echo number_format($tot_debet_sa,0,',','.'); ?></td>
        <td class='kolom_header' style='text-align:right; width:10%; border-bottom:1px solid black;'><?php echo number_format($tot_kredit_sa,0,',','.'); ?></td>
    </tr>
</table>

<?PHP
    $width_custom = 14;
    $height_custom = 8.50; 
    $content = ob_get_clean();
    $width_in_inches = $width_custom;
    $height_in_inches = $height_custom;
    $width_in_mm = $width_in_inches * 26.4;
    $height_in_mm = $height_in_inches * 26.4;
    $html2pdf = new HTML2PDF('L',array($width_in_mm,$height_in_mm),'en');
    $html2pdf->pdf->SetTitle('Laporan Trial Balance');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('Laporan_trial_balance.pdf');
?>