<?php

use Illuminate\Database\Seeder;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Str;
use App\User;
use Carbon\Carbon;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate(
            ['email' => 'ncohen@dev.com'],
            [
                'uuid' => Str::uuid(),
                'name' => 'Nick',
                'last_name' => 'Cohen',
                'type' => 'V',
                'status' => 1,
                'email_verified_at' => date('Y-m-d H:i:s'),
                'password' => (new BcryptHasher)->make('12345678'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null
            ]
        );

        User::updateOrCreate(
            ['email' => 'admin@dev.com'],
            [
                'uuid' => Str::uuid(),
                'name' => 'Admin',
                'last_name' => 'Admin',
                'status' => 1,
                'email_verified_at' => Carbon::now(),
                'password' => (new BcryptHasher)->make('12345678'),
                'is_admin' => true
            ]
        );
    }
}
