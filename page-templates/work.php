<?php get_header('', ['pageId' => 'works']); ?>

<main class="works">
  <div class="mv-sub mv-sub--work">
    <div class="mv-sub__logo">
      <img src="<?php echo get_template_directory_uri() ?>/src/img/logo.png" alt="" width="138" height="91">
    </div>
  </div>

  <div class="nav is-pc-tab">
    <div class="l-inner">
      <ul class="nav__list">
        <li class="nav__item" data-nav-id="top"><a href="/kashiwaya-lp/">TOP</a></li>
        <li class="nav__item" data-nav-id="subsidy"><a href="/kashiwaya-lp/#subsidy">補助金情報</a></li>
        <li class="nav__item"><a href="/kashiwaya-lp/#reform">窓・ドアの<br>リフォーム</a></li>
        <li class="nav__item" data-nav-id="works"><a href="/kashiwaya-lp/#works">施工事例</a></li>
        <li class="nav__item"><a href="/kashiwaya-lp/#measure">窓の測り方</a></li>
      </ul>
    </div>
  </div>

  <div class="work-cont">
    <div class="l-inner">
      <h2 class="heading-B">施工事例</h2>
      <div class="inner">
        <p class="work-cont__txt">私たちは自社で技術社員を育成し、<br class="is-sp">質の高い技術力を確保しています。<br>そのため、お客様のご要望に<br class="is-sp">スピーディかつ柔軟に対応でき、<br>高品質でありながら<br class="is-sp">低コストを実現しています。<br>また、窓もドアも、壁を壊す必要がないため<br class="is-sp">工期が短く、<br>大体１日で終わることが多いです。</p>
      </div>
    </div>

  </div>


  <div class="l-inner">

    <?php
        $query = new WP_Query(array(
            'post_type' => 'works',
            'posts_per_page' => -1
        ));

        if ($query->have_posts()) :
            echo '<div class="works__inner inner">';
            while ($query->have_posts()) : $query->the_post();
                get_template_part('template-parts/work-content');
            endwhile;
            echo '</div>';
        else :
            echo '<p>施工事例がありません。</p>';
        endif;
        wp_reset_postdata();
    ?>
  </div>

</main>


<?php wp_reset_postdata(); ?>

<?php get_footer(); ?>