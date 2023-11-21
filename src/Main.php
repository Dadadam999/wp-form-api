<?php

namespace FormApi;

use FormApi\Controller\ScriptController;
use WP_REST_Request;

class Main
{
    private ScriptController $scriptController;

    public function __construct()
    {
        $this->scriptController  = new ScriptController(
            'wp-form-api/asets/style',
            'wp-form-api/asets/script',
        );
    }

    private function apiInit()
    {
        add_action('rest_api_init', function () 
        {    
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
