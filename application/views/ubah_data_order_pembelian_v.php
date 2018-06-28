<form role="form" action="<?=base_url();?>order_pembelian_c" method="post">
<?php 
	$dt_id = $dt->id_order;
	$sql_c = $this->db->query("SELECT COUNT(*) as hitu_d FROM tb_order_pembelian_detail WHERE id_induk = '$dt_id'")->row();

?>
<input type="hidden" id="jml_tr" value="<?=$sql_c->hitu_d;?>">
<input type="hidden" id="id_order" name="id_order" value="<?=$dt->id_order;?>">

<div class="row" id="form_order_pembelian">
	<div class="col-md-12 col-sm-6">
		<!-- BEGIN PORTLET-->
		<div class="portlet light ">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-bar-chart font-green-sharp hide"></i>
					<span class="caption-subject font-green-sharp bold uppercase">Form Order Pembelian Barang</span>
				</div>
				<div class="actions">
					<div class="btn-group btn-group-devided" data-toggle="buttons">
					</div>
				</div>
			</div>

			<div class="portlet-body">	
				<div class="row" style="padding-top: 15px; padding-bottom: 15px;">
					<div class="col-md-12">
						<div class="col-md-3">
							<label class="control-label"><b style="font-size:14px;">Departemen</b></label>
							<div class="input-group" style="width: 100%; ">
								<input type="text" name="departemen" class="form-control" readonly value="<?=$dt->nama_divisi;?>">
							</div>
						</div>

						<!-- <div class="col-md-3">
							<label class="control-label"><b style="font-size:14px;">Tahun</b></label>
							<div class="input-group" style="width: 100%; ">
								<select name="tahuni" class="form-control" id="tahuni" onchange="get_transaction(this.value);">
									<option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>
									<option value="2016">2016</option>
									<option value="2017">2017</option>
									<option value="2018">2018</option>
								</select>
							</div>
						</div> -->


						<div class="col-md-3">
							<label class="control-label"><b style="font-size:14px;">Tanggal</b></label>
							<div class="input-group" style="width: 100%;">
								<input type="text" class="form-control" name="tanggal" id="tanggal" value="<?=$dt->tanggal;?>" readonly required>
								<span class="input-group-btn"><button class="btn default" type="button"><i class="fa fa-calendar"></i></button></span>
							</div>
						</div>

						<div class="col-md-3">
							<label class="control-label"><b style="font-size:14px;">Uraian</b></label>
							<div class="input-group" style="width: 100%; ">
								<input type="text" rows="1" id="uraian" name="uraian" class="form-control" required value="<?=$dt->uraian;?>">
							</div>
						</div>
					</div>
				</div>

				
				<div class="row" style="padding-top: 15px; padding-bottom: 15px; margin-left:18px; margin-right:18px;" id="tabel_produk">
					<div class="portlet-body flip-scroll">
						<table class="table table-bordered table-striped table-condensed flip-content">
							<thead class="flip-content">
								<tr>
									<th style="text-align: center;  width: 20%;">Produk / Item</th>
									<th style="text-align: center; ">Kuantitas</th>
									<th style="text-align: center; ">Satuan</th>
									<th style="text-align: center; ">Reff No</th>
									<th style="text-align: center; ">Aksi</th>
								</tr>
							</thead>
							<tbody id="data_item">
								<?php 
									$no = 0;
									foreach ($dt_detail as $key => $value) {
									
										$no++;
								?>
								
									<tr id="tr_<?=$no;?>">
									<td align="center" style="vertical-align:middle;">
										<div class="span12">
											<div class="control-group">
												<div classs="controls">
													<div class="input-append" style="width: 100%;">
														<input readonly value="<?=$value->nama_produk?>" type="text" id="nama_produk_" class="form-control"  name="nama_produk[]" required style="background:#FFF; width: 60%; font-size: 13px; float: left;">
														<button onclick="show_pop_produk();" type="button" class="btn" style="width: 30%;">Cari</button>
														<input type="hidden" id="id_produk_" value="<?=$value->id_produk;?>" name="produk[]" readonly style="background:#FFF;" value="0">
													</div>
												</div>
											</div>
										</div>
									</td>
									
									<td align="center" style="vertical-align:middle;">
										<div class="controls">
											<input onkeyup="hitung_total();" style="font-size: 13px; text-align:left;" type="text" class="form-control" value="<?=$value->kuantitas;?>" name="kuantitas[]" id="kuantitas_">
										</div>
									</td>
									<td align="center" style="vertical-align:middle;">
										<div class="controls">
											<input style="font-size: 13px; text-align:left;" type="text" class="form-control" value="<?=$value->satuan;?>" name="satuan[]" id="satuan_">
										</div>
									</td>
									<td align="center" style="vertical-align:middle;">
										<div class="controls">
											<input style="font-size: 13px; text-align:left;" type="text" class="form-control" value="<?=$value->no_spb;?>" name="no_spb[]" id="no_spb_">
										</div>
									</td>
									<td align="center" style="vertical-align:middle;">
										<div class="controls">
											<button style="width: 100%;" onclick="hapus(<?=$no;?>);" type="button" class="btn btn-danger"> Hapus </button>
										</div>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>

						<!-- <button style="margin-bottom: 15px; background: #26a69a;" onclick="tambah_data();" type="button" class="btn btn-info"><i class="icon-plus"></i> Tambah Baris Data </button>
						<button style="margin-bottom: 15px; background: #f47a42;" onclick="show_pop_spb(1);" type="button" class="btn btn-info"><i class="icon-plus"></i> Include SPB </button> -->

					</div>
				</div>
			</div>
		</div>
		<!-- END PORTLET-->
	</div>
</div>

<div class="row" id="tabel_total" >
	<div class="col-md-12 col-sm-6">
		<!-- BEGIN PORTLET-->
		<div class="portlet light ">
			<div class="portlet-body">
				<div class="row" style="padding-top: 15px;">
					<div class="col-md-12">
						
					</div>
				</div>

				<div class="row" style="padding-top: 35px; padding-bottom: 15px;">
					<div class="col-md-12">
						<div class="col-md-offset-2 col-md-10">
							<input type="submit" name="simpan_data" value="SIMPAN" class="btn btn-info">
							<button type="button" id="batal" class="btn red" onclick="window.location = '<?php echo base_url(); ?>order_pembelian_c'">Batal Dan Kembali</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END PORTLET-->
	</div>
</div>
</form>
<script type="text/javascript">
	function hapus(i){
	$('#tr_'+i).remove();
}
</script>