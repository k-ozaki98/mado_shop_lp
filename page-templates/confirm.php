<?php
// POSTデータがなければリダイレクト
if (empty($_POST)) {
    wp_redirect(home_url());
    exit;
}

$data = $_POST;

get_header('', ['pageId' => 'confirm']);
?>

<main class="confirm-page">
    <div class="l-inner confirm-page__inner">
        <h1 class="heading-A confirm-page_ttl">お問い合わせ内容の確認</h1>

        <div class="confirm">
            <!-- 基本情報 -->
            <div class="confirm__item">
                <label class="confirm__label">お名前</label>
                <div class="confirm__wrap"><?php echo esc_html($data['your-name']); ?></div>
            </div>
            <div class="confirm__item">
                <label class="confirm__label">メールアドレス</label>
                <div class="confirm__wrap"><?php echo esc_html($data['your-email']); ?></div>
            </div>
            <div class="confirm__item">
                <label class="confirm__label">郵便番号</label>
                <div class="confirm__wrap"><?php echo esc_html($data['zip'] ?? '未入力'); ?></div>
            </div>
            <div class="confirm__item">
                <label class="confirm__label">住所</label>
                <div class="confirm__wrap">
                    <?php echo esc_html($data['prefecture'] . ' ' . $data['city'] . ' ' . ($data['building'] ?? '')); ?>
                </div>
            </div>
            <div class="confirm__item">
                <label class="confirm__label">電話番号</label>
                <div class="confirm__wrap"><?php echo esc_html($data['tel']); ?></div>
            </div>

            <h3 class="form__subtitle">詳しいお問い合わせ内容</h3>
            <div class="confirm__item">
                <label class="confirm__label">お住まいのタイプ</label>
                <div class="confirm__wrap"><?php echo esc_html($data['house-type']); ?></div>
            </div>

            <!-- 窓情報のループ -->
            <?php
            $window_count = 0;
            foreach ($data as $key => $value) {
                if (preg_match('/^place-(\d+)$/', $key, $matches)) {
                    $window_count = max($window_count, intval($matches[1]));
                }
            }

            if ($window_count > 0) {
                echo '<h3 class="form__subtitle">窓のリフォーム情報</h3>';
                for ($i = 1; $i <= $window_count; $i++) {
                    if (!empty($data["place-$i"])) {
                        ?>
                        <div class="window-info">
                            <h4 class="window-info__title">窓 <?php echo $i; ?></h4>
                            <div class="window-info__item">
                                <label class="confirm__label">リフォームしたい箇所</label>
                                <div class="confirm__wrap">
                                    <?php echo isset($data["reform-place-$i"]) ? esc_html($data["reform-place-$i"]) : '未入力';?>
                                </div>
                            </div>
                            <div class="window-info__item">
                                <label class="confirm__label">サイズ</label>
                                <div class="confirm__wrap">
                                    高さ: <?php echo esc_html($data["height-$i"] ?? '未入力'); ?>cm ×
                                    幅: <?php echo esc_html($data["width-$i"] ?? '未入力'); ?>cm ×
                                    窓枠: <?php echo esc_html($data["frame-$i"] ?? '未入力'); ?>cm
                                </div>
                            </div>
                            <div class="window-info__item">
                                <label class="confirm__label">場所</label>
                                <div class="confirm__wrap"><?php echo esc_html($data["place-$i"]); ?></div>
                            </div>
                        </div>
                        <?php
                    }
                }
            }
            ?>

            <!-- 現地調査希望日 -->
            <div class="confirm__item">
                <label class="confirm__label">現地調査希望日</label>
                <div class="confirm__wrap">
                    <?php echo !empty($data['preferred-date']) ? esc_html($data['preferred-date']) : '未入力'; ?>
                    <?php if (!empty($data['preferred-time'])): ?>
                        （<?php echo esc_html($data['preferred-time']); ?>）
                    <?php endif; ?>
                </div>
            </div>

            <!-- その他 -->
            <div class="confirm__item">
                <label class="confirm__label">その他</label>
                <div class="confirm__wrap"><?php echo esc_html($data['other'] ?? '特になし'); ?></div>
            </div>

            <!-- 戻る & 送信ボタン -->
            <div class="btn-wrap">
                <div class="form__back">
                    <button type="button" onclick="history.back()" class="form__button form__button--back">戻る</button>
                </div>
                <div class="form__submit">
                    <form method="post" action="<?php echo esc_url(home_url('/thanks/')); ?>">
                        <!-- hiddenフィールドでデータを渡す -->
                        <?php foreach ($data as $key => $value): ?>
                            <?php if (is_array($value)): ?>
                                <?php foreach ($value as $subkey => $subvalue): ?>
                                    <input type="hidden" name="<?php echo esc_attr($key); ?>[<?php echo esc_attr($subkey); ?>]" value="<?php echo esc_attr($subvalue); ?>">
                                <?php endforeach; ?>
                            <?php else: ?>
                                <input type="hidden" name="<?php echo esc_attr($key); ?>" value="<?php echo esc_attr($value); ?>">
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <input type="hidden" name="final_submit" value="1">
                        <button type="submit" class="form__button">送信</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
