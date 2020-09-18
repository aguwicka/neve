<div class="entry-header">
    <div class="nv-title-meta-wrap"><h1 class="title entry-title "><?php the_title(); ?></h1>
        <ul class="nv-meta-list">
            <li class="meta author vcard"><span class="author-name fn">by <?php the_author() ?></span>
            </li>
            <li class="meta date posted-on">
                <time class="entry-date published"><?php the_date() ?></time>
            </li>
        </ul>
    </div>
</div>
<div class="nv-content-wrap entry-content">
    <?php the_content();?>
</div>
<?php if ('book' == get_post_type()): ?>
<div class="content-description">
    <p class="content-genre">
        Жанр: <?php $genres = get_the_terms( $post->ID, 'genre' );
        foreach ($genres as $genre):
        echo $genre->name;
        endforeach;
        ?>
    </p>
    <p class="content-author">
        Автор: <?php $authors = get_the_terms( $post->ID, 'author' );
        foreach ($authors as $author):
            echo $author->name;
        endforeach;
        ?>
    </p>
    <p class="content-price">
        Цена книги: <?php the_field('price');?>
    </p>
    <p class="content-release">
        Дата выхода: <?php the_field('release_date');?>
    </p>
    <p class="content-count">
        Количество страниц: <?php the_field('number_of_pages');?>
    </p>
</div>
<?php endif;?>