<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-pageid="<?php echo isset($args['pageId']) ? esc_attr($args['pageId']) : ''; ?>">
  <?php wp_body_open(); ?>
  <header class="header is-pc-tab">
    <div class="header__inner">
      <div class="header__wrap">
        <div class="header__logo">
          <img src="<?php echo get_template_directory_uri() ?>/src/img/logo.png" alt="" width="121" height="80">
        </div>
        <ul class="header__list">
          <li><a href="/kashiwaya-lp/">TOP</a></li>
          <li><a href="/kashiwaya-lp/subsidy">補助金情報</a></li>
          <li><a href="/kashiwaya-lp/#reform">窓・ドアの<br>リフォーム</a></li>
          <li><a href="/kashiwaya-lp/work">施工事例</a></li>
          <li><a href="/kashiwaya-lp/#measure">窓の測り方</a></li>
        </ul>
        <a href="/kashiwaya-lp/#contact" class="header__contact">お問い合わせ</a>
      </div>
    </div>
  </header>

  <header class="header is-sp">
    <div class="header__wrap">
      <div class="hmbbtn">
        <div class="hmb-btn js-hmb-btn">
          <div class="hmb-btn__inner">
            <div class="hmb-btn__hmb">
              <span></span><span></span>
            </div>
          </div>
          <p class="hmb-btn__txt">MENU</p>
        </div>
      </div>
    </div>
  </header>
  <a href="/kashiwaya-lp/#contact" class="header__contact is-sp">お問い合わせ</a>

  <div class="menu-sp is-sp">
    <div class="menu-sp__wrap">
      <ul class="menu-sp__list">
        <li><a href="/kashiwaya-lp/">TOP</a></li>
        <li><a href="/kashiwaya-lp/subsidy">補助金情報</a></li>
        <li><a href="/kashiwaya-lp/#reform">窓・ドアのリフォーム</a></li>
        <li><a href="/kashiwaya-lp/work">施工事例</a></li>
        <li><a href="/kashiwaya-lp/#measure">窓の測り方</a></li>
        <li><a href="/kashiwaya-lp/#contact">お問い合わせ</a></li>
      </ul>
      <a href="https://www.kashiwaya-s.com/" target="_blank" class="hp-btn"><span><img src="<?php echo get_template_directory_uri() ?>/src/img/hp-btn-icon.svg" alt=""></span>柏屋商事ホームページ</a>
      <p class="copyright">© Kashiwaya Corporation All Rights Reserved.</p>
    </div>
  </div>