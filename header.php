<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-pageid="<?php echo isset($args['pageId']) ? esc_attr($args['pageId']) : ''; ?>">
  <?php wp_body_open(); ?>
  <header class="header is-pc-tab">
    <a href="/#contact" class="header__contact">お問い合わせ</a>
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
      <a href="/#contact" class="header__contact">お問い合わせ</a>
    </div>
  </header>

  <div class="menu-sp is-sp">
    <div class="menu-sp__wrap">
      <ul class="menu-sp__list">
        <li><a href="/">TOP</a></li>
        <li><a href="/#subsidy">補助金情報</a></li>
        <li><a href="/#reform">窓・ドアのリフォーム</a></li>
        <li><a href="/#works">施工事例</a></li>
        <li><a href="/#measure">窓の測り方</a></li>
        <li><a href="/#contact">お問い合わせ</a></li>
      </ul>
      <a href="" class="hp-btn"><span><img src="<?php echo get_template_directory_uri() ?>/src/img/hp-btn-icon.svg" alt=""></span>柏屋商事ホームページ</a>
      <p class="copyright">© Kashiwaya Corporation All Rights Reserved.</p>
    </div>
  </div>