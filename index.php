<?php get_header(); ?>

<main>

  <section class="contact" id="contact">
    <div class="l-inner">
      <h2 class="contact__title">お問い合わせフォーム</h2>
        
        <?php
        echo do_shortcode('[contact-form-7 id="88bedbd" title="無題"]');
        ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>