<?php
/**
 * Plugin Name: CodeKaizen WP Event Webhooks
 * Description: CodeKaizen webhooks for WordPress events
 * Author: CodeKaizen
 * Author URI: https://codekaizen.net/
 * Version: 1.0.0
 * Text Domain: codekaizen-wp-event-webhooks
 * @package  CodeKaizen WP Event Webhooks
 * @category Core
 * @author   Missie Dawes
 * @version  1.0.0
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function codekaizen_revalidate_blog_posts() {
    $nextapp_base_api_url = getenv( 'NEXTAPP_BASE_API_URL' );
    $nextapp_revalidateBlogPosts_endpoint = '/revalidateBlogPosts';
    $nextapp_revalidate_secret = getenv( 'NEXTAPP_REVALIDATE_SECRET' );

    $nextapp_full_url = $nextapp_base_api_url . $nextapp_revalidateBlogPosts_endpoint;

    $response = wp_remote_get( $nextapp_full_url, array(
        'headers' => array(
            'Authorization' => 'Bearer ' . $nextapp_revalidate_secret
        )
    ));

    if ( is_wp_error( $response ) ) {
        error_log( 'Error revalidating blog posts: ' . $response->get_error_message());
    }
}

// Revalidate blog posts whenever a post is edited
add_action( 'edit_post', 'codekaizen_revalidate_blog_posts' );
