<?php
if (!defined('ABSPATH')) {
    exit;
}


function wptp_create_post_type()
{
    $labels = array(
        'name' => __('Books'),
        'singular_name' => __('book'),
        'add_new' => __('New book'),
        'add_new_item' => __('Add New book'),
        'edit_item' => __('Edit book'),
        'new_item' => __('New book'),
        'view_item' => __('View book'),
        'search_items' => __('Search books'),
        'not_found' => __('No books Found'),
        'not_found_in_trash' => __('No books found in Trash'),
    );
    $args = array(
        'labels' => $labels,
        'has_archive' => true,
        'public' => true,
        'hierarchical' => false,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'custom-fields',
            'thumbnail',
            'page-attributes'
        ),
        'show_in_rest'       => true,
        'taxonomies' => array('post_tag', 'category'),
    );
    register_post_type('book', $args);
}

add_action('init', 'wptp_create_post_type');



function wptp_register_taxonomies() {


    register_taxonomy( 'genre', 'book',
        array(
            'labels' => array(
                'name'              => 'Genre',
                'singular_name'     => 'Genre',
                'search_items'      => 'Search Genre',
                'all_items'         => 'All Genre',
                'edit_item'         => 'Edit Genre',
                'update_item'       => 'Update Genre',
                'add_new_item'      => 'Add New Genre',
                'new_item_name'     => 'New Genre Name',
                'menu_name'         => 'Genre',
            ),
            'hierarchical' => true,
            'sort' => true,
            'args' => array( 'orderby' => 'term_order' ),
            'rewrite' => array( 'slug' => 'genre' ),
            'show_admin_column' => true,
            'show_in_rest'       => true,
        )
    );


    register_taxonomy( 'author', 'book',
        array(
            'labels' => array(
                'name'              => 'Author',
                'singular_name'     => 'Author',
                'search_items'      => 'Search Author',
                'all_items'         => 'All Author',
                'edit_item'         => 'Edit Author',
                'update_item'       => 'Update Author',
                'add_new_item'      => 'Add New Author',
                'new_item_name'     => 'New Author Name',
                'menu_name'         => 'Author',
            ),
            'hierarchical' => true,
            'sort' => true,
            'args' => array( 'orderby' => 'term_order' ),
            'rewrite' => array( 'slug' => 'author' ),
            'show_admin_column' => true,
            'show_in_rest'       => true,
        )
    );
}
add_action( 'init', 'wptp_register_taxonomies' );