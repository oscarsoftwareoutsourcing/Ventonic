<?php

use Illuminate\Database\Seeder;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'uuid' => Str::uuid(),
            'name' => 'Nick',
            'last_name' => 'Cohen',
            'email' => 'ncohen@dev.com',
            'type' => 'V',
            'status' => 1,
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => (new BcryptHasher)->make('12345678'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null
        ]);
    }
}
