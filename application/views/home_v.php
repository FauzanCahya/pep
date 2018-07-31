<?php 

	$sess_user = $this->session->userdata('sign_in');
	$nama = $sess_user['nama_user'];
	$level = $sess_user['level'];
	$id_user = $sess_user['id'];

?>
<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.4
Version: 4.0.1
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title><?php echo $title; ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/bootstrap-select.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/global/plugins/jquery-multi-select/css/multi-select.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/global/plugins/clockface/css/clockface.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<link href="<?php echo base_url(); ?>assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-toastr/toastr.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style-devan.css"/>
<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN THEME STYLES -->
<link href="<?php echo base_url(); ?>assets/global/css/components-md.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/global/css/plugins-md.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="<?php echo base_url(); ?>assets/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style-devan.css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="<?php echo base_url(); ?>ico/howto02.png">
<style type="text/css">
.control-label{
	color: #000 !important;
}
</style>
</head>
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-md page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo" >

<?php
function MonthToString($month){
    $string = "";
    switch ($month) {
      case '1': $string = 'Januari'; break;
      case '2': $string = 'Februari'; break;
      case '3': $string = 'Maret'; break;
      case '4': $string = 'April'; break;
      case '5': $string = 'Mei'; break;
      case '6': $string = 'Juni'; break;
      case '7': $string = 'Juli'; break;
      case '8': $string = 'Agustus'; break;
      case '9': $string = 'September'; break;
      case '10': $string = 'Oktober'; break;
      case '11': $string = 'November'; break;
      case '12': $string = 'Desember'; break;

      default: ''; break;
    }
    return $string;
}

$data = $this->session->userdata('sign_in');
$id_user = $data['id'];
?>
<!-- BEGIN HEADER -->
<div class="page-header md-shadow-z-1-i navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">
		<!-- BEGIN LOGO -->
		<!-- <div class="page-logo">
			<a href="index.html">
			<img src="<?php echo base_url(); ?>assets/admin/layout/img/logo.png" alt="logo" class="logo-default"/>
			</a>
			<div class="menu-toggler sidebar-toggler">
			</div>
		</div> -->
		<!-- END LOGO -->
		<!-- BEGIN HORIZANTAL MENU -->
		<!-- DOC: Remove "hor-menu-light" class to have a horizontal menu with theme background instead of white background -->
		<!-- DOC: This is desktop version of the horizontal menu. The mobile version is defined(duplicated) in the responsive menu below along with sidebar menu. So the horizontal menu has 2 seperate versions -->
		<div class="hor-menu hor-menu-light hidden-sm hidden-xs">
			<ul class="nav navbar-nav">
				<!-- DOC: Remove data-hover="megadropdown" and data-close-others="true" attributes below to disable the horizontal opening on mouse hover -->
				<li class ="classic-menu-dropdown">
					<a href="<?php echo base_url(); ?>dashboard_c">
					Dashboard <span class="selected"></span>
					</a>
				</li>
				<?PHP
					$sql = "
						SELECT a.* FROM kepeg_menu_1 a 
						JOIN (
							SELECT ID_MENU FROM kepeg_hak_akses
							WHERE ID_PEGAWAI = '$id_user' AND KET = 'MENU_PORTAL'
						) b ON a.ID = b.ID_MENU
				        ORDER BY a.URUT ASC
					";
					$qry = $this->db->query($sql);
	                $get_menu1 = $qry->result();
	                foreach ($get_menu1 as $key => $menu1) {
	                	if($menu1->LINK == null || $menu1->LINK == ""){
	            ?>
	            <li class ="mega-menu-dropdown">
					<a data-toggle="dropdown" href="javascript:;" class="dropdown-toggle" data-hover="megamenu-dropdown" data-close-others="true">
					<?php echo $menu1->NAMA; ?> <i class="fa fa-angle-down"></i><span class="selected"></span>
					</a>
					<ul class="dropdown-menu" style="min-width: 400px;">
						<li>
							<div class="mega-menu-content">
								<div class="row">
									<div class="col-md-12">
										<ul class="mega-menu-submenu">
										<?php
											$sql2 = "
												SELECT a.* FROM kepeg_menu_2 a 
												JOIN (
													SELECT ID_MENU FROM kepeg_hak_akses
													WHERE ID_PEGAWAI = '$id_user' AND KET = 'MENU_2'
												) b ON a.ID = b.ID_MENU
												WHERE a.ID_MENU_1 = '".$menu1->ID."'
										        ORDER BY a.URUT ASC
											";
											$qry2 = $this->db->query($sql2);
											$get_menu2 = $qry2->result();
											foreach ($get_menu2 as $key => $val2) {
												if($val2->LINK != null || $val2->LINK != ""){
										?>
											<li <?php if ($menu2 == $val2->VIEW) { echo "class = 'active'";} ?> >
												<a href="<?php echo base_url().$val2->LINK; ?>">
												<i class="<?php echo $val2->ICON; ?>"></i> <?php echo $val2->NAMA; ?> </a>
											</li>
										<?php
												}else{
										?>
											<li class="dropdown-submenu">
												<a href="javascript:;">
												<i class="<?php echo $val2->ICON; ?>"></i> <?php echo $val2->NAMA; ?> </a>
												<ul class="dropdown-menu" style="min-width: 400px;">
												<?php
													$sql3 = "
														SELECT a.* FROM kepeg_menu_3 a 
														JOIN (
															SELECT ID_MENU FROM kepeg_hak_akses
															WHERE ID_PEGAWAI = '$id_user' AND KET = 'MENU_3'
														) b ON a.ID = b.ID_MENU
														WHERE a.ID_MENU_2 = '".$val2->ID."'
												        ORDER BY a.URUT ASC
													";
													$qry3 = $this->db->query($sql3);
													$get_menu3 = $qry3->result();
													foreach ($get_menu3 as $key => $val3) {
												?>
													<li <?php if ($menu2 == $val3->VIEW) { echo "class = 'active'";}?>>
														<a href="<?php echo base_url().$val3->LINK; ?>">
														<i class="<?php echo $val3->ICON; ?>"></i> <?php echo $val3->NAMA; ?> </a>
													</li>
												<?php
													}
												?>
												</ul>
											</li>
										<?php
												}
											}
										?>
										</ul>
									</div>
								</div>
							</div>
						</li>
					</ul>
				</li>
	            <?php
	                	}else{
	            ?>
	            <li class ="classic-menu-dropdown">
					<a href="<?php echo base_url().$menu1->LINK; ?>">
					<?php echo $menu1->NAMA; ?> <span class="selected"></span>
					</a>
				</li>
	            <?php
	            		}
	                }
                ?>

				<!-- <li class ="mega-menu-dropdown">
					<a data-toggle="dropdown" href="javascript:;" class="dropdown-toggle" data-hover="megamenu-dropdown" data-close-others="true">
					Penjualan <i class="fa fa-angle-down"></i><span class="selected"></span>
					</a>
					<ul class="dropdown-menu" style="min-width: 400px;">
						<li> -->
							<!-- Content container to add padding -->
							<!-- <div class="mega-menu-content">
								<div class="row">
									<div class="col-md-12">
										<ul class="mega-menu-submenu">
											<li <?php if ($menu2 == 'sales_order') { echo "class = 'active'";}?>>
												<a href="<?php echo base_url(); ?>sales_order_c">
												<i class="fa fa-bank"></i> Sales Order </a>
											</li>
											<li <?php if ($menu2 == 'invoice') { echo "class = 'active'";}?>>
												<a href="<?php echo base_url(); ?>invoice_c">
												<i class="fa fa-building"></i> Invoice </a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</li>
					</ul>
				</li> -->
				
			</ul>
		</div>
		<!-- END HORIZANTAL MENU -->
		<!-- BEGIN HEADER SEARCH BOX -->
		<!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
		<form class="search-form" action="extra_search.html" method="GET">
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Search..." name="query">
				<span class="input-group-btn">
				<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
				</span>
			</div>
		</form>
		<!-- END HEADER SEARCH BOX -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<!-- <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a> -->
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<?PHP 
		$sql_jt = "SELECT *, DATEDIFF(DATE_ADD(TGL_JATUH_TEMPO, INTERVAL 12 DAY), CURDATE()) as selisih FROM tb_pengakuan_hutang ";
		$data_jt = $this->db->query($sql_jt)->result();
		?>
		<div class="top-menu">
			<ul class="nav navbar-nav pull-right">
				<!-- BEGIN USER LOGIN DROPDOWN -->
				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
				<li id="header_notification_bar" class="dropdown dropdown-extended dropdown-notification">
					<a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="javascript:;">
					<i class="icon-bell"></i>
					<span class="badge badge-default">
					<?=count($data_jt);?> </span>
					</a>
					<ul class="dropdown-menu">
						<li class="external">
							<h3><span class="bold"><?=count($data_jt);?></span> Tagihan Jatuh Tempo</h3>
							<a target="_blank" href="<?=base_url();?>pengakuan_hutang_c/cetak_jatuh_tempo">Cetak </a>
						</li>
						<li>
							<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 250px;"><ul data-handle-color="#637283" style="height: 250px; overflow: hidden; width: auto;" class="dropdown-menu-list scroller" data-initialized="1">
								<?PHP foreach ($data_jt as $key => $row) { ?>
								<li>
									<a href="javascript:;">
									<span class="time"><?=$row->selisih;?> hari lagi</span>
									<span class="details">
									<span class="label label-sm label-icon label-warning">
									<i class="fa fa-bell-o"></i>
									</span>
									<?=$row->NO_BUKTI;?> </span>
									</a>
								</li>
								<?PHP } ?>
								<?PHP if(count($data_jt) == 0){ ?>
								<li>
									<a href="javascript:;">
									<span class="details">
									Tidak ada tagihan jatuh tempo
									</span>
									</a>
								</li>
								<?PHP } ?>
							</ul><div class="slimScrollBar" style="background: rgb(99, 114, 131) none repeat scroll 0% 0%; width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; right: 1px;"></div></div>
						</li>
					</ul>
				</li>
				<li class="dropdown dropdown-user">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<img alt="" class="img-circle" src="<?php echo base_url(); ?>assets/admin/layout/img/avatar3_small.jpg"/>
					<span class="username username-hide-on-mobile">
					<?php echo $nama; ?> </span>
					<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-menu-default">
						<!-- <li>
							<a href="extra_profile.html">
							<i class="icon-user"></i> My Profile </a>
						</li>
						<li>
							<a href="page_calendar.html">
							<i class="icon-calendar"></i> My Calendar </a>
						</li>
						<li>
							<a href="inbox.html">
							<i class="icon-envelope-open"></i> My Inbox <span class="badge badge-danger">
							3 </span>
							</a>
						</li>
						<li>
							<a href="page_todo.html">
							<i class="icon-rocket"></i> My Tasks <span class="badge badge-success">
							7 </span>
							</a>
						</li>
						<li class="divider">
						</li> -->
						<?php 

							if($level == 'direktur'){

						?>
						<li>
							<a href="<?php echo base_url(); ?>user_management_c">
							<i class="icon-users"></i> User Management </a>
						</li>
						<?php } ?>
						<li>
							<a href="<?php echo base_url(); ?>login_c/logout">
							<i class="icon-key"></i> Log Out </a>
						</li>
					</ul>
				</li>
				<!-- END USER LOGIN DROPDOWN -->
			</ul>
		</div>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	
	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content" style="margin-left:0; min-height:555px;">

			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title" style="color: white;">
			<?php echo $title; ?> 
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="index.html">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#"><?php echo $sub_menu; ?></a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#" style="color: #26a69a;"><?php echo $sub_menu1; ?></a>
					</li>
				</ul>
				<div class="page-toolbar">
					<div class="btn green">
						<?php 
                            $d = date('d');
                            $m = MonthToString(date('n'));
                            $y = date('Y');
                            echo $d." ".$m." ".$y;
                        ?>
					</div>
				</div>
			</div>
			<!-- END PAGE HEADER-->

			<?php if ($page != '') {
				$this->load->view($page);
			}else{
			?>

			<!-- BEGIN PAGE CONTENT-->
			
			<!-- END PAGE CONTENT-->
			
			<?php }?>

		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<!-- <div class="page-footer">
	<div class="page-footer-inner">
		 2014 &copy; Metronic by keenthemes. <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" title="Purchase Metronic just for 27$ and get lifetime updates for free" target="_blank">Purchase Metronic!</a>
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div> -->
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo base_url(); ?>assets/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-toastr/toastr.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/pages/scripts/ui-toastr.js"></script>
<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/clockface/js/clockface.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/pages/scripts/table-editable.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/pages/scripts/components-pickers.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/pages/scripts/components-dropdowns.js"></script>
<script src="<?php echo base_url(); ?>assets/js-form.js"></script>
<script src="<?php echo base_url(); ?>js/pesan.js"></script>

<!-- END PAGE LEVEL SCRIPTS -->

<script>
jQuery(document).ready(function() {    
    Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
	QuickSidebar.init(); // init quick sidebar
	Demo.init(); // init demo features
	TableEditable.init();
	UIToastr.init();
	ComponentsPickers.init();
	ComponentsDropdowns.init();
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>