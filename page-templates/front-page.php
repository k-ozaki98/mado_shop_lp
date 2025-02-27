<?php 
session_start(); 

get_header('', ['pageId' => 'top']); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // POSTデータを保存
  $_SESSION['inquiry_data'] = $_POST;
  
  // 確認ページにリダイレクト
  wp_redirect(home_url('/confirm'));
  exit;
}

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
                <input type="text" name="your-name" class="form__input" required>
              </div>
            </div>

            <div class="form__item">
              <label class="form__label">
                <span class="form__required">必須</span>
                <span class="form__text">メールアドレス</span>
              </label>
              <div class="form__wrap">
                <input type="email" name="your-email" class="form__input" required>
              </div>
            </div>

            <div class="form__item">
              <label class="form__label">郵便番号</label>
              <div class="form__wrap">
                <input type="text" name="zip" class="form__input">
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
                    <option value="北海道">北海道</option>
                    <option value="青森県">青森県</option>
                    <option value="岩手県">岩手県</option>
                    <option value="宮城県">宮城県</option>
                    <option value="秋田県">秋田県</option>
                    <option value="山形県">山形県</option>
                    <option value="福島県">福島県</option>
                    <option value="茨城県">茨城県</option>
                    <option value="栃木県">栃木県</option>
                    <option value="群馬県">群馬県</option>
                    <option value="埼玉県">埼玉県</option>
                    <option value="千葉県">千葉県</option>
                    <option value="東京都">東京都</option>
                    <option value="神奈川県">神奈川県</option>
                    <option value="新潟県">新潟県</option>
                    <option value="富山県">富山県</option>
                    <option value="石川県">石川県</option>
                    <option value="福井県">福井県</option>
                    <option value="山梨県">山梨県</option>
                    <option value="長野県">長野県</option>
                    <option value="岐阜県">岐阜県</option>
                    <option value="静岡県">静岡県</option>
                    <option value="愛知県">愛知県</option>
                    <option value="三重県">三重県</option>
                    <option value="滋賀県">滋賀県</option>
                    <option value="京都府">京都府</option>
                    <option value="大阪府">大阪府</option>
                    <option value="兵庫県">兵庫県</option>
                    <option value="奈良県">奈良県</option>
                    <option value="和歌山県">和歌山県</option>
                    <option value="鳥取県">鳥取県</option>
                    <option value="島根県">島根県</option>
                    <option value="岡山県">岡山県</option>
                    <option value="広島県">広島県</option>
                    <option value="山口県">山口県</option>
                    <option value="徳島県">徳島県</option>
                    <option value="香川県">香川県</option>
                    <option value="愛媛県">愛媛県</option>
                    <option value="高知県">高知県</option>
                    <option value="福岡県">福岡県</option>
                    <option value="佐賀県">佐賀県</option>
                    <option value="長崎県">長崎県</option>
                    <option value="熊本県">熊本県</option>
                    <option value="大分県">大分県</option>
                    <option value="宮崎県">宮崎県</option>
                    <option value="鹿児島県">鹿児島県</option>
                    <option value="沖縄県">沖縄県</option>
                  </select>
                </div>
                <div class="form__address-detail">
                  <label class="form__label">
                    <span class="form__required is-sp">必須</span>
                    <span class="form__address-text">市区町村・番地</span>
                  </label>
                  <input type="text" name="city" class="form__input" required>
                </div>
                <div class="form__address-detail">
                  <label class="form__label">
                    <span class="form__required is-sp">必須</span>
                    <span class="form__address-text">建物名・部屋番号</span>
                  </label>
                  <input type="text" name="building" class="form__input" required>
                </div>
              </div>
            </div>

            <div class="form__item">
              <label class="form__label">
                <span class="form__required">必須</span>
                <span class="form__text">電話番号</span>
              </label>
              <div class="form__wrap">
                <input type="tel" name="tel" class="form__input" required>
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
                  <option value="戸建て">戸建て</option>
                  <option value="マンション">マンション</option>
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
                  <option value="窓">窓</option>
                  <option value="玄関ドア">玄関ドア</option>
                </select>
              </div>
            </div>

            <!-- 窓の情報 -->
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
                      <input type="text" name="height-1" class="form__input-s">
                    </div>
                    <span>×</span>
                    <div class="window-info__item">
                      <span class="window-info__label">幅</span>
                      <input type="text" name="width-1" class="form__input-s">
                    </div>
                    <span>×</span>
                    <div class="window-info__item">
                      <span class="window-info__label">窓枠</span>
                      <input type="text" name="frame-1" class="form__input-s">
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
                <!-- ファイル入力を非表示にする -->
                <div class="window-info__file-wrapper">
                  <input type="file" name="photo-1" class="form__file">
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
                  <input type="number" name="count-1" class="form__input-s" min="1" required>
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
                      <option value="LDK">LDK</option>
                      <option value="浴室">浴室</option>
                      <option value="和室">和室</option>
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
                <div class="form__date">
                  <div class="window-info__wrap window-info__wrap--unit window-info__wrap--unit--month">
                    <input type="number" name="preferred-month" class="form__input-s" min="1" max="12">
                  </div>
                  <div class="window-info__wrap window-info__wrap--unit window-info__wrap--unit--date">
                    <input type="number" name="preferred-day" class="form__input-s" min="1" max="31">
                  </div>
                </div>
                <p class="form__note">ご希望の調査日時間帯を記載していただくとよりスムーズです。</p>
              </div>
            </div>

            <div class="form__item">
              <label class="form__label">その他</label>
              <div class="form__wrap">
                <textarea name="other" class="form__textarea"></textarea>
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

