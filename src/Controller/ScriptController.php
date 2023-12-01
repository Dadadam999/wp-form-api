<?php

namespace FormApi\Controller;

use FormApi\Entity\ScriptType;

class ScriptController
{
    public function __construct(private string $folderCss, private string $folderJs)
    {
    }

    public function addStyle(string $handle, string $fileName)
    {
        wp_enqueue_style(
            $handle,
            plugins_url($this->folderCss . '/' . $fileName)
        );
    }

    public function addScript(string $handle, string $fileName, ScriptType $type)
    {
        add_action($type->value, function () use ($handle, $fileName) {
            wp_enqueue_script(
                $handle,
                plugins_url($this->folderJs . '/' . $fileName)
            );
        });
    }
}