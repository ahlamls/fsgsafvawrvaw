<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Galaxy_Sleep
 */

get_header();

$filter_in_stock = $_GET['filter_in_stock'] ?? "";
$filter_out_stock = $_GET['filter_out_stock'] ?? "";
$filter_min_price = $_GET['filter_min_price'] ?? "";
$filter_max_price = $_GET['filter_max_price'] ?? "";
$sort = $_GET['sort'] ?? "relevance";
$has_filter = !empty($filter_in_stock) || !empty($filter_out_stock) || !empty($filter_min_price) || !empty($filter_max_price);
$max_price = 10000;
?>
<main id="primary" class="site-main">
    <form id="form-search" role="search" method="get" action="<?php echo site_url(); ?>">
        <div class="form-search">
            <div class="form-search-content">
                <input id="input-search" type="search" class="search-field" placeholder="Shop durchsuchen" value="<?php echo get_search_query() ?>" name="s">
                <button type="submit" class="search-submit">
                    <svg role="presentation" stroke-width="1.6" focusable="false" width="22" height="22" class="icon icon-search" viewBox="0 0 22 22">
                        <circle cx="11" cy="10" r="7" fill="none" stroke="currentColor"></circle>
                        <path d="m16 15 3 3" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </button>
            </div>
        </div>
        <div class="search-content">
            <?php if(have_posts() || $has_filter): ?>
            <div class="search-filter">
                <div class="sf-wrapper">
                    <div class="sf-section fn-collapse">
                        <div class="sf-label">Verfügbarkeit</div>
                        <div class="sf-content">
                            <div class="sf-inside">
                                <label class="sf-checkbox" for="filter_in_stock">
                                    <input id="filter_in_stock" name="filter_in_stock" type="checkbox" <?php echo !empty($filter_in_stock) ? 'checked' : '' ?> data-fcv="filter_in_stock">
                                    <span class="sfc-icon"></span><span class="sfc-text">Auf Lager</span>
                                </label>
                                <label class="sf-checkbox" for="filter_out_stock">
                                    <input id="filter_out_stock" name="filter_out_stock" type="checkbox" <?php echo !empty($filter_out_stock) ? 'checked' : '' ?> data-fcv="filter_out_stock">
                                    <span class="sfc-icon"></span><span class="sfc-text">Nicht vorrätig</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="sf-section fn-collapse">
                        <div class="sf-label">Preis</div>
                        <div class="sf-content">
                            <div class="sf-inside fn-slider-range" data-slider-maximum="<?php echo $max_price ?>">
                                <div class="sf-price">
                                    <div class="sfp-input">
                                        <span class="sfp-label">CHF</span>
                                        <input type="text" name="filter_min_price" value="<?php echo !empty($filter_min_price) ? intval($filter_min_price) : "" ?>" class="fn-numeric" placeholder="0" data-slider-min data-fcv="filter_price">
                                    </div>
                                    <div class="sfp-sep"></div>
                                    <div class="sfp-input">
                                        <span class="sfp-label">CHF</span>
                                        <input type="text" name="filter_max_price" value="<?php echo !empty($filter_max_price) ? intval($filter_max_price) : "" ?>" class="fn-numeric" placeholder="<?php echo $max_price ?>" data-slider-max data-fcv="filter_price">
                                    </div>
                                </div>
                                <div class="sf-price-slider">
                                    <div data-slider-range></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sf-section fn-collapse">
                        <div class="sf-label">Sortieren nach</div>
                        <div class="sf-content">
                            <div class="sf-inside">
                                <label class="sf-checkbox" for="filter-3">
                                    <input id="filter-3" type="radio" name="sort" value="relevance" <?php echo ($sort == 'relevance') ? 'checked' : '' ?>>
                                    <span class="sfc-icon"></span><span class="sfc-text">Relevanz</span>
                                </label>
                                <label class="sf-checkbox" for="filter-4">
                                    <input id="filter-4" type="radio" name="sort" value="min_price" <?php echo ($sort == 'min_price') ? 'checked' : '' ?>>
                                    <span class="sfc-icon"></span><span class="sfc-text">Preis (aufsteigend)</span>
                                </label>
                                <label class="sf-checkbox" for="filter-5">
                                    <input id="filter-5" type="radio" name="sort" value="max_price" <?php echo ($sort == 'max_price') ? 'checked' : '' ?>>
                                    <span class="sfc-icon"></span><span class="sfc-text">Preis (absteigend)</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sf-nav">
                    <button class="sfn-open fn-search-nav" type="button">Filter anzeigen</button>
                    <button class="sfn-close fn-search-nav" type="button">Filter schliessen</button>
                </div>
            </div>
            <div id="search-result" class="search-result">
                <div id="search-result-content">
                <?php if($has_filter): ?>
                    <div class="sr-filter">
                        <?php if(!empty($filter_in_stock)): ?>
                            <div class="srf-item fn-filter-control" data-fc="filter_in_stock">Auf Lager </div>
                        <?php endif ?>
                        <?php if(!empty($filter_out_stock)): ?>
                            <div class="srf-item fn-filter-control" data-fc="filter_out_stock">Nicht vorrätig </div>
                        <?php endif ?>
                        <?php if(!empty($filter_min_price) || !empty($filter_max_price)): ?>
                            <div class="srf-item fn-filter-control" data-fc="filter_price">
                            CHF <?php echo !empty($filter_min_price) ? number_format($filter_min_price, 2, '.', ',') : '0.00' ?>
                            -
                            CHF <?php echo !empty($filter_max_price) ? number_format($filter_max_price, 2, '.', ',') : number_format($max_price, 2, '.', ',') ?> 
                            </div>
                        <?php endif ?>
                        <div class="srf-item srf-clear fn-filter-control" data-fc="all">Alles löschen</div>
                    </div>
                <?php endif ?>
                <?php if(have_posts()): ?>
                    <div class="sr-content">
                        <ul class="products">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php if ('product' == get_post_type()): $product = wc_get_product(get_the_ID());?>
                                <?php if(function_exists('wc_get_template_part')) wc_get_template_part( 'content', 'product' ); ?>
                            <?php endif ?>
                        <?php endwhile; ?>
                        </ul>
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php if ('product' != get_post_type()): ?>
                            <div class="sr-item">
                                <div class="sr-title"><?php the_title(); ?></div>
                                <div class="sr-link"><a href="<?php echo get_permalink() ?>">Weiterlesen →</a></div>
                            </div>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <div class="sr-noresult"><p>Keine Treffer</p></div>
                <?php endif ?>
                </div>
            </div>
            <?php elseif(!empty(get_search_query())): ?>
                <div class="sc-noresult"><p>Keine Treffer</p></div>
            <?php endif ?>
        </div>
    </form>
</main>
<?php
get_sidebar();
get_footer();
