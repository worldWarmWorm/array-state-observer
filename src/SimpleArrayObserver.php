<?php

namespace WorldWarmWorm\ArrayStateObserver;

final class SimpleArrayObserver extends ArrayObserver
{

  /**
   * @param array<int|string|null, int|string|null> $before
   * @param array<int|string|null, int|string|null> $after
   * @return $this
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
