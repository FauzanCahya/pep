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

<table style="width: 100%">
	<tr>
		<td style="width: 50%;text-align: left;">PT PRIMA ELEKTRIK POWER</td>
		<td style="width: 28%;text-align: left;"></td>
	</tr>
	<tr>
		<td style="width: 50%;text-align: left;">Sumangko Wringin Anom Gresik</td>
		<td style="width: 28%;text-align: left;"></td>
	</tr>
	<tr>
		<td style="width: 50%;text-align: left;">Jawa Timur - Indonesia</td>
		<td style="width: 28%;text-align: left;"></td>
	</tr>
</table>


<br>
<table align="center">
    <tr>
        <td align="center">
            <h4 style="text-decoration: underline;">
                TAGIHAN JATUH TEMPO
            </h4>
        </td>
    </tr>
</table>
<br>
<div style="height: 300px;">
<table style="width: 100%;height: 300px;border-collapse: collapse;">
	
		<tr >
			<th style="width: 40%;padding: 5px 5px 5px 5px; border: 1px solid black; text-align: center;">No Transaksi</th>
			<th style="width: 20%;padding: 5px 5px 5px 5px; border: 1px solid black; text-align: center;">Nilai</th>
			<th style="width: 20%;padding: 5px 5px 5px 5px; border: 1px solid black; text-align: center;">Jatuh Tempo</th>
			<th style="width: 20%;padding: 5px 5px 5px 5px; border: 1px solid black; text-align: center;">Sisa Hari</th>
		</tr>
		<?PHP foreach ($dt as $key => $row) { ?>
		<tr>
			<td style="border: 1px solid black;padding: 5px 5px 5px 5px;"><?=$dt->NO_BUKTI;?></td>
			<td style="border: 1px solid black;padding: 5px 5px 5px 5px;"><?=$dt->DIBAYAR;?></td>
			<td style="border: 1px solid black;padding: 5px 5px 5px 5px;"><?=$dt->TGL_JATUH_TEMPO;?></td>
			<td style="border: 1px solid black;padding: 5px 5px 5px 5px;"><?=$dt->selisih;?> hari lagi</td>
		</tr>
		<?PHP } ?>
		<?PHP 
		if(count($dt) == 0){
		?>
		<tr>
			<td style="text-align: center; border: 1px solid black;padding: 5px 5px 5px 5px;" colspan="4"><b>TIDAK ADA TAGIHAN JATUH TEMPO</b></td>
		</tr>
		<?PHP
		}
		?>
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
    $html2pdf = new HTML2PDF('L','A4','en');
    $html2pdf->pdf->SetTitle('Laporan Jatuh Tempo');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('Laporan_jatuh_tempo.pdf');
?>