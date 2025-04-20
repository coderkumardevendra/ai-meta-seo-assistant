<?php
// Meta boxes for SEO tools in the post editor
add_action('add_meta_boxes', 'aimg_add_meta_boxes');
function aimg_add_meta_boxes() {
    add_meta_box('aimg_meta_box', 'AI Meta SEO Assistant', 'aimg_meta_box_content', 'post', 'normal', 'high');
}

function aimg_meta_box_content($post) {
    ?>
    <div>
        <label for="aimg_meta_title">Meta Title</label>
        <input type="text" id="aimg_meta_title" name="aimg_meta_title" value="<?php echo esc_attr(get_post_meta($post->ID, 'aimg_meta_title', true)); ?>" class="regular-text" />
    </div>
    <div>
        <label for="aimg_meta_description">Meta Description</label>
        <textarea id="aimg_meta_description" name="aimg_meta_description" rows="4" class="large-text"><?php echo esc_textarea(get_post_meta($post->ID, 'aimg_meta_description', true)); ?></textarea>
    </div>
    <div id="aimg_keywords_suggestions"></div>
    <div>
        <button type="button" id="generate_meta_button" class="button">Generate Meta</button>
    </div>
    <?php
}

add_action('admin_enqueue_scripts', 'aimg_enqueue_scripts');
function aimg_enqueue_scripts() {
    wp_enqueue_script('aimg-ai-meta-generator', plugin_dir_url(__FILE__) . '../js/ai-meta-generator.js', array('jquery'), null, true);
}
