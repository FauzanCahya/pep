<div class="row" id="form_supplier">
	<div class="col-md-12">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-green-haze">
					<i class="icon-settings font-green-haze"></i>
					<span class="caption-subject bold uppercase"> Form Edit Akun Supplier </span>
				</div>
				<div class="actions">
					<a class="btn btn-circle btn-icon-only blue" href="javascript:;">
					<i class="icon-cloud-upload"></i>
					</a>
					<a class="btn btn-circle btn-icon-only green" href="javascript:;">
					<i class="icon-wrench"></i>
					</a>
					<a class="btn btn-circle btn-icon-only red" href="javascript:;">
					<i class="icon-trash"></i>
					</a>
					<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title="">
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<form role="form" class="form-horizontal" method="post" action="<?php echo $url_simpan; ?>">
					<div class="form-body">
						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Kode Supplier</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="kode_supplier" name="kode_supplier" value="<?=$lihat_data->kode_supplier;?>" >
								<div class="form-control-focus">
								</div>
							</div>
						</div>
						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Nama Supplier</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="nama_supplier" name="nama_supplier" value="<?=$lihat_data->nama_supplier;?>">
								<div class="form-control-focus">
								</div>
							</div>
						</div>

						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Kode Akun Debit</label>
							<div class="col-md-3">
								<select class="form-control" name="akun_debit">
									<?php 

										if($lihat_data->akun_debit == '' || $lihat_data->akun_debit == NULL){

									?>
									
									<?php 
									}else{ ?>
									<option value="<?=$akun_debit->ID;?>"><?=$akun_debit->NAMA_GRUP;?></option>
									<?php } ?>
									<option></option>
									<?php 

									foreach ($dt_akun as $key => $value) {
										?>
										<option value="<?=$value->ID;?>"><?=$value->NAMA_GRUP;?></option>
										<?php 
									}

									?>
								</select>
								<div class="form-control-focus">
								</div>
							</div>
						</div>

						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Kode Akun Kredit</label>
							<div class="col-md-3">
								<select class="form-control" name="akun_kredit">
									<?php 

										if($lihat_data->akun_kredit == '' || $lihat_data->akun_kredit == NULL){

									?>
									
									<?php 
									}else{ ?>
									<option value="<?=$akun_kredit->ID;?>"><?=$akun_kredit->NAMA_GRUP;?></option>
									<?php } ?>

									<option></option>
									<?php 

									foreach ($dt_akun as $key => $valuea) {
										?>
										<option value="<?=$valuea->ID;?>"><?=$valuea->NAMA_GRUP;?></option>
										<?php 
									}

									?>
								</select>
								<div class="form-control-focus">
								</div>
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
</div>