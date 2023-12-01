<?php

namespace FormApi\Entity;

enum MetaBoxPriority: string
{
    case HIGH = 'high';
    case LOW = 'low';
    case CORE = 'core';
    case DEFAULT = 'default';
}