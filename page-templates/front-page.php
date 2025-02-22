<?php get_header('', ['pageId' => 'top']); ?>

<main>

  <section class="works">
    <div class="l-inner">
      <h2 class="works__heading">施工事例</h2>
      <p class="works__intro">
      私たちは自社で技術社員を育成し、質の高い技術力を確保しています。<br>
      そのため、お客様のご要望にスピーディかつ柔軟に対応でき、<br>
      高品質でありながら低コストを実現しています。<br>
      また、窓もドアも、壁を壊す必要がないため工期が短く、<br>
      大体１日で終わることが多いです。
      </p>
      <?php get_template_part('template-parts/work-content'); ?>

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

