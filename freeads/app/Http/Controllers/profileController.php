<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class profileController extends Controller
{
    //
    private function viewData($user) {
        $categories = Category::all();
        $viewData = [
            'categories' => $categories,
            'user' => $user
        ];
        return $viewData;
    }
    public function index() {
        $user = User::find(Auth::user()->id);
        $viewData = $this->viewData($user);
        return view('profile.profile', $viewData);
    }
}
