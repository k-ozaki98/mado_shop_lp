<?php
// 施工事例のカスタム投稿表示
add_theme_support('post-thumbnails');
function create_works_post_type() {
    register_post_type('works',
        array(
            'labels' => array(
                'name' => '施工事例',
                'singular_name' => '施工事例',
                'add_new' => '新規追加',
                'add_new_item' => '新規施工事例を追加',
                'edit_item' => '施工事例を編集',
                'menu_name' => '施工事例'
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail'),
            'menu_position' => 5,
            'show_in_rest' => true,
            'menu_icon' => 'dashicons-admin-home',
        )
    );
}
add_action('init', 'create_works_post_type');
