<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class testCtrl extends Controller
{
    public function add($number) {
        return view('test', [
            'number' => $number + 5
        ]);
    }
    public function viewUsers() {
        $users = DB::table('users')->get();
        return view('test', [
            'users' => $users
        ]);
    }
    public function form(Request $request) {
        $test = $request->search;
        return view('test', [
            'test' => $test
        ]);
    }
}