<?php

namespace App\Http\Controllers;

use App\Models\Todolist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TodolistController extends Controller
{
    public function addTodo(Request $request)
    {
        $todo = Todolist::create([
            'todo_id' => uniqid(),
            'user_id' => Auth::user()->id,
            'todo' => $request->todo,
            'checked' => false
        ]);
        if ($todo) {
            Session::flash('status', 'success');
            return redirect('/home')->with('message', 'Success Add Data');
        } else {
            Session::flash('status', 'failed');
            return redirect('/home')->with('message', 'Failed Add Data');
        }
    }

    public function showTodolistPage()
    {
        $todolists = User::with('todolist')->find(Auth::user()->id);
        return view('todolist.todolist', [
            'title' => 'Todolists',
            'todolists' => $todolists
        ]);
    }

    public function checkTodo($todo_id)
    {
        $todo = Todolist::where('todo_id', $todo_id);
        $selectedTodo = Todolist::where('todo_id', $todo_id)->get();
        $todo->update(
            [
                'checked' => !$selectedTodo->first()->checked
            ]
        );

        return redirect('/home');
    }

    public function deleteTodo($todo_id)
    {
        $todo = Todolist::where('todo_id', $todo_id)->delete();
        return redirect('/home');
    }
}
