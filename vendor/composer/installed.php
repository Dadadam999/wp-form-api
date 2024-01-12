<?php return array(
    'root' => array(
        'name' => 'wordpress/wpformapi',
        'pretty_version' => '0.0.1',
        'version' => '0.0.1.0',
        'reference' => NULL,
        'type' => 'wordpress-plugin',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'dev' => true,
    ),
    'versions' => array(
        'dadadam/wptoolkit' => array(
            'pretty_version' => 'dev-main',
            'version' => 'dev-main',
            'reference' => '5fa9ccea4ea46c6944db001c057adc58db7ddd71',
            'type' => 'library',
            'install_path' => __DIR__ . '/../dadadam/wptoolkit',
            'aliases' => array(
                0 => '9999999-dev',
            ),
            'dev_requirement' => false,
        ),
        'wordpress/wpformapi' => array(
            'pretty_version' => '0.0.1',
            'version' => '0.0.1.0',
            'reference' => NULL,
            'type' => 'wordpress-plugin',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
    ),
);
