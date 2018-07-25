<script src="<?php echo base_url(); ?>js/jquery-1.11.1.min.js" type="text/javascript"></script>
<script type="text/javascript">

$(document).ready(function(){

	$("#kode_satuan").focus();

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

	$("#tambah_konversi").click(function(){
		$("#tambah_konversi").fadeOut('slow');
		$("#table_konversi").fadeOut('slow');
		$("#form_konversi").fadeIn('slow');
	});

	$("#batal").click(function(){
		$("#tambah_konversi").fadeIn('slow');
		$("#table_konversi").fadeIn('slow');
		$("#form_konversi").fadeOut('slow');
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

function hapus_konversi(id)
{
	$('#popup_hapus').css('display','block');
	$('#popup_hapus').show();

		$.ajax({
		url : '<?php echo base_url(); ?>konversi_c/data_konversi_id',
		data : {id:id},
		type : "POST",
		dataType : "json",
		async : false,
		success : function(row){
			$('#id_hapus').val(id);
			$('#msg').html('Apakah <b>'+row['kode_satuan_1']+'</b> ini ingin dihapus ?');
		}
	});
}

function ubah_data_konversi(id)
{
		$('#popup_ubah').css('display','block');
		$('#popup_ubah').show();
	
		$.ajax({
			url : '<?php echo base_url(); ?>konversi_c/data_konversi_id',
			data : {id:id},
			type : "POST",
			dataType : "json",
			async : false,
			success : function(row){
				$('#id_konversi_modal').val(id);
				$('#id_satuan_1_modal').val(row['kode_satuan_1']);
				$('#id_satuan_2_modal').val(row['kode_satuan_2']);
				$('#nilai_1_modal').val(row['nilai_1']);
				$('#nilai_2_modal').val(row['nilai_2']);
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

<div class="row" id="form_konversi">
	<div class="col-md-12">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-green-haze">
					<i class="icon-settings font-green-haze"></i>
					<span class="caption-subject bold uppercase"> Form Setting Notifikasi </span>
				</div>
			</div>
			
			<div class="portlet-body form">
				<form role="form" class="form-horizontal" method="post" action="<?php echo $url_simpan; ?>">
					<div class="form-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
                                    <label class="col-md-6 control-label" >Setting saat ini </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="" aria-describedby="sizing-addon1" value="<?=$lihat_data->hari;?>" readonly="">
                                        <span class="input-group-addon" id="sizing-addon1">Hari Sebelum Jatuh Tempo</span>
                                    </div>
                                </div>
							</div>							
							
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
                                    <label class="col-md-6 control-label" >Setting Baru </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="" aria-describedby="sizing-addon1" value="" required="" onkeyup="FormatCurrency(this);" name="hari">
                                        <span class="input-group-addon" id="sizing-addon1">Hari Sebelum Jatuh Tempo</span>
                                    </div>
                                </div>
							</div>							
							
						</div>
					</div>
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-2 col-md-10">
								<input name="simpan" type="submit" class="btn blue" value="Simpan">
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- END SAMPLE FORM PORTLET-->
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