<?php get_header('', ['pageId' => 'thanks']); ?>

<main class="thanks">
  <div class="l-inner thanks__inner">
    <h1 class="thanks__ttl">お問い合わせが完了しました</h1>
    <p class="thanks__text">
      お問合せいただきありがとうございました。<br>
      内容を確認のうえ、折り返しご連絡いたします。<br>
      今しばらくお待ちください。
    </p>
    <div class="thanks__btn">
      <a href="<?php echo home_url(); ?>">TOPへ戻る</a>
    </div>
  </div>
</main>

<?php get_footer(); ?>
