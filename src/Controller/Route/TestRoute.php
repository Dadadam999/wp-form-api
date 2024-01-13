<?php

namespace FormApi\Controller\Route;

use WP_REST_Request;
use WpToolKit\Controller\RouteController;
use WpToolKit\Interface\RestRouteInterface;

class TestRoute extends RouteController implements RestRouteInterface
{
    public function __construct()
    {
        parent::__construct('FormApi/v1', '/test', []);
    }

    public function callback(WP_REST_Request $request): mixed
    {
        return [
            'code' => 0,
            'message' => 'Success.',
            'messages' => []
        ];
    }

    public function checkPermission(WP_REST_Request $request): bool
    {
        return true;
    }
}
