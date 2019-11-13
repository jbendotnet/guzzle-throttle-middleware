<?php

namespace BenTools\GuzzleHttp\Middleware;

use BenTools\Psr7\RequestMatcherInterface;
use Psr\Http\Message\RequestInterface;

class ThrottleConfiguration implements RequestMatcherInterface
{
    /**
     * @var RequestMatcherInterface
     */
    private $requestMatcher;

    /**
     * @var int
     */
    private $maxRequests;

    /**
     * @var float
     */
    private $duration;

    /**
     * @var string
     */
    private $storageKey;

    /**
     * ThrottleConfiguration constructor.
     * @param RequestMatcherInterface $requestMatcher
     * @param int                     $maxRequests
     * @param float                     $duration
     * @param string                  $storageKey
     */
    public function __construct(RequestMatcherInterface $requestMatcher, $maxRequests, $duration, $storageKey)
    {
        $this->requestMatcher = $requestMatcher;
        $this->maxRequests = $maxRequests;
        $this->duration = $duration;
        $this->storageKey = $storageKey;
    }

    /**
     * @inheritdoc
     */
    public function matchRequest(RequestInterface $request)
    {
        return $this->requestMatcher->matchRequest($request);
    }

    /**
     * @return int
     */
    public function getMaxRequests()
    {
        return $this->maxRequests;
    }

    /**
     * @return float
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @return string
     */
    public function getStorageKey()
    {
        return $this->storageKey;
    }
}
