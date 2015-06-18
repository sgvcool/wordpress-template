<!DOCTYPE html>	
  <html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	  <meta charset="<?php bloginfo( 'charset' ); ?>">
	  <meta name="viewport" content="width=device-width">
	  <title><?php wp_title( $sep, $echo, $seplocation ); ?></title>
	  <link href="<?php bloginfo( 'stylesheet_url' ); ?>" rel="stylesheet" type="text/css">
	  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	
	  <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico">
	  <script src="<?php echo get_template_directory_uri(); ?>/js/bxslider.min.js"></script>
	  <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.bxslider.js"></script>
	  <?php canonical();?>
	  <?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
	  <div class='greatContainer'>
		<header>
		  <!-- main menu-->
		  <?php wp_nav_menu('menu=main'); ?>
		  <!-- main menu-->
		  
		  <a href='/' class='logoSite'></a>
		</header>



