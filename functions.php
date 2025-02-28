<?php

// テーマの初期設定
require_once get_template_directory() . '/inc/init.php';

// カスタム投稿タイプの登録
require_once get_template_directory() . '/inc/post-types.php';




/**
 * スクリプトとスタイルの読み込み
 */
function theme_scripts() {
    // メインのCSS
    $compiled_css = get_template_directory() . '/dist/assets/styles/style.css';
    if (file_exists($compiled_css)) {
        wp_enqueue_style(
            'theme-style',
            get_template_directory_uri() . '/dist/assets/styles/style.css',
            [],
            filemtime($compiled_css)
        );
    }

    // JavaScript
    $compiled_js = get_template_directory() . '/dist/assets/js/script-bundle.js';
    if (file_exists($compiled_js)) {
        wp_enqueue_script(
            'theme-scripts',
            get_template_directory_uri() . '/dist/assets/js/script-bundle.js',
            ['jquery'],
            filemtime($compiled_js),
            true
        );

        // JavaScriptのグローバル変数を設定
        wp_localize_script('theme-scripts', 'themeVars', [
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'themeUrl' => get_template_directory_uri()
        ]);
    }
}
add_action('wp_enqueue_scripts', 'theme_scripts');


// カレンダーライブラリ読み込み
require_once get_template_directory() . '/inc/date-picker.php';

// バリデーション設定
// require_once get_template_directory() . '/inc/validate_form.php';

// 不要なpタグを除去
// add_filter('wpcf7_autop_or_not', '__return_false');

// // フォーム要素のクラスをカスタマイズ
// add_filter('wpcf7_form_elements', function($content) {
//     // 特定のタグや属性を置換
//     $content = preg_replace('/<p>(.*?)<\/p>/s', '$1', $content);
//     // 例: spanタグを除去
//     $content = preg_replace('/<span class="wpcf7-form-control-wrap.*?">(.*?)<\/span>/s', '$1', $content);
    
//     return $content;
// });


// テンプレート内でショートコードを実行できるようにする
// add_filter('widget_text', 'do_shortcode');
// add_filter('the_content', 'do_shortcode', 11);





// function dynamic_hidden_fields($form_tag) {
//     // height が未定義の場合、空の配列をセット
//     $height = isset($_POST['height']) ? $_POST['height'] : array();
    
//     if ($form_tag['name'] == 'window_count') {
//         $form_tag['values'] = array(count($height));
//     }
//     return $form_tag;
// }
// add_filter('wpcf7_form_tag', 'dynamic_hidden_fields');




// フォーム送信処理
function handle_form_submission() {
    // サンクスページでの処理（最終送信）
    if (isset($_POST['final_submit']) && $_POST['final_submit'] == 1) {
        // メール送信処理を実行
        send_form_mail($_POST);
    }
}
add_action('template_redirect', 'handle_form_submission');

/**
 * フォームメール送信処理
 */
function send_form_mail($data) {
    // 送信先（管理者メールアドレス）
    $to = get_option('admin_email');
    $subject = 'ウェブサイトからのお問い合わせ';
    
    // メール本文を作成
    $body = "お問い合わせフォームから以下の内容が送信されました。\n\n";
    $body .= "【お名前】: " . $data['your-name'] . "\n";
    $body .= "【メールアドレス】: " . $data['your-email'] . "\n";
    
    if (!empty($data['zip'])) {
        $body .= "【郵便番号】: " . $data['zip'] . "\n";
    }
    
    $body .= "【住所】: " . $data['prefecture'] . $data['city'];
    if (!empty($data['building'])) {
        $body .= " " . $data['building'];
    }
    $body .= "\n";
    
    $body .= "【電話番号】: " . $data['tel'] . "\n";
    $body .= "【お住まいのタイプ】: " . $data['house-type'] . "\n";
    $body .= "【リフォームしたい箇所】: " . $data['reform-place'] . "\n";
    
    // 窓の情報
    if ($data['reform-place'] === '窓') {
        // データから窓の数を判断
        $window_count = 0;
        foreach ($data as $key => $value) {
            if (preg_match('/^count-(\d+)$/', $key, $matches)) {
                $window_count = max($window_count, intval($matches[1]));
            }
        }
        
        for ($i = 1; $i <= $window_count; $i++) {
            if (isset($data["count-$i"]) && isset($data["place-$i"])) {
                $body .= "\n【窓の情報(" . $i . ")】\n";
                
                if (!empty($data["height-$i"]) && !empty($data["width-$i"])) {
                    $body .= "  サイズ: 高さ" . $data["height-$i"] . " × 幅" . $data["width-$i"];
                    if (!empty($data["frame-$i"])) {
                        $body .= " × 窓枠" . $data["frame-$i"];
                    }
                    $body .= "\n";
                }
                
                $body .= "  枚数: " . $data["count-$i"] . "\n";
                $body .= "  場所: " . $data["place-$i"] . "\n";
            }
        }
    }
    
    // 現地調査希望日
    if (!empty($data['preferred-date'])) {
        $body .= "【現地調査希望日】: " . $data['preferred-date'];
        
        if (!empty($data['preferred-time'])) {
            $body .= " (" . $data['preferred-time'] . ")";
        }
        
        $body .= "\n";
    } else {
        $body .= "【現地調査希望日】: 未入力\n";
    }
    
    // その他
    if (!empty($data['other'])) {
        $body .= "【その他】: \n" . $data['other'] . "\n";
    }
    
    // メールヘッダー
    $headers = [
        'From: ' . $data['your-name'] . ' <' . $data['your-email'] . '>',
        'Reply-To: ' . $data['your-email'],
        'Content-Type: text/plain; charset=UTF-8'
    ];
    
    // メール送信
    $mail_sent = wp_mail($to, $subject, $body, $headers);
    
    // 自動返信メール
    if ($mail_sent) {
        $auto_reply_subject = 'お問い合わせありがとうございます';
        $auto_reply_body = $data['your-name'] . " 様\n\n";
        $auto_reply_body .= "お問い合わせいただきありがとうございます。\n";
        $auto_reply_body .= "以下の内容でお問い合わせを受け付けました。\n\n";
        $auto_reply_body .= $body;
        $auto_reply_body .= "\n※このメールは自動送信されています。このメールに返信しないでください。\n";
        
        $auto_reply_headers = [
            'From: ' . get_bloginfo('name') . ' <' . get_option('admin_email') . '>',
            'Content-Type: text/plain; charset=UTF-8'
        ];
        
        wp_mail($data['your-email'], $auto_reply_subject, $auto_reply_body, $auto_reply_headers);
    }
    
    return $mail_sent;
}

// ファイルアップロード処理
function handle_file_uploads($post_data) {
    $uploaded_files = [];
    
    foreach ($_FILES as $key => $file) {
        if (preg_match('/^photo-(\d+)$/', $key) && !empty($file['name'])) {
            // アップロードディレクトリの作成
            $upload_dir = wp_upload_dir();
            $target_dir = $upload_dir['basedir'] . '/form_uploads/';
            
            if (!file_exists($target_dir)) {
                wp_mkdir_p($target_dir);
            }
            
            $file_name = sanitize_file_name($file['name']);
            $target_file = $target_dir . time() . '_' . $file_name;
            
            if (move_uploaded_file($file['tmp_name'], $target_file)) {
                $uploaded_files[$key] = $target_file;
            }
        }
    }
    
    return $uploaded_files;
}

