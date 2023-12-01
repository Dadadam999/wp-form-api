<?php

namespace FormApi\Interface;

interface MetaBoxInterface
{
    public function render($post): void;
    public function callback($postId): void;
}
