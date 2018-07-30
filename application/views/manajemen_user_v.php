<script src="<?php echo base_url(); ?>js/jquery-1.11.1.min.js" type="text/javascript"></script>
<style type="text/css">
#view_hak_akses{
	display: none;
}
</style>
<script type="text/javascript">
$(document).ready(function(){
	<?php if($this->session->flashdata('simpan')){ ?>
	berhasil();
	<?php } ?>

	$('#btn_batal_ha').click(function(){
		$('#view_hak_akses').hide();
		$('#view_data').show();
	});
});

function hapus_kategori(id){
	$('#popup_hapus').css('display','block');
	$('#popup_hapus').show();

		$.ajax({
		url : '<?php echo base_url(); ?>kategori_barang_c/data_kategori_id',
		data : {id:id},
		type : "POST",
		dataType : "json",
		async : false,
		success : function(row){
			$('#id_hapus').val(id);
			$('#msg').html('Apakah <b>'+row['nama_kategori']+'</b> ini ingin dihapus ?');
		}
	});
}

function ubah_data_kategori(id){
		$('#popup_ubah').css('display','block');
		$('#popup_ubah').show();
	
		$.ajax({
			url : '<?php echo base_url(); ?>kategori_barang_c/data_kategori_id',
			data : {id:id},
			type : "POST",
			dataType : "json",
			async : false,
			success : function(row){
				$('#id_kategori_modal').val(id);
				$('#kode_kategori_modal').val(row['kode_kategori']);
				$('#nama_kategori_modal').val(row['nama_kategori']);
			}
		});
}
</script>

<div class="row" id="form_kategori" style="display:none; ">
	<div class="col-md-12">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-green-haze">
					<i class="icon-settings font-green-haze"></i>
					<span class="caption-subject bold uppercase"> Form Kategori </span>
				</div>
			</div>
			<div class="portlet-body form">
				<form role="form" class="form-horizontal" method="post" action="<?php echo $url_simpan; ?>">
					<div class="form-body">
						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Nama Lengkap</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" >
								<div class="form-control-focus">
								</div>
							</div>
						</div>
						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Username</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="username" name="username" >
								<div class="form-control-focus">
								</div>
							</div>
						</div>
						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Password</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="password" name="password" >
								<div class="form-control-focus">
								</div>
							</div>
						</div>

						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Ulangi Password</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="password_ulang" name="password_ulang" >
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

<button id="tambah_kategori" class="btn green">
Tambah User <i class="fa fa-plus"></i>
</button>
</br>
</br>

<div class="row" id="view_data">
	<div class="col-md-12">
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-edit"></i>Table Manajemen User
				</div>		
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-hover table-bordered" id="sample_editable_1">
				<thead>
				<tr>
					<th style="text-align:center;"> No</th>
					<th style="text-align:center;"> Username</th>
					<th style="text-align:center;"> Departemen</th>
					<th style="text-align:center;"> Level</th>
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
					<td style="text-align:center; vertical-align:"><?php echo $value->username; ?></td>
					<td style="text-align:center; vertical-align:"><?php echo $value->nama_departemen; ?></td>
					<td style="text-align:center; vertical-align:"><?php echo $value->level; ?></td>
					<td style="text-align:center; vertical-align: middle;">
						<a class="btn default btn-xs blue" href="<?php echo base_url(); ?>manajemen_user_c/hak_akses/<?php echo $value->id;?>">
							<i class="fa fa-cog"></i> Kelola Hak Akses 
						</a>
						<a class="btn default btn-xs purple" id="ubah" onclick="ubah_data_kategori(<?php echo $value->id?>);">
							<i class="fa fa-edit"></i> Ubah
						</a>
						<a class="btn default btn-xs red" id="hapus" onclick="hapus_kategori(<?php echo $value->id?>);">
							<i class="fa fa-trash-o"></i> Hapus
						</a>
					</td>
				</tr>
					<?php 
						}
					?>
				</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div id="popup_ubah">
	<div class="window_ubah">
		<div class="tab-content">
			<div id="tab_0" class="tab-pane active">
				<div class="portlet box green">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-pencil"></i>Ubah Kategori
						</div>
					</div>

					<div class="portlet-body form">
						<!-- BEGIN FORM-->
						<div class="portlet-body form">
					<form role="form" class="form-horizontal" method="post" action="<?php echo $url_ubah;?>" enctype="multipart/form-data">
						<div class="form-body">
							<input type="hidden" name="id_kategori_modal" id="id_kategori_modal">

							<div class="form-group form-md-line-input">
								<label class="col-md-3 control-label" for="form_control_1">Kode Kategori</label>
								<div class="col-md-4">
									<input required type="text" class="form-control" name="kode_kategori_modal" id="kode_kategori_modal" >
									<div class="form-control-focus">
									</div>
								</div>
							</div>

							<div class="form-group form-md-line-input">
								<label class="col-md-3 control-label" for="form_control_1">Nama Kategori</label>
								<div class="col-md-4">
									<input required type="text" class="form-control" name="nama_kategori_modal" id="nama_kategori_modal" >
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
						<input type="submit" class="btn btn-primary" data-bb-handler="confirm" value="Hapus" id="hapus">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>