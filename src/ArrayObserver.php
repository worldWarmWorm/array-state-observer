<?php

namespace WorldWarmWorm\ArrayStateObserver;

use WorldWarmWorm\ArrayStateObserver\interfaces\Observable;

abstract class ArrayObserver implements Observable
{
  protected const ADDED = 'added';

  protected const DELETED = 'deleted';

  protected array $added = [];

  protected array $deleted = [];

  private function __construct() {}

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
      : [self::ADDED => $added, self::DELETED => $deleted];
  }

  abstract protected function observe(array $before, array $after): self;

  public static function init(array $before, array $after): self
  {
    return (new static())->observe($before, $after);
  }

  /** @todo учесть что значения могут остаться, а ключи поменяться */
  protected function isAllAdded(array $before, array $after): bool
  {
    return empty($before) && !empty($after);
  }

  /** @todo учесть что значения могут остаться, а ключи поменяться */
  protected function isAllDeleted(array $before, array $after): bool
  {
    return !empty($before) && empty($after);
  }

  /** @todo учесть что значения могут остаться, а ключи поменяться */
  protected function hasPartiallyChanges(array $before, array $after): bool
  {
    return $before !== $after && !empty($before) && !empty($after);
  }
}
