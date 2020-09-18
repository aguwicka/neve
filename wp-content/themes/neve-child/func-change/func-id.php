<?php
if (!defined('ABSPATH')) {
    exit;
}

// колонка "ID" в админке
add_action( 'admin_init', 'admin_area_ID' );
function admin_area_ID() {
// для таксономий (рубрик, меток и т.д.)
    foreach ( get_taxonomies() as $taxonomy ) {
        add_action( "manage_edit-${taxonomy}_columns", 'tax_add_col' );
        add_filter( "manage_edit-${taxonomy}_sortable_columns", 'tax_add_col' );
        add_filter( "manage_${taxonomy}_custom_column", 'tax_show_id', 10, 3 );
    }
    add_action( 'admin_print_styles-edit-tags.php', 'tax_id_style' );
    function tax_add_col( $columns ) {
        return $columns + array( 'tax_id' => 'ID' );
    }

    function tax_show_id( $v, $name, $id ) {
        return 'tax_id' === $name ? $id : $v;
    }

    function tax_id_style() {
        print '<style>#tax_id{width:4em}</style>';
    }

// для постов и страниц
    add_filter( 'manage_posts_columns', 'posts_add_col', 5 );
    add_action( 'manage_posts_custom_column', 'posts_show_id', 5, 2 );
    add_filter( 'manage_pages_columns', 'posts_add_col', 5 );
    add_action( 'manage_pages_custom_column', 'posts_show_id', 5, 2 );
    add_action( 'admin_print_styles-edit.php', 'posts_id_style' );
    function posts_add_col( $defaults ) {
        $defaults['wps_post_id'] = __( 'ID' );

        return $defaults;
    }

    function posts_show_id( $column_name, $id ) {
        if ( $column_name === 'wps_post_id' ) {
            echo $id;
        }
    }

    function posts_id_style() {
        print '<style>#wps_post_id{width:4em}</style>';
    }
}