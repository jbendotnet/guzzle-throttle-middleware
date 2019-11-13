<?php

namespace BenTools\GuzzleHttp\Middleware\Storage\Adapter;

use BenTools\GuzzleHttp\Middleware\Storage\Counter;
use BenTools\GuzzleHttp\Middleware\Storage\ThrottleStorageInterface;

class ArrayAdapter implements ThrottleStorageInterface
{

    private $storage = [];

    /**
     * @inheritDoc
     */
    public function hasCounter($storageKey)
    {
        return isset($this->storage[$storageKey]);
    }

    /**
     * @inheritDoc
     */
    public function getCounter($storageKey)
    {
        return isset($this->storage[$storageKey]) ? $this->storage[$storageKey] : null;
    }

    /**
     * @inheritDoc
     */
    public function saveCounter($storageKey, Counter $counter, $ttl = null)
    {
        $this->storage[$storageKey] = $counter;
    }

    /**
     * @inheritDoc
     */
    public function deleteCounter($storageKey)
    {
        unset($this->storage[$storageKey]);
    }
}
