<script src="<?php echo base_url(); ?>js/jquery-1.11.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#btn_cari').click(function(){
		var jenis_dokumen = $('#jenis_dokumen').val();

		if(jenis_dokumen == 'SPB'){
			no_spb_first();
		}else if(jenis_dokumen == 'OPB'){
			no_opb_first();
		}else if(jenis_dokumen == 'PO'){
			no_po_first();
		}else if(jenis_dokumen == 'LPB'){
			no_lpb_first();
		}
	});
});

function no_spb_first(){
	$('#tabel_data tbody').html("");

	var nomor = $('#nomor').val();
	var sie = $('#sie').val();
	var tahun = $('#tahun').val();

	$.ajax({
		url : '<?php echo base_url(); ?>dashboard_c/cek_no_spb_first',
		data : {
			nomor:nomor,
			sie:sie,
			tahun:tahun
		},
		type : "POST",
		dataType : "json",
		success : function(spb){
			$tr = '';
			var no = 0;

			if(spb.length != 0){
				for(var i=0; i<spb.length; i++){
					no++;
					var no_spb = spb[i].no_spb;

					$tr += '<tr>'+
								'<td style="text-align:center;">'+no+'</td>'+
								'<td>'+spb[i].no_spb+'</td>'+
								'<td>'+spb[i].tanggal+'</td>'+
								'<td>'+spb[i].nama_produk+'</td>'+
								'<td>Permintaan Barang (SPB)</td>'+
							'</tr>';

					$.ajax({
						url : '<?php echo base_url(); ?>dashboard_c/cek_no_spb_di_opb',
						data : {
							no_spb:no_spb,
							sie:sie,
							tahun:tahun
						},
						type : "POST",
						dataType : "json",
						success : function(opb){
							$tr2 = '';

							if(opb.length != 0){
								for(var j=0; j<opb.length; j++){
									no++;
									var no_opb = opb[j].no_opb

									$tr2 += '<tr>'+
												'<td style="text-align:center;">'+no+'</td>'+
												'<td>'+opb[j].no_opb+'</td>'+
												'<td>'+opb[j].tanggal+'</td>'+
												'<td>'+opb[j].nama_produk+'</td>'+
												'<td>Order Pembelian Barang (OPB)</td>'+
											'</tr>';
									
									$.ajax({
										url : '<?php echo base_url(); ?>dashboard_c/cek_no_opb_di_po',
										data : {
											no_opb:no_opb,
											sie:sie,
											tahun:tahun
										},
										type : "POST",
										dataType : "json",
										success : function(po){
											$tr3 = '';

											if(po.length != 0){
												for(var k=0; k<po.length; k++){
													no++;
													var no_po = po[k].no_po;

													$tr3 += '<tr>'+
																'<td style="text-align:center;">'+no+'</td>'+
																'<td>'+po[k].no_po+'</td>'+
																'<td>'+po[k].tanggal+'</td>'+
																'<td>'+po[k].nama_produk+'</td>'+
																'<td>Purchase Order (PO)</td>'+
															'</tr>';

													$.ajax({
														url : '<?php echo base_url(); ?>dashboard_c/cek_no_lpb',
														data : {
															no_po:no_po,
															sie:sie,
															tahun:tahun
														},
														type : "POST",
														dataType : "json",
														success : function(lpb){
															$tr4 = '';

															if(lpb.length != 0){
																for(var l=0; l<lpb.length; l++){
																	no++;

																	$tr4 += '<tr>'+
																		'<td style="text-align:center;">'+no+'</td>'+
																		'<td>'+lpb[l].no_lpb+'</td>'+
																		'<td>'+lpb[l].tanggal+'</td>'+
																		'<td>'+lpb[l].nama_produk+'</td>'+
																		'<td>Laporan Penerimaan Barang (LPB)</td>'+
																	'</tr>';
																}

																$('#tabel_data tbody').append($tr4);

															}else{
																// $tr = '<tr class="warning"><td colspan="5">&nbsp;</td></tr>';
																// $('#tabel_data tbody').append($tr);
															}
														}
													});

												}

												$('#tabel_data tbody').append($tr3);
											}else{
												// $tr = '<tr class="warning"><td colspan="5">&nbsp;</td></tr>';
												// $('#tabel_data tbody').append($tr);
											}
										}
									});
								}

								$('#tabel_data tbody').append($tr2);
								
							}else{
								// $tr = '<tr class="warning"><td colspan="5">&nbsp;</td></tr>';
								// $('#tabel_data tbody').append($tr);
							}
						}
					});
					
				}

				$('#tabel_data tbody').html($tr);

			}else{
				$tr = '<tr><td colspan="5">Data Tidak Ada</td></tr>';
				$('#tabel_data tbody').append($tr);
			}
		}
	});
}

function no_opb_first(){
	$('#tabel_data tbody').html("");

	var nomor = $('#nomor').val();
	var sie = $('#sie').val();
	var tahun = $('#tahun').val();

	$.ajax({
		url : '<?php echo base_url(); ?>dashboard_c/cek_no_opb_first',
		data : {
			nomor:nomor,
			sie:sie,
			tahun:tahun
		},
		type : "POST",
		dataType : "json",
		success : function(opb){
			$tr = '';

			if(opb.length != 0){
				var no = 0;

				for(var j=0; j<opb.length; j++){
					no++;
					var no_opb = opb[j].no_opb

					$tr += '<tr>'+
								'<td style="text-align:center;">'+no+'</td>'+
								'<td>'+opb[j].no_opb+'</td>'+
								'<td>'+opb[j].tanggal+'</td>'+
								'<td>'+opb[j].nama_produk+'</td>'+
								'<td>Order Pembelian Barang (OPB)</td>'+
							'</tr>';

					$.ajax({
						url : '<?php echo base_url(); ?>dashboard_c/cek_no_spb_by_opb',
						data : {
							no_opb:no_opb,
							sie:sie,
							tahun:tahun
						},
						type : "POST",
						dataType : "json",
						success : function(spb){
							$tr2 = '';

							if(spb.length != 0){
								for(var k=0; k<spb.length; k++){
									no++;
									var no_opb = spb[k].no_opb;

									$tr2 += '<tr>'+
												'<td style="text-align:center;">'+no+'</td>'+
												'<td>'+spb[k].no_spb+'</td>'+
												'<td>'+spb[k].tanggal+'</td>'+
												'<td>'+spb[k].nama_produk+'</td>'+
												'<td>Permintaan Barang (SPB)</td>'+
											'</tr>';

									$.ajax({
										url : '<?php echo base_url(); ?>dashboard_c/cek_no_opb_di_po',
										data : {
											no_opb:no_opb,
											sie:sie,
											tahun:tahun
										},
										type : "POST",
										dataType : "json",
										success : function(po){
											$tr3 = '';

											if(po.length != 0){
												for(var l=0; l<po.length; l++){
													no++;
													var no_po = po[l].no_po;

													$tr3 += '<tr>'+
																'<td style="text-align:center;">'+no+'</td>'+
																'<td>'+po[l].no_po+'</td>'+
																'<td>'+po[l].tanggal+'</td>'+
																'<td>'+po[l].nama_produk+'</td>'+
																'<td>Purchase Order (PO)</td>'+
															'</tr>';

													$.ajax({
														url : '<?php echo base_url(); ?>dashboard_c/cek_no_lpb',
														data : {
															no_po:no_po,
															sie:sie,
															tahun:tahun
														},
														type : "POST",
														dataType : "json",
														success : function(lpb){
															$tr4 = '';

															if(lpb.length != 0){
																for(var m=0; m<lpb.length; m++){
																	no++;

																	$tr4 += '<tr>'+
																		'<td style="text-align:center;">'+no+'</td>'+
																		'<td>'+lpb[m].no_lpb+'</td>'+
																		'<td>'+lpb[m].tanggal+'</td>'+
																		'<td>'+lpb[m].nama_produk+'</td>'+
																		'<td>Laporan Penerimaan Barang (LPB)</td>'+
																	'</tr>';
																}

																$('#tabel_data tbody').append($tr4);

															}else{
																
															}
														}
													});
												}

												$('#tabel_data tbody').append($tr3);
											}else{

											}
										}
									});
								}

								$('#tabel_data tbody').append($tr2);
							}else{

							}
						}
					});
				}

				$('#tabel_data tbody').append($tr);
				
			}else{
				$tr = '<tr class="warning"><td colspan="5">&nbsp;</td></tr>';
				$('#tabel_data tbody').append($tr);
			}
		}
	});
}

function no_po_first(){
	$('#tabel_data tbody').html("");

	var nomor = $('#nomor').val();
	var sie = $('#sie').val();
	var tahun = $('#tahun').val();

	$.ajax({
		url : '<?php echo base_url(); ?>dashboard_c/cek_no_po_fisrt',
		data : {
			nomor:nomor,
			sie:sie,
			tahun:tahun
		},
		type : "POST",
		dataType : "json",
		success : function(po){
			$tr = '';
			var no = 0;

			if(po.length != 0){
				for(var k=0; k<po.length; k++){
					no++;
					var no_po = po[k].no_po;
					var no_opb = po[k].no_opb;

					$tr += '<tr>'+
								'<td style="text-align:center;">'+no+'</td>'+
								'<td>'+po[k].no_po+'</td>'+
								'<td>'+po[k].tanggal+'</td>'+
								'<td>'+po[k].nama_produk+'</td>'+
								'<td>Purchase Order (PO)</td>'+
							'</tr>';

					$.ajax({
						url : '<?php echo base_url(); ?>dashboard_c/cek_no_lpb_by_po',
						data : {
							no_po:no_po,
							sie:sie,
							tahun:tahun
						},
						type : "POST",
						dataType : "json",
						success : function(lpb){
							$tr2 = '';

							if(lpb.length != 0){
								for(var l=0; l<lpb.length; l++){
									no++;

									$tr2 += '<tr>'+
										'<td style="text-align:center;">'+no+'</td>'+
										'<td>'+lpb[l].no_lpb+'</td>'+
										'<td>'+lpb[l].tanggal+'</td>'+
										'<td>'+lpb[l].nama_produk+'</td>'+
										'<td>Laporan Penerimaan Barang (LPB)</td>'+
									'</tr>';

									$.ajax({
										url : '<?php echo base_url(); ?>dashboard_c/cek_no_opb_by_po',
										data : {
											no_opb:no_opb,
											sie:sie,
											tahun:tahun
										},
										type : "POST",
										dataType : "json",
										success : function(opb){
											$tr3 = '';

											if(opb.length != 0){
												for(var m=0; m<opb.length; m++){
													var no_spb = opb[m].no_spb;

													$tr3 += '<tr>'+
																'<td style="text-align:center;">'+no+'</td>'+
																'<td>'+opb[m].no_opb+'</td>'+
																'<td>'+opb[m].tanggal+'</td>'+
																'<td>'+opb[m].nama_produk+'</td>'+
																'<td>Order Pembelian Barang (OPB)</td>'+
															'</tr>';

													$.ajax({
														url : '<?php echo base_url(); ?>dashboard_c/cek_no_spb_by_opb2',
														data : {
															no_spb:no_spb,
															sie:sie,
															tahun:tahun
														},
														type : "POST",
														dataType : "json",
														success : function(spb){
															$tr4 = '';

															if(spb.length != 0){
																for(var n=0; n<spb.length; n++){
																	no++;

																	$tr4 += '<tr>'+
																				'<td style="text-align:center;">'+no+'</td>'+
																				'<td>'+spb[n].no_spb+'</td>'+
																				'<td>'+spb[n].tanggal+'</td>'+
																				'<td>'+spb[n].nama_produk+'</td>'+
																				'<td>Permintaan Barang (SPB)</td>'+
																			'</tr>';
																}

																$('#tabel_data tbody').append($tr4);
															}else{
																
															}
														}
													});

												}

												$('#tabel_data tbody').append($tr3);
											}else{

											}
										}
									});

								}

								$('#tabel_data tbody').append($tr2);
							}else{

							}
						}
					});
				}

				$('#tabel_data tbody').append($tr);

			}else{
				$tr = '<tr class="warning"><td colspan="5">&nbsp;</td></tr>';
				$('#tabel_data tbody').append($tr);
			}
		}
	});
}

function no_lpb_first(){
	$('#tabel_data tbody').html("");

	var nomor = $('#nomor').val();
	var sie = $('#sie').val();
	var tahun = $('#tahun').val();

	$.ajax({
		url : '<?php echo base_url(); ?>dashboard_c/cek_no_lpb_first',
		data : {
			nomor:nomor,
			sie:sie,
			tahun:tahun
		},
		type : "POST",
		dataType : "json",
		success : function(lpb){
			$tr4 = '';
			var no = 0;

			if(lpb.length != 0){
				for(var l=0; l<lpb.length; l++){
					no++;
					var no_po = lpb[l].no_po;

					$tr4 += '<tr>'+
								'<td style="text-align:center;">'+no+'</td>'+
								'<td>'+lpb[l].no_lpb+'</td>'+
								'<td>'+lpb[l].tanggal+'</td>'+
								'<td>'+lpb[l].nama_produk+'</td>'+
								'<td>Laporan Penerimaan Barang (LPB)</td>'+
							'</tr>';

					$.ajax({
						url : '<?php echo base_url(); ?>dashboard_c/cek_no_po_by_lpb',
						data : {
							no_po:no_po,
							sie:sie,
							tahun:tahun
						},
						type : "POST",
						dataType : "json",
						success : function(po){
							$tr5 = '';

							if(po.length != 0){
								for(var m=0; m<po.length; m++){
									no++;
									var no_opb = po[m].no_opb;

									$tr5 += '<tr>'+
												'<td style="text-align:center;">'+no+'</td>'+
												'<td>'+po[m].no_po+'</td>'+
												'<td>'+po[m].tanggal+'</td>'+
												'<td>'+po[m].nama_produk+'</td>'+
												'<td>Purchase Order (PO)</td>'+
											'</tr>';

									$.ajax({
										url : '<?php echo base_url(); ?>dashboard_c/cek_no_opb_by_po2',
										data : {
											no_opb:no_opb,
											sie:sie,
											tahun:tahun
										},
										type : "POST",
										dataType : "json",
										success : function(opb){
											$tr6 = '';

											if(opb.length != 0){
												for(var n=0; n<opb.length; n++){
													no++;
													var no_spb = opb[n].no_spb;

													$tr6 += '<tr>'+
															'<td style="text-align:center;">'+no+'</td>'+
															'<td>'+opb[n].no_opb+'</td>'+
															'<td>'+opb[n].tanggal+'</td>'+
															'<td>'+opb[n].nama_produk+'</td>'+
															'<td>Order Pembelian Barang (OPB)</td>'+
														'</tr>';

													$.ajax({
														url : '<?php echo base_url(); ?>dashboard_c/cek_no_spb_by_opb3',
														data : {
															no_spb:no_spb,
															sie:sie,
															tahun:tahun
														},
														type : "POST",
														dataType : "json",
														success : function(spb){
															$tr7 = '';

															if(spb.length != 0){
																for(var o=0; o<spb.length; o++){
																	no++;

																	$tr7 += '<tr>'+
																				'<td style="text-align:center;">'+no+'</td>'+
																				'<td>'+spb[o].no_spb+'</td>'+
																				'<td>'+spb[o].tanggal+'</td>'+
																				'<td>'+spb[o].nama_produk+'</td>'+
																				'<td>Permintaan Barang (SPB)</td>'+
																			'</tr>';
																}

																$('#tabel_data tbody').append($tr7);
															}else{
																
															}
														}
													});
												}

												$('#tabel_data tbody').append($tr6);
											}else{
												
											}
										}
									});
								}

								$('#tabel_data tbody').append($tr5);
							}else{
								
							}
						}
					});
				}

				$('#tabel_data tbody').append($tr4);

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
								<select name="jenis_dokumen" id="jenis_dokumen" class="form-control">
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
								<select name="sie" id="sie" class="form-control">
								<?php 
									$dpt = $this->db->query("SELECT * FROM master_divisi")->result();
									foreach ($dpt as $key => $value) {
								?>
									<option value="<?=$value->nama_divisi;?>"><?=$value->nama_divisi;?></option>
								<?php
									}
								?>
								</select>
							</div>
						</div>

						<div class="col-md-2">
							<div class="input-group">
								<input type="text" class="form-control" name="tahun" id="tahun" value="" placeholder="Masukkan Tahun">
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
								<th>BARANG</th>
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