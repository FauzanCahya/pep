<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("input[name='pilih']").click(function(){
		var cek = $("input[name='pilih']:checked").val();
		if(cek == 'Harian'){
			$('.harian').show();
			$('.bulanan').hide();
		}else{
			$('.harian').hide();
			$('.bulanan').show();
		}
	});
});
</script>

<style type="text/css">
.bulanan, .harian{
	display: none;
}
</style>

<div class="row">
	<div class="col-md-12">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-green-haze">
					<i class="icon-book-open font-green-haze"></i>
					<span class="caption-subject bold uppercase"> Laporan Cash Flow </span>
				</div>
			</div>
			<div class="portlet-body form">
				<form role="form" target="_blank" class="form-horizontal" method="post" action="<?=base_url();?>lap_cash_flow_c/cetak">
					<div class="form-body">
						<div class="form-group form-md-radios">
							<label class="col-md-2 control-label" for="form_control_1">Pilih</label>
							<div class="col-md-4">
								<div class="md-radio-inline">
									<div class="md-radio">
										<input type="radio" id="radio6" name="pilih" class="md-radiobtn" value="Harian">
										<label for="radio6">
										<span></span>
										<span class="check"></span>
										<span class="box"></span>
										Harian </label>
									</div>
									<div class="md-radio">
										<input type="radio" id="radio7" name="pilih" class="md-radiobtn" value="Bulanan">
										<label for="radio7">
										<span></span>
										<span class="check"></span>
										<span class="box"></span>
										Bulanan </label>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group bulanan">
							<label class="col-md-2 control-label" for="form_control_1">Bulan</label>
							<div class="col-md-3">
								<select name="bulan" class="form-control">
									<option value="01">Januari</option>
									<option value="02">Februari</option>
									<option value="03">Maret</option>
									<option value="04">April</option>
									<option value="05">Mei</option>
									<option value="06">Juni</option>
									<option value="07">Juli</option>
									<option value="08">Agustus</option>
									<option value="09">September</option>
									<option value="10">Oktober</option>
									<option value="11">November</option>
									<option value="12">Desember</option>
								</select>
							</div>
						</div>
						<div class="form-group bulanan">
							<label class="col-md-2 control-label" for="form_control_1">Tahun</label>
							<div class="col-md-3">
								<select name="tahun" class="form-control">
								<?php
									$tahun = date('Y');
									for($i = $tahun-3; $i < $tahun+1; $i++){
										$s = "";
										if($tahun == $i){
											$s = "selected='selected'";
										}else{

										}
								?>
									<option value="<?php echo $i; ?>" <?php echo $s; ?>><?php echo $i; ?></option>
								<?php
									}
								?>
								</select>	
							</div>
						</div>
						<div class="form-group harian">
							<label class="control-label col-md-2">Tanggal</label>
							<div class="col-md-4">
								<div class="input-group input-large date-picker input-daterange" data-date="<?php echo date('d-m-Y'); ?>" data-date-format="dd-mm-yyyy">
									<input type="text" class="form-control" name="tanggal_awal" id="tanggal_awal" value="" readonly>
									<span class="input-group-addon">s/d</span>
									<input type="text" class="form-control" name="tanggal_akhir" id="tanggal_akhir" value="" readonly>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label" for="form_control_1">Nama Bank</label>
							<div class="col-md-3">
								<select name="tahun" class="form-control">
									<option value="BCA">BCA</option>
									<option value="MANDIRI">MANDIRI</option>
									<option value="PERMATA">PERMATA</option>
									<option value="MUAMALAT">MUAMALAT</option>
								</select>	
							</div>
						</div>
						
					</div>
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-2 col-md-10">
								<button type="submit" class="btn blue">Cetak</button>
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