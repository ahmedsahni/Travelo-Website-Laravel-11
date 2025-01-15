<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        // Fetch all countries from the database
        $countries = Country::all();

        // Pass countries to the view
        return view('admin.countries', compact('countries'));
    }
    public function store(Request $request)
    {
        // Validate the uploaded image
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Store the image
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads'), $imageName);

        // Store the image filename in the database
        $country = new Country();
        $country->name = $request->name;
        $country->price = $request->price;
        $country->image = $imageName;  // Store filename
        $country->save();

        return redirect()->route('country.index');
    }
    public function destroy($id)
    {
        // Find the country by ID
        $country = Country::findOrFail($id);

        // Delete the country from the database
        $country->delete();

        // Redirect to the countries page with a success message
        return redirect()->route('admin.countries')->with('success', 'Country deleted successfully.');
    }
}
