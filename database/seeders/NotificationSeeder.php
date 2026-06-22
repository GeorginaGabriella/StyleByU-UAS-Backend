<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notification;
use App\Models\User;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('role', 'user')->first();

        if ($user) {
            Notification::create([
                'user_id' => $user->id,
                'title' => 'Selamat Datang di StyleByU!',
                'message' => 'Terima kasih sudah bergabung. Jangan lupa cek produk terbaru kami.',
                'is_read' => false
            ]);

            Notification::create([
                'user_id' => $user->id,
                'title' => 'Promo Spesial',
                'message' => 'Dapatkan diskon 10% untuk pembelian pertama dengan kode: HEMAT10K',
                'is_read' => false
            ]);
        }
    }
}