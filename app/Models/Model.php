<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Ramsey\Uuid\Uuid;

abstract class Model extends EloquentModel
{
    protected $keyType = 'string';
    public $incrementing = false;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        if (!$this->getAttribute('uuid')) {
            $this->setAttribute('uuid', Uuid::uuid4());
        }
    }
}
