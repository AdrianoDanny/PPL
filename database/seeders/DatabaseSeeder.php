<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kabupaten;
use App\Models\Kecamatan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // Seed Kabupaten
        $kabupaten1 = Kabupaten::create(['kabupaten' => 'Jember']);
        $kabupaten2 = Kabupaten::create(['kabupaten' => 'Banyuwangi']);

        // Seed Kecamatan
        Kecamatan::create(['kecamatan' => 'Sumbersari', 'kabupaten_id' => $kabupaten1->id]);
        Kecamatan::create(['kecamatan' => 'Tanggul', 'kabupaten_id' => $kabupaten1->id]);
        Kecamatan::create(['kecamatan' => 'Genteng', 'kabupaten_id' => $kabupaten2->id]);
        Kecamatan::create(['kecamatan' => 'Banyuwangi', 'kabupaten_id' => $kabupaten2->id]);
    }
}
