<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;

class Todolistcontroller extends Controller
{
    public function index(){
        $todos = Todo::All();
        return view('todo.index' , [
            'todos' => $todos
        ]);
    }

    public function update(Request $request){

        /*
        $todo = Todo::create([
            'title' => $request->input('title')
        ]);
        */

        $todo = Todo::create($request->all());
        return redirect('/todo');
    }
    

    public function delete(Request $request , Todo $todo){

        $todo->delete();
        return redirect('/todo');
    }

    
}
