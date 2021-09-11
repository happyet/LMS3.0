<!DOCTYPE html>
<html dir="ltr" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name = "viewport" content ="initial-scale=1.0,user-scalable=no">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page">
	<header id="header">
		<?php lmsim_custom_logo(); ?>
		<nav id="menu">
			<?php 
				if(has_nav_menu('topbar')){
					wp_nav_menu( array(
						'menu'              => '',
						'theme_location'    => 'topbar',
						'depth'             => 0,
						'container'         => '',
						'container_class'   => '',
						'fallback_cb'     	=> false,
						'menu_class'        => 'nav navbar-nav',
						'items_wrap'     => '<ul class="%2$s">%3$s</ul>'
					)  );
				}
			?>	
		</nav>
	</header>
	<main id="main">