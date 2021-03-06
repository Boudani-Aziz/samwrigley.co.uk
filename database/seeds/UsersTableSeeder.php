<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        factory(User::class)->create([
            'name' => 'Sam Wrigley',
            'slug' => 'sam-wrigley',
            'email' => Config::get('contact.email'),
            'password' => bcrypt('secret'),
        ]);
    }
}
