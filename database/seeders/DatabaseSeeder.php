<?php

namespace Database\Seeders;

use App\Enums\CustomerRole;
use App\Enums\SectionType;
use App\Models\Customer;
use App\Models\Section;
use App\Models\User;
use App\Models\Year;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Pest\ArchPresets\Custom;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $customer =  Customer::updateOrCreate(
            ['email' => 'rajtravels.bd@gmail.com'],
            [
                'name' => 'M/S RAJ TRAVELS',
                'role' => CustomerRole::Customer,
                'password' => 'raj@0935',
            ]
        );

        $agency = $customer->agency()->updateOrCreate([], [
            'name' => 'M/S RAJ TRAVELS',
            'license' => '0935',
            'address' => '189/1, Nayagola, Nayagola Hat-6300, Chapainawabganj, Rajshahi, Dhaka, Bangladesh',
            'phone' => '+8801799745020',
            'email' => 'info@msrajtravels.com',
        ]);

        $agency->teamMembers()->updateOrCreate([
            'email' => 'accounts@msrajtravels.com',
        ], [
            'name' => 'M/S RAJ TRAVELS',
            'role' => CustomerRole::TeamMember,
            'password' => 'raj@accounts',
        ]);

        if (app()->environment('production')) return;

        Year::updateOrCreate([
            'name' => 'Hajj 2026',
        ], [
            "start_date" => "2025-06-01",
            "end_date" => "2026-05-31",
            "status" => true,
        ]);

        Customer::updateOrCreate(
            ['email' => 'customer@email.com'],
            [
                'name' => 'Customer',
                'password' => 'password',
            ]
        );


        // User::updateOrCreate(
        //     ['email' => 'user@email.com'],
        //     [
        //         'first_name' => 'Raj',
        //         'last_name' => 'Travels',
        //         'username' => 'rajtravels',
        //         'password' => 'password',
        //         'gender' => 'male',
        //     ]
        // );

        // Section::updateOrCreate(
        //     ['code' => '205.00'],
        //     [
        //         'name' => 'Lending & Collection',
        //         'type' => SectionType::Lend,
        //         'description' => 'Lending & Collection Section',
        //     ]
        // );

        // Section::updateOrCreate(
        //     ['code' => '101.00'],
        //     [
        //         'name' => 'Borrowing & Payment',
        //         'type' => SectionType::Borrow,
        //         'description' => 'Borrowing & Payment Section',
        //     ]
        // );

        // Section::updateOrCreate([
        //     'type' => SectionType::PreRegistration,
        // ], [
        //     'code' => '402.00',
        //     'name' => 'Pre Registration',
        //     'description' => 'Pre Registration Section.',
        // ]);

        // Section::updateOrCreate([
        //     'type' => SectionType::Registration,
        // ], [
        //     'name' => 'Registration',
        //     'description' => 'Registration Section.',
        // ]);
    }
}
