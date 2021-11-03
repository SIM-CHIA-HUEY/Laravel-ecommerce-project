<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Models\Ad;
use Illuminate\Support\Facades\Auth;

class myadsController extends Controller
{
    private $categories;

    public function __construct()
    {
        $this->categories = Category::all();
    }

    private function getViewData($ads, $view='list') {
        $data = [
            'categories' => $this->categories,
            'ads' => $ads,
            'view' => $view
            ];
        return $data;
    }
    public function index() {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        $ads = DB::table('ads')
                ->where('users_id', '=', Auth::user()->id)
                ->get();
        $viewData = $this->getViewData($ads);
        return view('myads.myads', $viewData);
    }
    public function getAd(int $id) {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        $ad = DB::table('ads')
                ->where('users_id', '=', Auth::user()->id)
                ->where('id', '=', $id)
                ->first();
        if(is_null($ad)) {
            return redirect('/');
        }
        $view = 'form';
        $viewData = $this->getViewData($ad, $view);
        return view('myads.myads', $viewData);
    }
    public function updateAd(Request $request) {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        // Retrieve data
        $title = $request->title;
        $description = $request->description;
        $category_id = $request->category;
        $price = $request->price;
        $adid = $request->adid;
        
        // Validate data
        $validated = $request->validate([
            'title' => 'required|max:50',
            'description' => 'required',
            'price' => 'required',
            'category' => 'required',
        ]);
        $ad = Ad::find($adid);
        $ad->title = $title;
        $ad->description = $description;
        $ad->category_id = $category_id;
        $ad->price = $price;
        $ad->save();
        $view = 'form';
        $viewData = $this->getViewData($ad, $view);
        return view('myads.myads', $viewData)->with('success', true);
    }
    public function enable($id) {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        $ad = Ad::find($id);
        if($ad->users_id != Auth::user()->id) {
            return redirect('/');
        }
        $ad->active = 1;
        $ad->save();
        $ads = DB::table('ads')
                ->where('users_id', '=', Auth::user()->id)
                ->get();
        $viewData = $this->getViewData($ads);
        return view('myads.myads', $viewData);
    }
    public function disable($id) {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        $ad = Ad::find($id);
        if($ad->users_id != Auth::user()->id) {
            return redirect('/');
        }
        $ad->active = 0;
        $ad->save();
        $ads = DB::table('ads')
                ->where('users_id', '=', Auth::user()->id)
                ->get();
        $viewData = $this->getViewData($ads);
        return view('myads.myads', $viewData);
    }
}
