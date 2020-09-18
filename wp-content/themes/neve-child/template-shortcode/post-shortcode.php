<?php
if (!defined('ABSPATH')) {
    exit;
}


function book_recent_posts_shortcode($atts, $content = NULL)
{
    $atts = shortcode_atts(
        [
            'orderby' => 'date',
            'posts_per_page' => '5',
            'post_type' => 'book'
        ], $atts, 'recent-posts' );

    $query = new WP_Query( $atts );

    $output = '<div class="posts-wrapper row">';

    while($query->have_posts()) : $query->the_post();

        $output .= '<article id="post-' . get_the_ID() .'" class="col-12 layout-grid col-sm-12">';

        $output .= '<div class="article-content-col">';

        $output .= '<div class="content">';
        $output .= '<div class="blog-entry-title entry-title">';
        $output .= '<a href="' . get_permalink() .'">' . get_the_title() .  '</a>';
        $output .= '</div>';
        $output .= '<div class="excerpt-wrap entry-summary">';
        $output .= '<p>' .get_the_excerpt() . '</p>';
        $output.= "<div class='post-description'>";

        $genres = get_the_terms( $post->ID, 'genre' );
        foreach( $genres as $genre ){
            $output .= '<p>' . 'Жанр:' . ' ' . $genre->name . '</p>';
        }

        $authors = get_the_terms($post->ID, 'author');
        foreach ($authors as $author){
            $output .= '<p>' . 'Стоимость:' . ' ' . $author->name . '</p>';
        }

        $price = get_field('price', $post->ID);
        $output .= '<p>' . 'Цена:' . ' ' . $price . '</p>';

        $releaseDate = get_field('release_date', $post->ID);
        $output .= '<p>' . 'Дата выхода:' . ' ' . $releaseDate . '</p>';
        $output.= "</div>";
        $output .= '</div>';
        $output .= '</div>';

        $output .= '</div>';

        $output .= '</article>';
    endwhile;

    wp_reset_query();

    return $output . '</div>';
}
add_shortcode('recent-posts', 'book_recent_posts_shortcode');