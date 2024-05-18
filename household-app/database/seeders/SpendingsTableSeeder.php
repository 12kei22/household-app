<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpendingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $project = DB::table('projects')->first();

        DB::table('spendings')->insert([
            'project_id' => $project->id,
            'spending_name' => 'スーパー',
            'spending_amount' => 15000,
            'due_date' => date('Y-m-d H:i:s', strtotime("1 day")),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('spendings')->insert([
            'project_id' => $project->id,
            'spending_name' => '外食',
            'spending_amount' => 10000,
            'due_date' => date('Y-m-d H:i:s', strtotime("2 day")),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('spendings')->insert([
            'project_id' => $project->id,
            'spending_name' => 'コンビニ',
            'spending_amount' => 1500,
            'due_date' => date('Y-m-d H:i:s', strtotime("3 day")),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('spendings')->insert([
            'project_id' => $project->id,
            'spending_name' => 'お菓子',
            'spending_amount' => 2300,
            'due_date' => date('Y-m-d H:i:s', strtotime("4 day")),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('spendings')->insert([
            'project_id' => $project->id,
            'spending_name' => '自販機',
            'spending_amount' => 130,
            'due_date' => date('Y-m-d H:i:s', strtotime("4 day")),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

    }
}
