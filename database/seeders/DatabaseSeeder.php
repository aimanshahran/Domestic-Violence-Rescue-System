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
            [
                'id' => '5',
                'name' => 'Authorities'
            ]
        ]);

        DB::table('case_severity')->insert([
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

        DB::table('case_status')->insert([
            [
                'id' => '1',
                'name' => 'received',
            ],
            [
                'id' => '2',
                'name' => 'notify authorities',
            ],
            [
                'id' => '3',
                'name' => 'authorities notified',
            ],
            [
                'id' => '4',
                'name' => 'on the way',
            ],
            [
                'id' => '5',
                'name' => 'victim picked-up',
            ],
            [
                'id' => '6',
                'name' => 'victim under investigation',
            ],
            [
                'id' => '7',
                'name' => 'victim under process by the authorities',
            ],
            [
                'id' => '8',
                'name' => 'case in court',
            ],
            [
                'id' => '9',
                'name' => 'case settled',
            ],
            [
                'id' => '10',
                'name' => 'archived',
            ],
        ]);

        DB::table('case_category')->insert([
            [
                'id' => '1',
                'name' => 'physical abused',
                'severity_status_ID' => 3,
            ],
            [
                'id' => '2',
                'name' => 'sexual abused',
                'severity_status_ID' => 3,
            ],
            [
                'id' => '3',
                'name' => 'threatening to kill you',
                'severity_status_ID' => 3,
            ],
            [
                'id' => '4',
                'name' => 'smashing things',
                'severity_status_ID' => 3,
            ],
            [
                'id' => '5',
                'name' => 'destroying property',
                'severity_status_ID' => 3,
            ],
            [
                'id' => '6',
                'name' => 'abusing pets',
                'severity_status_ID' => 3,
            ],
            [
                'id' => '7',
                'name' => 'abusing kids',
                'severity_status_ID' => 3,
            ],
            [
                'id' => '8',
                'name' => 'do illegal things',
                'severity_status_ID' => 3,
            ],
            [
                'id' => '9',
                'name' => 'displaying weapons',
                'severity_status_ID' => 3,
            ],
            [
                'id' => '10',
                'name' => 'making you afraid of him/her by using looks, actions, gestures',
                'severity_status_ID' => 3,
            ],
            [
                'id' => '11',
                'name' => 'threating to leave you alone',
                'severity_status_ID' => 2,
            ],
            [
                'id' => '12',
                'name' => 'threating to commit suicide',
                'severity_status_ID' => 2,
            ],
            [
                'id' => '13',
                'name' => 'controlling your behaviour and action',
                'severity_status_ID' => 2,
            ],
            [
                'id' => '14',
                'name' => 'limiting you from outside involvements',
                'severity_status_ID' => 2,
            ],
            [
                'id' => '15',
                'name' => 'using jealousy to justify actions',
                'severity_status_ID' => 2,
            ],
            [
                'id' => '16',
                'name' => 'making you feel guilty about the children',
                'severity_status_ID' => 1,
            ],
            [
                'id' => '17',
                'name' => 'using the children to relay messages',
                'severity_status_ID' => 1,
            ],
            [
                'id' => '18',
                'name' => 'using visitation to harass you',
                'severity_status_ID' => 1,
            ],
            [
                'id' => '19',
                'name' => 'threating to take the children away',
                'severity_status_ID' => 1,
            ],
            [
                'id' => '20',
                'name' => 'saying you caused it',
                'severity_status_ID' => 1,
            ],
            [
                'id' => '21',
                'name' => 'being the one to define men\'s and women\'s roles',
                'severity_status_ID' => 1,
            ],
            [
                'id' => '22',
                'name' => 'threating you like a servant',
                'severity_status_ID' => 1,
            ],
            [
                'id' => '23',
                'name' => 'preventing you from getting a job/keeping a job',
                'severity_status_ID' => 1,
            ],
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456'),
            'role_id' => 1,
        ]);

        DB::table('dv_information')->insert([
            [
                'category_id' => '1',
                'user_id' => '1',
            ],
            [
                'category_id' => '2',
                'user_id' => '1',
            ],
            [
                'category_id' => '3',
                'user_id' => '1',
            ],
            [
                'category_id' => '4',
                'user_id' => '1',
            ],
            [
                'category_id' => '5',
                'user_id' => '1',
            ],
        ]);
    }
}
