
<article class="works-card">
    <h2 class="works-card__title"><?php the_title(); ?></h2>

    <div class="works-card__body">
        <?php if (has_post_thumbnail()): ?>
            <div class="works-card__img">
                <?php the_post_thumbnail('large'); ?>
            </div>
        <?php endif; ?>

        <dl class="works-card__data">
            <?php
            $fields = [
              'location' => ['unit' => '', 'label' => '住所'],
              'window_count' => ['unit' => '', 'label' => '施工箇所'],
              'window_overview' => ['unit' => '', 'label' => '施工概要'],
              'work_content' => ['unit' => '', 'label' => '施工内容'],
              'cost' => ['unit' => '万', 'label' => '費用'],
              'subsidy' => ['unit' => '円', 'label' => '申請補助金'],
              'period' => ['unit' => '日', 'label' => '工期'],
              'years' => ['unit' => '', 'label' => '築年数'],
              'materials' => ['unit' => '', 'label' => '仕様商材']
            ];

            foreach ($fields as $field_name => $field_info):
                $value = get_field($field_name);
                
                // 設定した項目のみ表示
                if ($value): ?>
                    <div class="works-card__data-item">
                        <dt><?php echo esc_html($field_info['label']); ?></dt>
                        <dd>
                            <?php 
                            if (is_array($value)) {
                              // 仕様商材の分岐
                                echo esc_html(implode('　', $value));
                            } else {
                              if ($field_name === 'subsidy') {
                                // 補助金はカンマ追加
                                echo number_format($value) . $field_info['unit'];
                              } else {
                                  echo esc_html($value) . $field_info['unit'];
                              }
                            }
                            ?>
                        </dd>
                    </div>
                <?php endif;
            endforeach; ?>
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

