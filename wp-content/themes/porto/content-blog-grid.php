<?php

global $porto_settings;

$post_layout = 'grid';

$columns = $porto_settings['grid-columns'];

global $porto_blog_columns;
if ($porto_blog_columns)
    $columns = $porto_blog_columns;

$classes = '';
switch ($columns) {
    case '2': $classes .= ' col-xs-6'; break;
    case '3': $classes .= ' col-xs-6 col-sm-4'; break;
    case '4': $classes .= ' col-xs-6 col-sm-4 col-lg-3'; break;
    default: $classes .= ' col-xs-6 col-sm-4'; break;
}
?>

<article <?php post_class($classes . ' post post-' . $post_layout); ?>>

    <div class="grid-box">

        <?php // Post Slideshow ?>
        <?php get_template_part('slideshow'); ?>

        <div class="post-content">

            <h4 class="entry-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>

            <?php
            porto_render_rich_snippets( false );
            if ($porto_settings['blog-excerpt']) {
                echo porto_get_excerpt( $porto_settings['blog-excerpt-length'], false );
            } else {
                echo '<div class="entry-content">';
                the_content();
                wp_link_pages( array(
                    'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'porto' ) . '</span>',
                    'after'       => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                    'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'porto' ) . ' </span>%',
                    'separator'   => '<span class="screen-reader-text">, </span>',
                ) );
                echo '</div>';
            }
            ?>

        </div>

        <?php if (in_array('date', $porto_settings['post-metas'])) : ?>
        <div class="post-meta">
            <span><i class="fa fa-calendar"></i> <?php echo get_the_date() ?></span>
        </div>
        <?php endif; ?>
        <div class="post-meta">
            <?php if (in_array('author', $porto_settings['post-metas'])) : ?><span><i class="fa fa-user"></i> <?php echo __('By', 'porto'); ?> <?php the_author_posts_link(); ?></span><?php endif; ?>
            <?php
            $cats_list = get_the_category_list(', ');
            if ($cats_list && in_array('cats', $porto_settings['post-metas'])) : ?>
                <span><i class="fa fa-folder-open"></i> <?php echo $cats_list ?></span>
            <?php endif; ?>
            <?php
            $tags_list = get_the_tag_list('', ', ');
            if ($tags_list && in_array('tags', $porto_settings['post-metas'])) : ?>
                <span><i class="fa fa-tag"></i> <?php echo $tags_list ?></span>
            <?php endif; ?>
            <?php if (in_array('comments', $porto_settings['post-metas'])) : ?><span><i class="fa fa-comments"></i> <?php comments_popup_link(__('0 Comments', 'porto'), __('1 Comment', 'porto'), '% '.__('Comments', 'porto')); ?></span><?php endif; ?>
            <?php
            if (function_exists('Post_Views_Counter') && Post_Views_Counter()->options['display']['position'] == 'manual') {
                $post_count = do_shortcode('[post-views]');
                if ($post_count) {
                    echo $post_count;
                }
            }
            ?>
        </div>
        <div class="clearfix">
            <a class="btn btn-xs btn-primary pt-right" href="<?php echo esc_url( apply_filters( 'the_permalink', get_permalink() ) ) ?>"><?php _e('Read more...', 'porto') ?></a>
        </div>
    </div>

</article>