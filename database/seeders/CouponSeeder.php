<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coupon;

class CouponSeeder extends Seeder
{
    public function run(): void
    {
        Coupon::create([
            'code' => 'HEMAT10K',
            'discount_amount' => 10000,
            'is_active' => true
        ]);
    }
}