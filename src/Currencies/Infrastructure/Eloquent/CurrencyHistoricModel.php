<?php

namespace Hoyvoy\Currencies\Infrastructure\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CurrencyHistoricModel extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'historic_currencies';
}
