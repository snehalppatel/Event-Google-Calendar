<?php
/*
  Template Name: Event calender
  Template Post Type: post, page, event
 */


get_header();

$args = array('post_type' => 'events', 'posts_per_page' => 10);
$the_query = new WP_Query($args);
?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
    <?php if ($the_query->have_posts()) : ?>
        <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
            <h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
            <?php the_field('locatios'); ?><br/><br/>
            <?php the_field('date'); ?>
            <br/>
            <br/>
            <br/>
        <?php endwhile;
        wp_reset_postdata();
        ?>
    <?php else: ?>
        <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>

</article><!-- .post -->
<?php get_footer(); ?>