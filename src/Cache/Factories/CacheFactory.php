<?php

namespace ExemplarCode\Cache\Factories;

use ExemplarCode\Cache\Contracts\CacheFactoryInterface;
use ExemplarCode\Cache\Contracts\CacheInterface;
use ExemplarCode\Cache\Drivers\ApcCache;
use ExemplarCode\Cache\Drivers\RedisCache;
use ExemplarCode\Cache\Drivers\SampleCache;

class CacheFactory implements CacheFactoryInterface
{
    const CACHE_DRIVER = 'CACHE_DRIVER';

    /**
     * @inheritDoc
     */
    public function make(): CacheInterface
    {
        switch ($_ENV[self::CACHE_DRIVER]) {
            case 'APC':
                return new ApcCache();
            case 'REDIS':
                return new RedisCache();
            default:
                return new SampleCache();
        }
    }
}
