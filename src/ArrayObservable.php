<?php

interface ArrayObservable
{
  public function added(): array;

  public function deleted(): array;

  /**
   * @return array{
   *   added: array<int, string|int>,
   *   deleted: array<int, string|int>
   * }
   */
  public function all(): array;
}