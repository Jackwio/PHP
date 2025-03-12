<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    public function __construct(string $base_currency, string $last_updated, object $rate)
    {
        $this->base_currency = $base_currency;
        $this->last_updated = $last_updated;
        $this->rate = $rate;
    }

    public string $base_currency;

    public string $last_updated;

    public object $rate;
}
