<?php

namespace BenTools\GuzzleHttp\Middleware\Storage;

interface ThrottleStorageInterface
{
    /**
     * @param string $storageKey
     * @return bool
     */
    public function hasCounter($storageKey);

    /**
     * @param string $storageKey
     * @return Counter
     */
    public function getCounter($storageKey);

    /**
     * @param string  $storageKey
     * @param Counter $counter
     * @param float   $ttl
     */
    public function saveCounter($storageKey, Counter $counter, $ttl = null);

    /**
     * @param string $storageKey
     */
    public function deleteCounter($storageKey);
}
