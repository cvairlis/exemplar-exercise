<?php

namespace ExemplarCode\Cache\Contracts;

interface CacheFactoryInterface
{
    /**
     * Instantiates the corresponding cache driver and returns it.
     */
    public function make(): CacheInterface;
}
