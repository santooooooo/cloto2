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
}
