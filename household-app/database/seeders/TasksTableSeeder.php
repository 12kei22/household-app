<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $project = DB::table('projects')->first();

        DB::table('tasks')->insert([
            'project_id' => $project->id,
            'spending_name' => '食費',
            'spending_amount' => 30000,
            'due_date' => date('Y-m-d H:i:s', strtotime("1 day")),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('tasks')->insert([
            'project_id' => $project->id,
            'spending_name' => '光熱費',
            'spending_amount' => 20000,
            'due_date' => date('Y-m-d H:i:s', strtotime("2 day")),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('tasks')->insert([
            'project_id' => $project->id,
            'spending_name' => '通信費',
            'spending_amount' => 3000,
            'due_date' => date('Y-m-d H:i:s', strtotime("3 day")),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('tasks')->insert([
            'project_id' => $project->id,
            'spending_name' => '交際費',
            'spending_amount' => 30000,
            'due_date' => date('Y-m-d H:i:s', strtotime("4 day")),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
