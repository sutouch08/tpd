
<!DOCTYPE html>
<html lang="th">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />

		<title><?php echo $this->title; ?></title>
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicon.png">

		<?php $this->load->view('include/header_include'); ?>

		<style>
			.ui-helper-hidden-accessible {
				display:none;
			}

			.ui-autocomplete {
		    max-height: 250px;
		    overflow-y: auto;
		    overflow-x: hidden;
			}

			.ui-widget {
				width:auto;
			}
	</style>

	</head>
	<body class="no-skin">
		<div id="loader">
        <div class="loader"></div>
		</div>
		<div id="loader-backdrop" style="position: fixed; width:100vw; height:100vh; background-color:white; opacity:0.3; display:none; z-index:9;"></div>
		<!-- #section:basics/navbar.layout -->
		<div id="navbar" class="navbar navbar-default">
			<script type="text/javascript">
				var BASE_URL = '<?php echo base_url(); ?>';
			</script>
			<div class="navbar-container" id="navbar-container">

				<!-- #section:basics/sidebar.mobile.toggle -->
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="<?php echo base_url(); ?>" class="navbar-brand" style="padding-top:0px; padding-bottom:0px;">
						<?php if(getConfig('UAT')) : ?>
							<h4>
								<?php echo getConfig('COMPANY_NAME'); ?>
							</h4>
						<?php else : ?>
						<img src="<?php echo base_url(); ?>images/company/company-logo.png" height="40" class="hidden-sm hidden-xs">
					<?php endif; ?>
					</a>
				</div>

					<?php //$this->load->view('include/top_menu'); ?>
				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">

						<li class="salmon">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">

								<span class="user-info">
									<small>Welcome</small>
									<?php echo $this->_user->uname; ?>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-caret dropdown-close">

								<li>
									<a href="JavaScript:void(0)" onclick="changeUserPwd()">
										<i class="ace-icon fa fa-key"></i>
										Change Password
									</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="JavaScript:window.location.reload(true)">
										<i class="ace-icon fa fa-bolt"></i>
										Clear cache
									</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="<?php echo base_url(); ?>authentication/logout">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
				<!-- /section:basics/navbar.dropdown -->
			</div><!-- /.navbar-container -->
		</div>

		<!-- /section:basics/navbar.layout -->
		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>
			<!-- #section:basics/sidebar -->
			<div id="sidebar" class="sidebar responsive <?php echo get_cookie('sidebar_layout'); ?>" data-sidebar="true" data-sidebar-scoll="true" data-sidebar-hover="true">
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>
						<!--- side menu  ------>
				<?php $this->load->view("include/side_menu"); ?>

				<!-- #section:basics/sidebar.layout.minimize -->
				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse" onclick="toggle_layout()">
					<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>

			</div>
			<!-- /section:basics/sidebar -->
			<div class="main-content">
				<div class="main-content-inner">
					<div id="sidebar2" class="sidebar h-sidebar navbar-collapse collapse" data-sidebar="true" data-sidebar-scoll="true"
					data-sidebar-hover="true" aria-expanded="false" style="height:1px;">
    			</div>
					<div class="page-content">

			<?php if($this->pm->can_view == 0) { $this->load->view('deny_page'); }	?>
