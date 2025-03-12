<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Rate;
use Illuminate\Http\Request;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function getReviews($store_id) {
        $reviews = Rate::with('customer')->where('store_id', $store_id)->latest()->get();
        return response()->json($reviews);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'rating' => 'required',
            'comment' => 'required',
        ],[
            'rating.required' => 'Rating is required',
            'comment.required' => 'Comment is required',
        ]);

        $rate = new Rate();
        $rate->rate = $data['rating'];
        $rate->noidung = $data['comment'];
        $rate->store_id = $request->store_id;
        $rate->customer_id = 1;
        $rate->save();

        $customer = Customer::find(1);

        return response()->json([
            'success' => true,
            'review' => [
                'user_name' => $customer->hoten, // Lấy tên người dùng
                'rating' => $rate->rate,
                'comment' => $rate->noidung,
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function show(Rate $rate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function edit(Rate $rate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rate $rate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rate $rate)
    {
        //
    }
}
