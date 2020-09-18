<?php
if (!defined('ABSPATH')) {
    exit;
}

function insertFootNote($content) {
    if('book' == get_post_type()) {
        $content.= "<div class='post-description'>";

        $genres = get_the_terms( $post->ID, 'genre' );
        foreach( $genres as $genre ){
            $content .= '<p>' . 'Жанр:' . ' ' . $genre->name . '</p>';
        }

        $authors = get_the_terms($post->ID, 'author');
        foreach ($authors as $author){
            $content .= '<p>' . 'Стоимость:' . ' ' . $author->name . '</p>';
        }

        $price = get_field('price', $post->ID);
        $content .= '<p>' . 'Цена:' . ' ' . $price . '</p>';

        $releaseDate = get_field('release_date', $post->ID);
        $content .= '<p>' . 'Дата выхода:' . ' ' . $releaseDate . '</p>';
        $content.= "</div>";
    }
    return $content;
}
add_filter ('the_excerpt', 'insertFootNote');