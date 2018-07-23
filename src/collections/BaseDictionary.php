<?php declare(strict_types=1);
/* 
 * This file is part of the spf-support package which is distributed under the MIT License.
 * See LICENSE.md or go to https://github.com/simon-downes/spf-support for full license details.
 */
namespace spf\support\collections;

use spf\contracts\support\collections\Dictionary;

/**
 * Basic dictionary implementation.
 */
class BaseDictionary extends BaseCollection implements Dictionary {

    public function has( $key ): bool {
        return array_key_exists($key, $this->items);
    }

    public function get( $key, $default = null ) {
        return $this->items[$key] ?? $default;
    }

    public function set( $key, $item ) {

        $current = $this->get($key);

        $this->items[$key] = $item;

        return $current;

    }

    public function remove( $key ) {
        $current = $this->get($key);
        unset($this->items[$key]);
        return $current;
    }

    public function keys(): array {
        return array_keys($this->items);
    }

}
