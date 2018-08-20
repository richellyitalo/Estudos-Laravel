<?php

use Illuminate\Database\Seeder;
use App\User;

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
            'name' => 'Jao',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin')
        ]);

        User::create([
            'name' => 'Outro usuário',
            'email' => 'outro@outro.com',
            'password' => bcrypt('outro')
        ]);
    }
}
