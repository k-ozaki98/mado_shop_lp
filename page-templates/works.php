<?php get_header('', ['pageId' => 'works']); ?>
<?php
$query = new WP_Query(array(
    'post_type' => 'works',
    'posts_per_page' => -1
));

if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post();
?>

<main class="works">
    <?php get_template_part('template-parts/work-content'); ?>
</main>

<?php endwhile; else : ?>
    <p>投稿がありません。</p>
<?php endif; ?>

<?php wp_reset_postdata(); ?>

<?php get_footer(); ?>
