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
    
    // jQuery UI Datepicker
    wp_enqueue_style('jquery-ui-css', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
    wp_enqueue_script('jquery-ui-datepicker');
}
add_action('wp_enqueue_scripts', 'theme_scripts');

function enqueue_datepicker() {
    // 日本語化だけを行う場合は以下のような小さなJS追加も可能
    wp_add_inline_script('jquery-ui-datepicker', '
        jQuery(document).ready(function($){
            $.datepicker.regional["ja"] = {
                closeText: "閉じる",
                prevText: "&#x3C;前",
                nextText: "次&#x3E;",
                currentText: "今日",
                monthNames: ["1月","2月","3月","4月","5月","6月","7月","8月","9月","10月","11月","12月"],
                monthNamesShort: ["1月","2月","3月","4月","5月","6月","7月","8月","9月","10月","11月","12月"],
                dayNames: ["日曜日","月曜日","火曜日","水曜日","木曜日","金曜日","土曜日"],
                dayNamesShort: ["日","月","火","水","木","金","土"],
                dayNamesMin: ["日","月","火","水","木","金","土"],
                weekHeader: "週",
                dateFormat: "yy/mm/dd",
                firstDay: 0,
                isRTL: false,
                showMonthAfterYear: true,
                yearSuffix: "年"
            };
            $.datepicker.setDefaults($.datepicker.regional["ja"]);
        });
    ');
}
add_action('wp_enqueue_scripts', 'enqueue_datepicker');

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


/**
 * フォーム送信処理（確認画面の送信を防ぐ）
 */
function handle_form_submission() {
    if (!session_id()) {
        session_start();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['final_submit']) && $_POST['final_submit'] == 1) {
        // すでに送信済みかをチェック
        if (!empty($_SESSION['form_submitted'])) {
            return; // 2回目の送信を防ぐ
        }
        
        // メール送信処理を実行
        $result = send_form_mail($_POST);
        
        // 送信成功した場合のみフラグを設定しリダイレクト
        if ($result) {
            $_SESSION['form_submitted'] = true;
            wp_safe_redirect(home_url('/thanks/'));
            exit;
        }
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

    // 窓の情報を動的に取得
    $window_count = 0;
    foreach ($data as $key => $value) {
        if (preg_match('/^place-(\d+)$/', $key, $matches)) {
            $window_count = max($window_count, intval($matches[1]));
        }
    }

    if ($window_count > 0) {
        $body .= "\n【リフォーム情報】\n";

        for ($i = 1; $i <= $window_count; $i++) {
            if (!empty($data["place-$i"])) {
                $body .= "\n--- リフォーム箇所 {$i} ---\n";
                
                // reform-placeの値を取得
                $reform_place = isset($data["reform-place-$i"]) ? $data["reform-place-$i"] : "未入力";
                $body .= "  【リフォームしたい箇所】: " . $reform_place . "\n";
                
                $body .= "  【場所】: " . $data["place-$i"] . "\n";
                
                if (!empty($data["height-$i"]) && !empty($data["width-$i"])) {
                    $body .= "  【サイズ】: 高さ" . $data["height-$i"] . "cm × 幅" . $data["width-$i"] . "cm";
                    if (!empty($data["frame-$i"])) {
                        $body .= " × 窓枠" . $data["frame-$i"] . "cm";
                    }
                    $body .= "\n";
                }
            }
        }
    }

    // 現地調査希望日
    if (!empty($data['preferred-date'])) {
        $body .= "\n【現地調査希望日】: " . $data['preferred-date'];
        
        if (!empty($data['preferred-time'])) {
            $body .= " (" . $data['preferred-time'] . ")";
        }
        
        $body .= "\n";
    } else {
        $body .= "【現地調査希望日】: 未入力\n";
    }
    
    // その他
    if (!empty($data['other'])) {
        $body .= "\n【その他】: \n" . $data['other'] . "\n";
    }
    
    // メールヘッダー
    $headers = [
        'From: ' . $data['your-name'] . ' <' . $data['your-email'] . '>',
        'Reply-To: ' . $data['your-email'],
        'Content-Type: text/plain; charset=UTF-8'
    ];
    
    // メール送信（1回のみ）
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

