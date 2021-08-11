<?php

/*
 * This file is part of the IndoRegion package.
 *
 * (c) Azis Hapidin <azishapidin.com | azishapidin@gmail.com>
 *
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use AzisHapidin\IndoRegion\RawDataGetter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\Regency;

class IndoRegionRegencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @deprecated
     *
     * @return void
     */
    // public function run()
    // {
    //     // Get Data
    //     $regencies = RawDataGetter::getRegencies();

    //     // Insert Data to Database
    //     DB::table('regencies')->insert($regencies);
    // }

    //kota dari raja ongkir
    public function run()
    {
        $response = Http::withHeaders([
            'key' => '4afd1954d5b0a88b43a793f6d7429497'
        ])->get('https://api.rajaongkir.com/starter/city');

        $regencies = $response['rajaongkir']['results'];

        foreach($regencies as $regency){
        $data_regency[] = [
            'id' => $regency['city_id'],
            'province_id' => $regency['province_id'],
            'name' => $regency['city_name']
            ];
        }
        Regency::insert($data_regency);
    }
}
