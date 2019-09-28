<?php

namespace src\Cache;

use Psr\Cache\CacheItemPoolInterface;
use Psr\Cache\CacheItemInterface;
use src\Cache\CacheItem;

class Cache implements CacheItemPoolInterface
{
    public function getItem($key) {
        return new CacheItem();
    }

    public function getItems(array $keys = array()) {

    }

    public function hasItem($key) {

    }

    public function clear() {

    }

    public function deleteItem($key) {

    }

    public function deleteItems(array $keys) {

    }

    public function save(CacheItemInterface $item) {

    }

    public function saveDeferred(CacheItemInterface $item) {

    }

    public function commit() {

    }
}
