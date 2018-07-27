<?PHP  
ob_start(); 
$base_url2 =  ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ?  "https" : "http");
$base_url2 .=  "://".$_SERVER['HTTP_HOST'];
$base_url2 .=  str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
?>
<style>


</style>

<table style="width: 100%">
	<tr>
		<td style="width: 50%;text-align: left;">PT PRIMA ELEKTRIK POWER</td>
		<td style="width: 28%;text-align: left;"></td>
		<td style="width: 7%;text-align: right;border: 1px solid black;">Tipe</td>
		<td style="width: 15%;text-align: right;border: 1px solid black;">Bukti A</td>
	</tr>
	<tr>
		<td style="width: 50%;text-align: left;">Sumangko Wringin Anom Gresik</td>
		<td style="width: 28%;text-align: left;"></td>
		<td style="width: 7%;text-align: right;border: 1px solid black;">Tgl</td>
		<td style="width: 15%;text-align: right;border: 1px solid black;"><?=$dt->tanggal;?></td>
	</tr>
	<tr>
		<td style="width: 50%;text-align: left;">Jawa Timur - Indonesia</td>
		<td style="width: 28%;text-align: left;"></td>
		<td style="width: 7%;text-align: right;border: 1px solid black;">No</td>
		<td style="width: 15%;text-align: right;border: 1px solid black;"><?=$dt->id_purchase;?></td>
	</tr>
</table>


<br>
<table align="center">
    <tr>
        <td align="center">
            <h4 style="text-decoration: underline;margin-top: 0px;margin-bottom: 0px;">
                PURCHASE ORDER (PO)
            </h4>
            <label><?=$dt->no_po;?></label>
        </td>
    </tr>
</table>
<div style="width: 100%;padding-top: 5px;padding-bottom: 5px;padding-left:5px;">
	<table style="width: 100%;">
		<tr>
			<td style="width: 50%;text-align:left;font-size: 15px;">Kepada :</td>
			<td style="width: 50%;text-align:left;font-size: 15px;"><?=$dt->supplier;?></td>
		</tr>
	</table>
</div>
<br>
<div style="height: 300px;">
<table style="width: 100%;max-height: 200px;">
	
		<tr>
			<th style="width: 5%;padding: 5px 5px 5px 5px; border-top: 1px solid black; border-bottom: 1px solid black;border-right: none;border-left: none;">No</th>
			<th style="width: 15%;padding: 5px 5px 5px 5px; border-top: 1px solid black; border-bottom: 1px solid black;border-right: none;border-left: none;">Nama Barang</th>
			<th style="width: 8%;padding: 5px 5px 5px 5px; border-top: 1px solid black; border-bottom: 1px solid black;border-right: none;border-left: none;">Jml</th>
			<th style="width: 10%;padding: 5px 5px 5px 5px; border-top: 1px solid black; border-bottom: 1px solid black;border-right: none;border-left: none;">Harga</th>
			<th style="width: 5%;padding: 5px 5px 5px 5px; border-top: 1px solid black; border-bottom: 1px solid black;border-right: none;border-left: none;">Disc</th>
			<th style="width: 15%;padding: 5px 5px 5px 5px; border-top: 1px solid black; border-bottom: 1px solid black;border-right: none;border-left: none;">Total</th>
			<th style="width: 8%;padding: 5px 5px 5px 5px; border-top: 1px solid black; border-bottom: 1px solid black;border-right: none;border-left: none;">No OPB</th>
			<th style="width: 30%;word-wrap : break-word;padding: 5px 5px 5px 5px; border-top: 1px solid black; border-bottom: 1px solid black;border-right: none;border-left: none;">Keterangan</th>
			
		</tr>
		<?php
		$i = 0;
		foreach ($dt_det as $key => $value) {
		$i++;

		
		 ?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?=$value->nama_produk;?></td>
			<td style="text-align: right;"><?=number_format($value->kuantitas,0);?></td>
			<td style="text-align: right;"><?=number_format($value->harga,0);?></td>
			<td><?=$value->disc;?></td>
			<td style="text-align: right;"><?=number_format($value->total,0);?></td>
			<td style="text-align: center;"><?=$dt->no_bukti;?></td>
			<td><?=$value->keterangan;?></td>
			
		</tr>
		<?php } ?>
		
		
	
</table>
</div>
<br>
<table>
	<tr>
		<td>Harap segera memberitahukan kepada kami</td>
		<td>DPP</td>
		<td></td>
		<td style="float: right;">Rp. <?php echo number_format($dt->sub_total,2);?></td>
	</tr>
	<tr>
		<td>bila syarat tersebut tidak terpenuhi</td>
		<td>Discount</td>
		<td><?=$dt->dc_po;?>%</td>
		<td style="float: right;">Rp. <?php echo number_format($dt->po_text,2);?></td>
	</tr>
	<tr>
		<td></td>
		<td>PPN</td>
		<td><?=$dt->dc_ppn;?>%</td>
		<td style="float: right;">Rp. <?php echo number_format($dt->ppn_text,2);?></td>
	</tr>
	<tr>
		<td></td>
		<td>Total</td>
		<td></td>
		<td style="float: right;">Rp. <?php echo number_format($dt->total,2);?></td>
	</tr>
</table>
<br>
<label>Terbilang : Tujuh Ratus Ribu Tiga Puluh Enam Ribu Rupiah</label><br>
<div style="height: 100px;">
<table style="width: 100%;border-collapse: collapse;">
	<tr>
			<th style="text-align:center;width: 50%;padding: 5px 5px 5px 5px; border: 1px solid black;">Type of Payment</th>
			<th style="text-align:center;width: 50%;padding: 5px 5px 5px 5px; border: 1px solid black;">Note</th>
			
		</tr>
		<tr>
			<?php 

				if($dt->terms == 'Proses'){
				?>
					<td style="height: 80px;border: 1px solid black;padding: 5px 5px 5px 5px;">
						Pembayaran akan dilakukan secara proses : <br>
						<?php 
							$idp = $dt->no_po;
							$trm = $this->db->query("SELECT * FROM tb_terms WHERE ID_PO = '$idp' ")->result();
							foreach ($trm as $key => $va) {
								echo $va->NAMA_PROSES.' = '.$va->AKHIR_PROSEN.'%';
								echo '<br>';
							}

						?>

					</td>
				<?php
				}

			?>
			<td style="height: 80px;border: 1px solid black;padding: 5px 5px 5px 5px;"><?=$dt->terms;?></td>
			<td style="height: 80px;border: 1px solid black;"></td>
		</tr>
</table>
</div>
<br>
<table style="width: 100%;">
	<tr>
		<td style="width: 25%;text-align: center;">Supplier</td>
		<td style="width: 25%;text-align: center;">Mengetahui</td>
		<td style="width: 25%;text-align: center;">Menyetujui</td>
		<td style="width: 25%;text-align: center;">Yang Membuat</td>
	</tr>
</table>
<br>
<br>
<br>
<br>
<br>
<table style="width: 100%;">
	<tr>
		<td style="width: 25%;text-align: center;">(...................................)</td>
		<td style="width: 25%;text-align: center;">(...................................)</td>
		<td style="width: 25%;text-align: center;">(...................................)</td>
		<td style="width: 25%;text-align: center;">(...................................)</td>
	</tr>
</table>
<br>
<label>Tembusan Kepada : 1.Arsip (Supplier)  2. Copy (Arsip Pembelian) 3. Copy (Akuntansi) 4.Copy (Gudang)</label>

<h5 style="margin-top: 10px;margin-bottom: 2px;">NOTE : </h5>
<h5 style="margin-top: 2px;margin-bottom: 2px;">1. No. PO harap dicantumkan pada Surat Jalan</h5>
<h5 style="margin-top: 2px;margin-bottom: 2px;">2. PO harap dilamppirkan pada saat penyerahan tagiham setelah ditandatangani di kolom supplier disertai dengan stempel asli perusahaan</h5>

<!-- <script type="text/javascript">
	// window.print();
</script> -->

<?PHP
    $width_custom = 14;
    $height_custom = 8.50;
    
    $content = ob_get_clean();
    $width_in_inches = $width_custom;
    $height_in_inches = $height_custom;
    $width_in_mm = $width_in_inches * 21.4;
    $height_in_mm = $height_in_inches * 19.8;
    $html2pdf = new HTML2PDF('P','A4','en');
    $html2pdf->pdf->SetTitle('Laporan Purchase Order ');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('Laporan_purchase_order.pdf');
?>