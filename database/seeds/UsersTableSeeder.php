<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin Admin',
            'email' => 'admin@argon.com',
            'identity_card' => '960208145611',
            'phone' => '0126360644',
            'type' => 1,
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('certificate_configs')->insert([
            'name' => 'Layout 1',
            'logo_1' => 'logo_1',
            'logo_2' => 'logo_2',
            'background' => 'bg',
            'director_signature' => 'signature',
            'certificate_type' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }
}
