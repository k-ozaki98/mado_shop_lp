<?php
get_header('', ['pageId' => 'confirm']); 
// セッションを確実に開始
if (!session_id()) {
    session_start();
}
?>

<main class="confirm">
  <div class="l-inner confirm__inner">
    <h1 class="heading-A confirm_ttl">お問い合わせ内容の確認</h1>
    
    <div class="form-container">
      <?php
      // 窓情報を直接表示する関数
      function display_window_info_custom() {
        if (empty($_SESSION['window_data'])) {
          return '<p class="no-window-info">窓情報はありません</p>';
        }
        
        $window_data = $_SESSION['window_data'];
        $output = '<div class="window-info-confirmation">';
        
        foreach ($window_data as $index => $data) {
          $num = $index + 1;
          $output .= '<div class="window-info-item">';
          $output .= "<h4 class=\"window-info__title\">窓の情報（{$num}）</h4>";
          
          // サイズ情報
          $height = isset($data['height']) ? $data['height'] : '';
          $width = isset($data['width']) ? $data['width'] : '';
          $frame = isset($data['frame']) ? $data['frame'] : '';
          
          if (!empty($height) || !empty($width) || !empty($frame)) {
            $output .= "<p><strong>サイズ:</strong> {$height} × {$width} × {$frame}</p>";
          } else {
            $output .= "<p><strong>サイズ:</strong> 未入力</p>";
          }
          
          $count = isset($data['count']) ? $data['count'] : '';
          $output .= "<p><strong>枚数:</strong> {$count}</p>";
          
          // 場所の値が配列の場合は文字列に変換
          $place = isset($data['place']) ? $data['place'] : '';
          if (is_array($place)) {
            $place = implode(', ', $place);
          }
          
          $output .= "<p><strong>場所:</strong> {$place}</p>";
          
          $photo = isset($data['photo']) ? $data['photo'] : 'なし';
          $output .= "<p><strong>写真:</strong> {$photo}</p>";
          $output .= '</div>';
        }
        
        $output .= '</div>';
        return $output;
      }
      
      // Contact Form 7フォームを表示
      echo do_shortcode('[contact-form-7 id="c22d3ea" title="お問い合わせ確認_copy"]');
      ?>
      
      <!-- 窓情報を表示するためのウィジェット -->
      <div class="confirm__item window-info-section">
        <label class="confirm__label">
          <span class="confirm__text">窓の情報</span>
        </label>
        <div class="confirm__wrap">
          <?php echo display_window_info_custom(); ?>
        </div>
      </div>
      
      <style>
      /* 窓情報のスタイル */
      .window-info-confirmation {
        margin: 0;
      }
      
      .window-info-item {
        background-color: #f8f8f8;
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        padding: 15px;
        margin-bottom: 15px;
      }
      
      .window-info-item:last-child {
        margin-bottom: 0;
      }
      
      .window-info__title {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 10px;
        padding-bottom: 5px;
        border-bottom: 1px solid #ddd;
      }
      
      .window-info-item p {
        margin: 8px 0;
        padding: 0;
      }
      
      .no-window-info {
        padding: 10px;
        background-color: #f9f9f9;
        border-left: 3px solid #ccc;
        font-style: italic;
      }
      
      /* 確認画面では元の窓情報フィールドと追加ボタンを非表示 */
      .window-info {
        display: none !important;
      }
      
      .form__add-btn, 
      .form__add-window,
      .confirm__add-btn {
        display: none !important;
      }
      
      /* 窓情報セクションのレイアウト調整 */
      .window-info-section {
        margin: 20px 0;
      }
      
      /* Contact Form 7の確認画面用スタイル微調整 */
      .confirm__wrap {
        margin-bottom: 8px;
      }
      </style>
    </div>
  </div>
</main>

<?php get_footer(); ?>

