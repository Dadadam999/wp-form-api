<?php

namespace FormApi;

use WP_REST_Request;
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
    }

    private function apiInit()
    {
        add_action('rest_api_init', function () {
            register_rest_route(
                'MultipleUploadsForHeilz/v1',
                '/savemetapoly',
                [
                    'methods' => 'POST',
                    'callback' => function (WP_REST_Request $request) {
                        $user_id = (int)$request->get_param('mufh-user-id');
                        $metakey = (string)$request->get_param('mufh-meta-key');
                        $value = (string)$request->get_param('mufh-meta-value');

                        if (empty($user_id) || empty($metakey) || empty($value))
                            return [
                                'code' => -99,
                                'message' => 'Too few arguments for this argument.',
                                'messages' => []
                            ];

                        update_user_meta($user_id, $metakey, $value);

                        return [
                            'code' => 0,
                            'message' => 'Success.',
                            'messages' => []
                        ];
                    }
                ]
            );
        });
    }
}
