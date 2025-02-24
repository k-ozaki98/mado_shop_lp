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
    
    // デバッグ用ログ（問題解決後に削除可能）
    error_log('FORM DATA: ' . print_r($form_data, true));
    
    // 動的に追加されたフィールドのデータを処理
    $window_data = [];
    for ($i = 1; $i <= 5; $i++) {
        // count-1 フィールドが存在し、かつ値が設定されている場合
        if (isset($form_data["count-{$i}"]) && $form_data["count-{$i}"] !== '') {
            // 窓情報データを配列に追加
            $window_data[] = [
                'index' => $i,  // 元のインデックスを保存
                'height' => isset($form_data["height-{$i}"]) ? $form_data["height-{$i}"] : '',
                'width' => isset($form_data["width-{$i}"]) ? $form_data["width-{$i}"] : '',
                'frame' => isset($form_data["frame-{$i}"]) ? $form_data["frame-{$i}"] : '',
                'count' => $form_data["count-{$i}"],
                'place' => isset($form_data["place-{$i}"]) ? $form_data["place-{$i}"] : ''
            ];
            
            // ファイルアップロードの処理
            $file_field = "photo-{$i}";
            $uploaded_files = $submission->uploaded_files();
            
            if (!empty($uploaded_files[$file_field])) {
                $window_data[count($window_data) - 1]['photo'] = '添付あり';
            } else {
                $window_data[count($window_data) - 1]['photo'] = 'なし';
            }
        }
    }
    
    // 窓情報が存在する場合のみ処理
    if (!empty($window_data)) {
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
            $window_info .= "写真: {$data['photo']}\n";
        }
        
        $mail['body'] = $mail_body . $window_info;
        $contact_form->set_properties(['mail' => $mail]);
        
        // セッションに窓情報を保存（確認画面用）
        if (!session_id()) {
            session_start();
        }
        $_SESSION['window_data'] = $window_data;
        
        // デバッグログ
        error_log('WINDOW DATA SAVED TO SESSION: ' . print_r($window_data, true));
    } else {
        error_log('NO WINDOW DATA FOUND');
    }
    
    return $contact_form;
}

// 確認画面で窓情報を表示するためのショートコード
add_shortcode('show_window_info', 'display_window_info');
function display_window_info() {
    if (!session_id()) {
        session_start();
    }
    
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
        $size_info = '';
        if (!empty($data['height']) || !empty($data['width']) || !empty($data['frame'])) {
            $size_info = "<p><strong>サイズ:</strong> {$data['height']} × {$data['width']} × {$data['frame']}</p>";
        } else {
            $size_info = "<p><strong>サイズ:</strong> 未入力</p>";
        }
        
        $output .= $size_info;
        $output .= "<p><strong>枚数:</strong> {$data['count']}</p>";
        
        // 場所の値が配列の場合は文字列に変換
        $place = $data['place'];
        if (is_array($place)) {
            $place = implode(', ', $place);
        }
        
        $output .= "<p><strong>場所:</strong> {$place}</p>";
        $output .= "<p><strong>写真:</strong> {$data['photo']}</p>";
        $output .= '</div>';
    }
    
    $output .= '</div>';
    return $output;
}

// WordPress 初期化時にセッションを開始
add_action('init', 'start_session', 1);
function start_session() {
    if (!session_id()) {
        session_start();
    }
}

// テンプレート内でショートコードを実行できるようにする
add_filter('widget_text', 'do_shortcode');
add_filter('the_content', 'do_shortcode', 11);

// ショートコードを高い優先度で登録
remove_shortcode('show_window_info'); // 既存の登録を削除
add_shortcode('show_window_info', 'display_window_info', 5);





