<div class="row" id="form_kode_akun">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-green-haze">
					<i class="icon-settings font-green-haze"></i>
					<span class="caption-subject bold uppercase"> Form Tambah Data Penerimaan Giro </span>
				</div>
				<div class="actions">
					<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title="">
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<form role="form" class="form-horizontal" method="post" action="<?php echo $url_simpan; ?>">
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">No. Giro</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="kode_akun" name="kode_akun" required>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Terima Dari</label>
							<div class="col-md-4">
								<select onchange="$('#kode_akun').val(this.value); $('#kode_akun').focus();" class="form-control input-large select2me input-sm" id="grup" name="grup" data-placeholder="Select..." required>
									<option value=""></option>
									<?php 
										foreach ($lihat_data_grup as $value){
									?>
										<option value="<?php echo $value->KODE_GRUP; ?>"><?php echo $value->KODE_GRUP; ?></option>
									<?php	
										}
									?>
								</select>	
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Nilai Giro</label>
							<div class="col-md-3">
								<select class="form-control" name="tipe" id="tipe">
									<option value="Rp">Rupiah</option>
									<option value="USD">US DOLLAR</option>
								</select>
							</div>
							<div class="col-md-5">
								<input type="text" class="form-control" id="nilai" name="nilai" required onkeyup="FormatCurrency(this);">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Keterangan</label>
							<div class="col-md-3">
								<textarea class="form-control" name="ket"></textarea>
							</div>
						</div>

					</div>
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-2 col-md-10">
								<button type="submit" class="btn blue">Simpan</button>
								<button type="button" id="batal" class="btn red">Batal Dan Kembali</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- END SAMPLE FORM PORTLET-->
	</div>
</div