<?php

namespace FormApi\Controller;

use FormApi\Entity\MetaBoxContext;
use FormApi\Entity\MetaBoxPriority;
use FormApi\Interface\MetaBoxInterface;

class MetaBoxController implements MetaBoxInterface
{
    public function __construct(
        private string $id,
        private string $title,
        private string $postName,
        private MetaBoxContext $context = MetaBoxContext::ADVANCED,
        private MetaBoxPriority $priority = MetaBoxPriority::DEFAULT
    )
    {
        add_action('add_meta_boxes', function() use($id, $title, $postName, $context, $priority) 
        {
            add_meta_box(
                $id,
                $title,
                array($this, 'render'),
                $postName,
                $context->value,
                $priority->value
            );
        });

        add_action('save_post', array($this, 'callback'));
    }

    public function render($post): void
    {
        // Override this method in your childs    
    }

    public function callback($postId): void
    {
        // Override this method in your childs
    }
}
