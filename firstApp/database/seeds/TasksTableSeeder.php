<?php

use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i = 1; $i <= 3; $i++){
            DB::table('tasks')->insert([
                'title' => "タスク ".str_random(10),
                'message' => "テスト用のメッセージです ".str_random(10),
                'state' => rand(0,1),
                'deadline_date' => new DateTime(),
                'done_date' => NEW DateTime(),
            ]);
        }
    }
}
