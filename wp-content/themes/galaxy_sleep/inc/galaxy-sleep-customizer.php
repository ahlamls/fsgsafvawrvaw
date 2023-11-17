<?php
/**
 * Customize Theme
 */
class GalaxySleep_Customizer {
    
    public function __construct() {
        add_action('customize_register', array($this, 'register_customize_sections'));
        add_action( 'customize_controls_print_scripts', array( $this, 'gs_add_scripts' ), 30 );
    }

    public function register_customize_sections($wp_customize) {

        /**
         * Section Product Category Colors
         */
        $this->section_product_category($wp_customize);

        /**
         * Section Product FAQ
         */
        $this->section_product_faq($wp_customize);

        /**
         * Section Product Category Colors
         */
        $this->section_banner($wp_customize);

        $template_sections = [
            ['title' => 'Home Section', 'key' => 'section_home', 'priority' => 101],
            ['title' => 'Über uns Section', 'key' => 'section_about_us', 'priority' => 102],
            ['title' => 'FAQ & Kontak Section', 'key' => 'section_faq_contact', 'priority' => 102],
            ['title' => 'Store Section', 'key' => 'section_store', 'priority' => 102],
            ['title' => 'Order Online Section', 'key' => 'section_order_online', 'priority' => 102],
            ['title' => 'Partner Section', 'key' => 'section_partner', 'priority' => 102],
            ['title' => 'Showroom Section', 'key' => 'section_showroom', 'priority' => 102],
        ];

        foreach ($template_sections as $section) {
            $this->define_section($wp_customize, $section['title'], $section['key'], $section['priority']);
        }

        /**
         * Section Home
         */
        // $this->section_home($wp_customize);

        /**
         * Section Über uns 
         */
        // $this->section_about_us($wp_customize);

        /**
         * Section store
         */

        // $this->section_store($wp_customize);

        /**
         * Section Footer
         */
        $this->section_footer($wp_customize);
    }

    private function section_product_category($wp_customize){
        /**
         * Section Footer: Contact
         */
        $wp_customize->add_section('section_product_category', array(
            'title'   		=> "Product Category",
            'panel'         => 'woocommerce',
            'priority'      => 11,
        ));

        $categories = get_terms('product_cat');
        foreach($categories as $category){
            $wp_customize->add_setting("section_product_category_setting_color_$category->slug", array(
                'default'           => '#f6f4f1',
            ));
            $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "section_product_category_control_color_$category->slug", array(
                'label' => "$category->name Color:",
                'section' => 'section_product_category',
                'settings' => "section_product_category_setting_color_$category->slug",
                'type' => 'color',
            )));
            $wp_customize->add_setting("section_product_category_setting_media_category_$category->slug", array(
                'default'           => '',
            ));
            $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "section_product_category_control_media_category_$category->slug", array(
                'label' => "$category->name Media Categories (comma separated):",
                'section' => 'section_product_category',
                'settings' => "section_product_category_setting_media_category_$category->slug",
                'type' => 'text',
            )));
        }
    }

    private function section_product_faq($wp_customize){

        /**
         * Define Section Menu
         */
        $section = "section_product_faq";
        $wp_customize->add_section($section, array(
            'title'   		=> "Product FAQ",
            'panel'         => 'woocommerce',
            'priority'      => 12,
        ));

        /**
         * Title
         */
        $wp_customize->add_setting("$section.setting_title", array(
            'default'           => gs_get_content("$section.title"),
        ));
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "$section.control.title", array(
            'label' => "Title",
            'section' => $section,
            'settings' => "$section.setting_title",
            'type' => 'text',
        )));
        
        /**
         * Label
         */
        $wp_customize->add_setting("$section.setting_label", array(
            'default'           => gs_get_content("$section.label"),
        ));
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "$section.control.label", array(
            'label' => "Label",
            'section' => $section,
            'settings' => "$section.setting_label",
            'type' => 'text',
        )));
        
        /**
         * Background Color
         */
        $wp_customize->add_setting("$section.setting_bgc", array(
            'default'   => gs_get_content("$section.bg_color"),
        ) );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "$section.control.bgc", array(
            'label'    => "Background Color",
            'section'  => $section,
            'settings' => "$section.setting_bgc",
        )));
        
        /**
         * Background Color 2
         */
        $wp_customize->add_setting("$section.setting_bgc2", array(
            'default'   => gs_get_content("$section.bg_color_2"),
        ) );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "$section.control.bgc2", array(
            'label'    => "Background Color 2",
            'section'  => $section,
            'settings' => "$section.setting_bgc2",
        )));

        $items = gs_get_content("$section.items");
        
        foreach ($items as $i => $item) {
            $no = $i+1;
            /**
             * Title
             */
            $wp_customize->add_setting("$section.setting_title_accordion.$i", array(
                'default'           => gs_get_content("$section.items.$i.title"),
            ));
            $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "$section.control.title_accordion.$i", array(
                'label' => "Item $no Title",
                'section' => $section,
                'settings' => "$section.setting_title_accordion.$i",
                'type' => 'text',
            )));
        
            /**
             * Description
             */
            $wp_customize->add_setting("$section.setting_desc_accordion.$i", array(
                'default'           => gs_get_content("$section.items.$i.desc"),
            ));
            $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "$section.control.desc_accordion.$i", array(
                'label' => "Item $no Description",
                'section' => $section,
                'settings' => "$section.setting_desc_accordion.$i",
                'type' => 'textarea',
            )));
        
        }
    }

    private function section_banner($wp_customize) {
        /**
         * Define Panel Menu
         */
        $wp_customize->add_section('section_banner', array(
			'title'   		=> 'Banner',
			'priority'		=> 100,
        ));

        /**
         * Checkbox show
         */
        $wp_customize->add_setting('section_banner_setting_show', array(
            'default'           => gs_get_content("section_banner.show"),
            'sanitize_callback' => 'gs_sanitize_checkbox',
        ));
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "section_banner_control_show", array(
            'label' => 'Show Banner',
            'section' => 'section_banner',
            'settings' => 'section_banner_setting_show',
            'type' => 'checkbox',
        )));

        /**
         * Title
         */
        $wp_customize->add_setting("section_banner_setting_title", array(
            'default'           => gs_get_content("section_banner.title"),
        ));
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "section_banner_control_title", array(
            'label' => "Title:",
            'section' => 'section_banner',
            'settings' => "section_banner_setting_title",
            'type' => 'text',
        )));

        /**
         * CTA Label
         */
        $wp_customize->add_setting("section_banner_setting_cta_label", array(
            'default'           => gs_get_content("section_banner.cta_label"),
        ));
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "section_banner_control_cta_label", array(
            'label' => "CTA Label:",
            'section' => 'section_banner',
            'settings' => "section_banner_setting_cta_label",
            'type' => 'text',
        )));

         /**
         * CTA Link
         */
        $wp_customize->add_setting("section_banner_setting_cta_link", array(
            'default'           => gs_get_content("section_banner.cta_link"),
        ));
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "section_banner_control_cta_link", array(
            'label' => "CTA Link:",
            'section' => 'section_banner',
            'settings' => "section_banner_setting_cta_link",
            'type' => 'text',
        )));

        /**
         * Background Color
         */
        $wp_customize->add_setting("section_banner_setting_bgc", array(
            'default'   => gs_get_content("section_banner.bg_color"),
        ) );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "section_banner_control_bgc", array(
            'label'    => "Background Color:",
            'section'  => 'section_banner',
            'settings' => "section_banner_setting_bgc",
        )));


    }

    private function section_home($wp_customize){

        /**
         * Define Panel Menu
         */
        $wp_customize->add_panel('section_home', array(
			'title'   		=> 'Home Sections',
			'priority'		=> 101,
        ));

        
        $section_home = gs_get_content('section_home');

        foreach($section_home as $i => $item){
            $no = $i+1;
            /**
             * Define Section Menu
             */
            $section = "section_home_$i";
            $wp_customize->add_section($section, array(
                'title'   		=> "Section $no",
                'panel'         => 'section_home'
            ));

            /**
             * Type
             */
            $setting_type = "section_home_setting_type_$i";
            $wp_customize->add_setting($setting_type, array(
                'default'           => gs_get_content("section_home.$i.type"),
            ));
            $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "section_home_control_type_$i", array(
                'label' => 'Type',
                'section' => $section,
                'settings' => $setting_type,
                'type' => 'select',
                'choices' => ['' => '','two_column' => '2 Column Layout', 'product_list' => 'Product List', 'single' => 'Single Layout']
            )));

            
            
            $this->two_column_layout($wp_customize, $section, 'section_home', $i, "left", $setting_type);
            $this->two_column_layout($wp_customize, $section, 'section_home', $i, "right", $setting_type);
            $this->product_list($wp_customize, $section, 'section_home', $i, $setting_type);
            $this->single_layout($wp_customize, $section, 'section_home', $i, $setting_type);
            
        }
    }

    private function section_about_us($wp_customize){

        /**
         * Define Panel Menu
         */
        $wp_customize->add_panel('section_about_us', array(
			'title'   		=> 'Über uns Sections',
			'priority'		=> 102,
        ));

        
        $section_about_us = gs_get_content('section_about_us');

        foreach($section_about_us as $i => $item){
            $no = $i+1;
            /**
             * Define Section Menu
             */
            $section = "section_about_us_$i";
            $wp_customize->add_section($section, array(
                'title'   		=> "Section $no",
                'panel'         => 'section_about_us'
            ));

            /**
             * Type
             */
            $setting_type = "section_about_us_setting_type_$i";
            $wp_customize->add_setting($setting_type, array(
                'default'           => gs_get_content("section_about_us.$i.type"),
            ));
            $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "section_about_us_control_type_$i", array(
                'label' => 'Type',
                'section' => $section,
                'settings' => $setting_type,
                'type' => 'select',
                'choices' => ['' => '','two_column' => '2 Column Layout', 'product_list' => 'Product List', 'single' => 'Single Layout']
            )));

            
            
            $this->two_column_layout($wp_customize, $section, 'section_about_us', $i, "left", $setting_type);
            $this->two_column_layout($wp_customize, $section, 'section_about_us', $i, "right", $setting_type);
            $this->product_list($wp_customize, $section, 'section_about_us', $i, $setting_type);
            $this->single_layout($wp_customize, $section, 'section_about_us', $i, $setting_type);   
        }
    }

    private function define_section($wp_customize, $title, $key, $priority = 101) {
        /**
         * Define Panel Menu
         */
        $wp_customize->add_panel($key, array(
			'title'   		=> $title,
			'priority'		=> $priority,
        ));

        
        $section_content = gs_get_content($key);

        foreach($section_content as $i => $item){
            $no = $i+1;
            /**
             * Define Section Menu
             */
            $section = $key."_$i";
            $wp_customize->add_section($section, array(
                'title'   		=> "Section $no",
                'panel'         => $key
            ));

            /**
             * Type
             */
            $setting_type = $key."_setting_type_$i";
            $wp_customize->add_setting($setting_type, array(
                'default'           => gs_get_content($key.".$i.type"),
            ));
            $wp_customize->add_control( new WP_Customize_Control( $wp_customize, $key."_control_type_$i", array(
                'label' => 'Type',
                'section' => $section,
                'settings' => $setting_type,
                'type' => 'select',
                'choices' => ['' => '', 'two_column' => '2 Column Layout', 'product_list' => 'Product List', 'single' => 'Single Layout', 'video' => 'Video', 'image' => 'Image']
            )));

            $this->two_column_layout($wp_customize, $section, $key, $i, "left", $setting_type);
            $this->two_column_layout($wp_customize, $section, $key, $i, "right", $setting_type);
            $this->product_list($wp_customize, $section, $key, $i, $setting_type);
            $this->single_layout($wp_customize, $section, $key, $i, $setting_type);
            $this->video_layout($wp_customize, $section, $key, $i, $setting_type);
            $this->image_layout($wp_customize, $section, $key, $i, $setting_type);
            
        }
    }

    private function two_column_layout($wp_customize, $parent_section, $section_prefix, $i, $position, $setting_type) {

        $position_title = $position == 'left' ? 'Left' : 'Right';
        
        /**
         * Type
         */
        $setting_position_type = "$section_prefix.tc.$position.setting_type_$i";
        $wp_customize->add_setting($setting_position_type, array(
            'default'           => gs_get_content("$section_prefix.$i.tc.$position.type"),
        ));
        $choices = ['text' => 'Text', 'text_logo' => 'Text with Logo', 'image' => 'Image', 'video' => 'Video', 'accordion' => 'Accordion Layout', 'icon_text' => 'Icon with text'];
        if ($position == 'right' && $section_prefix == 'section_faq_contact') {
            $choices['form_contact'] = 'Form Contact';
        }
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "$section_prefix.control_tc.$position.type_$i", array(
            'label' => "[$position_title]: Type",
            'section' => $parent_section,
            'settings' => $setting_position_type,
            'type' => 'select',
            'choices' => $choices,
            'active_callback' => function () use ($setting_type, $setting_position_type) {
                return get_theme_mod($setting_type, "") == 'two_column';
            },
        )));
        
        /**
         * Title
         */
        $wp_customize->add_setting("$section_prefix.tc.$position.setting_title_$i", array(
            'default'           => gs_get_content("$section_prefix.$i.tc.$position.text.title"),
        ));
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "$section_prefix.control_tc.$position.title_$i", array(
            'label' => "$position_title: Title",
            'section' => $parent_section,
            'settings' => "$section_prefix.tc.$position.setting_title_$i",
            'type' => 'text',
            'active_callback' => function () use ($setting_type, $setting_position_type) {
                return get_theme_mod($setting_type, "") == 'two_column' && get_theme_mod($setting_position_type, "") == 'text';
            },
        )));
        
        /**
         * Description
         */
        $wp_customize->add_setting("$section_prefix.tc.$position.setting_desc_$i", array(
            'default'           => gs_get_content("$section_prefix.$i.tc.$position.text.desc"),
        ));
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "$section_prefix.control_tc.$position.desc_$i", array(
            'label' => "$position_title: Description",
            'section' => $parent_section,
            'settings' => "$section_prefix.tc.$position.setting_desc_$i",
            'type' => 'textarea',
            'active_callback' => function () use ($setting_type, $setting_position_type) {
                return get_theme_mod($setting_type, "") == 'two_column' && get_theme_mod($setting_position_type, "") == 'text';
            },
        )));
        
        /**
         * CTA Label
         */
        $wp_customize->add_setting("$section_prefix.tc.$position.setting_cta_label_$i", array(
            'default'           => gs_get_content("$section_prefix.$i.tc.$position.text.cta_label"),
        ));
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "$section_prefix.control_tc.$position.cta_label_$i", array(
            'label' => "$position_title: CTA Label",
            'section' => $parent_section,
            'settings' => "$section_prefix.tc.$position.setting_cta_label_$i",
            'type' => 'text',
            'active_callback' => function () use ($setting_type, $setting_position_type) {
                return get_theme_mod($setting_type, "") == 'two_column' && get_theme_mod($setting_position_type, "") == 'text';
            },
        )));
        
        /**
         * CTA Link
         */
        $wp_customize->add_setting("$section_prefix.tc.$position.setting_cta_link_$i", array(
            'default'           => gs_get_content("$section_prefix.$i.tc.$position.text.cta_link"),
        ));
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "$section_prefix.control_tc.$position.cta_link_$i", array(
            'label' => "$position_title: CTA Link",
            'section' => $parent_section,
            'settings' => "$section_prefix.tc.$position.setting_cta_link_$i",
            'type' => 'url',
            'active_callback' => function () use ($setting_type, $setting_position_type) {
                return get_theme_mod($setting_type, "") == 'two_column' && get_theme_mod($setting_position_type, "") == 'text';
            },
        )));
        
        /**
         * Background Color
         */
        $wp_customize->add_setting("$section_prefix.tc.$position.setting_bgc_$i", array(
            'default'   => gs_get_content("$section_prefix.$i.tc.$position.text.bg_color"),
        ) );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "$section_prefix.control_tc.$position.bgc_$i", array(
            'label'    => "$position_title: Background Color",
            'section'  => $parent_section,
            'settings' => "$section_prefix.tc.$position.setting_bgc_$i",
            'active_callback' => function () use ($setting_type, $setting_position_type) {
                return get_theme_mod($setting_type, "") == 'two_column' && get_theme_mod($setting_position_type, "") == 'text';
            },
        )));
        
        /**
         * Image
         */
        $wp_customize->add_setting("$section_prefix.tc.$position.setting_image_$i", array(
            'default'           => gs_get_content("$section_prefix.$i.tc.$position.image"),
            'sanitize_callback' => 'gs_media_url',
        ));
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, "$section_prefix.control_tc.$position.image_$i", array(
            'label' => "$position_title: Image",
            'section' => $parent_section,
            'settings' => "$section_prefix.tc.$position.setting_image_$i",
            'mime_type' => 'image',
            'active_callback' => function () use ($setting_type, $setting_position_type) {
                return get_theme_mod($setting_type, "") == 'two_column' && get_theme_mod($setting_position_type, "") == 'image';
            },
        )));

        $setting_image_type = "$section_prefix.tc.$position.setting_image_type_$i";
        $wp_customize->add_setting($setting_image_type, array(
            'default'   => gs_get_content("$section_prefix.$i.tc.$position.image_type"),
        ) );
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "$section_prefix.control_tc.$position.image_type_$i", array(
            'label' => "[$position_title]: Image Background Type",
            'section' => $parent_section,
            'settings' => $setting_image_type,
            'type' => 'select',
            'choices' => ['cover' => 'Cover', 'contain' => 'Contain'],
            'active_callback' => function () use ($setting_type, $setting_position_type) {
                return get_theme_mod($setting_type, "") == 'two_column' && get_theme_mod($setting_position_type, "") == 'image';
            },
        )));

        /**
         * Image Bg Color
         */
        $wp_customize->add_setting("$section_prefix.tc.$position.setting_image_bgc_$i", array(
            'default'   => gs_get_content("$section_prefix.$i.tc.$position.image_bgc"),
        ) );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "$section_prefix.control_tc.$position.image_bgc_$i", array(
            'label'    => "$position_title: Image Background Color",
            'section'  => $parent_section,
            'settings' => "$section_prefix.tc.$position.setting_image_bgc_$i",
            'active_callback' => function () use ($setting_type, $setting_position_type, $setting_image_type) {
                return get_theme_mod($setting_type, "") == 'two_column' && get_theme_mod($setting_position_type, "") == 'image' && get_theme_mod($setting_image_type, "") == 'contain';
            },
        )));

        
        
        /**
         * Video
         */
        $wp_customize->add_setting("$section_prefix.tc.$position.setting_video_$i", array(
            'default'           => gs_get_content("$section_prefix.$i.tc.$position.video"),
            'sanitize_callback' => 'gs_media_url',
        ));
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, "$section_prefix.control_tc.$position.video_$i", array(
            'label' => "$position_title: Video",
            'section' => $parent_section,
            'settings' => "$section_prefix.tc.$position.setting_video_$i",
            'mime_type' => 'video',
            'active_callback' => function () use ($setting_type, $setting_position_type) {
                return get_theme_mod($setting_type, "") == 'two_column' && get_theme_mod($setting_position_type, "") == 'video';
            },
        )));
        
        /**
         * Accordion Layout
         */
        
        /**
         * Title
         */
        $wp_customize->add_setting("$section_prefix.tc.$position.setting_title_accordion_$i", array(
            'default'           => gs_get_content("$section_prefix.$i.tc.$position.accordion.title"),
        ));
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "$section_prefix.control_tc.$position.title_accordion_$i", array(
            'label' => "$position_title: Accordion Title",
            'section' => $parent_section,
            'settings' => "$section_prefix.tc.$position.setting_title_accordion_$i",
            'type' => 'text',
            'active_callback' => function () use ($setting_type, $setting_position_type) {
                return get_theme_mod($setting_type, "") == 'two_column' && get_theme_mod($setting_position_type, "") == 'accordion';
            },
        )));
        
        $accordions = gs_get_content("$section_prefix.$i.tc.$position.accordion.items");
        
        /**
         * Background Color
         */
        $wp_customize->add_setting("$section_prefix.tc.$position.setting_bgc_accordion_$i", array(
            'default'   => gs_get_content("$section_prefix.$i.tc.$position.accordion.bg_color"),
        ) );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "$section_prefix.control_tc.$position.bgc_accordion_$i", array(
            'label'    => "$position_title: Accordion Background Color",
            'section'  => $parent_section,
            'settings' => "$section_prefix.tc.$position.setting_bgc_accordion_$i",
            'active_callback' => function () use ($setting_type, $setting_position_type) {
                return get_theme_mod($setting_type, "") == 'two_column' && get_theme_mod($setting_position_type, "") == 'accordion';
            },
        )));
        
        foreach ($accordions as $j => $items) {
            $no = $j+1;
            /**
             * Image Logo
             */
            $wp_customize->add_setting("$section_prefix.tc.$position.setting_logo_accordion.$j._$i", array(
                'default'           => gs_get_content("$section_prefix.$i.tc.$position.accordion.items.$j.logo"),
                'sanitize_callback' => 'gs_media_url',
            ));
            $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, "$section_prefix.control_tc.$position.logo_accordion.$j._$i", array(
                'label' => "$position_title: Accordion $no Logo ",
                'section' => $parent_section,
                'settings' => "$section_prefix.tc.$position.setting_logo_accordion.$j._$i",
                'mime_type' => 'image',
                'active_callback' => function () use ($setting_type, $setting_position_type) {
                    return get_theme_mod($setting_type, "") == 'two_column' && get_theme_mod($setting_position_type, "") == 'accordion';
                },
            )));
        
            /**
             * Logo Background Color
             */
            $wp_customize->add_setting("$section_prefix.tc.$position.setting_logo_bgc_accordion.$j._$i", array(
                'default'   => gs_get_content("$section_prefix.$i.tc.$position.accordion.items.$j.logo_bg_color"),
            ) );
            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "$section_prefix.control_tc.$position.logo_bgc_accordion.$j._$i", array(
                'label'    => "$position_title: Accordion $no Logo Background Color",
                'section'  => $parent_section,
                'settings' => "$section_prefix.tc.$position.setting_logo_bgc_accordion.$j._$i",
                'active_callback' => function () use ($setting_type, $setting_position_type) {
                    return get_theme_mod($setting_type, "") == 'two_column' && get_theme_mod($setting_position_type, "") == 'accordion';
                },
            )));
        
            /**
             * Title
             */
            $wp_customize->add_setting("$section_prefix.tc.$position.setting_title_accordion.$j._$i", array(
                'default'           => gs_get_content("$section_prefix.$i.tc.$position.accordion.items.$j.title"),
            ));
            $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "$section_prefix.control_tc.$position.title_accordion.$j._$i", array(
                'label' => "$position_title: Accordion $no Title",
                'section' => $parent_section,
                'settings' => "$section_prefix.tc.$position.setting_title_accordion.$j._$i",
                'type' => 'text',
                'active_callback' => function () use ($setting_type, $setting_position_type) {
                    return get_theme_mod($setting_type, "") == 'two_column' && get_theme_mod($setting_position_type, "") == 'accordion';
                },
            )));
        
            /**
             * Description
             */
            $wp_customize->add_setting("$section_prefix.tc.$position.setting_desc_accordion.$j._$i", array(
                'default'           => gs_get_content("$section_prefix.$i.tc.$position.accordion.items.$j.desc"),
            ));
            $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "$section_prefix.control_tc.$position.desc_accordion.$j._$i", array(
                'label' => "$position_title: Accordion $no Description",
                'section' => $parent_section,
                'settings' => "$section_prefix.tc.$position.setting_desc_accordion.$j._$i",
                'type' => 'textarea',
                'active_callback' => function () use ($setting_type, $setting_position_type) {
                    return get_theme_mod($setting_type, "") == 'two_column' && get_theme_mod($setting_position_type, "") == 'accordion';
                },
            )));
        
        }

        /**
         * Icon with Text
         */
        $icons_text = gs_get_content("$section_prefix.$i.tc.$position.icon_text.items");

        /**
         * Background Color
         */
        $wp_customize->add_setting("$section_prefix.tc.$position.setting_bgc_icon_text_$i", array(
            'default'   => gs_get_content("$section_prefix.$i.tc.$position.icon_text.bg_color"),
        ) );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "$section_prefix.control_tc.$position.bgc_icon_text_$i", array(
            'label'    => "$position_title: Icon with Text Background Color",
            'section'  => $parent_section,
            'settings' => "$section_prefix.tc.$position.setting_bgc_icon_text_$i",
            'active_callback' => function () use ($setting_type, $setting_position_type) {
                return get_theme_mod($setting_type, "") == 'two_column' && get_theme_mod($setting_position_type, "") == 'icon_text';
            },
        )));
        
        foreach ($icons_text as $j => $items) {
            $no = $j+1;
            /**
             * Image icon
             */
            $wp_customize->add_setting("$section_prefix.tc.$position.setting_icon_text_image.$j._$i", array(
                'default'           => gs_get_content("$section_prefix.$i.tc.$position.icon_text.items.$j.image"),
                'sanitize_callback' => 'gs_media_url',
            ));
            $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, "$section_prefix.control_tc.$position.icon_text_image.$j._$i", array(
                'label' => "$position_title: Icon with Text $no Image ",
                'section' => $parent_section,
                'settings' => "$section_prefix.tc.$position.setting_icon_text_image.$j._$i",
                'mime_type' => 'image',
                'active_callback' => function () use ($setting_type, $setting_position_type) {
                    return get_theme_mod($setting_type, "") == 'two_column' && get_theme_mod($setting_position_type, "") == 'icon_text';
                },
            )));

        
            /**
             * Title
             */
            $wp_customize->add_setting("$section_prefix.tc.$position.setting_title_icon_text.$j._$i", array(
                'default'           => gs_get_content("$section_prefix.$i.tc.$position.icon_text.items.$j.title"),
            ));
            $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "$section_prefix.control_tc.$position.title_icon_text.$j._$i", array(
                'label' => "$position_title: Icon with Text $no Title",
                'section' => $parent_section,
                'settings' => "$section_prefix.tc.$position.setting_title_icon_text.$j._$i",
                'type' => 'text',
                'active_callback' => function () use ($setting_type, $setting_position_type) {
                    return get_theme_mod($setting_type, "") == 'two_column' && get_theme_mod($setting_position_type, "") == 'icon_text';
                },
            )));
        
            /**
             * Description
             */
            $wp_customize->add_setting("$section_prefix.tc.$position.setting_desc_icon_text.$j._$i", array(
                'default'           => gs_get_content("$section_prefix.$i.tc.$position.icon_text.items.$j.desc"),
            ));
            $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "$section_prefix.control_tc.$position.desc_icon_text.$j._$i", array(
                'label' => "$position_title: Icon with Text $no Description",
                'section' => $parent_section,
                'settings' => "$section_prefix.tc.$position.setting_desc_icon_text.$j._$i",
                'type' => 'textarea',
                'active_callback' => function () use ($setting_type, $setting_position_type) {
                    return get_theme_mod($setting_type, "") == 'two_column' && get_theme_mod($setting_position_type, "") == 'icon_text';
                },
            )));

            /**
             * CTA Label
             */
            $wp_customize->add_setting("$section_prefix.tc.$position.setting_cta_label_icon_text.$j._$i", array(
                'default'           => gs_get_content("$section_prefix.$i.tc.$position.icon_text.items.$j.cta_label"),
            ));
            $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "$section_prefix.control_tc.$position.cta_label_icon_text.$j._$i", array(
                'label' => "$position_title: Icon with Text $no CTA Label",
                'section' => $parent_section,
                'settings' => "$section_prefix.tc.$position.setting_cta_label_icon_text.$j._$i",
                'type' => 'text',
                'active_callback' => function () use ($setting_type, $setting_position_type) {
                    return get_theme_mod($setting_type, "") == 'two_column' && get_theme_mod($setting_position_type, "") == 'icon_text';
                },
            )));

            /**
             * CTA Link
             */
            $wp_customize->add_setting("$section_prefix.tc.$position.setting_cta_link_icon_text.$j._$i", array(
                'default'           => gs_get_content("$section_prefix.$i.tc.$position.icon_text.items.$j.cta_link"),
            ));
            $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "$section_prefix.control_tc.$position.cta_link_icon_text.$j._$i", array(
                'label' => "$position_title: Icon with Text $no CTA Link",
                'section' => $parent_section,
                'settings' => "$section_prefix.tc.$position.setting_cta_link_icon_text.$j._$i",
                'type' => 'text',
                'active_callback' => function () use ($setting_type, $setting_position_type) {
                    return get_theme_mod($setting_type, "") == 'two_column' && get_theme_mod($setting_position_type, "") == 'icon_text';
                },
            )));

            /**
             * Form Contact
             */
            if ($position == 'right' && $section_prefix == 'section_faq_contact') {
                /**
                 * Title
                 */
                $wp_customize->add_setting("$section_prefix.tc.$position.setting_title_form_contact_$i", array(
                    'default'           => gs_get_content("$section_prefix.$i.tc.$position.form_contact.title"),
                ));
                $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "$section_prefix.control_tc.$position.title_form_contact_$i", array(
                    'label' => "$position_title: Form Contact Title",
                    'section' => $parent_section,
                    'settings' => "$section_prefix.tc.$position.setting_title_form_contact_$i",
                    'type' => 'text',
                    'active_callback' => function () use ($setting_type, $setting_position_type) {
                        return get_theme_mod($setting_type, "") == 'two_column' && get_theme_mod($setting_position_type, "") == 'form_contact';
                    },
                )));

                /**
                 * Desc
                 */
                $wp_customize->add_setting("$section_prefix.tc.$position.setting_desc_form_contact_$i", array(
                    'default'           => gs_get_content("$section_prefix.$i.tc.$position.form_contact.desc"),
                ));
                $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "$section_prefix.control_tc.$position.desc_form_contact_$i", array(
                    'label' => "$position_title: Form Contact Description",
                    'section' => $parent_section,
                    'settings' => "$section_prefix.tc.$position.setting_desc_form_contact_$i",
                    'type' => 'textarea',
                    'active_callback' => function () use ($setting_type, $setting_position_type) {
                        return get_theme_mod($setting_type, "") == 'two_column' && get_theme_mod($setting_position_type, "") == 'form_contact';
                    },
                )));

                /**
                 * Background Color
                 */
                $wp_customize->add_setting("$section_prefix.tc.$position.setting_bgc_form_contact_$i", array(
                    'default'   => gs_get_content("$section_prefix.$i.tc.$position.form_contact.bg_color"),
                ) );
                $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "$section_prefix.control_tc.$position.bgc_form_contact_$i", array(
                    'label'    => "$position_title: Form Contact Background Color",
                    'section'  => $parent_section,
                    'settings' => "$section_prefix.tc.$position.setting_bgc_form_contact_$i",
                    'active_callback' => function () use ($setting_type, $setting_position_type) {
                        return get_theme_mod($setting_type, "") == 'two_column' && get_theme_mod($setting_position_type, "") == 'form_contact';
                    },
                )));

                /**
                 * Base Color
                 */
                $wp_customize->add_setting("$section_prefix.tc.$position.setting_bgc2_form_contact_$i", array(
                    'default'   => gs_get_content("$section_prefix.$i.tc.$position.form_contact.bg_color2"),
                ) );
                $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "$section_prefix.control_tc.$position.bgc2_form_contact_$i", array(
                    'label'    => "$position_title: Form Contact Base Color",
                    'section'  => $parent_section,
                    'settings' => "$section_prefix.tc.$position.setting_bgc2_form_contact_$i",
                    'active_callback' => function () use ($setting_type, $setting_position_type) {
                        return get_theme_mod($setting_type, "") == 'two_column' && get_theme_mod($setting_position_type, "") == 'form_contact';
                    },
                )));

                /**
                 * Form Shortcode
                 */
                $wp_customize->add_setting("$section_prefix.tc.$position.setting_shortcode_form_contact_$i", array(
                    'default'           => gs_get_content("$section_prefix.$i.tc.$position.form_contact.shortcode"),
                ));
                $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "$section_prefix.control_tc.$position.shortcode_form_contact_$i", array(
                    'label' => "$position_title: Form Contact Shortcode",
                    'section' => $parent_section,
                    'settings' => "$section_prefix.tc.$position.setting_shortcode_form_contact_$i",
                    'type' => 'text',
                    'active_callback' => function () use ($setting_type, $setting_position_type) {
                        return get_theme_mod($setting_type, "") == 'two_column' && get_theme_mod($setting_position_type, "") == 'form_contact';
                    },
                )));

                /**
                 * Image
                 */
                $wp_customize->add_setting("$section_prefix.tc.$position.setting_logo_form_contact_$i", array(
                    'default'           => gs_get_content("$section_prefix.$i.tc.$position.logo"),
                    'sanitize_callback' => 'gs_media_url',
                ));
                $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, "$section_prefix.control_tc.$position.logo_form_contact_$i", array(
                    'label' => "$position_title: Form Contact Logo",
                    'section' => $parent_section,
                    'settings' => "$section_prefix.tc.$position.setting_logo_form_contact_$i",
                    'mime_type' => 'image',
                    'active_callback' => function () use ($setting_type, $setting_position_type) {
                        return get_theme_mod($setting_type, "") == 'two_column' && get_theme_mod($setting_position_type, "") == 'form_contact';
                    },
                )));

                /**
                 * Logo Title 
                 */
                $wp_customize->add_setting("$section_prefix.tc.$position.setting_logo_title_form_contact_$i", array(
                    'default'           => gs_get_content("$section_prefix.$i.tc.$position.form_contact.logo_title"),
                ));
                $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "$section_prefix.control_tc.$position.logo_title_form_contact_$i", array(
                    'label' => "$position_title: Form Contact Logo Title",
                    'section' => $parent_section,
                    'settings' => "$section_prefix.tc.$position.setting_logo_title_form_contact_$i",
                    'type' => 'text',
                    'active_callback' => function () use ($setting_type, $setting_position_type) {
                        return get_theme_mod($setting_type, "") == 'two_column' && get_theme_mod($setting_position_type, "") == 'form_contact';
                    },
                )));

                /**
                 * Logo CTA Label 
                 */
                $wp_customize->add_setting("$section_prefix.tc.$position.setting_cta_label_form_contact_$i", array(
                    'default'           => gs_get_content("$section_prefix.$i.tc.$position.form_contact.cta_label"),
                ));
                $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "$section_prefix.control_tc.$position.cta_label_form_contact_$i", array(
                    'label' => "$position_title: Form Contact Logo CTA Label",
                    'section' => $parent_section,
                    'settings' => "$section_prefix.tc.$position.setting_cta_label_form_contact_$i",
                    'type' => 'text',
                    'active_callback' => function () use ($setting_type, $setting_position_type) {
                        return get_theme_mod($setting_type, "") == 'two_column' && get_theme_mod($setting_position_type, "") == 'form_contact';
                    },
                )));

                /**
                 * Logo CTA Link
                 */
                $wp_customize->add_setting("$section_prefix.tc.$position.setting_cta_link_form_contact_$i", array(
                    'default'           => gs_get_content("$section_prefix.$i.tc.$position.form_contact.cta_link"),
                ));
                $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "$section_prefix.control_tc.$position.cta_link_form_contact_$i", array(
                    'label' => "$position_title: Form Contact Logo CTA Link",
                    'section' => $parent_section,
                    'settings' => "$section_prefix.tc.$position.setting_cta_link_form_contact_$i",
                    'type' => 'text',
                    'active_callback' => function () use ($setting_type, $setting_position_type) {
                        return get_theme_mod($setting_type, "") == 'two_column' && get_theme_mod($setting_position_type, "") == 'form_contact';
                    },
                )));
                
            }
        
        }
        
        /**
         * Text with Logo
         */
        
        /**
         * Logo
         */
        $wp_customize->add_setting("$section_prefix.tc.$position.setting_tl_logo_$i", array(
            'default'           => gs_get_content("$section_prefix.$i.tc.$position.text_logo.logo"),
            'sanitize_callback' => 'gs_media_url',
        ));
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, "$section_prefix.control_tc.$position.tl_logo_$i", array(
            'label' => "$position_title: Logo",
            'section' => $parent_section,
            'settings' => "$section_prefix.tc.$position.setting_tl_logo_$i",
            'mime_type' => 'image',
            'active_callback' => function () use ($setting_type, $setting_position_type) {
                return get_theme_mod($setting_type, "") == 'two_column' && get_theme_mod($setting_position_type, "") == 'text_logo';
            },
        )));
        
        /**
         * Text
         */
        $wp_customize->add_setting("$section_prefix.tc.$position.setting_tl_title_$i", array(
            'default'           => gs_get_content("$section_prefix.$i.tc.$position.text_logo.title"),
        ));
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "$section_prefix.control_tc.$position.tl_title_$i", array(
            'label' => "$position_title: Title",
            'section' => $parent_section,
            'settings' => "$section_prefix.tc.$position.setting_tl_title_$i",
            'type' => 'text',
            'active_callback' => function () use ($setting_type, $setting_position_type) {
                return get_theme_mod($setting_type, "") == 'two_column' && get_theme_mod($setting_position_type, "") == 'text_logo';
            },
        )));
        
        
        /**
         * CTA Label
         */
        $wp_customize->add_setting("$section_prefix.tc.$position.setting_tl_cta_label_$i", array(
            'default'           => gs_get_content("$section_prefix.$i.tc.$position.text_logo.cta_label"),
        ));
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "$section_prefix.control_tc.$position.tl_cta_label_$i", array(
            'label' => "$position_title: CTA Label",
            'section' => $parent_section,
            'settings' => "$section_prefix.tc.$position.setting_tl_cta_label_$i",
            'type' => 'text',
            'active_callback' => function () use ($setting_type, $setting_position_type) {
                return get_theme_mod($setting_type, "") == 'two_column' && get_theme_mod($setting_position_type, "") == 'text_logo';
            },
        )));
        
        /**
         * CTA Link
         */
        $wp_customize->add_setting("$section_prefix.tc.$position.setting_tl_cta_link_$i", array(
            'default'           => gs_get_content("$section_prefix.$i.tc.$position.text_logo.cta_link"),
        ));
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "$section_prefix.control_tc.$position.tl_cta_link_$i", array(
            'label' => "$position_title: CTA Link",
            'section' => $parent_section,
            'settings' => "$section_prefix.tc.$position.setting_tl_cta_link_$i",
            'type' => 'url',
            'active_callback' => function () use ($setting_type, $setting_position_type) {
                return get_theme_mod($setting_type, "") == 'two_column' && get_theme_mod($setting_position_type, "") == 'text_logo';
            },
        )));
        
        /**
         * Background Color
         */
        $wp_customize->add_setting("$section_prefix.tc.$position.setting_tl_bgc_$i", array(
            'default'   => gs_get_content("$section_prefix.$i.tc.$position.text_logo.bg_color"),
        ) );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "$section_prefix.control_tc.$position.tl_bgc_$i", array(
            'label'    => "$position_title: Background Color",
            'section'  => $parent_section,
            'settings' => "$section_prefix.tc.$position.setting_tl_bgc_$i",
            'active_callback' => function () use ($setting_type, $setting_position_type) {
                return get_theme_mod($setting_type, "") == 'two_column' && get_theme_mod($setting_position_type, "") == 'text_logo';
            },
        )));
    }
        
    private function product_list($wp_customize, $parent_section, $section_prefix, $i, $setting_type) {
        
        /**
         * Title
         */
        $wp_customize->add_setting("$section_prefix.pl_setting_title_$i", array(
            'default'           => gs_get_content("$section_prefix.$i.pl.title"),
        ));
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "$section_prefix.control_pl_title_$i", array(
            'label' => "Title",
            'section' => $parent_section,
            'settings' => "$section_prefix.pl_setting_title_$i",
            'type' => 'text',
            'active_callback' => function () use ($setting_type) {
                return get_theme_mod($setting_type, "") == 'product_list';
            },
        )));
        
        /**
         * Product loop
         */
        $products = gs_get_content("$section_prefix.$i.pl.items");
        foreach ($products as $j => $item) {
            $no = $j+1;
            /**
             * Product: Title
             */
            $wp_customize->add_setting("$section_prefix.pl.$j.setting_title_$i", array(
                'default'           => gs_get_content("$section_prefix.$i.pl.items.$j.title"),
            ));
            $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "$section_prefix.control_pl.$j.title_$i", array(
                'label' => "Product $no: Title",
                'section' => $parent_section,
                'settings' => "$section_prefix.pl.$j.setting_title_$i",
                'type' => 'text',
                'active_callback' => function () use ($setting_type) {
                    return get_theme_mod($setting_type, "") == 'product_list';
                },
            )));
        
            /**
             * Product: Image
             */
            $wp_customize->add_setting("$section_prefix.pl.$j.setting_image_$i", array(
                'default'           => gs_get_content("$section_prefix.$i.pl.items.$j.image"),
                'sanitize_callback' => 'gs_media_url',
            ));
            $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, "$section_prefix.control_pl.$j.image_$i", array(
                'label' => "Product $no: Image",
                'section' => $parent_section,
                'settings' => "$section_prefix.pl.$j.setting_image_$i",
                'mime_type' => 'image',
                'active_callback' => function () use ($setting_type) {
                    return get_theme_mod($setting_type, "") == 'product_list';
                },
            )));

            /**
             * CTA Label
             */
            if($j == 5) {
                $wp_customize->add_setting("$section_prefix.pl.$j.setting_cta_label_$i", array(
                    'default'           => gs_get_content("$section_prefix.$i.pl.items.$j.cta_label"),
                ));
                $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "$section_prefix.control_pl.$j.cta_label_$i", array(
                    'label' => "Product $no: CTA Label",
                    'section' => $parent_section,
                    'settings' => "$section_prefix.pl.$j.setting_cta_label_$i",
                    'type' => 'url',
                    'active_callback' => function () use ($setting_type) {
                        return get_theme_mod($setting_type, "") == 'product_list';
                    },
                )));
            }
        
            /**
             * CTA Link
             */
            $wp_customize->add_setting("$section_prefix.pl.$j.setting_cta_link_$i", array(
                'default'           => gs_get_content("$section_prefix.$i.pl.items.$j.cta_link"),
            ));
            $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "$section_prefix.control_pl.$j.cta_link_$i", array(
                'label' => "Product $no: CTA Link",
                'section' => $parent_section,
                'settings' => "$section_prefix.pl.$j.setting_cta_link_$i",
                'type' => 'url',
                'active_callback' => function () use ($setting_type) {
                    return get_theme_mod($setting_type, "") == 'product_list';
                },
            )));
        
            /**
             * Background Color 1
             */
            $wp_customize->add_setting("$section_prefix.pl.$j.setting_bgc1_$i", array(
                'default'   => gs_get_content("$section_prefix.$i.pl.items.$j.bg_color_1"),
            ) );
            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "$section_prefix.control_pl.$j.bgc1_$i", array(
                'label'    => "Product $no: Background Color 1",
                'section'  => $parent_section,
                'settings' => "$section_prefix.pl.$j.setting_bgc1_$i",
                'active_callback' => function () use ($setting_type) {
                    return get_theme_mod($setting_type, "") == 'product_list';
                },
            )));
            /**
             * Background Color 2
             */

            if($j != 5) {
                $wp_customize->add_setting("$section_prefix.pl.$j.setting_bgc2_$i", array(
                    'default'   => gs_get_content("$section_prefix.$i.pl.items.$j.bg_color_2"),
                ) );
                $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "$section_prefix.control_pl.$j.bgc2_$i", array(
                    'label'    => "Product $no: Background Color 2",
                    'section'  => $parent_section,
                    'settings' => "$section_prefix.pl.$j.setting_bgc2_$i",
                    'active_callback' => function () use ($setting_type) {
                        return get_theme_mod($setting_type, "") == 'product_list';
                    },
                )));
            }
        }
    }
            
    private function single_layout($wp_customize, $parent_section, $section_prefix, $i, $setting_type) {
        /**
         * Title
         */
        $wp_customize->add_setting("$section_prefix.sl_setting_title_$i", array(
            'default'           => gs_get_content("$section_prefix.$i.sl.title"),
        ));
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "$section_prefix.control_sl_title_$i", array(
            'label' => "Title",
            'section' => $parent_section,
            'settings' => "$section_prefix.sl_setting_title_$i",
            'type' => 'text',
            'active_callback' => function () use ($setting_type) {
                return get_theme_mod($setting_type, "") == 'single';
            },
        )));
        
        /**
         * Title
         */
        $wp_customize->add_setting("$section_prefix.sl_setting_desc_$i", array(
            'default'           => gs_get_content("$section_prefix.$i.sl.desc"),
        ));
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "$section_prefix.control_sl_desc_$i", array(
            'label' => "Description",
            'section' => $parent_section,
            'settings' => "$section_prefix.sl_setting_desc_$i",
            'type' => 'textarea',
            'active_callback' => function () use ($setting_type) {
                return get_theme_mod($setting_type, "") == 'single';
            },
        )));
        
        /**
         * CTA Label
         */
        $wp_customize->add_setting("$section_prefix.sl_setting_cta_label_$i", array(
            'default'           => gs_get_content("$section_prefix.$i.sl.cta_label"),
        ));
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "$section_prefix.control_sl_cta_label_$i", array(
            'label' => "CTA Label",
            'section' => $parent_section,
            'settings' => "$section_prefix.sl_setting_cta_label_$i",
            'type' => 'text',
            'active_callback' => function () use ($setting_type) {
                return get_theme_mod($setting_type, "") == 'single';
            },
        )));
        
        /**
         * CTA Link
         */
        $wp_customize->add_setting("$section_prefix.sl_setting_cta_link_$i", array(
            'default'           => gs_get_content("$section_prefix.$i.sl.cta_link"),
        ));
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "$section_prefix.control_sl_cta_link_$i", array(
            'label' => "CTA Link",
            'section' => $parent_section,
            'settings' => "$section_prefix.sl_setting_cta_link_$i",
            'type' => 'url',
            'active_callback' => function () use ($setting_type) {
                return get_theme_mod($setting_type, "") == 'single';
            },
        )));
    }

    private function section_footer($wp_customize) {
        /**
         * Define Panel Menu
         */
        $wp_customize->add_panel('panel_footer', array(
			'title'   		=> 'Footer',
			'priority'		=> 110,
        ));

        /**
         * Section Footer: Contact
         */
        $wp_customize->add_section('section_footer_contact', array(
            'title'   		=> "Contact",
            'panel'         => 'panel_footer'
        ));

        /**
         * Title
         */
        $wp_customize->add_setting("section_footer_contact_setting_title", array(
            'default'           => gs_get_content("section_footer.contacts.title"),
        ));
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "section_footer_contact_control_title", array(
            'label' => "Title:",
            'section' => 'section_footer_contact',
            'settings' => "section_footer_contact_setting_title",
            'type' => 'text',
        )));


        $contacts = gs_get_content('section_footer.contacts.items');

        foreach ($contacts as $i => $contact) {
            $no = $i + 1;

            /**
             * Image Logo
             */
            $wp_customize->add_setting("section_footer_contact_setting_logo_$i", array(
                'default'           => gs_get_content("section_footer.contacts.items.$i.logo"),
                'sanitize_callback' => 'gs_media_url',
            ));
            $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, "section_footer_contact_control_logo_$i", array(
                'label' => "Logo $no:",
                'section' => 'section_footer_contact',
                'settings' => "section_footer_contact_setting_logo_$i",
                'mime_type' => 'image',
            )));

            /**
             * Title
             */
            $wp_customize->add_setting("section_footer_contact_setting_title_$i", array(
                'default'           => gs_get_content("section_footer.contacts.items.$i.title"),
            ));
            $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "section_footer_contact_control_title_$i", array(
                'label' => "Title $no:",
                'section' => 'section_footer_contact',
                'settings' => "section_footer_contact_setting_title_$i",
                'type' => 'text',
            )));

            /**
             * Desc
             */
            $wp_customize->add_setting("section_footer_contact_setting_desc_$i", array(
                'default'           => gs_get_content("section_footer.contacts.items.$i.desc"),
            ));
            $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "section_footer_contact_control_desc_$i", array(
                'label' => "Desc $no:",
                'section' => 'section_footer_contact',
                'settings' => "section_footer_contact_setting_desc_$i",
                'type' => 'textarea',
            )));

            /**
             * CTA Label
             */
            $wp_customize->add_setting("section_footer_contact_setting_cta_label_$i", array(
                'default'           => gs_get_content("section_footer.contacts.items.$i.cta_label"),
            ));
            $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "section_footer_contact_control_cta_label_$i", array(
                'label' => "CTA Label $no:",
                'section' => 'section_footer_contact',
                'settings' => "section_footer_contact_setting_cta_label_$i",
                'type' => 'text',
            )));

            /**
             * CTA Link
             */
            $wp_customize->add_setting("section_footer_contact_setting_cta_link_$i", array(
                'default'           => gs_get_content("section_footer.contacts.items.$i.cta_link"),
            ));
            $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "section_footer_contact_control_cta_link_$i", array(
                'label' => "CTA Link $no:",
                'section' => 'section_footer_contact',
                'settings' => "section_footer_contact_setting_cta_link_$i",
                'type' => 'url',
            )));
        }


        /**
         * Section Footer: Logo
         */
        $wp_customize->add_section('section_footer_logo', array(
            'title'   		=> "Logo",
            'panel'         => 'panel_footer'
        ));

        /**
         * Image Logo
         */
        $wp_customize->add_setting("section_footer_logo_setting_logo", array(
            'default'           => gs_get_content("section_footer.logo"),
            'sanitize_callback' => 'gs_media_url',
        ));
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, "section_footer_logo_control_logo", array(
            'label' => "Logo:",
            'section' => 'section_footer_logo',
            'settings' => "section_footer_logo_setting_logo",
            'mime_type' => 'image',
        )));

        /**
         * Section Footer: Newsletter
         */
        $wp_customize->add_section('section_footer_newsletter', array(
            'title'   		=> "Newsletter",
            'panel'         => 'panel_footer'
        ));

        /**
         * Footer Newsletter: Title
         */
        $wp_customize->add_setting("section_footer_newsletter_setting_title", array(
            'default'           => gs_get_content("section_footer.newsletter_title"),
        ));
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "section_footer_newsletter_control_title", array(
            'label' => "Title:",
            'section' => 'section_footer_newsletter',
            'settings' => "section_footer_newsletter_setting_title",
            'type' => 'text',
        )));

        $menus = gs_get_content("section_footer.menu.items");

        foreach ($menus as $i => $menu) {
            $no = $i + 1;
             /**
             * Section Footer: Menu
             */
            $wp_customize->add_section("section_footer_menu_$i", array(
                'title'   		=> "Menu $no",
                'panel'         => 'panel_footer'
            ));

            /**
             * Footer Menu: Title
             */
            $wp_customize->add_setting("section_footer_menu_setting_title_$i", array(
                'default'           => gs_get_content("section_footer.menu.items.$i.title"),
            ));
            $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "section_footer_menu_control_title_$i", array(
                'label' => "Title:",
                'section' => "section_footer_menu_$i",
                'settings' => "section_footer_menu_setting_title_$i",
                'type' => 'text',
            )));

            /**
             * Menu
             */
            $wp_customize->add_setting("section_footer_menu_setting_menu_$i", array(
                'default'           => gs_get_content("section_footer.menu.items.$i.menu"),
            ));
            $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "section_footer_menu_control_menu_$i", array(
                'label' => 'Menu:',
                'section' => "section_footer_menu_$i",
                'settings' => "section_footer_menu_setting_menu_$i",
                'type' => 'select',
                'choices' => array_column(wp_get_nav_menus(), 'name', 'slug'),
            )));
        }


        /**
         * Section Footer: Social Link
         */
        $wp_customize->add_section('section_footer_social_link', array(
            'title'   		=> "Social Link",
            'panel'         => 'panel_footer'
        ));

        /**
         * Footer: FB Social Link
         */
        $wp_customize->add_setting("section_footer_social_link_setting_facebook", array(
            'default'           => gs_get_content("section_footer.social_link_facebook"),
        ));
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "section_footer_social_link_control_facebook", array(
            'label' => "Facebook:",
            'section' => 'section_footer_social_link',
            'settings' => "section_footer_social_link_setting_facebook",
            'type' => 'text',
        )));

        /**
         * Footer: linkedin Social Link
         */
        $wp_customize->add_setting("section_footer_social_link_setting_linkedin", array(
            'default'           => gs_get_content("section_footer.social_link_linkedin"),
        ));
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "section_footer_social_link_control_linkedin", array(
            'label' => "LinkedIn:",
            'section' => 'section_footer_social_link',
            'settings' => "section_footer_social_link_setting_linkedin",
            'type' => 'text',
        )));

        /**
         * Footer: Instagram Social Link
         */
        $wp_customize->add_setting("section_footer_social_link_setting_instagram", array(
            'default'           => gs_get_content("section_footer.social_link_instagram"),
        ));
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "section_footer_social_link_control_instagram", array(
            'label' => "Instagram:",
            'section' => 'section_footer_social_link',
            'settings' => "section_footer_social_link_setting_instagram",
            'type' => 'text',
        )));


        /**
         * Footer: Media Social Link
         * 
         * update: 16.11 folder: hide play icon
         */
        // $wp_customize->add_setting("section_footer_social_link_setting_media", array(
        //     'default'           => gs_get_content("section_footer.social_link_media"),
        // ));
        // $wp_customize->add_control( new WP_Customize_Control( $wp_customize, "section_footer_social_link_control_media", array(
        //     'label' => "Media:",
        //     'section' => 'section_footer_social_link',
        //     'settings' => "section_footer_social_link_setting_media",
        //     'type' => 'text',
        // )));

       
    }

    private function video_layout($wp_customize, $parent_section, $section_prefix, $i, $setting_type) {
        /**
         * Video
         */
        $wp_customize->add_setting("$section_prefix.video_$i", array(
            'default'           => gs_get_content("$section_prefix.$i.video"),
            'sanitize_callback' => 'gs_media_url',
        ));
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, "$section_prefix.control_video_$i", array(
            'label' => "Video: ",
            'section' => $parent_section,
            'settings' => "$section_prefix.video_$i",
            'mime_type' => 'video',
            'active_callback' => function () use ($setting_type) {
                return get_theme_mod($setting_type, "") == 'video';
            },
        )));
    }

    private function image_layout($wp_customize, $parent_section, $section_prefix, $i, $setting_type) {
        /**
         * Image
         */
        $wp_customize->add_setting("$section_prefix.image_$i", array(
            'default'           => gs_get_content("$section_prefix.$i.image"),
            'sanitize_callback' => 'gs_media_url',
        ));
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, "$section_prefix.control_image_$i", array(
            'label' => "Image: ",
            'section' => $parent_section,
            'settings' => "$section_prefix.image_$i",
            'mime_type' => 'image',
            'active_callback' => function () use ($setting_type) {
                return get_theme_mod($setting_type, "") == 'image';
            },
        )));
    }

    /**
	 * Scripts to improve our form.
	 */
	public function gs_add_scripts() {
		?>
		<script type="text/javascript">
			jQuery( function( $ ) {
				wp.customize.panel( 'section_about_us', function( panel ) {
					panel.expanded.bind( function( isExpanded ) {
						if ( isExpanded ) {
							wp.customize.previewer.previewUrl.set( '<?php echo esc_js( get_permalink( get_page_by_path( 'pages/uber-uns' ) ) ); ?>' );
						} else {
                            wp.customize.previewer.previewUrl.set( '<?php echo esc_js( get_site_url() ); ?>' );
                        }
					} );
				} );
				wp.customize.section( 'section_product_category', function( section ) {
					section.expanded.bind( function( isExpanded ) {
						if ( isExpanded ) {
							wp.customize.previewer.previewUrl.set( '<?php echo esc_js( get_permalink( get_page_by_path( 'shop' ) ) ); ?>' );
						} else {
                            wp.customize.previewer.previewUrl.set( '<?php echo esc_js( get_site_url() ); ?>' );
                        }
					} );
				} );
			} );
		</script>
		<?php
	}
}

/**
 * Load all our Customizer Custom Controls
 */
// require_once trailingslashit( dirname(__FILE__) ) . 'custom-controls.php';


function gs_media_url( $input ) {
    if (is_integer($input)) return wp_get_attachment_url($input);
    return $input;
}   

function gs_sanitize_checkbox( $checked ) {
    // Boolean check.
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}