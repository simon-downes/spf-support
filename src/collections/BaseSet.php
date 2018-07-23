<?php declare(strict_types=1);
/* 
 * This file is part of the spf-support package which is distributed under the MIT License.
 * See LICENSE.md or go to https://github.com/simon-downes/spf-support for full license details.
 */
namespace spf\support\collections;

use spf\contracts\support\collections\Set;

/**
 * Basic set implementation.
 */
class BaseSet extends BaseCollection implements Set {

    public function add( $item ) {

        $new = !$this->contains($item);

        if( $new ) {
            $this->items[] = $item;
        }

        return $new;

    }

    public function remove( $item ): bool {

        $key = array_search($item, $this->items);

        if( $key !== false ) {
            unset($this->items[$key]);
        }

        return $key !== false;

    }

}
