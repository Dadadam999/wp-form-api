<?php 

namespace FormApi\Entity;

enum ScriptType {
    case FRONT = 'wp_enqueue_scripts';
    case ADMIN = 'admin_enqueue_scripts';
    case LOGIN = 'login_enqueue_scripts';
}
