<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Galaxy_Sleep
 */

get_header();
?>

	<main id="primary" class="site-main">
		<section class="error-404 not-found">
			<div class="row no-gutters">
				<div class="col-12 col-md-6 bg-brick blocky-group d-flex">
					<div class="block-media-text">
						<h1><b>Oops,</b></h1>
						<h1>page gone.</h1>
						<div class="row w-100 no-gutters">
							<a title="Zur Startseite" href="<?php echo esc_url( home_url( '/' ) ); ?>" class=" mt-4 col-12 col-md-8 mx-auto btn btn-bright btn-lg">Back to home</a>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6 bg-pale-brick blocky-group d-flex justify-content-center align-items-center text-center">
					<div>
						<h3><b>404 failure</b>.</h3>
						<p><span class="lead">Page cannot be found.</span></p>
					</div>
				</div>
			</div>
		</section>
	</main><!-- #main -->

<?php
get_footer();
