<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{
    /** @var Technology */
    protected $technology;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Technology $technology)
    {
        $this->technology = $technology;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->technology->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function show(Technology $technology)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Technology $technology)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function destroy(Technology $technology)
    {
        //
    }
}
