<?php

namespace WorldWarmWorm\ArrayStateObserver\interfaces;

interface Observable
{
  /**
   * @return array{
   *   added: array<int|string|null, string|int|null>
   * }
   */
  public function added(): array;


  /**
   * @return array{
   *   deleted: array<int|string|null, string|int|null>
   * }
   */
  public function deleted(): array;

  /**
   * @return array{
   *   added: array<string|int|null, string|int|null>,
   *   deleted: array<string|int|null, string|int|null>
   * }
   */
  public function all(): array;
}