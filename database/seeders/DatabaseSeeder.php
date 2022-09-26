<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dv_category')->insert([
            [
                'id' => '1',
                'name' => 'Introduction',
            ],
            [
                'id' => '2',
                'name' => 'Staying Safe',
            ],
            [
                'id' => '3',
                'name' => 'Getting Help',
            ],
            [
                'id' => '4',
                'name' => 'Laws',
            ],
            [
                'id' => '5',
                'name' => 'FAQ',
            ],
        ]);

        DB::table('feedback_status')->insert([
            [
                'id' => '1',
                'name' => 'Received',
            ],
            [
                'id' => '2',
                'name' => 'In process',
            ],
            [
                'id' => '3',
                'name' => 'Reply',
            ],
            [
                'id' => '4',
                'name' => 'Closed',
            ],
            [
                'id' => '5',
                'name' => 'Archived',
            ],
        ]);

        DB::table('gender')->insert([
            [
                'id' => '1',
                'type' => 'Male',
            ],
            [
                'id' => '2',
                'type' => 'Female',
            ],
        ]);

        DB::table('role')->insert([
            [
                'id' => '1',
                'name' => 'Admin',
            ],
            [
                'id' => '2',
                'name' => 'User',
            ],
            [
                'id' => '3',
                'name' => 'Counselor',
            ],
            [
                'id' => '4',
                'name' => 'Writer',
            ],
        ]);

        DB::table('severity_status')->insert([
            [
                'id' => '1',
                'name' => 'Low',
            ],
            [
                'id' => '2',
                'name' => 'Medium',
            ],
            [
                'id' => '3',
                'name' => 'High',
            ],
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456'),
            'role_id' => 1,
        ]);
    }
}
