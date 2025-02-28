<?php
/**
 * フォームバリデーション処理
 */

// validate_form.php の validate_contact_form 関数内に追加
function validate_contact_form() {
  // デバッグログ
  error_log('validate_contact_form called. POST: ' . print_r($_POST, true));
  
  // 以下は既存のコード
  if (empty($_POST) || isset($_POST['final_submit'])) {
      error_log('Validation skipped: empty POST or final_submit found');
      return;
  }
  
  if (isset($_POST['your-name'])) {
      error_log('Contact form detected, validating...');
      $errors = validate_form_data($_POST);
      
      if (!empty($errors)) {
          error_log('Validation errors found: ' . print_r($errors, true));
          // エラーがある場合、セッションに保存してリダイレクト
          if (!session_id()) {
              session_start();
          }
          
          $_SESSION['form_errors'] = $errors;
          $_SESSION['form_data'] = $_POST;
          
          // デバッグ用にセッション情報も記録
          error_log('Session data saved. Session ID: ' . session_id());
          
          // URLにハッシュタグを追加してリダイレクト
          wp_redirect(home_url('/#contact'));
          exit;
      }
  }
}

/**
 * フォームデータのバリデーション
 */
function validate_form_data($data) {
    $errors = [];
    
    // 必須項目のチェック
    $required_fields = [
        'your-name' => 'お名前',
        'your-email' => 'メールアドレス',
        'tel' => '電話番号',
        'prefecture' => '都道府県',
        'house-type' => 'お住まいのタイプ',
        'reform-place' => 'リフォームしたい箇所'
    ];
    
    foreach ($required_fields as $field => $label) {
        if (empty($data[$field])) {
            $errors[] = $label . 'は必須項目です';
        }
    }
    
    // メールアドレスの形式チェック
    if (!empty($data['your-email']) && !filter_var($data['your-email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'メールアドレスの形式が正しくありません';
    }
    
    // 電話番号の形式チェック
    if (!empty($data['tel']) && !preg_match('/^[0-9\-]+$/', $data['tel'])) {
        $errors[] = '電話番号は数字とハイフンのみで入力してください';
    }
    
    // 窓情報のバリデーション
    if (isset($data['reform-place']) && $data['reform-place'] === '窓') {
        // データから窓の数を判断
        $window_count = 0;
        foreach ($data as $key => $value) {
            if (preg_match('/^count-(\d+)$/', $key, $matches)) {
                $window_count = max($window_count, intval($matches[1]));
            }
        }
        
        for ($i = 1; $i <= $window_count; $i++) {
            if (empty($data["count-$i"])) {
                $errors[] = "窓の情報（$i）の枚数は必須項目です";
            }
            if (empty($data["place-$i"])) {
                $errors[] = "窓の情報（$i）の場所は必須項目です";
            }
        }
    }
    
    return $errors;
}

remove_action('template_redirect', 'validate_contact_form');
add_action('template_redirect', 'validate_contact_form', 5);