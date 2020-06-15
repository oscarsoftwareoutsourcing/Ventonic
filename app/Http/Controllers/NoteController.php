<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class NoteController extends Controller
{
    // To load index of the module.
    public function index() {

        // Get user notes
        $user = User::with(['notes'])->find(Auth::id());

        return view('notes.index')->with('notes', $user->notes);
    }
}