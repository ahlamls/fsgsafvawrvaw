<?php /* Template Name: Über uns Template */ ?>
<?php get_header(); ?>
    <?php $section_name = 'section_about_us'; ?>
    <?php $section = gs_get_content($section_name) ?? []; ?>
    <?php foreach($section as $i => $items): ?>
        <?php 
            $type = get_theme_mod($section_name."_setting_type_$i", $items['type'] ?? null);
        ?>
        <?php if (!empty($type)): ?>
            <?php if ($type == 'two_column'): ?>
                <?php echo section_two_column($section_name, $i, $items) ?>
            <?php elseif ($type == 'product_list'): ?>
                <?php echo section_product_list($section_name, $i, $items) ?>
            <?php elseif ($type == 'single'): ?>
                <?php echo section_single($section_name, $i, $items) ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>
<?php get_footer(); ?>