<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Location;
use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:ad-list|ad-create|ad-edit|ad-delete', ['only' => ['index','show']]);
        $this->middleware('permission:ad-create', ['only' => ['create','store']]);
        $this->middleware('permission:ad-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:ad-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = Ad::latest()->paginate(5);

        return view('ads.index',compact('ads'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('ads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $title = $request->title;
        $description = $request->description;
        $price = $request->price;
        $image = $request->image;
        $category_id = $request->category_id;
        $users_id = $request->users_id;
        $active = $request->active;
        $country = $request->country;
        $city = $request->city;
        $postcode = $request->postcode;
        $street = $request->street;
        $number = $request->number;

        // Store location data to Locations table
        DB::table('locations')->insert([
            'country' => $country,
            'city' => $city,
            'postcode' => $postcode,
            'street' => $street,
            'number' => $number
        ]);

        //get id of created location
        $lastEntry = DB::table('locations')->orderBy('id', 'desc')->first();
        $locationID = $lastEntry->id;


        request()->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'users_id' => 'required',
            'active' => 'required',
            //'location_id' => 'required',
            'image' => 'image|required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'number' => 'required',
            'street' => 'required',
            'postcode' => 'required',
            'city' => 'required',
            'country' => 'required'
        ]);

        Ad::create([
            'title' => $title,
            'description' => $description,
            'price' => $price,
            'category_id' => $category_id,
            'users_id' => $users_id,
            'active' => $active,
            'location_id' => $locationID,
        ]);

        // Get current ad's ID.
        $currentAd = DB::table('ads')->orderBy('id', 'desc')->first();

        //store image to app's folder
        $destinationPath = 'images/';
        $profileImage = $image->getClientOriginalName();
        $image->move($destinationPath, $profileImage);

        // Store image data to Pictures table
        DB::table('pictures')->insert([
            'ads_id' => $currentAd->id,
            'main_picture' => 1,
            'url' => $profileImage
        ]);




        return redirect()->route('ads.index')
            ->with('success','Ad created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function show(Ad $ad)
    {
        $author = DB::table('users')->where('id', '=', $ad->users_id)->first();
        $category = DB::table('categories')->where('id', '=', $ad->category_id)->first();
        $location = DB::table('locations')->where('id', '=', $ad->location_id)->first();
        $picture = DB::table('pictures')->where('ads_id','=', $ad->id)->first();

        return view('ads.show',['author' => $author, 'ad' => $ad, 'category' => $category, 'location'=>$location,
            'picture' => $picture]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function edit(Ad $ad)
    {
        $author = DB::table('users')->where('id', '=', $ad->users_id)->first();
        $category = DB::table('categories')->where('id', '=', $ad->category_id)->first();
        $location = DB::table('locations')->where('id', '=', $ad->location_id)->first();
        $picture = DB::table('pictures')->where('ads_id','=', $ad->id)->first();


        return view('ads.edit',['author' => $author, 'ad' => $ad, 'category' => $category, 'location'=>$location,
            'picture' => $picture]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ad $ad)
    {

        $country = $request->country;
        $city = $request->city;
        $postcode = $request->postcode;
        $street = $request->street;
        $number = $request->number;

        request()->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'users_id' => 'required',
            'active' => 'required',

            'number' => '',
            'street' => '',
            'postcode' => '',
            'city' => '',
            'country' => ''
        ]);

        //UPDATE IMAGE
        $input = $request->all();
        $currentAd = DB::table('ads')->orderBy('id', 'desc')->first();

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = $image->getClientOriginalName();
            $image->move($destinationPath, $profileImage);

            DB::table('pictures')->update([
                'ads_id' => $currentAd->id,
                'main_picture' => 1,
                'url' => $profileImage
            ]);
        }else{
            unset($input['image']);
        }

        //UPDATE LOCATION
        //get id of location
        $lastEntry = DB::table('locations')->orderBy('id', 'desc')->first();
        $locationID = $lastEntry->id;

        
        DB::table('locations')->whereIn('id', $locationID)->update($request->all());
        /*
        DB::table('locations')->update([
            'country' => $country,
            'city' => $city,
            'postcode' => $postcode,
            'street' => $street,
            'number' => $number
        ]);
        //update the adress where location_id = this location id */

        //UPDATE AD
        $ad->update($request->all());

        return redirect()->route('ads.index')
            ->with('success','Ad updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ad $ad)
    {
        $ad->delete();
        return redirect()->route('ads.index')
            ->with('success','Ad deleted successfully');
    }



}
