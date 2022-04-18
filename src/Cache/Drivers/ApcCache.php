<?php

namespace ExemplarCode\Cache\Drivers;

use ExemplarCode\Cache\Contracts\CacheInterface;

class ApcCache implements CacheInterface
{
    /**
     * @inheritDoc
     */
    public function get($key, $default = null)
    {
        // TODO: Implement get() method.
    }

    /**
     * @inheritDoc
     */
    public function set($key, $value, $ttl = null): bool
    {
        // TODO: Implement get() method.

        return false;
    }
}
