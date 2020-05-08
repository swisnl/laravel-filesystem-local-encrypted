<?php

namespace Swis\Laravel\Encrypted;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class EncryptedCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        return $value === null ? null : decrypt($value);
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return $value === null ? null : encrypt($value);
    }
}
