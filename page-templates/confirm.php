<?php
get_header('', ['pageId' => 'confirm']); 
?>

<main class="confirm-page">
  <div class="l-inner confirm-page__inner">
    <h1 class="heading-A confirm-page_ttl">お問い合わせ内容の確認</h1>
    
    <div class="form-container">
      <?php
      
      // Contact Form 7フォームを表示
      // echo do_shortcode('[contact-form-7 id="e1b726c" title="お問い合わせ確認画面これが最後"]');
          echo do_shortcode('[inquiry_confirmation]');
          

      ?>
      
    </div>
  </div>
</main>

<?php get_footer(); ?>

