<?php
if (is_front_page()) {
    get_template_part('page-templates/front-page');
} elseif (is_page()) {
    $page = get_post(get_the_ID());
    $slug = $page->post_name;
    get_template_part('page-templates/' . $slug);
} else {
    wp_redirect(home_url());
    exit;
}
?>