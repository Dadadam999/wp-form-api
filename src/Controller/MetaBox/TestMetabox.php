<?php

namespace FormApi\Controller\MetaBox;

use WpToolKit\Entity\Post;
use WpToolKit\Entity\View;
use WpToolKit\Controller\ViewLoader;
use WpToolKit\Field\TextField;
use WpToolKit\Interface\MetaBoxInterface;
use WpToolKit\Controller\MetaBoxController;
use WpToolKit\Entity\MetaPoly;
use WpToolKit\Entity\MetaPolyType;

class TestMetabox extends MetaBoxController implements MetaBoxInterface
{
    private MetaPoly $something;

    public function __construct(
        private Post $post
    ) {
        parent::__construct(
            "test_metabox",
            "Test metabox",
            $post->name
        );

        $this->something = new MetaPoly(
            'something',
            MetaPolyType::STRING,
            'Какая-то настройка:'
        );
    }

    public function render($post): void
    {
        $somethingField = new TextField(
            $this->something->name,
            $this->something->title,
            get_post_meta(
                $post->ID,
                $this->something->name,
                true
            )
        );

        $viewLoader = new ViewLoader();

        $viewLoader->add(
            new View(
                'TestMetaBox',
                WP_PLUGIN_DIR . '/wp-form-api/src/Template/TestMetaBoxView.php',
                ['something' => $somethingField]
            )
        );

        $viewLoader->load('TestMetaBox');
    }

    public function callback($postId): void
    {
        if (!isset($_POST['test_metabox_nonce']) || !wp_verify_nonce($_POST['test_metabox_nonce'], 'test_metabox_nonce')) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (!current_user_can('edit_post', $postId)) {
            return;
        }

        if (isset($_POST[$this->something->name])) {
            update_post_meta(
                $postId,
                $this->something->name,
                sanitize_text_field($_POST[$this->something->name])
            );
        }
    }
}
