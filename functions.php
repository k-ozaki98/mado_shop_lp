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