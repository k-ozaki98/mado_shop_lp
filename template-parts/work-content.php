<?php
$query = new WP_Query(array(
    'post_type' => 'works',
    'posts_per_page' => -1
));

if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post();
?>

<div class="works__inner inner">
        <article class="works-card">
            <h2 class="works-card__title"><?php the_title(); ?></h2>

            <div class="works-card__body">
                <?php if (has_post_thumbnail()): ?>
                    <div class="works-card__img">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>
    
                    <dl class="works-card__data">
                        <div class="works-card__data-item">
                            <dt>住所</dt>
                            <dd><?php echo esc_html(get_post_meta(get_the_ID(), 'location', true)); ?></dd>
                        </div>
                        <div class="works-card__data-item">
                            <dt>施工箇所</dt>
                            <dd><?php echo esc_html(get_field('window_count')); ?>枚</dd>
                        </div>
                        <div class="works-card__data-item">
                            <dt>施工内容</dt>
                            <dd><?php echo esc_html(get_field('work_content')); ?></dd>
                        </div>
                        <div class="works-card__data-item">
                            <dt>費用</dt>
                            <dd><?php echo esc_html(get_field('cost')); ?>万</dd>
                        </div>
                        <div class="works-card__data-item">
                            <dt>工期</dt>
                            <dd><?php echo esc_html(get_field('period')); ?>日</dd>
                        </div>
                        <div class="works-card__data-item">
                            <dt>築年数</dt>
                            <dd><?php echo esc_html(get_field('years')); ?>年</dd>
                        </div>
                        <div class="works-card__data-item">
                            <dt>仕様商材</dt>
                            <dd><?php echo esc_html(get_field('materials')); ?></dd>
                        </div>
                    </dl>

            </div>

            <div class="works-card__detail js-works-accordion">
                
                
                <div class="works-card__content js-works-accordion-content">
                    <?php if (get_field('customer_needs')): ?>
                        <section class="works-card__section">
                            <h3>お客様のご要望</h3>
                            <div class="works-card__text">
                                <?php echo nl2br(esc_html(get_field('customer_needs'))); ?>
                            </div>
                        </section>
                    <?php endif; ?>

                    <?php if (get_field('proposal')): ?>
                        <section class="works-card__section">
                            <h3>ご提案内容</h3>
                            <div class="works-card__text">
                                <?php echo nl2br(esc_html(get_field('proposal'))); ?>
                            </div>
                        </section>
                    <?php endif; ?>

                    <?php if (get_field('cost_detail')): ?>
                        <section class="works-card__section">
                            <h3>費用詳細</h3>
                            <div class="works-card__text">
                                <?php echo nl2br(esc_html(get_field('cost_detail'))); ?>
                            </div>
                        </section>
                    <?php endif; ?>
                </div>

                <button class="works-card__more js-works-accordion-trigger">
                    もっと見る
                    <span class="works-card__more-icon"></span>
                </button>
            </div>
        </article>
    </div>

<?php
    endwhile;
    wp_reset_postdata(); // 追加
else :
    echo 'No works found.';
endif;
?>
