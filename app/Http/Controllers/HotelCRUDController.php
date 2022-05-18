<?php

namespace App\Http\Controllers;
use App\Hotel;

use Illuminate\Http\Request;

class HotelCRUDController extends Controller
{
    /**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index()
	{
		$data['hotels'] = Hotel::orderBy('id','desc')->paginate(5);
		return view('index', $data);
	}
	/**
	* Show the form for creating a new resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function create()
	{
		return view('create');
	}
	/**
	* Store a newly created resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function store(Request $request)
	{
		$request->validate([
		'name' => 'required',
		'available' => 'required',
		'floor' => 'required',
		'room_no' => 'required',
		'per_room_price' => 'required'
		]);

		$hotel = new Hotel;
		$hotel->name = $request->name;
		$hotel->available = $request->available;
		$hotel->floor = $request->floor;
		$hotel->room_no = $request->room_no;
		$hotel->per_room_price = $request->per_room_price;
		$hotel->save();
		return redirect()->route('hotel.index')
		->with('success','Hotel Room has been created successfully.');
	}
	/**
	* Display the specified resource.
	*
	* @param  \App\Hotel  $hotel
	* @return \Illuminate\Http\Response
	*/
	public function show(Hotel $hotel)
	{
	return view('show',compact('hotel'));
	} 
	/**
	* Show the form for editing the specified resource.
	*
	* @param  \App\Hotel  $hotel
	* @return \Illuminate\Http\Response
	*/
	public function edit(Hotel $hotel)
	{
		return view('edit',compact('hotel'));
	}
	/**
	* Update the specified resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @param  \App\Hotel  $hotel
	* @return \Illuminate\Http\Response
	*/
	public function update(Request $request, $id)
	{
		$request->validate([
		'name' => 'required',
		'available' => 'required',
		'floor' => 'required',
		'room_no' => 'required',
		'per_room_price' => 'required'
		]);

		$hotel = Hotel::find($id);
		$hotel->name = $request->name;
		$hotel->available = $request->available;
		$hotel->floor = $request->floor;
		$hotel->room_no = $request->room_no;
		$hotel->per_room_price = $request->per_room_price;
		$hotel->save();
		return redirect()->route('hotel.index')
		->with('success','Hotel Has Been updated successfully');
	}
	/**
	* Remove the specified resource from storage.
	*
	* @param  \App\Hotel  $hotel
	* @return \Illuminate\Http\Response
	*/
	public function destroy(Hotel $hotel)
	{
		$hotel->delete();
		return redirect()->route('hotel.index')
		->with('success','Hotel Room has been deleted successfully');
	}


	public function search(Request $request){
	    // Get the search value from the request
	    $min = $request->input('min');
	    $max = $request->input('max');

	    // Search in the title and body columns from the posts table
	    $data['hotels'] = Hotel::query()
	    	->where('available', 'true')
	        ->whereBetween('per_room_price', [$min, $max])
	        ->paginate(5);	

	    // Return the search view with the results
	    return view('index', $data);
}


}
