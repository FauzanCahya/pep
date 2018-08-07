<script src="<?php echo base_url(); ?>js/jquery-1.11.1.min.js" type="text/javascript"></script>
<style type="text/css">
#view_hak_akses,
#view_tambah,
#view_ubah{
	display: none;
}
</style>
<script type="text/javascript">
var ajax = "";
$(document).ready(function(){
	<?php if($this->session->flashdata('simpan')){ ?>
	berhasil();
	<?php }else if($this->session->flashdata('hapus')){ ?>
	hapus();
	<?php } ?>
	
	$('#btn_tambah').click(function(){
		$('#view_data').hide();
		$('#view_tambah').show();
	});

	$('#btn_batal').click(function(){
		$('#view_data').show();
		$('#view_tambah').hide();
	});

	$('.cari_div').click(function(){
		$('#popup_dep').click();
		get_divisi();
	});

	$('#btn_batal_ha').click(function(){
		$('#view_hak_akses').hide();
		$('#view_data').show();
	});
});

function ubah_data(id){
	$('#view_ubah').show();
	$('#view_data').hide();

	$.ajax({
		url : '<?php echo base_url(); ?>manajemen_user_c/get_user_id',
		data : {id:id},
		type : "POST",
		dataType : "json",
		success : function(row){
			$('#id_ubah').val(id);
			$('#nama_lengkap_ubah').val(row['nama_user']);
			$('#username_ubah').val(row['username']);
		}
	});

	$('#btn_batal_ubah').click(function(){
		$('#view_data').show();
		$('#view_ubah').hide();
	});
}

function hapus_data(id){
	$('#popup_hapus').click();

	$.ajax({
		url : '<?php echo base_url(); ?>manajemen_user_c/get_user_id',
		data : {id:id},
		type : "POST",
		dataType : "json",
		success : function(row){
			$('#id_hapus').val(id);
			$('#msg').html('Apakah user <b>'+row['username']+'</b> ingin dihapus ?');
		}
	});
}

function get_divisi(){
	var keyword = $('#search_div').val();

	if(ajax){
		ajax.abort();
	}

	ajax = $.ajax({
		url : '<?php echo base_url(); ?>manajemen_user_c/get_divisi',
		data : {keyword:keyword},
		type : "GET",
		dataType : "json",
		success : function(result){
			$tr = '';

			if(result == null || result == ""){
				$tr = '<tr><td colspan="2" style="text-align:center;">Data Tidak Ada</td></tr>';
			}else{
				var no = 0;

				for(var i=0; i<result.length; i++){
					no++;

					$tr += '<tr style="cursor:pointer;" onclick="klik_divisi('+result[i].id_divisi+');">'+
								'<td style="text-align:center;">'+no+'</td>'+
								'<td>'+result[i].nama_divisi+'</td>'+
							'</tr>';
				}
			}

			$('#tabel_dep tbody').html($tr);
		}
	});

	$('#search_div').off('keyup').keyup(function(){
		get_divisi();
	});
}

function klik_divisi(id){
	$('#tutup_div').click();

	$.ajax({
		url : '<?php echo base_url(); ?>manajemen_user_c/get_divisi_id',
		data : {id:id},
		type : "POST",
		dataType : "json",
		success : function(row){
			$('#id_divisi').val(id);
			$('#nama_divisi').val(row['nama_divisi']);
		}
	});
}

function user_same(){
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
    toastr.error("Username ini telah digunakan!!!", "Perhatian");
}

function pass_no_same(){
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
    toastr.error("Ulangi password dengan benar!!!", "Perhatian");
}

function cek_username(){
	var username = $('#username').val();

	$.ajax({
		url : '<?php echo base_url(); ?>manajemen_user_c/cek_username',
		data : {username:username},
		type : "POST",
		dataType : "json",
		success : function(row){
			if(row['TOTAL'] != 0){
				user_same();
				$('#btn_simpan').prop('disabled','disabled');
				$('#username').focus();
			}else{
				$('#btn_simpan').removeAttr('disabled');
			}
		}
	});
}

function cek_password(){
	var pass1 = $('#password').val();
	var pass2 = $('#password_ulang').val();

	if(pass1 != pass2){
		pass_no_same();
		$('#btn_simpan').prop('disabled','disabled');
	}else{
		$('#btn_simpan').removeAttr('disabled');
	}
}
</script>

<div class="row" id="view_data">
	<div class="col-md-12">
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-edit"></i>Table Manajemen User
				</div>		
			</div>
			<div class="portlet-body">
				<button id="btn_tambah" class="btn green" style="margin-bottom: 10px;">
					Tambah User <i class="fa fa-plus"></i>
				</button>
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
								<!-- <a class="btn default btn-xs purple" id="ubah" onclick="ubah_data(<?php //echo $value->id?>);">
									<i class="fa fa-edit"></i> Ubah
								</a> -->
								<a class="btn default btn-xs red" id="hapus" onclick="hapus_data(<?php echo $value->id?>);">
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

<div class="row" id="view_tambah">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-green-haze">
					<i class="icon-settings font-green-haze"></i>
					<span class="caption-subject bold uppercase"> Form Input User </span>
				</div>
			</div>
			<div class="portlet-body form">
				<form role="form" class="form-horizontal" method="post" action="<?php echo base_url(); ?>manajemen_user_c/simpan_user">
					<div class="form-body">
						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Divisi</label>
							<div class="col-md-3">
								<div class="input-group">
									<div class="input-group-control">
										<input type="hidden" id="id_divisi" name="id_divisi" value="">
										<input type="text" class="form-control" id="nama_divisi" name="nama_divisi" value="" readonly>
										<div class="form-control-focus">
										</div>
									</div>
									<span class="input-group-btn btn-left">
										<button class="btn yellow cari_div" type="button"><i class="fa fa-search"></i></button>
									</span>
								</div>
							</div>
						</div>
						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Nama User</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="">
								<div class="form-control-focus">
								</div>
							</div>
						</div>
						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Username</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="username" name="username" value="" onchange="cek_username();">
								<div class="form-control-focus">
								</div>
							</div>
						</div>
						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Password</label>
							<div class="col-md-8">
								<input type="password" class="form-control" id="password" name="password" value="">
								<div class="form-control-focus">
								</div>
							</div>
						</div>

						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Ulangi Password</label>
							<div class="col-md-8">
								<input type="password" class="form-control" id="password_ulang" name="password_ulang" value="" onchange="cek_password();">
								<div class="form-control-focus">
								</div>
							</div>
						</div>

						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Level</label>
							<div class="col-md-3">
								<select class="form-control" name="level">
									<?php 

										$sql = $this->db->query("SELECT * FROM master_level")->result();

										foreach ($sql as $key => $value) {
											

									?>
										<option value="<?=$value->LEVEL;?>"><?=$value->LEVEL;?></option> 

									<?php } ?>

								
								</select>
							</div>
						</div>
					</div>
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-2 col-md-10">
								<button type="submit" id="btn_simpan" class="btn blue">Simpan</button>
								<button type="button" id="btn_batal" class="btn red">Batal</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="row" id="view_ubah">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-green-haze">
					<i class="icon-settings font-green-haze"></i>
					<span class="caption-subject bold uppercase"> Form Input User </span>
				</div>
			</div>
			<div class="portlet-body form">
				<form role="form" class="form-horizontal" method="post" action="">
					<input type="hidden" name="id_ubah" id="id_ubah" value="">
					<div class="form-body">
						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Nama User</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="nama_lengkap_ubah" name="nama_lengkap_ubah" value="">
								<div class="form-control-focus">
								</div>
							</div>
						</div>
						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Username</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="username_ubah" name="username_ubah" value="">
								<div class="form-control-focus">
								</div>
							</div>
						</div>
						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Password</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="password_ubah" name="password_ubah" value="">
								<div class="form-control-focus">
								</div>
							</div>
						</div>

						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Ulangi Password</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="password_ulang_ubah" name="password_ulang_ubah" value="">
								<div class="form-control-focus">
								</div>
							</div>
						</div>
					</div>
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-2 col-md-10">
								<button type="submit" class="btn blue">Simpan</button>
								<button type="button" id="btn_batal_ubah" class="btn red">Batal</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<a class="btn default" id="popup_hapus" data-toggle="modal" href="#basic" style="display: none;">View Demo </a>
<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Konfirmasi Hapus</h4>
			</div>
			<div class="modal-body">
				<p id="msg"></p>
			</div>
			<div class="modal-footer">
				<form action="<?php echo $url_hapus; ?>" method="post">
					<input type="hidden" name="id_hapus" id="id_hapus" value="">
					<button type="button" class="btn default" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn red">Hapus</button>
				</form>
			</div>
		</div>
	</div>
</div>

<a class="btn default" id="popup_dep" data-toggle="modal" href="#basic2" style="display: none;">View Demo </a>
<div class="modal fade" id="basic2" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Data Divisi</h4>
			</div>
			<div class="modal-body">
				<form role="form" class="form-horizontal" method="post" action="">
					<div class="form-body">
						<div class="form-group">
							<div class="col-md-12">
								<input type="text" class="form-control" id="search_div" value="" placeholder="Cari divisi...">
							</div>
						</div>
					</div>
				</form>
				<table class="table table-hover table-bordered" id="tabel_dep">
					<thead>
						<tr class="success">
							<th style="text-align:center;"> No</th>
							<th style="text-align:center;"> Nama Divisi</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn default" id="tutup_div" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>