<?php

namespace FormApi;

use WP_REST_Request;

class Main
{
    public function __construct()
    {   
        //$this->apiInit();
        //$this->scriptAdd();
    }

    private function scriptAdd()
    {
        wp_enqueue_style('mufh-front', plugins_url('MultipleUploadsForHeilz/Source/Assets/Style/MufhFront.css'));

        add_action('wp_enqueue_scripts', function () {
            $scripts = [
                'mufh-lib-nosleep' => 'Lib/NoSleep.min.js',
                'mufh-class-menu' => 'Classes/Menu.js',
            ];

            foreach ($scripts as $label => $path) {
                wp_enqueue_script(
                    $label,
                    plugins_url('MultipleUploadsForHeilz/Source/Assets/Js/' . $path),
                    [],
                    '1.0.0'
                );
            }
        });
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
