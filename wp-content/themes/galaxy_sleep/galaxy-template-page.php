<?php /* Template Name: Galaxy Page Template */ ?>
<?php get_header(); ?>
    <?php $section_name = get_post_meta(get_the_ID(), 'section_name', TRUE); ?>
    <?php if(!empty($section_name) && $section_name): ?>
        <?php $section = gs_get_content($section_name) ?? []; ?>
        <?php foreach($section as $i => $items): ?>
            <?php 
                $type = get_theme_mod($section_name."_setting_type_$i", $items['type'] ?? null);
            ?>
            <?php if (!empty($type)): ?>
                <?php if ($type == 'two_column'): ?>
                    <?php echo section_two_column($section_name, $i, $items) ?>
                <?php elseif ($type == 'product_list'): ?>
                    <?php 
                        $prevItemType = '';
                        if (isset($section[$i-1])) {
                            $prevI = $i - 1;
                            $prevItem = $section[$prevI];
                            $prevItemType = get_theme_mod($section_name."_setting_type_$prevI", $prevItem['type'] ?? null);
                        }
                    ?>
                    <?php echo section_product_list($section_name, $i, $items, $prevItemType) ?>
                <?php elseif ($type == 'single'): ?>
                    <?php echo section_single($section_name, $i, $items) ?>
                <?php elseif ($type == 'video'): ?>
                    <?php echo section_video($section_name, $i, $items) ?>
                <?php elseif ($type == 'image'): ?>
                    <?php echo section_image($section_name, $i, $items) ?>
                <?php endif; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
<?php get_footer(); ?>