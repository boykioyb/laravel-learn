<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RegisterUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->create([
            'name' => 'Trần Quang Hòa',
            'email' => 'hoatq.dev@gmail.com',
            'username' => 'boykioyb',
            'status' => 1,
            'password' => Hash::make("123456")
        ]);
    }
}
