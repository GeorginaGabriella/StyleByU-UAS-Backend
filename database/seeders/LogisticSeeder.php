<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShippingMethod;
use App\Models\PaymentMethod;

class LogisticSeeder extends Seeder
{
    public function run(): void
    {
        $shippings = [
            [
                'name' => 'JNE REG',
                'description' => 'Reguler',
                'price' => 15000,
                'estimated_days' => 3
            ],

            [
                'name' => 'J&T Express',
                'description' => 'Ekonomi',
                'price' => 12000,
                'estimated_days' => 4
            ],

            [
                'name' => 'SiCepat BEST',
                'description' => 'Same Day',
                'price' => 25000,
                'estimated_days' => 1
            ],
        ];

        foreach ($shippings as $ship) {
            ShippingMethod::create($ship);
        }

        $payments = [
            [
                'name' => 'COD (Bayar di Tempat)',
                'type' => 'cod',
                'description' => 'Bayar saat barang sampai',
                'is_active' => true
            ],

            [
                'name' => 'QRIS (GoPay/OVO/Dana)',
                'type' => 'qris',
                'description' => 'Scan QRIS',
                'is_active' => true
            ],

            [
                'name' => 'Transfer Bank BCA',
                'type' => 'transfer',
                'description' => 'Transfer manual ke BCA',
                'is_active' => true
            ]
        ];

        foreach ($payments as $pay) {
            PaymentMethod::create($pay);
        }
    }
}