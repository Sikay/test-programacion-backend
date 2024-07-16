<?php

namespace Hoyvoy\Currencies\Infrastructure\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CurrencyModel extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'currencies';

    protected static function newFactory()
    {
        return CurrencyFactory::new();
    }
}
