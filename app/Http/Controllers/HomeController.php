<?php

namespace ChessT\Http\Controllers;

use Auth;
use Carbon\Carbon;
use ChessT\Tournament;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tournaments = Tournament::all()->where( 'end', '>=', Carbon::today() )->take(10);

        $categories = Tournament::select( 'category' )->groupBy( 'category' )->take(5)->get();

        $countries = Tournament::select( 'country' )->groupBy( 'country' )->take(5)->get();

        $cities = Tournament::select( 'city' )->groupBy( 'city' )->take(5)->get();

        return view( 'main',
        compact( 'tournaments', 'categories', 'countries', 'cities' ) );
    }
}
