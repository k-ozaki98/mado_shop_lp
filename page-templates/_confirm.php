<?php
get_header('', ['pageId' => 'confirm']); 
?>

<main class="confirm-page">
  <div class="l-inner confirm-page__inner">
    <h1 class="heading-A confirm-page_ttl">お問い合わせ内容の確認</h1>
    
    <div class="form-container">
      <?php
      
      // Contact Form 7フォームを表示
      echo do_shortcode('[contact-form-7 id="f3f3d81" title="お問い合わせ_copy_確認画面"]');
      ?>
      
    </div>
  </div>
</main>

<?php get_footer(); ?>

