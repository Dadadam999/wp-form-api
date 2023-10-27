<?php
/**
 * Plugin Name: wp-form-api
 * Description: Library for creating forms.
 * Version: 0.0.1
*/

require_once __DIR__ . '/vendor/autoload.php';

use FormApi\Main;

register_activation_hook(__FILE__, 'wpFormApiInstall');
register_deactivation_hook(__FILE__, 'wpFormApiUninstall');

function wpFormApiInstall()
{

}

function wpFormApiUninstall()
{
 
}

add_action('plugins_loaded', function () {
    new Main();
});
