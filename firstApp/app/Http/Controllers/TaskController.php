<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Task;

use DB;
use DateTime;
use Response;
use Log;

class TaskController extends Controller
{
    // トップページを返す
    public function index()
    {
        //Log::debug("index function @ TaskController.php");
        $users = \App\Task::all();
        return view('tasks');
    }

    // タスクリストをJSONで返す
    public function tasklist(Request $request)
    {
        //Log::debug("tasklist function @ TaskController.php");
        $users = \App\Task::all();
        return Response::json($users);
    }

    public function create(Request $request)
    {
        $new_task = new Task;
        $new_task->title = $request->input('taskname');
        $new_task->message = $request->input('message');
        $new_task->state = 0;
        $new_task->save();

        return 0;
    }



    //
    public function updtask(Request $request, $id)
    {
        //Log::debug("updtask function @ TaskController.php");
        if( $request->input('state') == "true" ){
            $newState = 1;
        }else{
            $newState = 0;
        }
        $task = \App\Task::find($id);
        $task->message = $request->input('message');
        $task->state = $newState;
        $task->save();

        return 0;
    }

    //
    public function remove(Request $request, $id)
    {
        $task = \App\Task::find($id);
        $task->delete();

        return 0;
    }
}
