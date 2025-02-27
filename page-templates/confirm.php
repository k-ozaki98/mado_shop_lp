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
      <div class="confirm__item">
        <label class="confirm__label">
          <span class="confirm__text">お名前</span>
        </label>
        <div class="confirm__wrap">
          <?php echo esc_html($data['your-name']); ?>
        </div>
      </div>

      <div class="confirm__item">
        <label class="confirm__label">
          <span class="confirm__text">メールアドレス</span>
        </label>
        <div class="confirm__wrap">
          <?php echo esc_html($data['your-email']); ?>
        </div>
      </div>

      <div class="confirm__item">
        <label class="confirm__label">郵便番号</label>
        <div class="confirm__wrap">
          <?php echo esc_html($data['zip'] ?? '未入力'); ?>
        </div>
      </div>

      <div class="confirm__item">
        <label class="confirm__label">
          <span class="confirm__text">住所</span>
        </label>
        <div class="confirm__wrap">
          <div class="confirm__address">
            <label class="confirm__label">
              <span class="confirm__address-text">都道府県</span>
            </label>
            <div class="form__select-wrap">
              <?php echo esc_html($data['prefecture']); ?>
            </div>
          </div>
          
          <div class="confirm__address">
            <label class="confirm__label">
              <span class="confirm__address-text">市区町村・番地</span>
            </label>
            <p><?php echo esc_html($data['city']); ?></p>
          </div>
          <div class="confirm__address">
            <label class="confirm__label">
              <span class="confirm__address-text">建物名・部屋番号</span>
            </label>
            <p><?php echo esc_html($data['building'] ?? '未入力'); ?></p>
          </div>
        </div>
      </div>

      <div class="confirm__item">
        <label class="confirm__label">
          <span class="confirm__text">電話番号</span>
        </label>
        <div class="confirm__wrap">
          <?php echo esc_html($data['tel']); ?>
        </div>
      </div>

      <h3 class="form__subtitle">詳しいお問い合わせ内容</h3>

      <div class="confirm__item">
        <label class="confirm__label">
          <span class="confirm__text">お住まいのタイプ</span>
        </label>
        <div class="form__select-wrap">
          <?php echo esc_html($data['house-type']); ?>
        </div>
      </div>

      <div class="confirm__item">
        <label class="confirm__label">
          <span class="confirm__text">リフォームしたい箇所</span>
        </label>
        <div class="form__select-wrap">
          <?php echo esc_html($data['reform-place']); ?>
        </div>
      </div>

      <!-- 窓の情報 -->
      <?php
      // 窓情報を動的に表示
      for ($i = 1; $i <= 5; $i++) {
        // 枚数が入力されている窓情報のみ表示
        if (!empty($data["count-{$i}"])) {
      ?>
        <div class="window-info" data-window-count="<?php echo $i; ?>">
          <h4 class="window-info__title">窓の情報（<?php echo $i; ?>）</h4>
          
          <div class="window-info__size">
            <label class="confirm__label">
              <span class="confirm__text">サイズ</span>
            </label>
            <div class="window-info__wrap">
              <div class="window-info__size-inputs">
                <div class="window-info__item">
                  <span class="window-info__label">高さ</span>
                  <p class="window-info__detail">
                    <?php echo esc_html($data["height-{$i}"] ?? '未入力'); ?>
                  </p>
                </div>
                <span>×</span>
                <div class="window-info__item">
                  <span class="window-info__label">幅</span>
                  <div class="window-info__detail">
                    <?php echo esc_html($data["width-{$i}"] ?? '未入力'); ?>
                  </div>
                </div>
                <span>×</span>
                <div class="window-info__item">
                  <span class="window-info__label">窓枠</span>
                  <div class="window-info__detail">
                    <?php echo esc_html($data["frame-{$i}"] ?? '未入力'); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="window-info__image">
            <label class="confirm__label">写真画像</label>
            <div class="window-info__file-wrapper">
              <?php 
              // 画像ファイルの表示処理
              if (!empty($data["photo-{$i}"])) {
                echo esc_html($data["photo-{$i}"]);
              } else {
                echo '添付なし';
              }
              ?>
            </div>
          </div>
          
          <div class="window-info__count">
            <label class="confirm__label">
              <span class="confirm__text">枚数</span>
            </label>
            <div class="window-info__wrap window-info__wrap--unit">
              <?php echo esc_html($data["count-{$i}"]); ?>
            </div>
          </div>

          <div class="window-info__place">
            <label class="confirm__label">
              <span class="confirm__text">場所</span>
            </label>
            <div class="window-info__wrap">
              <div class="form__select-wrap">
                <?php echo esc_html($data["place-{$i}"]); ?>
              </div>
            </div>
          </div>
        </div>
      <?php 
        } 
      }
      ?>

      <div class="confirm__item">
        <label class="confirm__label">
          <span class="confirm__text">現地調査希望日</span>
        </label>
        <div class="confirm__wrap">
          <?php echo !empty($data['preferred-date']) ? esc_html($data['preferred-date']) : '未入力'; ?>
          <?php if (!empty($data['preferred-time'])): ?>
            （<?php echo esc_html($data['preferred-time']); ?>）
          <?php endif; ?>
        </div>
      </div>

      <div class="confirm__item">
        <label class="confirm__label">その他</label>
        <div class="confirm__wrap">
          <?php echo esc_html($data['other'] ?? '特になし'); ?>
        </div>
      </div>

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