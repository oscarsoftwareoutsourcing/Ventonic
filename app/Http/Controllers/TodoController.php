<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class TodoController extends Controller
{
    // To load index of the module.
    public function index() {

        // Get user notes
        $user = User::with(['notes'])->find(Auth::id());

        return view('todos.index')->with('notes', $user->notes);
    }
}