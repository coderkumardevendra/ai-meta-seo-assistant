<?php
// Settings page for OpenAI API Key
add_action('admin_menu', 'aimg_plugin_settings_menu');
function aimg_plugin_settings_menu() {
    add_options_page('AI Meta SEO Assistant Settings', 'AI Meta SEO Assistant', 'manage_options', 'aimg_settings', 'aimg_plugin_settings_page');
}

function aimg_plugin_settings_page() {
    ?>
    <div class="wrap">
        <h2>AI Meta SEO Assistant Settings</h2>
        <form method="post" action="options.php">
            <?php settings_fields('aimg_settings_group'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">OpenAI API Key</th>
                    <td><input type="text" name="aimg_openai_api_key" value="<?php echo esc_attr(get_option('aimg_openai_api_key')); ?>" class="regular-text" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

add_action('admin_init', 'aimg_register_settings');
function aimg_register_settings() {
    register_setting('aimg_settings_group', 'aimg_openai_api_key');
}
