<?php
/**
 * ファイルアップロード処理 (WordPress用・セッション不使用)
 */

/**
 * ファイルを一時ディレクトリに保存する
 * @param array $file $_FILES配列の要素
 * @return array|false 保存に成功した場合は情報配列、失敗した場合はfalse
 */
function save_uploaded_file($file) {
    // ファイルがアップロードされていない場合
    if (empty($file) || $file['error'] !== UPLOAD_ERR_OK || empty($file['tmp_name'])) {
        return false;
    }
    
    // アップロードディレクトリの設定 (wp-content/uploads/temp)
    $upload_dir = wp_upload_dir();
    $temp_dir = $upload_dir['basedir'] . '/temp';
    
    // ディレクトリが存在しない場合は作成
    if (!file_exists($temp_dir)) {
        wp_mkdir_p($temp_dir);
        
        // セキュリティのためindex.phpを作成
        $index_file = $temp_dir . '/index.php';
        if (!file_exists($index_file)) {
            file_put_contents($index_file, '<?php // Silence is golden');
        }
    }
    
    // ファイルタイプの検証
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($file['type'], $allowed_types)) {
        return false;
    }
    
    // ファイルサイズの検証 (5MB)
    if ($file['size'] > 5 * 1024 * 1024) {
        return false;
    }
    
    // 一意のファイル名を生成
    $file_info = pathinfo($file['name']);
    $file_ext = strtolower($file_info['extension']);
    $unique_filename = uniqid('file_') . '.' . $file_ext;
    $upload_path = $temp_dir . '/' . $unique_filename;
    
    // ファイルを一時ディレクトリに移動
    if (move_uploaded_file($file['tmp_name'], $upload_path)) {
        return [
            'original_name' => $file['name'],
            'file_name' => $unique_filename,
            'file_path' => $upload_path,
            'file_url' => $upload_dir['baseurl'] . '/temp/' . $unique_filename,
            'file_type' => $file['type'],
            'file_size' => $file['size']
        ];
    }
    
    return false;
}

/**
 * フォーム送信時のファイル処理
 * @return array アップロードされたファイル情報
 */
function process_form_files() {
    // POSTリクエストでない場合は何もしない
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return [];
    }
    
    // 窓情報のファイル処理
    $uploaded_files = [];
    
    // $_FILESをループして窓の写真を処理
    foreach ($_FILES as $key => $file) {
        // photo-*パターンのキーのみ処理
        if (preg_match('/^photo-(\d+)$/', $key, $matches) && !empty($file['name'])) {
            $window_index = $matches[1];
            $file_info = save_uploaded_file($file);
            
            if ($file_info) {
                $uploaded_files[$key] = $file_info;
            }
        }
    }
    
    return $uploaded_files;
}

/**
 * 確認画面に渡すためのhiddenフィールド生成
 * @param array $uploaded_files アップロードされたファイル情報
 * @return string HTML
 */
function get_file_hidden_fields($uploaded_files) {
    if (empty($uploaded_files)) {
        return '';
    }
    
    $html = '';
    foreach ($uploaded_files as $key => $file_info) {
        foreach ($file_info as $field => $value) {
            $html .= sprintf(
                '<input type="hidden" name="uploaded_files[%s][%s]" value="%s">',
                esc_attr($key),
                esc_attr($field),
                esc_attr($value)
            );
        }
    }
    
    return $html;
}

/**
 * 確認画面でのファイル表示
 * @param array $uploaded_files アップロードされたファイル情報
 * @param string $file_key ファイルのキー (photo-1など)
 * @return string HTMLマークアップ
 */
function display_uploaded_file($uploaded_files, $file_key) {
    // アップロードされたファイル情報がない場合
    if (empty($uploaded_files) || empty($uploaded_files[$file_key])) {
        return '<span>添付なし</span>';
    }
    
    $file_info = $uploaded_files[$file_key];
    $file_name = esc_html($file_info['original_name']);
    $file_url = esc_url($file_info['file_url']);
    
    // 画像ファイルの場合はサムネイル表示
    if (strpos($file_info['file_type'], 'image/') === 0) {
        return sprintf(
            '<div class="file-preview"><img src="%s" alt="%s" style="max-width: 200px; max-height: 150px;"><span class="file-name">%s</span></div>',
            $file_url,
            $file_name,
            $file_name
        );
    }
    
    // 画像以外のファイルの場合はリンク表示
    return sprintf(
        '<a href="%s" target="_blank" class="file-link">%s</a>',
        $file_url,
        $file_name
    );
}

/**
 * 不要な一時ファイルの削除
 * @param array $file_paths 削除するファイルのパス
 */
function cleanup_temp_files($file_paths) {
    if (empty($file_paths)) {
        return;
    }
    
    foreach ($file_paths as $path) {
        if (file_exists($path)) {
            @unlink($path);
        }
    }
}

/**
 * 古い一時ファイルのクリーンアップ (cron用)
 * 24時間以上前の一時ファイルを削除
 */
function cleanup_old_temp_files() {
    $upload_dir = wp_upload_dir();
    $temp_dir = $upload_dir['basedir'] . '/temp';
    
    if (!file_exists($temp_dir) || !is_dir($temp_dir)) {
        return;
    }
    
    $max_age = 24 * 60 * 60; // 24時間（秒）
    $now = time();
    
    $files = glob($temp_dir . '/file_*.*');
    foreach ($files as $file) {
        // index.phpはスキップ
        if (basename($file) === 'index.php') {
            continue;
        }
        
        // ファイルの最終更新時間をチェック
        $file_time = filemtime($file);
        if ($now - $file_time > $max_age) {
            @unlink($file);
        }
    }
}

// 定期的な一時ファイルクリーンアップのためのcronイベント登録
add_action('wp', function() {
    if (!wp_next_scheduled('cleanup_temp_files_cron')) {
        wp_schedule_event(time(), 'daily', 'cleanup_temp_files_cron');
    }
});
add_action('cleanup_temp_files_cron', 'cleanup_old_temp_files');