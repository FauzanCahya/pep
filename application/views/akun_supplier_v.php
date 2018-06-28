<script src="<?php echo base_url(); ?>js/jquery-1.11.1.min.js" type="text/javascript"></script>
<script type="text/javascript">

$(document).ready(function(){

	$("#kode_supplier").focus();

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

	$("#tambah_supplier").click(function(){
		$("#tambah_supplier").fadeOut('slow');
		$("#table_supplier").fadeOut('slow');
		$("#form_supplier").fadeIn('slow');
	});

	$("#batal").click(function(){
		$("#tambah_supplier").fadeIn('slow');
		$("#table_supplier").fadeIn('slow');
		$("#form_supplier").fadeOut('slow');
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

function hapus_supplier(id)
{
	$('#popup_hapus').css('display','block');
	$('#popup_hapus').show();

		$.ajax({
		url : '<?php echo base_url(); ?>supplier_c/data_supplier_id',
		data : {id:id},
		type : "POST",
		dataType : "json",
		async : false,
		success : function(row){
			$('#id_hapus').val(id);
			$('#msg').html('Apakah <b>'+row['nama_supplier']+'</b> ini ingin dihapus ?');
		}
	});
}

function ubah_data_supplier(id)
{
		$('#popup_ubah').css('display','block');
		$('#popup_ubah').show();
	
		$.ajax({
			url : '<?php echo base_url(); ?>supplier_c/data_supplier_id',
			data : {id:id},
			type : "POST",
			dataType : "json",
			async : false,
			success : function(row){
				$('#id_supplier_modal').val(id);
				$('#kode_supplier_modal').val(row['kode_supplier']);
				$('#nama_supplier_modal').val(row['nama_supplier']);
				$('#alamat_supplier_modal').val(row['alamat_supplier']);
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

<div class="row" id="form_supplier" style="display:none;">
	<div class="col-md-12">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-green-haze">
					<i class="icon-settings font-green-haze"></i>
					<span class="caption-subject bold uppercase"> Form Supplier </span>
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
								<input type="text" class="form-control" id="kode_supplier" name="kode_supplier" >
								<div class="form-control-focus">
								</div>
							</div>
						</div>
						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Nama Supplier</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="nama_supplier" name="nama_supplier" >
								<div class="form-control-focus">
								</div>
							</div>
						</div>
						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Alamat Supplier</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="alamat_supplier" name="alamat_supplier" >
								<div class="form-control-focus">
								</div>
							</div>
						</div>
						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Telephon</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="telp" name="telp" >
								<div class="form-control-focus">
								</div>
							</div>
						</div>
						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Email</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="email" name="email" >
								<div class="form-control-focus">
								</div>
							</div>
						</div>
						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">NPWP</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="npwp" name="npwp" >
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


</br>
</br>

<div class="row" id="table_supplier" style="display:block;">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-edit"></i>Table Supplier
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
					<th style="text-align:center;"> Kode Supplier</th>
					<th style="text-align:center;"> Nama Supplier</th>
					<th style="text-align:center;"> Akun Debit</th>
					<th style="text-align:center;"> Akun Kredit</th>
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
					<td style="text-align:center; vertical-align:"><?php echo $value->kode_supplier; ?></td>
					<td style="text-align:center; vertical-align:"><?php echo $value->nama_supplier; ?></td>
					<?php 
						$id_debit = $value->akun_debit;
						$id_kredit = $value->akun_kredit;
						if($id_debit == '' || $id_debit == NULL){
							?>
								<td style="text-align:center; vertical-align:"></td>
								<td style="text-align:center; vertical-align:"></td>
							<?php
						}else{
						$dt_db = $this->db->query("SELECT * FROM ak_grup_kode_akun WHERE ID = '$id_debit'")->row();
						$dt_kr = $this->db->query("SELECT * FROM ak_grup_kode_akun WHERE ID = '$id_kredit'")->row();

					?>
					<td style="text-align:center; vertical-align:"><?php echo $dt_db->NAMA_GRUP; ?></td>
					<td style="text-align:center; vertical-align:"><?php echo $dt_kr->NAMA_GRUP; ?></td>
				<?php } ?>
					<td style="text-align:center; vertical-align: middle;">
						<a class="btn default btn-xs purple" id="ubah" href="<?php echo base_url();?>akun_supplier_c/ubah_data/<?=$value->id_supplier;?>" ><i class="fa fa-edit"></i> Update </a>
						<!-- <a class="btn default btn-xs red" id="hapus" onclick="hapus_supplier(<?php echo $value->id_supplier?>);"><i class="fa fa-trash-o"></i> Hapus </a> -->
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
							<i class="fa fa-pencil"></i>Ubah supplier
						</div>
					</div>

					<div class="portlet-body form">
						<!-- BEGIN FORM-->
						<div class="portlet-body form">
					<form role="form" class="form-horizontal" method="post" action="<?php echo $url_ubah;?>" enctype="multipart/form-data">
						<div class="form-body">
							<input type="hidden" name="id_supplier_modal" id="id_supplier_modal">

							<div class="form-group form-md-line-input">
								<label class="col-md-3 control-label" for="form_control_1">Kode Supplier</label>
								<div class="col-md-4">
									<input required type="text" class="form-control" name="kode_supplier_modal" id="kode_supplier_modal" >
									<div class="form-control-focus">
									</div>
								</div>
							</div>

							<div class="form-group form-md-line-input">
								<label class="col-md-3 control-label" for="form_control_1">Nama Supplier</label>
								<div class="col-md-4">
									<input required type="text" class="form-control" name="nama_supplier_modal" id="nama_supplier_modal" >
									<div class="form-control-focus">
									</div>
								</div>
							</div>

							<div class="form-group form-md-line-input">
								<label class="col-md-3 control-label" for="form_control_1">Alamat Supplier</label>
								<div class="col-md-4">
									<input required type="text" class="form-control" name="alamat_supplier_modal" id="alamat_supplier_modal" >
									<div class="form-control-focus">
									</div>
								</div>
							</div>

							<div class="form-group form-md-line-input">
								<label class="col-md-3 control-label" for="form_control_1">Telephone</label>
								<div class="col-md-4">
									<input required type="text" class="form-control" name="telp_modal" id="telp_modal" >
									<div class="form-control-focus">
									</div>
								</div>
							</div>

							<div class="form-group form-md-line-input">
								<label class="col-md-3 control-label" for="form_control_1">Email</label>
								<div class="col-md-4">
									<input required type="text" class="form-control" name="email_modal" id="email_modal" >
									<div class="form-control-focus">
									</div>
								</div>
							</div>

							<div class="form-group form-md-line-input">
								<label class="col-md-3 control-label" for="form_control_1">NPWP</label>
								<div class="col-md-4">
									<input required type="text" class="form-control" name="npwp_modal" id="npwp_modal" >
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