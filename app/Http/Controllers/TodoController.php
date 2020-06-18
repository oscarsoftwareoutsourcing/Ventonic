<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Todo;
use App\User;
use App\ModuleLabel;

class TodoController extends Controller
{
    // To load index of the module.
    public function index() {

        try {
            
            // We query all the data for the module.
            $moduleLabels = ModuleLabel::find(1);

            // Get user notes
            $user = User::with(['todos'])->find(Auth::id());

            $userTodos = (sizeof($user->todos) === 0) ? $user->todos : $user->todos[0]['todos'];

            return view('todos.index')->with([
                'todos' => $userTodos,
                'labels' => $moduleLabels->labels,
                'user_id' => Auth::id()
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function saveTodo(Request $request) {

        try {

            // Create object.
            $todos = Todo::where('user_id', $request->uid)->first();

            // If found, it's an update
            if($todos) {
                $todos->todos = $request->todos;

            } else {
                $todos = new Todo;
                $todos->user_id = $request->uid;
                $todos->todos = $request->todos;
            }

            // Save 
            $todos->save();

            return response()->json([
                'result' => true,
                'updatedTodos' => $todos->todos
            ]);

        } catch (\Exception $ex) {
            return response()->json([
                'result' => false
            ]);
        }
    }

    public function updateTodos(Request $request) {

        try {
            $updated_todos = null;

            // Create object.
            $todos = Todo::where('user_id', $request->uid)->first();

            $todos->todos = $request->todos;

            // Save 
            $todos->save();
            $updated_todos = $todos->todos;

            return response()->json([
                'result' => true,
                'updatedTodos' => $updated_todos
            ]);

        } catch (\Exception $ex) {
            return response()->json([
                'result' => false
            ]);
        }
    }
}