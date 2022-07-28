<?php

namespace App\Http\Traits;

trait UsesUuid
{
  protected static function bootUsesUuid() {
    static::creating(function ($model) {
      $model->uuid = (string) \Uuid::generate(4);
    });
  }

  public function getIncrementing()
  {
      return false;
  }

  public function getKeyType()
  {
      return 'string';
  }
}