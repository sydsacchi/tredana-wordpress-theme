<?php
/**
 * Tredana Theme Customizer
 *
 * @package Tredana
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function tredana_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'tredana_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'tredana_customize_partial_blogdescription',
		) );
	}

    $wp_customize->add_setting(
        'tredana_link_color',
        array(
            'default'     => '#000000'
        )
    );
    
    $wp_customize->add_setting(
        'tredana_visited_color',
        array(
            'default'     => '#000000'
        )
    );

    $wp_customize->add_setting(
        'tredana_headings_color',
        array(
            'default'     => '#000000'
        )
    );

    $wp_customize->add_setting(
        'tredana_text_color',
        array(
            'default'     => '#000000'
        )
    );

    $wp_customize->add_setting(
        'tredana_meta_color',
        array(
            'default'     => '#000000'
        )
    );

    $wp_customize->add_setting(
        'tredana_page_color',
        array(
            'default'     => '#ffffff'
        )
    );
 
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'link_color',
            array(
                'label'      => __( 'Link Color', 'tredana' ),
                'section'    => 'colors',
                'settings'   => 'tredana_link_color'
            )
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'visited_color',
            array(
                'label'      => __( 'Visited Color', 'tredana' ),
                'section'    => 'colors',
                'settings'   => 'tredana_visited_color'
            )
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'headings_color',
            array(
                'label'      => __( 'Headings Color', 'tredana' ),
                'section'    => 'colors',
                'settings'   => 'tredana_headings_color'
            )
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'text_color',
            array(
                'label'      => __( 'Text Color', 'tredana' ),
                'section'    => 'colors',
                'settings'   => 'tredana_text_color'
            )
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'meta_color',
            array(
                'label'      => __( 'Meta Color', 'tredana' ),
                'section'    => 'colors',
                'settings'   => 'tredana_meta_color'
            )
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'page_color',
            array(
                'label'      => __( 'Page Color', 'tredana' ),
                'section'    => 'colors',
                'settings'   => 'tredana_page_color'
            )
        )
    );

    $wp_customize->add_section('font_style', array (
		'title' => __('Font Style', 'tredana'),
		'priority' => 130
	));

    $wp_customize->add_setting('font_style', array(
		'default' => 'verdana',		
		'type' => 'theme_mod',
	));
	
	$wp_customize->add_control('font_style', array(
		'label' => __('Font Style', 'tredana'),
		'section' => 'font_style',
		'type' => 'radio',
		'choices' => array(
			'trebuchet' => 'Trebuchet MS',
			'verdana' => 'Verdana',
            'treheading' => 'Trebuchet MS for headings and Verdana for body',
            'verdheading' => 'Verdana for headings and Trebuchet MS for body',    			
		),
		'priority' => 1
	));


    $wp_customize->add_section('custom_footer_text', array (
		'title' => __('Footer Text/Credits', 'tredana'),
		'priority' => 150
	));
	
	$wp_customize->add_setting('footer_text_block', array(
		'default' => __('Tredana Theme · By: <a href="https://www.sidneysacchi.com" target="_blank" title="Web Design &amp; Web Consulting">Sidney Sacchi</a>' , 'tredana'),
		#'sanitize_callback' => 'sanitize_text'		
	));
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'custom_footer_text', array( 
		'label' => __( 'Footer Text/Credits', 'tredana' ), 
		'section' => 'custom_footer_text', 
		'settings' => 'footer_text_block', 		
		'type' => 'text'
		))); 
		
	// Sanitize text 
	
		function sanitize_text( $text ) {
		return sanitize_text_field( $text ); 
		}
}
add_action( 'customize_register', 'tredana_customize_register' );

function tredana_customizer_css() {
    
    if( in_array(get_theme_mod('font_style'), array('verdana'))) { 
    ?>
    <style type="text/css">
        body {
            font-family:Verdana,Geneva,sans-serif;
        }
    </style>
    <?php
    } elseif( in_array(get_theme_mod('font_style'), array('trebuchet'))) {
    ?>
    <style type="text/css">
        body {
            font-family:"Trebuchet MS", Helvetica, sans-serif;
        }
    </style>
    <?php
    } elseif( in_array(get_theme_mod('font_style'), array('treheading'))) {
    ?>
    <style type="text/css">
        body {
            font-family:Verdana,Geneva,sans-serif;
        }        
        h1, h2, h3, h4, h5, h6 {
            font-family:"Trebuchet MS", Helvetica, sans-serif;
        }
    </style>
    <?php
    } else {
    ?>
    <style type="text/css">
        body {
            font-family:"Trebuchet MS", Helvetica, sans-serif;
        }        
        h1, h2, h3, h4, h5, h6 {
            font-family:Verdana,Geneva,sans-serif;
        }
    </style>
    <?php 
    } ?>
    <style type="text/css">
        #page { background: <?php echo get_theme_mod( 'tredana_page_color' ); ?>; }        
        p, ul, ol, li { color: <?php echo get_theme_mod( 'tredana_text_color' ); ?>; }
        a { color: <?php echo get_theme_mod( 'tredana_link_color' ); ?>; }
        a:visited { color: <?php echo get_theme_mod( 'tredana_visited_color' ); ?>; }
        h2, h3, h4, h5 { color: <?php echo get_theme_mod( 'tredana_headings_color' ); ?>; }
        .posted-on, .byline { color: <?php echo get_theme_mod( 'tredana_meta_color' ); ?>; }
    </style>
    <?php
}

add_action( 'wp_head', 'tredana_customizer_css' );
/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function tredana_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function tredana_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function tredana_customize_preview_js() {
	wp_enqueue_script( 'tredana-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'tredana_customize_preview_js' );

function remove_customizer_settings( $wp_customize ){
  $wp_customize->remove_section('header_image');

}
add_action( 'customize_register', 'remove_customizer_settings', 20 );
