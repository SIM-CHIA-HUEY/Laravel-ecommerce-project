<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class postadController extends Controller
{
    private $categories;

    public function __construct()
    {
        $this->categories = Category::all();
    }
    public function index() {
        return view('postad.postad', [
            'categories' => $this->categories
        ]);
    }

    // An ad has been posted by the user.
    public function post(Request $request) {
        // Retrieve data
        $title = $request->title;
        $description = $request->description;
        $category_id = $request->category;
        $price = $request->price;
        
        // Validate data
        $validated = $request->validate([
            'title' => 'required|max:50',
            'description' => 'required',
            'price' => 'required',
            'category' => 'required',
            'mainImage' => 'image|required',
            'image2' => 'image',
            'image3' => 'image'
        ]);

        // Upload main file.
        $path = $request->file('mainImage')->storePublicly('public/images');
        $path = str_replace('public', 'storage', $path);
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

        // Insert ads information in DB.
        DB::table('ads')->insert([
            'title' => $title,
            'description' => $description,
            'category_id' => $category_id,
            'price' => $price,
            'users_id' => '1',
            'location_id' => '1',
            'active' => '1'
        ]);
        // Get current ad's ID.
        $currentAd = DB::table('ads')->orderBy('id', 'desc')->first();

        // Update pictures table with main pictures.
        DB::table('pictures')->insert([
            'ads_id' => $currentAd->id,
            'main_picture' => '1',
            'url' => $path
        ]);
        if($path2 != NULL) {
            DB::table('pictures')->insert([
                'ads_id' => $currentAd->id,
                'main_picture' => '0',
                'url' => $path2
            ]);
        }
        if($path3 != NULL) {
            DB::table('pictures')->insert([
                'ads_id' => $currentAd->id,
                'main_picture' => '0',
                'url' => $path3
            ]);
        }

        // Return the view.
        return view('postad.postad', [
            'categories' => $this->categories,
            'success' => 'true'
        ]);
    }
}
