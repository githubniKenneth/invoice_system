<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::create([
            'first_name' => 'Kenneth',
            'middle_name' => 'Rey',
            'last_name' => 'Hontucan',
            'full_name' => 'Kenneth Rey Hontuacn',
            'street' => '123',
            'barangay' => 'Dummy',
            'city' => 'Makati',
            'full_address' => '123 Dummy Makati',
            'created_by' => '1', 
        ]);

        Customer::create([
            'first_name' => 'Test',
            'middle_name' => 'C',
            'last_name' => '123',
            'full_name' => 'Test C 123',
            'street' => '123',
            'barangay' => 'Barangay',
            'city' => 'Makati',
            'full_address' => '123 Barangay Makati',
            'created_by' => '1', 
        ]);
    }
}
