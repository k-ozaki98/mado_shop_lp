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

// 不要なpタグを除去
add_filter('wpcf7_autop_or_not', '__return_false');

// フォーム要素のクラスをカスタマイズ
add_filter('wpcf7_form_elements', function($content) {
    // 特定のタグや属性を置換
    $content = preg_replace('/<p>(.*?)<\/p>/s', '$1', $content);
    // 例: spanタグを除去
    $content = preg_replace('/<span class="wpcf7-form-control-wrap.*?">(.*?)<\/span>/s', '$1', $content);
    
    return $content;
});


// 動的フィールドを追加
add_action('wpcf7_before_send_mail', 'handle_dynamic_fields', 10, 3);

function handle_dynamic_fields($contact_form, &$abort, $submission) {
    $form_data = $submission->get_posted_data();
    
    // 動的に追加されたフィールドのデータを処理
    $window_data = [];
    for ($i = 1; $i <= 5; $i++) {
        if (isset($form_data["height-{$i}"])) {
            $window_data[] = [
                'height' => $form_data["height-{$i}"],
                'width' => $form_data["width-{$i}"],
                'frame' => $form_data["frame-{$i}"],
                'photo' => $form_data["photo-{$i}"],
                'count' => $form_data["count-{$i}"],
                'place' => $form_data["place-{$i}"]
            ];
        }
    }
    
    // メール本文にデータを追加
    $mail = $contact_form->prop('mail');
    $mail_body = $mail['body'];
    
    $window_info = "\n\n== 窓の情報 ==\n";
    foreach ($window_data as $index => $data) {
        $num = $index + 1;
        $window_info .= "\n窓の情報（{$num}）\n";
        $window_info .= "サイズ: {$data['height']} × {$data['width']} × {$data['frame']}\n";
        $window_info .= "枚数: {$data['count']}\n";
        $window_info .= "場所: {$data['place']}\n";
    }
    
    $mail['body'] = $mail_body . $window_info;
    $contact_form->set_properties(['mail' => $mail]);
    
    return $contact_form;
}
