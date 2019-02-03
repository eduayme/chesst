<?php

namespace ChessT\Http\Controllers;

use Auth;
use Carbon\Carbon;
use ChessT\Tournament;
use Illuminate\Http\Request;

class MyTournaments extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tournaments = Tournament::all()->where( 'user_id', Auth::user()->id );

        return view('auth.mytournaments', compact('tournaments'));
    }
}
