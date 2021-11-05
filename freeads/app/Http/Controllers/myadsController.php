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
    // Display all the ads owned by user.
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
    // Display form with a specific ad.id = $id
    public function getAd(int $id) {
        if(!isset(Auth::user()->id)) {
            return redirect('/');
        }
        // Get specified ad
        $ad = DB::table('ads')
                ->where('users_id', '=', Auth::user()->id)
                ->where('ads.id', '=', $id)
                ->first();
        // Verify it is owned by the user
        if(is_null($ad)) {
            return redirect('/');
        }
        // Get related pictures and their ID.
        $pictures = DB::table('pictures')
                    ->where('ads_id', '=', $ad->id)
                    ->orderBy('id', 'asc')
                    ->get();
        $view = 'form';
        $viewData = $this->getViewData($ad, $pictures, $view);
        return view('myads.myads', $viewData);
    }
    // Updated specific ad then send back to the form.
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
            'mainImage' => 'image|nullable',
            'image2' => 'image|nullable',
            'image3' => 'image|nullable',
            'newImage2' => 'image|nullable',
            'newImage3' => 'image|nullable'
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
        // Add a new 2nd image
        if($request->newImage2 != NULL) {
            $newPath2 = $request->file('newImage2')->storePublicly('public/images');
            $newPath2 = str_replace('public', 'storage', $newPath2);
        } else {
            $newPath2 = NULL;
        }
        // Add a new 3rd image
        if($request->newImage3 != NULL) {
            $newPath3 = $request->file('newImage3')->storePublicly('public/images');
            $newPath3 = str_replace('public', 'storage', $newPath3);
        } else {
            $newPath3 = NULL;
        }
        // Updating image base.
        if(!is_null($path)) {
            $main_picture = Picture::where('ads_id', '=', $ad->id)->first();
            $main_picture->url = $path;
            $main_picture->save();
        }
        if(!is_null($path2)) {
            $id_second_image = $request->id2;
            $second_picture = Picture::find($id_second_image);
            $second_picture->url = $path2;
            $second_picture->save();
        }
        if(!is_null($path3)) {
            $id_third_image = $request->id3;
            $third_picture = Picture::find($id_third_image);
            $third_picture->url = $path3;
            $third_picture->save();
        }
        if(!is_null($newPath2)) {
            DB::table('pictures')->insert([
                'ads_id' => $adid,
                'main_picture' => '0',
                'url' => $newPath2
            ]);
        }
        if(!is_null($newPath3)) {
            DB::table('pictures')->insert([
                'ads_id' => $adid,
                'main_picture' => '0',
                'url' => $newPath3
            ]);
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
