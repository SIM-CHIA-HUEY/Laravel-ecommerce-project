<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Location;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class profileController extends Controller
{
    //
    private function viewData($user) {
        $categories = Category::all();
        $viewData = [
            'categories' => $categories,
            'users' => $user
        ];
        return $viewData;
    }
    public function index() {
        $user = DB::table('users')
                ->where('users.id', '=', Auth::user()->id)
                ->leftJoin('locations', 'locations.id', '=', 'users.location_id')
                ->select('users.*', 'locations.*')
                ->get();
        $viewData = $this->viewData($user);
        return view('profile.profile', $viewData);
    }
    public function update(Request $request) {
        // Control data
        $validated = $request->validate([
            'username' => 'required',
            'phone_number' => 'required',
            'number' => 'required',
            'street' => 'required',
            'postcode' => 'required',
            'city' => 'required',
            'country' => 'required'
        ]);
        // Update user
        $user = User::find(Auth::user()->id);
        $user->name = $request->username;
        $user->phone_number = $request->phone_number;
        $user->save();

        // Update location
        $location = Location::find(Auth::user()->location_id);
        $location->number = $request->number;
        $location->street = $request->street;
        $location->postcode = $request->postcode;
        $location->city = $request->city;
        $location->country = $request->country;
        $location->save();

        $users = DB::table('users')
                ->where('users.id', '=', Auth::user()->id)
                ->leftJoin('locations', 'locations.id', '=', 'users.location_id')
                ->select('users.*', 'locations.*')
                ->get();
        $viewData = $this->viewData($users);
        return view('profile.profile', $viewData);
    }
}
