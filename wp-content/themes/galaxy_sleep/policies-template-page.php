<?php /* Template Name: Policies Template */ ?>
<?php get_header(); ?>
    <section>
        <div class="row no-gutters">
            <div class="col-12 col-md-6 blocky-group d-flex bg-stone">
                <div class="p-4 p-md-5 block-policies title-section text-center">
                    <?php the_title( '<h3 class="sticky-title"><b>', '</b></h3>' ); ?>
                </div>
            </div>
            <div class="col-12 col-md-6 blocky-group d-flex bg-pale-stone">
                <div class="p-4 p-md-5 block-policies">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>