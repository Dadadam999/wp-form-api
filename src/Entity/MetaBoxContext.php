<?php

namespace FormApi\Entity;

enum MetaBoxContext: string
{
    case NORMAL = 'normal';
    case ADVANCED = 'advanced';
    case SIDE = 'side';
}