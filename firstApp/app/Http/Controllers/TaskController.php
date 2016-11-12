<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use DateTime;

class TaskController extends Controller
{

    //
    public function index()
    {
        $users = DB::table('mydb.tasks')->get();
        return view('tasks', ['users' => $users]);
    }

    //
    public function create(Request $request)
    {
        return view('newTask');
    }


    //
    public function update(Request $request)
    {
        if($request->input('do')){
            DB::table('mydb.tasks')->insert([
                [
                 'title' => $request->input('title'),
                 'message' =>$request->input('message'),
                 'state' => 0,
                 'deadline_date' => new DateTime(),
                 'done_date' => new DateTime(),
            ]]);
        }

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



}
