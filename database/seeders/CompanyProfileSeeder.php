<?php

namespace Database\Seeders;

use App\Models\CompanyProfile;
use Illuminate\Database\Seeder;

class CompanyProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompanyProfile::updateOrCreate(
            ['id' => 1],
            [
                'about' => 'Ghina Tour Travel adalah biro perjalanan wisata terpercaya yang melayani berbagai kebutuhan perjalanan Anda, mulai dari Umroh, Wisata Religi, hingga Paket Liburan Keluarga dengan harga yang kompetitif dan pelayanan prima.',
                'vision_mission' => 'Menjadi biro perjalanan wisata pilihan utama yang memberikan pengalaman perjalanan tak terlupakan dengan mengutamakan kepuasan dan kenyamanan pelanggan.',
                'whatsapp' => '081234567890',
                'email' => 'info@ghinatour.com',
                'address' => 'Jl. Pariwisata No. 45, Jakarta Selatan, DKI Jakarta 12345',
                'instagram' => '@ghinatourtravel',
            ]
        );
    }
}
