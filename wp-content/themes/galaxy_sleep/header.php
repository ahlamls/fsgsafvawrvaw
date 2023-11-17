<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Galaxy_Sleep
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<?php $show_banner = get_theme_mod("section_banner_setting_show", gs_get_content('section_banner.show')); ?>
	<?php if ($show_banner === true): ?>
	<?php $banner_bg_color = get_theme_mod("section_banner_setting_bgc", gs_get_content('section_banner.bg_color')); ?>
	<div id="banner" class="banner" style="<?php echo !empty($banner_bg_color) ? "background-color: $banner_bg_color" : '#ff9678' ?>">
		<div class="banner-close-btn" onclick="hideBanner()">
			<svg version="1.1" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" width="100%" class="d-block"><path d="m284.29 256 221.86-221.86c7.811-7.811 7.811-20.475 0-28.285s-20.475-7.811-28.285 0l-221.86 221.86-221.86-221.86c-7.811-7.811-20.475-7.811-28.285 0s-7.811 20.475 0 28.285l221.86 221.86-221.86 221.86c-7.811 7.811-7.811 20.475 0 28.285 3.905 3.905 9.024 5.857 14.143 5.857s10.237-1.952 14.143-5.857l221.86-221.86 221.86 221.86c3.905 3.905 9.024 5.857 14.143 5.857s10.237-1.952 14.143-5.857c7.811-7.811 7.811-20.475 0-28.285l-221.86-221.86z"></path></svg>
		</div>
		<div class="row m-0 banner-row align-items-center">
			<div class="col-12 col-lg-7 m-0 banner-title">
				<div class="richtext"><p><?php echo get_theme_mod("section_banner_setting_title", gs_get_content('section_banner.title')) ?></p></div>
			</div>
			<div class="col-8 text-lg-left col-lg-5 m-lg-0 mx-auto text-center cta-col">
				<a href="<?php echo get_theme_mod("section_banner_setting_cta_link", gs_get_content('section_banner.cta_link')) ?>" target="" title="Subscribe to an electric car now." class="btn btn-bright btn-lg"><?php echo get_theme_mod("section_banner_setting_cta_label", gs_get_content('section_banner.cta_label')) ?></a>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<header id="masthead" class="site-header">
		<nav class="navbar-wrapper navbar navbar-expand-lg navbar-light navbar-top-position">
			<div class="navbar-header col-outer pr-0">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-brand">
					<?php if(has_header_image()): ?>
						<img width="195" src="<?php echo get_header_image() ?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
					<?php else: ?>
						<img src="<?php echo get_template_directory_uri() ?>/assets/img/icons/galaxy-logo-dark.svg" alt="">
					<?php endif; ?>
				</a>
				<div class="navbar-header-right-mobile">
					<a href="<?php echo gs_get_cart_url(); ?>" class="cart-icon-wrapper d-block d-md-none">
						<img src="<?php echo get_template_directory_uri() ?>/assets/img/icons/bed-logo.png" alt="" class="cart-icon">
						<div class="cart-count">
							<span id="sa-cart-count"><?php echo gs_get_cart_count() ?></span>
						</div>
					</a>
					<button type="button" aria-label="Toggle navigation" class="navbar-toggle col-outer pl-0 navbar-toggler collapsed" data-toggle="collapse" data-target="#basic-navbar-nav" aria-controls="basic-navbar-nav" onclick="handleToggleNav()"><span class="sr-only">Toggle navigation</span><span class="icon-bar top-bar bg-mobile-dark"></span><span class="icon-bar bottom-bar bg-mobile-dark"></span></button>
				</div>
			</div>
			<div class="navbar-collapse collapse" id="basic-navbar-nav">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						'container' 	 => 'ul',
						'menu_class'	 => 'navbar-nav navbar-main',
						'link_class'	 => 'nav-link',
					)
				);
				?>
				<div class="navbar-right-icons">
					<?php
					wp_nav_menu(
						array(
							'menu'			=> 'menu-2',
							'menu_id'       => 'primary-menu-right',
							'container' 	=> 'ul',
							'menu_class'	=> 'navbar-nav navbar-right',
							'link_class'	=> 'nav-link',
						)
					);
					?>
					<a href="<?php echo gs_get_cart_url(); ?>" class="cart-icon-wrapper d-none d-md-block">
						<img src="<?php echo get_template_directory_uri() ?>/assets/img/icons/bed-logo.png" alt="" class="cart-icon">
						<div class="cart-count">
							<span id="sa-cart-count"><?php echo gs_get_cart_count() ?></span>
						</div>
					</a>
					<!-- <a href="#" data-toggle="modal" data-target="#modalSearch">
						<svg role="presentation" stroke-width="1.6" focusable="false" width="22" height="22" class="icon icon-search" viewBox="0 0 22 22">
							<circle cx="11" cy="10" r="7" fill="none" stroke="currentColor"></circle>
							<path d="m16 15 3 3" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
						</svg>
					</a> -->
					<!-- <a href="<?php echo gs_get_cart_url() ?>" class="relative tap-area" aria-controls="cart-drawer">
						<span class="sr-only">Warenkorb öffnen</span>
						<svg role="presentation" stroke-width="1.6" focusable="false" width="22" height="22" class="icon icon-cart" viewBox="0 0 22 22">
							<path d="M11 7H3.577A2 2 0 0 0 1.64 9.497l2.051 8A2 2 0 0 0 5.63 19H16.37a2 2 0 0 0 1.937-1.503l2.052-8A2 2 0 0 0 18.422 7H11Zm0 0V1" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
						</svg>
						
					</a> -->
				</div>
			</div>
		</nav>
	</header><!-- #masthead -->
