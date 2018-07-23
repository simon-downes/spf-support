<?php declare(strict_types=1);
/* 
 * This file is part of the spf-support package which is distributed under the MIT License.
 * See LICENSE.md or go to https://github.com/simon-downes/spf-support for full license details.
 */
namespace spf\support\collections;

use ArrayIterator, IteratorAggregate;

use spf\contracts\support\collections\Collection;

/**
 * Basic collection implementation.
 * Should not be implemented directly, instead use one of the more specific
 * sub-classes, such as BaseSet or BaseDictionary
 */
class BaseCollection implements IteratorAggregate, Collection {

    protected $items;

    public function __construct( array $items = [] ) {
        $this->items = $items;
    }

    public function count(): int {
        return count($this->items);
    }

    public function isEmpty(): bool {
        return count($this->items) == 0;
    }

    public function clear(): Collection {
        $this->items = [];
        return $this;
    }

    public function contains( $item ): bool {
        return array_search($item, $this->items) !== false;
    }

    public function toArray(): array {
        return $this->items;
    }

    public function getIterator() {
        return new ArrayIterator($this->items);
    }

}
