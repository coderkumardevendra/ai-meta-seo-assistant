<?php
// Handles AJAX and OpenAI API logic
add_action('wp_ajax_generate_meta', 'aimg_generate_meta');
function aimg_generate_meta() {
    if (!isset($_POST['post_title']) || !isset($_POST['post_excerpt'])) {
        wp_send_json_error(['message' => 'Invalid input']);
    }

    $post_title = sanitize_text_field($_POST['post_title']);
    $post_excerpt = sanitize_textarea_field($_POST['post_excerpt']);
    $api_key = get_option('aimg_openai_api_key');

    if (empty($api_key)) {
        wp_send_json_error(['message' => 'API Key not set']);
    }

    $response = aimg_call_openai_api($post_title, $post_excerpt, $api_key);

    if ($response) {
        wp_send_json_success($response);
    } else {
        wp_send_json_error(['message' => 'API error']);
    }
}

function aimg_call_openai_api($title, $excerpt, $api_key) {
    $url = 'https://api.openai.com/v1/completions';
    $data = [
        'model' => 'text-davinci-003',
        'prompt' => "Generate a meta title and description based on this post title and excerpt.\nTitle: {$title}\nExcerpt: {$excerpt}",
        'max_tokens' => 100,
    ];

    $args = [
        'body' => json_encode($data),
        'headers' => [
            'Authorization' => 'Bearer ' . $api_key,
            'Content-Type' => 'application/json',
        ],
        'timeout' => 15,
    ];

    $response = wp_remote_post($url, $args);

    if (is_wp_error($response)) {
        return false;
    }

    $body = wp_remote_retrieve_body($response);
    $result = json_decode($body, true);

    if (isset($result['choices'][0]['text'])) {
        return [
            'meta_title' => trim($result['choices'][0]['text']),
            'meta_description' => trim($result['choices'][0]['text']),
        ];
    }

    return false;
}
