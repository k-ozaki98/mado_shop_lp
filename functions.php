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


// テンプレート内でショートコードを実行できるようにする
add_filter('widget_text', 'do_shortcode');
add_filter('the_content', 'do_shortcode', 11);





function dynamic_hidden_fields($form_tag) {
    // height が未定義の場合、空の配列をセット
    $height = isset($_POST['height']) ? $_POST['height'] : array();
    
    if ($form_tag['name'] == 'window_count') {
        $form_tag['values'] = array(count($height));
    }
    return $form_tag;
}
add_filter('wpcf7_form_tag', 'dynamic_hidden_fields');
