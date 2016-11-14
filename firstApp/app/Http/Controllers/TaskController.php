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
        Log::debug("throw index function @ TaskController.php");
        $users = DB::table('mydb.tasks')->get();
        return view('tasks', ['users' => $users]);
    }

    public function create(Request $request)
    {
        $foo = $request->input('tihagowog');

        DB::table('mydb.tasks')->insert([
        [
            'title' => $request->input('taskname'),
            'message' =>$request->input('message'),
            'state' => 0,
            'deadline_date' => new DateTime(),
            'done_date' => new DateTime(),
        ]]);

        return redirect('/');
    }



    //
    public function updtask(Request $request, $id)
    {
        if($request['state'] == 'checked'){
            $state = 1;
        }else{
            $state = 0;
        }
        if($request->input('update')){
            DB::table('mydb.tasks')->where('id',$id)->update(['message' => $request->input('message'), 'state' => $state]);
        }elseif($request->input('delete')){
            DB::table('mydb.tasks')->where('id',$id)->delete();
        }

        return redirect('/');
    }

    //
    public function remove(Request $request, $id)
    {
        DB::table('mydb.tasks')->where('id',$id)->delete();
        return 0;
    }
}
