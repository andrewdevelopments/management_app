<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UserSeeder::class);
        factory(App\User::class, 10)->create();
        App\User::create([
            'name' => 'Senior Software Admin',
            'email' => 'admin@admin.ro',
            'colour' => '#f00',
            'role' => 'Admin',
            'email_verified_at' => now(),
            'password' => bcrypt('admin'),
            'remember_token' => Str::random(10),
        ]);
        App\User::create([
            'name' => 'Senior Software User',
            'email' => 'user@user.ro',
            'colour' => '#f00',
            'role' => 'Developer',
            'email_verified_at' => now(),
            'password' => bcrypt('user'),
            'remember_token' => Str::random(10),
        ]);
    }
}
