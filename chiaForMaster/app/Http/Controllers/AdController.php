<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;

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
        request()->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required',
            'location_id' => 'required',
            'user_id' => 'required',
            'is_active' => 'required'
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = $image->getClientOriginalName();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }

        Ad::create($input);

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
        return view('ads.show',compact('ad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function edit(Ad $ad)
    {
        return view('ads.edit',compact('ad'));
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
        request()->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'location_id' => 'required',
            'user_id' => 'required',
            'is_active' => 'required'
        ]);

        //problem is image name stored in : IMAGES folder and database ads->image are not the same !

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = $image->getClientOriginalName();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }else{
            unset($input['image']);
        }

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
