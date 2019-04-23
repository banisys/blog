<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function myFavorites()
    {
        $myFavorites = Auth::user()->favorites;
//        dd($myFavorites);
        return view('users.my_favorites', compact('myFavorites'));
    }

    public function rate()
    {
        return view('welcome');
    }
}
