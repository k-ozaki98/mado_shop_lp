<?php

/**
 * Datepickerの読み込み
 */
function enqueue_datepicker() {
  // スタイル
  wp_enqueue_style('jquery-ui-css', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
  
  // スクリプト
  wp_enqueue_script('jquery-ui-datepicker');
  
  // 日本語化
  wp_enqueue_script(
    'datepicker-ja',
    get_template_directory_uri() . '/dist/assets/js/script-bundle.js',
    ['jquery-ui-datepicker'],
    '1.0.0',
    true
  );
}
add_action('wp_enqueue_scripts', 'enqueue_datepicker');