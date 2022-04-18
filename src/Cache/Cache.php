<?php

namespace ExemplarCode\Cache;

use ExemplarCode\Cache\Concerns\CacheFunctionsTrait;
use ExemplarCode\Cache\Contracts\CacheInterface;
use ExemplarCode\Cache\Factories\CacheFactory;

class Cache
{
    use CacheFunctionsTrait;

    /** @var CacheInterface */
    private $cache;

    public function __construct()
    {
        $this->cache = (new CacheFactory())->make();
    }
}
