<?php get_header('', ['pageId' => 'top']); ?>

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

      <div class="works__wrap">
        <?php get_template_part('template-parts/work-content'); ?>
      </div>

      <a href="/works/" class="works__more">他の施工事例を見る</a>
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

        <?php
          echo do_shortcode('[contact-form-7 id="88bedbd" title="無題"]');
          ?>


      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>