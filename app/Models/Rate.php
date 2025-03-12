<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    public function __construct(float $USD, float $TWD, float $JPY)
    {
        $this->USD = $USD;
        $this->TWD = $TWD;
        $this->JPY = $JPY;
    }

    public float $USD;

    public float $TWD;

    public float $JPY;
}
