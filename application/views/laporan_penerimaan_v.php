<script src="<?php echo base_url(); ?>js/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/js-form.js" type="text/javascript"></script>
<script type="text/javascript">

$(document).ready(function(){

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

	$("#tambah_laporan").click(function(){
		$("#tambah_laporan").fadeOut('slow');
		$("#table_laporan").fadeOut('slow');
		$(".cui").fadeOut('slow');
		$("#form_laporan").fadeIn('slow');
		$("#tabel_total").fadeIn('slow');
	});

	$("#batal").click(function(){
		$("#tambah_laporan").fadeIn('slow');
		$("#table_laporan").fadeIn('slow');
		$("#form_laporan").fadeOut('slow');
		$("#tabel_total").fadeOut('slow');
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

function hapus_laporan(id)
{
	$('#popup_hapus').css('display','block');
	$('#popup_hapus').show();

		$.ajax({
		url : '<?php echo base_url(); ?>laporan_penerimaan_c/data_laporan_id',
		data : {id:id},
		type : "POST",
		dataType : "json",
		async : false,
		success : function(row){
			$('#id_hapus').val(id);
			$('#msg').html('Apakah <b>'+row['no_lpb']+'</b> ini ingin dihapus ?');
		}
	});
}

function ubah_data_laporan(id)
{
		$("#tambah_laporan").fadeOut('slow');
		$("#table_laporan").fadeOut('slow');
		$("#form_laporan").fadeIn('slow');
		$("#tabel_total").fadeIn('slow');
	
		$.ajax({
			url : '<?php echo base_url(); ?>laporan_penerimaan_c/data_laporan_id',
			data : {id:id},
			type : "POST",
			dataType : "json",
			async : false,
			success : function(row){
				$('#id_laporan').val(id);
				$('#no_lpb').val(row['no_lpb']);
				$('#tanggal').val(row['tanggal']);
				$('#no_po').val(row['no_po']);
				$('#diterima').val(row['diterima']);
				$('#nama_produk_1').val(row['nama_produk']);
				$('#keterangan_1').val(row['keterangan']);
				$('#kuantitas_1').val(row['kuantitas']);
				$('#harga_1').val(row['harga']);
				$('#total_1').val(row['total']);
				$('#no_opb_1').val(row['no_opb']);
			}
		});
}

function simpan_add_produk(){
	var nama_produk = $('#nama_produk').val();
	var keterangan 	= $('#keterangan').val();
	var kuantitas   = $('#kuantitas').val();
	var harga       = $('#harga').val();
	var total       = $('#total').val();
	var no_spb      = $('#no_opb').val();

	if(nama_produk == ""){
		alert("Nama Produk Harus di isi.");
	} else if(keterangan == ""){
		alert("Nama Produk Harus di isi.");
	} else if(kuantitas == ""){
		alert("Satuan Produk Harus di isi.");
	} else if(harga == ""){
		alert("Harga Produk Harus di isi.");
	} else if(total == ""){
		alert("total Produk Harus di isi.");
	}else if(no_opb == ""){
	} else {
		$.ajax({
			url : '<?php echo base_url(); ?>laporan_order_c/simpan',
			data : {
				nama_produk:nama_produk,
				keterangan:keterangan,
				kuantitas:kuantitas,
				harga:harga,
				total:total,
				no_opb:no_opb,
			},
			type : "POST",
			dataType : "json",
		});
	}

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

function show_pop_po(no){
	$('#popup_koang').remove();
	get_popup_po();
    ajax_po(no);
}

function get_popup_po(){
    var base_url = '<?php echo base_url(); ?>';
    var $isi = '<div id="popup_koang">'+
                '<div class="window_koang">'+
                '    <a href="javascript:void(0);"><img src="'+base_url+'ico/cancel.gif" id="pojok_koang"></a>'+
                '    <div class="panel-body">'+
                '    <input style="width: 95%;" type="text" name="search_koang_pro" id="search_koang_pro" class="form-control" value="" placeholder="Cari No. PO...">'+
                '    <div class="table-responsive">'+
                '    <input type="hidden" name="id_purchase" id="id_purchase">'+
                '            <table class="table table-hover2" id="tes5">'+
                '                <thead>'+
                '                    <tr>'+
                '                        <th>Tanggal</th>'+
                '                        <th style="white-space:nowrap;"> No PO </th>'+
                '                        <th style="white-space:nowrap;"> Supplier </th>'+
                '                    </tr>'+
                '                </thead>'+
                '                <tbody>'+
            
                '                </tbody>'+
                '            </table>'+
                '        </div>'+
                '    </div>'+
                '</div>'+
            '</div>';
    $('body').append($isi);

    $('#pojok_koang').click(function(){
        $('#popup_koang').css('display','none');
        $('#popup_koang').hide();
    });

    $('#popup_koang').css('display','block');
    $('#popup_koang').show();
}

function ajax_po(id_form){
    var keyword = $('#search_koang_pro').val();
    $.ajax({
        url : '<?php echo base_url(); ?>laporan_penerimaan_c/get_po_popup',
        type : "POST",
        dataType : "json",
        data : {keyword : keyword},
        success : function(result){
            var isine = '';
            var no = 0;
            var tipe_data = "";
            $.each(result,function(i,res){
                no++;

                isine += '<tr onclick="get_po_detail(\'' +res.id_purchase+ '\',\'' +id_form+ '\');" style="cursor:pointer;">'+
                            '<td text-align="center">'+res.tanggal+'</td>'+
                            '<td text-align="center">'+res.no_po+'</td>'+
                            '<td text-align="left">'+res.supplier+'</td>'+
                        '</tr>';
            });

            if(result.length == 0){
            	isine = "<tr><td colspan='3' style='text-align:center'><b style='font-size: 15px;'> Data tidak tersedia </b></td></tr>";
            }

            $('#tes5 tbody').html(isine); 
            $('#search_koang_pro').off('keyup').keyup(function(){
                ajax_po(id_form);
            });
        }
    });
}

function get_po_detail(id, no_form)
{
	var id_purchase = id ; 

	$.ajax({
		url 	 : '<?php echo base_url(); ?>laporan_penerimaan_c/get_po_detail',
		data 	 : {id_purchase:id},
		type 	 : "GET",
		dataType : "json",

		success  : function(result){
			$('#id_produk_1').val(result.id_purchase);
			$('#diterima').val(result.supplier);
			$('#no_po').val(result.no_po);

			po_detail_produk(id);

			$('#search_koang_pro').val("");
		    $('#popup_koang').css('display','none');
		    $('#popup_koang').hide()
		} 
	});
}

function po_detail_produk(id)
{
	$.ajax({
		url : '<?php echo base_url(); ?>laporan_penerimaan_c/po_detail_produk',
		data : {id,id},
		type : "POST",
		dataType : "json",
		async : false,
		success : function(result){
			var isi = '';
			var no = 0;
			$('#jml_tr').val(result.length);
			$.each(result,function(i,res){
				no++;

			isi += '<tr id="tr_'+no+'">'+
						'<td align="center" style="vertical-align:middle;">'+
							'<div class="span12">'+
								'<div class="control-group">'+
									'<div class="controls">'+
										'<div class="input-append" style="width: 100%;">'+
											'<input readonly type="text" value="'+res.nama_produk+'" id="nama_produk_'+no+'" class="form-control" name="nama_produk[]" required style="background:#FFF; width: 60%; font-size: 13px; float: left;">'+
											'<button onclick="show_pop_produk('+no+');" type="button" class="btn" style="width: 30%;">Cari</button>'+
											'<input type="hidden" id="id_produk_'+no+'" name="produk[]" readonly style="background:#FFF;" value="'+res.id_produk+'">'+
										'</div>'+
									'</div>'+
								'</div>'+
							'</div>'+
						'</td>'+
						'<td align="center" style="vertical-align:middle;">'+
							'<div class="controls">'+
								'<input style="font-size: 10px; text-align:left;" type="text" class="form-control" value="'+res.keterangan+'" name="keterangan[]" id="keterangan_'+no+'">'+
							'</div>'+
						'</td>'+
						'<td align="center" style="vertical-align:middle;">'+
							'<div class="controls">'+
								'<input onkeyup="hitung_total(1);" style="font-size: 10px; text-align:left;" type="text" class="form-control" value="'+res.kuantitas+'" name="kuantitas[]" id="kuantitas_'+no+'">'+
							'</div>'+
						'</td>'+
						// '<td align="center" style="vertical-align:middle;">'+
						// 	'<div class="controls">'+
						// 		'<input style="font-size: 10px; text-align:left;" type="text" class="form-control" value="'+res.harga+'" name="harga[]" id="harga_'+no+'">'+
						// 	'</div>'+
						// '</td>'+
						'<td align="center" style="vertical-align:middle;">'+
							'<div class="controls">'+
								'<input style="font-size: 10px; text-align:left;" type="text" class="form-control" value="'+res.total+'" name="total[]" id="total_'+no+'">'+
							'</div>'+
						'</td>'+
						'<td align="center" style="vertical-align:middle;">'+
							'<div class="controls">'+
								'<input style="font-size: 10px; text-align:left;" type="text" class="form-control" value="'+res.no_po+'" name="no_opb[]" id="no_opb_'+no+'">'+
							'</div>'+
						'</td>'+
						'<td align="center" style="vertical-align:middle;">'+
							'<div class="controls">'+
								'<button style="width: 100%;" onclick="hapus_row_pertama();" type="button" class="btn btn-danger"> Hapus </button>'+
							'</div>'+
						'</td>'+
					'</tr>';
					});

				$('#data_item').html(isi);
				$('#jml_tr').val(result.length);
				}

			});
	hitung_total_semua();
}

function show_pop_produk(no){
	$('#popup_koang').remove();
	get_popup_produk();
    ajax_produk(no);
}

function get_popup_produk(){
    var base_url = '<?php echo base_url(); ?>';
    var $isi = '<div id="popup_koang">'+
                '<div class="window_koang">'+
                '    <a href="javascript:void(0);"><img src="'+base_url+'ico/cancel.gif" id="pojok_koang"></a>'+
                '    <div class="panel-body">'+
                '    <input style="width: 95%;" type="text" name="search_koang_pro" id="search_koang_pro" class="form-control" value="" placeholder="Cari Produk...">'+
                '    <div class="table-responsive">'+
                '            <table class="table table-hover2" id="tes5">'+
                '                <thead>'+
                '                    <tr>'+
                '                        <th>No</th>'+
                '                        <th style="white-space:nowrap;"> Nama Produk </th>'+
                '                        <th style="white-space:nowrap;"> Harga </th>'+
                '                    </tr>'+
                '                </thead>'+
                '                <tbody>'+
            
                '                </tbody>'+
                '            </table>'+
                '        </div>'+
                '    </div>'+
                '</div>'+
            '</div>';
    $('body').append($isi);

    $('#pojok_koang').click(function(){
        $('#popup_koang').css('display','none');
        $('#popup_koang').hide();
    });

    $('#popup_koang').css('display','block');
    $('#popup_koang').show();
}

function ajax_produk(id_form){
    var keyword = $('#search_koang_pro').val();
    $.ajax({
        url : '<?php echo base_url(); ?>laporan_penerimaan_c/get_produk_popup',
        type : "POST",
        dataType : "json",
        data : {
            keyword : keyword,
        },
        success : function(result){
            var isine = '';
            var no = 0;
            var tipe_data = "";
            $.each(result,function(i,res){
                no++;

                isine += '<tr onclick="get_produk_detail(\'' +res.id_barang+ '\',\'' +id_form+ '\');" style="cursor:pointer;">'+
                            '<td text-align="center">'+no+'</td>'+
                            '<td text-align="left">'+res.nama_barang+'</td>'+
                            '<td text-align="left">'+res.harga_beli+'</td>'+
                            
                        '</tr>';
            });

            if(result.length == 0){
            	isine = "<tr><td colspan='4' style='text-align:center'><b style='font-size: 15px;'> Data tidak tersedia </b></td></tr>";
            }

            $('#tes5 tbody').html(isine); 
            $('#search_koang_pro').off('keyup').keyup(function(){
                ajax_produk(id_form);
            });
        }
    });
}

function get_produk_detail(id, no_form){

	var id_barang = id;
    $.ajax({
		url : '<?php echo base_url(); ?>laporan_penerimaan_c/get_produk_detail',
		data : {id_barang:id},
		type : "GET",
		dataType : "json",
		success : function(result){
			$('#id_produk_'+no_form).val(result.id_barang);
			$('#nama_produk_'+no_form).val(result.nama_barang);
			$('#Kuantitas_'+no_form).focus();
			$('#harga_'+no_form).val(NumberToMoney(result.harga_beli).split('.00').join(''));
			$('#total_'+no_form).val(NumberToMoney(result.harga_beli*1).split('.00').join(''));

			$('#search_koang_pro').val("");
		    $('#popup_koang').css('display','none');
		    $('#popup_koang').hide()
		}
	});
}

function hitung_total(id){

	var kuantitas = $('#kuantitas_'+id).val();
	kuantitas = kuantitas.split(',').join('');

	if(kuantitas == ""){
		kuantitas = 0;
	}

	var harga = $('#harga_awal_'+id).val();
	harga = harga.split(',').join('');

	if(harga == "" || harga== null){
		harga = 0;
	}

	var total = parseFloat(kuantitas) * parseFloat(harga);

	$('#total_'+id).val(acc_format(total, "").split('.00').join('') );

	hitung_total_semua();
}

function hitung_total_semua(){
	var sum = 0;
	var pajak_prosen = 0
	$("input[name='total[]']").each(function(idx, elm) {
		var tot = elm.value.split(',').join('');
		if(tot > 0){
    		sum += parseFloat(tot);
		}
    });

    $('#subtotal_txt').html('Rp. '+acc_format(sum, ""));
}

function acc_format(n, currency) {
	return currency + " " + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
}

function add_row(id_peminjaman_detail,nama,sisa,no_po,harga,id_produk,penerimaan){
	var jml_tr = $('#jml_tr').val();
	var i = parseFloat(jml_tr) + 1;

	var isi = 	'<tr id="tr_'+i+'">'+
					
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input style="font-size: 10px; text-align:center;" type="text" class="form-control" value="'+no_po+'" name="no_po[]" id="no_op_'+i+'">'+
							'<input style="font-size: 10px; text-align:center;" type="hidden" class="form-control" value="'+id_produk+'" name="id_produk[]" id="no_op_'+i+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input style="font-size: 10px; text-align:left;" type="text" class="form-control" value="'+nama+'" name="nama_produk[]" id="keterangan_'+i+'">'+
							'<input type="hidden" id="id_produk_'+i+'" value="'+id_peminjaman_detail+'" name="id_peminjaman_detail[]" readonly style="background:#FFF;" value="0">'+
						'</div>'+
					'</td>'+
					
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input style="font-size: 10px; text-align:center;" type="text" class="form-control" value="'+penerimaan+'" name="sisa[]" id="sisa_'+i+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input style="font-size: 10px; text-align:center;" type="text" class="form-control" value="'+sisa+'" name="penerimaan[]" id="penerimaan_'+i+'">'+
						'</div>'+
					'</td>'+
					// '<td align="center" style="vertical-align:middle;">'+
					// 	'<div class="controls">'+
					// 		'<input style="font-size: 10px; text-align:center;" type="text" class="form-control" value="'+harga+'" name="harga_awal[]" id="harga_awal_'+i+'">'+
					// 	'</div>'+
					// '</td>'+

					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input style="font-size: 10px; text-align:center;" onkeyup="hitung_total('+i+'),FormatCurrency(this);" onchange="ewek(this.value,'+i+');" type="text" class="form-control" value="" name="kuantitas[]" id="kuantitas_'+i+'">'+
						'</div>'+
					'</td>'+
					// '<td align="center" style="vertical-align:middle;">'+
					// 	'<div class="controls">'+
					// 		'<input style="font-size: 10px; text-align:center;" type="text" class="form-control" value="" name="total[]" id="total_'+i+'">'+
					// 	'</div>'+
					// '</td>'+
					
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<button style="width: 100%;" onclick="hapus_row('+i+','+id_peminjaman_detail+');" type="button" class="btn btn-danger"> Hapus </button>'+
						'</div>'+
					'</td>'+
				'</tr>';



	$('#data_item').append(isi);
	$('#tr_al_'+id_peminjaman_detail).hide();
	$('#jml_tr').val(i);

}

function hapus_row(id,id_peminjaman_detail){
	$('#tr_'+id).remove();
	$('#tr_al_'+id_peminjaman_detail).show();
}

function ewek(jml,id){
	var qty           = $('#penerimaan_'+id).val();

	var besar_lah	= parseInt(qty);
	var isi_lah		= parseInt(jml);

	if(isi_lah > besar_lah){
		alert('Kuantitas yang anda masukkan kelebihan');
		$('#kuantitas_'+id).val(besar_lah);
	}
}

function get_transaction(id) {
	

        $.ajax({
            url : '<?php echo base_url(); ?>laporan_penerimaan_c/get_transaction_info',
            data : {id:id},
            type : "POST",
            dataType : "json",
            success : function(result){   
                var isine = "";
                if(result.length > 0){
                    $.each(result,function(i,res){
                    	var sisa = res.kuantitas - res.penerimaan;
                        isine += '<tr id="tr_al_'+res.id_peminjaman_detail+'">'+
                                    '<td style="text-align:center;">'+res.no_po+'</td>'+
                                    '<td style="text-align:center;">'+res.supplier+'</td>'+
                                    '<td style="text-align:center;">'+res.nama_produk+'</td>'+
                                    '<td style="text-align:center;">'+res.kuantitas+'</td>'+
                                    '<td style="text-align:center;">'+res.penerimaan+'</td>'+
                                    
                                    '<td>'+
                                    	'<button style="width: 100%;" onclick="add_row(&quot;'+res.id_peminjaman_detail+'&quot;,&quot;'+res.nama_produk+'&quot;,&quot;'+sisa+'&quot;,&quot;'+res.no_po+'&quot;,&quot;'+res.harga+'&quot;,&quot;'+res.id_produk+'&quot;,&quot;'+res.kuantitas+'&quot;);" type="button" class="btn btn-success"> Tambah </button>'+
                                    '</td>'+
                                '</tr>';
                    });
                } else {
                    isine = "<tr><td colspan='6' style='text-align:center;'> There are no transaction for this data </td></tr>";
                }

                $('#data_transaction').html(isine);
            }
        });
    }

function get_transaction_departemen_search(nama) {
	var dept 		= $('#dept').val();

        $.ajax({
            url : '<?php echo base_url(); ?>laporan_penerimaan_c/get_transaction_info_search',
            data : {nama:nama,dept:dept},
            type : "POST",
            dataType : "json",
            success : function(result){   
                var isine = "";
                if(result.length > 0){
                    $.each(result,function(i,res){
                    	var sisa = res.kuantitas - res.penerimaan;
                        isine += '<tr id="tr_al_'+res.id_peminjaman_detail+'">'+
                                    '<td style="text-align:center;">'+res.no_po+'</td>'+
                                    '<td style="text-align:center;">'+res.supplier+'</td>'+
                                    '<td style="text-align:center;">'+res.nama_produk+'</td>'+
                                    '<td style="text-align:center;">'+res.kuantitas+'</td>'+
                                    '<td style="text-align:center;">'+res.penerimaan+'</td>'+
                                    
                                    '<td>'+
                                    	'<button style="width: 100%;" onclick="add_row(&quot;'+res.id_peminjaman_detail+'&quot;,&quot;'+res.nama_produk+'&quot;,&quot;'+sisa+'&quot;,&quot;'+res.no_po+'&quot;,&quot;'+res.harga+'&quot;,&quot;'+res.id_produk+'&quot;,&quot;'+res.kuantitas+'&quot;);" type="button" class="btn btn-success"> Tambah </button>'+
                                    '</td>'+
                                '</tr>';
                    });
                } else {
                    isine = "<tr><td colspan='6' style='text-align:center;'> There are no transaction for this data </td></tr>";
                }

                $('#data_transaction').html(isine);
            }
        });
    }

</script>

<style type="text/css">

#data_item tr td input{
	font-size: 15px !important;
}

</style>

<form role="form" action="<?php echo $url_simpan; ?>" method="post">
<input type="hidden" id="jml_tr" value="1">
<input type="hidden" id="id_laporan" name="id_laporan">

<div class="row" id="form_laporan" style="display:none; ">
	<div class="col-md-12 col-sm-6">
		<!-- BEGIN PORTLET-->
		<div class="portlet light ">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-bar-chart font-green-sharp hide"></i>
					<span class="caption-subject font-green-sharp bold uppercase">Form Laporan</span>
				</div>
				<div class="actions">
					<div class="btn-group btn-group-devided" data-toggle="buttons">
					</div>
				</div>
			</div>

			<div class="portlet-body">	
				<div class="row" style="padding-top: 15px; padding-bottom: 15px;">
					<div class="col-md-12">
						
						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Tanggal</label>
							<div class="col-md-4">
								<div class="input-group date" data-date-format="dd-mm-yyyy">
									<input type="text" class="form-control" value="<?=date('d-m-Y');?>" name="tanggal" id="tanggal" readonly>
									<span class="input-group-btn">
									<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
									</span>
									<div class="form-control-focus">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Departemen</label>
							<div class="col-md-4">
								<select name="dept" id="dept" class="form-control" onchange="get_transaction(this.value);">
									<option>Pilih Departemen ......</option>
									<?php 
										foreach ($dt_dept as $key => $dt_value) {
											?>
											<option value="<?=$dt_value->id_divisi;?>"><?=$dt_value->nama_divisi;?></option>
											<?php
										}
									?>
								</select>
								
							</div>
							<!-- <div class="col-md-2">
								<select name="filt" class="form-control" onchange="get_transaction(this.value);">
									<option value="<?php echo date('m'); ?>">Bulan Ini</option>
									<option value="<?php echo date('Y'); ?>">Tahun Ini</option>
									<option value="Pencarian">Pencarian</option>
									
								</select>
							</div> -->
							<!-- <div class="col-md-2">
								<input type="text" id="nama_filt" name="" class="form-control">
							</div> -->
						</div>
						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Diterima Dari</label>
							<div class="col-md-4">
								<select name="supplier" class="form-control input-large select2me input-sm" onchange="get_supplier(this.value);">
									<option>Pilih Supplier ......</option>
									<?php 
										$dt_supp = $this->db->query("SELECT * FROM master_supplier")->result();
										foreach ($dt_supp as $key => $dt_value) {
											?>
											<option value="<?=$dt_value->id_supplier;?>"><?=$dt_value->nama_supplier;?></option>
											<?php
										}
									?>
								</select>
								<div class="form-control-focus">
								</div>
							</div>
						</div>

						<div class="form-group form-md-line-input">
							<label class="col-md-2 control-label" for="form_control_1">Surat Jalan</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="surat_jalan" name="surat_jalan" >
								<div class="form-control-focus">
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<div class="col-md-4">
							<label class="control-label"><b style="font-size:14px;">Pencarian PO</b></label>
							<div class="input-group" style="width: 100%;">
								<input type="text" class="form-control" name="pencarian" id="pencarian" onkeyup="get_transaction_departemen_search(this.value);">
								
							</div>
						</div>
					</div>
				</div>

				<div class="row" style="padding-top: 15px; padding-bottom: 15px; margin-left:18px; margin-right:18px;overflow-y: scroll;height: 350px;">
					<div class="portlet-body flip-scroll">
						<table class="table table-bordered table-striped table-condensed flip-content">
							<thead class="flip-content">
								<tr>
									<th style="text-align: center; ">No PO</th>
									<th style="text-align: center; ">Supplier</th>
									<th style="text-align: center;  width: 30%;">Nama Barang</th>
									<th style="text-align: center; ">Kuantitas</th>
									<th style="text-align: center; ">Penerimaan</th>
									<th style="text-align: center; ">Aksi</th>
								</tr>
							</thead>
							<tbody id="data_transaction">
								<tr>
									<td align="center" style="vertical-align:middle;">
										
									</td>
									<td align="center" style="vertical-align:middle;">
										
									</td>
									<td align="center" style="vertical-align:middle;">
										
									</td>
									<td align="center" style="vertical-align:middle;">
										
									</td>
									<td align="center" style="vertical-align:middle;">
										
									</td>
									<td align="center" style="vertical-align:middle;">
										
									</td>
								</tr>
							</tbody>
						</table>

						
					</div>
				</div>
			</div>

			<div class="row" style="padding-top: 15px; padding-bottom: 15px; margin-left:18px; margin-right:18px;">
				<div class="portlet-body flip-scroll">
					<table class="table table-bordered table-striped table-condensed flip-content">
						<thead class="flip-content">
							<tr>
								<th style="text-align: center; width: 20%;">NO PO</th>
								<th style="text-align: center; widows: 30%;">Nama</th>
								<th style="text-align: center;">Kuantitas</th>
								<th style="text-align: center;">Sisa</th>
								<th style="text-align: center;">Qty Penerimaan</th>
								<th style="text-align: center;">Aksi</th>
							</tr>
						</thead>
						<tbody id="data_item">
							<tr id="tr_1">
								
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row" id="tabel_total" style="display:none; ">
	<div class="col-md-12 col-sm-6">
		<!-- BEGIN PORTLET-->
		<div class="portlet light ">
			<div class="portlet-body">
				<div class="row" style="padding-top: 15px;">
					<div class="col-md-12">
						<!-- <div class="col-md-3">
							<div style="margin-bottom: 15px;" class="span3">
								<h4 class="control-label"> Sub Total :</h4> 
							</div>
						</div>

						<div class="col-md-3">
							<div style="margin-bottom: 15px;" class="span4">
								<h4 id="subtotal_txt" class="control-label"> Rp. 0.00 </h4> 
							</div>
						</div> -->
					</div>
				</div>

				<div class="row" style="padding-top: 35px; padding-bottom: 15px;">
					<div class="col-md-12">
						<div class="col-md-offset-2 col-md-10">
							<button type="submit" class="btn blue">Simpan</button>
							<button type="button" id="batal" class="btn red" onclick="window.location = '<?php echo base_url(); ?>laporan_penerimaan_c'">Batal Dan Kembali</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END PORTLET-->
	</div>
</div>
</form>

<div class="row">
	
	<div class="col-md-3 cui" >
		<select class="form-control">
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
	<div class="col-md-3 cui" >
		<select class="form-control">
			<option value="2016">2016</option>
			<option value="2017">2017</option>
			<option value="2018">2018</option>
		</select>
	</div>
	<div class="col-md-4 cui" >
		<a href=""><button id="tambah_permintaan_barang" class="btn green">
			Cari <i class="fa fa-search"></i>
			</button>
		</a>
	</div>

	<div class="col-md-2">
		<button id="tambah_laporan" class="btn green" style="float: right;">
		Tambah laporan Penerimaan <i class="fa fa-plus"></i>
		</button>
	</div>
</div>


</br>
</br>

<div class="row" id="table_laporan" style="display:block; ">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-edit"></i>Table laporan Penerimaan
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
					<th style="text-align:center;"> No LPB</th>
					<th style="text-align:center;"> Tanggal</th>
					<th style="text-align:center;"> Aksi </th>
				</tr>
				</thead>
				<tbody>
					<?php 
					$no = 0 ;
					foreach ($lihat_data as $value) {
						$no++;
					if($value->status == '1'){
				?>
				<tr style="background-color: #cccbce;">
				<?php	
				}else{
				?>
				<tr>
					<?php  } ?>
					<td style="text-align:center; vertical-align:"><?php echo $no; ?></td>
					<td style="text-align:center; vertical-align:"><?php echo $value->no_lpb; ?></td>
					<td style="text-align:center; vertical-align:"><?php echo $value->tanggal; ?></td>
					<td style="text-align:center; vertical-align: middle;">
						<!-- <a class="btn default btn-xs purple" id="ubah" onclick="ubah_data_laporan(<?php echo $value->id_laporan?>);"><i class="fa fa-edit"></i> Ubah </a> -->
						<a class="btn default btn-xs red" id="hapus" onclick="hapus_laporan(<?php echo $value->id_laporan?>);"><i class="fa fa-trash-o"></i> Batal </a>
						<a target="_blank" class="btn default btn-xs green" id="hapus" href="<?=base_url();?>laporan_penerimaan_c/cetak/<?=$value->id_laporan;?>" ><i class="fa fa-print"></i> Cetak </a>
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