<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getAccountData()
    {
        return response()->json(['result' => true, 'user' => auth()->user()], 200);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        if ($request->email && $request->email !== $user->email) {
            $user->email = $request->email;
        }
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return response()->json(['result' => true], 200);
    }
}
