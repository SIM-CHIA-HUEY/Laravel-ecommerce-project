<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Models\Ad;
use Illuminate\Support\Facades\Auth;
use App\Models\Picture;

class myadsController extends Controller
{
    private $categories;

    public function __construct()
    {
        $this->categories = Category::all();
    }

    private function getViewData($ads, $pictures = NULL, $view='list') {
        $data = [
            'categories' => $this->categories,
            'ads' => $ads,
            'view' => $view,
            'pictures' => $pictures
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
                ->where('ads.id', '=', $id)
                ->first();
        if(is_null($ad)) {
            return redirect('/');
        }
        $pictures = DB::table('pictures')
                    ->where('ads_id', '=', $ad->id)
                    ->get();
        $view = 'form';
        $viewData = $this->getViewData($ad, $pictures, $view);
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
        $mainImage = $request->mainImage;
        $image2 = $request->image2;
        $image2 = $request->image3;
        
        // Validate data
        $validated = $request->validate([
            'title' => 'required|max:50',
            'description' => 'required',
            'price' => 'required',
            'category' => 'required',
            'mainImage' => 'image|nullable',
            'image2' => 'image|nullable',
            'image3' => 'image|nullable'
        ]);

        // Update the ad
        $ad = Ad::find($adid);
        $ad->title = $title;
        $ad->description = $description;
        $ad->category_id = $category_id;
        $ad->price = $price;
        $ad->save();
        $view = 'form';

        // Upload the pictures & update the table.

        // Upload main file.
        if($request->mainImage != NULL) {
            $path = $request->file('mainImage')->storePublicly('public/images');
            $path = str_replace('public', 'storage', $path);
        } else {
            $path = NULL;
        }
        // Upload 2nd file.
        if($request->image2 != NULL) {
            $path2 = $request->file('image2')->storePublicly('public/images');
            $path2 = str_replace('public', 'storage', $path2);
        } else {
            $path2 = NULL;
        }
        // Upload 3rd file.
        if($request->image3 != NULL) {
            $path3 = $request->file('image3')->storePublicly('public/images');
            $path3 = str_replace('public', 'storage', $path3);
        } else {
            $path3 = NULL;
        }
        if(!is_null($path)) {
            $main_picture = Picture::where('ads_id', '=', $ad->id)->first();
            $main_picture->url = $path;
            $main_picture->save();
        }

        // Retrieve the pictures to display
        $pictures = DB::table('pictures')
                    ->where('ads_id', '=', $ad->id)
                    ->get();

        // Get view data & display
        $viewData = $this->getViewData($ad, $pictures, $view);
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
