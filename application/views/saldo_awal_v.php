<script src="<?php echo base_url(); ?>js/jquery-1.11.1.min.js" type="text/javascript"></script>
<script type="text/javascript">

$(document).ready(function(){

	$("#kode_pelanggan").focus();

	$('#hapus').click(function(){
		$('#popup_hapus').css('display','block');
		$('#popup_hapus').show();
	});

	$('#close_hapus').click(function(){
		$('#popup_hapus').css('display','none');
		$('#popup_hapus').hide();
	});

	$('#batal_hapus').click(function(){
		$('#popup_hapus').css('display','none');
		$('#popup_hapus').hide();
	});

	$('#batal_ubah').click(function(){
		$('#popup_ubah').css('display','none');
		$('#popup_ubah').hide();
	});

	$("#tambah_pelanggan").click(function(){
		$("#tambah_pelanggan").fadeOut('slow');
		$("#table_pelanggan").fadeOut('slow');
		$("#form_pelanggan").fadeIn('slow');
	});

	$("#batal").click(function(){
		$("#tambah_pelanggan").fadeIn('slow');
		$("#table_pelanggan").fadeIn('slow');
		$("#form_pelanggan").fadeOut('slow');
	});
});

function loading(){
	$('#popup_load').css('display','block');
	$('#popup_load').show();
}

function hapus_toas(){
	toastr.options = {
      "closeButton": true,
      "debug": false,
      "positionClass": "toast-bottom-right",
      "onclick": null,
      "showDuration": "5000",
      "hideDuration": "5000",
      "timeOut": "5000",
      "extendedTimeOut": "5000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    toastr.success("Data Berhasil Dihapus!", "Terhapus");
}

function hapus_pelanggan(id)
{
	$('#popup_hapus').css('display','block');
	$('#popup_hapus').show();

		$.ajax({
		url : '<?php echo base_url(); ?>pelanggan_c/data_pelanggan_id',
		data : {id:id},
		type : "POST",
		dataType : "json",
		async : false,
		success : function(row){
			$('#id_hapus').val(id);
			$('#msg').html('Apakah <b>'+row['nama_pelanggan']+'</b> ini ingin dihapus ?');
		}
	});
}

function ubah_data_pelanggan(id)
{
		$('#popup_ubah').css('display','block');
		$('#popup_ubah').show();
	
		$.ajax({
			url : '<?php echo base_url(); ?>pelanggan_c/data_pelanggan_id',
			data : {id:id},
			type : "POST",
			dataType : "json",
			async : false,
			success : function(row){
				$('#id_pelanggan_modal').val(id);
				$('#kode_pelanggan_modal').val(row['kode_pelanggan']);
				$('#nama_pelanggan_modal').val(row['nama_pelanggan']);
				$('#alamat_pelanggan_modal').val(row['alamat_pelanggan']);
				$('#telp_modal').val(row['telp']);
				$('#email_modal').val(row['email']);
				$('#npwp_modal').val(row['npwp']);
			}
		});
}

function berhasil(){
	toastr.options = {
      "closeButton": true,
      "debug": false,
      "positionClass": "toast-bottom-right",
      "onclick": null,
      "showDuration": "5000",
      "hideDuration": "5000",
      "timeOut": "5000",
      "extendedTimeOut": "5000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    toastr.success("Data Berhasil Disimpan!", "Berhasil");
}

</script>

<div class="row" id="form_pelanggan" style="display:none;">
	<div class="col-md-12">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-green-haze">
					<i class="icon-settings font-green-haze"></i>
					<span class="caption-subject bold uppercase"> Input Saldo Awal </span>
				</div>
			</div>
			<div class="portlet-body form">
				<form role="form" class="form-horizontal" method="post" action="<?php echo $url_simpan; ?>">
					<div class="form-body">
						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Kode Akun</label>
							<div class="col-md-3">
								<select class="form-control input-large select2me input-sm" id="kode_akun" name="kode_akun" data-placeholder="Select...">
									<option value=""></option>
									<?php 
										foreach ($dt_kode_akun as $value){
									?>
										<option value="<?php echo $value->KODE_AKUN; ?>"><?php echo $value->KODE_AKUN; ?> - <?php echo $value->NAMA_AKUN; ?></option>
									<?php	
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Debet</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="debet" name="debet" >
								<div class="form-control-focus">
								</div>
							</div>
						</div>
						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Kredit</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="kredit" name="kredit" >
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

<button id="tambah_pelanggan" class="btn green">
Tambah Saldo Awal <i class="fa fa-plus"></i>
</button>
</br>
</br>

<div class="row" id="table_pelanggan" style="display:block;">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-edit"></i>Saldo Awal
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse">
					</a>
					<a href="#portlet-config" data-toggle="modal" class="config">
					</a>
					<a href="javascript:;" class="reload">
					</a>
					<a href="javascript:;" class="remove">
					</a>
				</div>		
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-hover table-bordered" id="sample_editable_1">
				<thead>
				<tr>
					<th style="text-align:center;"> No</th>
					<th style="text-align:center;"> Kode Akuntansi</th>
					<th style="text-align:center;"> Debet</th>
					<th style="text-align:center;"> Kredit</th>
					<th style="text-align:center;"> Aksi </th>
				</tr>
				</thead>
				<tbody>
					<?php 
					$no = 0 ;
					foreach ($lihat_data as $value) {
						$no++;
					?>
				<tr>
					<td style="text-align:center; vertical-align:"><?php echo $no; ?></td>
					<td style="text-align:center; vertical-align:"><?php echo $value->KODE_AKUN; ?></td>
					<td style="text-align:center; vertical-align:"><?php echo $value->DEBET; ?></td>
					<td style="text-align:center; vertical-align:"><?php echo $value->KREDIT; ?></td>
					<td style="text-align:center; vertical-align: middle;">
						<a class="btn default btn-xs purple" id="ubah" onclick="ubah_data_pelanggan(<?php echo $value->ID?>);"><i class="fa fa-edit"></i> Ubah </a>
						<a class="btn default btn-xs red" id="hapus" onclick="hapus_pelanggan(<?php echo $value->ID?>);"><i class="fa fa-trash-o"></i> Hapus </a>
					</td>
				</tr>
					<?php 
						}
					?>
				</tbody>
				</table>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>

<div id="popup_ubah">
	<div class="window_ubah">
		<div class="tab-content">
			<div id="tab_0" class="tab-pane active">
				<div class="portlet box green">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-pencil"></i>Ubah Saldo Awal
						</div>
					</div>

					<div class="portlet-body form">
						<!-- BEGIN FORM-->
						<div class="portlet-body form">
					<form role="form" class="form-horizontal" method="post" action="<?php echo $url_ubah;?>" enctype="multipart/form-data">
						<div class="form-body">
							<input type="hidden" name="id_pelanggan_modal" id="id_pelanggan_modal">

							<div class="form-group form-md-line-input">
								<label class="col-md-3 control-label" for="form_control_1">Kode Akun</label>
								<div class="col-md-4">
									<input required type="text" class="form-control" name="ed_kode_akun" id="ed_kode_akun" readonly="" >
									<div class="form-control-focus">
									</div>
								</div>
							</div>

							<div class="form-group form-md-line-input">
								<label class="col-md-3 control-label" for="form_control_1">Debet</label>
								<div class="col-md-4">
									<input required type="text" class="form-control" name="ed_debet" id="ed_debet" >
									<div class="form-control-focus">
									</div>
								</div>
							</div>

							<div class="form-group form-md-line-input">
								<label class="col-md-3 control-label" for="form_control_1">Kredit</label>
								<div class="col-md-4">
									<input required type="text" class="form-control" name="ed_kredit" id="ed_kredit" >
									<div class="form-control-focus">
									</div>
								</div>
							</div>


						<div class="form-actions">
							<div class="row">
								<div class="col-md-offset-3 col-md-10">
									<button type="submit" class="btn blue">Simpan</button>
									<button type="button" id="batal_ubah" class="btn default">Batal</button>
								</div>
							</div>
						</div>
				</div>
			</form>
		</div>
										<!-- END FORM-->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="popup_hapus">
	<div class="window_hapus">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<button class="bootbox-close-button close" type="button" id="close_hapus">×</button>
					<div class="bootbox-body" id="msg"></div>
				</div>
				<div class="modal-footer">
					<form action="<?php echo $url_hapus; ?>" method="post">
						<input type="hidden" name="id_hapus" id="id_hapus" value="">
						<input type="button" class="btn btn-default" data-bb-handler="cancel" value="Batal" id="batal_hapus">
						<input type="submit" class="btn btn-primary" data-bb-handler="confirm" value="Hapus" id="hapus" onclick="loading();">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){
	<?php
		if($this->session->flashdata('sukses')){
	?>
		berhasil();
	<?php 
		}elseif($this->session->flashdata('hapus')){
	?>
		hapus_toas();
	<?php
		}
	?>
});
</script>