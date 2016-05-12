<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title><?php wp_title(); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="body-overflow">

<header class="header">
	<div class="wrap">
		<p class="header-logo logo">
			<a href="<?php bloginfo( 'url' ); ?>">
				<?php echo Theme_SVG::render( THEME_IMG_PATH . '/wdg-logo.svg' ); ?>
				<?php bloginfo( 'name' ); ?>
			</a>
		</p>

		<?php echo Theme::nav( 'primary' ); ?>
		<?php echo Theme::nav( 'utility' ); ?>

		<?php get_search_form(); ?>
	</div>
</header><!-- end .header -->

<div class="main-container">
	<div class="wrap">

		<?php echo Theme::get_template_part( 'partials/breadcrumb' ); ?>
