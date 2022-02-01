<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::create([
            'name' => 'mohammed adil',
            'phone' => ['091623195', '0123654987'],
            'address' => 'Omdurman Kh'
        ]);

        Client::create([
            'name' => 'monzer balla',
            'phone' => ['091234789'],
            'address' => 'Omdurman Kh'
        ]);
    }
}
