<?php
/*
Plugin Name: Codekaizen WP Usermeta
Description: Adds additional fields to WordPress user profiles for backend use.
Version: 1.0.0
Author: Codekaizen
*/

// Show the field in user profile (admin)
function codekaizen_wp_usermeta_field($user) {
    $github = get_user_meta($user->ID, 'codekaizen_github_username', true);
    $moniker = get_user_meta($user->ID, 'codekaizen_moniker', true);
    ?>
    <h3>Additional Fields</h3>
    <table class="form-table">
        <tr>
            <th><label for="codekaizen_github_username">GitHub Username</label></th>
            <td>
                <input type="text" name="codekaizen_github_username" id="codekaizen_github_username" value="<?php echo esc_attr($github); ?>" class="regular-text" />
                <br />
                <span class="description">Enter your GitHub username.</span>
            </td>
        </tr>
        <tr>
            <th><label for="codekaizen_moniker">Moniker</label></th>
            <td>
                <input type="text" name="codekaizen_moniker" id="codekaizen_moniker" value="<?php echo esc_attr($moniker); ?>" class="regular-text" />
                <br />
                <span class="description">Enter your moniker (e.g., "The Sensei," "The Ninja," etc.).</span>
            </td>
        </tr>
    </table>
    <?php
}
add_action('show_user_profile', 'codekaizen_wp_usermeta_field');
add_action('edit_user_profile', 'codekaizen_wp_usermeta_field');

// Save the fields
function codekaizen_wp_usermeta_save($user_id) {
    if (!current_user_can('edit_user', $user_id)) return false;
    if (isset($_POST['codekaizen_github_username'])) {
        update_user_meta($user_id, 'codekaizen_github_username', sanitize_text_field($_POST['codekaizen_github_username']));
    }
    if (isset($_POST['codekaizen_moniker'])) {
        update_user_meta($user_id, 'codekaizen_moniker', sanitize_text_field($_POST['codekaizen_moniker']));
    }
}
add_action('personal_options_update', 'codekaizen_wp_usermeta_save');
add_action('edit_user_profile_update', 'codekaizen_wp_usermeta_save');
