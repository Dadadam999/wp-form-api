<?php

namespace FormApi;

use FormApi\Controller\Route\TestRoute;
use WpToolKit\Entity\Post;

use FormApi\Controller\MetaBox\TestMetabox;
use WpToolKit\Controller\PostController;

class Main
{
    private PostController $postController;

    public function __construct()
    {
        $test = new Post(
            'test_post',
            'Test title',
            'dashicons-calendar-alt',
            'manage_options',
            ['title', 'page-attributes']
        );

        $this->postController = new PostController($test);
        $this->postController->addToMenu();
        new TestMetabox($test);
        new TestRoute();
    }
}
