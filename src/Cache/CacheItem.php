<?php

namespace src\Cache;

use Psr\Cache\CacheItemInterface;

class CacheItem implements CacheItemInterface
{
    public function getKey() {

    }

    public function get() {
        return [];
    }

    public function isHit() {
        return false;
    }

    public function set($value) {
        return $this;
    }

    public function expiresAt($expiration) {

    }

    public function expiresAfter($time) {

    }
}
