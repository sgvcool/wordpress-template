<!DOCTYPE html>	
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width">
		<title><?php wp_title( $sep, $echo, $seplocation ); ?></title>
		<link href="<?php bloginfo( 'stylesheet_url' ); ?>" rel="stylesheet" type="text/css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico">
		
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
		
		<!-- Latest compiled and minified JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

		<!-- slick -->
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/slick/slick.css"/>
		<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/slick/slick.min.js"></script>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/common.js"></script>
		
		
		<?php canonical();?>
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<div class='container'>
			<div class='row bg-shadow wrapper-container'>
				<div class='col-md-12 bm-header-container bm-shadow-container'>
					<a href='/' class='bm-site-logo'>
						<p class='bm-text-logo'></p>
					</a>
				</div>
				
				<!-- main menu-->
				<div class='col-md-12 bm-menu hidden-xs'>
					<?php wp_nav_menu('menu=main'); ?>
				</div>
				<!-- main menu-->
				
				<!--mobile main menu-->
				<div class='col-md-12 bm-menu visible-xs bg-black'>
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						
					</div>
					<div class="collapse navbar-collapse">
						<?php wp_nav_menu('menu=main'); ?>
					</div>
				</div>
				<!--mobile main menu-->