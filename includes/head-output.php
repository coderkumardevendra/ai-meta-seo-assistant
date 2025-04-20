<?php
// Injects meta tags into wp_head
add_action('wp_head', 'aimg_output_meta_tags');
function aimg_output_meta_tags() {
    if (is_singular() && in_the_loop()) {
        global $post;
        $meta_title = get_post_meta($post->ID, 'aimg_meta_title', true);
        $meta_description = get_post_meta($post->ID, 'aimg_meta_description', true);

        if ($meta_title) {
            echo '<title>' . esc_html($meta_title) . '</title>' . "\n";
            echo '<meta name="title" content="' . esc_attr($meta_title) . '">' . "\n";
        }

        if ($meta_description) {
            echo '<meta name="description" content="' . esc_attr($meta_description) . '">' . "\n";
        }
    }
}
