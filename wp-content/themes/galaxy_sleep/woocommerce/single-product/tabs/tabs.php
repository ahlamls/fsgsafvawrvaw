<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );
$media_categories = gs_get_media_categories(get_the_id());
$field_prefix = 'detail-';
$custom_fields = get_post_meta(get_the_ID());
if ( ! empty( $product_tabs ) ) : ?>

	<div class="woocommerce-tabs wc-tabs-wrapper">
		<ul class="tabs wc-tabs" role="tablist">
			<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
				<li class="<?php echo esc_attr( $key ); ?>_tab" id="tab-title-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
					<a href="#tab-<?php echo esc_attr( $key ); ?>">
						<?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?>
					</a>
				</li>
			<?php endforeach; ?>
            <?php foreach($media_categories as $media_category): ?>
                <li class="material_tab" id="tab-title-<?php echo $media_category->term->slug ?>" role="tab" aria-controls="tab-<?php echo $media_category->term->slug ?>">
                    <a href="#tab-<?php echo $media_category->term->slug ?>"><?php echo str_replace('Product - ','',$media_category->term->name) ?></a>
                </li>
            <?php endforeach ?>
		</ul>
		<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
			<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content wc-tab" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
               <?php if($key == 'description'): ?>
                <div class="woc-detail row">
                <?php foreach($custom_fields as $field_key => $field_value): ?>
                <?php if(strpos($field_key, $field_prefix) === false) continue;  $field_label = str_replace($field_prefix, '', $field_key); ?>
                    <div class="wd-item col-12 col-md-6">
                        <div class="wd-content">
                            <div class="wd-label"><?php echo $field_label ?></div>
                            <div class="wd-value"><?php echo $field_value[0] ?></div>
                        </div>
                    </div>
                <?php endforeach ?>
                </div>
               <?php endif ?>
				<?php
				if ( isset( $product_tab['callback'] ) ) {
					call_user_func( $product_tab['callback'], $key, $product_tab );
				}
				?>
			</div>
		<?php endforeach; ?>
        <?php foreach($media_categories as $media_category): ?>
			<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo $media_category->term->slug ?> panel entry-content wc-tab" id="tab-<?php echo $media_category->term->slug ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo $media_category->term->slug ?>">
                <div class="woc-media-category row no-gutters">
                <?php foreach($media_category->posts as $attachment): $image_url = wp_get_attachment_url($attachment->ID);?>
                    <div class="wmc-item <?php echo $media_category->term->description ?>">
                        <div class="wmc-content">
                            <div class="wmc-image"><img src="<?php echo esc_url($image_url) ?>" alt=""></div>
                            <div class="wmc-text"><?php echo $attachment->post_title ?></div>
                        </div>
                    </div>
                <?php endforeach ?>
                </div>
			</div>
        <?php endforeach ?>
		<?php do_action( 'woocommerce_product_after_tabs' ); ?>
	</div>

<?php endif; ?>
