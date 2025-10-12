<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Resident;

class ResidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $residents = [
            [
                'nik' => '3276010101010001',
                'name' => 'Ahmad Fauzi',
                'gender' => 'male',
                'birth_date' => '1995-04-12',
                'birth_place' => 'Bandung',
                'address' => 'Jl. Merdeka No. 45, Bandung',
                'religion' => 'Islam',
                'marital_status' => 'married',
                'occupation' => 'Software Engineer',
                'phone' => '081234567890',
                'status' => 'active',
            ],
            [
                'nik' => '3276010202020002',
                'name' => 'Siti Nurhaliza',
                'gender' => 'female',
                'birth_date' => '1998-08-25',
                'birth_place' => 'Garut',
                'address' => 'Jl. Cimanuk No. 12, Garut',
                'religion' => 'Islam',
                'marital_status' => 'single',
                'occupation' => 'Designer',
                'phone' => '082134567891',
                'status' => 'active',
            ],
            [
                'nik' => '3276010303030003',
                'name' => 'Budi Santoso',
                'gender' => 'male',
                'birth_date' => '1987-02-10',
                'birth_place' => 'Jakarta',
                'address' => 'Jl. Melati No. 9, Jakarta Selatan',
                'religion' => 'Kristen',
                'marital_status' => 'married',
                'occupation' => 'Teacher',
                'phone' => '085234567892',
                'status' => 'moved',
            ],
            [
                'nik' => '3276010404040004',
                'name' => 'Maria Magdalena',
                'gender' => 'female',
                'birth_date' => '1975-12-01',
                'birth_place' => 'Surabaya',
                'address' => 'Jl. Mawar No. 8, Surabaya',
                'religion' => 'Katolik',
                'marital_status' => 'widowed',
                'occupation' => 'Nurse',
                'phone' => '081345678903',
                'status' => 'active',
            ],
            [
                'nik' => '3276010505050005',
                'name' => 'Rizky Pratama',
                'gender' => 'male',
                'birth_date' => '2001-06-20',
                'birth_place' => 'Tasikmalaya',
                'address' => 'Jl. Pahlawan No. 33, Tasikmalaya',
                'religion' => 'Islam',
                'marital_status' => 'single',
                'occupation' => 'Student',
                'phone' => '089512345678',
                'status' => 'deceased',
            ],
        ];

        foreach ($residents as $data) {
            // Buat user terlebih dahulu
            $user = User::create([
                'name' => $data['name'],
                'email' => strtolower(str_replace(' ', '', $data['name'])) . '@example.com',
                'password' => bcrypt('password'),
            ]);

            // Buat resident dan hubungkan user_id
            Resident::create(array_merge($data, [
                'user_id' => $user->id,
            ]));
        }
    }
}
