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
use App\Models\Province;

class IndoRegionProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @deprecated
     *
     * @return void
     */
    //provinsi dari github
    // public function run()
    // {
    //     // Get Data
    //     $provinces = RawDataGetter::getProvinces();

    //     // Insert Data to Database
    //     DB::table('provinces')->insert($provinces);
    // }


    //provinsi dari rajaongkir
    public function run()
    {
        $response = Http::withHeaders([
            'key' => '4afd1954d5b0a88b43a793f6d7429497'
        ])->get('https://api.rajaongkir.com/starter/province');

        $provinces = $response['rajaongkir']['results'];

        foreach($provinces as $province){
        $data_province[] = [
            'id' => $province['province_id'],
            'name' => $province['province']
            ];
        }
        Province::insert($data_province);
    }

}
