<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::truncate();
        DB::table('users')->insert([
            [
                
                
                    'id_karyawan' => '1131211',
                    'name' => 'User',
                    'username' => 'user',
                    'password' => Hash::make('user'),
                    'aktif' => true,
                    'level' => 'user',
                
                
            ],
            [
                
                'id_karyawan' => '212132',
                'name' => 'Admin',
                'username' => 'admin',
                'password' => Hash::make('admin'),
                'aktif' => true,
                'level' => 'admin',
            ],
            [
               
                'id_karyawan' => '2121323',
                'name' => 'Admin2',
                'username' => 'admin2.cda',
                'password' => Hash::make('admin2'),
                'aktif' => true,
                'level' => 'admin',
            ],
            [
                'id_karyawan' => '2121393',
                'name' => 'Superadmin',
                'username' => 'superadmin.cda',
                'password' => Hash::make('superadmin'),
                'aktif' => true,
                'level' => 'superadmin',
            ],
        ]);
    }
}
