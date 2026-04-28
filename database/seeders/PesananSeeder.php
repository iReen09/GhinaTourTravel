<?php

namespace Database\Seeders;

use App\Models\Paket;
use App\Models\Pesanan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pakets = Paket::all();

        if ($pakets->isEmpty()) {
            $this->command->info('Tidak ada paket, lewati PesananSeeder.');
            return;
        }

        $faker = \Faker\Factory::create('id_ID');

        for ($i = 0; $i < 10; $i++) {
            $paket = $pakets->random();
            $jumlahOrang = rand(1, 5);
            $totalHarga = $paket->harga_paket * $jumlahOrang;

            Pesanan::create([
                'id_paket' => $paket->id,
                'nama_pemesan' => $faker->name,
                'no_hp' => '08' . $faker->numerify('##########'),
                'diskon' => 0,
                'total_harga' => $totalHarga,
                'tanggal_acara' => now()->addDays(rand(1, 30)),
                'jumlah_orang' => $jumlahOrang,
                'invoice' => 'INV-' . strtoupper(Str::random(10)),
                'status' => 'pending',
            ]);
        }
    }
}
