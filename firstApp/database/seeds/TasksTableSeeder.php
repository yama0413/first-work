<?php

use Illuminate\Database\Seeder;
use App\Task;

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
        for($i=1; $i<=3; $i++){
            $task = new Task;

            $task->title = "test".$i;
            $task->message = "message".$i;
            $task->state = rand(0, 1);

            $task->save();
        }
    }
}
