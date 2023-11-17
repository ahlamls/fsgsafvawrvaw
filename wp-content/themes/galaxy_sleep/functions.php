<?php
/**
 * Galaxy Sleep functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Galaxy_Sleep
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.26' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function galaxy_sleep_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Galaxy Sleep, use a find and replace
		* to change 'galaxy_sleep' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'galaxy_sleep', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'galaxy_sleep' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	// add_theme_support(
	// 	'custom-background',
	// 	apply_filters(
	// 		'galaxy_sleep_custom_background_args',
	// 		array(
	// 			'default-color' => 'ffffff',
	// 			'default-image' => '',
	// 		)
	// 	)
	// );

	// Add theme support for selective refresh for widgets.
	// add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'galaxy_sleep_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function galaxy_sleep_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'galaxy_sleep_content_width', 640 );
}
add_action( 'after_setup_theme', 'galaxy_sleep_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
// function galaxy_sleep_widgets_init() {
// 	register_sidebar(
// 		array(
// 			'name'          => esc_html__( 'Sidebar', 'galaxy_sleep' ),
// 			'id'            => 'sidebar-1',
// 			'description'   => esc_html__( 'Add widgets here.', 'galaxy_sleep' ),
// 			'before_widget' => '<section id="%1$s" class="widget %2$s">',
// 			'after_widget'  => '</section>',
// 			'before_title'  => '<h2 class="widget-title">',
// 			'after_title'   => '</h2>',
// 		)
// 	);
// }
// add_action( 'widgets_init', 'galaxy_sleep_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function galaxy_sleep_scripts() {
	wp_enqueue_style( 'galaxy_sleep-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'galaxy_sleep-style', 'rtl', 'replace' );
	wp_enqueue_style( 'galaxy_sleep-style-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap-custom.min.css' );
	wp_enqueue_style( 'galaxy_sleep-style-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );
	wp_enqueue_style( 'galaxy_sleep-style-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );
	wp_enqueue_style( 'galaxy_sleep-style-jquery-ui', get_template_directory_uri() . '/assets/css/jquery-ui.min.css' );
	wp_enqueue_style( 'galaxy_sleep-style-custom', get_template_directory_uri() . '/assets/css/style.css', array(), _S_VERSION );


	wp_enqueue_script( 'jquery-ui-slider' );
	wp_enqueue_script( 'jquery-ui-selectmenu' );

	wp_enqueue_script( 'galaxy_sleep-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	// wp_enqueue_script( 'galaxy_sleep-script-jquery', get_template_directory_uri() . '/assets/js/jquery-3.2.1.slim.min.js');
	wp_enqueue_script( 'galaxy_sleep-script-jquery', get_template_directory_uri() . '/assets/js/jquery-3.7.1.min.js');
	wp_enqueue_script( 'galaxy_sleep-script-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js');
	wp_enqueue_script( 'galaxy_sleep-script-app', get_template_directory_uri() . '/assets/js/app.js', array('jquery', 'jquery-ui-slider', 'jquery-ui-selectmenu'), _S_VERSION, true );
	wp_dequeue_script( 'zoom' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'galaxy_sleep_scripts', 15 );

function add_menu_link_class( $atts, $item, $args ) {
	if (isset($args->link_class)) {
        $atts['class'] = $args->link_class;
    }
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_menu_link_class', 10, 3 );

function gs_get_cart_url(){
	if (function_exists('wc_get_cart_url')) return wc_get_cart_url();
	return '';
}

function gs_get_cart_count(){
	if (function_exists('WC')) return WC()->cart->get_cart_contents_count();
	return '';
}

add_filter( 'woocommerce_add_to_cart_fragments', 'gs_refresh_cart_count', 50, 1 );
function gs_refresh_cart_count( $fragments ){
    ob_start();
		?><span id="gs-cart-count"><?php echo gs_get_cart_count() ?></span><?php
    $fragments['#gs-cart-count'] = ob_get_clean();
    return $fragments;
}

require get_template_directory() . '/inc/galaxy-sleep-content.php';
if ( ! defined( 'GS_CONTENT' ) ) {
	$content = new GalaxySleep_Content();
	define('GS_CONTENT', $content->getData());
} 

function gs_get_content($input){
	$content = GS_CONTENT;
	$keys = explode('.', $input);
	foreach ($keys as $key) {
		if (isset($content[$key])) {
			$content = $content[$key];
		} else {
			return null;
		}
	}
	return $content;
}

function gs_search_query($query) {
	if ($query->is_search() && !is_admin()) {
		$filter_in_stock = $_GET['filter_in_stock'] ?? "";
		$filter_out_stock = $_GET['filter_out_stock'] ?? "";
		$filter_min_price = $_GET['filter_min_price'] ?? "";
		$filter_max_price = $_GET['filter_max_price'] ?? "";
		$sort = $_GET['sort'] ?? "relevance";
		
		$meta_query = $query->get('meta_query');
		if(empty($meta_query)) $meta_query = [];

		if(!empty($filter_in_stock) && !empty($filter_out_stock)){
			$query->set('post_type', 'product');
		} else {
			if(!empty($filter_in_stock)) $meta_query[] = ['key' => '_stock_status','value' => 'instock'];
			if(!empty($filter_out_stock)) $meta_query[] = ['key' => '_stock_status','value' => 'outofstock'];
		}

		if(!empty($filter_min_price)) $meta_query[] = ['key' => '_price','value' => $filter_min_price, 'compare' => '>=', 'type' => 'NUMERIC'];
		if(!empty($filter_max_price)) $meta_query[] = ['key' => '_price','value' => $filter_max_price, 'compare' => '<=', 'type' => 'NUMERIC'];
		
		$query->set('meta_query', $meta_query);

		if(in_array($sort, ['min_price','max_price'])){
			$query->set('post_type', 'product');
			$query->set('orderby', 'meta_value_num');
			$query->set('meta_key', '_price');
			if($sort == 'min_price') $query->set('order', 'ASC');
			if($sort == 'max_price') $query->set('order', 'DESC');
		} 
	}
}
add_action('pre_get_posts', 'gs_search_query');

// add_filter( 'woocommerce_cart_needs_payment', '__return_false' ); // disable payment
add_filter( 'woocommerce_price_trim_zeros', '__return_true' );

function section_two_column($section, $i, $items) {
	ob_start();
	?>
	<section>
		<div class="row no-gutters">
			<?php
				$left_type = get_theme_mod("$section.tc.left.setting_type_$i", $items['tc']['left']['type']);
			?>
			<?php if ($left_type == 'text'): ?>
				<div class="col-12 col-md-6 blocky-group d-flex" style="background-color: <?php echo get_theme_mod("$section.tc.left.setting_bgc_$i", $items['tc']['left']['text']['bg_color']) ?>">
					<div class="p-4 p-md-5 block-media-text">
						<h2>
							<?php echo get_theme_mod("$section.tc.left.setting_title_$i", $items['tc']['left']['text']['title']) ?>
						</h2>
						<p class="mt-4 teaser-description">
							<?php echo get_theme_mod("$section.tc.left.setting_desc_$i", $items['tc']['left']['text']['desc']) ?>
						</p>
						<?php if (get_theme_mod("$section.tc.left.setting_cta_label_$i", $items['tc']['left']['text']['cta_label'])):  ?>
						<div class="row">
							<div class="col-12 col-lg-8 flex-column d-flex mx-auto mt-3 text-center">
								<a href="<?php echo get_theme_mod("$section.tc.left.setting_cta_link_$i", $items['tc']['left']['text']['cta_link']) ?>" class="w-100 btn btn-bright btn-lg mt-4"><?php echo get_theme_mod("$section.tc.left.setting_cta_label_$i", $items['tc']['left']['text']['cta_label']) ?></a>
							</div>
						</div>
						<?php endif ?>
					</div>
				</div>
			<?php elseif ($left_type == 'text_logo'): ?>
				<div class="col-12 col-md-6 blocky-group d-flex" style="background-color: <?php echo get_theme_mod("$section.tc.left.setting_tl_bgc_$i", $items['tc']['left']['text_logo']['bg_color']) ?>">
					<div class="p-4 p-md-5 block-media-text-logo">
						<div>
							<img src="<?php echo get_theme_mod("$section.tc.left.setting_tl_logo_$i", $items['tc']['left']['text_logo']['logo']) ?>" alt="">
						</div>
						<h2>
							<?php echo get_theme_mod("$section.tc.left.setting_tl_title_$i", $items['tc']['left']['text_logo']['title']) ?>
						</h2>
						<?php if (get_theme_mod("$section.tc.left.setting_tl_cta_label_$i", $items['tc']['left']['text_logo']['cta_label'])):  ?>
						<div class="row">
							<div class="col-12 col-lg-8 flex-column d-flex mx-auto mt-3 text-center">
								<a href="<?php echo get_theme_mod("$section.tc.left.setting_tl_cta_link_$i", $items['tc']['left']['text_logo']['cta_link']) ?>" class="w-100 btn btn-bright btn-lg mt-4"><?php echo get_theme_mod("$section.tc.left.setting_tl_cta_label_$i", $items['tc']['left']['text_logo']['cta_label']) ?></a>
							</div>
						</div>
						<?php endif ?>
					</div>
				</div>
			<?php elseif ($left_type == 'image'): ?>
				<?php 
					$image_bgc = get_theme_mod("$section.tc.left.setting_image_bgc_$i", ($items['tc']['left']['image_bgc'] ?? ''));
					$image_type = get_theme_mod("$section.tc.left.setting_image_type_$i", ($items['tc']['left']['image_type'] ?? ''));
				?>
				<div class="col-12 col-md-6 d-flex align-items-center two-column-layout-img" style="<?php !empty($image_bgc) && $image_bgc != 'cover' ? "background-color: $image_bgc" : '' ?>">
					<img src="<?php echo get_theme_mod("$section.tc.left.setting_image_$i", $items['tc']['left']['image']) ?>" alt="" style="<?php !empty($image_type) && $image_type != 'cover' ? "object-fit: $image_type" : '' ?>">
				</div>
			<?php elseif ($left_type == 'video'): ?>
				<div class="col-12 col-md-6">
					<video autoplay muted loop>
						<source src="<?php echo get_theme_mod("$section.tc.left.setting_video_$i", $items['tc']['left']['video']) ?>" type="video/mp4">
					</video>
				</div>
			<?php elseif ($left_type == 'accordion'): ?>
				<div class="col-12 col-md-6 d-flex align-items-center p-0 d-flex" style="background-color: <?php echo get_theme_mod("$section.tc.left.setting_bgc_accordion_$i", $items['tc']['left']['accordion']['bg_color']) ?>">
					<div class="d-flex block flex-column second-block justify-content-center align-items-center flex-fill col-outer py-5">
						<div class="block-richtext-container d-flex">
							<div class="block-richtext d-flex flex-column text-center flex-fill">
								<div class="richtext">
									<h3>
										<?php echo get_theme_mod("$section.tc.left.setting_title_accordion_$i", $items['tc']['left']['accordion']['title']) ?>
									</h3>
								</div>
							</div>
						</div>
						<div class="mt-5 d-block position-relative w-100">
							<?php
								$accordions = gs_get_content("$section.$i.tc.left.accordion.items");
								$accordion_left_id = "accordion_left_$i";
							?>
							<div class="accordion" id="<?php echo $accordion_left_id ?>">
								<?php foreach ($accordions as $j => $accordion): ?>
									<?php 
										$accordion_item_id = "collapse-left-$i-$j"; 
										$heading_id = "heading-left-$i-$j";
										$accordion_item_title = get_theme_mod("$section.tc.left.setting_title_accordion.$j._$i", $accordion['title']);
									?>
									<?php if (!empty($accordion_item_title)): ?>
									<?php $accordion_logo = get_theme_mod("$section.tc.left.setting_logo_accordion.$j._$i", $accordion['logo']); ?>
									<?php $accordion_bg_logo = get_theme_mod("$section.tc.left.setting_logo_bgc_accordion.$j._$i", $accordion['logo_bg_color']); ?>
									<div class="accordion-item <?php echo empty($accordion_bg_logo) ? 'border-black' : '' ?> <?php echo !empty($accordion_logo) ? 'accordion-with-icon' : '' ?>" style="<?php echo !empty($accordion_bg_logo) ? 'border-color:'.$accordion_bg_logo : '' ?>">
										<div class="accordion-header" id="<?php echo $heading_id ?>">
											<div role="button" class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#<?php echo $accordion_item_id ?>" aria-expanded="true" aria-controls="<?php echo $accordion_item_id ?>">
												<div class="d-flex w-100 justify-content-between align-items-center flex-row">
													<div class="d-flex align-items-center">
														<?php if (!empty($accordion_logo)): ?>
														<div class="accordion-icon mr-3" style="<?php echo !empty($accordion_bg_logo) ? "background-color: $accordion_bg_logo" : '' ?>">
															<img src="<?php echo $accordion_logo ?>" alt="">
														</div>
														<?php endif; ?>
														<p class="d-flex mb-0">
															<b><?php echo $accordion_item_title ?></b>
														</p>
													</div>
													<div class="accordion-toggle d-flex ml-3">
														<span class="accordion-toggle-line1 bg-dark border-dark"></span>
														<span class="accordion-toggle-line2 bg-dark border-dark"></span>
													</div>
												</div>
											</div>
										</div>
										<div id="<?php echo $accordion_item_id ?>" class="collapse" aria-labelledby="<?php echo $heading_id ?>" data-parent="#<?php echo $accordion_left_id ?>">
											<div class="accordion-body">
												<p><?php echo get_theme_mod("$section.tc.left.setting_desc_accordion.$j._$i", $accordion['desc']) ?></p>
											</div>
										</div>
									</div>
									<?php endif; ?>
								<?php endforeach; ?>
							</div>
						</div>
						<div class="mt-4 d-block position-relative w-100"></div>
					</div>
				</div>
			<?php elseif ($left_type == 'icon_text'): ?>
				<div class="col-12 col-md-6 d-flex align-items-center p-0 d-flex" style="background-color: <?php echo get_theme_mod("$section.tc.left.setting_bgc_icon_text_$i", $items['tc']['left']['icon_text']['bg_color']) ?>">
					<div class="d-flex block flex-column second-block justify-content-center align-items-center flex-fill col-outer py-5 ">
						<?php $icons_text = gs_get_content("$section.$i.tc.left.icon_text.items"); ?>
						<?php foreach ($icons_text as $j => $icon_text): ?>
							<?php 
								$icon_text_title = get_theme_mod("$section.tc.left.setting_title_icon_text.$j._$i", $icon_text['title']);
								$icon_text_image = get_theme_mod("$section.tc.left.setting_icon_text_image.$j._$i", $icon_text['image']); 
							?>
							<?php if (!empty($icon_text_title)): ?>
							<div class="explanation-row row w-100">
								<div class="col-12 col-xl-4 d-flex flex-column align-items-center mb-3 p-3 explanation-image-container">
									<img width="280" height="auto" src="<?php echo $icon_text_image; ?>" class="explanation-image w-90">
								</div>
								<div class="explanation-text-column col-12 col-xl-8">
									<div class="mb-2 explanation-title">
										<h3>
											<span class=""><?php echo $icon_text_title ?></span>
										</h3>
									</div>
									<div class="explanation-desc">
										<p><?php echo get_theme_mod("$section.tc.left.setting_desc_icon_text.$j._$i", $icon_text['desc']) ?></p>
										<?php
											$cta_label = get_theme_mod("$section.tc.left.setting_cta_label_icon_text.$j._$i", $icon_text['cta_label']);
											$cta_link = get_theme_mod("$section.tc.left.setting_cta_link_icon_text.$j._$i", $icon_text['cta_link']);
										?>
										<?php if (!empty($cta_label)): ?>
											<a href="<?php echo $cta_link ?>" class="w-100 btn btn-outline-dark btn-lg mt-3"><?php echo $cta_label ?></a>
										<?php endif; ?>
									</div>
								</div>
							</div>
							<?php endif; ?>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>
			<?php
				$right_type = get_theme_mod("$section.tc.right.setting_type_$i", $items['tc']['right']['type']);
			?>
			<?php if ($right_type == 'text'): ?>
				<div class="col-12 col-md-6 blocky-group d-flex" style="background-color: <?php echo get_theme_mod("$section.tc.right.setting_bgc_$i", $items['tc']['right']['text']['bg_color']) ?>">
					<div class="p-4 p-md-5 block-media-text">
						<h2>
							<?php echo get_theme_mod("$section.tc.right.setting_title_$i", $items['tc']['right']['text']['title']) ?>
						</h2>
						<p class="mt-4 teaser-description">
							<?php echo get_theme_mod("$section.tc.right.setting_desc_$i", $items['tc']['right']['text']['desc']) ?>
						</p>
						<?php if (get_theme_mod("$section.tc.right.setting_cta_label_$i", $items['tc']['right']['text']['cta_label'])):  ?>
						<div class="row">
							<div class="col-12 col-lg-8 flex-column d-flex mx-auto mt-3 text-center">
								<a href="<?php echo get_theme_mod("$section.tc.right.setting_cta_link_$i", $items['tc']['right']['text']['cta_link']) ?>" class="w-100 btn btn-bright btn-lg mt-4"><?php echo get_theme_mod("$section.tc.right.setting_cta_label_$i", $items['tc']['right']['text']['cta_label']) ?></a>
							</div>
						</div>
						<?php endif ?>
					</div>
				</div>
			<?php elseif ($right_type == 'text_logo'): ?>
				<div class="col-12 col-md-6 blocky-group d-flex" style="background-color: <?php echo get_theme_mod("$section.tc.right.setting_tl_bgc_$i", $items['tc']['right']['text_logo']['bg_color']) ?>">
					<div class="p-4 p-md-5 block-media-text-logo">
						<div>
							<img src="<?php echo get_theme_mod("$section.tc.right.setting_tl_logo_$i", $items['tc']['right']['text_logo']['logo']) ?>" alt="">
						</div>
						<h2>
							<?php echo get_theme_mod("$section.tc.right.setting_tl_title_$i", $items['tc']['right']['text_logo']['title']) ?>
						</h2>
						<?php if (get_theme_mod("$section.tc.right.setting_tl_cta_label_$i", $items['tc']['right']['text_logo']['cta_label'])):  ?>
						<div class="row">
							<div class="col-12 col-lg-8 flex-column d-flex mx-auto mt-3 text-center">
								<a href="<?php echo get_theme_mod("$section.tc.right.setting_tl_cta_link_$i", $items['tc']['right']['text_logo']['cta_link']) ?>" class="w-100 btn btn-bright btn-lg mt-4"><?php echo get_theme_mod("$section.tc.right.setting_tl_cta_label_$i", $items['tc']['right']['text_logo']['cta_label']) ?></a>
							</div>
						</div>
						<?php endif ?>
					</div>
				</div>
			<?php elseif ($right_type == 'image'): ?>
				<?php 
					$image_bgc = get_theme_mod("$section.tc.right.setting_image_bgc_$i", ($items['tc']['right']['image_bgc'] ?? ''));
					$image_type = get_theme_mod("$section.tc.right.setting_image_type_$i", ($items['tc']['right']['image_type'] ?? ''));
				?>
				<div class="col-12 col-md-6 d-flex align-items-center two-column-layout-img" style="<?php echo !empty($image_bgc) && $image_bgc != 'cover' ? "background-color: $image_bgc" : '' ?>">
					<img src="<?php echo get_theme_mod("$section.tc.right.setting_image_$i", $items['tc']['right']['image']) ?>" alt="" style="<?php echo !empty($image_type) && $image_type != 'cover' ? "object-fit: $image_type" : '' ?>">
				</div>
			<?php elseif ($right_type == 'video'): ?>
				<div class="col-12 col-md-6">
					<video autoplay muted loop>
						<source src="<?php echo get_theme_mod("$section.tc.right.setting_video_$i", $items['tc']['right']['video']) ?>" type="video/mp4">
					</video>
				</div>
			<?php elseif ($right_type == 'accordion'): ?>
				<div class="col-12 col-md-6 d-flex align-items-center p-0 d-flex" style="background-color: <?php echo get_theme_mod("$section.tc.right.setting_bgc_accordion_$i", $items['tc']['right']['accordion']['bg_color']) ?>">
					<div class="d-flex block flex-column second-block justify-content-center align-items-center flex-fill col-outer py-5">
						<div class="block-richtext-container d-flex">
							<div class="block-richtext d-flex flex-column text-center flex-fill">
								<div class="richtext">
									<h3>
										<?php echo get_theme_mod("$section.tc.right.setting_title_accordion_$i", $items['tc']['right']['accordion']['title']) ?>
									</h3>
								</div>
							</div>
						</div>
						<div class="mt-5 d-block position-relative w-100">
							<?php
								$accordions = gs_get_content("$section.$i.tc.right.accordion.items");
								$accordion_right_id = "accordion_right_$i";
							?>
							<div class="accordion" id="<?php echo $accordion_right_id ?>">
								<?php foreach ($accordions as $j => $accordion): ?>
									<?php 
										$accordion_item_id = "collapse-right-$i-$j"; 
										$heading_id = "heading-right-$i-$j";
										$accordion_item_title = get_theme_mod("$section.tc.right.setting_title_accordion.$j._$i", $accordion['title']);
									?>
									<?php if (!empty($accordion_item_title)): ?>
									<?php $accordion_bg_logo = get_theme_mod("$section.tc.right.setting_logo_bgc_accordion.$j._$i", $accordion['logo_bg_color']); ?>
									<?php $accordion_logo = get_theme_mod("$section.tc.right.setting_logo_accordion.$j._$i", $accordion['logo']); ?>
									<div class="accordion-item <?php echo empty($accordion_bg_logo) ? 'border-black' : '' ?> <?php echo !empty($accordion_logo) ? 'accordion-with-icon' : '' ?>" style="<?php echo !empty($accordion_bg_logo) ? 'border-color:'.$accordion_bg_logo : '' ?>">
										<div class="accordion-header" id="<?php echo $heading_id ?>">
											<div role="button" class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#<?php echo $accordion_item_id ?>" aria-expanded="true" aria-controls="<?php echo $accordion_item_id ?>">
												<div class="d-flex w-100 justify-content-between align-items-center flex-row">
													<div class="d-flex align-items-center">
														<?php if (!empty($accordion_logo)): ?>
														<div class="accordion-icon mr-3" style="<?php echo !empty($accordion_bg_logo) ? "background-color: $accordion_bg_logo" : '' ?>">
															<img src="<?php echo $accordion_logo ?>" alt="">
														</div>
														<?php endif; ?>
														<p class="d-flex mb-0">
															<b><?php echo $accordion_item_title ?></b>
														</p>
													</div>
													<div class="accordion-toggle d-flex ml-3">
														<span class="accordion-toggle-line1 bg-dark border-dark"></span>
														<span class="accordion-toggle-line2 bg-dark border-dark"></span>
													</div>
												</div>
											</div>
										</div>
										<div id="<?php echo $accordion_item_id ?>" class="collapse" aria-labelledby="<?php echo $heading_id ?>" data-parent="#<?php echo $accordion_right_id ?>">
											<div class="accordion-body">
												<p><?php echo get_theme_mod("$section.tc.right.setting_desc_accordion.$j._$i", $accordion['desc']) ?></p>
											</div>
										</div>
									</div>
									<?php endif; ?>
								<?php endforeach; ?>
							</div>
						</div>
						<div class="mt-4 d-block position-relative w-100"></div>
					</div>
				</div>
			<?php elseif ($right_type == 'icon_text'): ?>
				<div class="col-12 col-md-6 d-flex align-items-center p-0 d-flex" style="background-color: <?php echo get_theme_mod("$section.tc.right.setting_bgc_icon_text_$i", $items['tc']['right']['icon_text']['bg_color']) ?>">
					<div class="d-flex block flex-column second-block justify-content-center align-items-center flex-fill col-outer py-5 ">
						<?php $icons_text = gs_get_content("$section.$i.tc.right.icon_text.items"); ?>
						<?php foreach ($icons_text as $j => $icon_text): ?>
							<?php 
								$icon_text_title = get_theme_mod("$section.tc.right.setting_title_icon_text.$j._$i", $icon_text['title']);
								$icon_text_image = get_theme_mod("$section.tc.right.setting_icon_text_image.$j._$i", $icon_text['image']); 
							?>
							<?php if (!empty($icon_text_title)): ?>
							<div class="explanation-row row w-100">
								<div class="col-12 col-xl-4 d-flex flex-column align-items-center mb-3 p-3 explanation-image-container">
									<img width="280" height="auto" src="<?php echo $icon_text_image; ?>" class="explanation-image w-90">
								</div>
								<div class="explanation-text-column col-12 col-xl-8">
									<div class="mb-2 explanation-title">
										<h3>
											<span class=""><?php echo $icon_text_title ?></span>
										</h3>
									</div>
									<div class="explanation-desc">
										<p><?php echo get_theme_mod("$section.tc.right.setting_desc_icon_text.$j._$i", $icon_text['desc']) ?></p>
										<?php
											$cta_label = get_theme_mod("$section.tc.right.setting_cta_label_icon_text.$j._$i", $icon_text['cta_label']);
											$cta_link = get_theme_mod("$section.tc.right.setting_cta_link_icon_text.$j._$i", $icon_text['cta_link']);
										?>
										<?php if (!empty($cta_label)): ?>
											<a href="<?php echo $cta_link ?>" class="w-100 btn btn-outline-dark btn-lg mt-3"><?php echo $cta_label ?></a>
										<?php endif; ?>
									</div>
								</div>
							</div>
							<?php endif; ?>
						<?php endforeach; ?>
					</div>
				</div>
			<?php elseif ($right_type == 'form_contact'): ?>
				<div class="col-12 col-md-6 blocky-group d-flex" style="background-color: <?php echo get_theme_mod("$section.tc.right.setting_bgc_form_contact_$i", $items['tc']['right']['form_contact']['bg_color']) ?>">
					<div class="p-4 p-md-5 block-media-text">
						<h3><?php echo get_theme_mod("$section.tc.right.setting_title_form_contact_$i", $items['tc']['right']['form_contact']['title']) ?></h3>
						<p><?php echo get_theme_mod("$section.tc.right.setting_desc_form_contact_$i", $items['tc']['right']['form_contact']['desc']) ?></p>
						<br><br><br>
						<?php $shortcode = get_theme_mod("$section.tc.right.setting_shortcode_form_contact_$i", $items['tc']['right']['form_contact']['shortcode']); ?>
						<?php $bg_color2 = get_theme_mod("$section.tc.right.setting_bgc2_form_contact_$i", $items['tc']['right']['form_contact']['bg_color2']) ?>
						<?php if(!empty($bg_color2)): ?>
							<style>.forminator-button-submit { background-color: <?php echo $bg_color2 ?> !important}</style>
						<?php endif; ?>
						
						<?php if (!empty($shortcode)): ?>
							<div class="form-contact">
								<?php echo do_shortcode($shortcode); ?>
							</div>
						<?php endif; ?>
						<div class="mt-5 d-flex justify-content-center text-center flex-column align-items-center">
							<?php $form_contact_logo = get_theme_mod("$section.tc.right.setting_logo_form_contact_$i", $items['tc']['right']['form_contact']['logo']) ?>
							<?php if (!empty($form_contact_logo)): ?>
								<div class="rounded-logo" style="background-color: <?php echo $bg_color2 ?>">
									<img src="<?php echo $form_contact_logo ?>">
								</div>
							<?php endif; ?>
							<div class="mt-3">
								<p><b><?php echo get_theme_mod("$section.tc.right.setting_logo_title_form_contact_$i", $items['tc']['right']['form_contact']['logo_title']) ?></b></p>
								<p><a href="<?php echo get_theme_mod("$section.tc.right.setting_cta_link_form_contact_$i", $items['tc']['right']['form_contact']['cta_link']) ?>"><?php echo get_theme_mod("$section.tc.right.setting_cta_label_form_contact_$i", $items['tc']['right']['form_contact']['cta_label']) ?></a></p>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<?php
	return ob_get_clean();
}

function section_product_list($section, $i, $items, $prevItemType = '') {
	ob_start();
	?>
	<section class="col-12 col-outer py-section-padding-home <?php echo !empty($prevItemType) && $prevItemType == 'single' ? 'prev-single-layout' : '' ?>">
		<?php $pl_title = get_theme_mod("$section.pl_setting_title_$i", $items['pl']['title']); ?>
		<?php if (!empty($pl_title)): ?>
		<div class="row">
			<div class="col-12 col-lg-8 flex-column d-flex mx-auto text-center">
				<div class="mb-lg-5 mb-4">
					<div class="richtext">
						<h3><?php echo $pl_title; ?></h3>
					</div>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<div class="vehicle-teaser-grid">
			<?php
				$products = gs_get_content("$section.$i.pl.items", $items['pl']['items']);
			?>
			<?php foreach ($products as $k => $product): ?>
				<?php if (!empty(get_theme_mod("$section.pl.$k.setting_title_$i", $product['title']))): ?>
				<?php
					$bg1 = get_theme_mod("$section.pl.$k.setting_bgc1_$i", $product['bg_color_1']);
					$bg2 = get_theme_mod("$section.pl.$k.setting_bgc2_$i", $product['bg_color_2']);
					$cta_label = get_theme_mod("$section.pl.$k.setting_cta_label_$i", $product['cta_label']);
					$cta_link = get_theme_mod("$section.pl.$k.setting_cta_link_$i", $product['cta_link']);
					$product_image = get_theme_mod("$section.pl.$k.setting_image_$i", $product['image']);
					$useImageAsCover = empty($bg1) && empty($bg2);
				?>
					<?php if (!empty($cta_label)): ?>
					<div class="d-flex border-radius overflow-hidden" style="<?php echo $useImageAsCover ? 'background: url('.$product_image.') center center/cover no-repeat' : '' ?>">
						<div class="border-radius w-100 h-100 overflow-hidden vehicle-teaser-column" style="background-color: <?php echo $bg1 ?>">
							<div class="col-6 h-100">
								<img src="<?php echo $product_image ?>" class="">
							</div>
							<div class="col-6 h-100 vehicle-teaser-column-right">
								<h4><?php echo get_theme_mod("$section.pl.$k.setting_title_$i", $product['title']) ?></h4>
								<a href="<?php echo $cta_link ?>" class="btn btn-light"><?php echo $cta_label ?></a>
							</div>
						</div>
					</div>
					<?php else: ?>
					<div class="d-flex border-radius overflow-hidden" style="<?php echo $useImageAsCover ? 'background: url('.$product_image.') center center/cover no-repeat' : '' ?>">
						<a class="w-100 h-100 no-underline" href="<?php echo $cta_link ?>">
							<div class="border-radius w-100 h-100 overflow-hidden" style="background-color: <?php echo $bg2 ?>">
								<div class="col-12 pb-3 pt-4 vehicle-teaser-head-line" style="background-color: <?php echo $bg1 ?>">
									<div class="richtext">
										<h4><?php echo get_theme_mod("$section.pl.$k.setting_title_$i", $product['title']) ?></h4>
									</div>
								</div>
								<div class="position-relative">
									<div class="vehicle-teaser-bg" style="background-color: <?php echo $bg1 ?>"></div>
									<div class="py-lg-4 px-4 pb-4 pt-0">
										<div class="vehicle-teaser-img-container">
											<?php if(!$useImageAsCover): ?>
											<img src="<?php echo $product_image ?>" class="vehicle-teaser-img">
											<?php endif; ?>
										</div>
									</div>
								</div>
							</div>
						</a>
					</div>
					<?php endif; ?>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
	</section>
	<?php
	return ob_get_clean();
}

function section_single($section, $i, $items) {
	ob_start();
	?>
	<section class="teaser d-flex justify-content-center align-items-center flex-row text-center">
		<div class="col-12 col-outer my-md-9 my-5">
			<div class="row">
				<div class="col-12 col-lg-8 flex-column d-flex mx-auto text-center">
					<div class="mb-3">
						<h3><?php echo get_theme_mod("$section.sl_setting_title_$i", $items['sl']['title']) ?></h3>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-lg-8 flex-column d-flex teaser-title mx-auto text-center">
					<p class="mb-sm-5 teaser-description mb-3"><?php echo get_theme_mod("$section.sl_setting_desc_$i", $items['sl']['desc']) ?></p>
				</div>
			</div>
			<?php if (!empty(get_theme_mod("$section.sl_setting_cta_label_$i", $items['sl']['cta_label']))): ?>
			<div class="row">
				<div class="col-12 col-md-4 col-xl-4 flex-column d-flex mx-auto mt-3 text-center">
					<a href="<?php echo get_theme_mod("$section.sl_setting_cta_link_$i", $items['sl']['cta_link']) ?>" class="w-100 btn btn-outline-dark btn-lg"><?php echo get_theme_mod("$section.sl_setting_cta_label_$i", $items['sl']['cta_label']) ?></a>
				</div>
			</div>
			<?php endif; ?> 
		</div>
	</section>

	<?php
	return ob_get_clean();
}

function section_video($section, $i, $items) {
	ob_start();
	$video = get_theme_mod("$section.video_$i", ($items['video'] ?? ''));
	?>
	<section>
		<?php if (!empty($video)): ?>
		<video class="sm-media" src="<?php echo $video ?>" playsinline="" loop="loop" autoplay="autoplay" muted="muted"></video>
		<?php endif; ?>
	</section>

	<?php
	return ob_get_clean();
}

function section_image($section, $i, $items) {
	ob_start();
	$image = get_theme_mod("$section.image_$i", ($items['image'] ?? ''));
	?>
	<section class="section-image">
		<?php if (!empty($image)): ?>
		<img src="<?php echo $image; ?>" alt="">
		<?php endif; ?>
	</section>

	<?php
	return ob_get_clean();
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

require get_template_directory() . '/inc/galaxy-sleep-customizer.php';
new GalaxySleep_Customizer();

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}