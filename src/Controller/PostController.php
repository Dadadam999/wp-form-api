<?php

namespace FormApi\Controller;

use FormApi\Entity\Post;

class PostController
{
    public function __construct() 
    {
    }

    public function registerPublicType(Post $post): void
    {
        add_action('init', function() use($post)
        {
           register_post_type(
                $post->getName(),
                [
                    'public' => true,
                    'label'  => $post->getTitle(),
                    'menu_icon' => $post->getIcon(),
                    'supports' => $post->getSupports(),
                    'show_in_menu' => $post->getUrl(),
                    'menu_position' => $post->getPosition()
                ]
            );
        });
    }

    public function registerMenu(Post $post): void
    {
        add_action('admin_menu', function() use($post)
        {
            add_menu_page(
                $post->getTitle(),
                $post->getTitle(),
                $post->getRole(),
                $post->getUrl(),
                '',
                $post->getIcon(),
                $post->getPosition()
            );
        });
    }

    public function removeStandartMetaBoxes(Post $post)
    {
        add_action( 'do_meta_boxes', function() use($post)
        {
            remove_meta_box('pageparentdiv', $post->getName(), 'side');
            remove_meta_box('us_page_settings', $post->getName(), 'side');
            remove_meta_box('postimagediv', $post->getName(), 'side');
            remove_meta_box('us_seo_settings', $post->getName(), 'normal');
            remove_meta_box('us_portfolio_settings', $post->getName(), 'normal');
        });
    }
}