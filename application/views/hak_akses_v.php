<script src="<?php echo base_url(); ?>js/jquery-1.11.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
	<?php if($this->session->flashdata('simpan')){ ?>
	berhasil();
	<?php } ?>

	$('#btn_kembali').click(function(){
		window.location = "<?php echo base_url(); ?>manajemen_user_c";
	});
});	

function centang_semua(id_lev1){
	var cek = $(".cek_lev1_"+id_lev1).is(":checked");
	// alert(cek);
	if(cek == true){
		$('.cek_'+id_lev1).prop('checked','checked');
	}else{
		$('.cek_'+id_lev1).removeAttr('checked');
	}
}

function centang_semua_m2(id_lev1,id_lev2){
	var cek = $(".cek_lev2_"+id_lev1+"_"+id_lev2).is(":checked");
	// alert(cek);
	if(cek == true){
		$('.cek_'+id_lev1+"_"+id_lev2).prop('checked','checked');
	}else{
		$('.cek_'+id_lev1+"_"+id_lev2).removeAttr('checked');
	}
}
</script>

<div class="row">
	<div class="col-md-12">
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-user"></i>User
				</div>
			</div>
			<div class="portlet-body">
				<form class="form-horizontal">
				<?php
					$peg = $this->model->get_user_id($id_user);
				?>
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-2 control-label">Nama Lengkap</label>
							<div class="col-md-6">
								<input type="text" class="form-control" id="nama_lengkap_ha" value="<?php echo $peg->nama_user; ?>" readonly>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Username</label>
							<div class="col-md-6">
								<input type="text" class="form-control" id="username_ha" value="<?php echo $peg->username; ?>" readonly>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cog"></i>Hak Akses
				</div>
			</div>
			<div class="portlet-body">
				<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>manajemen_user_c/simpan">
					<ul class="nav nav-tabs coba">
	                    <?PHP 
	                    $no_1 = 0;
	                    foreach ($get_menu_1 as $key => $menu_1) { 
	                        $no_1++;
	                    ?>
	                        <li role="presentation" class="<?PHP if($no_1 == 1){ echo "active"; }?>">
	                            <a style="background:#f4f8fb;" href="#data_menu<?=$menu_1->ID;?>" role="tab" data-toggle="tab"> <?=$menu_1->NAMA;?> </a>
	                        </li>
	                    <?PHP } ?>
	                </ul>
	                <div class="tab-content">
	                    <?PHP 
	                        $no = 0;
	                        $check_1 = "";
	                        foreach ($get_menu_1 as $key => $menu_1) { 
	                            if($menu_1->STS == 0){
	                                $check_1 = "";
	                            } else {
	                                $check_1 = "checked"; 
	                            }

	                            $no++;
	                    ?>
                        <div role="tabpanel" class="tab-pane fade <?PHP if($no == 1){ echo "in active"; }?>" id="data_menu<?=$menu_1->ID;?>">
                            <div class="row">
                                <div class="col-md-12">
                                	<div class="md-checkbox-list">
										<div class="md-checkbox has-error">
											<input type="checkbox" id="ck_portal_<?=$menu_1->ID;?>" class="md-check cek_lev1_<?=$menu_1->ID;?>" name="menu_portal[]" value="<?=$menu_1->ID;?>" onclick="centang_semua(<?=$menu_1->ID;?>);" <?=$check_1;?>>
											<label for="ck_portal_<?=$menu_1->ID;?>">
												<span></span>
												<span class="check"></span>
												<span class="box"></span>
												<b> Menu Portal <?=strtoupper($menu_1->NAMA);?> </b>
											</label>
										</div>
									</div>
                                    <ul style="list-style: none;">
                                    <?PHP 
                                    $get_menu_2 = $this->model->get_data_menu_2($menu_1->ID, $id_pegawai);
                                    $check_2 = "";
                                    $check_2_cus = "";
                                    foreach ($get_menu_2 as $key => $menu_2) {
                                        if($menu_2->STS == 0){
                                            $check_2 = "";
                                            $check_2_cus = "custom-unchecked";
                                        } else {
                                            $check_2 = "checked";
                                            $check_2_cus = "custom-checked";
                                        }
                                    ?>
                                    <div class="col-lg-3" style="margin-top: 35px;">
                                        <?PHP if($menu_2->LINK != "" || $menu_2->LINK != null){ ?>
                                            <li>
                                            	<div class="md-checkbox-list">
													<div class="md-checkbox">
														<input type="checkbox" id="<?=$menu_2->NAMA;?>" class="md-check <?=$check_2_cus;?> cek_<?=$menu_1->ID;?>" name="ch_menu2[]" value="<?=$menu_2->ID;?>" <?=$check_2;?>>
														<label for="<?=$menu_2->NAMA;?>">
															<span></span>
															<span class="check"></span>
															<span class="box"></span>
															<b> <?=$menu_2->NAMA;?> </b>
														</label>
													</div>
												</div>
                                            </li>
                                        <?PHP } else { ?>
                                            <li>
                                                <div class="md-checkbox-list">
													<div class="md-checkbox">
														<input type="checkbox" id="<?=$menu_2->NAMA;?>" class="md-check <?=$check_2_cus;?> cek_lev2_<?=$menu_1->ID;?>_<?=$menu_2->ID;?>" name="ch_menu2[]" value="<?=$menu_2->ID;?>" onclick="centang_semua_m2(<?=$menu_1->ID;?>,<?=$menu_2->ID;?>);" <?=$check_2;?>>
														<label for="<?=$menu_2->NAMA;?>">
															<span></span>
															<span class="check"></span>
															<span class="box"></span>
															<b> <?=$menu_2->NAMA;?> </b>
														</label>
													</div>
												</div>
                                                
                                                <ul style="list-style: none;">
                                                    <?PHP 
                                                        $check_3 = "";
                                                        $check_3_cus = "";
                                                        $get_menu_3 = $this->model->get_data_menu_3($menu_2->ID, $id_pegawai);
                                                        foreach ($get_menu_3 as $key => $menu_3) {
                                                            if($menu_3->STS == 0){
                                                                $check_3 = "";
                                                                $check_3_cus = "custom-unchecked";
                                                            } else {
                                                                $check_3 = "checked";
                                                                $check_3_cus = "custom-checked";
                                                            }
                                                    ?>
                                                    <li>
                                                    	<div class="md-checkbox-list">
															<div class="md-checkbox">
																<input type="checkbox" id="menu3-<?=$menu_3->ID;?>" class="md-check cek_<?=$menu_1->ID;?>_<?=$menu_2->ID;?>" name="ch_menu3[]" value="<?=$menu_3->ID;?>" <?=$check_3;?>>
																<label for="menu3-<?=$menu_3->ID;?>" class="<?=$check_3_cus;?>">
																	<span></span>
																	<span class="check"></span>
																	<span class="box"></span>
																	<b> <?=$menu_3->NAMA;?> </b>
																</label>
															</div>
														</div>
                                                    </li>
                                                    <?PHP } ?>
                                                </ul>
                                            </li>
                                        <?PHP } ?>
                                    </div>
                                    <?PHP } ?>                                            
                                    </ul>
                                </div>
                            </div>
                        </div>
	                    <?PHP } ?>
	                </div>
	                <hr>
	                <center>
                        <div class="form-group m-b-0">
                            <input type="submit" class="btn blue" value="Simpan Hak Akses" name="simpan">
                            <input type="button" class="btn red" value="Kembali" id="btn_kembali">
                        </div>
                    </center>
                    <?PHP if($dt_pegawai == ""){ ?>
					    <input name="id_pegawai2" id="id_pegawai2" class="form-control" value="" type="hidden">
					<?PHP } else { ?>
					    <input name="id_pegawai2" id="id_pegawai2" class="form-control" value="<?=$dt_pegawai->id;?>" type="hidden">
					<?PHP } ?>
				</form>
			</div>
		</div>
	</div>
</div>