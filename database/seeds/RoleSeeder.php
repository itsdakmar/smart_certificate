<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Role::create(['name' => 'admin','slug' => 'Pentadbir', 'guard_name' => 'web']);
        \App\Role::create(['name' => 'secretariat','slug' => 'Urusetia kursus', 'guard_name' => 'web']);
        \App\Role::create(['name' => 'director','slug' => 'Pengarah', 'guard_name' => 'web']);
    }
}
