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
      // デバッグ情報（本番環境では削除してください）
      echo '<!-- DEBUG: Session data: ' . json_encode($_SESSION) . ' -->';
      
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
      echo do_shortcode('[contact-form-7 id="aac2c30" title="お問い合わせ確認"]');
      
      // 窓情報のHTMLを直接出力
      echo '<div id="window-info-container" style="margin: 20px 0;">';
      echo display_window_info_custom();
      echo '</div>';
      ?>
      
      <style>
      /* 窓情報のスタイル */
      .window-info-confirmation {
        margin: 10px 0;
      }
      
      .window-info-item {
        background-color: #f8f8f8;
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        padding: 15px;
        margin-bottom: 15px;
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
      </style>
      
      <script>
      document.addEventListener('DOMContentLoaded', function() {
        // 元の窓情報のコンテナを非表示にする
        document.querySelectorAll('.window-info').forEach(function(elem) {
          // 要素を完全に非表示にする代わりに高さ0で要素を保持
          elem.style.height = '0';
          elem.style.overflow = 'hidden';
          elem.style.margin = '0';
          elem.style.padding = '0';
          elem.style.border = 'none';
        });
        
        // 窓追加ボタンを非表示
        document.querySelectorAll('.confirm__add-btn, .form__add-btn').forEach(function(elem) {
          if (elem) elem.style.display = 'none';
        });
        
        // 窓情報コンテナを適切な位置に移動
        const windowInfoContainer = document.getElementById('window-info-container');
        const windowInfoElements = document.querySelectorAll('.window-info');
        
        if (windowInfoContainer && windowInfoElements.length > 0) {
          // 最初の窓情報要素の前に挿入
          windowInfoElements[0].parentNode.insertBefore(windowInfoContainer, windowInfoElements[0]);
        }
        
        // Console.logでデバッグ情報
        console.log('Window info elements:', windowInfoElements.length);
        console.log('Window info container:', windowInfoContainer);
      });
      </script>
    </div>
  </div>
</main>

<?php get_footer(); ?>