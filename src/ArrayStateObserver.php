<?php

final class ArrayStateObserver implements ArrayObservable
{
  public const ADDED = 'added';

  public const DELETED = 'deleted';

  private array $added = [];

  private array $deleted = [];

  public function __construct(array $before, array $after)
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
  }

  public function added(): array
  {
    return $this->added;
  }

  public function deleted(): array
  {
    return $this->deleted;
  }

  public function all(): array
  {
    $added = $this->added();
    $deleted = $this->deleted();

    return empty($added) && empty($deleted)
      ? []
      : [
        self::ADDED => $added,
        self::DELETED => $deleted
      ];
  }

  private function isAllAdded(array $before, array $after): bool
  {
    return empty($before) && !empty($after);
  }

  private function isAllDeleted(array $before, array $after): bool
  {
    return !empty($before) && empty($after);
  }

  private function hasPartiallyChanges(array $before, array $after): bool
  {
    return $before !== $after && !empty($before) && !empty($after);
  }
}
