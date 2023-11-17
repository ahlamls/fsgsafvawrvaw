<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Galaxy_Sleep
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function galaxy_sleep_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			// 'thumbnail_image_width' => 150,
			// 'single_image_width'    => 300,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 3,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'galaxy_sleep_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function galaxy_sleep_woocommerce_scripts() {
	wp_enqueue_style( 'galaxy_sleep-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), _S_VERSION );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'galaxy_sleep-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'galaxy_sleep_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function galaxy_sleep_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'galaxy_sleep_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function galaxy_sleep_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 4,
		'columns'        => 4,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'galaxy_sleep_woocommerce_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'galaxy_sleep_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function galaxy_sleep_woocommerce_wrapper_before() {
		?>
			<main id="primary" class="site-main">
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'galaxy_sleep_woocommerce_wrapper_before' );

if ( ! function_exists( 'galaxy_sleep_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function galaxy_sleep_woocommerce_wrapper_after() {
		?>
			</main><!-- #main -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'galaxy_sleep_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'galaxy_sleep_woocommerce_header_cart' ) ) {
			galaxy_sleep_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'galaxy_sleep_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function galaxy_sleep_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		galaxy_sleep_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'galaxy_sleep_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'galaxy_sleep_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function galaxy_sleep_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'galaxy_sleep' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'galaxy_sleep' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'galaxy_sleep_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function galaxy_sleep_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php galaxy_sleep_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
remove_action( 'woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title', 10 );

function gs_product_detail_category_class($classes) {
	if(!(is_product() && is_single())) return $classes;
	$product = wc_get_product();
	$categories = get_the_terms($product->get_id(), 'product_cat');
	foreach ($categories as $category) $classes[] = "product-cat-".$category->slug;
	return $classes;
}

add_filter('body_class', 'gs_product_detail_category_class',10,2);

function gs_product_category_color(){
	$categories = get_terms('product_cat');
	echo '<style>';
	foreach($categories as $category){
		$color = get_theme_mod("section_product_category_setting_color_$category->slug", "#f6f4f1");
		if(is_product() && is_single()){
			$product = wc_get_product();
			$attribute_color = $product->get_attribute('theme_color');
			if(!empty($attribute_color)) $color = $attribute_color;
		}
		echo "[class*=-".$category->slug."]{ --woc-product-category-color:".$color."}";
	}
	echo '</style>';
}

add_action( 'wp_head', 'gs_product_category_color', 10, 0 );

function gs_loop_product_name() {
	$product_names = explode(' ', get_the_title());
	$product_names[0] = '<span>'.$product_names[0].'</span>';
	$product_name = implode(' ', $product_names);
	echo '<h2 class="' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">' . $product_name . '</h2>';
}

add_action('woocommerce_shop_loop_item_title', 'gs_loop_product_name', 10 );
add_action('woocommerce_template_single_title', 'gs_loop_product_name', 10 );

function gs_loop_product_color() {
	$product = wc_get_product();
	$categories = get_the_terms($product->get_id(), 'product_cat');
	$color = "";
	foreach($categories as $category){
		$color = get_theme_mod("section_product_category_setting_color_$category->slug", "#f6f4f1");
	}
	$attribute_color = $product->get_attribute('theme_color');
	if(!empty($attribute_color)) $color = $attribute_color;
	if(empty($color)) return;
	echo "<style>.post-".$product->get_id()."{ --woc-product-category-color:".$color."}</style>";
}

add_action('woocommerce_before_shop_loop_item', 'gs_loop_product_color', 10 );

function gs_loop_product_info() {
	global $product;
	$text = $product->get_short_description();
	if(!empty($text)) echo '<div class="product-info">'.$product->get_short_description().'</div>';
}

add_action('woocommerce_after_shop_loop_item', 'gs_loop_product_info', 10 );

function gs_onsale($text) {
    global $product;
	$regular_price = $product->get_regular_price(); 
	$sale_price = $product->get_sale_price();
	if ($product->is_type('variable')) {
		$prices = $product->get_variation_prices( true );
		if (!empty( $prices['price'] ) ) {
			if($product->is_on_sale()){
				$sale_price = current( $prices['sale_price'] );
				$regular_price = current( $prices['regular_price'] );
			}
		}
    }
	$discount_percentage = ($regular_price > 0) ? round((($regular_price - $sale_price) / $regular_price) * 100) : 0;
    return '<span class="onsale">Galaxy <b>'.$discount_percentage.'%</b></span>';  
}
add_filter('woocommerce_sale_flash', 'gs_onsale');

function gs_loop_product_monthly_price() {
	// global $product;
	// $price = $product->get_price();
    // if ($product->is_type('variable')) {
	// 	$prices = $product->get_variation_prices( true );
	// 	if (!empty( $prices['price'] ) ) {
	// 		if($product->is_on_sale()){
	// 			$price = current($prices['sale_price']);
	// 		} else {
	// 			$price = current($prices['price']);
	// 		}
	// 	}
    // }
	// <div class="mp-price">'.round($price/48).'</div>
    echo '<div class="monthly-price">
		<div class="mp-ab">ab</div>
		<div class="mp-price">0</div>
		<div class="mp-currency"><b>'.get_woocommerce_currency().'</b><span>Monat</span></div>
	</div>';
}
add_action('woocommerce_after_shop_loop_item_title', 'gs_loop_product_monthly_price', 8);

// function gs_loop_product_price($price, $product) {
//     if ($product->is_type('variable')) {
// 		$prices = $product->get_variation_prices( true );
// 		if (!empty( $prices['price'] ) ) {
// 			if($product->is_on_sale()){
// 				$min_sale_price = current( $prices['sale_price'] );
// 				$min_reg_price = current( $prices['regular_price'] );
// 				$price = wc_format_sale_price( wc_price( $min_reg_price ), wc_price( $min_sale_price ) );
// 			} else {
// 				$price = wc_price(current($prices['price']));
// 			}
// 		}
//     }
//     return $price;
// }

// add_filter('woocommerce_get_price_html', 'gs_loop_product_price', 10, 2);

function gs_product_detail_price() {
	global $product;
    echo 
	'<div class="monthly-info">
		<div class="mi-price">
			<div class="mip-text">Deine Monatsrate</div>
			<div class="mip-price">
				<div id="monthly-price" class="mp-price">'.round($product->get_price()/48).'</div>
				<div class="mp-currency"><b>'.get_woocommerce_currency().'</b><span>Monat</span></div>
			</div>
		</div>
		<div class="mi-option">
			<table class="mi-option-table"><tbody><tr>
				<th class="label"><label>Laufzeit</label></th>
				<td class="value">
					<select id="monthly-option">
						<option value="12">12 Monate</option>
						<option value="24">24 Monate</option>
						<option value="48" selected>48 Monate</option>
					</select>
				</td>
			</tr></tbody></table>
		</div>
	</div>';
    echo 
	'<div class="price-info">
		<div class="pi-text">Galaxy Preis</div>
		<div class="pi-price">'.$product->get_price_html().'</div>
	</div>';
}
add_action('woocommerce_after_add_to_cart_quantity', 'gs_product_detail_price', 8);

function gs_product_detail_term_info() {
    echo '<div class="term-info">Inkl. 7,7 % Mwst</div>';
}
add_action('woocommerce_after_add_to_cart_button', 'gs_product_detail_term_info', 8);

function gs_show_all_products_in_category($query) {
    if (is_product_category() && $query->is_main_query()) {
        $query->set('posts_per_page', -1);
    }
}

add_action('pre_get_posts', 'gs_show_all_products_in_category');

function gs_get_media_categories($id){
	$media_categories = [];
	$categories = get_the_terms($id, 'product_cat');
	foreach ($categories as $category){
		$media_category = get_theme_mod("section_product_category_setting_media_category_$category->slug");
		if(empty($media_category)) continue;
		$media_categories = array_merge($media_categories,explode(',',$media_category));
	}
	$items = [];
	foreach($media_categories as $category){
		$content = gs_get_media_category($category);
		if($content == null) continue;
		$items[] = $content;
	}
	return $items;
}

function gs_get_media_category($category){
	$term = get_term_by('slug', $category, 'media_category');
	if($term == false) return null;
	$args = array(
		'post_type'      => 'attachment',
		'post_status'    => 'inherit',
		'posts_per_page' => -1,
		'tax_query'      => array(
			array(
				'taxonomy' => 'media_category',
				'field'    => 'term_id',
				'terms'    => $term->term_id,
			),
		),
	);
	$attachment = new WP_Query($args);
	return (object) [
		'term' => $term,
		'posts' => $attachment->posts,
	];
}