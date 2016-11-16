<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use DateTime;
use Response;
use Log;

class TaskController extends Controller
{
    //
    public function index()
    {
        //Log::debug("index function @ TaskController.php");
        $users = DB::table('mydb.tasks')->get();
        return view('tasks', ['users' => $users]);
    }

    public function tasklist(Request $request)
    {
        Log::debug("tasklist function @ TaskController.php");
        $users = DB::table('mydb.tasks')->get();
        return Response::json($users);
    }

    public function create(Request $request)
    {
        DB::table('mydb.tasks')->insert([
        [
            'title' => $request->input('taskname'),
            'message' =>$request->input('message'),
            'state' => 0,
            'deadline_date' => new DateTime(),
            'done_date' => new DateTime(),
        ]]);

        return 0;
    }



    //
    public function updtask(Request $request, $id)
    {

        if( $request->input('state') == "true" ){
            $newState = 1;
        }else{
            $newState = 0;
        }

        DB::table('mydb.tasks')->where('id',$id)->update(['message' => $request->input('message'), 'state' => $newState]);

        return 0;
    }

    //
    public function remove(Request $request, $id)
    {
        DB::table('mydb.tasks')->where('id',$id)->delete();
        return 0;
    }
}
