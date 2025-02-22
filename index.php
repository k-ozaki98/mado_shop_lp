<?php get_header('', ['pageId' => 'top']); ?>

<main>

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

