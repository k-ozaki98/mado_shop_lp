<?php

get_header('', ['pageId' => 'top']); 
?>

<main>

  <section class="contact" id="contact">
    <div class="l-inner">
      <div class="contact__inner">
        <h2 class="contact__title">お問い合わせフォーム</h2>

        <form id="contact-form" method="post" action="/confirm/" enctype="multipart/form-data">
          <div class="form">
            <div class="form__item">
              <label class="form__label">
                <span class="form__required">必須</span>
                <span class="form__text">お名前</span>
              </label>
              <div class="form__wrap">
                <input type="text" name="your-name" class="form__input" required value="<?php echo isset($form_data['your-name']) ? esc_attr($form_data['your-name']) : ''; ?>">
              </div>
            </div>

            <div class="form__item">
              <label class="form__label">
                <span class="form__required">必須</span>
                <span class="form__text">メールアドレス</span>
              </label>
              <div class="form__wrap">
                <input type="email" name="your-email" class="form__input" required value="<?php echo isset($form_data['your-email']) ? esc_attr($form_data['your-email']) : ''; ?>">
              </div>
            </div>

            <div class="form__item">
              <label class="form__label">郵便番号</label>
              <div class="form__wrap">
                <input type="text" name="zip" class="form__input" value="<?php echo isset($form_data['zip']) ? esc_attr($form_data['zip']) : ''; ?>">
              </div>
            </div>

            <div class="form__item">
              <label class="form__label">
                <span class="form__required is-pc-tab">必須</span>
                <span class="form__text">住所</span>
              </label>
              <div class="form__wrap">
                <label class="form__label">
                  <span class="form__required is-sp">必須</span>
                  <span class="form__address-text">都道府県</span>
                </label>
                <div class="form__select-wrap">
                  <select name="prefecture" class="form__select" required>
                    <option value="">-- 選択してください --</option>
                    <?php
                      $prefectures = [
                          '北海道', '青森県', '岩手県', '宮城県', '秋田県', '山形県', '福島県', 
                          '茨城県', '栃木県', '群馬県', '埼玉県', '千葉県', '東京都', '神奈川県', 
                          '新潟県', '富山県', '石川県', '福井県', '山梨県', '長野県', '岐阜県', 
                          '静岡県', '愛知県', '三重県', '滋賀県', '京都府', '大阪府', '兵庫県', 
                          '奈良県', '和歌山県', '鳥取県', '島根県', '岡山県', '広島県', '山口県', 
                          '徳島県', '香川県', '愛媛県', '高知県', '福岡県', '佐賀県', '長崎県', 
                          '熊本県', '大分県', '宮崎県', '鹿児島県', '沖縄県'
                      ];
                      foreach ($prefectures as $prefecture) {
                          $selected = (isset($form_data['prefecture']) && $form_data['prefecture'] === $prefecture) ? 'selected' : '';
                          echo '<option value="' . esc_attr($prefecture) . '" ' . $selected . '>' . esc_html($prefecture) . '</option>';
                      }
                      ?>
                  </select>
                </div>
                <div class="form__address-detail">
                  <label class="form__label">
                    <span class="form__required is-sp">必須</span>
                    <span class="form__address-text">市区町村・番地</span>
                  </label>
                  <input type="text" name="city" class="form__input" required value="<?php echo isset($form_data['city']) ? esc_attr($form_data['city']) : ''; ?>">
                </div>
                <div class="form__address-detail">
                  <label class="form__label">
                    <span class="form__required is-sp">必須</span>
                    <span class="form__address-text">建物名・部屋番号</span>
                  </label>
                  <input type="text" name="building" class="form__input"  value="<?php echo isset($form_data['building']) ? esc_attr($form_data['building']) : ''; ?>">
                </div>
              </div>
            </div>

            <div class="form__item">
              <label class="form__label">
                <span class="form__required">必須</span>
                <span class="form__text">電話番号</span>
              </label>
              <div class="form__wrap">
                <input type="tel" name="tel" class="form__input" required value="<?php echo isset($form_data['tel']) ? esc_attr($form_data['tel']) : ''; ?>">
              </div>
            </div>

            <h3 class="form__subtitle">詳しいお問い合わせ内容</h3>

            <div class="form__item">
              <label class="form__label">
                <span class="form__required">必須</span>
                <span class="form__text">お住まいのタイプ</span>
              </label>
              <div class="form__select-wrap">
                <select name="house-type" class="form__select" required>
                  <option value="">-- 選択してください --</option>
                  <option value="戸建て" <?php echo (isset($form_data['house-type']) && $form_data['house-type'] === '戸建て') ? 'selected' : ''; ?>>戸建て</option>
                  <option value="マンション" <?php echo (isset($form_data['house-type']) && $form_data['house-type'] === 'マンション') ? 'selected' : ''; ?>>マンション</option>
                </select>
              </div>
            </div>

            <div class="form__item">
              <label class="form__label">
                <span class="form__required">必須</span>
                <span class="form__text">リフォームしたい箇所</span>
              </label>
              <div class="form__select-wrap">
                <select name="reform-place" class="form__select" required>
                  <option value="">-- 選択してください --</option>
                  <option value="窓" <?php echo (isset($form_data['reform-place']) && $form_data['reform-place'] === '窓') ? 'selected' : ''; ?>>窓</option>
                  <option value="玄関ドア" <?php echo (isset($form_data['reform-place']) && $form_data['reform-place'] === '玄関ドア') ? 'selected' : ''; ?>>玄関ドア</option>
                </select>
              </div>
            </div>

            <!-- 窓の情報 -->
            <?php
            // 既存の窓情報を取得
            $window_count = 1; // デフォルト
            if (isset($form_data)) {
                foreach ($form_data as $key => $value) {
                    if (preg_match('/^count-(\d+)$/', $key, $matches)) {
                        $window_count = max($window_count, intval($matches[1]));
                    }
                }
            }
            
            // 最初の窓情報フォーム
            ?>
            <div class="window-info" data-window-count="1">
              <h4 class="window-info__title">窓の情報（1）</h4>
              
              <div class="window-info__size">
                <label class="form__label">
                  <span class="form__optional">任意</span>
                  <span class="form__text">サイズ</span>
                </label>
                <div class="window-info__wrap">
                  <div class="window-info__size-inputs">
                    <div class="window-info__item">
                      <span class="window-info__label">高さ</span>
                      <input type="text" name="height-1" class="form__input-s" value="<?php echo isset($form_data['height-1']) ? esc_attr($form_data['height-1']) : ''; ?>">
                    </div>
                    <span>×</span>
                    <div class="window-info__item">
                      <span class="window-info__label">幅</span>
                      <input type="text" name="width-1" class="form__input-s" value="<?php echo isset($form_data['width-1']) ? esc_attr($form_data['width-1']) : ''; ?>">
                    </div>
                    <span>×</span>
                    <div class="window-info__item">
                      <span class="window-info__label">窓枠</span>
                      <input type="text" name="frame-1" class="form__input-s" value="<?php echo isset($form_data['frame-1']) ? esc_attr($form_data['frame-1']) : ''; ?>">
                    </div>
                  </div>
                  <p class="window-info__note">窓枠は、窓のリフォームをご希望の方のみご記入ください。</p>
                  <div class="window-info__btn">
                    <a href="">窓の測り方</a>
                  </div>
                </div>
              </div>

              <div class="window-info__image">
                <label class="form__label">
                  <span class="form__optional">任意</span>
                  写真画像
                </label>
                <div class="window-info__file-wrapper">
                  <input type="file" name="photo-1" class="form__file" value="<?php echo isset($form_data['photo-1']) ? esc_attr($form_data['photo-1']) : ''; ?>">
                  <span class="window-info__file-name"></span>
                  <button type="button" class="window-info__upload-btn js-file-btn">画像添付</button>
                  <p class="window-info__note">当該箇所の写真画像を添付していただくとよりスムーズです。</p>
                </div>
              </div>
              <div class="window-info__count">
                <label class="form__label">
                  <span class="form__required">必須</span>
                  <span class="form__text">枚数</span>
                </label>
                <div class="window-info__wrap window-info__wrap--unit">
                  <input type="number" name="count-1" class="form__input-s" min="1" required value="<?php echo isset($form_data['count-1']) ? esc_attr($form_data['count-1']) : ''; ?>">
                </div>
              </div>

              <div class="window-info__place">
                <label class="form__label">
                  <span class="form__required">必須</span>
                  <span class="form__text">場所</span>
                </label>
                <div class="window-info__wrap">
                  <div class="form__select-wrap">
                    <select name="place-1" class="form__select" required>
                      <option value="">-- 選択してください --</option>
                      <option value="LDK" <?php echo (isset($form_data['place-1']) && $form_data['place-1'] === 'LDK') ? 'selected' : ''; ?>>LDK</option>
                      <option value="浴室" <?php echo (isset($form_data['place-1']) && $form_data['place-1'] === '浴室') ? 'selected' : ''; ?>>浴室</option>
                      <option value="和室" <?php echo (isset($form_data['place-1']) && $form_data['place-1'] === '和室') ? 'selected' : ''; ?>>和室</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <div class="form__add-btn">
              <button type="button" class="form__add-window">窓を追加する</button>
            </div>

            <div class="form__item">
              <label class="form__label">
                <span class="form__optional">任意</span>
                <span class="form__text">現地調査希望日</span>
              </label>
              <div class="form__wrap">
                <input type="text" name="preferred-date" id="preferred-date" class="form__input datepicker" readonly>
                
                <div class="form__radio-group">
                  <label class="form__radio-label">
                    <input type="radio" name="preferred-time" value="午前" class="form__radio">
                    <span>午前中</span>
                  </label>
                  <label class="form__radio-label">
                    <input type="radio" name="preferred-time" value="午後" class="form__radio">
                    <span>午後</span>
                  </label>
                </div>
              </div>
            </div>

            <div class="form__item">
              <label class="form__label">その他</label>
              <div class="form__wrap">
                <textarea name="other" class="form__textarea" value="<?php echo isset($form_data['other']) ? esc_attr($form_data['other']) : ''; ?>"></textarea>
              </div>
            </div>

            <div class="form__submit">
              <input type="submit" class="form__button" value="入力内容を確認">
            </div>
          </div>
        </form>


      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>

<script>
  jQuery(document).ready(function($) {
    // Datepicker初期化
    $('.datepicker').datepicker({
      dateFormat: 'yy/mm/dd',
      minDate: 1, // 明日から選択可能
      beforeShowDay: function(date) {
        // 土日を選択不可に
        // var day = date.getDay();
        // return [day != 0 && day != 6, ''];

        // 全日選択可能
        return [true, ''];
      }
    });
  });

  jQuery(document).ready(function($) {
  const $container = $('.form');
  const $addButton = $('.form__add-window');
  let windowCount = $('.window-info').length;
  
  // 窓追加ボタンの表示/非表示を更新
  function updateAddButtonVisibility() {
    if (windowCount >= 5) {
      $('.form__add-btn').hide();
    } else {
      $('.form__add-btn').show();
    }
  }
  
  // 初期表示時にボタン表示を更新
  updateAddButtonVisibility();
  
  $addButton.on('click', function() {
    windowCount++;
    
    if (windowCount > 5) {
      alert('窓の追加は最大5つまでです');
      windowCount--;
      return;
    }

    // テンプレートをクローン
    const $template = $('.window-info').first().clone();
    
    // 新しい窓の属性を更新
    $template.attr('data-window-count', windowCount);
    $template.find('input, select').each(function() {
      const oldName = $(this).attr('name');
      if (oldName && oldName.includes('-1')) {
        $(this).attr('name', oldName.replace(/-1/, `-${windowCount}`));
        $(this).val('');
      }
    });
    
    // タイトルを更新
    $template.find('.window-info__title').text(`窓の情報（${windowCount}）`);

    // 削除ボタンを追加
    if (!$template.find('.window-info__remove').length) {
      const $removeButton = $('<button type="button" class="window-info__remove">×</button>');
      $template.prepend($removeButton);
    }

    $template.find('.window-info__file-name').text('');

    $container.find('.form__add-btn').before($template);
    
    // 削除ボタンのイベント
    $template.find('.window-info__remove').on('click', function() {
      $(this).closest('.window-info').remove();
      windowCount--;
      updateAddButtonVisibility();
    });
    
    // ボタン表示を更新
    updateAddButtonVisibility();
  });
  
  // 既存の削除ボタンのイベント
  $container.on('click', '.window-info__remove', function() {
    $(this).closest('.window-info').remove();
    windowCount--;
    updateAddButtonVisibility();
  });
});


</script>

