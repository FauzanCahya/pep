<script src="<?php echo base_url(); ?>js/jquery-1.11.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#btn_cari').click(function(){
		trace_nomor();
	});
});

function trace_nomor(){
	var nomor = $('#nomor').val();

	$.ajax({
		url : '<?php echo base_url(); ?>dashboard_c/cek_no_di_spb',
		data : {nomor:nomor},
		type : "POST",
		dataType : "json",
		success : function(spb){

			$tr = '';

			var no = 0;

			if(spb.length != 0){
				for(var i=0; i<spb.length; i++){
					no++;

					$tr += '<tr>'+
								'<td style="text-align:center;">'+no+'</td>'+
								'<td>'+spb[i].no_spb+'</td>'+
								'<td>'+spb[i].tanggal+'</td>'+
								'<td>'+spb[i].uraian+'</td>'+
								'<td>Permintaan Barang (SPB)</td>'+
							'</tr>';
				}

				$('#tabel_data tbody').html($tr);

				$.ajax({
					url : '<?php echo base_url(); ?>dashboard_c/cek_no_spb_di_opb',
					data : {nomor:nomor},
					type : "POST",
					dataType : "json",
					success : function(opb){
						$tr2 = '';

						if(opb.length != 0){
							for(var j=0; j<opb.length; j++){
								no++;

								$tr2 += '<tr>'+
											'<td style="text-align:center;">'+no+'</td>'+
											'<td>'+opb[j].no_opb+'</td>'+
											'<td>'+opb[j].tanggal+'</td>'+
											'<td>'+opb[j].uraian+'</td>'+
											'<td>Order Pembelian Barang (OPB)</td>'+
										'</tr>';
							}

							$('#tabel_data tbody').append($tr2);

							$.ajax({
								url : '<?php echo base_url(); ?>dashboard_c/cek_no_opb_di_po',
								data : {nomor:nomor},
								type : "POST",
								dataType : "json",
								success : function(po){
									$tr3 = '';

									if(po.length != 0){
										for(var k=0; k<po.length; k++){
											no++;

											$tr3 += '<tr>'+
														'<td style="text-align:center;">'+no+'</td>'+
														'<td>'+po[k].no_opb+'</td>'+
														'<td>'+po[k].tanggal+'</td>'+
														'<td>'+po[k].uraian+'</td>'+
														'<td>Purchase Order (PO)</td>'+
													'</tr>';
										}

										$('#tabel_data tbody').append($tr3);

									}else{
										$tr = '<tr class="warning"><td colspan="5">&nbsp;</td></tr>';
										$('#tabel_data tbody').append($tr);
									}
								}
							});
						}else{
							$tr = '<tr class="warning"><td colspan="5">&nbsp;</td></tr>';
							$('#tabel_data tbody').append($tr);
						}
					}
				});
			}else{
				$tr = '<tr class="warning"><td colspan="5">&nbsp;</td></tr>';
				$('#tabel_data tbody').append($tr);
			}
		}
	});
}
</script>

<div class="row" id="form_kode_akun">
	<div class="col-md-12">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-green-haze">
					<i class="icon-settings font-green-haze"></i>
					<span class="caption-subject bold uppercase"> DASHBOARD </span>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="row" style="margin-bottom: 20px;">
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="dashboard-stat blue-madison">
							<div class="visual">
								<i class="fa fa-comments"></i>
							</div>
							<div class="details">
								<div class="number">
								<?php 
									$tanggal = date('d-m-Y');
									$po = $this->db->query("SELECT COUNT(*) as hitung FROM tb_purchase_order WHERE tanggal = '$tanggal'")->row();
								?>
									<?=$po->hitung;?>
								</div>
								<div class="desc">
									 Purchase Order Hari Ini 
								</div>
							</div>
							<a class="more" href="javascript:;">
							View more <i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="dashboard-stat red-intense">
							<div class="visual">
								<i class="fa fa-bar-chart-o"></i>
							</div>
							<div class="details">
								<div class="number">
								<?php 
									$pb = $this->db->query("SELECT COUNT(*) as hitung FROM tb_permintaan_barang WHERE tanggal = '$tanggal'")->row();
								?>
									<?=$pb->hitung;?>
								</div>
								<div class="desc">
									Permintaan Barang Hari Ini
								</div>
							</div>
							<a class="more" href="javascript:;">
							View more <i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="dashboard-stat green-haze">
							<div class="visual">
								<i class="fa fa-shopping-cart"></i>
							</div>
							<div class="details">
								<div class="number">
									 <?php 
									 	$opb = $this->db->query("SELECT COUNT(*) as hitung FROM tb_order_pembelian WHERE tanggal = '$tanggal'")->row();

									 ?>
									 <?=$opb->hitung;?>
								</div>
								<div class="desc">
									 Order Pembelian Barang Hari Ini
								</div>
							</div>
							<a class="more" href="javascript:;">
							View more <i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="dashboard-stat purple-plum">
							<div class="visual">
								<i class="fa fa-globe"></i>
							</div>
							<div class="details">
								<div class="number">
									 <?php 
									 	$pt = $this->db->query("SELECT COUNT(*) as hitung FROM tb_peminjaman_barang WHERE tanggal = '$tanggal'")->row();

									 ?>
									 <?=$pt->hitung;?>
								</div>
								<div class="desc">
									 Peminjaman Tools Hari Ini
								</div>
							</div>
							<a class="more" href="javascript:;">
							View more <i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div>
				</div>

				<div class="clearfix">
				</div>

			

			</div>
		</div>
		<!-- END SAMPLE FORM PORTLET-->
	</div>
</div>

<div class="row" id="form_kode_akun">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-green-haze">
					<i class="fa fa-search font-green-haze"></i>
					<span class="caption-subject bold uppercase"> DOKUMEN LINK </span>
				</div>
			</div>
			<div class="portlet-body form">
				<h4 class="block">Masukkan Nomor</h4>
				<form role="form">
					<div class="row">
						<div class="col-md-2">
							<div class="input-group">
								<input type="text" class="form-control" name="nomor" id="nomor" value="" placeholder="Masukkan nomor">
							</div>
						</div>

						<div class="col-md-2">
							<div class="input-group" style="width: 100%;">
								<select name="departemen" class="form-control">
									<option value="Tipe" disabled>----Tipe----</option>
									<option value="SPB">SPB</option>
									<option value="OPB">OPB</option>
									<option value="PO">PO</option>
									<option value="LPB">LPB</option>
								</select>
							</div>
						</div>

						<div class="col-md-2">
							<div class="input-group" style="width: 100%;">
								<select name="departemen" class="form-control">
									<?php 

										$dpt = $this->db->query("SELECT * FROM master_divisi")->result();

										foreach ($dpt as $key => $value) {
											?>
												<option value="<?=$value->id_divisi;?>"><?=$value->nama_divisi;?></option>
											<?php
										}

									?>
								</select>
							</div>
						</div>

						<div class="col-md-2">
							<div class="input-group">
								<input type="text" class="form-control" name="nomor" id="nomor" value="" placeholder="Masukkan Tahun">
								
							</div>
						</div>

						<div class="col-md-2">
							<div class="input-group">
								
								<span class="input-group-btn">
									<button type="button" class="btn blue" id="btn_cari">Cari</button>
								</span>
							</div>
						</div>
					</div>
				</form>
				<br>
				<br>
				<div class="table-responsive">
					<table class="table table-bordered" id="tabel_data">
						<thead>
							<tr class="success">
								<th>NO</th>
								<th>NOMOR DOKUMEN</th>
								<th>TANGGAL</th>
								<th>URAIAN</th>
								<th>KETERANGAN</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>