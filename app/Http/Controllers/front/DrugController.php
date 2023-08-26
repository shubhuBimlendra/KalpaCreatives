<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Drug;
use Illuminate\Support\Carbon;
use Auth;

class DrugController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drugs=Drug::orderBy('id','desc')->paginate(5);
        return view('front.drug.index', compact('drugs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('front.drug.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'quantity' => 'required|numeric',
            'image' => 'required|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $drug = new Drug;
        $drug->title = $request->title;
        $drug->description = $request->description;
        $drug->added_by = Auth::user()->name;
        $drug->updated_by = 'NAN';
        $drug->price = $request->price;
        $drug->discount = $request->discount;
        $drug->qty = $request->quantity;

        $imageName = Carbon::now()->timestamp. '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $drug->image = $imageName;

        $drug->save();
        return redirect()->route('drugs.index')
        ->with('message','Drug has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $drug = Drug::findOrFail($id);
        return view('front.drug.edit',compact('drug'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'quantity' => 'required|numeric',
            'image' => 'required|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $drug = Drug::findOrFail($id);
        $drug->title = $request->title;
        $drug->description = $request->description;
        $drug->updated_by = Auth::user()->name;
        $drug->price = $request->price;
        $drug->discount = $request->discount;
        $drug->qty = $request->quantity;

        $imageName = Carbon::now()->timestamp. '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $drug->image = $imageName;

        $drug->save();
        return redirect()->route('drugs.index')
        ->with('message','Drug has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $drug = Drug::findOrFail($id);
        $drug->delete();
        return redirect()->route('drugs.index')
        ->with('message','Drug has been deleted successfully.');
    }
}
