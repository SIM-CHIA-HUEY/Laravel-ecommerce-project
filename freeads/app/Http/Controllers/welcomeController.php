<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Ad;
use Illuminate\Support\Facades\DB;
use App\Models\Picture;

class welcomeController extends Controller
{
    private $categories;

    public function __construct()
    {
        $this->categories = Category::all();
    }
    public function index() {

        // Get ads
        $ads = DB::table('ads')
                ->where('active', '=', '1')
                ->join('pictures', 'pictures.ads_id', '=', 'ads.id')
                ->where('main_picture', '=', '1')
                ->select('ads.*', 'pictures.url')
                ->get();

        return view('welcome', 
        ['categories' => $this->categories, 
        'ads' => $ads,
        'page' => 'index']);
    }
    // Work in progress
    // 
    public function search(Request $request) {
        $search = '%'.$request->search.'%';
        $location = $request->location;

        // Validate data received
        $validated = $request->validate([
            'search' => 'required'
        ]);

        if(is_null($location)) {
            $ads = DB::table('ads')
                    ->where('title', 'like', $search)
                    ->where('active', '=', '1')
                    ->join('pictures', 'pictures.ads_id', '=', 'ads.id')
                    ->where('main_picture', '=', '1')
                    ->select('ads.*', 'pictures.url')
                    ->get();
        } else {
            $ads = DB::table('ads')
                    ->where('title', 'like', $search)
                    ->where('active', '=', '1')
                    ->join('pictures', 'pictures.ads_id', '=', 'ads.id')
                    ->where('main_picture', '=', '1')
                    ->leftJoin('locations', 'ads.location_id', '=', 'locations.id')
                    ->where('postcode', '=', $location)
                    ->orWhere('city', 'like', $location)
                    ->select('ads.*', 'pictures.url', 'locations.id')
                    ->get();
        }

        return view('welcome',
        ['categories' => $this->categories,
        'ads' => $ads]);
    }
    // Get ads for a given category.
    public function displayCategory(int $categoryID) {

        // Get ads with given IDs
        $ids = $this->buildIDArray($categoryID);
        $ads = DB::table('ads')
                ->where('active', '=', '1')
                ->whereIn('ads.category_id', $ids)
                ->join('pictures', 'pictures.ads_id', '=', 'ads.id')
                ->where('main_picture', '=', '1')
                ->get();
        // Get category list for breadcrumb
        $categoryList = DB::select('with recursive tree AS (
            select id, name, parent_id from categories where id=?
            union all
            select parent.id, parent.name, parent.parent_id from categories as parent
            join tree on tree.parent_id = parent.id
            )
            select id, name from tree', [$categoryID]);
        $categoryList = array_reverse($categoryList);

        return view('welcome', 
        ['categories' => $this->categories, 
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
