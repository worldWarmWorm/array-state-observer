<?php

namespace WorldWarmWorm\ArrayStateObserver;

/**
 * SimpleArrayObserver works with simple arrays like those bellow
 *
 * $array = [1, 2, 3, [...n]]
 * $array2 = [
 *    'cat' => 'Jack',
 *    'dog' => 'Bob',
 *    'horse' => 'Chuck',
 *    [...n]
 *  ]
 */
final class SimpleArrayObserver extends ArrayObserver
{
  /**
   * @param array<int|string|null, int|string|null> $before
   * @param array<int|string|null, int|string|null> $after
   * @return SimpleArrayObserver
   */
  public function observe(array $before, array $after): self
  {
    switch (true) {
      case $this->isAllAdded($before, $after):
        $this->added = $after;
        break;
      case $this->isAllDeleted($before, $after):
        $this->deleted = $before;
        break;
      case $this->hasPartiallyChanges($before, $after):
        $this->deleted = array_diff($before, $after);
        $this->added = array_diff($after, $before);
    }

    return $this;
  }
}
