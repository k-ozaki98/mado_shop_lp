<?php 

get_header('', ['pageId' => 'top']); 

?>

<main>

  <div class="mv">
    <div class="mv__inner l-inner">
      <div class="mv__ttl">
        <picture>
          <source media="(max-width:767px)" type="image/png" srcset="<?php echo get_template_directory_uri() ?>/src/img/mv-ttl_sp.png" width="213" height="336" />
          <img src="<?php echo get_template_directory_uri() ?>/src/img/mv-ttl.png" alt="" width="486" height="313">
        </picture>
      </div>
      <div class="mv__logo">
        <img src="<?php echo get_template_directory_uri() ?>/src/img/logo.png" alt="" width="138" height="91">
      </div>
      <div class="mv__txt">
        <img src="<?php echo get_template_directory_uri() ?>/src/img/mv-txt.png" alt="" width="384" height="309">
      </div>
    </div>
  </div>


  <div class="nav is-pc-tab">
    <div class="l-inner">
      <ul class="nav__list">
        <li class="nav__item" data-nav-id="top"><a href="/">TOP</a></li>
        <li class="nav__item" data-nav-id="subsidy"><a href="/#subsidy">補助金情報</a></li>
        <li class="nav__item"><a href="/#reform">窓・ドアの<br>リフォーム</a></li>
        <li class="nav__item" data-nav-id="works"><a href="/#works">施工事例</a></li>
        <li class="nav__item"><a href="/#measure">窓の測り方</a></li>
      </ul>
    </div>
  </div>

  <section class="about">
    <div class="l-inner">
      <h2 class="heading-A about__ttl">快適な住空間の実現</h2>
      <p class="about__txt">住宅資材商社としての創業70年の歴史、<br>
        及び50年を超える窓関連工事事業で<br class="is-sp">培って参りましたノウハウで<br>
        お客様の快適な住空間の実現に向けた<br class="is-sp">課題解決提案を<br class="is-pc-tab">窓・ドアのリフォームに<br class="is-sp">限らない様々な角度からご提案致します。
      </p>
      <div class="about__img">
        <picture>
          <source media="(max-width:767px)" type="image/png" srcset="<?php echo get_template_directory_uri() ?>/src/img/about-img_sp.png" />
          <img src="<?php echo get_template_directory_uri() ?>/src/img/about-img.png" alt="">
        </picture>
      </div>

      <a href="/subsidy/" class="subsidy-btn" id="subsidy">
        <span>あなたのお家のリフォームにも?!</span>
        かしこく補助金活用
      </a>
    </div>
  </section>


  <section class="reform" id="reform">
    <div class="l-inner">
      <h2 class="heading-B">窓のリフォーム</h2>
      <p class="reform__txt">窓のリフォームには、既存窓の内側に<br class="is-sp">新たに内窓を新設する、<br>または既存の内窓を取り除き<br class="is-sp">新たな内窓に交換する「内窓設置」と、<br>既存窓のガラスを取り外し、<br class="is-sp">既存窓枠の上から新たな窓枠を<br>覆い被せて取り付け、<br class="is-sp">複層ガラス等に交換する<br>「外窓交換（カバー工法）」があります。</p>
      <div class="reform__cont inner">
        <p class="reform__ttl">内窓設置</p>
        <p class="reform__cont-txt">環境省の「先進的窓リノベ事業」における「内窓設置」とは、既存窓の内側に<br class="is-pc-tab">新たに内窓を新設する、または既存の内窓を取り除き新たな内窓に交換する工事をいいます。<br>ただし、<span>外皮部分に位置する既存外窓（ドア）の開口面※から屋内側へ<br class="is-pc-tab">50cm以内に平行に設置するもの</span>に限ります。​</p>
        <ul class="u-ul-style u-ul-style--asterisk reform__list">
          <li>開口面とは、外窓（複数のサッシで構成された出窓を含む）やドアを設置するために<br class="is-pc-tab">外壁に空けられた開口に対して、周囲の壁面を延長してできる面をいいます。</li>
        </ul>
        <div class="reform__img reform__img--small">
          <img src="<?php echo get_template_directory_uri() ?>/src/img/reform-img01.png" alt="">
        </div>
      </div>
      <div class="reform__cont inner">
        <p class="reform__ttl">外窓交換（カバー工法）</p>
        <p class="reform__cont-txt">環境省の「先進的窓リノベ事業」における「外窓」とは、<br class="is-pc-tab">住宅の外皮部分※にある開口部に設置する建具のうち、屋外から施錠できない建具をいいます。<br class="is-pc-tab">なお、「カバー工法」とは、既存窓のガラスを取り外し、<br class="is-pc-tab">既存窓枠の上から新たな窓枠を覆い被せて取り付け、複層ガラス等に交換する工事をいいます。​</p>
        <ul class="u-ul-style u-ul-style--asterisk reform__list">
          <li>外壁ライン上にある熱的境界をいいます。</li>
        </ul>
        <div class="reform__img">
          <img src="<?php echo get_template_directory_uri() ?>/src/img/reform-img02.png" alt="">
        </div>
      </div>
      <h2 class="heading-A reform__sub-ttl">ドアのリフォーム</h2>
      <div class="reform__cont inner">
        <p class="reform__ttl">ドア交換（カバー工法）</p>
        <p class="reform__cont-txt">環境省の「先進的窓リノベ事業」における「ドア」とは、<br class="is-pc-tab">住宅の外皮部分※にある開口部に設置する建具のうち、<br class="is-pc-tab">屋外から施錠できる建具をいいます。なお、「カバー工法」とは、<br class="is-pc-tab">​既存ドアについて枠を残して取り除き、既存枠の上から新たな枠を取り付け、<br class="is-pc-tab">ドアを交換する工事をいいます。</p>
        <ul class="u-ul-style u-ul-style--asterisk reform__list">
          <li>外壁ライン上にある熱的境界をいいます。</li>
        </ul>
        <p class="reform__notice">「ドア交換（ドアに対する内窓設置を含む）」については、他の窓の工事と同一の契約であり、<br>同時に申請する場合のみ、環境省の「先進的窓リノベ事業」の補助対象となります。</p>
        <div class="reform__img">
          <img src="<?php echo get_template_directory_uri() ?>/src/img/reform-img03.png" alt="">
        </div>
      </div>
    </div>
  </section>

  <section class="works" id="works">
    <div class="l-inner">
      <h2 class="heading-B works__heading">施工事例</h2>
      <p class="works__intro">
        私たちは自社で技術社員を育成し、<br class="is-sp">質の高い技術力を確保しています。<br>
        そのため、お客様のご要望に<br class="is-sp">スピーディかつ柔軟に対応でき、<br>
        高品質でありながら低コストを<br class="is-sp">実現しています。<br class="is-pc-tab">
        また、窓もドアも、<br class="is-sp">壁を壊す必要がないため工期が短く、<br>
        大体１日で終わることが多いです。
      </p>
      <div class="works__inner inner">
          <?php
          $query = new WP_Query(array(
              'post_type' => 'works',
              'posts_per_page' => 2  
          ));

          if ($query->have_posts()) :
              while ($query->have_posts()) : $query->the_post();
                  get_template_part('template-parts/work-content');
              endwhile;
          endif;
          wp_reset_postdata();
          ?>
      </div>
      <?php if (wp_count_posts('works')->publish > 2): ?>
          <a href="<?php echo esc_url(home_url('/work/')); ?>" class="works__more">
              他の施工事例を見る
          </a>
      <?php endif; ?>
    </div>
  </section>

  <section class="measure" id="measure">
    <div class="l-inner">
      <div class="measure__cont">
        <h2 class="heading-A">窓の測り方（幅と高さ）</h2>
        <p class="measure__txt">ガラスが納まっている<br class="is-sp">アルミサッシ枠を含めた<br>横幅、高さ、窓枠を測ってください。</p>
        <div class="measure__img">
          <picture>
            <source media="(max-width:767px)" type="image/png" srcset="<?php echo get_template_directory_uri() ?>/src/img/measure-img_sp.png" />
            <img src="<?php echo get_template_directory_uri() ?>/src/img/measure-img.png" alt="">
          </picture>
        </div>
      </div>

      <a href="https://www.kashiwaya-s.com/" target="_blank" class="hp-btn"><span><img src="<?php echo get_template_directory_uri() ?>/src/img/hp-btn-icon.svg" alt=""></span>柏屋商事ホームページ</a>
    </div>
  </section>




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
                      <span class="form__address-text"><span class="form__optional">任意</span>建物名・部屋番号</span>
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
                      <a href="https://www.dev-weroll.com/kashiwaya-lp/#measure" target="_blank">窓の測り方</a>
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

  document.addEventListener('DOMContentLoaded', function() {
    // フォームの要素を取得
    const form = document.getElementById('contact-form');
    if (!form) return;
    
    // カスタムエラーメッセージを定義
    const customMessages = {
      'your-name': 'お名前を入力してください',
      'your-email': 'メールアドレスを入力してください',
      'zip': '郵便番号を入力してください',
      'prefecture': '都道府県を選択してください',
      'city': '市区町村・番地を入力してください',
      'building': '建物名・部屋番号を入力してください',
      'tel': '電話番号を入力してください',
      'house-type': 'お住まいのタイプを選択してください',
      'reform-place': 'リフォームしたい箇所を選択してください',
      'preferred-date': '希望日を入力してください'
    };
    
    // フォーム送信時のバリデーション
    form.addEventListener('submit', function(event) {
      // 必須フィールドをチェック
      let firstErrorField = null;
      let hasError = false;
      
      // 全ての必須フィールドをチェック
      form.querySelectorAll('[required]').forEach(function(field) {
        // フィールドが空か、セレクトボックスの場合はデフォルト値のまま
        if (!field.value || (field.tagName === 'SELECT' && field.value === '' || field.value === '-- 選択してください --')) {
          // エラースタイルを適用
          field.style.borderColor = '#ff0000';
          field.style.backgroundColor = '#fff8f8';
          
          // エラーメッセージが既にあるか確認
          let existingError = findErrorMessage(field);
          if (!existingError) {
            // エラーメッセージを作成
            let message = 'このフィールドは必須です';
            
            // 通常のフィールド名チェック
            if (customMessages[field.name]) {
              message = customMessages[field.name];
            } 
            // 動的フィールド名（count-1, place-2など）のチェック
            else {
              // count-* パターンのフィールド
              if (/^count-\d+$/.test(field.name)) {
                message = '枚数を入力してください';
              } 
              // place-* パターンのフィールド
              else if (/^place-\d+$/.test(field.name)) {
                message = '場所を選択してください';
              }
            }
            
            // エラーメッセージを表示
            addErrorMessage(field, message);
          }
          
          // 最初のエラーフィールドを記録
          if (!firstErrorField) {
            firstErrorField = field;
          }
          
          hasError = true;
        }
      });
      
      // エラーチェック: メールアドレス
      const emailField = form.querySelector('input[name="your-email"]');
      if (emailField && emailField.value && !isValidEmail(emailField.value)) {
        if (!findErrorMessage(emailField)) {
          addErrorMessage(emailField, '有効なメールアドレスを入力してください');
        }
        emailField.style.borderColor = '#ff0000';
        emailField.style.backgroundColor = '#fff8f8';
        if (!firstErrorField) firstErrorField = emailField;
        hasError = true;
      }
      
      // エラーチェック: 電話番号
      const telField = form.querySelector('input[name="tel"]');
      if (telField && telField.value && !isValidTel(telField.value)) {
        if (!findErrorMessage(telField)) {
          addErrorMessage(telField, '有効な電話番号を入力してください');
        }
        telField.style.borderColor = '#ff0000';
        telField.style.backgroundColor = '#fff8f8';
        if (!firstErrorField) firstErrorField = telField;
        hasError = true;
      }
      
      // エラーチェック: 郵便番号（入力されている場合）
      const zipField = form.querySelector('input[name="zip"]');
      if (zipField && zipField.value && !isValidZip(zipField.value)) {
        if (!findErrorMessage(zipField)) {
          addErrorMessage(zipField, '有効な郵便番号を入力してください（例: 123-4567）');
        }
        zipField.style.borderColor = '#ff0000';
        zipField.style.backgroundColor = '#fff8f8';
        if (!firstErrorField) firstErrorField = zipField;
        hasError = true;
      }
      
      // エラーがある場合は送信をキャンセル
      if (hasError) {
        event.preventDefault();
        
        // 最初のエラーフィールドにスクロールとフォーカス
        if (firstErrorField) {
          setTimeout(function() {
            firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
            firstErrorField.focus();
          }, 100);
        }
      }
    });
    
    // 入力中にエラー表示をクリア
    form.addEventListener('input', function(e) {
      if (e.target.tagName === 'INPUT' || e.target.tagName === 'SELECT' || e.target.tagName === 'TEXTAREA') {
        e.target.style.borderColor = '';
        e.target.style.backgroundColor = '';
        
        const errorMsg = findErrorMessage(e.target);
        if (errorMsg) {
          errorMsg.remove();
        }
      }
    });
    
    // blur時のバリデーション（フォーカスが外れた時）
    form.addEventListener('blur', function(e) {
      console.log('hazureta')
      if ((e.target.tagName === 'INPUT' || e.target.tagName === 'SELECT' || e.target.tagName === 'TEXTAREA') && 
          e.target.hasAttribute('required')) {
        
        // 必須フィールドで値がない場合
        if (!e.target.value || (e.target.tagName === 'SELECT' && (e.target.value === '' || e.target.value === '-- 選択してください --'))) {
          e.target.style.borderColor = '#ff0000';
          e.target.style.backgroundColor = '#fff8f8';
          
          // メッセージが既にあるか確認
          if (!findErrorMessage(e.target)) {
            let message = 'このフィールドは必須です';
            
            // メッセージの取得
            if (customMessages[e.target.name]) {
              message = customMessages[e.target.name];
            } else if (/^count-\d+$/.test(e.target.name)) {
              message = '枚数を入力してください';
            } else if (/^place-\d+$/.test(e.target.name)) {
              message = '場所を選択してください';
            }
            
            addErrorMessage(e.target, message);
          }
        }
      }
      
      // メールアドレスのバリデーション
      if (e.target.name === 'your-email' && e.target.value && !isValidEmail(e.target.value)) {
        e.target.style.borderColor = '#ff0000';
        e.target.style.backgroundColor = '#fff8f8';
        if (!findErrorMessage(e.target)) {
          addErrorMessage(e.target, '有効なメールアドレスを入力してください');
        }
      }
      
      // 電話番号のバリデーション
      if (e.target.name === 'tel' && e.target.value && !isValidTel(e.target.value)) {
        e.target.style.borderColor = '#ff0000';
        e.target.style.backgroundColor = '#fff8f8';
        if (!findErrorMessage(e.target)) {
          addErrorMessage(e.target, '有効な電話番号を入力してください');
        }
      }
      
      // 郵便番号のバリデーション
      if (e.target.name === 'zip' && e.target.value && !isValidZip(e.target.value)) {
        e.target.style.borderColor = '#ff0000';
        e.target.style.backgroundColor = '#fff8f8';
        if (!findErrorMessage(e.target)) {
          addErrorMessage(e.target, '有効な郵便番号を入力してください（例: 123-4567）');
        }
      }
    }, true);
    
    // 窓追加ボタンがクリックされた後の処理
    const addWindowBtn = document.querySelector('.form__add-window');
    if (addWindowBtn) {
      addWindowBtn.addEventListener('click', function() {
        // 遅延を設けて新しい窓情報が追加された後に処理
        setTimeout(function() {
          const newWindow = document.querySelector('.window-info:last-child');
          if (newWindow) {
            // 新しい窓情報の必須項目を取得
            const requiredFields = newWindow.querySelectorAll('[required]');
            requiredFields.forEach(function(field) {
              // blur時のイベントを設定（既に設定されているのでここでは追加設定不要）
            });
          }
        }, 100);
      });
    }
  });
  
  // エラーメッセージを表示する関数
  function addErrorMessage(field, message) {
    const errorMsg = document.createElement('div');
    errorMsg.className = 'form__error';
    errorMsg.textContent = message;
    errorMsg.style.color = '#ff0000';
    errorMsg.style.fontSize = '14px';
    errorMsg.style.marginTop = '5px';
    errorMsg.style.display = 'block';
    
    // エラーメッセージを入力フィールドの直後に配置
    field.insertAdjacentElement('afterend', errorMsg);
  }
  
  // エラーメッセージを探す関数
  function findErrorMessage(field) {
    // 次の要素がエラーメッセージかチェック
    let nextEl = field.nextElementSibling;
    if (nextEl && nextEl.classList.contains('form__error')) {
      return nextEl;
    }
    return null;
  }
  
  // メールアドレスのバリデーション関数
  function isValidEmail(email) {
    const pattern = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
    return pattern.test(email);
  }
  
  // 電話番号のバリデーション関数
  function isValidTel(tel) {
    // ハイフンありなしどちらも許可
    const pattern = /^(0\d{1,4}-\d{1,4}-\d{4}|\d{10,11})$/;
    return pattern.test(tel);
  }
  
  // 郵便番号のバリデーション関数
  function isValidZip(zip) {
    // ハイフンありなしどちらも許可
    const pattern = /^(\d{3}-\d{4}|\d{7})$/;
    return pattern.test(zip);
  }

  
</script>

