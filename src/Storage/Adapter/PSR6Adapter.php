<?php

namespace BenTools\GuzzleHttp\Middleware\Storage\Adapter;

use BenTools\GuzzleHttp\Middleware\Storage\Counter;
use BenTools\GuzzleHttp\Middleware\Storage\ThrottleStorageInterface;
use Psr\Cache\CacheItemPoolInterface;

/**
 * Class PSR6Adapter
 * Needs PSR-6 psr/cache implementation (like symfony/cache)
 */
class PSR6Adapter implements ThrottleStorageInterface
{
    /**
     * @var CacheItemPoolInterface
     */
    private $cacheItemPool;

    /**
     * PSR6Adapter constructor.
     */
    public function __construct(CacheItemPoolInterface $cacheItemPool)
    {
        $this->cacheItemPool = $cacheItemPool;
    }

    /**
     * @inheritDoc
     */
    public function hasCounter($storageKey)
    {
        return $this->cacheItemPool->hasItem($storageKey);
    }

    /**
     * @inheritDoc
     */
    public function getCounter($storageKey)
    {
        $item = $this->cacheItemPool->getItem($storageKey);
        if ($item->isHit()) {
            $counter = unserialize($item->get());
        } else {
            $counter = null; // will throw TypeError
        }
        return $counter;
    }

    /**
     * @inheritDoc
     */
    public function saveCounter($storageKey, Counter $counter, $ttl = null)
    {
        $item = $this->cacheItemPool->getItem($storageKey);
        $item->set(serialize($counter));
        if (null !== $ttl) {
            $item->expiresAfter((int) ceil($ttl));
        }
        $this->cacheItemPool->save($item);
    }

    /**
     * @inheritDoc
     */
    public function deleteCounter($storageKey)
    {
        $this->cacheItemPool->deleteItem($storageKey);
    }
}
