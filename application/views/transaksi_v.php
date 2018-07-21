<script src="<?php echo base_url(); ?>js/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/pagination.js" type="text/javascript"></script>

<style type="text/css">

</style>

<script type="text/javascript">
$(document).ready(function(){
	pagingKategori();
	pagingKonsumen();

	$('#btn_simpan1').click(function(){
		var id_kategori = $('#id_kategori').val();
		var kode_akun = $('#akun_penerimaan_brg').val();
		var tipe = 'Akun Terima';

		if(id_kategori == ""){
			notif_kat_kosong();
		}else{
			$('#popup_load').show();

			$.ajax({
				url : '<?php echo base_url(); ?>transaksi_c/simpan_akun',
				data : {
					id_kategori:id_kategori,
					kode_akun:kode_akun,
					tipe:tipe
				},
				type : "POST",
				dataType : "json",
				success : function(row){
					$('#popup_load').hide();
					berhasil();
					klik_kategori(id_kategori);
				}
			});	
		}
	});

	$('#btn_simpan2').click(function(){
		var id_kategori = $('#id_kategori').val();
		var kode_akun = $('#akun_pakai_brg').val();
		var tipe = 'Akun Pakai';

		if(id_kategori == ""){
			notif_kat_kosong()
		}else{
			$('#popup_load').show();

			$.ajax({
				url : '<?php echo base_url(); ?>transaksi_c/simpan_akun',
				data : {
					id_kategori:id_kategori,
					kode_akun:kode_akun,
					tipe:tipe
				},
				type : "POST",
				dataType : "json",
				success : function(row){
					$('#popup_load').hide();
					berhasil();
					klik_kategori(id_kategori);
				}
			});
		}
	});

	$('#btn_simpan3').click(function(){
		var id_kategori = $('#id_kategori').val();
		var kode_akun = $('#akun_hutang_brg').val();
		var tipe = 'Akun Hutang';

		if(id_kategori == ""){
			notif_kat_kosong()
		}else{
			$('#popup_load').show();

			$.ajax({
				url : '<?php echo base_url(); ?>transaksi_c/simpan_akun',
				data : {
					id_kategori:id_kategori,
					kode_akun:kode_akun,
					tipe:tipe
				},
				type : "POST",
				dataType : "json",
				success : function(row){
					$('#popup_load').hide();
					berhasil();
					klik_kategori(id_kategori);
				}
			});
		}
	});

	$('#btn_simpan1_kon').click(function(){
		var id_konsumen = $('#id_konsumen').val();
		var kode_akun = $('#akun_hutang_brg').val();
		var tipe = 'Akun Hutang';

		if(id_konsumen == ""){
			notif_kon_kosong();
		}else{
			$('#popup_load').show();

			$.ajax({
				url : '<?php echo base_url(); ?>transaksi_c/simpan_akun_kon',
				data : {
					id_konsumen:id_konsumen,
					kode_akun:kode_akun,
					tipe:tipe
				},
				type : "POST",
				dataType : "json",
				success : function(row){
					$('#popup_load').hide();
					berhasil();
					klik_konsumen(id_konsumen);
				}
			});	
		}
	});

	$('#btn_simpan2_kon').click(function(){
		var id_konsumen = $('#id_konsumen').val();
		var kode_akun = $('#akun_piutang_brg').val();
		var tipe = 'Akun Piutang';

		if(id_konsumen == ""){
			notif_kon_kosong();
		}else{
			$('#popup_load').show();

			$.ajax({
				url : '<?php echo base_url(); ?>transaksi_c/simpan_akun_kon',
				data : {
					id_konsumen:id_konsumen,
					kode_akun:kode_akun,
					tipe:tipe
				},
				type : "POST",
				dataType : "json",
				success : function(row){
					$('#popup_load').hide();
					berhasil();
					klik_konsumen(id_konsumen);
				}
			});	
		}
	});
});

function pagingKategori($selector){
    var jumlah_tampil = 10;

    if(typeof $selector == 'undefined')
    {
        $selector = $("#tabel_kategori tbody tr"); 
    }

    window.tp = new Pagination('#tablePagingKategori', {
        itemsCount:$selector.length,
        pageSize : parseInt(jumlah_tampil),
        onPageSizeChange: function (ps) {
            console.log('changed to ' + ps);
        },
        onPageChange: function (paging) {
            //custom paging logic here
            //console.log(paging);
            var start = paging.pageSize * (paging.currentPage - 1),
                end = start + paging.pageSize,
                $rows = $selector;

            $rows.hide();

            for (var i = start; i < end; i++) {
                $rows.eq(i).show();
            }
        }
    });
}

function pagingKonsumen($selector){
    var jumlah_tampil = 10;

    if(typeof $selector == 'undefined')
    {
        $selector = $("#tabel_konsumen tbody tr"); 
    }

    window.tp = new Pagination('#tablePagingKonsumen', {
        itemsCount:$selector.length,
        pageSize : parseInt(jumlah_tampil),
        onPageSizeChange: function (ps) {
            console.log('changed to ' + ps);
        },
        onPageChange: function (paging) {
            //custom paging logic here
            //console.log(paging);
            var start = paging.pageSize * (paging.currentPage - 1),
                end = start + paging.pageSize,
                $rows = $selector;

            $rows.hide();

            for (var i = start; i < end; i++) {
                $rows.eq(i).show();
            }
        }
    });
}

function klik_kategori(id){
	$('#popup_load').show();

	$.ajax({
		url : '<?php echo base_url(); ?>transaksi_c/get_kat_barang_id',
		data : {id:id},
		type : "POST",
		dataType : "json",
		success : function(row){
			$('#id_kategori').val(id);
			
			$('#kode_akun_terima_brg').html(row['kode_akun_terima']);
			$('#text_akun_terima_brg').html(row['akun_terima']);

			$('#kode_akun_pakai_brg').html(row['kode_akun_pakai']);
			$('#text_akun_pakai_brg').html(row['akun_pakai']);

			$('#kode_akun_hutang_brg').html(row['kode_akun_hutang']);
			$('#text_akun_hutang_brg').html(row['akun_hutang']);

			$('#popup_load').hide();
		}
	});
}

function klik_konsumen(id){
	$('#popup_load').show();

	$.ajax({
		url : '<?php echo base_url(); ?>transaksi_c/get_konsumen_id',
		data : {id:id},
		type : "POST",
		dataType : "json",
		success : function(row){
			$('#id_konsumen').val(id);
			
			$('#kode_akun_hutang_dg').html(row['akun_hutang_dagang']);
			$('#text_akun_hutang_dg').html(row['akun_hutang']);

			$('#kode_akun_piutang_brg').html(row['akun_piutang_barang']);
			$('#text_akun_piutang_brg').html(row['akun_piutang']);

			$('#popup_load').hide();
		}
	});
}
</script>

<div id="popup_load">
    <div class="window_load">
        <img src="<?=base_url()?>ico/loading5.gif" height="100" width="125">
    </div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="portlet-body">
				<div class="tabbable tabbable-tabdrop">
					<ul class="nav nav-pills">
						<li class="active">
							<a data-toggle="tab" href="#tab11" aria-expanded="true">Transaksi Item Barang</a>
						</li>
						<li class="">
							<a data-toggle="tab" href="#tab12" aria-expanded="false">Transaksi Konsumen</a>
						</li>
						<li>
							<a data-toggle="tab" href="#tab13">Transaksi Uang</a>
						</li>
						<li>
							<a data-toggle="tab" href="#tab14">Transaksi Lainnya</a>
						</li>
					</ul>
					<div class="tab-content">
						<div id="tab11" class="tab-pane active">
							<form role="form" class="form-horizontal" method="post">
								<input type="hidden" name="id_kategori" id="id_kategori" value="">
								<div class="form-body">
									<div class="col-md-6">
										<table class="table table-hover table-bordered" id="tabel_kategori">
											<thead>
												<tr class="success">
													<th>Master Barang</th>
												</tr>
											</thead>
											<tbody>
											<?php
												foreach ($lihat_data as $key => $value) {
											?>
												<tr style="cursor: pointer;" onclick="klik_kategori(<?php echo $value->id_kategori; ?>);">
													<td><?php echo $value->nama_kategori; ?></td>
												</tr>
											<?php
												}
											?>
											</tbody>
										</table>
										<div id="tablePagingKategori"> </div>
									</div>
									<div class="col-md-6">
										<table class="table">
											<tr>
												<td>
													<label>Akun untuk penerimaan barang</label>
													<div class="input-group">
														<select class="form-control input-medium select2me" name="akun_penerimaan_brg" id="akun_penerimaan_brg" data-placeholder="Select...">
														<?php
															foreach ($kode_akun as $key => $value) {
														?>
															<option value="<?php echo $value->KODE_AKUN; ?>"><?php echo $value->NAMA_AKUN; ?></option>
														<?php
															}
														?>
														</select>
													</div>	
												</td>
												<td>Kode Akun</td>
												<td>Uraian</td>
											</tr>
											<tr>
												<td>
													<button class="btn blue" type="button" id="btn_simpan1">Simpan</button>
												</td>
												<td><b id="kode_akun_terima_brg">-</b></td>
												<td><b id="text_akun_terima_brg">-</b></td>
											</tr>
											<tr>
												<td>
													<label>Akun untuk pemakaian barang</label>
													<div class="input-group">
														<select class="form-control input-medium select2me" name="akun_pakai_brg" id="akun_pakai_brg" data-placeholder="Select...">
														<?php
															foreach ($kode_akun as $key => $value) {
														?>
															<option value="<?php echo $value->KODE_AKUN; ?>"><?php echo $value->NAMA_AKUN; ?></option>
														<?php
															}
														?>
														</select>
													</div>	
												</td>
												<td>Kode Akun</td>
												<td>Uraian</td>
											</tr>
											<tr>
												<td>
													<button class="btn blue" type="button" id="btn_simpan2">Simpan</button>
												</td>
												<td><b id="kode_akun_pakai_brg">-</b></td>
												<td><b id="text_akun_pakai_brg">-</b></td>
											</tr>
											<tr>
												<td>
													<label>Akun untuk hutang barang</label>
													<div class="input-group">
														<select class="form-control input-medium select2me" name="akun_hutang_brg" id="akun_hutang_brg" data-placeholder="Select...">
														<?php
															foreach ($kode_akun as $key => $value) {
														?>
															<option value="<?php echo $value->KODE_AKUN; ?>"><?php echo $value->NAMA_AKUN; ?></option>
														<?php
															}
														?>
														</select>
													</div>	
												</td>
												<td>Kode Akun</td>
												<td>Uraian</td>
											</tr>
											<tr>
												<td>
													<button class="btn blue" type="button" id="btn_simpan3">Simpan</button>
												</td>
												<td><b id="kode_akun_hutang_brg">-</b></td>
												<td><b id="text_akun_hutang_brg">-</b></td>
											</tr>
										</table>
									</div>
								</div>
							</form>
						</div>

						<div id="tab12" class="tab-pane">
							<form role="form" class="form-horizontal" method="post">
								<input type="hidden" name="id_konsumen" id="id_konsumen" value="">
								<div class="form-body">
									<div class="col-md-6">
										<table class="table table-hover table-bordered" id="tabel_konsumen">
											<thead>
												<tr class="danger">
													<th>Kode Konsumen</th>
													<th>Nama Konsumen</th>
												</tr>
											</thead>
											<tbody>
											<?php
												foreach ($konsumen as $key => $value) {
											?>
												<tr style="cursor: pointer;" onclick="klik_konsumen(<?php echo $value->id_pelanggan; ?>);">
													<td><?php echo $value->kode_pelanggan; ?></td>
													<td><?php echo $value->nama_pelanggan; ?></td>
												</tr>
											<?php
												}
											?>
											</tbody>
										</table>
										<div id="tablePagingKonsumen"> </div>
									</div>
									<div class="col-md-6">
										<table class="table">
											<tr>
												<td>
													<label>Akun untuk hutang dagang</label>
													<div class="input-group">
														<select class="form-control input-medium select2me" name="akun_hutang_dg" id="akun_hutang_dg" data-placeholder="Select...">
														<?php
															foreach ($kode_akun as $key => $value) {
														?>
															<option value="<?php echo $value->KODE_AKUN; ?>"><?php echo $value->NAMA_AKUN; ?></option>
														<?php
															}
														?>
														</select>
													</div>	
												</td>
												<td>Kode Akun</td>
												<td>Uraian</td>
											</tr>
											<tr>
												<td>
													<button class="btn blue" type="button" id="btn_simpan1_kon">Simpan</button>
												</td>
												<td><b id="kode_akun_hutang_dg">-</b></td>
												<td><b id="text_akun_hutang_dg">-</b></td>
											</tr>
											<tr>
												<td>
													<label>Akun untuk piutang barang</label>
													<div class="input-group">
														<select class="form-control input-medium select2me" name="akun_piutang_brg" id="akun_piutang_brg" data-placeholder="Select...">
														<?php
															foreach ($kode_akun as $key => $value) {
														?>
															<option value="<?php echo $value->KODE_AKUN; ?>"><?php echo $value->NAMA_AKUN; ?></option>
														<?php
															}
														?>
														</select>
													</div>	
												</td>
												<td>Kode Akun</td>
												<td>Uraian</td>
											</tr>
											<tr>
												<td>
													<button class="btn blue" type="button" id="btn_simpan2_kon">Simpan</button>
												</td>
												<td><b id="kode_akun_piutang_brg">-</b></td>
												<td><b id="text_akun_piutang_brg">-</b></td>
											</tr>
										</table>
									</div>
								</div>
							</form>
						</div>
						<div id="tab13" class="tab-pane">
							<p>
								 Howdy, I'm in Section 3.
							</p>
						</div>
						<div id="tab14" class="tab-pane">
							<p>
								 Howdy, I'm in Section 4.
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>