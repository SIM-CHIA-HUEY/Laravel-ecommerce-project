<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

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
    public function post(Request $request) {
        // Retrieve data
        $title = $request->title;
        $description = $request->description;
        $category_id = $request->category;
        $price = $request->price;
        $validated = $request->validate([
            'title' => 'required|max:50',
            'description' => 'required|max:255',
            'price' => 'required',
            'category' => 'required'
        ]);
        /*
        DB::table('ads')->insert([
            'title' => $title,
            'description' => $description,
            'category_id' => $category_id,
            'price' => $price,
            'users_id' => '1',
            'location_id' => '1',
            'active' => '1'
        ]);
        $currentAd = DB::table('ads')->orderBy('id', 'desc')->first();
        DB::table('pictures')->insert([
            'ads_id' => $currentAd->id,
            'main_picture' => '1',
            'url' => 'default_product.png'
        ]);
        */
        return view('postad.postad', [
            'categories' => $this->categories
        ]);
    }
}
