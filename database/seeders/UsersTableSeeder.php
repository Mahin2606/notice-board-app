<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'password' => '$2y$10$4HALXmVOATXmU9hPbXGbUOh1gJsFMkyUXWzGfIwwSDGdlhIg5Aoj6'
        ]);
    }
}
