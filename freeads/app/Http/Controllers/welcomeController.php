<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Ad;
use Illuminate\Support\Facades\DB;

class welcomeController extends Controller
{
    //
    public function index() {
        // Get category list.
        $categories = Category::all();
        // Get ads
        $ads = DB::select('SELECT *, (SELECT pictures.url FROM pictures WHERE pictures.ads_id = ads.id) AS picture FROM ads');
        return view('welcome', 
        ['categories' => $categories, 
        'ads' => $ads]);
    }
    public function search(Request $request) {
        $search = $request->search;
        $location = $request->location;
        return view('welcome',
        ['categories' => Category::all(),
        'ads' => Ad::where('title', 'like', '%'.$search.'%')]);
    }
    public function displayCategory(int $categoryID) {
        // Get category list.
        $categories = Category::all();

        // Get ads with given IDs
        $ids = $this->buildIDArray($categoryID);
        $ads = Ad::whereIn('category_id', $ids)->get();
        $categoryList = DB::select('with recursive tree AS (
            select id, name, parent_id from categories where id=?
            union all
            select parent.id, parent.name, parent.parent_id from categories as parent
            join tree on tree.parent_id = parent.id
            )
            select id, name from tree', [$categoryID]);
        $categoryList = array_reverse($categoryList);
        return view('welcome', 
        ['categories' => $categories, 
        'ads' => $ads,
        'categoryList' => $categoryList]);
    }
    private function buildIDArray($categoryID) {
        // Initiate array
        $ids = array();
        // Get root category ID
        $selectedCat = Category::where('id',$categoryID)->first();
        // Store it's ID in the array.
        array_push($ids, $selectedCat->id);
        // Get sub category's ID.
        $subIDs = $this->getSubID($selectedCat->id);
        // Merge IDs in the same array.
        $ids = array_merge($ids, $subIDs);
        // Return completed array.
        return $ids;
    }
    // Works with buildIDArray();
    private function getSubID($categoryID) {
        // Initiate array
        $ids = array();
        // Get sub categories.
        $subCategories = Category::where('parent_id', $categoryID)->get();
        // For each : add ID to the array and check for sub categories.
        foreach($subCategories as $category) {
            array_push($ids, $category->id);
            $subIDs = $this->getSubID($category->id);
            $ids = array_merge($subIDs, $ids);
        }
        // Return completed array.
        return $ids;
    }
}
