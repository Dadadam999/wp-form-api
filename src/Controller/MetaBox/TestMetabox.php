<?php

namespace FormApi\Controller\MetaBox;

use FormApi\Controller\MetaBoxController;
use FormApi\Entity\Post;
use FormApi\Interface\MetaBoxInterface;

class TestMetabox extends MetaBoxController implements MetaBoxInterface
{
    public function __construct(private Post $post)
    {
        parent::__construct(
            "test_metabox",
            "Test metabox",
            $post->getName()
        );
    }

    public function render($post): void
    {
        $something = get_post_meta($post->ID, 'something', true);

        ob_start();
        require WP_PLUGIN_DIR . '/wp-form-api/src/Template/TestMetaBoxView.php';
        echo ob_get_clean();
    }

    public function callback($postId): void
    {
        if (!wp_verify_nonce($_POST['test_metabox_nonce'], 'test_metabox_nonce')) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (!current_user_can('edit_post', $postId)) {
            return;
        }

        if (isset($_POST['something'])) {
            update_post_meta($postId, 'something', sanitize_text_field($_POST['something']));
        }
    }
}
