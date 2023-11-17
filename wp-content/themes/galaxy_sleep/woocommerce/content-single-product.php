<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
$featured_image_id = $product->get_image_id();
$featured_image_url = wp_get_attachment_image_url($featured_image_id, 'full');
$product_names = explode(' ', $product->get_title());
$product_names[0] = '<span>'.$product_names[0].'</span>';
$product_name = implode(' ', $product_names);
$product_short_description = $product->get_short_description();
?>
<div class="product-header">
    <div class="product-header-image">
        <?php if($featured_image_url): ?>
            <img src="<?php echo esc_url($featured_image_url) ?>" alt="">
        <?php endif ?>
    </div>
    <div class="product-header-title">
        <h2><?php echo $product_name ?></h2>
        <?php if(!empty($product_short_description)): ?>
            <div class="product-header-info"><?php echo $product->get_short_description(); ?></div>
        <?php endif ?>
    </div>
    <?php if($product->is_on_sale()): ?>
        <?php woocommerce_show_product_sale_flash(); ?>
    <?php endif ?>
</div>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
    <div class="row product-detail-column">
        <div class="col-12 col-md-6 col-lg-8 product-detail-gallery">
            <?php
            /**
             * Hook: woocommerce_before_single_product_summary.
             *
             * @hooked woocommerce_show_product_sale_flash - 10
             * @hooked woocommerce_show_product_images - 20
             */
            do_action( 'woocommerce_before_single_product_summary' );
            ?>
            <?php
            /**
             * Hook: woocommerce_after_single_product_summary.
             *
             * @hooked woocommerce_output_product_data_tabs - 10
             * @hooked woocommerce_upsell_display - 15
             * @hooked woocommerce_output_related_products - 20
             */
            do_action( 'woocommerce_after_single_product_summary' );
            ?>
        </div>
        <div class="col-12 col-md-6 col-lg-4 product-detail-summary">
            <div class="product-detail-content">
                <div class="summary entry-summary">
                    <div class="product-detail-title">
                        <h2><?php echo $product_name ?></h2>
                    </div>
                    <?php
                    /**
                     * Hook: woocommerce_single_product_summary.
                     *
                     * @hooked woocommerce_template_single_title - 5
                     * @hooked woocommerce_template_single_rating - 10
                     * @hooked woocommerce_template_single_price - 10
                     * @hooked woocommerce_template_single_excerpt - 20
                     * @hooked woocommerce_template_single_add_to_cart - 30
                     * @hooked woocommerce_template_single_meta - 40
                     * @hooked woocommerce_template_single_sharing - 50
                     * @hooked WC_Structured_Data::generate_product_data() - 60
                     */
                    do_action( 'woocommerce_single_product_summary' );
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div><?php woocommerce_output_related_products() ?></div>
</div>
<div class="product-faq-section">
    <?php 
        $section_product_faq = gs_get_content('section_product_faq'); 
        $section_product_faq_title = get_theme_mod("section_product_faq.setting_title", $section_product_faq['title']);
        $section_product_faq_titles = explode(' ', $section_product_faq_title);
        $section_product_faq_titles[0] = '<span>'.$section_product_faq_titles[0].'</span>';
        $section_product_faq_title = implode(' ', $section_product_faq_titles);
    ?>
    <section>
        <div class="row no-gutters">
            <div class="col-12 col-md-6 blocky-group d-flex" style="background-color: <?php echo get_theme_mod("section_product_faq.setting_bgc", $section_product_faq['bg_color']) ?>">
                <div class="p-4 p-md-5 block-media-text">
                    <h2><?php echo $section_product_faq_title; ?></h2>
                    <div class="row">
                        <div class="col-12 col-lg-8 flex-column d-flex mx-auto mt-3 text-center">
                            <div class="w-100 btn btn-bright btn-lg mt-4"><?php echo get_theme_mod("section_product_faq.setting_label", $section_product_faq['label']) ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 d-flex align-items-center p-0 d-flex" style="background-color: <?php echo get_theme_mod("section_product_faq.setting_bgc2", $section_product_faq['bg_color_2']) ?>">
                <div class="d-flex block flex-column second-block justify-content-center align-items-center flex-fill col-outer py-5">
                    <div class="mt-5 d-block position-relative w-100">
                        <?php
                            $items = gs_get_content("section_product_faq.items");
                            $accordion_right_id = "accordion_right";
                        ?>
                        <div class="accordion accordion-with-icon" id="<?php echo $accordion_right_id ?>">
                            <?php foreach ($items as $i => $item): ?>
                                <?php 
                                    $accordion_item_id = "collapse-right-$i"; 
                                    $heading_id = "heading-right-$i";
                                    $accordion_item_title = get_theme_mod("section_product_faq.setting_title_accordion.$i", $item['title']);
                                ?>
                                <?php if (!empty($accordion_item_title)): ?>
                                <div class="accordion-item">
                                    <div class="accordion-header" id="<?php echo $heading_id ?>">
                                        <div role="button" class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#<?php echo $accordion_item_id ?>" aria-expanded="true" aria-controls="<?php echo $accordion_item_id ?>">
                                            <div class="d-flex w-100 justify-content-between align-items-center flex-row">
                                                <div class="d-flex align-items-center">
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
                                            <p><?php echo get_theme_mod("section_product_faq.setting_desc_accordion.$i", $item['desc']) ?></p>
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
        </div>
    </section>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
