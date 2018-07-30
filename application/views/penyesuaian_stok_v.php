<script src="<?php echo base_url(); ?>js/jquery-1.11.1.min.js" type="text/javascript"></script>

<div class="row" id="form_pelanggan">
	<div class="col-md-12">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-green-haze">
					<i class="icon-settings font-green-haze"></i>
					<span class="caption-subject bold uppercase"> Penyesuaian Stok </span>
				</div>
			</div>
			<div class="portlet-body form">
				<form role="form" class="form-horizontal" method="post" action="<?php echo $url_simpan; ?>" onsubmit="return cek_balance();">
					<div class="form-body">
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-4 control-label" for="form_control_1">Kode Barang</label>
								<div class="col-md-8">
									<select  class="form-control input-large select2me input-sm" id="id_barang" name="id_barang" data-placeholder="Select..." required onchange="get_barang_detail();">
										<option value=""></option>
										<?php 
											foreach ($lihat_data_barang as $value){
										?>
											<option value="<?php echo $value->id_barang; ?>"><?php echo $value->kode_barang; ?> - <?php echo $value->nama_barang; ?></option>
										<?php	
											}
										?>
									</select>	
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label" for="form_control_1">Nama Barang</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="nama_barang" name="nama_barang" readonly="">
									<div class="form-control-focus">
									</div>
								</div>
							</div>

							<hr>

							<div class="form-group">
								<label class="col-md-4 control-label" for="form_control_1">Jumlah Perubahan</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="qty_opname" name="qty_opname">
									<div class="form-control-focus">
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label" for="form_control_1">Harga</label>
								<div class="col-md-8">
									<input type="text" class="form-control" id="harga_opname" name="harga_opname">
									<div class="form-control-focus">
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label" for="form_control_1">Keterangan</label>
								<div class="col-md-8">
									<textarea class="form-control" id="ket_opname" name="ket_opname"></textarea>
								</div>
							</div>
						</div>
						
						<hr>

						<!-- POSTING -->
						<div class="table-scrollable">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr style="background: #333; color: #FFF;">
                                    <th style="text-align: center; width: 20%;"> Kode Perkiraan </th>
                                    <th style="text-align: center;"> Debet </th>
                                    <th style="text-align: center;"> Kredit </th>
                                    <th style="text-align: center;"> Keterangan </th>
                                    <th style="text-align: center;">  </th>
                                </tr>
                            </thead>
                            <tbody id="dataAkun">
                                <tr id="tr_1">
                                    <td>
                                    	<select  class="form-control input-large select2me input-sm" name="kode_akun[]" id="kode_akun_1" data-placeholder="Pilih Kode Perkiraan..." required>
												<option value=""></option>
												<?php 
													foreach ($lihat_data_akun as $value){
												?>
													<option value="<?php echo $value->KODE_AKUN; ?>"><?php echo $value->KODE_AKUN; ?> - <?php echo $value->NAMA_AKUN; ?></option>
												<?php	
													}
												?>
											</select>	
                                    </td>
                                    <td>
                                    	<div class="controls">
											<input style="text-align:right;" type="text" class="form-control" value="" name="debet[]" id="debet_1" onkeyup="FormatCurrency(this); hitung_debkre();">
										</div>
                                    </td>
                                    <td>
                                    	<div class="controls">
											<input style="text-align:right;" type="text" class="form-control" value="" name="kredit[]" id="kredit_1" onkeyup="FormatCurrency(this); hitung_debkre();">
										</div>
                                    </td>
                                    <td>
                                    	<div class="controls">
											<input style="text-align:left;" type="text" class="form-control" value="" name="keterangan[]" id="keterangan_1">
										</div>
                                    </td>
                                    <td>
                                    
                                    </td>
                                </tr>
                                <tr id="tr_2">
                                    <td>
                                    	<select  class="form-control input-large select2me input-sm" name="kode_akun[]" id="kode_akun_2" data-placeholder="Pilih Kode Perkiraan..." required>
												<option value=""></option>
												<?php 
													foreach ($lihat_data_akun as $value){
												?>
													<option value="<?php echo $value->KODE_AKUN; ?>"><?php echo $value->KODE_AKUN; ?> - <?php echo $value->NAMA_AKUN; ?></option>
												<?php	
													}
												?>
											</select>	
                                    </td>
                                    <td>
                                    	<div class="controls">
											<input style="text-align:right;" type="text" class="form-control" value="" name="debet[]" id="debet_2" onkeyup="FormatCurrency(this); hitung_debkre();">
										</div>
                                    </td>
                                    <td>
                                    	<div class="controls">
											<input style="text-align:right;" type="text" class="form-control" value="" name="kredit[]" id="kredit_2" onkeyup="FormatCurrency(this); hitung_debkre();">
										</div>
                                    </td>
                                    <td>
                                    	<div class="controls">
											<input style="text-align:left;" type="text" class="form-control" value="" name="keterangan[]" id="keterangan_2">
										</div>
                                    </td>
                                    <td>
                                    
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                            	<tr>
                            		<td style="text-align: center;"><b>TOTAL</b></td>
                            		<td style="text-align: right;"><b id="total_debet_txt">0</b></td>
                            		<td style="text-align: right;"><b id="total_kredit_txt">0</b></td>
                            		<td style="text-align: right;" colspan="2"><b></b></td>
                            		<input type="hidden" id="total_debet_val">
                            		<input type="hidden" id="total_kredit_val">
                            	</tr>
                            </tfoot>
                        </table>                        
                    </div>

                    <button type="button" class="btn btn-primary" onclick="add_row();"><i class="icon-plus"></i> Tambah Baris</button>
					</div>
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-2 col-md-10">
								<button type="submit" class="btn blue">Simpan</button>
								<a href="<?=base_url();?>penyesuaian_stok_c" class="btn red">Batal</a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- END SAMPLE FORM PORTLET-->
	</div>
</div>
<input type="hidden" name="total_row" id="total_row" value="2">
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
	
	function cek_balance(){
		var d = $('#total_debet_val').val();
		var k = $('#total_kredit_val').val();

		var a = false;
		if(parseFloat(d) != parseFloat(k)){
			alert("Debet dan Kredit tidak balance !!");
			a = false;
		} else {
			a = true;
		}

		return a;
	}

	function get_barang_detail(){
		var id = $('#id_barang').val();
		$.ajax({
			url : '<?php echo base_url(); ?>penyesuaian_stok_c/barang_id',
			data : {id:id},
			type : "POST",
			dataType : "json",
			async : false,
			success : function(res){
				$('#nama_barang').val(res.nama_barang);
				$('#qty_opname').val(res.stok);
				$('#harga_opname').val(NumberToMoney(res.harga_jual));
			}
		});
	}

	function getTerbilang(e){

		e = e.split(',').join('');

	    var bilangan = e; 
	    var kalimat="";
	    var angka   = new Array('0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');
	    var kata    = new Array('','Satu','Dua','Tiga','Empat','Lima','Enam','Tujuh','Delapan','Sembilan');
	    var tingkat = new Array('','Ribu','Juta','Milyar','Triliun');
	    var panjang_bilangan = bilangan.length;
	     
	    /* pengujian panjang bilangan */
	    if(panjang_bilangan > 15){
	        kalimat = "Diluar Batas";
	    }else{
	        /* mengambil angka-angka yang ada dalam bilangan, dimasukkan ke dalam array */
	        for(i = 1; i <= panjang_bilangan; i++) {
	            angka[i] = bilangan.substr(-(i),1);
	        }
	         
	        var i = 1;
	        var j = 0;
	         
	        /* mulai proses iterasi terhadap array angka */
	        while(i <= panjang_bilangan){
	            subkalimat = "";
	            kata1 = "";
	            kata2 = "";
	            kata3 = "";
	             
	            /* untuk Ratusan */
	            if(angka[i+2] != "0"){
	                if(angka[i+2] == "1"){
	                    kata1 = "Seratus";
	                }else{
	                    kata1 = kata[angka[i+2]] + " Ratus";
	                }
	            }
	             
	            /* untuk Puluhan atau Belasan */
	            if(angka[i+1] != "0"){
	                if(angka[i+1] == "1"){
	                    if(angka[i] == "0"){
	                        kata2 = "Sepuluh";
	                    }else if(angka[i] == "1"){
	                        kata2 = "Sebelas";
	                    }else{
	                        kata2 = kata[angka[i]] + " Belas";
	                    }
	                }else{
	                    kata2 = kata[angka[i+1]] + " Puluh";
	                }
	            }
	             
	            /* untuk Satuan */
	            if (angka[i] != "0"){
	                if (angka[i+1] != "1"){
	                    kata3 = kata[angka[i]];
	                }
	            }
	             
	            /* pengujian angka apakah tidak nol semua, lalu ditambahkan tingkat */
	            if ((angka[i] != "0") || (angka[i+1] != "0") || (angka[i+2] != "0")){
	                subkalimat = kata1+" "+kata2+" "+kata3+" "+tingkat[j]+" ";
	            }
	             
	            /* gabungkan variabe sub kalimat (untuk Satu blok 3 angka) ke variabel kalimat */
	            kalimat = subkalimat + kalimat;
	            i = i + 3;
	            j = j + 1;
	        }
	         
	        /* mengganti Satu Ribu jadi Seribu jika diperlukan */
	        if ((angka[5] == "0") && (angka[6] == "0")){
	            kalimat = kalimat.replace("Satu Ribu","Seribu");
	        }
	    }
	    document.getElementById("terbilang").innerHTML=kalimat;
	}

	function add_row(){
		var jml = $('#total_row').val();
		var i = parseFloat(jml) + 1;

		var isi =   '<tr id="tr_'+i+'">'+
	                    '<td>'+
	                    	'<select  class="form-control input-large select2me input-sm" name="kode_akun[]" id="kode_akun_'+i+'" data-placeholder="Pilih Kode Perkiraan..." required>'+
								'<option value=""></option>'+
								<?php 
									foreach ($lihat_data_akun as $value){
								?>
									'<option value="<?php echo $value->KODE_AKUN; ?>"><?php echo $value->KODE_AKUN; ?> - <?php echo $value->NAMA_AKUN; ?></option>'+
								<?php	
									}
								?>
							'</select>'+
	                    '</td>'+
	                    '<td>'+
	                    	'<div class="controls">'+
								'<input style="text-align:right;" type="text" class="form-control" value="" name="debet[]" id="debet_'+i+'" onkeyup="FormatCurrency(this); hitung_debkre();">'+
							'</div>'+
	                    '</td>'+
	                    '<td>'+
	                    	'<div class="controls">'+
								'<input style="text-align:right;" type="text" class="form-control" value="" name="kredit[]" id="kredit_'+i+'" onkeyup="FormatCurrency(this); hitung_debkre();">'+
							'</div>'+
	                    '</td>'+
	                    '<td>'+
	                    	'<div class="controls">'+
								'<input style="text-align:left;" type="text" class="form-control" value="" name="keterangan[]" id="keterangan_'+i+'">'+
							'</div>'+
	                    '</td>'+
	                    '<td style="text-align:center;">'+
	                    	'<button class="btn btn-danger" type="button" onclick="hapus_opename_akuntansi('+i+');">Hapus</button>'+
	                    '</td>'+
	                '</tr>';


		$('#dataAkun').append(isi);
		$('#kode_akun_'+i).select2();
		$('#total_row').val(i);
	}

	function hapus_opename_akuntansi(id){
		$('#tr_'+id).remove();
	}

	function hitung_debkre(){
		var tot_deb = 0;
		$("input[name='debet[]']").each(function(idx, elm) {
			if(elm.value == ""){
				var tot = 0;
			} else {
				var tot = elm.value.split(',').join('');
			}

			if(tot > 0){
	    		tot_deb += parseFloat(tot);
			}
	    });

	    var tot_kre = 0;
	    $("input[name='kredit[]']").each(function(idx, elm) {
			if(elm.value == ""){
				var tot2 = 0;
			} else {
				var tot2 = elm.value.split(',').join('');
			}
			
			if(tot2 > 0){
	    		tot_kre += parseFloat(tot2);
			}
	    });

	    $('#total_debet_txt').html(NumberToMoney(tot_deb).split('.00').join(''));
	    $('#total_kredit_txt').html(NumberToMoney(tot_kre).split('.00').join(''));

	    $('#total_debet_val').html(tot_kre);
	    $('#total_kredit_val').html(tot_kre);

	    $('#total_all').val(tot_deb);

	}
</script>